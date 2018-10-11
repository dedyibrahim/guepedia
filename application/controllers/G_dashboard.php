<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

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
public function json_data_seo(){
echo $this->M_dashboard->data_seo();       
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

public function json_penjualan(){
echo $this->M_dashboard->json_penjualan();       
}

public function json_customer_royalti(){
echo $this->M_dashboard->json_customer_royalti();       
}

public function json_transfer_royalti(){
echo $this->M_dashboard->json_transfer_royalti();       
}

public function json_all_order(){
echo $this->M_dashboard->json_all_order();       
}

public function json_kode_kupon(){
echo $this->M_dashboard->json_kode_kupon();       
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
$this->load->view('Halaman_dashboard/V_penulis');
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
'id_account'        => $input['id_account'],    
'penulis'           => $input['penulis'],
'status'            => $input['status'],
'id_kategori_naskah'=> $input['kategori'],
'sinopsis'          => $input['sinopsis'],
'judul'             => $input['judul'],
'harga'             => $input['harga'],
'berat_buku'        => $input['berat'],
'jumlah_lembar'     => $input['jumlah_lembar'],
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
$id_account    = $this->uri->segment(3);
$data_penulis  = $this->M_dashboard->data_penulis($id_account);    
$total_royalti = $this->M_dashboard->total_royalti_penulis($id_account);
$total_naskah  = $this->M_dashboard->total_naskah_penulis($id_account);

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_data_penulis',['data_penulis'=>$data_penulis,'total_royalti'=>$total_royalti,'total_naskah'=>$total_naskah]);
$this->load->view('Umum/V_footer');


}
public function tambah_user(){

if($this->input->post('nama_admin')){

$input= $this->input->post();
$data = array(
'nama_admin'=>$input['nama_admin'],
'level'     =>$input['level'],
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


public function cari_customer(){
$term = strtolower($this->input->get('term'));    

$query = $this->M_dashboard->cari_customer($term);

foreach ($query as $d) {
$json[]= array(
'label'                   => $d->nama_customer,   
'nama_customer'           => $d->nama_customer,   
'nomor_kontak'            => $d->nomor_kontak,   
'alamat_lengkap'          => $d->alamat_lengkap,
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
'id_account'               => $d->id_account,
'nama_penulis'             => $d->penulis,
'harga_buku'               => $d->harga,
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

function produk_laris(){

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

redirect(base_url('G_dashboard/produk_laris'));

}else{

redirect(404);    
}    

}

function laporan_penjualan(){
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_input_penjualan');
$this->load->view('Umum/V_footer');   

}

function  set_kasir(){
if($this->input->post('id_file_naskah')){
$id_file_naskah = $this->input->post('id_file_naskah');
$query = $this->M_dashboard->file_naskah_penulis($id_file_naskah);
$cek_sesi = $this->session->userdata('data_kasir');

$data_lama = $this->session->userdata('data_kasir');

if($cek_sesi != NULL){

foreach ($query->result_array() as $buku){
$array2 = array(
'id_account'    =>$buku['id_account'],
'id_file_nasjah'=>$buku['id_file_naskah'],
'judul'         =>$buku['judul'],
'qty'           =>1,    
'jumlah'        =>$buku['harga'],
'harga'         =>$buku['harga'],
'diskon'        =>0,
'nilai_diskon'  =>0,
'royalti'       =>$buku['harga'] * 15 / 100  ,
'bersih'        =>$buku['harga'] - $buku['harga'] * 15 / 100,    
'penulis'       =>$buku['penulis'],

);
}
array_push($data_lama, $array2);    
$this->session->set_userdata('data_kasir',$data_lama);    


}else{    

foreach ($query->result_array() as $buku){
$array['data_kasir'][]=[
'id_account'    =>$buku['id_account'],
'id_file_nasjah'=>$buku['id_file_naskah'],
'judul'         =>$buku['judul'],
'qty'           =>1,    
'jumlah'        =>$buku['harga'],
'harga'         =>$buku['harga'],
'diskon'        =>0,
'nilai_diskon'  =>0,    
'royalti'       =>$buku['harga'] * 15 / 100,
'bersih'        =>$buku['harga'] - $buku['harga'] * 15 / 100,    
'penulis'       =>$buku['penulis'],

];
$this->session->set_userdata($array);    

}
}


echo print_r($this->session->userdata());

}else{

redirect(404);    
}    

}
function canvas_kasir(){
$data = $this->session->userdata('data_kasir'); 
if (is_array($data) || is_object($data)){

$ht = count($data);
}
$subtotal       = 0;
$royalti        = 0;
$bersih         = 0;
$nilai_diskon   = 0;

if (is_array($data) || is_object($data)){
foreach($data as $i=>$ht){

$subtotal      += $data[$i]['jumlah'];
$royalti       += $data[$i]['royalti'];
$bersih        += $data[$i]['bersih'];
$nilai_diskon  += $data[$i]['nilai_diskon'];

}
}
$total = array(
'subtotal'      =>$subtotal,    
'royalti'       =>$royalti,    
'bersih'        =>$bersih,    
'nilai_diskon'  =>$nilai_diskon,
'total'         =>$subtotal + $this->session->userdata('jumlah_biaya_lain') + $this->session->userdata('nilai_ppn') - $this->session->userdata('jumlah_diskon_total'), 
'total_bersih'  =>$bersih,    
);

$this->session->set_userdata($total);

echo "<table class='table table-striped table-sm table-bordered table-condensed table-hover'>"
. "<tr>"
. "<th>Penulis</th>"
. "<th>Id Penulis</th>"
. "<th style='width: 20%;'>Judul</th>"
. "<th>Harga</th>"
. "<th style='width: 5%;'>Qty</th>"
. "<th>Jumlah</th>"
. "<th style='width: 5%;'>Diskon </th>"
. "<th>Nilai Diskon </th>"
. "<th>Bagi hasil 15 %</th>"
. "<th>Bersih</th>"
. "<th>Aksi</th>"
. "</tr>";

if (is_array($data) || is_object($data)){

foreach($data as $i=>$ht){

echo "
<tr>
<td> ".$data[$i]['penulis']."</td>
<td> ".$data[$i]['id_account']."</td>
<td> ".$data[$i]['judul']."</td>
<td>".number_format($data[$i]['harga'])."</td>
<td><input type='text' id='qty_kasir".$i."' onchange='update_qty_kasir(".$i.");' class='form-control' value='".$data[$i]['qty']."'></td>
<td>".number_format($data[$i]['jumlah'])."</td>
<td><input readonly='' type='text' id='id_diskon".$i."' onchange='set_diskon(".$i.");' class='form-control' value='".$data[$i]['diskon']."'></td>
<td>".number_format($data[$i]['nilai_diskon'])."</td>
<td>".number_format($data[$i]['royalti'])."</td>
<td>".number_format($data[$i]['bersih'])."</td>
<td><button onclick='hapus_datakasir(".$i.");' class='btn btn-sm btn-danger'><span class='fa fa-close'></span></button> || <button onclick='beri_diskon(".$i.");' class='btn btn-sm btn-warning'><span class='fa fa fa-percent'></span></button></td>
</tr>";

}
}
echo "<tr>"
. "<td colspan='5'>Sub Total</td>"
. "<td colspan='2'>".number_format($this->session->userdata('subtotal'))."</td>"

. "<td>".number_format($this->session->userdata('nilai_diskon'))."</td>"


. "<td>".number_format($this->session->userdata('royalti'))."</td>"

. "<td colspan='2'>".number_format($this->session->userdata('bersih'))."</td>"

. "</tr>";
if($this->session->userdata('nama_biaya_lain') !=''){

echo "<tr>"
. "<td colspan='5'>".$this->session->userdata('nama_biaya_lain')."</td>"
. "<td colspan='2'>".number_format($this->session->userdata('jumlah_biaya_lain'))."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"

. "</tr>";
}
if ($this->session->userdata('nilai_ppn') !=''){
echo "<tr>"
. "<td colspan='5'>PPN 10 %</td>"
. "<td colspan='2'>".number_format($this->session->userdata('nilai_ppn'))."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"

. "</tr>";
}
if($this->session->userdata('diskon_total') !=''){
echo "<tr>"
. "<td colspan='5'>Diskon ".$this->session->userdata('diskon_total')." %</td>"
. "<td colspan='2'>".number_format($this->session->userdata('jumlah_diskon_total'))."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"

. "</tr>";

}

echo "<tr>"
. "<td colspan='5'>Total Bayar</td>"
. "<td colspan='2'>".number_format($this->session->userdata('total'))."</td>"
. "<td colspan='2'>Total Bersih</td>"
. "<td colspan='2'>".number_format($this->session->userdata('total_bersih'))."</td>"
. "</tr>";

echo "</table>";    
echo "<input type='hidden' id='total_bayar' class='form-control' value=".$this->session->userdata('total').">";
}

function hapus_datakasir(){
$id_hapus = $this->input->post('id_hapus');
unset($_SESSION['data_kasir'][$id_hapus]);
$array_items = array(
'nama_biaya_lain',
'jumlah_biaya_lain',
'nilai_ppn',
'diskon_total',
'jumlah_diskon_total',    

);

$this->session->unset_userdata($array_items);

}

public function update_qty_kasir(){

$id_qty    = $this->input->post('id_qty');
$qty_kasir = $this->input->post('qty_kasir');
$detailsdata = $this->session->userdata('data_kasir');

$d =  $detailsdata[$id_qty];

$data2 = array(
'id_account'    =>$d['id_account'],
'id_file_nasjah'=>$d['id_file_naskah'],
'judul'         =>$d['judul'],
'qty'           =>$qty_kasir,    
'harga'         =>$d['harga'],
'diskon'        =>0,
'nilai_diskon'  =>0,       
'jumlah'        =>$d['harga']*$qty_kasir,   
'royalti'       =>$d['harga']*$qty_kasir * 15 / 100,
'bersih'        =>$d['harga']*$qty_kasir - $d['harga']*$qty_kasir * 15 / 100,    
'penulis'       =>$d['penulis'],
);

array_push($detailsdata, $data2);

$this->session->set_userdata('data_kasir',$detailsdata);

unset($_SESSION['data_kasir'][$id_qty]);
$array_items = array(
'nama_biaya_lain',
'jumlah_biaya_lain',
'nilai_ppn',
'diskon_total',
'jumlah_diskon_total',    

);

$this->session->unset_userdata($array_items);

}
function set_diskon(){
if($this->input->post('nilai_diskon') !=''){
$input = $this->input->post();

if($input['nilai_diskon'] < 40){

$id_qty    = $this->input->post('id_qty');
$detailsdata = $this->session->userdata('data_kasir');

$d =  $detailsdata[$id_qty];

$data2 = array(
'id_account'    =>$d['id_account'],
'id_file_nasjah'=>$d['id_file_naskah'],
'judul'         =>$d['judul'],
'qty'           =>$d['qty'],    
'harga'         =>$d['harga'],
'diskon'        =>$input['nilai_diskon'],
'nilai_diskon'  =>$d['jumlah'] * $input['nilai_diskon'] / 100 ,        
'jumlah'        =>$d['jumlah'],   
'royalti'       =>($d['jumlah'] - $d['jumlah'] * $input['nilai_diskon'] / 100) * 15 /100,
'bersih'        => ($d['jumlah'] - $d['jumlah'] * $input['nilai_diskon'] / 100) - (($d['jumlah'] - $d['jumlah'] * $input['nilai_diskon'] / 100) * 15 /100) ,    
'penulis'       =>$d['penulis'],
);

array_push($detailsdata, $data2);

$this->session->set_userdata('data_kasir',$detailsdata);

unset($_SESSION['data_kasir'][$id_qty]);
$array_items = array(
'nama_biaya_lain',
'jumlah_biaya_lain',
'nilai_ppn',
'diskon_total',
'jumlah_diskon_total',    

);

$this->session->unset_userdata($array_items);


}else{

$id_qty    = $this->input->post('id_qty');
$qty_kasir = $this->input->post('qty_kasir');
$detailsdata = $this->session->userdata('data_kasir');

$d =  $detailsdata[$id_qty];

$data2 = array(
'id_account'    =>$d['id_account'],
'id_file_nasjah'=>$d['id_file_naskah'],
'judul'         =>$d['judul'],
'qty'           =>$d['qty'],    
'harga'         =>$d['harga'],
'diskon'        =>$input['nilai_diskon'],
'nilai_diskon'  =>$d['jumlah'] *  $input['nilai_diskon'] / 100,        
'jumlah'        =>$d['jumlah'],   
'royalti'       =>0,
'bersih'        =>$d['harga'] * $d['qty'] - $d['jumlah'] *  $input['nilai_diskon'] / 100 ,    
'penulis'       =>$d['penulis'],
);

array_push($detailsdata, $data2);

$this->session->set_userdata('data_kasir',$detailsdata);

unset($_SESSION['data_kasir'][$id_qty]);
$array_items = array(
'nama_biaya_lain',
'jumlah_biaya_lain',
'nilai_ppn',
'diskon_total',
'jumlah_diskon_total',    

);

$this->session->unset_userdata($array_items);


}

}else{

redirect(404);    
}


}

function simpan_biaya_lain(){
if($this->input->post('nama_biaya_lain')){
$input = $this->input->post();

$data = array(
'nama_biaya_lain'  =>$input['nama_biaya_lain'],
'jumlah_biaya_lain'=>$input['jumlah_biaya_lain'],    
);

$this->session->set_userdata($data);
}else{

redirect(404);    
}    

}
function set_ppn (){
if($this->input->post('nilai_ppn')){

$nilai_ppn = $this->session->userdata('subtotal') * 10 / 100;
$data = array(
'nilai_ppn' => $nilai_ppn,    
);

$this->session->set_userdata($data);
}else{
redirect(404);   
}   


}

function set_diskon_total(){
if($this->input->post('nilai_diskon_total')){
$input = $this->input->post();

$nilai_diskon_total =  $this->session->userdata('subtotal') * $input['nilai_diskon_total'] / 100;
$data = array(

'diskon_total'       => $input['nilai_diskon_total'],    
'jumlah_diskon_total'=> $nilai_diskon_total,

);
$this->session->set_userdata($data);

}else{

redirect(404);    
}    

}


function simpan_customer_baru(){
if($this->input->post('nama_customer')){
$input = $this->input->post();

$data = array(
'nama_customer' => $input['nama_customer'],
'nomor_kontak' => $input['nomor_kontak'],
'alamat_lengkap'=>$input['alamat_lengkap'],   
);

$this->M_dashboard->simpan_customer_baru($data);
echo "berhasil";   
}else{

redirect(404);    
}    


}

function simpan_penjualan(){
if($this->input->post('nama_customer')){
$input = $this->input->post();
$sesi  = $this->session->userdata();

$hitung_invoices = $this->M_dashboard->hitung_invoices();
$angka = 6;
$no_invoices = str_pad($hitung_invoices, $angka ,"0",STR_PAD_LEFT);




$data1 = array(
'no_invoices'           => 'INV/'.date('d/m/Y')."/".$no_invoices,   
'nama_customer'         => $input['nama_customer'],
'nomor_kontak'          => $input['nomor_kontak'],
'alamat_lengkap'        => $input['alamat_lengkap'],
'jumlah_uang'           => $input['jumlah_uang'],
'kembalian'             => $input['kembalian'],
'nama_biaya_lain'       => $this->session->userdata('nama_biaya_lain'),
'jumlah_biaya_lain'     => $this->session->userdata('jumlah_biaya_lain'),   
'ppn'                   => '10',
'nilai_ppn'             => $this->session->userdata('nilai_ppn'), 
'diskon_total'          => $this->session->userdata('diskon_total'),
'jumlah_diskon_total'   => $this->session->userdata('jumlah_diskon_total'),
'total'                 => $this->session->userdata('total'),
'total_bersih'          => $this->session->userdata('total_bersih'),
'tanggal_transaksi'     => date('d/m/Y'),
'subtotal'              => $this->session->userdata('subtotal'),
'jumlah_diskon'         => $this->session->userdata('nilai_diskon'),
'total_royalti'         => $this->session->userdata('royalti'),
'bersih'                => $this->session->userdata('bersih'),
'status_penjualan'      => 'Selesai',
'penjualan'             => $input['penjualan'],    
);

$this->M_dashboard->simpan_data_penjualan($data1);

$data = $this->session->userdata('data_kasir'); 
$ht   = count($data);

foreach($data as $i=>$ht){

$data2 = array (
'no_invoices'           => 'INV/'.date('d/m/Y')."/".$no_invoices,   
'judul_buku'            => $data[$i]['judul'],
'id_account_penulis'    => $data[$i]['id_account'],
'nama_penulis'          => $data[$i]['penulis'],
'qty'                   => $data[$i]['qty'],
'harga'                 => $data[$i]['harga'],
'jumlah'                => $data[$i]['jumlah'],
'diskon'                => $data[$i]['diskon'],
'nilai_diskon'          => $data[$i]['nilai_diskon'],
'royalti'               => $data[$i]['royalti'],
'bersih'                => $data[$i]['bersih'],
'tanggal_transaksi'     => date('d/m/Y'),

);    

$this->M_dashboard->simpan_jumlah_penjualan($data2);

}



$array_items = array(
'nama_biaya_lain',
'jumlah_biaya_lain',
'nilai_ppn',
'diskon_total',
'jumlah_diskon_total',    
'royalti',
'bersih',   
'data_kasir',
);

$this->session->unset_userdata($array_items);


echo "berhasil";

}else{

redirect(404);    

}    

}

function print_penjualan(){

$id_data_penjualan = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$this->db->where('data_penjualan.id_data_penjualan',$id_data_penjualan);
$data = $this->db->get();
$data_static = $data->row_array(); 

$html  ="<img src='".base_url('assets/img/logo-toko.png')."'>";
$html .="<h3 style='position:fixed;' align='center'>PENJUALAN GUEPEDIA <br><b>".$data_static['no_invoices']."</b></h3>";
$html .="<br><hr>";
$html .="Nama customer :".$data_static['nama_customer']."<br>";
$html .="Nomor kontak  :".$data_static['nomor_kontak']."<br>";
$html .="Alamat lengkap :".$data_static['alamat_lengkap']."<br><br>";


$html .= '<table style="width:100%; text-align:center;" border="1" cellspacing="0" cellpadding="2"  >'
. '<tr>'
. '<th>Judul Buku</th>'
. '<th>Penulis</th>'
. '<th>Harga</th>'
. '<th>Qty</th>'
. '<th>Jumlah</th>'
. '<th>Diskon</th>'
. '<th>Nilai Diskon</th>'
. '<th>Bagi Hasil</th>'
. '<th>Bersih</th>'
. '</tr>';


foreach ($data->result_array() as $penjualan){
$html .= '<tr>
<td>' . $penjualan['judul_buku'] . '</td>
<td>' . $penjualan['nama_penulis'] . '</td>
<td>Rp.' . number_format($penjualan['harga']) . '</td>
<td>' . $penjualan['qty'].'</td>
<td>Rp.' . number_format($penjualan['jumlah']) . '</td>
<td>' . $penjualan['diskon'] . ' %</td>
<td>Rp.' . number_format($penjualan['nilai_diskon']) . '</td>
<td>Rp.' . number_format($penjualan['royalti']) . '</td>
<td>Rp.' . number_format($penjualan['bersih']) . '</td>
</tr>';
}

$html.= "<tr>"
. "<td colspan='4'>Sub Total</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['subtotal'])."</td>"
. "<td>Rp. ".number_format($data_static['jumlah_diskon'])."</td>"
. "<td>Rp. ".number_format($data_static['total_royalti'])."</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['total_bersih'])."</td>"
. "</tr>";

if($data_static['nama_biaya_lain'] !=''){
$html.= "<tr>"
. "<td colspan='4'>".$data_static['nama_biaya_lain']."</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['jumlah_biaya_lain'])."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"
. "</tr>";
}

if ($data_static['nilai_ppn'] !=''){
$html.= "<tr>"
. "<td colspan='4'>PPN 10 %</td>"
. "<td colspan='2'>Rp.".number_format($data_static['nilai_ppn'])."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"
. "</tr>";
}

if($data_static['diskon_total'] !=''){
$html.= "<tr>"
. "<td colspan='4'>Diskon ".$data_static['diskon_total']." %</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['jumlah_diskon_total'])."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"
. "</tr>";
}

$html.= "<tr>"
. "<td colspan='4'>Total Bayar</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['total'])."</td>"
. "<td colspan='2'>Total Bersih</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['total_bersih'])."</td>"
. "</tr>";
$html.= "<tr>"
. "<td colspan='4'>Jumlah uang</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['jumlah_uang'])."</td>"
. "<td colspan='2'>Kembalian</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['kembalian'])."</td>"
. "</tr>";



$html.= '</table>';



$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));


}


public function buat_laporan(){
if ($this->input->post('dates')){

$tanggal = $this->input->post('dates');
$range = explode(' ', $tanggal);

$this->db->select('*');
$this->db->where(array('data_jumlah_penjualan.tanggal_transaksi >='=>$range[0],'data_jumlah_penjualan.tanggal_transaksi <='=>$range[2]));
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$query = $this->db->get();
$html  = "<h3 style='padding: 2%; color: #000; background-color: rgb(168, 207, 69);' align='center'>Laporan Penjualan ".$tanggal."</h3>"; 

$html .= '<table style="width:100%; style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:0px 0;padding:0"  >'
. '<tr>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">No invoices</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Customer</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Tanggal</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Judul Buku</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Penulis</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Harga</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Qty</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Jumlah</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Diskon</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Nilai Diskon</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Bagi Hasil</th>'
. '<th style="border-bottom: 1px solid rgb(168,207,69);">Bersih</th>'
. '</tr>';


foreach ($query->result_array() as $penjualan){
$html .= '<tr>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['no_invoices'] . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['nama_customer'] . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['tanggal_transaksi'] . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['judul_buku'] . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['nama_penulis'] . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">Rp.' . number_format($penjualan['harga']) . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['qty'].'</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">Rp.' . number_format($penjualan['jumlah']) . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">' . $penjualan['diskon'] . ' %</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">Rp.' . number_format($penjualan['nilai_diskon']) . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">Rp.' . number_format($penjualan['royalti']) . '</td>
<td style="border-bottom: 1px solid rgb(168,207,69);">Rp.' . number_format($penjualan['bersih']) . '</td>
</tr>';
}

$html .="</table>";

$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));


}else{
redirect(404);    
}

}

function cetak_label(){

$id_data_penjualan = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$this->db->where('data_penjualan.id_data_penjualan',$id_data_penjualan);
$data = $this->db->get();
$data_static = $data->row_array(); 

$html  ="<h1 align='center'><img src='".base_url('assets/img/logo-toko.png')."'></h1><hr>";



$html .="<h4 >KEPADA :<br>Nama Penerima : ".$data_static['nama_customer']."<br>";
$html .="Nomor kontak  : ".$data_static['nomor_kontak']."<br>";
$html .="Alamat lengkap : ".$data_static['alamat_lengkap']."</h4>";


$html .="<h4 >PENGIRIM : <br> GUEPEDIA<br> Bukit Golf Arcadia Blok AR 118 , Bojong Nangka, Gunung Putri Bogor <br> Telp : 081287602508</h4>";

$html .="<hr>";
$html .=$data_static['nama_biaya_lain']." ";
$html .="Rp.".number_format($data_static['jumlah_biaya_lain'])."<br>";

foreach ($data->result_array() as $penjualan){
$html .= '' . $penjualan['judul_buku'] . ' (' . $penjualan['qty'].')<br>';
}



$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A5','landscape');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));


}

public function update_status_penjualan(){
if($this->input->post('id_data_penjualan')){
$input = $this->input->post();

$data = array(
'status_penjualan' => $input['status_penjualan'],
'resi_pengiriman' => $input['resi_pengiriman'],  
);

$this->M_dashboard->update_status_penjualan($data,$input['id_data_penjualan']);
}else{

redirect(404);    
}    

}
public function json_penjualan_customer($id){
echo $this->M_dashboard->json_penjualan_customer($id);       
}

function print_penjualan_customer(){

$id_data_penjualan = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$wer = array(
'data_penjualan.id_data_penjualan'=>$id_data_penjualan,
'data_jumlah_penjualan.id_account_penulis'=> base64_decode($this->uri->segment(4)),    
);
$this->db->where($wer);

$data = $this->db->get();
$data_static = $data->row_array(); 

$html  ="<img src='".base_url('assets/img/logo-toko.png')."'>";
$html .="<h3 style='position:fixed;' align='center'>PENJUALAN GUEPEDIA <br><b>".$data_static['no_invoices']."</b></h3>";
$html .="<br><hr>";
$html .="Nama customer :".$data_static['nama_customer']."<br>";
$html .="Nomor kontak  :".$data_static['nomor_kontak']."<br>";
$html .="Alamat lengkap :".$data_static['alamat_lengkap']."<br><br>";


$html .= '<table style="width:100%; text-align:center;" border="1" cellspacing="0" cellpadding="2"  >'
. '<tr>'
. '<th>Judul Buku</th>'
. '<th>Penulis</th>'
. '<th>Harga</th>'
. '<th>Qty</th>'
. '<th>Jumlah</th>'
. '<th>Diskon</th>'
. '<th>Nilai Diskon</th>'
. '<th>Royalti</th>'
. '<th>Bersih</th>'
. '</tr>';


foreach ($data->result_array() as $penjualan){
$html .= '<tr>
<td>' . $penjualan['judul_buku'] . '</td>
<td>' . $penjualan['nama_penulis'] . '</td>
<td>Rp.' . number_format($penjualan['harga']) . '</td>
<td>' . $penjualan['qty'].'</td>
<td>Rp.' . number_format($penjualan['jumlah']) . '</td>
<td>' . $penjualan['diskon'] . ' %</td>
<td>Rp.' . number_format($penjualan['nilai_diskon']) . '</td>
<td>Rp.' . number_format($penjualan['royalti']) . '</td>
<td>Rp.' . number_format($penjualan['bersih']) . '</td>
</tr>';
}



$html.= '</table>';

$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));


}
public function penarikan(){
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_customer_royalti');
$this->load->view('Umum/V_footer');
}

