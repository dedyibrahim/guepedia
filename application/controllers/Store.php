<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Store extends CI_Controller {
public function __construct() {
parent::__construct();
$this->load->library('pagination');
$this->load->model('M_store');
$this->load->library('cart');
$this->load->library('Datatables');
$this->load->library('upload');
}

public function index(){
$baru_terbit = $this->M_store->baru_terbit();    
$terlaris    = $this->M_store->terlaris();    

$this->load->view('Umum/V_header_toko');
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

if($kategori->num_rows() > 0){

$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_kategori',['kategori'=>$kategori]);
echo $this->pagination->create_links();
$this->load->view('Umum/V_footer_toko');
}else{
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_kategori_kosong');
$this->load->view('Umum/V_footer_toko');    
}

}else {
redirect(404);    
}
}
public function cari_buku(){

$kata_kunci = $this->input->post('kata_kunci');

$hasil_cari = $this->M_store->cari_buku($kata_kunci);    
if($hasil_cari->num_rows() > 0){
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
<div class='card-footer'>";
echo '<button onclick="tambah_keranjang('."'".base64_encode($data['id_file_naskah'])."'".')" class="btn btn-success form-control"><b>Rp.'.number_format($data['harga'])."</b> <span class='fa fa-shopping-basket '></span></button>    



</div>
</div>
</div>";
}
echo "</div>";
}else{
 $this->load->view('not_found.php');     
}

}

function lihat_buku(){

$id_file_naskah = $this->uri->segment(3);
$query = $this->M_store->data_buku($id_file_naskah);
if($query->num_rows() > 0 ){

$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_buku',['data'=>$query]);
$this->load->view('Umum/V_footer_toko');


}else{
redirect('Store');    
}
}
function tambah_keranjang(){
if($this->input->post('id_file_naskah')){
$id_file_naskah = $this->input->post('id_file_naskah'); 
$query = $this->M_store->tambah_keranjang($id_file_naskah)->row_array();    

$data = array(
'id'            => $query['id_file_naskah'],
'qty'           => $this->input->post('qty'),
'price'         => $query['harga'],
'name'          => $query['judul'],
'berat'         => $query['berat_buku'],
'id_account'    => $query['id_account'],

);

$this->cart->insert($data);
echo $query['judul'];

$unset = array(
'nilai_kupon', 
'hasil_kupon',
'nama_kupon',
'ongkir',
'kurir',
'service',        
'nilai_promo', 
'hasil_promo',
'nama_promo',
);
$this->session->unset_userdata($unset);
}else{
redirect(404);    
}    

}
function keranjang_header(){

foreach ($this->cart->contents() as $items){
echo "<span style='color:#28a745; font-size:15px;'>".$items['name']."</span><br> ";    
echo "Rp. ". number_format($items['price'])." X ";    
echo number_format($items['qty'])." = ";    
echo "Rp. ".number_format($items['subtotal'])."<br>";    
}    
echo "<hr><span style='color:#28a745; font-size:18px; text-align: center;'>Total : Rp. ".number_format($this->cart->total())."</span>";

}
function keranjang(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_keranjang');
$this->load->view('Umum/V_footer_toko');    
}
function keranjang_total(){
if($this->cart->total() == 0){

echo "<h1 align='center'>Keranjang anda masih kosong <br> <hr><a href='".base_url('Store')."'><button class='btn btn-success btn-lg'>Mulai Belanja !!!</button></a></h1><hr>"; 

}else{    
echo '<table style="text-align:  center;" class="table table-md table-striped table-condensed">
<tr>
<th>No</th>  
<th>Nama Buku</th>  
<th>Harga</th>  
<th style="width: 8%;">Qty</th>  
<th>Jumlah</th>  
<th>Aksi</th>  
</tr>';
$no=1; foreach ($this->cart->contents() as $items){ 
echo '<tr>
<td>'.$no ++.'</td>   
<td><a style="text-decoration:none;" href="'.base_url('Store/lihat_buku/'. base64_encode($items['id'])).'" > '.$items['name'] .'</a></td>
<td>Rp.'.number_format($items['price']) .'</td>
<td><input type="text" id="qty'.$items['id'].'" maxlength="3" onchange="update_qty_keranjang('.$items['id'].')" class="form-control" value="'.$items['qty'].'"></td>
<td>Rp. '.number_format($items['subtotal']).'</td>
<td><button onclick="hapus_cart('.$items['id'].');" class="btn btn-danger"><span class="fa fa-close"></span></button></td>
</tr>';

}
echo "<tr style='backround-color:#f60;'>"
. "<td colspan='2'><b>Total</b></td>"
. "<td colspan='2'> <b>Rp. ".number_format($this->cart->total())."</b></td>"
. "<td colspan='2' ><a href='". base_url('Store/checkout')."'><buttton class='btn btn-success form-control'>Bayar Buku <span class='fa fa fa-money'></span></button></a></td>"
. "</tr>";

echo '</table>'; 

}
}
function update_qty_keranjang(){
if($this->input->post('qty')){
$input = $this->input->post();
$data = array(
'rowid' => md5($input['id']),
'qty'=> $input['qty'],
);
echo print_r($input);
$this->cart->update($data);
$unset = array(
'nilai_kupon', 
'hasil_kupon',
'nama_kupon',
'ongkir',
'kurir',
'service',        
'nilai_promo', 
'hasil_promo',
'nama_promo',
);
$this->session->unset_userdata($unset);

}else{
redirect(404);    
} 
}

