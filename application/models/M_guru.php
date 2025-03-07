<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model{

    public function gedDataGuru(){
		$query=$this->db->query("SELECT * FROM guru");
		return $query;
	}

    //query CRUD guru
	public function AksiTambahGuru($nama,$nip,$alamat,$jk,$notlp,$username,$pass,$jabatan, $level){
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
		echo "sukses";
	}

	public function AksiHapusGuru($id){
		$q=$this->db->query('DELETE FROM guru WHERE id_guru ='.$id);
		return $q;
		echo "sukses";
	}	

	public function GetDataGuru($id){
		$q=$this->db->query('SELECT * FROM guru WHERE id_guru ='.$id)->row();
		echo json_encode(array('id'=>$q->id_guru,'nip' => $q->nip_nuptk,'jabatan' => $q->jabatan,'nama' => $q->nama_guru,'alamat_guru'=> $q->alamat_guru,'jk'=>$q->jenis_kelamin,'hp'=>$q->no_telephone_guru,'username'=>$q->username_guru,'password'=>$q->password_guru));
	}

	public function aksiUpdateGuru($id,$nip,$nama,$alamat,$jk,$notlp,$username,$pass,$jabatan){
		$data=array( 
			'nip_nuptk' => $nip, 
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
		$this->db->where('id_guru',$id);
		$this->db->update('guru',$data);
		echo "sukses";	
	}

}
?>