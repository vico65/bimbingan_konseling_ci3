<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {


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
		// if(!$this->session->userdata('level_akses')) {
		$this->load->view('login');
		// } else {
		// 	$this->beranda();
		// }
		
	}

	

	public function AksiLogin() {
		$usr = $this->db->escape_like_str($this->input->post('username'));
		$pwd = $this->db->escape_like_str($this->input->post('password'));
	
		// Panggil model untuk mendeteksi akun
		$result = $this->model_global->detectUserType($usr, $pwd);
	
		if ($result) {
			echo json_encode(["status" => "valid", "value" => base_url() . "beranda"]);
		} else {
			echo json_encode(["status" => "invalid", "pesan" => "Username atau Password Salah"]);
		}
	}
	

	public function beranda(){	
		// if(!$this->session->userdata('islogin')){
			//redirect('asasas','refresh');
		// } else {
			$type_akses=$this->session->userdata('level_akses');
			if ($type_akses=='adminbk') {
				$d['content']='adminbk/beranda';
			} elseif ($type_akses=='guru') {
				$d['content']='guru/beranda';
			} elseif ($type_akses=='murid') {
				$d['content']='murid/beranda';
			} elseif ($type_akses=='kepsek') {
				$d['content']='kepala_sekolah/beranda';
			} elseif ($type_akses=='wali_murid') {
				$d['content']='wali_murid/beranda';
			} else {
				$d['content']='404';
			}
			
			$this->load->view('home',$d);
		//}	
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->index();
	}	

	public function enkripsi(){
		$this->model_mcrypt->encrypt('login');
		// $this->model_mcrypt->decrypt('');
	}
}