public function buat_transfer(){
$id_account    = $this->uri->segment(3);
$data_penulis  = $this->M_dashboard->data_penulis($id_account);    
$total_royalti = $this->M_dashboard->total_royalti_penulis($id_account);
$total_naskah  = $this->M_dashboard->total_naskah_penulis($id_account);

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_buat_transfer',['data_penulis'=>$data_penulis,'total_royalti'=>$total_royalti,'total_naskah'=>$total_naskah]);
$this->load->view('Umum/V_footer');


}

public function simpan_transfer_royalti(){
if($this->input->post('royalti')){
$input = $this->input->post();

$config2['upload_path']          = './uploads/bukti_transfer/';
$config2['allowed_types']        = 'jpeg|jpg|png|gif';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if(!$this->upload->do_upload('bukti_transfer')){
echo $this->upload->display_errors();
}else{
$data = array(
'royalti'           => $input['royalti'],
'id_account'        => base64_decode($input['id_account']),
'biaya_admin'       => $input['biaya_admin'],
'royalti_bersih'    => $input['royalti_bersih'],   
'bukti_transfer'    => $this->upload->data('file_name'),    
);
$this->M_dashboard->simpan_transfer($data);
echo "berhasil";
}

}else{
redirect(404);    
} 
}

public function download_bukti(){
$id_data_transfer = base64_decode($this->uri->segment(3));
$bukti_transfer   = $this->db->get_where('data_transfer_royalti',array('id_data_transfer_royalti'=>$id_data_transfer))->row_array();
force_download('./uploads/bukti_transfer/'.$bukti_transfer['bukti_transfer'], NULL);
}

