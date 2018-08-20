<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penulis extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->model('M_penulis');

if($this->session->userdata('nama_lengkap')  && $this->session->userdata('id_account') ){
redirect(base_url('Halaman_penulis')); 
}

}

public function index(){
$this->load->view('Umum/V_header');
$this->load->view('Penulis/V_login');
}

public function daftar(){
if($this->input->post('nama_lengkap')){

$hasil_cek = $this->M_penulis->cek_email_daftar($this->input->post('email'));   

if($hasil_cek > 0 ){

echo "sudah_digunakan";
}else{
$input = $this->input->post();

$hasil_pendaftar = $this->M_penulis->data_pendaftar();

$angka = 6;
$pendaftar = $hasil_pendaftar;

$id_account = str_pad($pendaftar, $angka ,"0",STR_PAD_LEFT);


$data = array(
'id_account'     => $id_account,   
'nama_lengkap'   => $input['nama_lengkap'],    
'nomor_kontak'   => $input['nomor_kontak'],    
'alamat_lengkap' => $input['alamat_lengkap'],    
'email'          => $input['email'],    
'password'       => md5($input['password']),    
);
$this->M_penulis->daftar_penulis($data);

echo "berhasil";    
    
}

}else{
redirect(404);
}
}

function login(){
if($this->input->post('email')){
$email    = $this->input->post('email');
$password = md5($this->input->post('password'));
$hasil_login = $this->M_penulis->login($email,$password);    
  
if($hasil_login->num_rows() > 0){
      
$data_login = $hasil_login->row_array();

$data = array(
'nama_lengkap'    => $data_login['nama_lengkap'], 
'nomor_kontak'    => $data_login['nomor_kontak'],
'alamat_lengkap'  => $data_login['alamat_lengkap'],
'email'           => $data_login['email'],
'id_account'      => $data_login['id_account'],    
);
$this->session->set_userdata($data);
echo "berhasil";


}else{
    
echo "akun_gaada";

}

}else{
redirect(404);    
}    
    
}

}
