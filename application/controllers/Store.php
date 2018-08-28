<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Store extends CI_Controller{
public function __construct() {
     parent::__construct();
 
 $this->load->model('M_store');    
}
 
public function index(){
$baru_terbit = $this->M_store->baru_terbit();    
$terlaris    = $this->M_store->terlaris();    
    
$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_banner');
$this->load->view('Store/V_home',['baru_terbit'=>$baru_terbit,'terlaris'=>$terlaris]);
$this->load->view('Umum/V_footer_toko');
}

public function kategori(){
if($this->uri->segment(3) !=''){
$id_kategori = $this->uri->segment(3);
$kategori = $this->M_store->lihat_kategori($id_kategori);
    
$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_kategori',['kategori'=>$kategori]);
$this->load->view('Umum/V_footer_toko');
    
}else {
    redirect(404);    
}
}
public function cari_buku(){

   
$kata_kunci = $this->input->post('kata_kunci');

$hasil_cari = $this->M_store->cari_buku($kata_kunci);    

echo "<div class='row'>";
foreach ($hasil_cari->result_array() as $data){
echo "<div class='col-lg-3 col-md-6 mb-4'>
<div class='card'>
<img class='card-img-top' style='max-height:185px;' src='".base_url('uploads/file_cover/'.$data['file_cover'])."'alt=''>
<div class='card-body' >
<p class='card-text' style='height:50px; text-align: center;'>".$data['judul']."</p>
</div>
<hr>
<h5 align='center'><b>Rp.".number_format($data['harga'])."</b></h5>    
<div class='card-footer'>
<a href='#' class='btn btn-success fa-color col'>Beli <span class='fa fa-shopping-basket'></span></a>
</div>
</div>
</div>";
}
echo "</div>";
       
}

    
}

