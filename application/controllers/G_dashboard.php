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
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_kategori');
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
}