<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

require('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class G_dashboard extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->library('upload');
$this->load->helper('download');
$this->load->library('Datatables');
$this->load->model('M_dashboard');
$this->load->library('pagination');
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
    
$kategori           = $this->M_dashboard->data_kategori()->num_rows();
$angka              = 3;
$jumlah_kategori    = $kategori;
$id_kategori        = str_pad($jumlah_kategori, $angka ,"0",STR_PAD_LEFT);

$data =array(
'id_kategori_naskah'    => "N_".$id_kategori,
'nama_kategori'         => $this->input->post('nama_kategori'),    
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

if($this->input->post('status') == "Publish"){
$kupon_penulis = explode(' ',$input['penulis']);

$cek_kupon         = $this->M_dashboard->cek_data_kode_kupon($input['id_account'])->num_rows();
$data_penulis      = $this->M_dashboard->data_penulis(base64_encode($input['id_account']))->row_array();

if($cek_kupon == 0){

$data2=array(
"nama_kupon"            => $kupon_penulis[0]."15",
'id_account'            => $input['id_account'],
'email_penulis'         => $data_penulis['email'],
'nama_penulis'          => $data_penulis['nama_lengkap'] ,
'nilai_kupon'           => '15',
'syarat_kupon'          => 0,
'status_kupon'          => 'Permanen'    
);

$this->M_dashboard->input_kode_kupon($data2);

}

}

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
$resize['image_library']  = 'gd2';
$resize['source_image']   = './uploads/file_cover/'.$this->upload->data('file_name');
$resize['create_thumb']   =  FALSE;
$resize['maintain_ratio'] =  TRUE;
$resize['width']     = 700;
$resize['height']   = 700;


$this->load->library('image_lib', $resize); 
$this->image_lib->resize();
        
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


if($this->input->post('status') == "Publish"){
$kupon_penulis = explode(' ',$input['penulis']);

$cek_kupon         = $this->M_dashboard->cek_data_kode_kupon($input['id_account'])->num_rows();
$data_penulis      = $this->M_dashboard->data_penulis(base64_encode($input['id_account']))->row_array();

if($cek_kupon == 0){

$data2=array(
"nama_kupon"            => $kupon_penulis[0]."15",
'id_account'            => $input['id_account'],
'email_penulis'         => $data_penulis['email'],
'nama_penulis'               => $data_penulis['nama_lengkap'] ,
'nilai_kupon'           => '15',
'syarat_kupon'          => 0,
'status_kupon'          => 'Permanen'    
);

$this->M_dashboard->input_kode_kupon($data2);

}

}

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


function produk_diskon(){

$produk_diskon = $this->M_dashboard->data_produk_diskon();

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_set_produk_diskon',['produk_diskon'=>$produk_diskon]);
$this->load->view('Umum/V_footer');


}


function set_diskon_produk(){
if($this->input->post('id_file_naskah')){

$data = array(
'status'      =>'Produk Diskon',
'nilai_diskon'=>$this->input->post('nilai_diskon'),
'hasil_diskon'=>$this->input->post('hasil_diskon'),
);

$this->M_dashboard->set_diskon_produk($data,$this->input->post('id_file_naskah'));

echo "berhasil";

}else{

redirect(404);    
}    

}


function hapus_produk_diskon(){
if($this->uri->segment(3) !=''){

$data = array(
'status'      =>'Publish',
'nilai_diskon'=>'',
'hasil_diskon'=>'',
);

$this->M_dashboard->set_diskon_produk($data, base64_decode($this->uri->segment(3)));


redirect(base_url('G_dashboard/produk_diskon'));

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
. "<td colspan='2'>".number_format($this->session->userdata('subtotal') - $this->session->userdata('nilai_diskon') )."</td>"

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
. "<td colspan='2'>".number_format($this->session->userdata('total') - $this->session->userdata('nilai_diskon'))."</td>"
. "<td colspan='2'>Total Bersih</td>"
. "<td colspan='2'>".number_format($this->session->userdata('total_bersih')- $this->session->userdata('jumlah_diskon_total'))."</td>"
. "</tr>";

echo "</table>";    
$k = $this->session->userdata('total')-$this->session->userdata('nilai_diskon') ;
echo "<input type='hidden' id='total_bayar' class='form-control' value=".$k.">";
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

if($input['nilai_diskon']< 40){

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
'no_invoices'           => 'INV/'.date('Ymd')."/".$no_invoices,   
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
'total'                 => $this->session->userdata('total') - $this->session->userdata('nilai_diskon'),
'total_bersih'          => $this->session->userdata('total_bersih') - $this->session->userdata('jumlah_diskon_total'),
'tanggal_transaksi'     => date('Y-m-d'),
'subtotal'              => $this->session->userdata('subtotal')-$this->session->userdata('nilai_diskon'),
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
'no_invoices'           => 'INV/'.date('Ymd')."/".$no_invoices,   
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
'tanggal_transaksi'     => date('Ymd'),

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


$html .= '<table style="width:100%; text-align:center;" border="1" cellspacing="-1" cellpadding="0"  >'
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
<td>' . $penjualan['diskon'] . ' % </td>
<td>Rp.'.number_format($penjualan['nilai_diskon']) .'</td>
<td>Rp.'.number_format($penjualan['royalti']).'</td>
<td>Rp.'.number_format($penjualan['bersih']).'</td>
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
ini_set('memory_limit', '500M');
$tanggal = $this->input->post('dates');
$range = explode(' ', $tanggal);
$range1 = $range[0];
$range2 = $range[2];
if($this->input->post('tipe') == "PDF"){

$this->buat_laporan_pdf($range1, $range2);
}else{
$this->buat_laporan_excel($range1, $range2);

    
}    
    
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

$html = "
<style>    
@page {
  size: 21cm 29.7cm;
 margin: 0.2cm 1.5cm ;
}
</style>
";
$html  .="<h1 align='center'><img style=' width:auto; height:35px; ' src='".base_url('assets/img/logo-toko.png')."'></h1><hr>";



$html .="<h4 >KEPADA : ".$data_static['nama_customer']. " / Nomor HP  : ".$data_static['nomor_kontak']."<br>";
$html .=$data_static['alamat_lengkap']."<br> ".$data_static['nama_biaya_lain']."</h4>";

$html .="<h4 >PENGIRIM :  GUEPEDIA<br> Bukit Golf Arcadia Blok AR 118 , Bojong Nangka, Gunung Putri Bogor / 081287602508</h4>";

$date1            = date_create($data_static['tanggal_transaksi']);
$tanggal_beli    = date_format($date1,"d F o");

$html .="<hr>";
$html .="<table border ='1' style='width:100%; font-size:15px;    padding:0; margin:0;   border-collapse: collapse;'>";
$html .="<tr><td width='80%'> ".$data_static['nama_biaya_lain']."";
$html .=" Rp. ".number_format($data_static['jumlah_biaya_lain'])." / Tanggal : ".$tanggal_beli." / ".$data_static['penjualan']."</td>"
        . "<td align='center'>Qty</td><td align='center'>Cover</td><td align='center'>Isi</td></tr> ";
foreach ($data->result_array() as $penjualan){
$html .= '<tr><td>' . $penjualan['judul_buku'] . ' <td align="center">' . $penjualan['qty'].'</td></td><td></td><td></td></tr>';
} 
$html .="<table>";




$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
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
$data_bukti    = $this->M_dashboard->data_bukti($this->uri->segment(4));

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_buat_transfer',['data_bukti'=>$data_bukti,'data_penulis'=>$data_penulis,'total_royalti'=>$total_royalti,'total_naskah'=>$total_naskah]);
$this->load->view('Umum/V_footer');


}

public function simpan_transfer_royalti(){
if($this->input->post('id_data_pengajuan')){

$id_account      = $this->db->get_where('data_pengajuan_royalti',array('id_data_pengajuan'=> base64_decode($this->input->post('id_data_pengajuan'))))->row_array();    
$penerima        = $this->db->get_where('akun_penulis',array('id_account'=>$id_account['id_account']))->row_array();


$config2['upload_path']          = './uploads/bukti_transfer/';
$config2['allowed_types']        = 'jpeg|jpg|png|gif';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if(!$this->upload->do_upload('bukti_transfer')){
echo $this->upload->display_errors();
}else{
$data = array(
'bukti_transfer'        =>$this->upload->data('file_name'),    
'status'                =>"Selesai",
'tanggal_konfirmasi'    =>date('d F o H:i:s')   
);
$this->M_dashboard->simpan_transfer($data,$this->input->post('id_data_pengajuan'));

echo "berhasil";


$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($penerima['email']);
$this->email->subject('Penarikan Bagi Hasil Guepedia');
$this->email->attach('./uploads/bukti_transfer/'.$this->upload->data('file_name'));

$html = "Kepada Yth : ".$penerima['nama_lengkap']."<br>"
       ."Mengenai penarikan bagi hasil yang diajukan pada ".$id_account['tanggal_pengajuan']."<br>"
       ."Dengan Nomor pnarikan : ".$id_account['nomor_penarikan']."<br><br>"
       ."Kami ingin memberitahukan bahwa pengajuan tersebut telah selesai kami proses dan di transfer ke nomor rekening sebagai berikut <br><br>"
       ."Nomor Rekening : ".$penerima['nomor_rekening']."<br>"
       ."Nama Bank :".$penerima['nama_bank']."<br>"
       ."Nama Pemilik Rekening : ".$penerima['nama_pemilik_rekening']." <br>"
       ."Sejumlah :<b> Rp.".number_format($id_account['royalti_ditarik'])."</b><br><br>"
       ."berikut kami lampirkan bukti transfernya <br>"
       ."Atas perhatian dan kerjasamanya kami ucapkan terimakasih  <br><br>"
       ."Hormat kami <br><br>"
       ."Admin Guepedia";

$this->email->message($html);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}
}

}else{
redirect(404);    
} 
}

public function download_bukti(){
$bukti_transfer = $this->M_dashboard->data_bukti($this->uri->segment(3))->row_array();

$html  ="<img src='".base_url('assets/img/logo-toko.png')."'>";
$html .="<h2 style='position:fixed;' align='right'><br>Data Penarikan Bagi Hasil</h2><hr>";
$html .="<table>"
        . "<tr><td>Nomor Penarikan</td><td>: ".$bukti_transfer['nomor_penarikan']."</td></tr>"
        . "<tr><td>Akun Penulis</td><td>: ".$bukti_transfer['nama_lengkap']."</td></tr>"
        . "<tr><td>Nomor Kontak</td><td>: ".$bukti_transfer['nomor_kontak']."</td></tr>"
        . "<tr><td>Tanggal Pengajuan</td><td>: ".$bukti_transfer['tanggal_pengajuan']."</td></tr>"
        . "<tr><td>Nama Rekening</td><td>: ".$bukti_transfer['nama_pemilik_rekening']."</td></tr>"
        . "<tr><td>Nomor Rekening</td><td>: ".$bukti_transfer['nomor_rekening']."</td></tr>"
        . "<tr><td>Nama Bank</td><td>: ".$bukti_transfer['nama_bank']."</td></tr>"
        . "</table>";


$html .="<h2 align='center'>Detail Penarikan <br> Status Penarikan ".$bukti_transfer['status']."</h2>";
$html .= '<table style="width:100%; text-align:center;" border="1" cellspacing="0" cellpadding="2"  >'
        . '<tr>'
        . '<th>Bagi Hasil</th>'
        . '<th>Biaya Admin</th>'
        . '<th>Di Tarik</th>'
        . '<th>Jumlah Penarikan</th>'
        . '<th>Sisa Bagi Hasil</th>'
        . '</tr>';
$html  .="<tr>"
        . "<td>Rp.".number_format($bukti_transfer['royalti_sebelumnya'])."</td>"
        . "<td>Rp.".number_format($bukti_transfer['biaya_admin'])."</td>"
        . "<td>Rp.".number_format($bukti_transfer['royalti_ditarik'])."</td>"
        . "<td>Rp.".number_format($bukti_transfer['jumlah_penarikan'])."</td>"
        . "<td>Rp.".number_format($bukti_transfer['royalti_diperoleh'])."</td>"
        . "</tr>"
        . "</table>"
        . "<hr>"
        . "<i>Note:</i> Proses Penarikan hannya akan di proses pada tanggal 5-10 di setiap Bulannya";

if($bukti_transfer['bukti_transfer'] != NULL){
  $html.="<hr> <i>Note</i> : Bukti Transfer<br>"
          . "<img style='width:300px; heght:auto;' src=". base_url('uploads/bukti_transfer/'.$bukti_transfer['bukti_transfer']).">";  
}


$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));
    
    
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
if($static['status'] == 'pending'){
$html  ="<div  style='position:fixed ;  left:0px;  width:19.5 cm; height:10cm; '>
            <br></br><br></br><br></br><br></br><br></br>
            <img src='".base_url('assets/img/watermark/belum_bayar.png')."' height='100%' width='100%' />
        </div>";    
    
}else if($static['status'] == 'proses'){
$html  ="<div  style='position:fixed ;  left:0px;  width:19.5 cm; height:10cm; '>
            <br></br><br></br><br></br><br></br><br></br>
            <img src='".base_url('assets/img/watermark/tertunda.png')."' height='100%' width='100%' />
        </div>";
}else if($static['status'] == 'terima' || $static['status'] == 'selesai'){
$html  ="<div  style='position:fixed ;  left:0px;  width:19.5 cm; height:10cm; '>
            <br></br><br></br><br></br><br></br><br></br>
            <img src='".base_url('assets/img/watermark/lunas.png')."' height='100%' width='100%' />
        </div>";    
}else if($static['status'] == 'tolak'){
$html  ="<div  style='position:fixed ;  left:0px;  width:19.5 cm; height:10cm; '>
            <br></br><br></br><br></br><br></br><br></br>
            <img src='".base_url('assets/img/watermark/tolak.png')."' height='100%' width='100%' />
        </div>";        
}

$html .="<img style='position:absolute;' src='".base_url('assets/img/logo-toko.png')."'>";
$html .= "<h3 align='center'>Guepedia <br>No.Invoices ".$static['invoices_toko']."</h3><hr>"; 

$html .= "Nama Pemesan / No.Kontak : ".$static['nama_penerima']." / ".$static['nomor_kontak']. "<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br><br>"; 

$html .= '<table style="width:100%; " border="1" cellspacing="0" cellpadding="2" >
<tr>
<th align="center">No</th>   
<th align="center">Rincian</th>   
<th align="center">Harga</th>   
<th align="center">Qty</th>   
<th align="center">Total</th>   
</tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td align="center">'.$d++.'</td>';
$html .='<td>'.$data['nama_buku'].'</td>';
$html .='<td>Rp. '.number_format($data['harga_buku']).'</td>';       
$html .='<td>'.$data['qty'].'</td>';
$html .='<td>Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="
<tr>
<td align='center' colspan='1'>".$d." </td>    
<td colspan='1'>Ongkir ".$static['kurir']." ".$static['service']."</td>    
<td colspan='1'></td>    
<td colspan='1'>".number_format($static['total_berat'])." Gram</td>    
<td  colspan='1'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<th colspan='4'>Kode kupon ".$static['nama_kupon']." ".$static['nilai_kupon'] ." %</th>    
<th  colspan='1' style='color:#dc3545;'> - Rp. ".number_format($static['hasil_kupon'])."</th>    
</tr>";
}

if($static['nilai_promo']){ 
$html .= "<tr>
<th colspan='4'>Kode promo ".$static['nama_promo']." ".$static['nilai_promo'] ." %</th>    
<th  colspan='1' style='color:#dc3545;'> - Rp. ".number_format($static['hasil_promo'])."</th>    
</tr>";
}

$html.= 
"<tr>
<th colspan='4'>Total Bayar</th>    
<th  colspan='1'>Rp. ".number_format($static['total_bayar'])."</th>    
</tr></table>";

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

$html .= "<div style='text-align:left;'>Pemesan / No.kontak : ".$static['nama_penerima']." / ".  $static['nomor_kontak'] ."<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br> </div>"; 


$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
<tr>
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">No</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Rincian</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Harga</th>   
<th style="border: 1px solid rgb(168,207,69); text-align:center;">Qty</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Total</th>   
</tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td style="border: 1px solid rgb(168,207,69);" align="center"  >'.$d++.'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);" >'.$data['nama_buku'].'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);"  > Rp.'.number_format($data['harga_buku']).'</td>';       
$html .='<td style="border: 1px solid rgb(168,207,69);"  >'.$data['qty'].'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);" >Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="
<tr>
<td style='border: 1px solid rgb(168,207,69);' align='center'  colspan='1'>".$d."</td>
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'>Ongkir ".$static['kurir']." ".$static['service']."</td>    
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'></td>
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'>".$static['total_berat']." Gram</td>
<td style='border: 1px solid rgb(168,207,69);'colspan='1'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<th style='border: 1px solid rgb(168,207,69);' colspan='4' >Kode kupon " .$static['nama_kupon']." ".$static['nilai_kupon']." %</th>    
<th style='border: 1px solid rgb(168,207,69);' colspan='1'  style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</th>    
</tr>";
}

