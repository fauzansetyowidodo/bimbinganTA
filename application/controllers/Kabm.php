<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kabm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $where = array('IDDosen' => $_SESSION['ID']);
        $dosen = $this->M_data->find('minat', $where);
        if (!$dosen) {
            redirect(base_url("Home"));
        }

        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
    }

    public function index()
    {
        $id = array('ID' => $_SESSION['ID']);

        $Penerima = array('IDPenerima' => $_SESSION['ID']);

        $data['Notifikasi'] = $this->M_data->find('notifikasi', $Penerima, '', '', 'users', 'users.ID = notifikasi.IDPengirim');

        $data['users'] = $this->M_data->find('users', $id, '', '', 'prodi', 'prodi.IDProdi = prodi.IDProdi');

        $result = $data['users']->row();
        $where = array('IDMinatUser' => $result->IDMinatUser);

        $data['ideta'] = $this->M_data->find('ideta', $where, 'IDIde', 'DESC', 'users', 'users.ID = ideta.IDIdeMahasiswa');

        $this->load->view('template/navbar');
        $this->load->view('dosen/home', $data);
    }

    public function filterPembimbing()
    {

        $pmb = $this->input->post('pmb');
        $id = array('ID' => $_SESSION['ID']);
        $kabm = $this->M_data->find('users', $id);

        $result = $kabm->row();

        $where = array(
            'IDMinatUser' => $result->IDMinatUser,
            'Status' => 'Dosen',
            'ID <>' => $pmb,
        );

        $data = $this->M_data->find('users', $where);

        $lists = "<option value=''>Pilih</option>";

        foreach ($data->result() as $u) {
            $lists .= "<option value='" . $u->ID . "'>" . $u->Nama . "</option>";
        }

        $callback = array('list' => $lists);
        echo json_encode($callback);
    }

    public function ideTa()
    {

        $id = array('ID' => $_SESSION['ID']);
        $kabm = $this->M_data->find('users', $id);

        $result = $kabm->row();
        $where = array('IDMinatUser' => $result->IDMinatUser);
        $dosen = array('IDMinatUser' => $result->IDMinatUser, 'Status' => 'Dosen');

        $data['dosen'] = $this->M_data->find(
            'users', $dosen
        );

        $data['ideta'] = $this->M_data->find('ideta', $where, 'IDIde', 'DESC', 'users', 'users.ID = ideta.IDIdeMahasiswa');

        $this->load->view('kabm/ideTa', $data);
    }

    public function acceptTa($idTa, $sta)
    {
        $note = $this->input->post('catatan');
        $where['IDIde'] = $idTa;

        $pengirim = $_SESSION['ID'];
        $tanggal = date('Y-m-d');

        $ideTa = $this->M_data->find('ideta', $where, '', '', 'users', 'users.ID = ideta.IDIdeMahasiswa');

        foreach ($ideTa->result() as $d) {
            $IDIde = $d->IDIde;
            $judul = $d->JudulIde;
            $deskripsi = $d->DeskripsiIde;
            $ID = $d->ID;
            $nama = $d->Nama;
        }

        if ($sta === 'true') {

            $hasil = 'Ditolak';

            $whereIde = array('IDIde' => $IDIde);

            $this->M_data->delete($whereIde, 'ideta');

        } else {

            $sh = array('IDTa' => $IDIde, 'JudulTa' => $judul, 'Deskripsi' => $deskripsi, 'IDMahasiswaTa' => $ID, 'Tanggal' => $tanggal);
            $this->M_data->save($sh, 'tugasakhir');

            
            for ($i = 1; $i < 2; $i++) {
                $pmb = $this->input->post('pmb' . $i);

                // Memasukan Dosen Pembimbing Ke Database
                $dosen = array('IDDosenPmb' => $pmb, 'IDTaPmb' => $IDIde, 'StatusProposal' => 0, 'StatusTa' => 0);
                $this->M_data->save($dosen, 'pembimbing');

                // Mengirim Pemberitahuan Ke Dosen Pembimbing
                $Catatan = 'Anda Di Tetapkan Sebagai Dosen Pembimbing ' . $nama . ' Anda sekarang bisa melihat proposal maupun Tugas Akhir ' . $nama ;

                $NotifDosen = array('Notifikasi' => $judul, 'Catatan' => $Catatan, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $pmb, 'StatusNotifikasi' => 'Informasi');
                $this->M_data->save($NotifDosen, 'notifikasi');
            
            }

            $whereIde = array('IDIdeMahasiswa' => $ID);

            $this->M_data->delete($whereIde, 'ideta');

            $hasil = 'Diterima';

        }

        echo $sta;

        $NotifMhs = array('Notifikasi' => $judul, 'Catatan' => $note, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $ID, 'StatusNotifikasi' => $hasil);
        $this->M_data->save($NotifMhs, 'notifikasi');

    }
}
