<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['judul']="Barang";

    // Pagination
        $this->load->library('pagination');

        //config
        $config['base_url'] = 'http://localhost/toko_online/Barang/index';
        $config['total_rows'] = $this->Barang_model->countAllBarang();
        $config['per_page'] = 5;

            // styling
            $config['full_tag_open'] = '<nav><ul class="pagination">';
            $config['full_tag_close'] = '</ul><nav>';

            $config['first_link'] = 'first';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'first';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            
            $config['next_link'] = 'first';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = 'first';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';
            
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config['attributes'] = '<li class="page-item">';

        //initalize
        $this->pagination->initialize($config);
        
        $data['barang']=$this->Barang_model->getAllBarang();
        if( $this->input->post('keyword')){
            $data['barang']=$this->Barang_model->cariDataBarang();
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('barang/index');
        $this->load->view('templates/footer');
    }

    function tambah()
    {
        $data['judul']="Tambah Data Barang";

        $this->form_validation->set_rules('id_barang', 'kode Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar');
                $this->load->view('barang/tambah');
                $this->load->view('templates/footer');
            }
            else
            {
                $this->Barang_model->tambahDataBarang();
                $this->session->set_flashdata('flash','Ditambah');
                redirect('barang');
            }
    }

    public function hapus($id){
        $this->Barang_model->hapusDataBarang();
        $this->session->set_flashdata('flash','Ditambah');
        redirect('barang');
    }

    public function detail($id){
        $data['judul']="Detail Barang";
        $data['barang']=$this->Barang_model->getBarangById($id);
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('barang/detail',$data);
        $this->load->view('templates/footer');

    }

    public function Ubah($id){
        $data['judul']="Ubah Data Barang";
        $data['barang']=$this->Barang_model->getBarangById($id);

        $this->form_validation->set_rules('id_barang', 'kode Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE)

            {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar');
                $this->load->view('barang/ubah',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->Barang_model->tambahDataBarang();
                $this->session->set_flashdata('flash','Diubah');
                redirect('barang');
            }
    }
    
}