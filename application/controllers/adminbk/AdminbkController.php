<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminbkController extends CI_Controller {

	public function index()
	{
		$this->load->view('adminbk/beranda');
	}

	public function adminbkRoute()
	{
		$d['page']=$this->uri->segment(1);
		$d['content']='adminbk/'.$d['page'];
		$this->load->view('home',$d);
	}
}
