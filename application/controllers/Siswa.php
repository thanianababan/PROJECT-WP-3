<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
        $data['siswa'] = $this->Siswa_model->getAllSiswa();
        $data['akun'] = $this->akun_model->getAllData();
        $data['kelas'] = $this->Siswa_model->getAllKelas();
        $data['iuran'] = $this->Siswa_model->getAllIuran();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer', $data);
        
    }

    public function tambahSiswa()
    {
        $data['title'] = 'Tambah Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->Siswa_model->getAllKelas();

        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|integer[data_siswa.nik]', [
            'required' => 'NIK tidak Boleh Kosong!',
            'numeric'  => 'NIK harus berupa angka!',
            'integer'  => 'NIK hanya berupa bilangan bulat',
            
        ]);
        $this->form_validation->set_rules('nok', 'NO KK', 'required|trim|numeric|integer', [
            'required' => 'No KK tidak Boleh Kosong!',
            'integer' => 'No KK hanya berupa bilangan bulat!',
            'numeric'  => 'No KK harus berupa angka!'
        ]);

        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim', [
            'required' => 'Nama siswa tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'jenis kelamin harus dipilih'
        ]);
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required', [
            'required' => 'kelas harus dipilih'
        ]);
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required|trim', [
            'required' => 'Nama ibu tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/tambahsiswa', $data);
            $this->load->view('templates/footer', $data);
        } else {
            //insert data siswa
            $this->Siswa_model->tambahSiswa();
        }
    }

    public function register_akun()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->Siswa_model->getAllSiswa();
        $data['akun'] = $this->akun_model->getAllData();
        $data['kelas'] = $this->Siswa_model->getAllKelas();
        $data['iuran'] = $this->Siswa_model->getAllIuran();
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email[user.email]', [
            'required' => 'email tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'password tidak boleh kosong!',
            'matches' => 'password tidak cocok!',
            'min_length' => 'password minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'id_siswa' => $this->input->post('id_siswa',true),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->akun_model->simpan_akun($data);
                // simpan akun ke dalam tabel data siswa
                $id = $this->input->post('id');
                $data_siswa = $this->Siswa_model->getSiswaById($id);
                $this->akun_model->simpan_akun_siswa($data_siswa);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Selamat, Akun Siswa Berhasil Dibuat!</div>
                ');
            redirect('siswa');
        }
    }

    public function tambahtransaksi()
    {
        $id = $this->input->post('id');
        $result = $this->Siswa_model->getSiswaById($id);

        if (!$result) {
            redirect('siswa');
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
                $this->load->view('siswa/tambahtransaksi', $data);
                $this->load->view('templates/footer', $data);
            } else {

                $jumlahBayar    = $this->input->post('jmlh_bayar');
                $bulanBayar     = $this->input->post('bulan_bayar');
                $tahunBayar     = $this->input->post('tahun_bayar');
                $cek            = $this->db->get_where('iuran', ['bulan_bayar' => $bulanBayar, 'tahun' => $tahunBayar])->row_array();

                if (!$cek) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        data iuran untuk bulan <strong>' . $bulanBayar . '</strong> tahun <strong>' . $tahunBayar . '</strong> belum di tambah, silahkan lakukan tambah data</div>');
                    redirect('siswa');
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
                    'jmlh_bayar'        => $this->input->post('jmlh_bayar', true),
                    'status'            => $status,
                    'sisa'              => $sisa,
                    'tgl_bayar'         => time(),
                    'nama_petugas'      => $this->input->post('nama_petugas', true)
                ];

                $this->Siswa_model->tambahTransaksi($data);
                $id = $this->input->post('id');
                $data_siswa = $this->Siswa_model->getSiswaById($id);
                $this->akun_model->update_siswa_bayar($data_siswa);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Selamat, Data Transaksi Siswa Berhasil Ditambah!</div>
                    ');
                redirect('siswa');
            }
        }
    }

    public function hapussiswa($nik)
    {
        $this->Siswa_model->hapusSiswa($nik);
    }

    public function transaksi()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['transaksi'] = $this->Siswa_model->getAllTransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/transaksi', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function editSiswa()
    {
        $nik = $this->input->post('nik');
        $result = $this->Siswa_model->getSiswaByNik($nik);

        if ($result) {
            // jika data ada

            $data['title'] = 'Edit Data Siswa';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['siswa'] = $result;
            $data['akun'] = $this->akun_model->getAllData();
            $data['kelas'] = $this->Siswa_model->getAllKelas();

            $this->form_validation->set_rules('nok', 'NO KK', 'required|trim|numeric');
            $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
            $this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim');
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required|trim');

            if ($this->form_validation->run() == false) {

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('siswa/editsiswa', $data);
                $this->load->view('templates/footer', $data);
               
            } else {
                // Edit Data Siswa
                $this->Siswa_model->editSiswa($nik);
            }
        } else {
            // jika data tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Siswa Gagal Diupdate, Data Siswa Tidak Ditemukan!</div>
            ');
            redirect('siswa');
        }
    }

    public function print()
    {
        $data['transaksi'] = $this->Siswa_model->getAllTransaksi();
        $this->load->view('print/print_transaksi', $data);

    }

    public function pdf()    
    {
        $this->load->library('dompdf_gen');

        $data['transaksi'] = $this->Siswa_model->getAllTransaksi();
        $this->load->view('pdf/laporan_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Pembayaran SPP Siswa.pdf", array('Attachment' =>0));

    }
    
    public function hapustransaksi($id_siswa)
    {
        $this->Siswa_model->hapusTransaksi($id_siswa);
    }


}