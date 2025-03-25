<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kepsek extends CI_Controller {
	public function index()
	{
		$this->load->view('home');
	}

	public function kepsekRoute(){

		$d['page']=$this->uri->segment(1);

		$isLevelAccessIsKepsek =  $this->session->userdata('level_akses') == 'kepsek';
		$d['content'] = $isLevelAccessIsKepsek ? 'kepala_sekolah/'.$d['page'] : 'wali_murid/'.$d['page'];
		
		$this->load->view('home',$d);
	}
}
