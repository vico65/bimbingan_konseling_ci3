<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model{

    public function gedDataGuru(){
		$query=$this->db->query("SELECT * FROM guru");
		return $query;
	}

    //query CRUD guru
	public function AksiTambahGuru($nama,$nip,$alamat,$jk,$notlp,$username,$pass,$jabatan){
		$data=array( 
			'nip_nuptk' => $nip, 
			'nama_guru' => $nama, 
			'alamat_guru' => $alamat, 
			'jenis_kelamin' => $jk, 
			'jabatan' => $jabatan,
			'no_telephone_guru' => $notlp,
			'username_guru' => $username,
			'password_guru' => $pass,
			'create_who'=> $this->session->userdata('username'),
			'create_date'=> date('Y-m-d H:i:s')
		);
		$this->db->insert('guru',$data);
		return true;
	}

	public function AksiHapusGuru($nip_nuptk){
		$q=$this->db->query('DELETE FROM guru WHERE nip_nuptk ='.$nip_nuptk);
		return $q;
	}	

	public function GetDataGuru($nip_nuptk){
		$q=$this->db->query('SELECT * FROM guru WHERE nip_nuptk ='.$nip_nuptk)->row();

		if(!$q) {
			return false;
		}
		
		echo json_encode(array('nip' => $q->nip_nuptk,'jabatan' => $q->jabatan,'nama' => $q->nama_guru,'alamat_guru'=> $q->alamat_guru,'jk'=>$q->jenis_kelamin,'hp'=>$q->no_telephone_guru,'username'=>$q->username_guru,'password'=>$q->password_guru));
	}

	public function GetDataGuruForInsert($nip_nuptk){
		$this->db->where('nip_nuptk', $nip_nuptk);
		$q = $this->db->get('guru');
		
		if ($q->num_rows() > 0) {
			return $q->row_array(); // Mengembalikan data siswa dengan nama kelas
		} else {
			return false; // Jika tidak ada siswa ditemukan
		}
	}



	public function aksiUpdateGuru($nip_nuptk,$nama,$alamat,$jk,$notlp,$username,$pass,$jabatan){
		$data=array( 
			'jabatan' => $jabatan, 
			'nama_guru' => $nama, 
			'alamat_guru' => $alamat, 
			'jenis_kelamin' => $jk, 
			'no_telephone_guru' => $notlp,
			'username_guru' => $username,
			'password_guru' => $pass,
			'create_who'=> $this->session->userdata('username'),
			'create_date'=> date('Y-m-d H:i:s')
		);
		$this->db->where('nip_nuptk',$nip_nuptk);
		$this->db->update('guru',$data);

		return $nip_nuptk;
	}

}
?>