function hapus_cart(){
if($this->input->post('id')){
$data = array(
'rowid' => md5($this->input->post('id')),
'qty'   => 0,
);

$this->cart->update($data);    
}else{
redirect(404);    
}    
}

function data_kecamatan(){
if($this->input->post('city_id')){
$curl = curl_init();
$input = $this->input->post();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$input['city_id'],
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
"key: 2390264a2b725f30995e41292a420f65"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
}
$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
echo "<option id='subdistrict_id' value='".$data['rajaongkir']['results'][$i]['subdistrict_id']."'>".$data['rajaongkir']['results'][$i]['subdistrict_name']."</option>";
}   
}else{
redirect(404);    
} 

}   
public function cari_kota(){
$term = strtolower($this->input->get('term'));    

$query = $this->M_store->cari_kota($term);

foreach ($query as $d) {
$json[]= array(
'label'                     => $d->nama_kota,   
'province'                  => $d->province,   
'postal_code'               => $d->postal_code,
'city_id'                   => $d->city_id,
);   

}

echo json_encode($json);
}

public function daftar_akun(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_daftar_akun');
$this->load->view('Umum/V_footer_toko');        
}

public function login_akun(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_login_akun');
$this->load->view('Umum/V_footer_toko');        
}

public function lupa_sandi(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lupa_sandi');
$this->load->view('Umum/V_footer_toko');        
}

