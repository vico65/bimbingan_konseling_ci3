<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model{

	public function getDaftarKelas(){
		$query=$this->db->query("SELECT * FROM kelas");
		return $query;
	}

    //query untuk menampilkan semua data peanggaran

	public function get_all_kelas() {
        $this->db->select('id_kelas, nama_kelas');
        $this->db->from('kelas');
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }

	public function getDataKelas(){
		$q=$this->db->query("SELECT * FROM kelas order by nama_Kelas asc");
		return $q;
	}	
	
	public function AksiTambahKelas($kelas){
		$data=array( 
			'nama_kelas' => $kelas
		);
		$this->db->insert('kelas',$data);
		echo "sukses";
	}

	public function HapusKelas($id){
		$q=$this->db->query('DELETE FROM kelas WHERE id_kelas ='.$id);
		return $q;
	}

	public function aksiUpdateKelas($id,$kelas){
		$data=array( 
			'nama_kelas' => $kelas, 
		);
		$this->db->where('id_kelas',$id);
		$this->db->update('kelas',$data);
		echo "sukses";	
	}

	public function GetDataKelas2($id){
		$q=$this->db->query('SELECT * FROM kelas WHERE id_kelas ='.$id)->row();
		echo json_encode(array('id_kelas'=> $q->id_kelas, 'nama_kelas'=> $q->nama_kelas ));
	}

	

	public function getStudentsByKelas($id_kelas) {
		$this->db->select('nis_siswa, nama_siswa, kelas, alamat_siswa, jenis_kelamin, tanggal_lahir, no_telephone_siswa, poin_siswa '); // Sesuaikan kolom yang diperlukan
		$this->db->from('siswa'); // Ganti dengan nama tabel siswa yang sebenarnya
		$this->db->where('kelas', $id_kelas); // Menggunakan kolom kelas yang sesuai dengan id_kelas
		$query = $this->db->get();
		return $query->result_array(); // Mengembalikan hasil sebagai array
	}
	
	
	
}

?>