if($static['nilai_promo']){ 
$html .= "<tr>
<th style='border: 1px solid rgb(168,207,69);' colspan='4' >Kode promo " .$static['nama_promo']." ". $static['nilai_promo']." %</th>    
<th style='border: 1px solid rgb(168,207,69);' colspan='1'  style='color:#dc3545;'> - Rp".number_format($static['hasil_promo'])."</th>    
</tr>";
}

$html.= 
"<tr>
<th style='border: 1px solid rgb(168,207,69);'   colspan='4'>Total Bayar</th>    
<th style='border: 1px solid rgb(168,207,69);'  colspan='1'>Rp.".number_format($static['total_bayar'])."</th>    
</tr></table> <br>";

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
$this->email->subject('Konfirmasi pesanan di batalkan');

$this->db->where(array('id_penjualan_toko'=>$input['id_penjualan_toko']));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;

$html  ="Maaf pesanan anda kami tolak dengan alasan ".$input['alasan']."<br>";

$html .= "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .= "<div style='text-align:left;'>Pemesan / No.kontak : ".$static['nama_penerima']." / ".  $static['nomor_kontak'] ."<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br> </div>"; 


$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
<tr>
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">No</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Rincian</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Harga</th>   
<th style="border: 1px solid rgb(168,207,69); text-align:center;">Qty</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Total</th>   
</tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td style="border: 1px solid rgb(168,207,69);" align="center"  >'.$d++.'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);" >'.$data['nama_buku'].'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);"  > Rp.'.number_format($data['harga_buku']).'</td>';       
$html .='<td style="border: 1px solid rgb(168,207,69);"  >'.$data['qty'].'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);" >Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="
<tr>
<td style='border: 1px solid rgb(168,207,69);' align='center'  colspan='1'>".$d."</td>
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'>Ongkir ".$static['kurir']." ".$static['service']."</td>    
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'></td>
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'>".$static['total_berat']." Gram</td>
<td style='border: 1px solid rgb(168,207,69);'colspan='1'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<th style='border: 1px solid rgb(168,207,69);' colspan='4' >Kode kupon " .$static['nama_kupon']." ".$static['nilai_kupon']." %</th>    
<th style='border: 1px solid rgb(168,207,69);' colspan='1'  style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</th>    
</tr>";
}

