<?php 
class Not_found extends CI_Controller{
    function index(){
     $this->load->view('Umum/V_header_toko');   
     $this->load->view('store/V_header_toko');   
     $this->load->view('not_found.php');  
     $this->load->view('umum/V_footer_toko');
    }
    
}