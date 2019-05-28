<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_model extends CI_Model

{

    public function __construct()
    {
        parent::__construct();
    }

    function data_list()
    {
        $hasil = $this->db->get('mahasiswa');
        return $hasil->result();
    }

    public function get_by_id($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('mahasiswa');

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('mahasiswa', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('mahasiswa', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }
}
