<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$status = $this->session->userdata('Status');
		if (!(($status == "Dosen") or ($status == "Kabm"))) {
			redirect(base_url("Home"));
		}
		$this->load->library('Ajax_pagination');
		$this->perPage = 5;
	}

	function index()
	{

		$id = array('ID' => $_SESSION['ID']);

		$Penerima = array('IDPenerima' => $_SESSION['ID']);

		$data['Notifikasi'] = $this->M_data->find('notifikasi', $Penerima, '', '', 'users', 'users.ID = notifikasi.IDPengirim');

		$data['users'] = $this->M_data->find('users', $id, '', '', 'prodi', 'prodi.IDProdi = users.IDProdiUser');

		$result = $data['users']->row();
		$where = array('IDMinatUser' => $result->IDMinatUser);

		$data['ideta'] = $this->M_data->find('ideta', $where, 'IDIde', 'DESC', 'users', 'users.ID = ideta.IDIdeMahasiswa');

		$this->load->view('template/navbar');
		$this->load->view('dosen/home', $data);
	}

	function tabelTa()
	{

		$ID = $_SESSION['ID'];

		$where = array('ID' => $ID);

		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		$keywords = $this->input->post('keywords');
		$search = $this->input->post('search');

		if (!empty($keywords)) {
			$conditions['search']['keywords'] = $keywords;
		}
		if (!empty($sortBy)) {
			$conditions['search']['sortBy'] = $sortBy;
		}

		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

		$users = $this->M_data->find('users', $where);

		foreach ($users->result() as $u) {
			$IDMinat = $u->IDMinatUser;
			$Status = $u->Status;

			$whereID = array(
				'IDMinatUser' => $u->IDMinatUser,
				'Status' => 'Mahasiswa'
			);
		}

		$data['users'] = $this->M_data->find('tugasakhir', $whereID, '', '', 'users', 'users.ID = tugasakhir.IDMahasiswaTa', '', '', '', '', $conditions, $search);

		$total = $this->M_data->find('tugasakhir', $whereID, '', '', 'users', 'users.ID = tugasakhir.IDMahasiswaTa');

		$totalData = $total != FALSE ? $total->num_rows() : 0;
		$config['target'] = '#tabelUser';
		$config['base_url'] = base_url() . 'Kabm/tabelTa';
		$config['total_rows'] = $totalData;
		$config['per_page'] = $this->perPage;
		$config['link_func']   = 'searchmhs';

		$this->ajax_pagination->initialize($config);

		if ($data['users']) {
			foreach ($data['users']->result() as $d) {

				$finish = array(
					'IDTaPmb' => $d->IDTa,
					'StatusTa' => 1
				);
			}
			$data['finish'] = $this->M_data->find('pembimbing', $finish, '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');
		}

		$data['pembimbing'] = $this->M_data->find('pembimbing', '', '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');
		$this->load->view('dosen/tabelTa', $data, false);
	}

	function detailDosen($nik)
	{
		$where = array('ID' => $nik);
		$wherep = array('IDDosenPmb' => $nik);
		$data['pembimbing'] = $this->M_data->find('pembimbing', $wherep, '', '', 'users', 'users.ID = pembimbing.IDDosenPmb', 'tugasakhir', 'tugasakhir.IDTa = pembimbing.IDTaPmb');
		$data['dosen'] = $this->M_data->find('users', $where);
		$this->load->view('template/navbar')->view('kabm/detailDosen', $data);
	}

	function detailMahasiswa($ID)
	{
		$where = array(
			'IDMahasiswaTa' => $ID
		);

		$data['tugasakhir'] = $this->M_data->find('tugasakhir', $where,  '', '', 'users', 'ID = IDMahasiswaTa');
		$data['uploader'] = $this->M_data->find('tugasakhir', $where,  '', '', 'users', 'ID = Uploader');

		$wherePMB = array(
			'IDTaPmb' => $data['tugasakhir']->row_array()['IDTa'],
			'IDDosenPmb' => $_SESSION['ID']
		);

		// Mengambil data pembimbing yang sedang melihat skripsi
		$data['pembimbing'] = $this->M_data->find('pembimbing', $wherePMB);

		$whereProp = array(
			'IDTaPmb' => $data['tugasakhir']->row_array()['IDTa']
		);

		// Array Proposal Berfungsi Untuk Menghitung Proposal Skripsi Yang Di ACC
		$data['proposal'] =  $this->M_data->find('pembimbing', $whereProp);

		$isTa = array(
			'StatusProposal' => 1,
			'IDTaPmb' => $data['tugasakhir']->row_array()['IDTa']
		);

		$data['isTa'] = $this->M_data->find('pembimbing', $isTa) ? $this->M_data->find('pembimbing', $isTa)->num_rows() === 2 ? 'Ta' : 'Proposal' : 'Proposal';

		$whereIDCard = array('IDKartuMahasiswa' => $ID);
		$data['konsultasi'] = $this->M_data->find('kartubimbingan', $whereIDCard, '', '', 'users', 'users.ID = kartubimbingan.IDDosenPembimbing');

		$this->load->view('template/navbar');
		$this->load->view('dosen/detailMahasiswa', $data);
	}

	function accUsers($ID, $users)
	{
		$where = array(
			'IDTaPmb' => $ID,
			'IDDosenPmb' => $_SESSION['ID']
		);

		$cek['Pembimbing'] = $this->M_data->find('tugasakhir', $where, '', '', 'pembimbing', 'pembimbing.IDTaPmb = tugasakhir.IDTa');

		foreach ($cek['Pembimbing']->result() as $c) {

			$data['Notifikasi'] = ' File TA ' . $c->JudulTa . ' Telah Di ACC';
			$data['Catatan'] = ' Telah Di ACC Oleh : <br>' . $this->session->userdata('Nama') . ' Sebagai Pembimbing ';
			$data['IDPenerima'] = $c->IDMahasiswaTa;
			$data['IDPengirim'] = $_SESSION['ID'];
			$data['TanggalNotifikasi'] = date('Y-m-d');
			$data['StatusNotifikasi'] = $users;

			$accept['Status' . $users] = 1;

			$this->M_data->update('IDPembimbing', $c->IDPembimbing, 'pembimbing', $accept);
			$this->M_data->save($data, 'notifikasi');
		}
	}

	function catatan($IDta, $ID, $status)
	 {
			$dataTa = array(
				
				'Uploader' => $_SESSION['ID']
			);
			
			$data['TanggalBimbingan'] = date('Y-m-d');
			$data['Catatan'] = $this->input->post('note');
			$data['IDDosenPembimbing'] = $_SESSION['ID'];
			$data['IDKartuMahasiswa'] = $ID;
			$berhasil = array('hasil' =>  'Berhasil');

			$this->M_data->update('IDTa', $IDta, 'tugasakhir', $dataTa);
			$this->M_data->save($data, 'kartubimbingan');
			echo json_encode($berhasil);
		}
}
