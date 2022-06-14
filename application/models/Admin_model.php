<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get_total_siswa()
    {
        return $this->db->get('data_siswa')->num_rows();
    }
    public function get_total_transaksi()
    {
        return $this->db->get('transaksi')->num_rows();
    }
}