<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('Item_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Item';

        $data['jenis'] = ['Pulsa', 'Listrik', 'BPJS', 'V. Wifi', 'Print'];
        $data['satuans'] = ['Lb', 'Pcs', 'Pc'];


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('item/index');
        $this->load->view('templates/footer');
    }


    public function kode_otomatis()
    {
        $data =  $this->Item_model->buat_kode();

        echo json_encode($data);
    }


    public function product_data()
    {

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->get("item");



        $data = [];
        $no = 0;

        foreach ($query->result() as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode_barang;
            $row[] = $r->nama_barang;
            $row[] = $r->jenis;
            $row[] = $r->merk;
            $row[] = $r->warna;
            $row[] = $r->satuan;
            $row[] = $r->harga;
            $row[] = $r->keterangan;


            //add html for action
            $row[] = '<a class="badge badge-primary" href="javascript:void(0)" title="Edit" onclick="edit_data(' . "'" . $r->id . "'" . ')"><i class="fas fa-edit"></i> Edit</a>
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






    public function edit_data($id)
    {
        $data = $this->Item_model->get_by_id($id);

        echo json_encode($data);
    }


    public function add_data()
    {

        $this->_validate();

        $data = array(
            'kode_barang' => $this->input->post('kode'),
            'nama_barang' => $this->input->post('nama'),
            'jenis' => $this->input->post('jenis'),
            'merk' => $this->input->post('merk'),
            'warna' => $this->input->post('warna'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'keterangan' => $this->input->post('keterangan'),
        );



        $insert = $this->Item_model->save($data);

        echo json_encode(array("status" => TRUE));
    }


    public function update_data()
    {
        $this->_validate();
        $data = array(
            'kode_barang' => $this->input->post('kode'),
            'nama_barang' => $this->input->post('nama'),
            'jenis' => $this->input->post('jenis'),
            'merk' => $this->input->post('merk'),
            'warna' => $this->input->post('warna'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'keterangan' => $this->input->post('keterangan'),

        );

        $this->Item_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }




    public function delete_datax($id)
    {
        //delete fil

        $this->Item_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }







    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('kode') == '') {
            $data['inputerror'][] = 'kode';
            $data['error_string'][] = 'kode is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'nama is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('jenis') == '') {
            $data['inputerror'][] = 'jenis';
            $data['error_string'][] = 'jenis is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('merk') == '') {
            $data['inputerror'][] = 'merk';
            $data['error_string'][] = 'merk is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('warna') == '') {
            $data['inputerror'][] = 'warna';
            $data['error_string'][] = 'warna is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('satuan') == '') {
            $data['inputerror'][] = 'satuan';
            $data['error_string'][] = 'satuan is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('keterangan') == '') {
            $data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'keterangan is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
