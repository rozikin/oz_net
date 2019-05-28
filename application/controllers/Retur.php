<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Retur_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Material Retur';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('retur/index');
        $this->load->view('templates/footer');
    }

    public function kode_otomatis()
    {
        $data =  $this->Retur_model->buat_kode();

        echo json_encode($data);
    }

    public function product_data()
    {

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $this->db->order_by('id','DESC');
        $query = $this->db->get('v_material_retur');

        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode_retur;
            $row[] = $r->tanggal;
            $row[] = $r->kode_barang;
            $row[] = $r->nama_barang;
        
            $row[] = $r->nik;
            $row[] = $r->nama;
            $row[] = $r->jumlah;
          


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
        $data['title'] = 'Add Material Retur';

        $data['item'] = $this->Retur_model->getAllitem();
        $data['employee'] = $this->Retur_model->getAllsupplier();
        $data['kodeotomatis'] =  $this->Retur_model->buat_kode();


        $this->form_validation->set_rules('tabels', 'Tabels', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('retur/add', $data);
            $this->load->view('templates/footer');
        } else {
            for ($count = 0; $count < count($_POST['hidden_kd_brg']); $count++) {

                $data = array(
                    'kode_retur' => $this->input->post('kode_retur'),
                    'tanggal' => $this->input->post('dates'),
                    'kode_barang' => $_POST['hidden_kd_brg'][$count],
                    'nik' => $_POST['hidden_nik'][$count],
                    'jumlah' => $_POST['hidden_jumlah'][$count],
                    'keterangan' => $this->input->post('keterangan'),
                );
    
                $insert = $this->Retur_model->saves($data);
         
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data added</div>');
            
        }
        redirect('retur');
    }
}


public function delete_datax($id)
{
    //delete fil

    $this->Retur_model->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
  
}


public function edit_data($id)
{
    
    $data = $this->Retur_model->get_by_id($id);

    echo json_encode($data);
}


public function edit($id)
{
    $data['title'] = 'Edit';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['in'] = $this->Retur_model->getID($id);
    $data['items'] = $this->Retur_model->getAllitem();
    $data['employee'] = $this->Retur_model->getAllsupplier();
  
   
   
   
        $this->form_validation->set_rules('kode_retur', 'kode_retur', 'required');
        $this->form_validation->set_rules('dates', 'Dates', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('kode_barang', 'Kode_barang', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');

        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('retur/edit', $data);
        $this->load->view('templates/footer');
    } else {
        $data = [
            'kode_retur' => $this->input->post('kode_retur'),
            'tanggal' => $this->input->post('dates'),
            'keterangan' => $this->input->post('keterangan'),
            'kode_barang' => $this->input->post('kode_barang'),
            'nik' => $this->input->post('nik'),
            'jumlah' => $this->input->post('jumlah')
        ];
     
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('material_retur', $data);

        $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert">Data edited</div>');
        redirect('retur');
    }

    

    }



}
