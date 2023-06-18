<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->view('home');
	}

	function filterMinat(){

		$IDProdi = $this->input->post('IDProdi');
		$where = array('IDProdiMnt' => $IDProdi );
		$data = $this->M_data->find('minat', $where);
		
		if ($data) {
			$lists = "<option value=''>Pilih</option>";
			foreach($data->result() as $u){
				$lists .= "<option value='".$u->IDMinat."'>".$u->Minat."</option>"; 
			}
		} else {
			$lists = "<option disabled> Belum Ada Bidang Minat </option>";
		}

		$callback = array('list'=> $lists); 
		echo json_encode($callback);
	}


	function session()
	{
		$username = $this->input->post('nim');
		$password = md5($this->input->post('password'));

		$where = "ID='$username' AND Password='$password'";

		$where_admin = "username='$username' AND Password='$password'";

		$users = $this->M_data->find('users', $where, '', '', 'minat','minat.IDMinat = users.IDMinatUser');

		$admin = $this->M_data->find('admin', $where_admin);

		if ($users) {

			foreach ($users->result() as $u) {

				$data = array(
					'ID' => $u->ID,
					'Status' => $u->Status,
					'Nama' => $u->Nama,
					'Minat' => $u->Minat,
				);
				
				$status = $u->Status;
				if ($u->ID === $u->IDDosen) {
					$data['Kabm'] = 1;
					echo 3;
				} elseif($status === 'Dosen') {
					$data['Kabm'] = 0;
					echo 1;
				} else {
					echo 2;
					$data['Kabm'] = 0;
				}

				$this->session->set_userdata($data);

			}

		} elseif ($admin) {

			foreach ($admin->result() as $b) {

				$data = array(
					'id_admin' => $b->id_admin,
					'username' => $b->username,
					'password' => $b->Password,
					'Status' => 'Admin',
				);

				$this->session->set_userdata($data);
				echo 4;
			}
		} else {
			redirect('Home');
		}
	}

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('Home');
	}
}
