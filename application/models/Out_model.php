<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Out_model extends CI_Model

{

    public function __construct()
    {
        parent::__construct();
    }



    function data_list()
    {
        $this->db->order_by('id','DESC');
        $hasil = $this->db->get('item');
        return $hasil->result();
    }


    public function getAllitem()
    {
        
        
        $query = $this->db->get('v_stok');

         return $query->result_array();
    }


    public function getAllsupplier()
    {
        return $this->db->get('employee')->result_array();
    }


    public function get_by_id($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('v_material_out');

        return $query->row();
    }



    function buat_kode()
    {
        $this->db->select('RIGHT(material_out.kode_out,4) as kode', FALSE);
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('material_out');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $tgl = date('dmY');
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "OUT"  . $tgl  . $kodemax;
        return $kodejadi;
    }

    public function saves($data)
    {
        $this->db->insert('material_out', $data);
        return $this->db->insert_id();
    }


    public function getID($id)
    {
        return $this->db->get_where('v_material_out',  ['id' => $id])->row_array();
    }



    public function update($where, $data)
    {
        $this->db->update('item', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('material_out');
    }
}
