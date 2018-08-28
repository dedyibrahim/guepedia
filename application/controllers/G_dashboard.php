<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class G_dashboard extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->library('upload');
$this->load->helper('download');
$this->load->library('Datatables');
$this->load->model('M_dashboard');
if(!$this->session->userdata('nama_admin')  && !$this->session->userdata('id_admin') ){
redirect(base_url()); 
}

}

public function index(){
$nama_kategori = $this->M_dashboard->kategori_naskah(); 
$jumlah_naskah = $this->M_dashboard->total_naskah();

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_kategori',['nama_kategori'=>$nama_kategori,'jumlah_naskah','jumlah_naskah'=>$jumlah_naskah]);
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
public function json_file_naskah_publish(){
echo $this->M_dashboard->lihat_file_naskah_publish();       
}
public function json_penulis(){
echo $this->M_dashboard->json_penulis();       
}
public function json_user(){
echo $this->M_dashboard->json_user();       
}

public function json_naskah_penulis($id_penulis){
echo $this->M_dashboard->lihat_naskah_penulis($id_penulis);       
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
$kategori = $this->M_dashboard->kategori_naskah();

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_lihat_naskah',['data_naskah'=>$query,'kategori'=>$kategori]);
$this->load->view('Umum/V_footer');
    
    
}
public function download_naskah(){
$id_file_naskah = base64_decode($this->uri->segment(3));
$file_naskah = $this->db->get_where('file_naskah_penulis',array('id_file_naskah'=>$id_file_naskah))->row_array();
    
    
force_download('./uploads/dokumen_naskah/'.$file_naskah['file_naskah'], NULL);
}

public function download_cover(){

$id_file_naskah = base64_decode($this->uri->segment(3));
$file_naskah = $this->db->get_where('file_naskah_penulis',array('id_file_naskah'=>$id_file_naskah))->row_array();
    
    
force_download('./uploads/file_cover/'.$file_naskah['file_cover'], NULL);
    
}

public function update_naskah(){
 $input= $this->input->post();   
$param = $input['id_file_naskah'];
        
 if($this->input->post('id_file_naskah')){
  
 if(!empty($_FILES['file_cover'])){
$config2['upload_path']          = './uploads/file_cover/';
$config2['allowed_types']        = 'jpeg|jpg|png|gif';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if(!$this->upload->do_upload('file_cover')){
echo $this->upload->display_errors();
}else{

  $data =array(
  'id_account'      => $input['id_account'],    
  'penulis'         => $input['penulis'],
  'status'          => $input['status'],
  'id_kategori_naskah'=> $input['kategori'],
  'sinopsis'        => $input['sinopsis'],
  'judul'           => $input['judul'],
  'harga'           => $input['harga'],
  'berat_buku'      => $input['berat'],
  'jumlah_lembar'   => $input['jumlah_lembar'],
  'file_cover'      => $this->upload->data('file_name'),
   );  
  $this->M_dashboard->update_naskah($data,$param);
 
 if($input['cover_lama'] !='' || $input['cover_lama'] !=NULL){ 
 unlink('./uploads/file_cover/'.$input['cover_lama']);  
 }
 
 echo "berhasil";
 
} 


}else{ 
     
  $data =array(
  'id_account'      => $input['id_account'],    
  'penulis'         => $input['penulis'],
  'status'          => $input['status'],
  'id_kategori_naskah'=> $input['kategori'],
  'sinopsis'        => $input['sinopsis'],
  'judul'           => $input['judul'],
  'harga'           => $input['harga'],
  'berat_buku'      => $input['berat'],
  'jumlah_lembar'   => $input['jumlah_lembar'],
  );  
  
  $this->M_dashboard->update_naskah($data,$param);
 
  echo "berhasil";
 }   
    
}else{
redirect(404);    
}

}


public function publish_buku(){
if($this->input->post("harga_buku")){

$input = $this->input->post();
    
$config2['upload_path']          = './uploads/file_cover/';
$config2['allowed_types']        = 'jpeg|jpg|png|gif';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if(!$this->upload->do_upload('file_cover_jadi')){

echo $this->upload->display_errors();

}else{
    
$data = array(
'berat_buku'       => $input['berat_buku'],
'harga'            => $input['harga_buku'],
'file_cover'       => $this->upload->data('file_name'),
'status'           => 'Publish',
 );

$param = $input['id_file_naskah'];

$this->M_dashboard->update_status_naskah($data,$param);

echo "berhasil";
}    
    


}else{
    
redirect(404);    
}
    
    
}

public function data_penulis(){
$id_account = $this->uri->segment(3);
$data_penulis = $this->M_dashboard->data_penulis($id_account);    

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_data_penulis',['data_penulis'=>$data_penulis]);
$this->load->view('Umum/V_footer');


}
public function tambah_user(){
    
if($this->input->post('nama_admin')){

$input= $this->input->post();
$data = array(
'nama_admin'=>$input['nama_admin'],
'email'     =>$input['email'],
'password'  => md5($input['password']),
);
$this->M_dashboard->simpan_user($data);    
echo "berhasil";    
}else{
    
redirect(404);   
    
}    
    
}

public function hapus_user(){
$id_admin = base64_decode($this->uri->segment(3));
$this->M_dashboard->hapus_user($id_admin);
redirect('G_dashboard/user');
}

public function halaman_publish(){
$kategori = $this->M_dashboard->kategori_naskah();
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_publish_buku',['kategori'=>$kategori]);
$this->load->view('Halaman_dashboard/V_data_file_publish');
$this->load->view('Umum/V_footer');
    
  
    
}
public function cari_penulis(){
$term = strtolower($this->input->get('term'));    

$query = $this->M_dashboard->cari_penulis($term);

foreach ($query as $d) {
$json[]= array(
'label'                    => $d->nama_lengkap,   
'email_penulis'            => $d->email,   
'id_account'               => $d->id_account,
);   

}

echo json_encode($json);
}
public function cari_buku(){
$term = strtolower($this->input->get('term'));    

$query = $this->M_dashboard->cari_buku($term);

foreach ($query as $d) {
$json[]= array(
'label'                    => $d->judul,   
'id_file_naskah'           => $d->id_file_naskah,
);   

}

echo json_encode($json);
}


public function edit_penulis(){
$id_account = $this->uri->segment(3);
$query = $this->M_dashboard->data_penulis($id_account);

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_edit_penulis',['query'=>$query]);
$this->load->view('Umum/V_footer');
    
  
}

function update_penulis(){
    
 if($this->input->post('status_akun')){
    $input = $this->input->post();
    
    $data= array(
    'status_akun'=>$input['status_akun']
    );
    
    $this->M_dashboard->update_penulis($data,$input['id_account']); 
     echo "berhasil";
     
 }else{
     
     redirect(404);   
 }   
    
}

public function proses_publish(){
if($this->input->post('id_account')){
$input = $this->input->post();
$config2['upload_path']          = './uploads/file_cover/';
$config2['allowed_types']        = 'jpeg|jpg|png|gif';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if(!$this->upload->do_upload('file_cover')){

echo $this->upload->display_errors();

}else{    

$data = array(
'jumlah_lembar'     =>$input['jumlah_lembar'],  
'judul'              =>$input['judul'],
'penulis'            =>$input['penulis'],
'harga'              =>$input['harga'],
'berat_buku'         =>$input['berat'],
'status'             =>$input['status'],
'id_kategori_naskah' =>$input['kategori'],
'tanggal_upload'     => date('d/m/Y'),
'sinopsis'           =>$input['sinopsis'],
'id_account'         =>$input['id_account'],
'file_cover'         =>$this->upload->data('file_name'),    
    
);

$this->M_dashboard->proses_publish($data);

echo "berhasil";
}
}else{
    
    redirect(404);    
}

}
function hapus_penulis(){
$id_account = $this->uri->segment(3);

$this->M_dashboard->hapus_penulis($id_account);

redirect('G_dashboard/penulis');
}

function pengaturan_toko(){

$produk_laris = $this->M_dashboard->data_produk_laris();

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_set_produk_laris',['produk_laris'=>$produk_laris]);
$this->load->view('Umum/V_footer');


}

function set_laris(){
if($this->input->post('id_file_naskah')){
    
$data = array('id_file_naskah'=>$this->input->post('id_file_naskah'));

$this->M_dashboard->set_laris($data);

echo "berhasil";
}else{
    
redirect(404);    
}    
    
}
function hapus_terlaris(){
if($this->uri->segment(3) !=''){
$param = $this->uri->segment(3);

$this->M_dashboard->hapus_terlaris($param);
 
redirect(base_url('G_dashboard/pengaturan_toko'));

}else{
    
 redirect(404);    
}    
    
}

}