public function daftar(){

if($this->input->post('nama_lengkap')){

$hasil_cek = $this->M_store->cek_email_daftar($this->input->post('email'));   

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

$html .="<h3>Terimakasih anda telah melakukan pendaftaran di Guepedia.com </h3><br>"
. "untuk mengkonfirmasi akun silahkan klik link di bawah ini <br><br>"
. "<a href='".base_url('Store/aktivasi/'.base64_encode($input['email']))."'>Konfirmasi akun anda disini</a><br><br>"
        
. "<i>Note: Jika anda tidak merasa melakukan pendaftaran mohon abaikan email ini </i>";


$this->email->message($html);

if (!$this->email->send()){    

echo $this->email->print_debugger();


}else{

$hasil_pendaftar = $this->M_store->hitung_penulis();

$angka = 6;
$pendaftar = $hasil_pendaftar;

$id_account = str_pad($pendaftar, $angka ,"0",STR_PAD_LEFT);


$data = array(
'id_account'     => $id_account,   
'nama_lengkap'   => $input['nama_lengkap'],    
'email'          => $input['email'],    
'password'       => md5($input['password']),    
'status_akun'    =>'tidak',
);
$input_total =array(
'id_account'           =>$id_account,
);

$this->M_store->daftar_penulis($data,$input_total);

echo "berhasil";    

}
}
}else{
redirect(404);
}
}
function cek_cost(){
if($this->input->post('total_berat')){
$input = $this->input->post();    

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "origin=78&originType=city&destination=".$input['subdistrict_id']."&destinationType=subdistrict&weight=".$input['total_berat']."&courier=".$input['kurir']."",
CURLOPT_HTTPHEADER => array(
"content-type: application/x-www-form-urlencoded",
"key: 2390264a2b725f30995e41292a420f65"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
$data = json_decode($response, true);

foreach ($data as $a){

foreach ($a['results'] as $b){
echo "<br><h4 align='center'>".$b['name']."</h4><hr>";

foreach ($b['costs'] as $c){
echo "<h5 style='color:#28a745;'>Service ".$c['service']." ";
echo "( ".$c['description']." ) </h5>";
foreach ($c['cost'] as $d){
echo "Rp.". number_format($d['value']);
echo " Estimasi ". $d['etd']." Hari <br>";
}
}
}
}
}    

}else{
redirect(404);    
}
}

function login(){
if($this->input->post('email')){
$input = $this->input->post();
$data = array(
'email'      => $input['email'],
'password'   => md5($input['password']),
'status_akun'=>'aktif',    
);
$query = $this->M_store->login($data);

if($query->num_rows() > 0){
$c = $query->row_array();
$data = array(
'id_account_toko'    =>$c['id_account'],
'email_toko'         =>$c['email'],
'nama_lengkap'       =>$c['nama_lengkap'],
'nomor_kontak'       =>$c['nomor_kontak'],  
);

$this->session->set_userdata($data);

echo "berhasil";
}else{
echo "tidakada";    
}

}else{
redirect(404);    
}


}

function  keluar(){
$this->session->sess_destroy();    
}

function halaman_checkout(){        
$query = $this->M_store->cek_alamat($this->session->userdata('id_account_toko'));


$this->load->view('Store/V_halaman_checkout',['data_alamat'=>$query]);


}

function checkout(){
if($this->session->userdata('id_account_toko') !=NULL){
if($this->cart->total()){    
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_checkout');
$this->load->view('Umum/V_footer_toko');    
}else{
redirect('Store');    
}

}else{
redirect('Store/login_akun');    
}
}

function cost_checkout(){
if($this->input->post('kurir')){

$total_berat = 0;
foreach ($this->cart->contents() as $items){ 
$total_berat += $items['berat'] * $items['qty'];    
}    
$id_account = $this->session->userdata('id_account_toko');
$alamat     = $this->M_store->cek_alamat($id_account)->row_array();

$input = $this->input->post();    
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "origin=78&originType=city&destination=".$alamat['subdistrict_id']."&destinationType=subdistrict&weight=".$total_berat."&courier=".$input['kurir']."",
CURLOPT_HTTPHEADER => array(
"content-type: application/x-www-form-urlencoded",
"key: 2390264a2b725f30995e41292a420f65"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
$data = json_decode($response, true);

foreach ($data as $a){
foreach ($a['results'] as $b){
echo "<br><h5 align='center' id='nama_kurir'>".$b['name']."</h5><hr>";
$no =0;
$n =0;
foreach ($b['costs'] as $c){

echo "<h6 style='color:#28a745;'>Service <span id='nama_service".$no ++."'>".$c['service']." ";
echo "( ".$c['description']." )</span> </h6>";

foreach ($c['cost'] as $d){
echo "<input type='radio' onclick='set_ongkir(".$n ++.");' id='ongkir' name='ongkir' value='".$d['value']."' >  ";
echo "Rp.". number_format($d['value']);
echo " Estimasi ". $d['etd']." Hari <br>";
}

}
}
}
}    

}else{
redirect(404);    
}
}

