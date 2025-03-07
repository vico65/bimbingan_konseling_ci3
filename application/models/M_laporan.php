<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model{
	public function insertPoinLaporan($id_siswa, $total_poin, $id_laporan, $id_pelanggaran, $poin_pelanggaran) {
		// Validasi input
		if (empty($id_siswa) || empty($total_poin) || empty($id_laporan) || empty($id_pelanggaran) || empty($poin_pelanggaran)) {
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
		$poin_lama = $this->db->get_where('siswa', array('id_siswa' => $id_siswa))->row();
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
		$this->db->where('id_siswa', $id_siswa);
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
		$this->m_bimbingan->CekDataBimbingan($id_siswa, $poin_baru, $id_laporan);
	
		echo json_encode(array('status' => 'success', 'message' => 'Poin berhasil ditambahkan'));
		exit;
	}
	
	public function insertPoinSiswa($nis, $poin, $id_laporan, $id_pelanggaran_array) {
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
		$this->m_bimbingan->CekDataBimbingan($siswa->id_siswa, $poin_baru, $id_laporan);
	
		foreach ($id_pelanggaran_array as $id_pelanggaran) {
			// Persiapkan data untuk laporan
			$laporan = array(
				'nis_siswa' => $siswa->nis_siswa,
				'id_pelanggaran' => $id_pelanggaran,
				'poin_pelanggaran' => $poin,
				'id_guru' => $this->session->userdata('id'),
				'deskripsi_pelanggaran' => 'Poin siswa bertambah ' . $poin . ' poin.',
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
	
		echo json_encode(array('status' => 'success', 'message' => 'Poin berhasil ditambahkan'));
		exit;
	}
	
	
    public function tolakLaporan($id_laporan){
		//update laporan siswa sebagai tervalidasi
		$laporan=array(
			'status_validasi' => 'N'
		);
		$this->db->where('id_laporan',$id_laporan);
		$this->db->update('laporan',$laporan);	
		echo "sukses";	
	}

    //query umtuk menampilkan laporan pelanggaran

	public function getLaporanPelanggaran($type_akses) {
		if ($type_akses == 'adminbk') {
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.`nama_guru`,
				siswa.nama_siswa,
				kelas.nama_kelas, -- Mengambil nama_kelas
				siswa.id_siswa
				FROM laporan
				INNER JOIN guru ON guru.`id_guru` = laporan.`id_guru`
				INNER JOIN siswa ON siswa.`nis_siswa` = laporan.`nis_siswa`
				INNER JOIN kelas ON kelas.`id_kelas` = siswa.`kelas` -- Menghubungkan ke tabel kelas
				WHERE laporan.status_validasi = 'B'
			");
		}else if ($type_akses == 'kepsek') {
			// Kepala sekolah melihat semua laporan
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.nama_guru,
				siswa.nama_siswa,
				kelas.nama_kelas,
				pelanggaran.kode_pelanggaran -- Mengambil kode_pelanggaran dari tabel pelanggaran
				FROM laporan
				INNER JOIN guru ON guru.id_guru = laporan.id_guru
				INNER JOIN siswa ON siswa.nis_siswa = laporan.nis_siswa
				INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
				INNER JOIN pelanggaran ON pelanggaran.id = laporan.id_pelanggaran -- Menghubungkan ke tabel pelanggaran
				ORDER BY laporan.tanggal_laporan DESC
			");
		} else if ($type_akses == 'guru') {
			// Guru melihat semua laporan yang dibuat oleh mereka, diurutkan dari yang terbaru
			$id_guru = $this->session->userdata('id'); // id guru dari sesi
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.nama_guru,
				siswa.nama_siswa,
				kelas.nama_kelas
				FROM laporan
				INNER JOIN guru ON guru.id_guru = laporan.id_guru
				INNER JOIN siswa ON siswa.nis_siswa = laporan.nis_siswa
				INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
				WHERE laporan.id_guru = $id_guru
				ORDER BY laporan.create_date DESC
			");
		}else if ($type_akses == 'murid') {
			$q = $this->db->query("SELECT 
				laporan.*,
				guru.`nama_guru`,
				siswa.nama_siswa,
				kelas.nama_kelas, -- Mengambil nama_kelas
				pelanggaran.kode_pelanggaran -- Mengambil kode_pelanggaran dari tabel pelanggaran
				FROM laporan
				INNER JOIN guru ON guru.`id_guru` = laporan.`id_guru`
				INNER JOIN siswa ON siswa.`nis_siswa` = laporan.`nis_siswa`
				INNER JOIN kelas ON kelas.`id_kelas` = siswa.`kelas` -- Menghubungkan ke tabel kelas
				INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran = laporan.id_pelanggaran -- Menghubungkan ke tabel pelanggaran
				WHERE siswa.nis_siswa = " . $this->session->userdata('id'));
		}else if ($type_akses == 'wali_murid') {
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
				INNER JOIN guru ON guru.id_guru = laporan.id_guru
				INNER JOIN siswa ON siswa.nis_siswa = laporan.nis_siswa
				INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
				INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran = laporan.id_pelanggaran -- Menghubungkan ke tabel pelanggaran
				WHERE siswa.nis_siswa = '$nis_anak'
			");
		}
	
		return $q;
	}
	

	public function getHistoriLaporan($tahun_ajaran = null) {
		$this->db->select('
			laporan.*,
			guru.nama_guru,
			siswa.nama_siswa,
			kelas.nama_kelas,
			pelanggaran.kode_pelanggaran
		');
		$this->db->from('laporan');
		$this->db->join('guru', 'guru.id_guru = laporan.id_guru');
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
	public function TambahLaporanPelanggaran($nis,$deskripsi){
		$data_siswa=$this->db->get_where('siswa', array('nis_siswa' => $nis))->row();
		$laporan=array(
			'nis_siswa' => $nis, 
			'id_guru' => $this->session->userdata('id'), 
			'deskripsi_pelanggaran' => $deskripsi, 
			'tahun_akademik' => '2024/2025',
			'create_date' => date('Y-m-d H:i:s'), 
			'create_who' => $this->session->userdata('username'), 
			'read_status_admin' => 'N',
			'read_status_siswa' => 'N',
			'read_status_wali' => 'N',
			'status_validasi' => 'B'
		);

		$this->db->insert('laporan',$laporan);
		echo "sukses";
	}


}

?>