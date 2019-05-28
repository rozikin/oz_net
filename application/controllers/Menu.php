<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
    }


    public function index()
    {
        $data['title'] = 'Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New Menu added</div>');
            redirect('menu');
        }
    }

    public function menu_edit($id)
    {
        $data['title'] = 'Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->Menu_model->menuID($id);


        $this->form_validation->set_rules('menu', 'Menu', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/menu_edit', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Menu_model->editDataMenu();


            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">menu edited</div>');
            redirect('menu');
        }
    }

    public function hapus_menu($id)
    {

        $this->Menu_model->hapusDataMenu($id);

        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Menu Deleted</div>');
        redirect('menu');
    }



    public function submenu()
    {
        $data['title'] = 'Submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //konek model
        $this->load->model('Menu_model', 'menu');
        $data['submenu'] = $this->menu->getsubmenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New Submenu added</div>');
            redirect('menu/submenu');
        }
    }



    public function hapus_submenu($id)
    {
        $this->load->model('Menu_model');
        $this->Menu_model->hapussubmenu($id);

        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('menu/submenu');
    }

    public function sub_edit($id)
    {
        $data['title'] = 'Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['subsmenu'] = $this->Menu_model->getID($id);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/sub_edit', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Menu_model->editData();


            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Submenu edited</div>');
            redirect('menu/submenu');
        }
    }
}