public function orderan_masuk(){
  
$orderan_masuk = $this->M_dashboard->orderan_masuk();
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_orderan_masuk',['orderan_masuk'=>$orderan_masuk]);
$this->load->view('Umum/V_footer');
}

public function orderan_proses(){
  
$orderan_masuk = $this->M_dashboard->orderan_proses();
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_orderan_proses',['orderan_masuk'=>$orderan_masuk]);
$this->load->view('Umum/V_footer');
}

function download_invoices(){
if($this->session->userdata('id_admin')){
$id = base64_decode($this->uri->segment(3));

$this->db->where(array('id_penjualan_toko'=>$id));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;
$html  ="<img style='position:absolute;' src='".base_url('assets/img/logo-toko.png')."'>";
$html .= "<h3 align='center'>Store Guepedia <br> ".$static['invoices_toko']."</h3><hr>"; 

$html .= '<table style="width:100%; text-align:center;" border="1" cellspacing="0" cellpadding="2" >
        <tr>
        <th>No</th>   
        <th>Nama Buku</th>   
        <th>Harga</th>   
        <th>Qty</th>   
        <th>Jumlah</th>   
        </tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td>'.$d++.'</td>';
$html .='<td>'.$data['nama_buku'].'</td>';
$html .='<td>Rp. '.number_format($data['harga_buku']).'</td>';       
$html .='<td>'.$data['qty'].'</td>';
$html .='<td>Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="<tr>
<td colspan='2'>Total Belanja</td>    
<td colspan='3'>Rp.".number_format($static['total_belanja'])."</td>    
</tr>
<tr>
<td colspan='2'>Ongkir </td>    
<td  colspan='3'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<td colspan='2'>Kode kupon ".$static['nama_kupon']."</td>    
<td  colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
</tr>";
 }
 if($static['nilai_promo']){ 
$html .= "<tr>
<td colspan='2'>Kode promo ".$static['nama_promo']."</td>    
<td  colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_promo'])."</td>    
</tr>";
 }
$html.= 
"<tr>
<td colspan='2'>Total Bayar</td>    
<td  colspan='3'>Rp.".number_format($static['total_bayar'])."</td>    
</tr></table><hr>";
$html .= "Nama Penerima :".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : <br>".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= $static['nomor_kontak']."<br>"; 

 
$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));
    
    
}else{
redirect('Store/login_akun');   
} 
}


