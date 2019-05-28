<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Out extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Out_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Sale';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('out/index');
        $this->load->view('templates/footer');
    }

    public function kode_otomatis()
    {
        $data =  $this->Out_model->buat_kode();

        echo json_encode($data);
    }

    public function product_data()
    {


        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('v_material_out');

        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {



            if ($r->pembayaran == 1) {
                $paid_status = '<h6><span class="badge badge-success">Lunas</span></h6>';
            } else {
                $paid_status = '<h6><span class="badge badge-danger">Hutang</span></h6>';
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode_out;
            $row[] = $r->tanggal;

            $row[] = $r->nama_barang;
            $row[] = $r->nama;
            $row[] = $r->jumlah;
            $row[] = $r->total;
            $row[] = $paid_status;
            $row[] = $r->user_id;



            //add html for action
            $row[] = '<a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $r->id . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
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





    public function add_form()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Sale';

        $data['item'] = $this->Out_model->getAllitem();
        $data['employee'] = $this->Out_model->getAllsupplier();
        $data['kodeotomatis'] =  $this->Out_model->buat_kode();


        $this->form_validation->set_rules('tabels', 'Tabels', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('out/add', $data);
            $this->load->view('templates/footer');
        } else {

            $user_id = $this->session->userdata('email');
            for ($count = 0; $count < count($_POST['hidden_kd_brg']); $count++) {


                $data = array(
                    'kode_out' => $this->input->post('kode_out'),
                    'tanggal' => $this->input->post('dates'),
                    'kode_barang' => $_POST['hidden_kd_brg'][$count],
                    'nik' => $_POST['hidden_nik'][$count],
                    'jumlah' => $_POST['hidden_jumlah'][$count],
                    'total' => $_POST['hidden_total'][$count],
                    'pembayaran' => 2,
                    'keterangan' => $this->input->post('keterangan'),
                    'user_id' => $user_id,
                );

                $insert = $this->Out_model->saves($data);

                $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data added</div>');
            }
            redirect('out');
        }
    }


    public function delete_datax($id)
    {
        //delete fil

        $this->Out_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    public function edit_data($id)
    {

        $data = $this->Out_model->get_by_id($id);

        echo json_encode($data);
    }


    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['in'] = $this->Out_model->getID($id);
        $data['items'] = $this->Out_model->getAllitem();
        $data['employee'] = $this->Out_model->getAllsupplier();




        $this->form_validation->set_rules('kode_out', 'kode_out', 'required');
        $this->form_validation->set_rules('dates', 'Dates', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('kode_barang', 'Kode_barang', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('out/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_out' => $this->input->post('kode_out'),
                'tanggal' => $this->input->post('dates'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_barang' => $this->input->post('kode_barang'),
                'nik' => $this->input->post('nik'),
                'jumlah' => $this->input->post('jumlah')
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('material_out', $data);

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data edited</div>');
            redirect('out');
        }
    }
}
