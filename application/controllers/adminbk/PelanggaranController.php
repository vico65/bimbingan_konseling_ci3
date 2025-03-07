<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelanggaranController extends CI_Controller {

	public function aksiTambahPelanggaran()
	{
		$kode=$this->input->post('kode');
		$jenis=$this->input->post('jenis');
		$poin=$this->input->post('poin');
		$sanksi=$this->input->post('sanksi');

		$this->m_pelanggaran->AksiTambahPelanggaran($kode,$jenis,$poin,$sanksi);
	}

	public function HapusPelanggaran()
	{
		$id=$this->input->post('id');
		$this->m_pelanggaran->HapusPelanggaran($id);
	}

	public function GetDataPelanggaran()
	{
		$id=$this->input->post('id');
		$this->m_pelanggaran->GetDataPelanggaran2($id);
	}

	public function aksiUpdatePelanggaran()
	{
		$id=$this->input->post('id');
		$kode=$this->input->post('kode_update');
		$jenis=$this->input->post('jenis_update');
		$poin=$this->input->post('poin_update');
		$sanksi=$this->input->post('sanksi_update');


		$this->m_pelanggaran->aksiUpdatePelanggaran($id,$kode,$jenis,$poin,$sanksi);
	}
}
