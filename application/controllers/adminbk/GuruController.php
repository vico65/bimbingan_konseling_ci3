<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuruController extends CI_Controller {


	public function aksiTambahGuru()
	{
		$nip=$this->input->post('nip_nuptk');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jabatan=$this->input->post('jabatan');
		$jk=$this->input->post('jk');
		$notlp=$this->input->post('notlp');
		$username=$this->input->post('username');
		$pass=$this->input->post('pass');
		$level=$this->input->post('level');


		$this->m_guru->AksiTambahGuru($nama,$nip,$alamat,$jk,$notlp,$username,$pass, $jabatan,$level);
	}

	public function hapusGuru()
	{
		$id=$this->input->post('id_guru');
		$this->m_guru->AksiHapusGuru($id);
	}

	public function getDataUpdate()
	{
		$id=$this->input->post('id_guru');
		$this->m_guru->GetDataGuru($id);
	}

	public function aksiUpdateGuru()
	{
		$id=$this->input->post('id_guru');
		$nip=$this->input->post('nip_nuptk');
		$jabatan=$this->input->post('jabatan');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jk=$this->input->post('jk');
		$notlp=$this->input->post('notlp');
		$username=$this->input->post('username');
		$pass=$this->input->post('pass');

		$this->m_guru->aksiUpdateGuru($id,$nip,$nama,$alamat,$jk,$notlp,$username,$pass, $jabatan);
	}
}