if($static['nilai_promo']){ 
$html .= "<tr>
<th style='border: 1px solid rgb(168,207,69);' colspan='4' >Kode promo " .$static['nama_promo']." ". $static['nilai_promo']." %</th>    
<th style='border: 1px solid rgb(168,207,69);' colspan='1'  style='color:#dc3545;'> - Rp".number_format($static['hasil_promo'])."</th>    
</tr>";
}

$html.= 
"<tr>
<th style='border: 1px solid rgb(168,207,69);'   colspan='4'>Total Bayar</th>    
<th style='border: 1px solid rgb(168,207,69);'  colspan='1'>Rp.".number_format($static['total_bayar'])."</th>    
</tr></table> <br>";

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
'nama_kupon'      => $input['nama_kupon'],
'id_account'      => $input['id_account'],
'email_penulis'   => $input['email_penulis'],
'nama_penulis'    => $input['nama_penulis'],
'nilai_kupon'     => $input['nilai_kupon'],
'syarat_kupon'    => $input['syarat_kupon'],
'status_kupon'    => "Expired",
'tanggal_expired' => date('d-m-Y', strtotime("+3 day"))
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

$html .= "<div style='text-align:left;'>Pemesan / No.kontak : ".$static['nama_penerima']." / ".  $static['nomor_kontak'] ."<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br> </div>"; 


