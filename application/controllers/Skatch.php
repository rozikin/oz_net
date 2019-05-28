<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skatch extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('Skatch_model');
        $this->load->library('pagination');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Skatch';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('skatch/index', $data);
        $this->load->view('templates/footer');
    }


    public function get_sm()
    {
        $data = $this->Skatch_model->gets_sm();
        echo json_encode($data);
    }

    public function get_sfm()
    {
        $data = $this->Skatch_model->gets_sfm();
        echo json_encode($data);
    }
    public function get_fm()
    {
        $data = $this->Skatch_model->gets_fm();
        echo json_encode($data);
    }


    function product_data()
    {

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->get("skatch");


        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->date_analisa;
            $row[] = $r->buyer;
            $row[] = $r->style;
            $row[] = $r->qty;
            $row[] = $r->cm;
            $row[] = $r->dcd;
            $row[] = $r->factory;
            $row[] = $r->type;
            $row[] = $r->total_process;
            $row[] = $r->operator;
            $row[] = $r->helper;
            $row[] = $r->total_manpower;
            $row[] = $r->smv;
            $row[] = $r->loss;
            $row[] = $r->total_smv;
            $row[] = $r->efficiency;
            $row[] = $r->work_hour;
            $row[] = $r->target;


            if ($r->image)
                $row[] = '<a href="' . base_url('assets/img/skatch/' . $r->image) . '" target="_blank"><img src="' . base_url('assets/img/skatch/' . $r->image) . '" class="img-responsive" width="20px" height="20px" /></a>';
            else
                $row[] = '(No photo)';

            //add html for action
            $row[] = '<a class="badge badge-success"  href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $r->id . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
            <a  class="badge badge-danger" btn-sm" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';


            $data[] = $row;
        };


        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),

            "data" => $data
        );


        echo json_encode($result);

        exit();
    }


    public function all_data()
    {
        $data['title'] = 'Skatch All';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //konek model

        //konfigurasi pagination
        $config['base_url'] = site_url('skatch/all_data'); //site url
        $config['total_rows'] = $this->db->count_all('skatch'); //total row
        $config['per_page'] = 6;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['data'] = $this->Skatch_model->get_dataAll_list($config['per_page'], $data['page']);

        $data['pagination'] = $this->pagination->create_links();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('skatch/all_data', $data);
        $this->load->view('templates/footer');
    }

    public function searchUser()
    {
        $data['title'] = 'Skatch All';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $key = $this->input->post('search');

        if (isset($key) and !empty($key)) {
            $data['data'] = $this->Skatch_model->searchRecord($key);
            $data['pagination'] = '';
            $data['message'] = 'Search Results';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('skatch/all_data', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('skatch/all_data');
        }
    }




    public function add_form()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Add Skatch';
        $data['buyers'] = $this->Skatch_model->getbuyer();
        $data['factorys'] = $this->Skatch_model->getfactory();


        $this->form_validation->set_rules('buyer', 'Buyer', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('skatch/add');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'date_analisa' => $this->input->post('date_analisa'),
                'buyer' => $this->input->post('buyer'),
                'style' => $this->input->post('style'),
                'qty' => $this->input->post('qty'),
                'cm' => $this->input->post('cm'),
                'dcd' => $this->input->post('dcd'),
                'factory' => $this->input->post('factory'),
                'type' => $this->input->post('type'),
                'total_process' => $this->input->post('total_process'),
                'operator' => $this->input->post('op'),
                'helper' => $this->input->post('hp'),
                'total_manpower' => $this->input->post('total_manpower'),
                'smv' => $this->input->post('smv'),
                'loss' => $this->input->post('loss'),
                'total_smv' => $this->input->post('total_smv'),
                'efficiency' => $this->input->post('efficiency'),
                'work_hour' => $this->input->post('wh'),
                'target' => $this->input->post('target')

            ];

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = '20148';
                $config['upload_path']   = './assets/img/skatch';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/skatch/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->insert('skatch', $data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">New skatch added</div>');
            redirect('skatch');
        }
    }

    public function delete_datax($id)
    {
        //delete file
        $person = $this->Skatch_model->get_by_id($id);
        if (file_exists('assets/img/skatch/' . $person->image) && $person->image)
            unlink('assets/img/skatch/' . $person->image);

        $this->Skatch_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['skatch'] = $this->Skatch_model->getID($id);
        $data['buyers'] = $this->Skatch_model->getbuyer();
        $data['factorys'] = $this->Skatch_model->getfactory();




        $this->form_validation->set_rules('buyer', 'Buyer', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('skatch/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'date_analisa' => $this->input->post('date_analisa'),
                'buyer' => $this->input->post('buyer'),
                'style' => $this->input->post('style'),
                'qty' => $this->input->post('qty'),
                'cm' => $this->input->post('cm'),
                'dcd' => $this->input->post('dcd'),
                'factory' => $this->input->post('factory'),
                'type' => $this->input->post('type'),
                'total_process' => $this->input->post('total_process'),
                'operator' => $this->input->post('op'),
                'helper' => $this->input->post('hp'),
                'total_manpower' => $this->input->post('total_manpower'),
                'smv' => $this->input->post('smv'),
                'loss' => $this->input->post('loss'),
                'total_smv' => $this->input->post('total_smv'),
                'efficiency' => $this->input->post('efficiency'),
                'work_hour' => $this->input->post('wh'),
                'target' => $this->input->post('target')

            ];


            $this->db->where('id', $this->input->post('id'));
            $this->db->update('skatch', $data);

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data edited</div>');
            redirect('skatch');
        }
    }

    public function cetak()
    {
        $this->load->library('mypdf');
        $data['data'] = $this->db->get('skatch');
        $this->mypdf->generate('skatch/cetak', $data, 'laporan-skatch', 'A4', 'landscape');
    }
}