function simpan_alamat(){

if($this->input->post('subdistrict_id')){
$input = $this->input->post();
$cek_alamat = $this->M_store->cek_alamat($this->session->userdata('id_account_toko'));

if($cek_alamat->num_rows() > 0){

$data =array(
'id_account_toko'   => $this->session->userdata('id_account_toko'),  
'nama_penerima'     => $input['nama_penerima'],
'nama_kota'         => $input['nama_kota'],
'city_id'           => $input['city_id'],
'nama_provinsi'     => $input['nama_provinsi'],
'nomor_kontak'      => $input['nomor_kontak'],
'kode_pos'          => $input['kode_pos'],
'alamat_lengkap'    => $input['alamat_lengkap'],
'subdistrict_id'    => $input['subdistrict_id'],
'nama_kecamatan'    => $input['nama_kecamatan'],
);
$this->M_store->update_alamat($data,$this->session->userdata('id_account_toko'));


}else{

$data =array(
'id_account_toko'   => $this->session->userdata('id_account_toko'),  
'nama_penerima'     => $input['nama_penerima'],
'nama_kota'         => $input['nama_kota'],
'city_id'           => $input['city_id'],
'nama_provinsi'     => $input['nama_provinsi'],
'nomor_kontak'      => $input['nomor_kontak'],
'kode_pos'          => $input['kode_pos'],
'alamat_lengkap'    => $input['alamat_lengkap'],
'subdistrict_id'    => $input['subdistrict_id'],
'nama_kecamatan'    => $input['nama_kecamatan'],
);
$this->M_store->input_alamat($data);

}
echo "berhasil";
}else{
redirect(404);    
}

}
function buat_alamat_baru (){
if($this->session->userdata('id_account_toko')){
$id_account_toko = $this->session->userdata('id_account_toko');
unset($_SESSION['ongkir']);
$this->M_store->buat_alamat_baru($id_account_toko);
}else{
redirect(404);    
}
}
function set_ongkir(){
if($this->input->post('ongkir')){
$data = array(
'ongkir' => $this->input->post('ongkir'),
'kurir'  => $this->input->post('nama_kurir'),
'service' => $this->input->post('nama_service'),    
);
$this->session->set_userdata($data);    
}else{
redirect(404);    
}    
}

function ubah_kurir(){
unset($_SESSION['ongkir']);
unset($_SESSION['kurir']);
unset($_SESSION['service']);

}

