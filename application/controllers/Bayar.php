<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bayar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bayar_model');
    }

    public function index()
    {
        $data['title'] = 'Bayar SPP';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->Bayar_model->get_data_bayar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/bayar', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function bukti($id)
    {
        $this->load->library('dompdf_gen');

        $data['transaksi'] = $this->Bayar_model->get_cetak($id);
        $this->load->view('user/cetak_bukti', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Bukti Pembayaran SPP Online.pdf", array('Attachment' => 0));
    }
}
