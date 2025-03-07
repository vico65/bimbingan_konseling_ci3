<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasController extends CI_Controller {

	public function aksiTambahKelas()
	{
		$kelas=$this->input->post('kelas');

		$this->m_kelas->AksiTambahKelas($kelas);
	}

	public function HapusKelas()
	{
		$id=$this->input->post('id_kelas');
		$this->m_kelas->HapusKelas($id);
	}

	public function GetDataKelas()
	{
		$id=$this->input->post('id_kelas');
		$this->m_kelas->GetDataKelas2($id);
	}

	public function aksiUpdateKelas()
	{
		$id=$this->input->post('id_kelas');
		$kelas=$this->input->post('nama_kelas');
		
		$this->m_kelas->aksiUpdateKelas($id,$kelas);
	}

	public function getStudentsByKelas() {
		$id_kelas = $this->input->post('id_kelas'); // Mengambil data id_kelas dari POST
		$data = $this->m_kelas->getStudentsByKelas($id_kelas); // Memanggil fungsi di model
		echo json_encode($data); // Mengembalikan data dalam format JSON
	}
	
	

}
