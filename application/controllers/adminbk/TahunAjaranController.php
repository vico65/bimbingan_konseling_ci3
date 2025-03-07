<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahunAjaranController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TahunAjaranModel');
    }

    public function index() {
        $d['tahun_akademik'] = $this->TahunAjaranModel->getAll();
        $d['page']=$this->uri->segment(1);
		$d['content']='adminbk/'.$d['page'];
		$this->load->view('home',$d);
        // $this->load->view('adminbk/tahun_ajaran', $data);
    }

    public function setAktif($id_tahun) {
        $this->TahunAjaranModel->setTahunAjaranAktif($id_tahun);
        redirect($_SERVER['HTTP_REFERER']); // Kembali ke halaman sebelumnya
    }

    public function store() {
        $tahun = $this->input->post('tahun');
        $this->TahunAjaranModel->insert(['tahun_akademik' => $tahun]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update() {
        $id = $this->input->post('id_tahun');
        $tahun = $this->input->post('tahun');
        $this->TahunAjaranModel->update($id, ['tahun_akademik' => $tahun]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id) {
        $this->TahunAjaranModel->delete($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function resetPoin() {
        // Pastikan hanya tahun ajaran aktif yang bisa melakukan reset
        $this->load->model('TahunAjaranModel');
        $this->load->model('M_bimbingan');

        $tahun_aktif = $this->TahunAjaranModel->getTahunAjaranAktif();
        
        if (!$tahun_aktif) {
            $this->session->set_flashdata('error', 'Tidak ada tahun ajaran yang aktif.');
            redirect('adminbk/tahunajaran');
        }
    
        // Panggil model untuk reset poin siswa
        if ($this->TahunAjaranModel->resetPoinSiswa()) {
            $this->M_bimbingan->expiredAllData();
            $this->session->set_flashdata('success', 'Semua poin siswa telah direset.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mereset poin siswa.');
        }
    
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
}