function set_promo(){
if($this->input->post('promo')){
$kupon = $this->input->post('promo');
$query = $this->M_store->cek_kupon($kupon);    

if($query->num_rows() > 0){
$data_promo = $query->row_array();

$data = array(
'nilai_promo' => $data_promo['nilai_promo'],
'hasil_promo' => $this->cart->total() * $data_promo['nilai_promo'] / 100,
'nama_promo'  => $data_promo['kode_promo'],   
);
$this->session->set_userdata($data);

echo "berhasil";
}else{
echo "tidak tersedia";    
}    
}else{
redirect(404);    
}    

}
function bayar(){
if($this->input->post('metode_pembayaran')){

if($this->session->userdata('ongkir')){    

$input = $this->input->post();
$id_account = $this->session->userdata('id_account_toko');
$alamat     = $this->M_store->cek_alamat($id_account)->row_array();
$penjualan = $this->M_store->data_penjualan_toko()->num_rows();
$angka = 6;
$jumlah_penjualan = $penjualan;
$invoices_toko = str_pad($jumlah_penjualan, $angka ,"0",STR_PAD_LEFT);

$expir = date('d-m-Y', strtotime("+3 day"));
$date1= date_create($expir);
$tanggal_expir = date_format($date1,"d F o");


$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;

$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($this->session->userdata('email_toko'));
$this->email->cc("guepedia@gmail.com");
$this->email->subject('Konfirmasi pesanan');

$html   = "Terimakasih anda telah melakukan pembelian di store guepedia <br>"
. "untuk proses selanjutnya silahkan anda melakukan pembayaran via bank transfer dan melakukan konfirmasi sebelum tanggal ".$tanggal_expir."<br>"
. "<h3 align='center' style='padding:2%;color:#fff;background-color:rgb(168,207,69)'>Rekening Pembayaran</h3> "

. "Nama bank : Bank BCA <hr>"
. "Nomor Rekenng : 2120077824 <hr>"
. "Atas nama: Dianata Eka Putra <hr>";

$html .= "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".'INV/ST/'.$invoices_toko."</h3>"; 

$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
<tr>
<th style="border-bottom: 1px solid rgb(168,207,69);">No</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);">Nama Buku</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);">Harga</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);">Qty</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);">Jumlah</th>   
</tr>';
$d = 1 ;

foreach ($this->cart->contents() as $items){
$html .='<tr>';    
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center" >'.$d++.'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center" >'.$items['name'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center" > Rp.'.number_format($items['price']).'</td>';       
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center" >'.$items['qty'].'</td>';
$html .='<td style="border-bottom: 1px solid rgb(168,207,69);" align="center" >Rp. '.number_format($items['subtotal']).'</td>';       
$html .='</tr>';
}

$html .="<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='2'>Total Belanja</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($this->cart->total())."</td>    
</tr>
<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Ongkir </td>    
<td style='border-bottom: 1px solid rgb(168,207,69);'  align='center' colspan='3'>Rp.".number_format($this->session->userdata('ongkir'))." </td>    
</tr>";

if($this->session->userdata('nilai_kupon')){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' colspan='2' align='center'>Kode kupon ".$this->session->userdata('nama_kupon')."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' colspan='3' align='center' style='color:#dc3545;'> - Rp".number_format($this->session->userdata('hasil_kupon'))."</td>    
</tr>";
}

if($this->session->userdata('nilai_promo')){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' colspan='2' align='center'>Kode promo ".$this->session->userdata('nama_promo')."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' colspan='3' align='center' style='color:#dc3545;'> - Rp".number_format($this->session->userdata('hasil_promo'))."</td>    
</tr>";
}

$html.= 
"<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='2'>Total Bayar</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($this->cart->total() + $this->session->userdata('ongkir') - $this->session->userdata('hasil_kupon'))."</td>    
</tr></table>";

$html .= "Nama Pemesan :".$alamat['nama_penerima']."<br>";
$html .= "Alamat pengiriman : <br>".$alamat['nama_kecamatan']." ".$alamat['nama_kota']." ".$alamat['nama_provinsi']." ".$alamat['alamat_lengkap']." ".$alamat['kode_pos']."<br>"; 
$html .= $alamat['nomor_kontak']."<br>"; 

$this->email->message($html);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
$penjualan_toko = array(
'invoices_toko'     => 'INV/ST/'.$invoices_toko,
'id_account'        => $this->session->userdata('id_account_toko'),
'nama_penerima'     => $alamat['nama_penerima'],
'nama_kota'         => $alamat['nama_kota'],
'nomor_kontak'      => $alamat['nomor_kontak'],
'nama_kecamatan'    => $alamat['nama_kecamatan'],
'nama_provinsi'     => $alamat['nama_provinsi'],
'kode_pos'          => $alamat['kode_pos'],
'alamat_lengkap'    => $alamat['alamat_lengkap'],
'nilai_kupon'       => $this->session->userdata('nilai_kupon'), 
'hasil_kupon'       => $this->session->userdata('hasil_kupon'),
'nama_kupon'        => $this->session->userdata('nama_kupon'),
'nilai_promo'       => $this->session->userdata('nilai_promo'), 
'hasil_promo'       => $this->session->userdata('hasil_promo'),
'nama_promo'        => $this->session->userdata('nama_promo'),    
'ongkir'            => $this->session->userdata('ongkir'),
'kurir'             => $this->session->userdata('kurir'),
'service'           => $this->session->userdata('service'),    
'metode_pembayaran' => $input['metode_pembayaran'],
'status'            => 'pending',    
'total_belanja'     => $this->cart->total(),    
'total_bayar'       => $this->cart->total() + $this->session->userdata('ongkir') - $this->session->userdata('hasil_kupon') - $this->session->userdata('hasil_promo'),    
'tanggal_order'     => date('d/m/Y'),
'expired'           => date('d/m/Y', strtotime("+2 day")),       
); 
$this->M_store->input_data_jumlah_penjualan_toko($penjualan_toko);

foreach ($this->cart->contents() as $items){
$data_penjualan =array(
'invoices_toko'     => 'INV/ST/'.$invoices_toko,
'nama_buku'         => $items['name'],
'harga_buku'        => $items['price'],
'qty'               => $items['qty'],
'subtotal'          => $items['subtotal'],
);
$this->M_store->input_data_penjualan_toko($data_penjualan);
}

$hapus_kupon = array(
'nama_kupon' => $this->session->userdata('nama_kupon'),
'id_account' => $this->session->userdata('id_account_toko'),   
);
$this->M_store->hapus_kupon($hapus_kupon);

echo "berhasil";

$this->cart->destroy();
$unset = array(
'nilai_kupon', 
'hasil_kupon',
'nama_kupon',
'ongkir',
'kurir',
'service',        
'nilai_promo', 
'hasil_promo',
'nama_promo',
);
$this->session->unset_userdata($unset);
}
}else{
echo "error";    
}
}else{

redirect(404);    
}
}

