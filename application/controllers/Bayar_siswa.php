<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bayar_siswa extends CI_Controller
{
public function __construct()
    {
        parent::__construct();
        $this->load->model(['Siswa_model','akun_model']);
    }
    
    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->Siswa_model->get_data_siswa();
        $data['transaksi'] = $this->Siswa_model->get_data_sisa();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/bayar_siswa', $data);
        $this->load->view('templates/footer', $data);
        
    }

    public function tambahtransaksi()
    {
        $id = $this->input->post('id');
        $result = $this->Siswa_model->getSiswaById($id);

        if (!$result) {
            redirect('bayar_siswa');
        } else {
            $data['title'] = 'Tambah Transaksi Siswa';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['iuran'] = $this->Siswa_model->getAllIuran();
            $data['siswa'] = $result;

            $this->form_validation->set_rules('bulan_bayar', 'Untuk pembayaran bulan', 'required|trim');
            $this->form_validation->set_rules('tahun_bayar', 'Untuk pembayaran tahun', 'required|trim|integer');
            $this->form_validation->set_rules('jmlh_bayar', 'Jumlah bayar', 'required|trim|numeric|integer');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('siswa/tambahtransaksi_siswa', $data);
                $this->load->view('templates/footer', $data);
                
            } else {
                $jumlahBayar    = $this->input->post('jmlh_bayar');
                $bulanBayar     = $this->input->post('bulan_bayar');
                $tahunBayar     = $this->input->post('tahun_bayar');
                $cek            = $this->db->get_where('iuran', ['bulan_bayar' => $bulanBayar, 'tahun' => $tahunBayar])->row_array();

                if (!$cek) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        data iuran untuk bulan <strong>' . $bulanBayar . '</strong> tahun <strong>' . $tahunBayar . '</strong> belum di tambah, silahkan lakukan tambah data</div>');
                redirect('bayar_siswa');
                } else {

                $sisa   = $cek['jmlh_bayar_lunas'] - $jumlahBayar;

                if ($sisa <= 0) {
                        $status = 'Lunas';
                } else {
                        $status = 'Belum Lunas';
                }
                }

                $data = [
                'id_siswa'          => $this->input->post('id', true),
                'bulan_bayar'       => $this->input->post('bulan_bayar', true),
                'tahun_bayar'       => $this->input->post('tahun_bayar', true),
                'email'             => $this->session->userdata('email', true),
                'jmlh_bayar'        => $this->input->post('jmlh_bayar', true),
                'status'            => $status,
                'sisa'              => $sisa,
                'tgl_bayar'         => time(),
                'nama_petugas'      => $this->input->post('nama_petugas', true)
                ];

                $this->Siswa_model->siswa_transaksi($data);

                $id = $this->input->post('id');
                $trans = $this->Siswa_model->get_trans_siswa();
                $trans_belum_lunas = $this->Siswa_model->get_belum_trans_siswa();
                foreach ($trans as $key => $lunas) {
                }
                foreach ($trans_belum_lunas as $key => $belum_lunas) {
                }
                if ($lunas) {
                    $data_siswa = $this->Siswa_model->getSiswaById($id);
                    $this->akun_model->update_siswa($data_siswa);
                } elseif ($belum_lunas) {
                    $data_siswa = $this->Siswa_model->getSiswaById($id);
                    $this->akun_model->update_siswa_lunas($data_siswa);
                }

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Selamat, Transaksi Berhasil!</div>
                        ');
                redirect('bayar_siswa');
            }
                
        }
    }
    
    public function bayar_sisa()
    {
        $id = $this->input->post('id_trans');
        $result = $this->Siswa_model->get_trans($id);
        if (!$result) {
                redirect('bayar_siswa');
            }else{
                $data['title'] = 'Data Transaksi';
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $data['transaksi'] = $result;
                $data['siswa'] = $this->Siswa_model->get_data_siswa();

                $this->form_validation->set_rules('sisa', 'Sisa bayar', 'required|trim|numeric|integer');

                if ($this->form_validation->run() == false) {
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/sidebar', $data);
                        $this->load->view('templates/topbar', $data);
                        $this->load->view('siswa/bayar_siswa', $data);
                        $this->load->view('templates/footer', $data);
                }else{
                        $jumlahBayar = $this->input->post('jmlh_bayar');
                        $sisa     = $this->input->post('sisa');

                        $total_bayar = $jumlahBayar + $sisa;
                        $data = [
                                'id_trans'=>$this->input->post('id_trans', true),
                                'jmlh_bayar'=> $total_bayar,
                                'sisa' => 0,
                                'status'            => "Lunas",

                        ];
                        $this->Siswa_model->update_total_bayar($data);
                        $id = $this->input->post('id');
                        $data_siswa = $this->Siswa_model->getSiswaById($id);
                        $this->akun_model->update_siswa_bayar($data_siswa);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Selamat, Transaksi Berhasil!</div>
                        ');
                        redirect('bayar_siswa');
                }
            } 
    }

    public function transaksi()
    {
        $data['title'] = 'Data Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->Siswa_model->get_data_sisa();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/bayar_sisa', $data);
        $this->load->view('templates/footer', $data);
    }
}