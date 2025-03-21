<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BimbinganController extends CI_Controller {

	public function index() {
		$this->load->model('M_bimbingan');
	
		// Ambil daftar tahun ajaran dari database
		$data['tahun_ajaran_list'] = $this->M_bimbingan->getTahunAjaran();
	
		// Ambil tahun ajaran dari input form (jika ada)
		$tahun_akademik = $this->input->get('tahun_ajaran');
	
		// Ambil data bimbingan berdasarkan tahun ajaran yang dipilih
		$data['bimbingan'] = $this->M_bimbingan->getDataBimbinganOrderById($tahun_akademik);
	
		// Kirim tahun ajaran yang dipilih ke tampilan
		$data['tahun_ajaran_terpilih'] = $tahun_akademik;
	
		// Tampilkan halaman daftar bimbingan
		$data['page'] = 'daftar_bimbingan';
		$data['content'] = 'adminbk/' . $data['page'];
	
		$this->load->view('home', $data);
	}
	
	

	public function validasiBimbingan()
	{
		$id=$this->input->post('id_jadwal');
		$this->m_bimbingan->validasiKehadiranBimbingan($id);
	}

	public function NonAktifkanBimbingan()
	{
		$id=$this->input->post('id');
		$this->m_bimbingan->expiredBimbingan($id);
	}

	public function PembatalanLaporan()
	{
		$id=$this->input->post('id_laporan');
		$this->m_bimbingan->tolakLaporan($id);
	}
}
