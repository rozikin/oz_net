<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('Ajax_model');
    }


    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Ajax';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ajax/index');
        $this->load->view('templates/footer');
    }

    function product_data()
    {



        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->get("mahasiswa");


        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nrp;
            $row[] = $r->nama;
            $row[] = $r->email;
            $row[] = $r->jurusan;


            if ($r->image)
                $row[] = '<a href="' . base_url('assets/img/mahasiswa/' . $r->image) . '" target="_blank"><img src="' . base_url('assets/img/mahasiswa/' . $r->image) . '" class="img-responsive" width="30px" height="30px" /></a>';
            else
                $row[] = '(No photo)';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $r->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

    public function edit_mhs($id)
    {
        $data = $this->Ajax_model->get_by_id($id);

        echo json_encode($data);
    }


    public function add_data()
    {
        $this->_validate();

        $data = array(
            'nrp' => $this->input->post('nrp'),
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'jurusan' => $this->input->post('jurusan'),

        );

        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }

        $insert = $this->Ajax_model->save($data);

        echo json_encode(array("status" => TRUE));
    }


    public function update_data()
    {
        $this->_validate();
        $data = array(
            'nrp' => $this->input->post('nrp'),
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'jurusan' => $this->input->post('jurusan'),

        );

        if ($this->input->post('remove_photo')) // if remove photo checked
            {
                if (file_exists('assets/img/mahasiswa/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                    unlink('assets/img/mahasiswa/' . $this->input->post('remove_photo'));
                $data['image'] = '';
            }

        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $person = $this->Ajax_model->get_by_id($this->input->post('id'));
            if (file_exists('assets/img/mahasiswa/' . $person->image) && $person->image)
                unlink('assets/img/mahasiswa/' . $person->image);

            $data['image'] = $upload;
        }

        $this->Ajax_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }




    public function delete_datax($id)
    {
        //delete file
        $person = $this->Ajax_model->get_by_id($id);
        if (file_exists('assets/img/mahasiswa/' . $person->image) && $person->image)
            unlink('assets/img/mahasiswa/' . $person->image);

        $this->Ajax_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }














    private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/mahasiswa/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte

        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) //upload and validate
            {
                $data['inputerror'][] = 'image';
                $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
                $data['status'] = FALSE;
                echo json_encode($data);
                exit();
            }
        return $this->upload->data('file_name');
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nrp') == '') {
            $data['inputerror'][] = 'nrp';
            $data['error_string'][] = 'nrpis required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jurusan') == '') {
            $data['inputerror'][] = 'jurusan';
            $data['error_string'][] = 'Please select jurusan';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
