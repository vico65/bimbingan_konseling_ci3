<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuruController extends CI_Controller {


	public function aksiTambahGuru()
	{

		$nip_nuptk=$this->input->post('nip_nuptk');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jabatan=$this->input->post('jabatan');
		$jk=$this->input->post('jk');
		$notlp=$this->input->post('notlp');
		$username=$this->input->post('username');
		$pass=$this->input->post('pass');
		$level=$this->input->post('level');

		if($this->m_guru->GetDataGuruForInsert($nip_nuptk)) {
			echo json_encode(array('status' => 'failed', 'message' => 'Data guru dengan nip/nuptk ' . $nip_nuptk . ' telah ada di database!'));
			return;
		};


		$this->m_guru->AksiTambahGuru($nama,$nip_nuptk,$alamat,$jk,$notlp,$username,$pass, $jabatan,$level);
		echo json_encode(array('status' => 'success', 'message' => 'Data guru dengan nip/nuptk ' . $nip_nuptk . ' telah ditambahkan!'));
	}

	public function hapusGuru()
	{
		$nip_nuptk=$this->input->post('nip_nuptk');
		$this->m_guru->AksiHapusGuru($nip_nuptk);
	}

	public function getDataUpdate()
	{
		$nip_nuptk=$this->input->post('nip_nuptk');
		$this->m_guru->GetDataGuru($nip_nuptk);
	}

	public function aksiUpdateGuru()
	{
		$nip_nuptk=$this->input->post('nip_nuptk');
		$jabatan=$this->input->post('jabatan');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jk=$this->input->post('jk');
		$notlp=$this->input->post('notlp');
		$username=$this->input->post('username');
		$pass=$this->input->post('pass');

		$this->m_guru->aksiUpdateGuru($nip_nuptk,$nama,$alamat,$jk,$notlp,$username,$pass, $jabatan);

		echo 'sukses';
	}
}
