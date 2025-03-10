<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanController extends CI_Controller {

    // public function PemberianPointSiswa(){
	// 	$nis=$this->input->post('nis');
	// 	$poin=$this->input->post('total_point');
	// 	$id_laporan=$this->input->post('id_laporan');

	// 	$this->m_laporan->insertPoinSiswa($nis,$poin,$id_laporan);
	// }

    public function histori_laporan() {
        $this->load->model('m_laporan');
        $this->load->model('TahunAjaranModel'); // Model untuk mengambil daftar tahun ajaran
    
        // Ambil daftar tahun ajaran dari database
        $data['tahun_ajaran_list'] = $this->TahunAjaranModel->getTahunAjaran();
    
        // Ambil tahun ajaran dari input form (jika ada)
        $tahun_ajaran = $this->input->get('tahun_ajaran');
    
        // Ambil data laporan berdasarkan tahun ajaran yang dipilih
        $data['laporan'] = $this->m_laporan->getHistoriLaporan($tahun_ajaran);
    
        // Kirim tahun ajaran yang dipilih ke tampilan
        $data['tahun_ajaran_terpilih'] = $tahun_ajaran;
        
        // Pastikan halaman yang benar ditampilkan
        $data['page'] = 'histori_laporan'; 
        $data['content'] = 'adminbk/' . $data['page'];
        
        $this->load->view('home', $data);
    }
    
    

    public function PemberianPointSiswa() {
        $nis = $this->input->post('nis');
        $poin = $this->input->post('total_point');
        $id_laporan = $this->input->post('id_laporan');
        $id_pelanggaran = $this->input->post('id_pelanggaran');
    
        // Pisahkan id pelanggaran jika ada lebih dari satu pelanggaran
        $id_pelanggaran_array = explode(',', $id_pelanggaran);
    
        // Pastikan fungsi insertPoinSiswa meng-handle insert laporan otomatis
        $this->m_laporan->insertPoinSiswa($nis, $poin, $id_laporan, $id_pelanggaran_array);
    }
    
    //beranda admin BK
    public function PemberianPointLaporan() {
        $nis = $this->input->post('nis');
        $poin = $this->input->post('total_point');
        $id_laporan = $this->input->post('id_laporan');
        
        // Mengambil data id_pelanggaran dan poin_pelanggaran sebagai array
        $id_pelanggaran = json_decode($this->input->post('id_pelanggaran'), true); 
        $poin_pelanggaran = json_decode($this->input->post('poin_pelanggaran'), true); 
    
        // Validasi input
        if (empty($nis) || empty($poin) || empty($id_laporan) || empty($id_pelanggaran) || empty($poin_pelanggaran)) {
            echo 'gagal'; // Atau menggunakan json_encode(['status' => 'error', 'message' => 'Input tidak valid']);
            return;
        }
    
        // Proses penyimpanan menggunakan array id_pelanggaran dan poin_pelanggaran
        $result = $this->m_laporan->insertPoinLaporan($nis, $poin, $id_laporan, $id_pelanggaran, $poin_pelanggaran);
    
        // if ($result) {
        //     echo 'sukses';
        // } else {
        //     echo 'gagal'; // Atau menggunakan json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
        // }
    }

    

    
	public function PembatalanLaporan()
	{
		$id=$this->input->post('id_laporan');
		$this->m_laporan->tolakLaporan($id);
	}
}