$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
<tr>
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">No</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Rincian</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Harga</th>   
<th style="border: 1px solid rgb(168,207,69); text-align:center;">Qty</th>   
<th  style="border: 1px solid rgb(168,207,69); text-align:center;">Total</th>   
</tr>';

foreach ($data_orderan->result_array() as $data){
$html .='<tr>';    
$html .='<td style="border: 1px solid rgb(168,207,69);" align="center"  >'.$d++.'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);" >'.$data['nama_buku'].'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);"  > Rp.'.number_format($data['harga_buku']).'</td>';       
$html .='<td style="border: 1px solid rgb(168,207,69);"  >'.$data['qty'].'</td>';
$html .='<td style="border: 1px solid rgb(168,207,69);" >Rp. '.number_format($data['subtotal']).'</td>';       
$html .='</tr>';
} 

$html .="
<tr>
<td style='border: 1px solid rgb(168,207,69);' align='center'  colspan='1'>".$d."</td>
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'>Ongkir ".$static['kurir']." ".$static['service']."</td>    
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'></td>
<td style='border: 1px solid rgb(168,207,69);'  colspan='1'>".$static['total_berat']." Gram</td>
<td style='border: 1px solid rgb(168,207,69);'colspan='1'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<th style='border: 1px solid rgb(168,207,69);' colspan='4' >Kode kupon " .$static['nama_kupon']." ".$static['nilai_kupon']." %</th>    
<th style='border: 1px solid rgb(168,207,69);' colspan='1'  style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</th>    
</tr>";
}

