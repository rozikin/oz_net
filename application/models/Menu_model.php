<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model

{
    public function menuID($id)
    {
        return $this->db->get_where('user_menu',  ['id' => $id])->row_array();
    }

    public function getsubmenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`    
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id` ";


        return $this->db->query($query)->result_array();
    }


    public function editDataMenu()
    {
        $data = [
            'menu' => $this->input->post('menu'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function hapusDataMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

 

    public function getID($id)
    {
        return $this->db->get_where('user_sub_menu',  ['id' => $id])->row_array();
    }

    public function hapussubmenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function editData()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }
}
