<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_sms extends CI_Controller {

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
		$this->load->view('login');
	}

	public function SendSMS(){
			// DEVELOPER MDOE
			//$no_tlp='6289661348416';         
			//$pesan	='test sms gateway api!';
			$no_tlp=$this->input->post('no_hp');
			$pesan=$this->input->post('pesan');
			//API URL
			$url = 'https://rest.nexmo.com/sms/json';
			//create a new cURL resource
			$ch = curl_init(); // Initiate cURL
		   	curl_setopt($ch, CURLOPT_URL,$url);
		   	curl_setopt($ch, CURLOPT_POST, true);// Tell cURL you want to post something
		   	curl_setopt($ch, CURLOPT_POSTFIELDS, "api_key=a58f46f0 &api_secret=PWOzJhamAcfIFhS3&to=".$no_tlp." &from=BK TJ&text=".$pesan); // Define what you want to post
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
		    $output = curl_exec ($ch); // Execute
		    echo $output;
	
	}	
}
