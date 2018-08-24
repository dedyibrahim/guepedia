<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Store extends CI_Controller{
public function __construct() {
     parent::__construct();
 }
 
public function index(){
$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_banner');
$this->load->view('Store/V_produk');
$this->load->view('Umum/V_footer_toko');
}
    
    
}

