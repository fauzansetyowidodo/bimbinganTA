<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('Status') != "Admin") {
            redirect(base_url("Home"));
        }
        $this->load->library('Ajax_pagination');
        $this->perPage = 4;
    }

    public function index()
    {
        $data['minat'] = $this->M_data->find('minat');
        $this->load->view('template/navbar');
        $this->load->view('admin/home', $data);
    }

    public function navigasiUsers($nav)
    {

        $where = $nav == 'Mahasiswa' ? "Status='Mahasiswa'" : "Status='Dosen'";
        if ($nav != 'Settings') {
            $data['users'] = $this->M_data->find('users', $where);
            $data['nav'] = $nav;
        } else {
            $data = '';
        }

        $this->load->view('admin/nav/' . $nav, $data);
    }

    public function formProdi()
    {
        $this->load->view('admin/form/Prodi');
    }

    public function formMinat()
    {
        $where = array('Status' => 'Dosen');

        $data['result'] = 'Data Program Studi harus disi dahulu!';
        $data['prodi'] = $this->M_data->find('prodi');
        $data['users'] = $this->M_data->find('users', $where);

        $this->load->view('admin/form/Minat', $data);
    }

    public function formKabm($id)
    {
        $where = array('IDMinatUser' => $id, 'Status' => 'Dosen');
        $data['dosen'] = $this->M_data->find('users', $where);
        $data['ID'] = $id;
        $this->load->view('admin/form/Kabm', $data);
    }

    public function formUsers($user)
    {
        $data['minat'] = $this->M_data->find('minat');
        $data['prodi'] = $this->M_data->find('prodi');
        $data['user'] = $user;
        $this->load->view('admin/form/Users', $data);
        $this->load->view('template/jquery/formSubmit');
    }

    public function tabelProdiAdmin()
    {
        $data['prodi'] = $this->M_data->find('prodi');
        $this->load->view('admin/tabel/Prodi', $data);
    }

    public function tabelMinatAdmin($id)
    {
        $where = array('IDProdiMnt' => $id);

        $data['minat'] = $this->M_data->find('minat', $where, '', '', 'users', 'users.ID = minat.IDDosen');

        if ($data['minat']) {
            foreach ($data['minat']->result() as $k) {
                $whereUsers = array(
           //       'IDKonsentrasiUser' => $k->IDKonsentrasi,
                    'Status' => 'Dosen',
                );
            }
            $data['users'] = $this->M_data->find('users', $whereUsers);
        } else {
            $data['users'] = 'Tidak Ditemukan Bidang Minat';
        }

        $this->load->view('admin/tabel/Minat', $data);

    }

    public function submitKabm($id)
    {
        $where = array(
            'IDMinat' => $id,
        );

        $data['IDDosen'] = $this->input->post('kabm');

        $this->M_data->update('IDMinat', $id, 'minat', $data);
        redirect('Admin');
    }

    public function tabelNavigasi($page, $user)
    {
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $search = $this->input->post('search');

        if (!empty($keywords)) {
            $conditions['search']['keywords'] = $keywords;
        }
        if (!empty($sortBy)) {
            $conditions['search']['sortBy'] = $sortBy;
        }
        if ($user != 'Daftar') {
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
        } else {
            $conditions['start'] = '';
            $conditions['limit'] = '';
        }

        if ($user === 'Mahasiswa') {
            $where = "(Status='Mahasiswa')";
        } else {
            $where['Status'] = $user;
        }

        $data['users'] = $this->M_data->find('users', $where, '', '', 'prodi', 'prodi.IDProdi = users.IDProdiUser', 'minat', 'minat.IDMinat = users.IDMinatUser', '', '', $conditions, $search);

        $total = $this->M_data->find('users', $where, '', '', 'prodi', 'prodi.IDProdi = users.IDProdiUser', 'minat', 'minat.IDMinat = users.IDMinatUser');

        if ($data['users']) {

            $data['prodi'] = $this->M_data->find('prodi');

            $whereminat = array(
              'IDProdiMnt' => $data['users']->row()->IDProdiUser   
          );

            $data['minat'] = $this->M_data->find('minat', $whereminat);

        }

        $totalRec = $total != false ? $total->num_rows() : 0;
        $config['target'] = '#tabelUsers';
        $config['base_url'] = base_url() . 'Admin/tabelNavigasi/' . $page . '/' . $user;
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'search' . $user;

        $user === 'Daftar' ? '' : $this->ajax_pagination->initialize($config);


        $data['status'] = $user;



        $this->load->view('admin/tabel/Users', $data, false);
        $this->load->view('template/jquery/btnSubmit');
    }

    public function saveProdi()
    {
        $data['IDProdi'] = $this->input->post('id_prodi');
        $data['Prodi'] = $this->input->post('prodi');

        $this->M_data->save($data, 'prodi');

        $notif = array(
            'head' => 'Data Berhasil Disimpan', 
            'isi' => 'Porgram Studi telah disimpan di Database', 
            'sukses' => 1, 
            'ID' => 'ProdiAdmin', 
            'func' => 'Admin/tabelProdiAdmin',
        );
        
        echo json_encode($notif);
    }

    public function saveMinat()
    {
        $prodi = $this->input->post('prodi');
        $data['IDMinat'] = $this->input->post('id');
        $data['minat'] = $this->input->post('minat');
        $data['IDProdiMnt'] = $this->input->post('id_prodi');
        $data['IDDosen'] = $prodi === null ? '' : $prodi;
        $this->M_data->save($data, 'minat');

        $notif = array(
            'head' => 'Data Berhasil Disimpan',
            'isi' => 'Bidang Minat telah disimpan di Database',
            'sukses' => 1,
            'ID' => 'ProdiAdmin',
            'func' => 'Admin/tabelProdiAdmin',
        );

        echo json_encode($notif);
    }

    public function saveUsers($user) 

    {
        $id = $this->input->post('id');
        $nama = $this->input->post('name');
        $email = $this->input->post('email');
        $prodi = $this->input->post('id_prodi');
        $minat = $this->input->post('minat');

        $data = array(
            'ID' => $id,
            'Nama' => $nama,
            'Email' => $email,
            'IDMinatUser' => $minat,
            'IDProdiUser' => $prodi,
            'Password' => md5('12345'),
            'Status' => $user,
        );

        $this->M_data->save($data, 'users');

        $notif = array(
            'head' => 'Data Berhasil Ditambahkan',
            'isi' => 'Data berhasilkan ditambahkan ke database '.$user,
            'sukses' => 1,
            'ID' => $user,
            'func' => 'Admin/tabelNavigasi/0/'.$user,
        );

        echo json_encode($notif);
    }


    public function filterKabm()
    {
        $id_prodi = $this->input->post('id_prodi');
        $where = array(
            'IDProdiUser' => $id_prodi,
            'Status' => 'Dosen',
        );
        $data = $this->M_data->find('users', $where);

        if ($data) {
            $lists = "<option value=''> Pilih Ketua Bidang Minat </option>";
            foreach ($data->result() as $d) {
                $lists .= "<option value='" . $d->ID . "'>" . $d->Nama . "</option>";
            }
        } else {
            $lists = "<option value=''>Dosen Tidak Ada </option>";
        }

        $callback = array('list' => $lists);
        echo json_encode($callback);
    }

    function updateUser()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $prodi = $this->input->post('prodi');
        $minat = $this->input->post('minat');
        $email = $this->input->post('email');
        $nohp = $this->input->post('nohp');
        $idlama = $this->input->post('idlama');

        $data = array('ID' => $id, 'Nama' => $name, 'IDProdiUser' => $prodi, 'IDMinatUser' => $minat, 'Email' => $email, 'NoHP' => $nohp );

        $this->M_data->update('ID', $idlama, 'users', $data);
    }

    public function update()
    {
        $id = $this->input->post("id");
        $value = $this->input->post("value");
        $modul = $this->input->post("modul");
        $data[$modul] = $value;
        $this->M_data->update('ID', $id, 'users', $data);
        echo "{}";
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
