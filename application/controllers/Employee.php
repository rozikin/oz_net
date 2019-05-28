<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Employee_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Employee';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('employee/index');
        $this->load->view('templates/footer');
    }


    public function kode_otomatis()
    {
        $data =  $this->Employee_model->buat_kode();

        echo json_encode($data);
    }

    public function product_data()
    {

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('employee');

        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nik;
            $row[] = $r->ktp;
            $row[] = $r->nama;
            $row[] = $r->department;
            $row[] = $r->bagian;
            $row[] = $r->jabatan;
            $row[] = $r->jenis_kelamin;
            $row[] = $r->tempat_lahir;
            $row[] = $r->tgl_lahir;


            //add html for action
            $row[] = '<a class="badge badge-info" href="javascript:void(0)" title="Detail" onclick="detail_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-info"></i> Detail</a>
            <a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $r->id . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
            <a class="badge badge-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';

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




    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Add Employee';




        $this->form_validation->set_rules('nik', 'Nik', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('employee/add', $data);
            $this->load->view('templates/footer');
        } else {


            $data = array(
                'nik' => $this->input->post('nik'),
                'ktp' => $this->input->post('ktp'),
                'nama' => $this->input->post('nama'),
                'department' => $this->input->post('department'),
                'bagian' => $this->input->post('bagian'),
                'jabatan' => $this->input->post('jabatan'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'umur' => $this->input->post('umur'),
                'size_baju' => $this->input->post('size_baju'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'tgl_habis_kontrak' => $this->input->post('tgl_habis_kontrak'),
                'status' => $this->input->post('status'),
                'tgl_penggajian' => $this->input->post('tgl_penggajian'),
                'keterangan' => $this->input->post('keterangan'),
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat')

            );

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = '20148';
                $config['upload_path']   = './assets/img/employee';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/employee/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $insert = $this->Employee_model->saves($data);

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data added</div>');
            redirect('employee');
        }
    }


    public function delete_datax($id)
    {
        //delete fil


        $this->Employee_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    public function edit_data($id)
    {

        $data = $this->Employee_model->get_by_id($id);

        echo json_encode($data);
    }


    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['employee'] = $this->Employee_model->getID($id);




        $this->form_validation->set_rules('nik', 'Nik', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('employee/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nik' => $this->input->post('nik'),
                'ktp' => $this->input->post('ktp'),
                'nama' => $this->input->post('nama'),
                'department' => $this->input->post('department'),
                'bagian' => $this->input->post('bagian'),
                'jabatan' => $this->input->post('jabatan'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'umur' => $this->input->post('umur'),
                'size_baju' => $this->input->post('size_baju'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'tgl_habis_kontrak' => $this->input->post('tgl_habis_kontrak'),
                'status' => $this->input->post('status'),
                'tgl_penggajian' => $this->input->post('tgl_penggajian'),
                'keterangan' => $this->input->post('keterangan'),
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat')

            );

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = '20148';
                $config['upload_path']   = './assets/img/employee';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/employee/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('employee', $data);

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data edited</div>');
            redirect('employee');
        }
    }

    public function detail_data($id)
    {

        $data = $this->Employee_model->get_by_id($id);

        echo json_encode($data);
    }


    public function detail($id)
    {
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['employees'] = $this->Employee_model->getID($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('employee/detail', $data);
        $this->load->view('templates/footer');
    }
}
