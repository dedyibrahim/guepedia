<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Store extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->library('pagination');
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

$jumlah_data = $this->M_store->jumlah_buku($id_kategori);
$config['base_url'] = base_url().'/Store/kategori/'.$this->uri->segment(3)."/";
$config['total_rows'] = $jumlah_data;
$config['per_page'] = 12;
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['attributes'] = ['class' => 'page-link'];
$config['first_link'] = false;
$config['last_link'] = false;
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';
$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';
$from = $this->uri->segment(4);

$this->pagination->initialize($config);		
$kategori= $this->M_store->lihat_kategori($id_kategori,$config['per_page'],$from);


$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_kategori',['kategori'=>$kategori]);

echo $this->pagination->create_links();

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
    
echo "
 <a style='text-decoration:none;' href='".base_url('Store/lihat_buku/'.base64_encode($data['id_file_naskah']))."'>    
    
<div class='col-lg-3 col-md-6 mb-4'>
<div class='card'>
<img class='card-img-top cover'  src='".base_url('uploads/file_cover/'.$data['file_cover'])."' alt=''>
<div class='card-body'>
<p class='card-text' style='height:50px; text-align: center;'>".$data['judul']."</p>
</div>
</a>
<div class='card-footer'>
<button class='btn btn-success form-control'><b>Rp.".number_format($data['harga'])."</b> <span class='fa fa-shopping-basket '></span></button>    


</div>
</div>
</div>";
}
echo "</div>";

}

function lihat_buku(){
$id_file_naskah = $this->uri->segment(3);

$query = $this->M_store->data_buku($id_file_naskah);
    

$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_buku',['data'=>$query]);
$this->load->view('Umum/V_footer_toko');

}
}

