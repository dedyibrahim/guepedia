<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman_penulis extends CI_Controller {
function __construct() {
parent::__construct();

$this->load->helper('download');
$this->load->library('upload');
$this->load->model('M_halaman_penulis');
if(!$this->session->userdata('nama_lengkap')  && !$this->session->userdata('id_account') ){
redirect(base_url('Penulis')); 
}
}

public function index(){
$data_penulis = $this->M_halaman_penulis->data_penulis();
 

$this->load->view('Umum/V_header');
$this->load->view('Halaman_penulis/V_menu');
$this->load->view('Halaman_penulis/V_profile',['data_akun'=>$data_penulis]);
$this->load->view('Umum/V_footer');
}

public function update_penulis(){
if($this->input->post('nama_lengkap')){    
$input = $this->input->post();
$data = array(
'nama_pena'     =>$input['nama_pena'],
'nama_lengkap'  =>$input['nama_lengkap'],
'nomor_kontak'  =>$input['nomor_kontak'],
'alamat_lengkap'=>$input['alamat_lengkap'],
);
$this->M_halaman_penulis->update_penulis($data,$this->session->userdata('id_account'));
echo "berhasil";
}else{

redirect(404) ;   

}        
}
public function logout(){
$this->session->sess_destroy();    
redirect('Penulis');

}
public function simpan_rekening(){
if($this->input->post('nama_bank')){
$input = $this->input->post();
    
$data= array(
'id_account'            =>$this->session->userdata('id_account'),    
'nama_pemilik_rekening' =>$input['pemilik_rekening'],
'nomor_rekening'        =>$input['nomor_rekening'],
'nama_bank'             =>$input['nama_bank'],   
);
$this->M_halaman_penulis->simpan_rekening_penulis($data,$this->session->userdata('id_account'));
echo "berhasil";

}else{
redirect(404);    

}    

}

function upload_naskah(){
$kategori = $this->M_halaman_penulis->data_kategori_naskah();    
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_penulis/V_menu');
$this->load->view('Halaman_penulis/V_upload_naskah',['kategori'=>$kategori]);
$this->load->view('Umum/V_footer');
   
    
}

public function proses_upload(){
$config['upload_path']          = './uploads/dokumen_naskah/';
$config['allowed_types']        = 'docx|doc|pdf|ods|pptx|ppt|jpeg|jpg|png|psd|cdr|';
$config['file_size']            = "2004800";
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);
$input = $this->input->post();

if (!$this->upload->do_upload('file_naskah')){

echo $this->upload->display_errors();

}else{  

    
$file_naskah = $this->upload->data('file_name');

$config2['upload_path']          = './uploads/file_cover/';
$config2['allowed_types']        = 'docx|doc|pdf|ods|pptx|ppt|jpeg|jpg|png|psd|cdr|';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if($this->upload->do_upload('file_cover') != NULL){

$data = array(
'id_account'        => $this->session->userdata('id_account'),
'judul'             => $input['judul'],
'penulis'           => $input['penulis'],
'sinopsis'          => $input['sinopsis'],
'id_kategori_naskah'=> $input['id_kategori_naskah'],
'file_naskah'       => $file_naskah,
'file_cover'        => $this->upload->data('file_name'),
'tanggal_upload'    => date('d/m/Y'),
'status'           => 'Pending',
 );

$this->M_halaman_penulis->simpan_naskah($data);

echo "berhasil";
}else{
    
$data = array(
'id_account'        => $this->session->userdata('id_account'),
'judul'             => $input['judul'],
'penulis'           => $input['penulis'],
'sinopsis'          => $input['sinopsis'],
'id_kategori_naskah'=> $input['id_kategori_naskah'],
'file_naskah'       => $file_naskah,
'tanggal_upload'    =>date('d/m/Y'),
'status'           => 'Pending',
);

$this->M_halaman_penulis->simpan_naskah($data);

echo "berhasil";
}
}
}

public function json_file_naskah(){
echo $this->M_halaman_penulis->json_file_naskah();       
}

public function my_project(){
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_penulis/V_menu');
$this->load->view('Halaman_penulis/V_my_project');
$this->load->view('Umum/V_footer');
     
    
}
public function download_tamplate(){

force_download('./assets/tamplate/tamplateguepedia.zip', NULL);

}

}