function input_resi_toko(){
if($this->input->post('resi')){
$input = $this->input->post();

$pembeli = $this->M_dashboard->data_pembeli($input['id_penjualan_toko'])->row_array();

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($pembeli['email']);
$this->email->subject('Resi pengiriman Guepedia');

$this->db->where(array('id_penjualan_toko'=>$input['id_penjualan_toko']));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;

$html  ="Halo orderan anda telah kami kirim menggunakan ". $static['kurir']." dengan Service ".$static['service']." Nomor Resi ".$input['resi']."<br>";
$html .= "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .='<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0"  >
        <tr>
        <th style="border-bottom: 1px solid rgb(168,207,69)">No</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69)">Nama Buku</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69)">Harga</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69)">Qty</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69)">Jumlah</th>   
        </tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$d++.'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$data['nama_buku'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">Rp. '.number_format($data['harga_buku']).'</td>';       
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$data['qty'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Belanja</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['total_belanja'])."</td>    
</tr>
<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Ongkir </td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode promo ".$static['nama_kupon']."</td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3' style='color:#dc3545;'> - Rp.".number_format($static['hasil_kupon'])."</td>    
</tr>";
 }
 if($static['nilai_promo']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode promo ".$static['nama_promo']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3' style='color:#dc3545;'> - Rp. ".number_format($static['hasil_promo'])."</td>    
</tr>";
 }