function konfirmasi_pembayaran(){
if($this->session->userdata('id_account_toko')){

$konfirmasi = $this->M_store->data_konfirmasi_pembayaran();

$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_konfirmasi_pembayaran',['konfirmasi'=>$konfirmasi]);
$this->load->view('Umum/V_footer_toko');    
}else{
redirect('Store/login_akun');   
}    
}

function konfirmasi(){
if($this->input->post('jumlah_bayar')){
$input = $this->input->post();

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$config2['upload_path']          = './uploads/bukti_bayar/';
$config2['allowed_types']        = 'pdf|jpeg|jpg|png|';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;

$this->upload->initialize($config2);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($this->session->userdata('email_toko'));
$this->email->cc("guepedia@gmail.com");
$this->email->subject('Konfirmasi pembayaran terkirim');

$id = $input['inv'];
$this->db->where(array('id_penjualan_toko'=>$id,'id_account'=>$this->session->userdata('id_account_toko')));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;

$html  ="Terimakasih anda telah melakukan  konfirmasi pembayaran , selanjutnya pembayaran akan kami periksa dalam waktu 1 X 24 JAM<br>";

$html .= "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .= '<table style="width:100%; max-width:100%; border-collapse:collapse; border-spacing:0; background-color:transparent; margin:5px 0;padding:0" >
<tr>
<th style="border-bottom: 1px solid rgb(168,207,69);" align="center">No</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Nama Buku</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Harga</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Qty</th>   
<th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Jumlah</th>   
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
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode kupon ".$static['nama_kupon']."</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
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
</tr></table>";

$html .= "Nama Pemesan :".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : <br>".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= $static['nomor_kontak']."<br>"; 

$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
if (!$this->upload->do_upload('bukti_bayar')){

echo $this->upload->display_errors();


}else{  
$data = array(
'nilai_transfer' => $input['jumlah_bayar'],
'bukti_transfer' => $this->upload->data('file_name'),  
'status'         => 'proses',
);

$this->M_store->konfirmasi($data,$input['inv']);

echo "berhasil";

}
}
}else{
redirect(404);    
}    

}
function download_invoices(){
if($this->session->userdata('id_account_toko')){
$id = base64_decode($this->uri->segment(3));

$this->db->where(array('id_penjualan_toko'=>$id,'id_account'=>$this->session->userdata('id_account_toko')));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$static = $query->row_array();

$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));
$d=1 ;
$html  ="<img style='position:absolute;' src='".base_url('assets/img/logo-toko.png')."'>";
$html .= "<h3 align='center'>Store Guepedia <br> ".$static['invoices_toko']." ".$static['status']."</h3><hr>"; 

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
$html .= "Nama Pemesan : ".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= "Nomor Kontak : ".$static['nomor_kontak']."<br>"; 


