<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bayar_model extends CI_Model
{
    public function get_data()
    {
        $query    = "SELECT * FROM transaksi WHERE status='Lunas'";

        return $this->db->get('transaksi')->result_array();
    }

    public function get_data_bayar()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('status = "Lunas"');
        $this->db->order_by('id_trans', 'desc');
        return $this->db->get()->result();;
    }

    public function get_cetak($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_trans', $id);
        return $this->db->get()->row();
    }
}