$html.= 
"<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Bayar</td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['total_bayar'])."</td>    
</tr></table>";
$html .= "Nama Penerima :".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : <br>".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= $static['nomor_kontak']."<br>"; 

$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();

}else{ 
$data = array(
 'status' =>'selesai',
 'nomor_resi'=>$input['resi'],   
);
$this->M_dashboard->input_resi_toko($data,$input['id_penjualan_toko']);
echo "berhasil";
}

}else{
redirect(404);    
}    
}

public function orderan_terima(){
$orderan_terima = $this->M_dashboard->orderan_terima();
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_orderan_terima',['orderan_terima'=>$orderan_terima]);
$this->load->view('Umum/V_footer');
}

public function orderan_selesai(){
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_orderan_selesai');
$this->load->view('Umum/V_footer');
}

function input_nama_penerima(){
if($this->input->post('penerima')){
$input = $this->input->post();

$data = array(
 'status' =>'selesai',
 'penerima_paket'=>$input['penerima'],   
);
$this->M_dashboard->input_nama_penerima($data,$input['id_penjualan_toko']);

echo "berhasil";
}else{
redirect(404);    
}    
}
function input_alasan_penolakan(){
if($this->input->post('alasan')){
    
$input = $this->input->post();

$pembeli = $this->M_dashboard->data_pembeli($input['id_penjualan_toko'])->row_array();

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($pembeli['email']);
$this->email->subject('Konfirmasi pesanan di tolak');

$this->db->where(array('id_penjualan_toko'=>$input['id_penjualan_toko']));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;

$html  ="Maaf pesanan anda kami tolak dengan alasan ".$input['alasan']."<br>";

$html .= "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
        <tr>
        <th style="border-bottom: 1px solid rgb(168,207,69);">No</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Nama Buku</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Harga</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Qty</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Jumlah</th>   
        </tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$d++.'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$data['nama_buku'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">Rp. '.number_format($data['harga_buku']).'</td>';       
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$data['qty'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Belanja</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['total_belanja'])."</td>    
</tr>
<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Ongkir </td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";

if($static['nilai_kupon']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode promo ".$static['nama_kupon']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);'  align='center' colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
</tr>";
}

if($static['nilai_kupon']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode kupon ".$static['nama_kupon']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);'  align='center' colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
</tr>";
}

if($static['nilai_promo']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode Promo ".$static['nama_promo']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);'  align='center' colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_promo'])."</td>    
</tr>";
 }
 
$html.= 
"<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Bayar</td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['total_bayar'])."</td>    
</tr></table><hr>";

$html .= "Nama Penerima :".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : <br>".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= $static['nomor_kontak']."<br>"; 

$this->email->message($html);
if (!$this->email->send()){   
    
echo $this->email->print_debugger();

}else{     
    
$input = $this->input->post();

$data = array(
 'status' =>'tolak',
 'alasan_penolakan'=>$input['alasan'],   
);
$this->M_dashboard->input_alasan_penolakan($data,$input['id_penjualan_toko']);

echo "berhasil";
}
}else{
redirect(404);    
}    
}
function input_balance(){
if($this->input->post('nilai_balance')){
$input = $this->input->post();
$data = array(
'royalti_diperoleh' =>$input['nilai_balance']    
);
$this->M_dashboard->simpan_balance($data,$input['id_account']);

echo "berhasil";    
}else{
redirect(404);    
}

    
}
function promo_kupon(){
$produk_laris = $this->M_dashboard->data_produk_laris();
$data_promo = $this->M_dashboard->data_promo();
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_promo_kupon',['data_promo'=>$data_promo,'produk_laris'=>$produk_laris]);
$this->load->view('Umum/V_footer');


}

