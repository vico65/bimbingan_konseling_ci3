<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suratpdf extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->load->library('pdf');
	    $this->load->model('m_siswa');
	    $this->load->model('m_bimbingan'); 
	}

	public function index() {
		$this->load->view('home');
	}

	// Fungsi untuk mengonversi hari ke bahasa Indonesia
    private function getHariIndonesia($tanggal) {
        $hariInggris = date('l', strtotime($tanggal));
        $hariIndonesia = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        return $hariIndonesia[$hariInggris];
    }

    public function suratPemanggilan($nis_siswa) { 
        $siswa = $this->m_siswa->getSiswaId($nis_siswa);
        if (!$siswa) {
            show_error('Data siswa tidak ditemukan.');
            return;
        }

        // Ambil data bimbingan terakhir berdasarkan NIS siswa
        $bimbingan = $this->m_bimbingan->getLastBimbinganBySiswa($siswa['nis_siswa']);

        // Cek apakah ada data bimbingan
        if (!$bimbingan) {
            show_error('Data bimbingan tidak ditemukan.');
            return;
        }

        // Ambil tanggal bimbingan dari tabel jadwal_bimbingan
        $tanggal_bimbingan = $this->m_bimbingan->getJadwalBimbinganById($bimbingan['id_bimbingan']);

        // Pastikan tanggal bimbingan tidak null
        if (!$tanggal_bimbingan) {
            show_error('Jadwal bimbingan tidak ditemukan.');
            return;
        }

        $hal_surat = "Surat Pemanggilan Siswa";

        // Konversi tanggal dan hari ke bahasa Indonesia
        $tanggal_bimbingan_format = date('d F Y', strtotime($tanggal_bimbingan['tanggal_bimbingan']));
        $hari_bimbingan = $this->getHariIndonesia($tanggal_bimbingan['tanggal_bimbingan']);
        $kode_bimbingan = $bimbingan['kode_bimbingan'];
        $poin_pelanggaran = $bimbingan['poin_pelanggaran'];

        // Kirim data ke view
        $data = [
            'siswa' => $siswa,
            'hal_surat' => $hal_surat,
            'tanggal_bimbingan' => $tanggal_bimbingan_format,
            'hari_bimbingan' => $hari_bimbingan,
            'kode_bimbingan' => $kode_bimbingan,
            'poin_pelanggaran' => $poin_pelanggaran
        ];

        // Load view dengan data
        $html = $this->load->view('surat/surat_pemanggilan', $data, true);

        // Load library PDF
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Surat_Pemanggilan_" . $siswa['nama_siswa'] . ".pdf", array("Attachment" => false));
    }
}
