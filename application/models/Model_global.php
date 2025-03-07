<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_global extends CI_Model{

	public function data_value($type,$jenis=''){
		$q=$this->db->query("SELECT * FROM data_value WHERE type_value='$type'  AND active_flag='Y'");
		return $q;
	}		

	public function detectUserType($usr, $pwd) {
		$tables = [
			['table' => 'guru', 'username' => 'username_guru', 'password' => 'password_guru', 'id' => 'id_guru', 'name' => 'nama_guru'],
			['table' => 'siswa', 'username' => 'username_siswa', 'password' => 'password_siswa', 'id' => 'nis_siswa', 'name' => 'nama_siswa'],
			['table' => 'wali_siswa', 'username' => 'username_wali_siswa', 'password' => 'password_wali_siswa', 'id' => 'id_wali', 'name' => 'nama_wali_siswa'],
		];

		$jabatan = 'jabatan';
	
		foreach ($tables as $table) {
			$query = $this->db->query("SELECT * FROM {$table['table']} WHERE {$table['username']} = '$usr' AND {$table['password']} = '$pwd'");
	
			if ($query->num_rows() > 0) {
				$row = $query->row();

				if($table['table'] == 'guru') {
					if($row->{'jabatan'} == 'Guru BK') {
						$level_akses = 'adminbk';
					} else if($row->{'jabatan'} == 'Kepala Sekolah') {
						$level_akses = 'kepsek';
					} else {
						$level_akses = 'guru';
					}
				} else if ($table['table'] == 'siswa') {
					$level_akses = 'murid';
				} else if ($table['table'] == 'wali_siswa') {
					$level_akses = 'wali_murid';
				}
	
				// Set session
				$add_session = [
					'username' => $row->{$table['username']},
					'level_akses' => $level_akses,
					'nama' => $row->{$table['name']},
					'id' => $row->{$table['id']},
					'islogin' => 'yes',
				];
	
				$this->session->set_userdata($add_session);
				return true;
			}
		}
		return false;
	}
	
	public function GetloginData($usr,$pwd,$type){
		//deklarasi variabel untuk session
		$username='null';
		$level_akses='null';
		$nama='null';
		$isLogin='no';
		$id='null';

		//query login sesuai level akses

		//jika level akses admin
		if ($type=='adminbk') {

			$query_login=$this->db->query("SELECT * FROM guru WHERE level_akses='adminbk' AND username_guru='$usr' AND password_guru='$pwd'");
			if ($query_login->num_rows()>0) {

				$row=$query_login->row();
				$username=$row->username_guru;
				$level_akses=$row->level_akses;
				$nama=$row->nama_guru;
				$id=$row->id_guru;
				$isLogin='yes';

				echo json_encode(array("status"=>"valid","value"=>base_url()."beranda"));
			} else {
				echo json_encode(array("status"=>"invalid","pesan"=>"Username Atau Password Salah"));
			}

		//jika level akses guru
		} else if ($type=='guru') {

			$query_login=$this->db->query("SELECT * FROM guru WHERE level_akses='guru' AND username_guru='$usr' AND password_guru='$pwd'");
			if ($query_login->num_rows()>0) {
				
				$row=$query_login->row();
				$username=$row->username_guru;
				$level_akses=$row->level_akses;
				$nama=$row->nama_guru;
				$id=$row->id_guru;
				$isLogin='yes';

				echo json_encode(array("status"=>"valid","value"=>base_url()."beranda"));
			} else {
				echo json_encode(array("status"=>"invalid","pesan"=>"Username Atau Password Salah"));
			}

		//jika level akses murid
		} else if ($type=='murid') {

			$query_login=$this->db->query("SELECT * FROM siswa WHERE level_akses='murid' AND username_siswa='$usr' AND password_siswa='$pwd'");
			if ($query_login->num_rows()>0) {
				
				$row=$query_login->row();
				$username=$row->username;
				$level_akses=$row->level_akses;
				$nama=$row->nama_siswa;
				$id=$row->nis_siswa;
				$isLogin='yes';

				echo json_encode(array("status"=>"valid","value"=>base_url()."beranda"));
			} else {
				echo json_encode(array("status"=>"invalid","pesan"=>"Username Atau Password Salah"));
			}

		//jika level akses kepala sekolah
		} elseif ($type=='kepsek') {

			$query_login=$this->db->query("SELECT * FROM guru WHERE level_akses='kepsek' AND username_guru='$usr' AND password_guru='$pwd'");
			if ($query_login->num_rows()>0) {
				
				$row=$query_login->row();
				$username=$row->username_guru;
				$level_akses=$row->level_akses;
				$nama=$row->nama_guru;
				$id=$row->id_guru;
				$isLogin='yes';

				echo json_encode(array("status"=>"valid","value"=>base_url()."beranda"));
			} else {
				echo json_encode(array("status"=>"invalid","pesan"=>"Username Atau Password Salah"));
			}

		//jika level akses wali siswa	
		} elseif ($type=='wali_murid') {
			
			$query_login=$this->db->query("SELECT * FROM wali_siswa WHERE level_akses='wali_murid' AND username_ws='$usr' AND password_wali_siswa='$pwd'");
			if ($query_login->num_rows()>0) {
				
				$row=$query_login->row();
				$username=$row->username_ws;
				$level_akses=$row->level_akses;
				$nama=$row->nama_wali_siswa;
				$id=$row->id_wali;
				$isLogin='yes';

				echo json_encode(array("status"=>"valid","value"=>base_url()."beranda"));
			} else {
				echo json_encode(array("status"=>"invalid","pesan"=>"Username Atau Password Salah"));
			}

		}	

		// membuat session
		$add_session=array(
			'username' => $username, 
			'level_akses' => $level_akses, 
			'nama' => $nama, 
			'id' => $id, 
			'islogin' => $isLogin 
		);

		$this->session->set_userdata($add_session);

		return $query_login;


	}


	//query untuk menampilkan notifikasi sesuai type akses
	public function getNotifikasi($type_akses){
		if ($type_akses=='adminbk') {
			$whereStr=" laporan.read_status_admin='N' and laporan.status_validasi='B'";
		} 
		else if ($type_akses=='murid') {
			$whereStr=" laporan.read_status_siswa='N'";
		}
		else if ($type_akses=='wali_murid') {
			$whereStr=" laporan.read_status_wali='N'";
		}

		$q=$this->db->query("SELECT 
				laporan.*,
				guru.`nama_guru`,
				siswa.nama_siswa,kelas
				FROM laporan
				INNER JOIN guru ON guru.`id_guru`= laporan.`id_guru`
				INNER JOIN siswa ON siswa.`nis_siswa` = laporan.`nis_siswa`
				WHERE $whereStr
		");	

		return $q;

	}


	public function ReadedNotifikasi($id_laporan){
		//update laporan siswa sebagai tervalidasi
		$laporan=array(
			'status_validasi' => 'Y'
		);
		$this->db->where('id_laporan',$id_laporan);
		$this->db->update('laporan',$laporan);	
		echo "sukses";	
	}	


}
?>