function set_promo(){
if($this->input->post('nilai_promo')){
$input = $this->input->post();

$data = array(
'kode_promo'  =>$input['kode_promo'],
'nilai_promo' =>$input['nilai_promo'],    
);

$this->M_dashboard->input_promo($data);

echo "berhasil";
}else{
redirect(404);    
}        
}

function set_kupon(){
if($this->input->post('nilai_kupon')){
$input = $this->input->post();

$data = array(
'nama_kupon'    => $input['nama_kupon'],
'id_account'    => $input['id_account'],
'email_penulis' => $input['email_penulis'],
'nama_penulis'  => $input['nama_penulis'],
'nilai_kupon'   => $input['nilai_kupon'],
'syarat_kupon'  => $input['syarat_kupon'],
);

$this->M_dashboard->input_kupon($data);

echo "berhasil";
}else{
redirect(404);    
}        
}

function hapus_promo(){
$id = $this->uri->segment(3);

$this->M_dashboard->hapus_promo($id);

redirect('G_dashboard/promo_kupon');
}

function hapus_kupon(){
$id = $this->uri->segment(3);

$this->M_dashboard->hapus_kupon($id);

redirect('G_dashboard/promo_kupon');
}
function terima_pesanan(){
if($this->input->post('id_penjualan_toko')){
$input = $this->input->post();

$pembeli = $this->M_dashboard->data_pembeli($input['id_penjualan_toko'])->row_array();

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($pembeli['email']);
$this->email->subject('Konfirmasi pembayaran berhasil');

$this->db->where(array('id_penjualan_toko'=>$input['id_penjualan_toko']));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;

$html  ="Pembayaran anda telah kami periksa dan kami terima , terimakasih atas kepercayaan anda berbelanja di Store Guepedia <br>";

$html .= "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
        <tr>
        <th style="border-bottom: 1px solid rgb(168,207,69);">No</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Nama Buku</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Harga</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Qty</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Jumlah</th>   
        </tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$d++.'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$data['nama_buku'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">Rp. '.number_format($data['harga_buku']).'</td>';       
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">'.$data['qty'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center">Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Belanja</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['total_belanja'])."</td>    
</tr>
<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Ongkir </td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";

if($static['nilai_kupon']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode promo ".$static['nama_kupon']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);'  align='center' colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
</tr>";
 }
 
 if($static['nilai_promo']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode promo ".$static['nama_promo']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_promo'])."</td>    
</tr>";
 }
$html.= 
"<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Bayar</td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['total_bayar'])."</td>    
</tr></table><hr>";

$html .= "Nama Penerima :".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : <br>".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= $static['nomor_kontak']."<br>"; 

$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();

}else{ 
   
$input = $this->input->post();
$data = array(
 'status' =>'terima'   
);
$this->M_dashboard->terima_pesanan($data,$input['id_penjualan_toko']);
echo "berhasil";

 }
 

}else{
redirect(404);    
}    
    
}
public function input_seo(){
  

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_data_seo');
$this->load->view('Umum/V_footer');
}

