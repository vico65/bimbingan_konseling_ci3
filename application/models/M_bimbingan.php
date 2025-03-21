<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class M_bimbingan extends CI_Model
{

	public function getTahunAjaran()
	{
		$this->db->select('tahun_akademik');
		$this->db->from('tahun_akademik');
		$this->db->order_by('tahun_akademik', 'DESC');
		return $this->db->get()->result_array();
	}

	public function getDataBimbingan($tahun_akademik = null)
	{
		$this->db->select('
            bimbingan.*,
            siswa.nama_siswa,
            siswa.kelas,	
            siswa.nis_siswa
        ');
		$this->db->from('bimbingan');
		$this->db->join('siswa', 'siswa.nis_siswa = bimbingan.nis_siswa');

		if ($tahun_akademik) {
			$this->db->where('bimbingan.tahun_akademik', $tahun_akademik);
		}

		return $this->db->get();
	}

	public function getDataBimbinganOrderById($tahun_akademik = null)
	{
		$this->db->select('
            bimbingan.*,
            siswa.nama_siswa,
            siswa.kelas,	
            siswa.nis_siswa,
			kelas.nama_kelas
        ');
		$this->db->from('bimbingan');
		$this->db->join('siswa', 'siswa.nis_siswa = bimbingan.nis_siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas');
		$this->db->order_by('bimbingan.id_bimbingan', 'DESC');

		if ($tahun_akademik) {
			$this->db->where('bimbingan.tahun_akademik', $tahun_akademik);
		}

		return $this->db->get();
	}

	public function CekDataBimbingan($nis_siswa, $poin, $id_laporan)
	{
		$cekPoin = $this->db->get_where('siswa', array('nis_siswa' => $nis_siswa))->row();
		if (!$cekPoin) {
			log_message('error', 'Siswa dengan ID ' . $nis_siswa . ' tidak ditemukan.');
			return false;
		}

		$totalPoin = $cekPoin->poin_siswa;

		// Tentukan jenis bimbingan
		if ($totalPoin >= 100) {
			$jenis = 'Berhenti'; // Jika poin >= 100, jenis bimbingan adalah Berhenti
		} elseif ($totalPoin >= 75) {
			$jenis = 'SP3';
		} elseif ($totalPoin >= 50) {
			$jenis = 'SP2';
		} elseif ($totalPoin >= 25) {
			$jenis = 'SP1';
		} else {
			return;
		}

		// Periksa apakah bimbingan sudah ada untuk tahun ajaran yang sama
		$tahun_akademik_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row();
		if (!$tahun_akademik_aktif) {
			return false;
		}
		$tahun_aktif = $tahun_akademik_aktif->tahun_akademik;

		// $cekBimbingan = $this->db->get_where('bimbingan', array(
		// 	'nis_siswa' => $cekPoin->nis_siswa,
		// 	'kode_bimbingan' => $jenis,
		// 	'tahun_akademik' => $tahun_aktif,
		// 	'status_bimbingan' => 'AKTIF'
		// ))->row();

		// if (!$cekBimbingan) {
		$this->InsertBimbinganSiswa($nis_siswa, $poin, $id_laporan, $jenis);
		// }
	}


	public function InsertBimbinganSiswa($nis_siswa, $poin, $id_laporan, $jenis)
	{
		// Ambil tahun ajaran aktif
		$tahun_akademik_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row();
		if (!$tahun_akademik_aktif) {
			log_message('error', 'Tahun ajaran aktif tidak ditemukan!');
			return false;
		}
		$tahun_aktif = $tahun_akademik_aktif->tahun_akademik;

		// Ambil data siswa
		$data_siswa = $this->db->get_where('siswa', array('nis_siswa' => $nis_siswa))->row();
		if (!$data_siswa) {
			return false;
		}

		// Cek apakah bimbingan dengan NIS dan kode yang sama sudah ada di tahun ajaran aktif
		$cek_bimbingan = $this->db->get_where('bimbingan', [
			'nis_siswa' => $data_siswa->nis_siswa,
			'tahun_akademik' => $tahun_aktif,
			'status_bimbingan' => 'AKTIF'
		])->row();

		if ($cek_bimbingan) {
			// log_message('info', 'Bimbingan sudah ada untuk NIS: ' . $data_siswa->nis_siswa . ' dan kode: ' . $jenis);
			$this->expiredBimbingan($cek_bimbingan->id_bimbingan);
		}

		// Buat data bimbingan baru
		$bimbingan = array(
			'nis_siswa' => $data_siswa->nis_siswa,
			'kode_bimbingan' => $jenis,
			'tanggal_bimbingan' => date('Y-m-d'),
			'poin_pelanggaran' => $poin,
			'tahun_akademik' => $tahun_aktif,
			'create_date' => date('Y-m-d H:i:s'),
			'status_bimbingan' => 'AKTIF',
		);

		$this->db->insert('bimbingan', $bimbingan);
		$id_bimbingan = $this->db->insert_id();

		if ($id_bimbingan > 0) {
			// log_message('info', 'Bimbingan berhasil dibuat dengan ID: ' . $id_bimbingan);
			$sp = ($jenis == 'SP1') ? 1 : (($jenis == 'SP2') ? 2 : 3);
			$this->buatJadwalBimbingan($id_bimbingan, $nis_siswa);
		} else {
			log_message('error', 'Gagal menyimpan bimbingan.');
		}
	}

	public function buatJadwalBimbingan($id_bimbingan, $nis_siswa)
	{
		$tanggal_awal = date('Y-m-d');
		$jumlah_hari = 0;

		// Cari hari terdekat yang bukan Sabtu atau Minggu
		do {
			$jumlah_hari++;
			$tgl_jadwal = date('Y-m-d', strtotime($tanggal_awal . " +" . $jumlah_hari . " day"));
			$hari = date('N', strtotime($tgl_jadwal)); // 6 = Sabtu, 7 = Minggu
		} while ($hari >= 6); // Lewati Sabtu & Minggu

		// Buat jadwal hanya untuk satu hari
		$jadwal = array(
			'tanggal_bimbingan' => $tgl_jadwal,
			'status_bimbingan' => 'Tidak Aktif',
			'id_bimbingan' => $id_bimbingan,
			'nis_siswa' => $nis_siswa
		);

		$this->db->insert('jadwal_bimbingan', $jadwal);
		log_message('info', 'Jadwal bimbingan dibuat: ' . json_encode($jadwal));
	}



	public function getDataBimbinganByParam($id)
	{
		// Pastikan $id adalah angka untuk mencegah SQL injection
		$id = (int) $id;

		$query = $this->db->query("
			SELECT 
				bimbingan.*,
				siswa.nis_siswa, siswa.nama_siswa, siswa.no_telephone_siswa, siswa.poin_siswa,
				kelas.nama_kelas,  
				data_value.deskripsi, data_value.remark
			FROM bimbingan
			INNER JOIN siswa ON siswa.nis_siswa = bimbingan.nis_siswa
			INNER JOIN kelas ON kelas.id_kelas = siswa.kelas
			INNER JOIN data_value ON data_value.type_value = bimbingan.kode_bimbingan
			WHERE bimbingan.id_bimbingan = $id
		");

		// Periksa jika query gagal
		if (!$query) {
			log_message('error', 'Query getDataBimbinganByParam gagal: ' . $this->db->error()['message']);
			return false;
		}

		return $query;
	}





	public function getJadwalBimbingan($id)
	{
		$query = $this->db->query("SELECT * FROM jadwal_bimbingan WHERE id_bimbingan=" . $id);
		return $query;
	}

	public function validasiKehadiranBimbingan($id_jadwal)
	{
		$jadwal = array(
			'status_bimbingan' => 'Aktif'
		);
		$this->db->where('id_jadwal_bimbingan', $id_jadwal);
		$this->db->update('jadwal_bimbingan', $jadwal);
		echo "sukses";
	}

	public function expiredBimbingan($id_bimbingan)
	{
		$data = array(
			'status_bimbingan' => 'EXPIRED'
		);
		$this->db->where('id_bimbingan', $id_bimbingan);
		$this->db->update('bimbingan', $data);
	}

	public function getDataBimbinganByIdSiswa($id, $type)
	{
		$status = "AKTIF";
		if ($type == 'HEADER') {
			$q = $this->db->query("
				SELECT 
					bimbingan.*, 
					jadwal_bimbingan.tanggal_bimbingan, jadwal_bimbingan.id_bimbingan, jadwal_bimbingan.nis_siswa
				FROM 
					bimbingan 
				INNER JOIN jadwal_bimbingan 
					ON jadwal_bimbingan.id_bimbingan = bimbingan.id_bimbingan 
				WHERE 
					bimbingan.nis_siswa = ? 
					AND jadwal_bimbingan.nis_siswa = ?
					AND bimbingan.status_bimbingan = ? 
				ORDER BY jadwal_bimbingan.id_bimbingan 
				LIMIT 1
			", [$id, $id, $status]);
		} else if ($type == 'JADWAL') {
			$q = $this->db->query("
				SELECT 
					bimbingan.*, 
					jadwal_bimbingan.*
				FROM 
					bimbingan 
				INNER JOIN jadwal_bimbingan 
					ON jadwal_bimbingan.id_bimbingan = bimbingan.id_bimbingan 
				WHERE 
					bimbingan.nis_siswa = ? 
					AND jadwal_bimbingan.nis_siswa = ?
			", [$id, $id]);
		}

		return $q;
	}

	public function getLastBimbinganBySiswa($nis)
	{
		$this->db->select('bimbingan.*, jadwal_bimbingan.tanggal_bimbingan');
		$this->db->from('bimbingan');
		$this->db->join('jadwal_bimbingan', 'jadwal_bimbingan.id_bimbingan = bimbingan.id_bimbingan', 'left');
		$this->db->where('bimbingan.nis_siswa', $nis);
		$this->db->order_by('bimbingan.create_date', 'DESC'); // Ambil yang terbaru berdasarkan create_date
		$this->db->order_by('bimbingan.kode_bimbingan', 'DESC'); // Tambahan jika ingin urutkan berdasarkan kode_bimbingan
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}


	public function getJadwalBimbinganById($bimbingan_id)
	{
		$this->db->select('bimbingan.*, jadwal_bimbingan.tanggal_bimbingan');
		$this->db->from('jadwal_bimbingan');
		$this->db->join('bimbingan', 'bimbingan.id_bimbingan = jadwal_bimbingan.id_jadwal_bimbingan', 'left');
		$this->db->where('jadwal_bimbingan.id_bimbingan', $bimbingan_id);
		$this->db->order_by('jadwal_bimbingan.tanggal_bimbingan', 'DESC'); // Ambil yang terbaru
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
			log_message('info', 'tidak ada data');
		} else {
			return null; // Jika tidak ada data
		}
	}

	public function getJadwalBimbinganById2($siswa_id)
	{
		$this->db->select('bimbingan.*, jadwal_bimbingan.tanggal_bimbingan');
		$this->db->from('jadwal_bimbingan');
		$this->db->join('bimbingan', 'bimbingan.id_bimbingan = jadwal_bimbingan.id_jadwal_bimbingan', 'left');
		$this->db->where('jadwal_bimbingan.nis_siswa', $siswa_id);
		$this->db->order_by('jadwal_bimbingan.tanggal_bimbingan', 'DESC'); // Ambil yang terbaru
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
			log_message('info', 'tidak ada data');
		} else {
			return null; // Jika tidak ada data
		}
	}

	public function expiredAllData()
	{
		$data = array(
			'status_bimbingan' => 'EXPIRED'
		);
		$this->db->where('status_bimbingan', 'AKTIF');
		$this->db->update('bimbingan', $data);
		echo "sukses";
	}
}
