<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();


        $this->load->model('Stok_model');
        $this->load->library('Pdf');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Stok';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('stok/index');
        $this->load->view('templates/footer');
    }



    public function product_data()
    {

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $this->db->order_by('kode_barang', 'DESC');
        $query = $this->db->get('v_stok');

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
            $row[] = $r->stok;




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


    public function cetak()
    {
        $data['data'] = $this->Stok_model->get_stok();
        $this->load->view('stok/cetak', $data);
    }

    public function cetak1()
    {
        $this->load->library('mypdf');
        $data['data'] = $this->Stok_model->get_stok();
        $this->mypdf->generate('stok/cetak1', $data, 'laporan-stok', 'A4', 'potrait');
    }
}
