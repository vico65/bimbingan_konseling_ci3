<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminbk extends CI_Controller {

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
		$this->load->view('adminbk/beranda');
	}

	public function adminbkRoute(){
		$d['page']=$this->uri->segment(1);
		$d['content']='adminbk/'.$d['page'];
		$this->load->view('home',$d);

	}

	public function PemberianPointSiswa(){
		$nis=$this->input->post('nis');
		$poin=$this->input->post('total_point');
		$id_laporan=$this->input->post('id_laporan');

		$this->model_global->insertPoinSiswa($nis,$poin,$id_laporan);
	}

	public function validasiBimbingan(){
		$id=$this->input->post('id_jadwal');
		$this->model_global->validasiKehadiranBimbingan($id);
	}

	public function aksiTambahGuru(){
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jk=$this->input->post('jk');
		$notlp=$this->input->post('notlp');
		$username=$this->input->post('username');
		$pass=$this->input->post('pass');

		$this->model_global->AksiTambahGuru($nama,$alamat,$jk,$notlp,$username,$pass);
	}

	public function hapusGuru(){
		$id=$this->input->post('id_guru');
		$this->model_global->AksiHapusGuru($id);
	}

	public function getDataUpdate() {
		$id=$this->input->post('id_guru');
		$this->model_global->GetDataGuru($id);
	}

	public function aksiUpdateGuru(){
		$id=$this->input->post('id_guru');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jk=$this->input->post('jk');
		$notlp=$this->input->post('notlp');
		$username=$this->input->post('username');
		$pass=$this->input->post('pass');

		$this->model_global->aksiUpdateGuru($id,$nama,$alamat,$jk,$notlp,$username,$pass);
	}


	public function aksiTambahSiswa(){
		$nis=$this->input->post('nis');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jk=$this->input->post('jk');
		$kelas=$this->input->post('kelas');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$tlp=$this->input->post('tlp');
		//data wali
		$data_wali['nama_wali']=$this->input->post('nama_wali');
		$data_wali['alamat_wali']=$this->input->post('alamat_wali');
		$data_wali['nohp_wali']=$this->input->post('no_hp_wali');

		$this->model_global->AksiTambahSiswa($nis,$nama,$alamat,$jk,$kelas,$tgl_lahir,$tlp,$data_wali);
	}

	public function HapusSiswa(){
		$id=$this->input->post('id_siswa');
		$this->model_global->AksiHapusSiswa($id);
	}

	public function GetDatasiswa() {
		$id=$this->input->post('id');
		$this->model_global->GetDatasiswa($id);
	}

	public function aksiUpdateSiswa(){
		$id_siswa=$this->input->post('id_siswa');
		$nis=$this->input->post('nis');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$jk=$this->input->post('jk');
		$kelas=$this->input->post('kelas');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$tlp=$this->input->post('tlp');

		$this->model_global->aksiUpdateSiswa($id_siswa,$nis,$nama,$alamat,$jk,$kelas,$tgl_lahir,$tlp);
	}

	public function aksiTambahPeanggaran(){
		$jenis=$this->input->post('jenis_insert');
		$poin=$this->input->post('poin_insert');
		$sanksi=$this->input->post('sanksi_insert');

		$this->model_global->AksiTambahPelanggaran($jenis,$poin,$sanksi);
	}

	public function HapusPelanggaran(){
		$id=$this->input->post('id');
		$this->model_global->HapusPelanggaran($id);
	}

	public function GetDataPelanggaran() {
		$id=$this->input->post('id');
		$this->model_global->GetDataPelanggaran2($id);
	}

	public function aksiUpdatePelanggaran(){
		$id=$this->input->post('id');
		$jenis=$this->input->post('jenis_update');
		$poin=$this->input->post('poin_update');
		$sanksi=$this->input->post('sanksi_update');

		$this->model_global->aksiUpdatePelanggaran($id,$jenis,$poin,$sanksi);
	}	

	// public function aksiUpdatePelanggaran(){
	// 	$id=$this->input->post('id');
	// 	$jenis=$this->input->post('jenis_update');
	// 	$poin=$this->input->post('poin_update');
	// 	$sanksi=$this->input->post('sanksi_update');

	// 	$this->model_global->aksiUpdatePelanggaran($id,$jenis,$poin,$sanksi);
	// }

	public function NonAktifkanBimbingan(){
		$id=$this->input->post('id');
		$this->model_global->expiredBimbingan($id);
	}

	public function PembatalanLaporan(){
		$id=$this->input->post('id_laporan');
		$this->model_global->tolakLaporan($id);
	}

	public function cariSiswaForSMS(){
		$data['nis_siswa']=$this->input->post('nis_siswa');
		$data['query']=$this->model_global->cariSiswaForSMS($data['nis_siswa']);

		$cek_siswa=$data['query']->num_rows();
		if ($cek_siswa>0) {
			$this->load->view('adminbk/pencarian-data-for-sms',$data);

		} else {
			echo "<center><i class='fa fa-search'></i> Tidak ditemukan data siswa dengan NIS '".$data['nis_siswa']."'' </center>";
		}

	}

}
