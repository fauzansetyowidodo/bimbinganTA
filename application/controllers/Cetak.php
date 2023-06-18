<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
	}

	public function kartu($nim)
	{
		$where = array('ID' => $nim);
		$where1 = array('IDKartuMahasiswa' => $nim);
		$data = $this->M_data->find('kartubimbingan', $where1, '', '', 'users', 'users.ID = kartubimbingan.IDDosenPembimbing');

		$where2 = array('IDMahasiswaTa' => $nim);
		$tugasakhir = $this->M_data->find('tugasakhir', $where2, '', '', 'users', 'users.ID = tugasakhir.Uploader');
		
		$mhs = $this->M_data->find('users', $where,'', '', 'prodi', 'prodi.IDProdi = users.IDProdiUser', 'minat', 'minat.IDMinat = users.IDMinatUser');

		$pdf = new Pdf('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Times', '', 13);
		$pdf->Image('assets/web/kopsurat2.png',10,15);
		$pdf->cell(80);
		$pdf->Cell(50,10,'KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI',0,0,'C');
		$pdf->ln(6);
		$pdf->Cell(210,10,'UNIVERSITAS BRAWIJAYA',0,0,'C');
		$pdf->ln(6);
		$pdf->Cell(210,10,'FAKULTAS VOKASI',0,0,'C');
		$pdf->ln(6);
		$pdf->Cell(210,10,'Jl. Veteran No. 12 - 16, Malang 65145, Indonesia',0,0,'C');
		$pdf->ln(6);
		$pdf->Cell(210,10,'Telp. +62-341-553240;  Fax. +62-341-553448',0,0,'C');
		$pdf->ln(6);
		$pdf->Cell(210,10,'E-mail: vokasi@ub.ac.id      http://vokasi.ub.ac.id',0,0,'C');
		$pdf->ln(6);
		$pdf->Image('assets/web/linekop.png',10,50,190);
		$pdf->ln(20);
		$pdf->Cell(0, 0, 'LEMBAR KONSULTASI TUGAS AKHIR', 0,0,'C');
		$pdf->ln(10);
		$pdf->SetFont('Times', '', 12);
		foreach ($mhs->result() as $m) {
			$pdf->Cell(30, 5, 'Nama', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->Nama, 0,0,'L');	
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'NIM', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->ID, 0,0,'L');
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'Bidang Minat', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->Minat, 0,'L');
			$pdf->ln(2);
			$pdf->Cell(30, 5, 'Program Studi', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->Prodi, 0,'L');
			$pdf->ln(2);       
			$pdf->Cell(30, 5, 'Judul TA', 0,0,'L');
			foreach ($tugasakhir->result() as $l) {
				$pdf->MultiCell(0, 5, ': '.$l->JudulTa, 0,'J');
			}
		}
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'Pembimbing', 0,0,'L');
			if ($tugasakhir) {
			foreach ($tugasakhir->result() as $j) {
					$pdf->MultiCell(0, 5, ': '.$j->Nama, 0,'J');
			}
		}
			
		$pdf->ln(10);
		/*srand(microtime()*1000000);*/
		if ($data) {

			$pdf->Cell(10,7,'No',1);		
			$pdf->Cell(45,7,'Tanggal', 1);
			$pdf->Cell(70,7,'Uraian', 1);
			$pdf->Cell(65,7,'TTD Pembimbing', 1);
			$pdf->Ln();
			$no = 1;
			$pdf->SetWidths(array(10,45,70,65,20));
			foreach ($data->result() as $d) {

				for($i=0;$i<1;$i++)
					$pdf->Row(array($no++,longdate_indo($d->TanggalBimbingan),$d->Catatan,''));
			}		
		} else {
			$pdf->MultiCell(100,7, 'Tidak Ditemukan Catatan Bimbingan Dosen Untuk Tugas Akhir Ini', 0);
		}


		$pdf->Cell(100, 0, '', 0,0,'L');
		$pdf->Cell(0, 35, 'Malang, '.date_indo(date('Y-m-d')), 0,2,'L');

		// foreach ($mhs->result() as $k) {
		// 	$where = array('IDMinat' => $k->IDMinatUser);
		// 	$prodi = $this->M_data->find('minat', $where,  '', '', 'users', 'users.ID = minat.IDDosen', 'prodi', 'prodi.IDProdi = minat.IDProdiMnt');	
		// }
		// foreach ($prodi->result() as $j) {
		// 	$pdf->Cell(0, 9, $j->Nama, 0,2,'L');
		// 	$pdf->Cell(0, 0, 'Ka. Bidang Minat '.$j->Prodi.' '.$j->Minat, 0,2,'L');
		// }
		$pdf->Output();
	}
}
