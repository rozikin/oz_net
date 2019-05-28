<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skatch_model extends CI_Model

{

    public function __construct()
    {
        parent::__construct();
    }


    function data_list()
    {
        $hasil = $this->db->get('skatch');
        return $hasil->result();
    }

    public function getID($id)
    {
        return $this->db->get_where('skatch',  ['id' => $id])->row_array();
    }

    function gets_sm()
    { {
            $sm = 'SM';
            $sql = "SELECT type FROM skatch WHERE type = '$sm'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
    }

    function gets_sfm()
    { {
            $sfm = 'SFM';
            $sql = "SELECT type FROM skatch WHERE type = '$sfm'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
    }

    function gets_fm()
    { {
            $fm = 'FM';
            $sql = "SELECT type FROM skatch WHERE type = '$fm'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
    }




    public function get_by_id($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('skatch');

        return $query->row();
    }


    function data($number, $offset)
    {
        return $query = $this->db->get('skatch', $number, $offset)->result();
    }

    function jumlah_data()
    {
        return $this->db->get('skatch')->num_rows();
    }

    //ambil data mahasiswa dari database
    function get_dataAll_list($limit, $start)
    {
        $query = $this->db->get('skatch', $limit, $start);
        return $query;
    }


    public function searchRecord($key)
    {
        $this->db->select('*');
        $this->db->from('skatch');
        $this->db->like('buyer', $key);
        $this->db->or_like('style', $key);
        $this->db->or_like('id', $key);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
    }

    public function getbuyer()
    {
        return $this->db->get('buyer')->result_array();
    }

    public function getfactory()
    {
        return $this->db->get('factory')->result_array();
    }



    public function save($data)
    {
        $this->db->insert('skatch', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('skatch', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('skatch');
    }

    public function get_skatch()
    {
        $query = $this->db->get('skatch');
        return $query->result_array();
    }
}
