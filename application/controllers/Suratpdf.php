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

    private function getTanggalIndonesia($tanggal) {
        $tanggal = explode(" ", $tanggal);
        $bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        return $tanggal[0] . ' ' . $bulanIndonesia[(int)$tanggal[1] - 1] . ' ' . $tanggal[2];
    }

    public function suratPemanggilan($nis_siswa) { 
        $siswa = $this->m_siswa->getSiswaIdAndWali($nis_siswa);
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
        // var_dump($tanggal_bimbingan);

        // Pastikan tanggal bimbingan tidak null
        if (!$tanggal_bimbingan) {
            show_error('Jadwal bimbingan tidak ditemukan.');
            return;
        }

        $tahun_ajaran_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row_array();
        $laporan = $this->m_laporan->getSatuLaporanPelanggaranBySiswa($nis_siswa, $tahun_ajaran_aktif['tahun_akademik']);

        // Konversi tanggal dan hari ke bahasa Indonesia
        $tanggal_bimbingan_format = $this->getTanggalIndonesia(date('d m Y', strtotime($tanggal_bimbingan['tanggal_bimbingan'])));
        $tanggal_laporan_format = $this->getTanggalIndonesia(date('d m Y', strtotime($laporan['create_date'])));
        $waktu_laporan = date("H:i", strtotime($laporan['create_date']));
        $hari_bimbingan = $this->getHariIndonesia($tanggal_bimbingan['tanggal_bimbingan']);
        $kode_bimbingan = $bimbingan['kode_bimbingan'];
        $poin_pelanggaran = $bimbingan['poin_pelanggaran'];
        $apakahDiberhentikan = false;
        $apakahSP3 = false;

        if($poin_pelanggaran == 100) {
            $hal_surat = "Surat Pemberitahuan Siswa";
            $apakahDiberhentikan = true;
        }
        else if($poin_pelanggaran >= 75) {
            $hal_surat = "Surat Panggilan Siswa Ke-3";
            $apakahSP3 = true;
        }
        else if($poin_pelanggaran >= 50) $hal_surat = "Surat Panggilan Siswa Ke-2";
        else $hal_surat = "Surat Panggilan Siswa Ke-1";

        $hari_laporan = $this->getHariIndonesia($laporan['create_date']);
        // var_dump($hari_laporan);

        // Kirim data ke view
        $data = [
            'siswa' => $siswa,
            'hal_surat' => $hal_surat,
            'tanggal_bimbingan' => $tanggal_bimbingan_format,
            'tanggal_laporan' => $tanggal_laporan_format,
            'waktu_laporan' => $waktu_laporan,
            'hari_laporan' => $hari_laporan,
            'hari_bimbingan' => $hari_bimbingan,
            'kode_bimbingan' => $kode_bimbingan,
            'poin_pelanggaran' => $poin_pelanggaran,
            'laporan' => $laporan,
            'status_sp3' => $apakahSP3
        ];

        

        // Load view dengan data
        $html = ($apakahDiberhentikan)? $this->load->view('surat/surat_pemberhentian', $data, true) :  $this->load->view('surat/surat_pemanggilan', $data, true);

        // var_dump($waktu_laporan);

        //Load library PDF
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Surat_Pemberhentian_" . $siswa['nama_siswa'] . ".pdf", array("Attachment" => false));
    }

    public function laporanPelanggaran() { 
        // $siswa = $this->m_siswa->getSiswaIdAndWali($nis_siswa);
        // if (!$siswa) {
        //     show_error('Data siswa tidak ditemukan.');
        //     return;
        // }
        $tahun_ajaran_terpilih = $this->input->get('tahun_ajaran_terpilih');
        
        if($tahun_ajaran_terpilih) {
            $laporan = $this->m_laporan->getHistoriLaporan($tahun_ajaran_terpilih);
        } else {    
            $laporan = $this->m_laporan->getHistoriLaporan();
        }

        // var_dump($laporan->result_array());


        // $tahun_ajaran_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row_array();
        // $tanggal_konfirmasi_pelanggaran = $this->getTanggalIndonesia(date('d m Y', strtotime($tanggal_bimbingan['tanggal_bimbingan'])));
        // $tanggal_laporan_format = $this->getTanggalIndonesia(date('d m Y', strtotime($laporan['create_date'])));
        // $waktu_laporan = date("H:i", strtotime($laporan['create_date']));
        // $hari_laporan = $this->getHariIndonesia($laporan['create_date']);

        $tanggal_hari_ini = $this->getTanggalIndonesia(date('d m Y'));

        // Kirim data ke view
        $data = [
            'laporan' => $laporan->result_array(),
            'tahun_ajaran_terpilih' => $tahun_ajaran_terpilih,
            'tanggal_hari_ini' => $tanggal_hari_ini
        ];

        // Load view dengan data
        $html = $this->load->view('laporan/laporanPelanggaran', $data, true);

        // var_dump($html);

        //Load library PDF
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("laporan_pelanggaran.pdf", array("Attachment" => false));
    }

    public function laporanBimbingan() { 
        // $siswa = $this->m_siswa->getSiswaIdAndWali($nis_siswa);
        // if (!$siswa) {
        //     show_error('Data siswa tidak ditemukan.');
        //     return;
        // }
        $tahun_ajaran_terpilih = $this->input->get('tahun_ajaran_terpilih');
        
        if($tahun_ajaran_terpilih) {
            $bimbingan = $this->m_bimbingan->getDataBimbinganOrderById($tahun_ajaran_terpilih);
        } else {    
            $bimbingan = $this->m_bimbingan->getDataBimbinganOrderById();
        }

        // var_dump($laporan->result_array());


        // $tahun_ajaran_aktif = $this->db->get_where('tahun_akademik', array('status_akademik' => 'aktif'))->row_array();
        // $tanggal_konfirmasi_pelanggaran = $this->getTanggalIndonesia(date('d m Y', strtotime($tanggal_bimbingan['tanggal_bimbingan'])));
        // $tanggal_laporan_format = $this->getTanggalIndonesia(date('d m Y', strtotime($laporan['create_date'])));
        // $waktu_laporan = date("H:i", strtotime($laporan['create_date']));
        // $hari_laporan = $this->getHariIndonesia($laporan['create_date']);

        $tanggal_hari_ini = $this->getTanggalIndonesia(date('d m Y'));

        // Kirim data ke view
        $data = [
            'bimbingan' => $bimbingan->result_array(),
            'tahun_ajaran_terpilih' => $tahun_ajaran_terpilih,
            'tanggal_hari_ini' => $tanggal_hari_ini
        ];

        // Load view dengan data
        $html = $this->load->view('laporan/laporanBimbingan', $data, true);

        // var_dump($bimbingan->result_array());

        //Load library PDF
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("laporan_pelanggaran.pdf", array("Attachment" => false));
    }
}
