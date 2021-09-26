<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : write less or more
    }

    function index()
    {
        $data['judul']="Toko Penjual";
        $this->load->view('templates/header',$data);
        $this->load->view('home/index');
        $this->load->view('templates/footer');
    }


}