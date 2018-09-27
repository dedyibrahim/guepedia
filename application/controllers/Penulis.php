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

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($input['email']);
$this->email->subject('Aktivasi akun');
$html = "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>Konfirmasi akun </h3>"; 

$html .= "untuk mengkonfirmasi akun silahkan klik link di bawah ini <br><br>"
. "<a href='".base_url('Penulis/aktivasi/'. base64_encode($input['email']))."'>Konfirmasi akun anda disini</a><br><br>"
. "atas perhatian dan kerjasamanya kami ucapkan terimaksih <br>"
. "<i>Note: Jika anda tidak merasa melakukan pendaftaran mohon abaikan email ini </i>";


$this->email->message($data_kirim);

if (!$this->email->send()){    

echo $this->email->print_debugger();

    
}else{

$hasil_pendaftar = $this->M_penulis->hitung_penulis();

$angka = 6;
$pendaftar = $hasil_pendaftar;

$id_account = str_pad($pendaftar, $angka ,"0",STR_PAD_LEFT);


$data = array(
'id_account'     => $id_account,   
'nama_pena'      => $input['nama_pena'],    
'nama_lengkap'   => $input['nama_lengkap'],    
'nomor_kontak'   => $input['nomor_kontak'],    
'alamat_lengkap' => $input['alamat_lengkap'],    
'email'          => $input['email'],    
'password'       => md5($input['password']),    
'status_akun'    =>'tidak',
);
$input_total =array(
'id_account'           =>$id_account,
);

$this->M_penulis->daftar_penulis($data,$input_total);

echo "berhasil";    

}
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
if($data_login['status_akun'] == 'tidak'){

echo "tidak"; 

}else{
$data = array(
'nama_lengkap'    => $data_login['nama_lengkap'], 
'nomor_kontak'    => $data_login['nomor_kontak'],
'alamat_lengkap'  => $data_login['alamat_lengkap'],
'email'           => $data_login['email'],
'id_account'      => $data_login['id_account'],    
);
$this->session->set_userdata($data);


echo "berhasil";


}

}else{

echo "akun_gaada";

}

}else{
redirect(404);    
}    

}



public function aktivasi(){
if($this->uri->segment(3) != ''){
$email =  $this->uri->segment(3);

$data = array(
'status_akun'=>'aktif'    
);

$this->M_penulis->aktivasi($data,$email);
redirect(base_url('Penulis'));    
}else{
redirect(404);    
}    
    
}

public function reset_password(){

if($this->input->post('email_reset')){
$email = $this->input->post('email_reset');

$hasil = $this->M_penulis->cek_email($email);

if($hasil != ''){

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($email);
$this->email->subject('Reset Password');
$html = "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'> Reset Password  Guepedia</h3>"; 

$html  .="Untuk melakukan reset password silahkan anda klik link di bawah ini <br>";
$html  .= base_url('Penulis/reset/'. base64_encode($email));
$html  .="<br><i>Note:Jika anda tidak merasa melakukan reset password mohon abaikan email ini</i>";

$this->email->message($html);

if (!$this->email->send()){    

echo $this->email->print_debugger();

    
}else{    
echo "berhasil";    


}


}else{
echo "gaada";    
}
   
}else{
redirect(404);    
}    
    
}

public function reset(){
 
if($this->uri->segment(3) != ''){
   
$this->load->view('Umum/V_header');
$this->load->view('Penulis/V_reset');
    
    
}else{
    
 
    redirect(404);   
    
}    
    
    
}

public function password_baru(){
if($this->input->post('password')){
$input = $this->input->post();

$data = array(
'password'    => md5($input['password']),    
'status_akun' =>'aktif',        
);
$this->M_penulis->update_password($data,$input['e']);

echo "berhasil";    
}else{
redirect(404);    
}  
    
    
    
}


}
