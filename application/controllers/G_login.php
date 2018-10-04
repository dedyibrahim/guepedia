<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class G_login extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->model('M_login');
if($this->session->userdata('nama_admin')  && $this->session->userdata('id_admin') ){
redirect(base_url('G_dashboard')); 
}

}

public function index(){
    
$this->load->view('Umum/V_header');
$this->load->view('Login/V_login');
}

public function login(){

if($this->input->post('email')){

$input = $this->input->post();    
$data = array(
'email'   => $input['email'],
'password'=> md5($input['password']),    
);

$query = $this->M_login->login($data);
$ambil = $query->row_array();


if($query->num_rows() > 0){
$datases = array(
'nama_admin' => $ambil['nama_admin'],
'email'      => $ambil['email'],
'level'      => $ambil['level'],
'id_admin'   => $ambil['id_admin'],   
);
$this->session->set_userdata($datases);
echo "berhasil";    
}else{
echo "gaada";    
}


}else{
redirect(404);    
}
}

}