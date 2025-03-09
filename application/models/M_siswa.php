<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa extends CI_Model
{

	//query untuk memfilter siswa
	public function cariDataSiswa($jenis, $parameter)
	{
		if ($jenis == 'nis') {
			$q = $this->db->zquery("SELECT * FROM siswa where nis_pelanggaran=" . $parameter);
		} elseif ($jenis == 'nama') {
			$q = $this->db->query("SELECT * FROM siswa where nama _siswa like '%" . $parameter . "%'");
		} else if ($jenis == 'kelas') {
			$q = $this->db->query("SELECT * FROM siswa where kelas='$parameter'");
		}

		return $q;
	}
	
	public function cariSiswa($nama)
	{
		// Query dengan JOIN untuk mendapatkan nama_kelas
		$this->db->select('siswa.*, kelas.nama_kelas');
		$this->db->from('siswa');
		$this->db->join('kelas', 'siswa.kelas = kelas.id_kelas'); // Join tabel kelas
		$this->db->like('siswa.nama_siswa', $nama); // Mencari berdasarkan nama siswa
		$query = $this->db->get();

		return $query; // Mengembalikan objek query
	}

	public function cariSiswaByNis($nis)
	{
		// Query dengan JOIN untuk mendapatkan nama_kelas
		$this->db->select('siswa.*, kelas.nama_kelas');
		$this->db->from('siswa');
		$this->db->join('kelas', 'siswa.kelas = kelas.id_kelas'); // Join tabel kelas
		$this->db->where('siswa.nis_siswa', $nis); // Mencari berdasarkan nama siswa
		$query = $this->db->get();

		return $query; // Mengembalikan objek query
	}


	public function cariSiswaForSurat($nis)
	{
		$q = $this->db->query("SELECT 
			siswa.`nis_siswa`,nama_siswa,
			wali_siswa.*
			FROM 
			siswa 
			INNER JOIN wali_siswa ON wali_siswa.`nis_siswa`=siswa.`nis_siswa`
			WHERE siswa.`nis_siswa`=" . $nis);
		return $q;
	}

	public function getSiswaById($nis_siswa)
	{
		$this->db->where('nis_siswa', $nis_siswa);
		$query = $this->db->get('siswa');

		if ($query->num_rows() > 0) {
			return $query->row_array(); // Mengembalikan data siswa sebagai array
		} else {
			return false; // Jika tidak ada siswa ditemukan
		}
	}

	public function getSiswaId($nis_siswa)
	{
		$this->db->select('siswa.*, kelas.nama_kelas');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left'); // JOIN dengan tabel kelas
		$this->db->where('siswa.nis_siswa', $nis_siswa);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row_array(); // Mengembalikan data siswa dengan nama kelas
		} else {
			return false; // Jika tidak ada siswa ditemukan
		}
	}

	public function getSiswaByWali()
	{
		// Ambil id_wali dari session
		$id_wali = $this->session->userdata('id');

		// Debug: Cek id_wali dari session
		if (!$id_wali) {
			return false; // Jika id_wali tidak ada di session
		}

		// Ambil NIS anak dari tabel wali_siswa berdasarkan id_wali
		$query_wali = $this->db->query("SELECT nis_siswa FROM wali_siswa WHERE id_wali = " . (int)$id_wali);

		// Debug: Cek hasil query wali_siswa
		if ($query_wali->num_rows() == 0) {
			return false; // Jika tidak ada data wali_siswa ditemukan
		}

		$nis_anak = $query_wali->row()->nis_siswa;

		// Query untuk mendapatkan data siswa berdasarkan NIS anak
		$this->db->select('siswa.*, kelas.nama_kelas');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->where('siswa.nis_siswa', $nis_anak);

		$query_siswa = $this->db->get();

		// Debug: Cek hasil query siswa
		if ($query_siswa->num_rows() > 0) {
			return $query_siswa->result_array(); // Mengembalikan array hasil query
		} else {
			return false; // Jika tidak ada data siswa ditemukan
		}
	}




	public function getSiswaDenganPoinDiAtas25()
	{
		$this->db->select('siswa.*, kelas.nama_kelas');
		$this->db->from('siswa');
		$this->db->join('kelas', 'siswa.kelas = kelas.id_kelas'); // Pastikan id_kelas ada di kedua tabel
		$this->db->where('siswa.poin_siswa >=', 25); // Tambahkan kondisi untuk poin > 25
		$query = $this->db->get();

		if (!$query) {
			// Jika query gagal, tampilkan pesan error
			return "kosong"; // Atau bisa mengembalikan array kosong
		}

		return $query->result_array(); // Mengembalikan hasil sebagai array
	}



	// public function getdaftarSiswa(){
	// 	$query=$this->db->query("SELECT * FROM siswa");
	// 	return $query;
	// }

	public function getdaftarSiswa()
	{
		$this->db->select('siswa.*, kelas.nama_kelas');
		$this->db->from('siswa');
		$this->db->join('kelas', 'siswa.kelas = kelas.id_kelas'); // Pastikan id_kelas ada di kedua tabel
		$query = $this->db->get();

		if (!$query) {
			// Jika query gagal, tampilkan pesan error
			return false; // Atau bisa mengembalikan array kosong
		}

		return $query->result_array(); // Mengembalikan hasil sebagai array
	}


	//query crud siswa
	public function AksiTambahSiswa($data_siswa, $data_wali)
	{

		// Insert data siswa
		$this->db->insert('siswa', $data_siswa);

		// Insert data wali
		$this->db->insert('wali_siswa', $data_wali);

		return true;
	}

	public function AksiHapusSiswa($nis)
	{
		$q = $this->db->query('DELETE FROM siswa WHERE nis_siswa =' . $nis);
		return $q;
		echo "sukses";
	}

	public function GetDatasiswa($nis)
	{
		$this->db->select('siswa.nis_siswa, siswa.nama_siswa, siswa.kelas as id_kelas, kelas.nama_kelas, 
						   siswa.alamat_siswa, siswa.jenis_kelamin, siswa.tanggal_lahir, siswa.tempat_lahir, 
							siswa.no_telephone_siswa, siswa.status_pengasuh');
		$this->db->from('siswa');
		$this->db->join('kelas', 'siswa.kelas = kelas.id_kelas', 'left'); // Join tabel kelas
		$this->db->where('siswa.nis_siswa', $nis);
		$q = $this->db->get()->row();

		if ($q) {
			echo json_encode(array(
				'nis' => $q->nis_siswa,
				'nama' => $q->nama_siswa,
				'id_kelas' => $q->id_kelas, // ID kelas
				'nama_kelas' => $q->nama_kelas, // Nama kelas
				'alamat' => $q->alamat_siswa,
				'jk' => $q->jenis_kelamin,
				'tgl_lahir' => $q->tanggal_lahir,
				'tempat_lahir' => $q->tempat_lahir,
				'hp' => $q->no_telephone_siswa,
				'status_pengasuh' => $q->status_pengasuh,
			));
		} else {
			echo json_encode(['error' => 'Data not found']);
		}
	}



	public function aksiUpdateSiswa($nis, $nama, $alamat, $jk, $kelas, $tempat_lahir, $tgl_lahir, $tlp, $status_pengasuh)
	{
		$data = array(
			'nama_siswa' => $nama,
			'kelas' => $kelas,
			'alamat_siswa' => $alamat,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tempat_lahir,  // Menambahkan tempat lahir
			'tanggal_lahir' => $tgl_lahir,
			'no_telephone_siswa' => $tlp,
			'status_pengasuh' => $status_pengasuh,  // Menambahkan jenis tinggal
		);

		// Update data siswa berdasarkan ID
		$this->db->where('nis_siswa', $nis);
		$this->db->update('siswa', $data);

		// Response sukses jika berhasil
		echo "sukses";
	}
}
