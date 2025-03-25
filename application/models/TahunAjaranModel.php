<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TahunAjaranModel extends CI_Model
{
    private $table = 'tahun_akademik';

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function getTahunAjaranAktif()
    {
        return $this->db->get_where('tahun_akademik', ['status_akademik' => 'aktif'])->row_array();
    }

    public function setTahunAjaranAktif($id_tahun)
    {
        // Reset semua tahun ajaran menjadi nonaktif
        $this->db->update('tahun_akademik', ['status_akademik' => 'nonaktif']);

        // Set tahun ajaran yang dipilih menjadi aktif
        $this->db->where('id_tahun_akademik', $id_tahun);
        $this->db->update('tahun_akademik', ['status_akademik' => 'aktif']);
    }

    public function getTahunAjaran()
    {
        return $this->db->get('tahun_akademik')->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_tahun_akademik', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_tahun_akademik' => $id]);
    }

    public function resetPoinSiswa()
    {
        $this->db->set('poin_siswa', 0);
        $this->db->update('siswa');
        return true;
    }
}
