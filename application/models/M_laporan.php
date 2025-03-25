<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class M_laporan extends CI_Model
{
	public function insertPoinLaporan($nis_siswa, $total_poin, $id_laporan, $id_pelanggaran, $poin_pelanggaran)
	{
		// Validasi input
		if (empty($nis_siswa) || empty($total_poin) || empty($id_laporan) || empty($id_pelanggaran) || empty($poin_pelanggaran)) {
			echo json_encode(array('status' => 'error', 'message' => 'Input tidak valid'));
			exit; // Menghentikan eksekusi agar tidak ada output lain
		}

		// Ambil tahun ajaran yang sedang aktif
		$tahun_ajaran_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row();
		if (!$tahun_ajaran_aktif) {
			echo json_encode(array('status' => 'error', 'message' => 'Tahun akademik aktif tidak ditemukan'));
			exit;
		}
		$tahun_aktif = $tahun_ajaran_aktif->tahun_akademik;

		// Ambil poin lama siswa
		$poin_lama = $this->db->get_where('siswa', array('nis_siswa' => $nis_siswa))->row();
		if (!$poin_lama) {
			echo json_encode(array('status' => 'error', 'message' => 'Siswa tidak ditemukan'));
			exit;
		}

		// Hitung poin baru
		$poin_baru = $poin_lama->poin_siswa + (int)$total_poin;
		$max_poin = 100;

		// Cek apakah poin baru melebihi batas maksimal
		if ($poin_baru > $max_poin) {
			echo json_encode(array('status' => 'error', 'message' => 'Poin siswa melebihi batas maksimal (100). Poin tidak ditambahkan.'));
			exit;
		}

		// Update poin siswa
		$siswa = array('poin_siswa' => $poin_baru);
		$this->db->where('nis_siswa', $nis_siswa);
		if (!$this->db->update('siswa', $siswa)) {
			echo json_encode(array('status' => 'error', 'message' => 'Gagal memperbarui poin siswa'));
			exit;
		}

		// Loop dan update laporan untuk setiap pelanggaran
		foreach ($id_pelanggaran as $index => $id_p) {
			$laporan = array(
				'tanggal_konfirmasi_pelanggaran' => date('Y-m-d'),
				'status_validasi' => 'Y',
				'id_pelanggaran' => $id_p,
				'poin_pelanggaran' => (int)$poin_pelanggaran[$index],
				'tahun_akademik' => $tahun_aktif
			);
			$this->db->where('id_laporan', $id_laporan);
			if (!$this->db->update('laporan', $laporan)) {
				echo json_encode(array('status' => 'error', 'message' => 'Gagal memperbarui laporan'));
				exit;
			}
		}

		// Panggil fungsi dari model M_bimbingan
		$this->load->model('M_bimbingan');
		$this->m_bimbingan->CekDataBimbingan($nis_siswa, $poin_baru, $id_laporan);

		$this->load->model('M_siswa');
		$siswa = $this->m_siswa->getSiswaIdAndWali($nis_siswa);

		if ($siswa['poin_siswa'] >= 25) {
			echo json_encode(array('status' => 'success', 'message' => 'Poin berhasil ditambahkan', 'apakahBimbingan' => true, 'linkWaWali' => $this->BuatLinkWhatsapp($siswa['nama_siswa'], $siswa['nama_kelas'], $this->getLaporanPelanggaranBySiswa($nis_siswa, $tahun_aktif), $siswa['poin_siswa'], date('Y-m-d'), $siswa['no_telephone_wali_siswa'], $siswa['nama_wali_siswa'])));
		} else {
			echo json_encode(array('status' => 'success', 'message' => 'Poin berhasil ditambahkan', 'apakahBimbingan' => false, 'linkWaWali' => null));
		}


		exit;
	}

	public function BuatLinkWhatsapp($nama_siswa, $kelas, $pelanggaran, $poin, $tanggal, $nomor_wali, $nama_wali)
	{
		$nomor_wali = str_replace("08", "628", $nomor_wali);

		$pesan = "*Bimbingan Konseling SMK NEGERI 5 Palembang*\n\n";

		$pesan .= "Yth. $nama_wali,\n\n";
		$pesan .= "Kami dari pihak layanan Bimbingan Konseling (BK) SMK Negeri 5 Palembang, ingin menyampaikan bahwa anak Bapak/Ibu yang bernama *$nama_siswa*, kelas *$kelas*, telah melakukan pelanggaran tata tertib sekolah dengan rincian:\n\n";

		$nomor = 1;

		foreach ($pelanggaran as $pel) {
			$pesan .= "- *Pelanggaran ke-$nomor :* \n";
			$pesan .= "Deskripsi Pelanggaran		   : " . $pel['deskripsi_pelanggaran'] . "\n";
			$pesan .= "Poin pelanggaran    			   : " . $pel['poin_pelanggaran'] . " poin\n";
			$pesan .= "Tanggal dan Waktu kejadian      : " .  $pel['create_date'] . "\n";
			$nomor++;
		}

		$pesan .= "\nDengan jumlah poin yang didapatkan oleh anak Bapak/Ibu adalah sebesar *" . $poin . "*, termasuk poin-poin pelanggaran lain.\n";
		$pesan .= "Maka dari itu kami pihak layanan Bimbingan Konseling (BK) SMK NEGERI 5 Palembang, mengundang Bapak/Ibu untuk menghadiri panggilan ke sekolah.\n\n";
		$pesan .= "Informasi lebih detail mengenai laporan ini juga dapat Bapak/Ibu akses pada laman website Bimbingan Konseling (BK) SMK NEGERI 5 Palembang.\n";
		$pesan .= "\nLink : http://localhost/bimbingan_konseling\n\n";
		$pesan .= "Demikian informasi ini kami sampaikan. Terima kasih atas perhatian dan kerja sama Bapak/Ibu.\n\n";
		$pesan .= "Hormat kami,\nBimbingan Konseling Sekolah.";

		$pesan = urlencode($pesan);

		// Buat link WhatsApp
		$link_wa = "https://wa.me/$nomor_wali?text=$pesan";

		return $link_wa;
	}

	public function insertPoinSiswa($nis, $poin, $id_laporan, $id_pelanggaran_array)
	{
		date_default_timezone_set('Asia/Jakarta');

		// Ambil data siswa berdasarkan NIS
		$siswa = $this->db->get_where('siswa', array('nis_siswa' => $nis))->row();

		if (!$siswa) {
			echo json_encode(array('status' => 'error', 'message' => 'Siswa tidak ditemukan'));
			exit;
		}

		// Ambil tahun ajaran yang sedang aktif
		$tahun_ajaran_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row();
		if (!$tahun_ajaran_aktif) {
			echo json_encode(array('status' => 'error', 'message' => 'Tahun ajaran aktif tidak ditemukan'));
			exit;
		}
		$tahun_aktif = $tahun_ajaran_aktif->tahun_akademik;

		// Hitung poin baru
		$poin_baru = $siswa->poin_siswa + $poin;
		$max_poin = 100;

		// Cek apakah poin baru melebihi batas maksimal
		if ($poin_baru > $max_poin) {
			echo json_encode(array('status' => 'error', 'message' => 'Poin siswa melebihi batas maksimal (100). Poin tidak ditambahkan.'));
			exit;
		}

		// Update poin siswa
		$this->db->where('nis_siswa', $nis);
		if (!$this->db->update('siswa', array('poin_siswa' => $poin_baru))) {
			echo json_encode(array('status' => 'error', 'message' => 'Gagal memperbarui poin siswa'));
			exit;
		}

		// Memanggil fungsi dari model M_bimbingan untuk mengecek data bimbingan
		$this->load->model('M_bimbingan');
		$this->m_bimbingan->CekDataBimbingan($siswa->nis_siswa, $poin_baru, $id_laporan);

		$this->load->model('M_pelanggaran');

		foreach ($id_pelanggaran_array as $id_pelanggaran) {
			$pelanggaran = $this->m_pelanggaran->GetDataPelanggaranForInsertPoin($id_pelanggaran);


			// Persiapkan data untuk laporan
			$laporan = array(
				'nis_siswa' => $siswa->nis_siswa,
				'id_pelanggaran' => $id_pelanggaran,
				'poin_pelanggaran' => $poin,
				'nip_nuptk' => $this->session->userdata('id'),
				'deskripsi_pelanggaran' => $pelanggaran['jenis_pelanggaran'],
				'tanggal_konfirmasi_pelanggaran' => date('Y-m-d'),
				'tahun_akademik' => $tahun_aktif,
				'create_date' => date('Y-m-d H:i:s'),
				'create_who' => $this->session->userdata('username'),
				'read_status_admin' => 'N',
				'read_status_siswa' => 'N',
				'read_status_wali' => 'N',
				'status_validasi' => 'Y'
			);

			// Insert data laporan ke database
			if (!$this->db->insert('laporan', $laporan)) {
				echo json_encode(array('status' => 'error', 'message' => 'Gagal insert laporan'));
				exit;
			}
		}

		$this->load->model('M_siswa');
		$siswa = $this->m_siswa->getSiswaIdAndWali($siswa->nis_siswa);

		if ($siswa['poin_siswa'] >= 25) {
			echo json_encode(array('status' => 'success', 'message' => 'Poin berhasil ditambahkan', 'apakahBimbingan' => true, 'linkWaWali' => $this->BuatLinkWhatsapp($siswa['nama_siswa'], $siswa['nama_kelas'], $this->getLaporanPelanggaranBySiswa($siswa['nis_siswa'], $tahun_aktif), $siswa['poin_siswa'], date('Y-m-d'), $siswa['no_telephone_wali_siswa'], $siswa['nama_wali_siswa'])));
		} else {
			echo json_encode(array('status' => 'success', 'message' => 'Poin berhasil ditambahkan', 'apakahBimbingan' => false, 'linkWaWali' => null));
		}

		exit;
	}


	public function tolakLaporan($id_laporan)
	{
		//update laporan siswa sebagai tervalidasi
		$laporan = array(
			'status_validasi' => 'N'
		);
		$this->db->where('id_laporan', $id_laporan);
		$this->db->update('laporan', $laporan);
		echo "sukses";
	}

	//query umtuk menampilkan laporan pelanggaran

	public function getLaporanPelanggaran($type_akses)
	{
		if ($type_akses == 'adminbk') {
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.`nama_guru`,
				siswa.nama_siswa,
				kelas.nama_kelas, -- Mengambil nama_kelas
				siswa.nis_siswa
				FROM laporan
				INNER JOIN guru ON guru.`nip_nuptk` = laporan.`nip_nuptk`
				INNER JOIN siswa ON siswa.`nis_siswa` = laporan.`nis_siswa`
				INNER JOIN kelas ON kelas.`id_kelas` = siswa.`kelas` -- Menghubungkan ke tabel kelas
				WHERE laporan.status_validasi = 'B'
			");
		} else if ($type_akses == 'kepsek') {
			// Kepala sekolah melihat semua laporan
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.nama_guru,
				siswa.nama_siswa,
				kelas.nama_kelas,
				pelanggaran.kode_pelanggaran -- Mengambil kode_pelanggaran dari tabel pelanggaran
				FROM laporan
				INNER JOIN guru ON guru.nip_nuptk = laporan.nip_nuptk
				INNER JOIN siswa ON siswa.nis_siswa = laporan.nis_siswa
				INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
				INNER JOIN pelanggaran ON pelanggaran.id = laporan.id_pelanggaran -- Menghubungkan ke tabel pelanggaran
				ORDER BY laporan.tanggal_laporan DESC
			");
		} else if ($type_akses == 'guru') {
			// Guru melihat semua laporan yang dibuat oleh mereka, diurutkan dari yang terbaru
			$nip_nuptk = $this->session->userdata('id'); // id guru dari sesi
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.nama_guru,
				siswa.nama_siswa,
				kelas.nama_kelas
				FROM laporan
				INNER JOIN guru ON guru.nip_nuptk = laporan.nip_nuptk
				INNER JOIN siswa ON siswa.nis_siswa = laporan.nis_siswa
				INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
				WHERE laporan.nip_nuptk = $nip_nuptk
				ORDER BY laporan.create_date DESC
			");
		} else if ($type_akses == 'murid') {
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.`nama_guru`,
				siswa.nama_siswa,
				kelas.nama_kelas, -- Mengambil nama_kelas
				pelanggaran.kode_pelanggaran -- Mengambil kode_pelanggaran dari tabel pelanggaran
				FROM laporan
				INNER JOIN guru ON guru.`nip_nuptk` = laporan.`nip_nuptk`
				INNER JOIN siswa ON siswa.`nis_siswa` = laporan.`nis_siswa`
				INNER JOIN kelas ON kelas.`id_kelas` = siswa.`kelas` -- Menghubungkan ke tabel kelas
				INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran = laporan.id_pelanggaran -- Menghubungkan ke tabel pelanggaran
				WHERE siswa.nis_siswa = " . $this->session->userdata('id'));
		} else if ($type_akses == 'wali_murid') {
			// Ambil NIS anak dari tabel wali_siswa
			$nis_anak = $this->db->query("SELECT nis_siswa FROM wali_siswa WHERE id_wali = " . $this->session->userdata('id'))->row()->nis_siswa;

			// Query untuk menampilkan laporan pelanggaran berdasarkan NIS anak
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.nama_guru,
				siswa.nama_siswa,
				kelas.nama_kelas,
				pelanggaran.kode_pelanggaran -- Mengambil kode_pelanggaran dari tabel pelanggaran
				FROM laporan
				INNER JOIN guru ON guru.nip_nuptk = laporan.nip_nuptk
				INNER JOIN siswa ON siswa.nis_siswa = laporan.nis_siswa
				INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
				INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran = laporan.id_pelanggaran -- Menghubungkan ke tabel pelanggaran
				WHERE siswa.nis_siswa = '$nis_anak'
			");
		}

		return $q;
	}

	public function getLaporanPelanggaranBySiswa($nis_siswa, $tahun_ajaran_aktif)
	{
		$this->db->select('deskripsi_pelanggaran, poin_pelanggaran, create_date');

		$this->db->from('laporan');

		$this->db->where('nis_siswa', $nis_siswa);
		$this->db->where('tahun_akademik', $tahun_ajaran_aktif);

		$this->db->order_by('poin_pelanggaran', 'DESC'); // Urutkan dari yang terbesar
		// $this->db->limit(1); // Ambil hanya satu data

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
			log_message('info', 'tidak ada data');
		} else {
			return null; // Jika tidak ada data
		}
	}

	public function getSatuLaporanPelanggaranBySiswa($nis_siswa, $tahun_ajaran_aktif)
	{
		$this->db->select('deskripsi_pelanggaran, poin_pelanggaran, create_date');

		$this->db->from('laporan');

		$this->db->where('nis_siswa', $nis_siswa);
		$this->db->where('tahun_akademik', $tahun_ajaran_aktif);

		$this->db->order_by('id_laporan', 'DESC'); // Urutkan dari yang terbesar
		$this->db->limit(1); // Ambil hanya satu data

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
			log_message('info', 'tidak ada data');
		} else {
			return null; // Jika tidak ada data
		}
	}

	public function getHistoriLaporan($tahun_ajaran = null)
	{
		$this->db->select('
			laporan.*,
			guru.nama_guru,
			siswa.nama_siswa,
			kelas.nama_kelas,
			pelanggaran.kode_pelanggaran
		');
		$this->db->from('laporan');
		$this->db->join('guru', 'guru.nip_nuptk = laporan.nip_nuptk');
		$this->db->join('siswa', 'siswa.nis_siswa = laporan.nis_siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas');
		$this->db->join('pelanggaran', 'pelanggaran.id_pelanggaran = laporan.id_pelanggaran');
		$this->db->where_in('laporan.status_validasi', ['N', 'Y']);

		// Jika ada filter tahun ajaran, tambahkan kondisi
		if ($tahun_ajaran) {
			$this->db->where('laporan.tahun_akademik', $tahun_ajaran);
		}


		return $this->db->get();
	}

	//query untuk menginsert laporan pelanggaran siswa
	public function TambahLaporanPelanggaran($nis, $deskripsi)
	{
		$data_siswa = $this->db->get_where('siswa', array('nis_siswa' => $nis))->row();
		$laporan = array(
			'nis_siswa' => $nis,
			'nip_nuptk' => $this->session->userdata('id'),
			'deskripsi_pelanggaran' => $deskripsi,
			'tahun_akademik' => '2024/2025',
			'create_date' => date('Y-m-d H:i:s'),
			'create_who' => $this->session->userdata('username'),
			'read_status_admin' => 'N',
			'read_status_siswa' => 'N',
			'read_status_wali' => 'N',
			'status_validasi' => 'B'
		);

		$this->db->insert('laporan', $laporan);
		echo "sukses";
	}
}
