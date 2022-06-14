<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('*');
        $this->db->from('user');    
        $this->db->where('role_id = 2');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
        
    }
    public function simpan_akun($data)
    {
        $this->db->insert('user', $data);
        
    }
    public function simpan_akun_siswa($data_siswa)
    {
        $data = [
            'status_akun' => 3,
            'date_created' => time(),
            'email_siswa' => $this->input->post('email'),
        ];
        
        $this->db->set($data);
        $this->db->where('id', $data_siswa['id']);
        $this->db->update('data_siswa', $data);
    }


    public function update_siswa($result)
    {
        $data = [
            'status_akun' => 1,
        ];

        $this->db->set($data);
        $this->db->where('id', $result['id']);
        $this->db->update('data_siswa', $data);
    }

    public function update_siswa_lunas($data_siswa)
    {
        $data = [
            'status_akun' => 2,
        ];

        $this->db->set($data);
        $this->db->where('id', $data_siswa['id']);
        $this->db->update('data_siswa', $data);
    }

    public function update_siswa_bayar($data_siswa)
    {
        $data = [
            'status_akun' => 2,
        ];

        $this->db->set($data);
        $this->db->where('id', $data_siswa['id']);
        $this->db->update('data_siswa', $data);
    }
}