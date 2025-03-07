<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suratpdf extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
	    parent::__construct();
	    	$this->load->library('pdf');
  	}
	public function index()
	{
		$this->load->view('home');
	}

	public function suratPemanggilan(){

		// $pdf=new FPDF();
		// // $pdf->setKriteria("cetak_laporan");
		// // $pdf->setnama("CETAK LAPORAN");
		$pdf=new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage("P","A4");
		$pdf->SetMargins(20,5,10);
		
		$A4[0]=210;
		$A4[1]=297;
		$Q[0]=216;
		$Q[1]=279;
		$pdf->SetTitle('Laporan Aplikasi Nasabah');
		$pdf->SetCreator('Programmer IT with fpdf');
				
		$h = 5;
		$pdf->image(base_url().'assets/img/logo-badung.png', 20, 8, 25);
		$pdf->image(base_url().'assets/img/logotj.png', 165, 8, 25);
		$pdf->SetFont('Times','B',18);
		$pdf->Cell(0,5,strtoupper('SMK PARIWISATA TRIATMAJAYA'),0,1,'C');
		$pdf->SetFont('Times','',12);
		
		$pdf->Ln();
		$pdf->Line(20,55,190,55,100);
		$pdf->Ln(25);
		

		//Menampilkan data
		$data1=1;
		$data2=2;
		$data3=3;	
		$data4=4;
		$data5=5;
		$data6=5;
		$data10=7;
		$data11=8;	
		$data12=9;
		$data13=10;
		$data14=11;
		$data15=12;
		$data16=13;								
		$data17=13;								
		$data18=13;								
		$data19=13;								
		$data20=13;	
		$tgl_daftar='123';							
		// foreach($q->result() as $row)			
		// {
			
		// 	$data1=$row->jenis_rek;
		// 	$data2=$row->no_rek;
		// 	$data3=$row->setoran_awal;	
		// 	$data4=$row->terbilang;
		// 	$data5=$row->sumber_dana;
		// 	$data6=$row->jenis_setoran;
		// 	$data10=$row->nama;
		// 	$data11=$row->nik_kk;	
		// 	$data12=$row->jk;
		// 	$data13=$row->tmp_lahir;
		// 	$data14=$row->tgl_lahir;
		// 	$data15=$row->alamat;
		// 	$data16=$row->pendidikan;
		// 	$data17=$row->telp;
		// 	$data18=$row->hp;
		// 	$data19=$row->pekerjaan;
		// 	$data20=$row->nama_ibu;
			

		// }
			
			$pdf->SetFont('Times','B',14);
			$pdf->Cell(0,$h,'SURAT PEMANGGILAN WALI SISWA','',0,'C');
			$pdf->Ln(10);
		
			$h = 7;
			$pdf->SetFont('Times','',12);
				$pdf->SetX(20);
				$pdf->Cell(0,$h,'Dengan hormat,','',0,'L');								
			$pdf->Ln();
				$pdf->Cell(0,$h,'Sehubungan dengan masalah yang harus diselesaikan bersama, maka dengan ini kami mengharapkan','',0,'L');								
			$pdf->Ln();
				$pdf->Cell(0,$h,'kehadiran Bapak/Ibu Wali murid pada :','',0,'L');								
			$pdf->Ln(10);
				$pdf->SetX(30);
				$pdf->Cell(35,$h,'Hari/Tanggal','',0,'L');
				$pdf->Cell(5,$h,':','',0,'C');
				$pdf->Cell(80,$h,'Senin 30 September 2019',0,'L');
			$pdf->Ln();
			$pdf->SetX(30);
				$pdf->Cell(35,$h,'Waktu','',0,'L');
				$pdf->Cell(5,$h,':','',0,'C');
				$pdf->Cell(80,$h,'08.00 WITA',0,'L');
			$pdf->Ln();
			$pdf->SetX(30);
				$pdf->Cell(35,$h,'Tempat','',0,'L');
				$pdf->Cell(5,$h,':','',0,'C');
				$pdf->Cell(80,$h,'SMK PARIWISATA TRIATMAJAYA','',0,'L');
			$pdf->Ln();
			// $pdf->SetX(30);
			// 	$pdf->Cell(35,$h,'Sumber Dana','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data5,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(30);
			// 	$pdf->Cell(35,$h,'Jenis Setoran','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data6,'',0,'L');
			
			$pdf->Ln();
			$pdf->SetX(30);
			$pdf->SetFont('Times','B',12);
				//$pdf->Cell(0,$h,'Data Nasabah Simpanan Sukarela','',0,'L');
			$pdf->Ln();
			$pdf->SetFont('Times','',12);
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'Nama Pemohon','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(100,$h,''.$data10,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'No. KTP/SIM','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data11,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'Jenis Kelamin','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data12,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'Tempat/Tgl Lahir','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data13.' / '.$data14,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'ALamat','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(150,$h,''.$data15,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'Pendidikan','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data16,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'No. Telp / HP','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data17.' / '.$data18 ,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'Pekerjaan','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data19,'',0,'L');
			// $pdf->Ln();
			// $pdf->SetX(40);
			// 	$pdf->Cell(35,$h,'Nama Ibu Kandung','',0,'L');
			// 	$pdf->Cell(5,$h,':','',0,'C');
			// 	$pdf->Cell(80,$h,''.$data20,'',0,'L');
			// $pdf->Ln(10);
			// $pdf->SetX(20);
				$pdf->MultiCell(0,$h,'Mengingat pentingnya hal tersebut maka kami mengharapkan Bapak/Ibu untuk datang tepat waktu pada waktu yang telah ditentukan.','','J',0);
			$pdf->Ln();
			$pdf->MultiCell(0,$h,'Demikian surat panggilan ini kami sampaikan, atas perhatian Bapak/Ibu kami ucapkan terimakasih.','','J',0);
			$pdf->Ln();

			
		//data
		//$pdf->SetFillColor(224,235,255);
						
		//========================Potrait================//
		$h = 5;
		$pdf->SetFont('Times','',12);
		$pdf->Ln();
		$pdf->SetX(130);					
		$pdf->Cell(50,$h,''.ucfirst(strtolower('Mengetahui')),'',0,'C');
		$pdf->Ln();
		
		$pdf->SetX(30);
		$pdf->Cell(50,$h,'','',0,'C');
		$pdf->Cell(50,$h,'','',0,'C');
		$pdf->Cell(50,$h,'Kepala Sekolah SMK Triatmajaya','',0,'C');
		$pdf->Ln();
		$pdf->SetX(30);
		$pdf->Cell(50,$h,'Waka Kesiswaan','',0,'C');
		$pdf->Cell(50,$h,'','',0,'C');
		// $pdf->Cell(50,$h,'Ketua','',0,'C');
		$pdf->Ln(25);
		$pdf->SetX(30);						
		$pdf->Cell(50,$h,'( ... )','',0,'C');
		$pdf->Cell(50,$h,'','',0,'C');
		$pdf->Cell(50,$h,'( ...  )','',0,'C');
				$pdf->Output();

	}
}
