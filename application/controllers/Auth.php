<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('akun_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pembayaran SPP Online';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');

        } else {
            // jika validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //jika User ada
        if ($user) {
            // jika user aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Selamat, Anda Berhasil Login!</div>
                    ');
                        redirect('admin');
                    } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Selamat, Anda Berhasil Login!</div>
                    ');
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Maaf, Password Salah!</div>
                    ');
                    redirect('auth');
                }
            }
        } else {
            //user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Maaf, Email Ini Belum Diregistrasi!</div>
            ');
            redirect('auth');
        }
    }
            
    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email[user.email]', [
            'required' => 'email tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'password tidak boleh kosong!',
            'matches' => 'password tidak cocok!',
            'min_length'    => 'password minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->library('form_validation');
            $this->load->view('templates/auth_header');
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            $this->akun_model->simpan_akun($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, Akun Telah Berhasil Dibuat! Silakan Login</div>
            ');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('rol_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, Anda Berhasil Logout!</div>');
        redirect('auth');
    }
    
   public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            // hapus sesi change password
            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password Berhasil Diganti, Silahkan Login Kembali!</div>
            ');
            redirect('auth');
        }
    }
    
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
    
}