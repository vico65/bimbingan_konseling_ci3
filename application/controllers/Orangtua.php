<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orangtua extends CI_Controller {
	public function index()
	{
		$this->load->view('home');
	}

	public function OrangtuaRoute(){
		$d['page']=$this->uri->segment(1);
		$d['content']='wali_murid/'.$d['page'];
		$this->load->view('home',$d);
	}
}
