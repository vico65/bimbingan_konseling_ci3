<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratController extends CI_Controller {

	public function cariSiswaForSurat()
	{
		$data['nis_siswa']=$this->input->post('nis_siswa');
		$data['query']=$this->m_siswa->cariSiswaForSurat($data['nis_siswa']);

		$cek_siswa=$data['query']->num_rows();
		if ($cek_siswa>0) {
			$this->load->view('adminbk/pencarian-data-for-surat',$data);
		} else {
			echo "<center><i class='fa fa-search'></i> Tidak ditemukan data siswa dengan NIS '".$data['nis_siswa']."'' </center>";
		}
	}
}
