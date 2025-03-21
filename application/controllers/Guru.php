<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}

	public function GuruRoute(){
		$d['page']=$this->uri->segment(1);
		$d['content']='guru/'.$d['page'];
		$this->load->view('home',$d);
	}

	// public function cariSiswa(){
	// 	$data['nama_siswa']=$this->input->post('nama');
	// 	$data['query']=$this->m_siswa->cariSiswa($data['nama_siswa']);

	// 	$cek_siswa=$data['query']->num_rows();
	// 	if ($cek_siswa>0) {
	// 		$this->load->view('guru/tabel-pencarian-siswa',$data);

	// 	} else {
	// 		echo "<center><i class='fa fa-search'></i> Tidak ditemukan data siswa dengan nama '".$data['nama_siswa']."'' </center>";
	// 	}

	// }

	public function cariSiswa() {
		// Mendapatkan input nama siswa dari form
		$data['nama_siswa'] = $this->input->post('nama');

		$data['query'] = $data['query'] = $this->m_siswa->cariSiswaByNis($data['nama_siswa']);

		
		// Memeriksa apakah data siswa ditemukan
		$cek_siswa = $data['query']->num_rows(); // Menggunakan num_rows() untuk menghitung jumlah baris
		if ($cek_siswa > 0) {
			// Jika siswa ditemukan, load view untuk menampilkan tabel pencarian
			$this->load->view('guru/tabel-pencarian-siswa', $data);
		} else {
			// Jika tidak ditemukan, tampilkan pesan tidak ada data
			echo "<center><i class='fa fa-search'></i> Tidak ditemukan data siswa atau nim '".$data['nama_siswa']."'</center>";
		}
	}
	
	

	public function TambahLaporanPelanggaran(){
		$nis=$this->input->post('nis');
		$deskripsi=$this->input->post('deskripsi_pelanggaran');

		$this->m_laporan->TambahLaporanPelanggaran($nis,$deskripsi);
	}
}