if($static['nilai_promo']){ 
$html .= "<tr>
<th style='border: 1px solid rgb(168,207,69);' colspan='4' >Kode promo " .$static['nama_promo']." ". $static['nilai_promo']." %</th>    
<th style='border: 1px solid rgb(168,207,69);' colspan='1'  style='color:#dc3545;'> - Rp".number_format($static['hasil_promo'])."</th>    
</tr>";
}

$html.= 
"<tr>
<th style='border: 1px solid rgb(168,207,69);'   colspan='4'>Total Bayar</th>    
<th style='border: 1px solid rgb(168,207,69);'  colspan='1'>Rp.".number_format($static['total_bayar'])."</th>    
</tr></table> <br>";

$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();

}else{ 
   
$input = $this->input->post();
$data = array(
 'status'         =>'terima',
 'tanggal_terima' => date('Y-m-d H:i:s'),
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
public function infokan(){
if($this->input->post('id_file_naskah')){

$data_info = $this->M_dashboard->data_info($this->input->post('id_file_naskah'))->row_array();

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($data_info['email']);
$this->email->subject('Informasi Status Naskah');
$html = "<h3 style='padding: 2%; color: #000; background-color: rgb(168, 207, 69);' align='center'>Informasi Status Naskah</h3>"; 
$html.= "Hai Kak ".$data_info['nama_lengkap']." Kami Dari Guepedia.com ingin memberitahukan status naskah kaka "
        ."yang diupload pada tanggal ".$data_info['tanggal_upload']."<br>"
        ."<hr>Judul : ".$data_info['judul']."<hr>"
        ."Status : ".$data_info['status']."<br><hr>";

$html .= $this->input->post('informasi');


$html .="<br><br>Atas perhatian dan kerjasamanya kami ucapkan terimakasih Salam Guepedia :-)";


$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
echo "berhasil";    

$data = array(
'nama'      =>$data_info['nama_lengkap'],
'email'     =>$data_info['email'],
'id_account'=>$data_info['id_account'],
'isi_email' =>$this->input->post('informasi'),
'subjek'    =>"Informasi Status Naskah",
    
);
$this->db->insert('riwayat_email',$data);


}
}else{
redirect(404);    
}    
    
}

public function banner(){
$query = $this->M_dashboard->data_banner();
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_menu_toko');
$this->load->view('Halaman_dashboard/V_banner',['query'=>$query]);
$this->load->view('Umum/V_footer');

}

public function hapus_naskah(){
if($this->input->post('id_file_naskah')){

$this->M_dashboard->hapus_naskah($this->input->post('id_file_naskah'));

echo "berhasil";
}else{
redirect(404);    
}   
}


public function halaman_email(){
$data_akun = $this->M_dashboard->data_akun($this->uri->segment(3));
$total_email = $this->M_dashboard->data_email($this->uri->segment(3));

$config['base_url']         = base_url('G_dashboard/halaman_email/'.$this->uri->segment(3));
$config['total_rows']       = $total_email->num_rows();
$config['per_page']         = 5;

$config['full_tag_open']    = '<ul class="pagination">';
$config['full_tag_close']   = '</ul>';
$config['attributes']       = ['class' => 'page-link'];
$config['first_link']       = false;
$config['last_link']        = false;
$config['first_tag_open']   = '<li class="page-item">';
$config['first_tag_close']  = '</li>';
$config['prev_link']        = '&laquo';
$config['num_links']        = 3;
$config['prev_tag_open']    = '<li class="page-item">';
$config['prev_tag_close']   = '</li>';
$config['next_link']        = '&raquo';
$config['next_tag_open']    = '<li class="page-item">';
$config['next_tag_close']   = '</li>';
$config['last_tag_open']    = '<li class="page-item">';
$config['last_tag_close']   = '</li>';
$config['cur_tag_open']     = '<li class="page-item active"><a href="#" class="page-link">';
$config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';
$config['num_tag_open']     = '<li class="page-item">';
$config['num_tag_close']    = '</li>';

$this->pagination->initialize($config);

$data_email= $this->M_dashboard->tampil_email($this->uri->segment(3),$config['per_page'],$this->uri->segment(4));

$this->load->view('Umum/V_header');
$this->load->view('Halaman_dashboard/V_menu');
$this->load->view('Halaman_dashboard/V_halaman_email',['data_akun'=>$data_akun,'data_email'=>$data_email]);

$this->load->view('Umum/V_footer');   
}

public function json_data_pengajuan_royalti(){
echo $this->M_dashboard->json_data_pengajuan_royalti();       
}

public function json_data_pengajuan_bagi_hasil_selesai(){
echo $this->M_dashboard->json_data_pengajuan_bagi_hasil_selesai();       
}

public function json_data_pengajuan_bagi_hasil_dibatalkan(){
echo $this->M_dashboard->json_data_pengajuan_bagi_hasil_dibatalkan();       
}

public function get_penjualan(){
if($this->input->post('id_data_penjualan')){
$query = $this->M_dashboard->get_penjualan($this->input->post('id_data_penjualan'));
$data_static = $query->row_array();

echo "Nama customer :".$data_static['nama_customer']."<br>";
echo "Nomor kontak  :".$data_static['nomor_kontak']."<br>";
echo "Alamat lengkap :".$data_static['alamat_lengkap']."<br><hr>";

echo  '<table style="width:100%;"  class="table table-striped  table-responsive" >'
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


foreach ($query->result_array() as $penjualan){
echo '<tr>
<td>' . $penjualan['judul_buku'] . '</td>
<td>' . $penjualan['nama_penulis'] . '</td>
<td>Rp.' . number_format($penjualan['harga']) . '</td>
<td>' . $penjualan['qty'].'</td>
<td>Rp.' . number_format($penjualan['jumlah']) . ' </td>
<td>' . $penjualan['diskon'] . ' % </td>
<td>Rp.' . number_format($penjualan['nilai_diskon']) . '</td>
<td>Rp.' . number_format($penjualan['royalti']) . '</td>
<td>Rp.' . number_format($penjualan['bersih']) . '</td>
</tr>';
}

echo "<tr>"
. "<td colspan='4'>Sub Total</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['subtotal'])."</td>"
. "<td>Rp. ".number_format($data_static['jumlah_diskon'])."</td>"
. "<td>Rp. ".number_format($data_static['total_royalti'])."</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['total_bersih'])."</td>"
. "</tr>";

if($data_static['nama_biaya_lain'] !=''){
echo  "<tr>"
. "<td colspan='4'>".$data_static['nama_biaya_lain']."</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['jumlah_biaya_lain'])."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"
. "</tr>";
}

if ($data_static['nilai_ppn'] !=''){
echo "<tr>"
. "<td colspan='4'>PPN 10 %</td>"
. "<td colspan='2'>Rp.".number_format($data_static['nilai_ppn'])."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"
. "</tr>";
}

if($data_static['diskon_total'] !=''){
echo "<tr>"
. "<td colspan='4'>Diskon ".$data_static['diskon_total']." %</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['jumlah_diskon_total'])."</td>"
. "<td colspan='2'></td>"
. "<td colspan='2'></td>"
. "</tr>";
}

echo "<tr>"
. "<td colspan='4'>Total Bayar</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['total'])."</td>"
. "<td colspan='2'>Total Bersih</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['total_bersih'])."</td>"
. "</tr>";
echo "<tr>"
. "<td colspan='4'>Jumlah uang</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['jumlah_uang'])."</td>"
. "<td colspan='2'>Kembalian</td>"
. "<td colspan='2'>Rp. ".number_format($data_static['kembalian'])."</td>"
. "</tr>";



echo '</table>';



}else{
redirect(404);    
}

}

public function simpan_banner(){
if($_FILES['banner']){
$config2['upload_path']          = './uploads/banner/';
$config2['allowed_types']        = 'jpeg|jpg|png|gif|webp';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;
$this->upload->initialize($config2);

if(!$this->upload->do_upload('banner')){   

echo $this->upload->display_errors();
}else{
    
$data =array(
'nama_banner'      => $this->upload->data('file_name'),
);  

$this->M_dashboard->simpan_banner($data);

redirect(base_url('G_dashboard/banner'));
}

}else{
    redirect(404);    
}
}

public function hapus_banner(){
if($this->uri->segment(3)){ 
unlink('./uploads/banner/'.$this->uri->segment(4));   

$this->M_dashboard->hapus_banner($this->uri->segment(3));
redirect(base_url('G_dashboard/banner'));
}else{
redirect(404);    
}
}
public function data_chart(){
$tanggal = $this->input->post('tanggal');
$range   = explode(' ',$tanggal);

$this->db->group_by('data_penjualan.tanggal_transaksi');
$this->db->where('data_penjualan.tanggal_transaksi >=',$range[0]);
$this->db->where('data_penjualan.tanggal_transaksi <=',$range[2]);
$query = $this->db->get('data_penjualan');

if($query->num_rows() >0){

    
$tanggal_transaksi  = array();    
$jumlah_pendapatan  = array();   
$jumlah_royalti     = array();    
$jumlah_bersih      = array();


foreach ($query->result()  as $hari) {
$tanggal_transaksi['tanggal_transaksi'][] = $hari->tanggal_transaksi;
} 

foreach ($query->result_array()  as $pendapatan) {
$query2 = $this->db->get_where('data_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));
$total_pendapatan = 0;

foreach($query2->result_array() as  $hasil_pendapatan){
$total_pendapatan += $hasil_pendapatan['subtotal'];
}

$jumlah_pendapatan['jumlah_pendapatan'][] = $total_pendapatan;
}


foreach ($query->result_array()  as $pendapatan) {
$query3 = $this->db->get_where('data_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));
$total_bersih = 0;
foreach($query3->result_array() as  $hasil_bersih){
$total_bersih += $hasil_bersih['total_bersih'];
}
$jumlah_bersih['jumlah_bersih'][] = $total_bersih;
}

foreach ($query->result_array()  as $pendapatan) {
$query4 = $this->db->get_where('data_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));
$total_royalti = 0;
foreach($query4->result_array() as  $hasil_royalti){
$total_royalti += $hasil_royalti['total_royalti'];
}
$jumlah_royalti['jumlah_royalti'][] = $total_royalti;
}

$data = array(
$tanggal_transaksi,    
$jumlah_pendapatan , 
$jumlah_royalti,    
$jumlah_bersih,
);
echo json_encode($data);

}else{
echo "kosong";    
}
}

public function batalkan_penarikan(){
if($this->input->post()){    
$input = $this->input->post();
$query1 = $this->db->get_where('data_pengajuan_royalti',array('id_data_pengajuan'=>base64_decode($input['id_data_pengajuan'])))->row_array();    
$query2 = $this->db->get_where('akun_penulis',array('id_account'=> base64_decode($input['id_account'])))->row_array();    

$data = array(
'royalti_diperoleh' => $query2['royalti_diperoleh']+$query1['biaya_admin']+$query1['royalti_ditarik']    
);

$data2 = array(
'status' => "Dibatalkan",
'alasan' => $input['alasan']    
);

$this->db->update('akun_penulis',$data,array('id_account'=> base64_decode($input['id_account'])));
$this->db->update('data_pengajuan_royalti',$data2,array('id_data_pengajuan'=>base64_decode($input['id_data_pengajuan'])));
$kembali = $query2['royalti_diperoleh']+$query1['biaya_admin']+$query1['royalti_ditarik'];
$this->email_batalkan_penarikan($query2,$query1,$input['alasan'],$kembali);

}else{
redirect(404);    
}    
}

public function email_batalkan_penarikan($data,$data2,$alasan,$kembali){
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($data['email']);
$this->email->subject('Pembatalan penarikan bagi hasil');

$html = "Kepada Yth : ".$data['nama_lengkap']."<br>"
       ."Mengenai penarikan bagi hasil yang diajukan pada ".$data2['tanggal_pengajuan']."<br>"
       ."Dengan Nomor pnarikan : ".$data2['nomor_penarikan']."<br><br>"
       ."Kami ingin memberitahukan bahwa pengajuan tersebut telah kami batalkan dengan alasan ".$alasan."<br><br>"
       ."dan total yang anda tarik sejumlah <b>Rp. " .number_format($kembali)."</b> telah kami kembalikan ke saldo bagi hasil anda. <br>"
        
       ."Atas perhatian dan kerjasamanya kami ucapkan terimakasih  <br><br>"
       ."Hormat kami <br><br>"
       ."Admin Guepedia";

$this->email->message($html);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
echo "berhasil";    
}

}
public function buat_laporan_excel($range1,$range2){
    
$this->db->select('*');
$this->db->where('data_penjualan.tanggal_transaksi >=',$range1);
$this->db->where('data_penjualan.tanggal_transaksi <=',$range2);
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$query = $this->db->get();
  
$header = array("No invoices","Resi", "Customer", "Dari", "Judul Buku","Harga","Qty", "Jumlah","Diskon","Nilai Diskon","Bagi Hasil","Ongkir","Bersih");

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$no=2;
$sheet->fromArray([$header], NULL, 'A1');

foreach ($query->result_array() as $penjualan){
$dataarray = array(
$penjualan['no_invoices'],
$penjualan['resi_pengiriman'],
$penjualan['nama_customer'] ,
$penjualan['penjualan'],
$penjualan['judul_buku'],
$penjualan['harga'],
$penjualan['qty'],
$penjualan['jumlah'],
$penjualan['diskon'],
$penjualan['nilai_diskon'],
$penjualan['royalti'],
$penjualan['jumlah_biaya_lain'],
$penjualan['bersih']
    
);    
$sheet->fromArray([$dataarray], NULL, 'A'.$no++.'');    
}

$writer = new Xlsx($spreadsheet);
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Laporan Penjualan.xlsx"');
$writer->save('php://output');  
    
}
public function buat_laporan_pdf($range1,$range2){
$dari   = date("d F o", strtotime($range1));
$sampai = date("d F o", strtotime($range2));

$this->db->select('*');
$this->db->where('data_penjualan.tanggal_transaksi >=',$range1);
$this->db->where('data_penjualan.tanggal_transaksi <=',$range2);
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$query = $this->db->get();

$html = "
<style>    
@page {
 margin: 1cm 0.5cm ;

}
</style>
";
$html  .= "<h2 align='center'>Laporan Penjualan ".$dari." Sampai ".$sampai."</h2>"; 

$html .= '<table style="width:100%; font-size:13px;" border="1" cellspacing="0" e cellspading="2"  >'
. '<tr>'
. '<th align="center" style="">Invoices</th>'
. '<th align="center" style="">Resi</th>'
. '<th align="center" style="">Customer</th>'
. '<th align="center" style="">Dari</th>'
. '<th align="center" style="">Judul Buku</th>'
. '<th align="center" style="">Harga</th>'
. '<th align="center" style="">Qty</th>'
. '<th align="center" style="">Jumlah</th>'
. '<th align="center" style="">Diskon</th>'
. '<th align="center" style="">Nilai Diskon</th>'
. '<th align="center" style="">Bagi Hasil</th>'
. '<th align="center" style="">Ongkir </th>'
. '<th align="center" style="">Bersih</th>'
. '<th align="center" width="5%" style="">Ket</th>'
. '</tr>';

$bagi_hasil =0 ;
$bersih     =0 ;
$ongkir     =0 ;
foreach ($query->result_array() as $penjualan){
$html .= '<tr>
<td align="center" style="">' . $penjualan['no_invoices'] . '</td>
<td align="center" style="">' . $penjualan['resi_pengiriman'] . '</td>
<td align="center" style="">' . $penjualan['nama_customer'] . '</td>
<td align="center" style="">' . $penjualan['penjualan'] . '</td>
<td align="center" style="">' . $penjualan['judul_buku'] . '</td>
<td align="center" style="">Rp.' . number_format($penjualan['harga']) . '</td>
<td align="center" style="">' . $penjualan['qty'].'</td>
<td align="center" style="">Rp.' . number_format($penjualan['jumlah']) . '</td>
<td align="center" style="">' . $penjualan['diskon'] . ' %</td>
<td align="center" style="">Rp.' . number_format($penjualan['nilai_diskon']) . '</td>
<td align="center" style="">Rp.' . number_format($penjualan['royalti']) . '</td>
<td align="center" style="">Rp.' . number_format($penjualan['jumlah_biaya_lain']) . '</td>
<td align="center" style="">Rp.' . number_format($penjualan['bersih']) . '</td>
<td align="center" style=""> </td>
</tr>';

$bagi_hasil += $penjualan['royalti'];
$bersih     += $penjualan['bersih'];
$ongkir     += $penjualan['jumlah_biaya_lain'];
}

$html .="<tr>"
      ."<td colspan='10'>Total</td>"
      ."<td colspan='1'>Rp. ". number_format($bagi_hasil)."</td>"
      ."<td colspan='1'>Rp. ". number_format($ongkir)."</td>"
      ."<td colspan='2'>Rp. ". number_format($bersih)."</td>"
      ."</tr>";


$html .="</table>";

$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('F4', 'landscape');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));


    
}

public function kirim_email(){

if($this->input->post('email')){
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
$this->email->subject($input['subjek']);

$html = $input['data_isi_email'];

$this->email->message($html);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
$data = array(
'nama'      =>$input['nama'],
'email'     =>$input['email'],
'id_account'=>base64_decode($input['id_account']),
'isi_email' =>$input['data_isi_email'],
'subjek'    =>$input['subjek'],
    
);
$this->db->insert('riwayat_email',$data);

echo "berhasil";    
}    
}else{
redirect(404);    
}
    
}

}