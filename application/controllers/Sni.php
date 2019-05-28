<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sni extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Sni_model');
    }


    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Sni Video';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('sni/index');
        $this->load->view('templates/footer');
    }

    function data_all()
    {


        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->get("sni");


        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->process_name;
            $row[] = $r->remark;
            $row[] = $r->category;
            $row[] = $r->smv;

            if ($r->image)
                $row[] = '<a href="' . base_url('assets/img/sni/' . $r->image) . '" target="_blank"><img src="' . base_url('assets/img/sni/' . $r->image) . '" class="img-responsive" width="80px" height="30px" /></a>';
            else
                $row[] = '(No photo)';

            $row[] = '<a class="badge badge-info"  href="javascript:void(0)" title="Play" onclick="play_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-play-circle"></i> Play</a>';

            //add html for action
            $row[] = '<a class="badge badge-success"  href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
            <a class="badge badge-danger"  href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';

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
        $data = $this->Sni_model->get_by_id($id);

        echo json_encode($data);
    }



    public function play_video($id)
    {
        $data = $this->Sni_model->get_by_id($id);

        echo json_encode($data);
    }


    public function add_data()
    {
        $this->_validate();

        $data = array(
            'process_name' => $this->input->post('name'),
            'remark' => $this->input->post('remark'),
            'category' => $this->input->post('category'),
            'smv' => $this->input->post('smv'),

        );

        if (!empty($_FILES['image']['name']) && (!empty($_FILES['video']['name']))) {
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '3000';
            $config['upload_path'] = './assets/img/sni';
            $config['file_name'] = uniqid();

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                echo $this->upload->display_errors();
            } else {
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);

                if ($_FILES['video']['name']) {
                    $config['allowed_types'] = 'mp4';
                    $config['max_size'] = '9000148';
                    $config['upload_path'] = './assets/img/sni';
                    $config['file_name'] = uniqid();

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('video')) {
                        echo $this->upload->display_errors();
                    } else {
                        $new_video = $this->upload->data('file_name');
                        $this->db->set('video', $new_video);

                        $this->Sni_model->save($data);
                        echo json_encode(array("status" => TRUE));
                    }
                }
            }
        }
    }





    public function update_data()
    {
        $this->_validate();
        $data = array(
            'process_name' => $this->input->post('name'),
            'remark' => $this->input->post('remark'),
            'category' => $this->input->post('category'),
            'smv' => $this->input->post('smv'),

        );


        if ($this->input->post('remove_photo')) //ifremovephotochecked
        {
            if (file_exists('assets/img/sni/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/img/sni/' . $this->input->post('remove_photo'));
        }

        if ($_FILES['image']['name']) {
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '3000';
            $config['upload_path'] = './assets/img/sni';
            $config['file_name'] = uniqid();

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                echo $this->upload->display_errors();
            } else {
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            }
        }


        if ($this->input->post('remove_video')) //ifremovevideochecked
        {
            if (file_exists('assets/img/sni/' . $this->input->post('remove_video')) && $this->input->post('remove_video'))
                unlink('assets/img/sni/' . $this->input->post('remove_video'));
        }



        if ($_FILES['video']['name']) {
            $config['allowed_types'] = 'mp4';
            $config['max_size'] = '9000148';
            $config['upload_path'] = './assets/img/sni';
            $config['file_name'] = uniqid();

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('video')) {
                echo $this->upload->display_errors();
            } else {
                $new_video = $this->upload->data('file_name');
                $this->db->set('video', $new_video);
            }
        }

        $this->Sni_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }




    public function delete_datax($id)
    {
        //deletefile
        $person = $this->Sni_model->get_by_id($id);
        if (file_exists('assets/img/sni/' . $person->image) && $person->image)
            unlink('assets/img/sni/' . $person->image);

        if (file_exists('assets/img/sni/' . $person->video) && $person->video)
            unlink('assets/img/sni/' . $person->video);

        $this->Sni_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }














    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'nameisrequired';
            $data['status'] = FALSE;
        }

        if ($this->input->post('remark') == '') {
            $data['inputerror'][] = 'remark';
            $data['error_string'][] = 'remarkisrequired';
            $data['status'] = FALSE;
        }

        if ($this->input->post('category') == '') {
            $data['inputerror'][] = 'category';
            $data['error_string'][] = 'categoryisrequired';
            $data['status'] = FALSE;
        }

        if ($this->input->post('smv') == '') {
            $data['inputerror'][] = 'smv';
            $data['error_string'][] = 'Pleaseselectsmv';
            $data['status'] = FALSE;
        }



        if ($data['status'] === FALSE) {
            echojson_encode($data);
            exit();
        }
    }
}
