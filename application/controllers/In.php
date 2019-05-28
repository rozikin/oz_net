<?php
defined('BASEPATH') or exit('No direct script access allowed');

class In extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('In_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Product In';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('in/index');
        $this->load->view('templates/footer');
    }



    public function kode_otomatis()
    {
        $data =  $this->In_model->buat_kode();

        echo json_encode($data);
    }

    public function product_data()
    {

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('v_material_in');

        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode_in;
            $row[] = $r->tanggal;
            $row[] = $r->kode_barang;
            $row[] = $r->nama_barang;
            $row[] = $r->jenis;
            $row[] = $r->nama;
            $row[] = $r->jumlah;
            $row[] = $r->total;


            //add html for action
            $row[] = '<a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $r->id . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
            <a class="badge badge-danger remove" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-trash"></i> Delete</a>';

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
        $data['title'] = 'Add Product in';

        $data['item'] = $this->In_model->getAllitem();
        $data['supplier'] = $this->In_model->getAllsupplier();
        $data['kodeotomatis'] =  $this->In_model->buat_kode();


        $this->form_validation->set_rules('tabels', 'Tabels', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('in/add', $data);
            $this->load->view('templates/footer');
        } else {
            for ($count = 0; $count < count($_POST['hidden_kd_brg']); $count++) {

                $data = array(
                    'kode_in' => $this->input->post('kode_in'),
                    'tanggal' => $this->input->post('dates'),
                    'kode_barang' => $_POST['hidden_kd_brg'][$count],
                    'kode_supplier' => $_POST['hidden_kd_sup'][$count],
                    'jumlah' => $_POST['hidden_jumlah'][$count],
                    'total' => $_POST['hidden_total'][$count],
                    'keterangan' => $this->input->post('keterangan')
                );

                $insert = $this->In_model->saves($data);
                $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data added</div>');
            }
            redirect('in');
        }
    }







    public function delete_datax($id)
    {
        //delete fil

        $this->In_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    public function edit_data($id)
    {

        $data = $this->In_model->get_by_id($id);

        echo json_encode($data);
    }


    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['in'] = $this->In_model->getID($id);
        $data['items'] = $this->In_model->getAllitem();
        $data['suppliers'] = $this->In_model->getAllsupplier();




        $this->form_validation->set_rules('kode_in', 'Kode_in', 'required');
        $this->form_validation->set_rules('dates', 'Dates', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('kode_barang', 'Kode_barang', 'required');
        $this->form_validation->set_rules('kode_supplier', 'Kode_supplier', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('in/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'Kode_in' => $this->input->post('kode_in'),
                'tanggal' => $this->input->post('dates'),
                'keterangan' => $this->input->post('keterangan'),
                'kode_barang' => $this->input->post('kode_barang'),
                'kode_supplier' => $this->input->post('kode_supplier'),
                'total' => $this->input->post('total'),

                'jumlah' => $this->input->post('jumlah')
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('material_in', $data);

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data edited</div>');
            redirect('in');
        }
    }
}
