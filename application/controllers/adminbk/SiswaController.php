<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiswaController extends CI_Controller {

	public function aksiTambahSiswa()
	{
		// Ambil data dari form
		$nis = $this->input->post('nis');
		$nama = $this->input->post('nama_siswa');
		$alamat = $this->input->post('alamat_siswa');
		$jk = $this->input->post('jenis_kelamin');
		$kelas = $this->input->post('kelas');
		$tgl_lahir = $this->input->post('tanggal_lahir');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tlp = $this->input->post('no_telephone_siswa');
		$status_pengasuh = $this->input->post('status_pengasuh');

		if($this->m_siswa->getSiswaById($nis)) {
			echo json_encode(array('status' => 'failed', 'message' => 'Data siswa dengan nis ' . $nis . ' telah ada di database!'));
			return;
		};
		

		// Data siswa
		$data_siswa = array(
			'nis_siswa' => $nis,
			'nama_siswa' => $nama,
			'kelas' => $kelas,
			'alamat_siswa' => $alamat,
			'jenis_kelamin' => $jk,
			'tanggal_lahir' => $tgl_lahir,
			'tempat_lahir' => $tempat_lahir,
			'no_telephone_siswa' => $tlp,
			'status_pengasuh' => $status_pengasuh,
			'username_siswa' => $nis,
			'password_siswa' => $nis
		);

		// Data wali siswa
		$data_wali = array( 
			'nis_siswa' => $nis,
			'nama_wali_siswa' => $this->input->post('nama_wali_siswa'),
			'pekerjaan_wali_siswa' => $this->input->post('pekerjaan_wali'),
			'alamat_wali_siswa' => $this->input->post('alamat_wali_siswa'),
			'no_telephone_wali_siswa' => $this->input->post('no_telp_wali'),
			'username_wali_siswa' => $nis,
			'password_wali_siswa' => 'wali' . $nis,
		);

		// Menyimpan data siswa dan wali
		$this->m_siswa->AksiTambahSiswa($data_siswa, $data_wali);

		// Mengirimkan response JSON
		echo json_encode(array('status' => 'success', 'message' => 'Data siswa dan wali siswa berhasil ditambahkan!'));
		
	}

	public function HapusSiswa()
	{
		$nis=$this->input->post('nis_siswa');
		$this->m_siswa->AksiHapusSiswa($nis);

		echo json_encode(array('status' => 'success', 'message' => 'Data siswa berhasil dihapus!'));
	}

	public function GetDatasiswa()
	{
		$nis=$this->input->post('nis');
		$this->m_siswa->GetDatasiswa($nis);
	}

	public function aksiUpdateSiswa()
	{
		$nis = $this->input->post('nis');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$kelas = $this->input->post('kelas');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tlp = $this->input->post('tlp');
		$status_pengasuh = $this->input->post('status_pengasuh');

		// Panggil model untuk melakukan update data siswa
		$this->m_siswa->aksiUpdateSiswa($nis, $nama, $alamat, $jk, $kelas, $tempat_lahir, $tgl_lahir, $tlp, $status_pengasuh);
	}

}
