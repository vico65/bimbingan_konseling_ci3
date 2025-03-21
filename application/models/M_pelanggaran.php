<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggaran extends CI_Model{

    public function getDaftarPelanggaran(){
		$query=$this->db->query("SELECT * FROM pelanggaran");
		return $query;
	}


	public function GetDataPelanggaran2($id){
		$q=$this->db->query('SELECT * FROM pelanggaran WHERE id_pelanggaran ='.$id)->row();
		echo json_encode(array('id'=> $q->id_pelanggaran, 'kode_pelanggaran'=> $q->kode_pelanggaran,'jenis' => $q->jenis_pelanggaran,'poin'=> $q->poin_pelanggaran,'sanksi' => $q->sanksi_pelanggaran));
	}

	public function GetDataPelanggaranForInsertPoin($id){
		$this->db->select('*');
		$this->db->from('pelanggaran');
		$this->db->where('id_pelanggaran', $id);
		return $this->db->get()->row_array();
	}

	public function getDataPelanggaran(){
		// $q=$this->db->query("SELECT * FROM pelanggaran order by CAST( poin_pelanggaran AS INT) asc");/
		$q=$this->db->query("SELECT * FROM pelanggaran order by kode_pelanggaran asc");
		return $q;
	}	

	public function AksiTambahPelanggaran($kode,$jenis,$poin,$sanksi){
		$data=array( 
			'kode_pelanggaran' => $kode, 
			'jenis_pelanggaran' => $jenis, 
			'poin_pelanggaran' => $poin, 
			'sanksi_pelanggaran' => $sanksi,

		);
		$this->db->insert('pelanggaran',$data);
		echo "sukses";
	}

	public function HapusPelanggaran($id){
		$q=$this->db->query('DELETE FROM pelanggaran WHERE id_pelanggaran ='.$id);
		return $q;
	}

	public function aksiUpdatePelanggaran($id,$kode,$jenis,$poin,$sanksi){
		$data=array( 
			'id_pelanggaran' => $id, 
			'kode_pelanggaran' => $kode, 
			'jenis_pelanggaran' => $jenis, 
			'poin_pelanggaran' => $poin, 
			'sanksi_pelanggaran' => $sanksi,
			
			// 'create_who' => $this->session->userdata('username'),
			// 'create_date' => date('Y-m-d H:i:s')
		);
		$this->db->where('id_pelanggaran',$id);
		$this->db->update('pelanggaran',$data);
		echo "sukses";	
	}

}

?>