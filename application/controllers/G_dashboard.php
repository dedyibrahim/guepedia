<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class G_dashboard extends CI_Controller{

public function __construct() {
parent::__construct();
$this->load->library('Datatables');
$this->load->model('M_dashboard');
if(!$this->session->userdata('nama_admin')  && !$this->session->userdata('id_admin') ){
redirect(base_url()); 
}

}

public function index(){
$nama_kategori = $this->M_dashboard->kategori_naskah(); 

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_kategori',['nama_kategori'=>$nama_kategori]);
$this->load->view('Umum/V_footer');
}

public function logout(){
$this->session->sess_destroy();    
redirect('G_login');
}

public function simpan_kategori(){
if($this->input->post('nama_kategori')){
$kategori = $this->M_dashboard->data_kategori()->num_rows();
    
$angka = 3;
$jumlah_kategori = $kategori;

$id_kategori = str_pad($jumlah_kategori, $angka ,"0",STR_PAD_LEFT);

    
$data =array(
'id_kategori_naskah'=>"N_".$id_kategori,
'nama_kategori'     =>$this->input->post('nama_kategori'),    
);
    
$this->M_dashboard->insert_kategori($data);    
echo "berhasil";
}else{
redirect(404);

}   

}
public function hapus_kategori(){
 
if($this->uri->segment(3)){
$this->db->delete('kategori_naskah',array('id_kategori'=> base64_decode($this->uri->segment(3))));   
redirect('G_dashboard');    
}else{
redirect(404);    
}    
    
    
}
public function lihat_kategori(){
$this->session->set_userdata(array('id_kategori_naskah'=> base64_decode($this->uri->segment(3))));    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_lihat_kategori');
$this->load->view('Umum/V_footer');
}
public function json_lihat_kategori(){
echo $this->M_dashboard->lihat_kategori();       
}
public function json_file_naskah(){
echo $this->M_dashboard->lihat_file_naskah();       
}
public function json_penulis(){
echo $this->M_dashboard->json_penulis();       
}
public function json_user(){
echo $this->M_dashboard->json_user();       
}

public function data_file_naskah(){

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_data_file_naskah');
$this->load->view('Umum/V_footer');
    
    
}
public function penulis(){

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_penulis');
$this->load->view('Umum/V_footer');
    
    
}
public function user(){

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_user');
$this->load->view('Umum/V_footer');
    
    
}
public function lihat_naskah(){
$query = $this->M_dashboard->lihat_naskah($this->uri->segment(3));    

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_lihat_naskah',['data_naskah'=>$query]);
$this->load->view('Umum/V_footer');
    
    
}


}