$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));


}else{
redirect('Store/login_akun');   
} 
}

public function json_transaksi(){
echo $this->M_store->json_transaksi();       
}

function daftar_transaksi(){
if($this->session->userdata('id_account_toko')){

$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_daftar_transaksi');
$this->load->view('Umum/V_footer_toko');     

}else{
redirect(404);    
}    
}

function set_kupon(){
if($this->input->post('kupon')){
$input = $this->input->post();

$query = $this->M_store->data_kupon($input['kupon']);
$cek = $query->row_array();

if($query->num_rows() > 0){
if( $cek['syarat_kupon'] < $this->cart->total()){

$data = array(
'nilai_kupon' => $cek['nilai_kupon'],
'hasil_kupon' => $this->cart->total() * $cek['nilai_kupon'] / 100,
'nama_kupon'  => $cek['nama_kupon'],   
);
$this->session->set_userdata($data);


echo "berhasil";    


}else{

echo "tidak_lolos";    
}


}else{
echo "gaada";    
} 

}else{

redirect(404);    
}    
}
function layanan(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_layanan');
$this->load->view('Umum/V_footer_toko');     

}

function faq(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_faq');
$this->load->view('Umum/V_footer_toko');     

}
function hubungi_kami(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_hubungi_kami');
$this->load->view('Umum/V_footer_toko');            
}
function tentang_kami(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_tentang_kami');
$this->load->view('Umum/V_footer_toko');     

}
function privasi(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_privasi');
$this->load->view('Umum/V_footer_toko');     
}

function syarat(){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_syarat');
$this->load->view('Umum/V_footer_toko');     
}
function reset_password(){
if($this->input->post('email')){
$cek_email = $this->M_store->cek_email($this->input->post('email'));

if($cek_email->num_rows() >0){

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


$this->load->library('email',$config);

$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($this->input->post('email'));
$this->email->subject('Reset Password Guepedia');
$html = "<h3 style='padding: 2%; color: #FFF; background-color: rgb(168, 207, 69);' align='center'> Reset Password  Guepedia</h3>"; 

$html  .="Untuk melakukan reset password silahkan anda klik link di bawah ini <br>";
$html  .= base_url('Store/halaman_reset/'. base64_encode($this->input->post('email')));
$html  .="<br><i>Note:Jika anda tidak merasa melakukan reset password mohon abaikan email ini</i>";
$this->email->message($html);

if (!$this->email->send()){    

echo $this->email->print_debugger();


}else{    
echo "berhasil";


}

}else{
echo "not_found";   
}

}else{
redirect(404);    
}

}
function halaman_reset(){
if($this->uri->segment(3) != NULL){
$this->load->view('Umum/V_header_toko');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_halaman_reset');
$this->load->view('Umum/V_footer_toko');  

}else{
    redirect(404);    
}
}
function set_password_baru(){
if($this->input->post('e')){
$input = $this->input->post();

$data = array(
'password'    => md5($input['password']),    
'status_akun' => 'aktif',    
);

$this->M_store->set_password_baru($data,$input['e']);

echo "berhasil";    
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

$this->M_store->aktivasi($data,$email);
redirect(base_url('Store'));    
}else{
redirect(404);    
}    
    
}

}

