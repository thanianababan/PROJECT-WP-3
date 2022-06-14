<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{ 

    public function getAllSiswa()
    {
        $query = "SELECT *
                    FROM `kelas` JOIN `data_siswa`
                      ON `kelas`.`id_kelas` = `data_siswa`.`kelas_id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function get_data_sisa()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('data_siswa', 'data_siswa.id = transaksi.id_siswa', 'left');
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->order_by('transaksi.id_trans', 'desc');

        return $this->db->get()->result_array();
        
    }


    public function get_All_Siswa()
    {
        $this->db->select('*');
        $this->db->from('data_siswa');
        $this->db->join('kelas', 'kelas.id_kelas = data_siswa.kelas_id', 'left');
        $this->db->join('user', 'user.id = data_siswa.id_user', 'left');
        $this->db->order_by('data_siswa.id', 'desc');

        return $this->db->get()->result_array();
        
    }

    public function get_data_siswa()
    {
        $this->db->select('*');
        $this->db->from('data_siswa');
        $this->db->join('kelas', 'kelas.id_kelas = data_siswa.kelas_id', 'left');
        $this->db->where('email_siswa', $this->session->userdata('email'));
        $this->db->order_by('data_siswa.id', 'desc');

        return $this->db->get()->result_array();
    }
    public function getAllKelas()
    {
        return $this->db->get('kelas')->result_array();
    }

    public function update_total_bayar($data)
    {
        $this->db->where('id_trans', $data['id_trans']);
        $this->db->update('transaksi', $data);
    }

    public function getAllTransaksi()
    {
        $query = "SELECT *
                    FROM `data_siswa` JOIN `transaksi`
                      ON `data_siswa`.`id`= `transaksi`.`id_siswa` 
        ";

        return $this->db->query($query)->result_array();
    }

    public function getTransaksi()
    {
        return $this->db->get('transaksi')->result_array();
    }

    public function getAllIuran()
    {
        return $this->db->get('iuran')->result_array();
    }

    public function getSiswaByNik($nik)
    {
        return $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();
    }

    public function get_trans($id)
    {
        return $this->db->get_where('transaksi', ['id_trans' => $id])->row_array();
    }
    public function get_trans_siswa()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->where('status = "Belum Lunas"');

        return $this->db->get()->result();
    }

    public function get_belum_trans_siswa()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->where('status = "Lunas"');

        return $this->db->get()->result();
    }

    public function getSiswaById($id)
    {
        return $this->db->get_where('data_siswa', ['id' => $id])->row_array();
    }

    public function tambahSiswa()
    {
        $data = [
            'nik'              => $this->input->post('nik', true),
            'nok'              => $this->input->post('nok', true),
            'nama_siswa'       => $this->input->post('nama_siswa', true),
            'jenis_kelamin'    => $this->input->post('jenis_kelamin', true),
            'kelas_id'         => $this->input->post('kelas_id', true),
            'nama_ayah'        => $this->input->post('nama_ayah', true),
            'nama_ibu'         => $this->input->post('nama_ibu', true),
            'alamat_ortu'      => $this->input->post('alamat_ortu', true)
        ];

        $this->db->insert('data_siswa', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, Data Siswa Berhasil Ditambah!</div>
            ');
        redirect('siswa');
    }

    public function tambahTransaksi($data)
    {

        $this->db->insert('transaksi', $data); 
    }
    public function siswa_transaksi($data)
    {
        $this->db->insert('transaksi', $data);  
    }


    public function editSiswa($nik)
    {
        $data = [
            'nik'           => $this->input->post('nik', true),
            'nok'           => $this->input->post('nok', true),
            'nama_siswa'    => $this->input->post('nama_siswa', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'kelas_id'      => $this->input->post('kelas_id', true),
            'nama_ayah'     => $this->input->post('nama_ayah', true),
            'nama_ibu'      => $this->input->post('nama_ibu', true),
            'alamat_ortu'   => $this->input->post('alamat_ortu', true)
        ];

        $this->db->set($data);
        $this->db->where('nik', $nik);
        $this->db->update('data_siswa', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, Data Siswa Berhasil Diubah!</div>
            ');
        redirect('siswa');
    }

    public function hapusSiswa($nik)
    {
        $result = $this->db->get_where('data_siswa', ['nik' => $nik])->row_array();

        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data Siswa Gagal Dihapus, Data Tidak Ditemukan!</div>
                ');
            redirect('siswa');
        } else {
            $this->db->where('nik', $nik);
            $this->db->delete('data_siswa');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Selamat, Data Siswa Berhasil Dihapus!</div>
                ');
            redirect('siswa');
        }
    }
    
    public function hapusTransaksi($id_siswa)
    {
        $result = $this->db->get_where('transaksi', ['id_siswa' => $id_siswa])->row_array();

        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Transaksi Siswa Gagal Dihapus, Transaksi Tidak Ditemukan!</div>
                ');
            redirect('siswa');
        } else {
            $this->db->where('id_siswa', $id_siswa) ;
            $this->db->delete('transaksi');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Selamat, Transaksi Siswa Berhasil Dihapus!</div>
                ');
            redirect('siswa');
        }
    }
    
}
