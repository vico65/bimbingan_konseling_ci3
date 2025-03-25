<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Murid extends CI_Controller {
	public function index()
	{
		$this->load->view('home');
	}

	public function MuridRoute(){
		$d['page']=$this->uri->segment(1);
		$d['content']='murid/'.$d['page'];
		$this->load->view('home',$d);
	}
}
