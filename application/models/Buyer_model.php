<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buyer_model extends CI_Model

{

    public function __construct()
    {
        parent::__construct();
    }

    function data_list()
    {
        $hasil = $this->db->get('buyer');
        return $hasil->result();
    }

    public function get_by_id($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('buyer');

        return $query->row();
    }



    function buat_kode()
    {
        $this->db->select('RIGHT(buyer.kode,3) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('buyer');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = "B" . $kodemax;
        return $kodejadi;
    }

    public function save($data)
    {
        $this->db->insert('buyer', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('buyer', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('buyer');
    }
}