public function simpan_kata_kunci(){
if($this->input->post('kata_kunci')){
  
  $data = array(
  'kata_kunci' => $this->input->post('kata_kunci')     
  );
  $this->M_dashboard->simpan_kata_kunci($data);
  
}else{
redirect(404);    
}
}

public function hapus_seo(){
if($this->uri->segment(3) !=''){

$this->M_dashboard->hapus_seo($this->uri->segment(3));
redirect('G_dashboard/input_seo');
}else{
redirect(404);    
}    
}

public function laporan_bagi_hasil(){

$html  = "<h3 style='padding: 2%; color: #000; background-color: rgb(168, 207, 69);' align='center'>Laporan Bagi Hasil ".date('d F o')."</h3>"; 

$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
        <tr>
        <th style="border-bottom: 1px solid rgb(168,207,69);">No</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">No Rekening</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Atas Nama</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Bank</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Penulis</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);">Jumlah</th>   
        </tr>';

$query = $this->M_dashboard->laporan_bagi_hasil();
$jml =1;

foreach ($query ->result_array() as $lp){
        $html .='<tr><td style="border-bottom: 1px solid rgb(168,207,69);">'.$jml++.'</td>   
        <td style="border-bottom: 1px solid rgb(168,207,69);">'.$lp['nomor_rekening'].'</td>   
        <td style="border-bottom: 1px solid rgb(168,207,69);">'.$lp['nama_pemilik_rekening'].'</td>   
        <td style="border-bottom: 1px solid rgb(168,207,69);">'.$lp['nama_bank'].'</td>   
        <td style="border-bottom: 1px solid rgb(168,207,69);">'.$lp['nama_lengkap'].'</td>   
        <td style="border-bottom: 1px solid rgb(168,207,69);">Rp.'.number_format($lp['royalti_diperoleh']).'</td></tr>';   
        
    
}


$html .="</table>";

    
    
$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));

   
}
}