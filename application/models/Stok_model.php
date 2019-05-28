<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_model extends CI_Model

{

    public function __construct()
    {
        parent::__construct();
    }

    function data_list()
    {
        $hasil = $this->db->get('item');
        return $hasil->result();
    }

    public function get_by_id($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('item');

        return $query->row();
    }


    public function get_stok()
    {
        $query = $this->db->get('v_stok');
        return $query->result_array();
    }




    public function save($data)
    {
        $this->db->insert('item', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('item', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('item');
    }
}
