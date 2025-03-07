<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kepsek extends CI_Controller {

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

	public function kepsekRoute(){

		$d['page']=$this->uri->segment(1);

		if($this->session->userdata('level_akses') == 'kepsek') {
			$d['content']='kepala_sekolah/'.$d['page'];
		} else if($this->session->userdata('level_akses') == 'wali_murid') {
			$d['content']='wali_murid/'.$d['page'];
		}
		
		
		$this->load->view('home',$d);
	}
}
