<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance_model extends CI_Model

{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_by_id($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('factory');

        return $query->row();
    }

    function cari_id()
    { {
            $sfm = 'SFM';
            $sql = "SELECT type FROM skatch WHERE type = '$sfm'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
    }



    public function save($data)
    {
        $this->db->insert('attendance', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('factory', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('factory');
    }
}
