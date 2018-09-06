<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

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

public function tarik_royalti(){
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_penulis/V_menu');
$this->load->view('Halaman_penulis/V_tarik_royalti');
$this->load->view('Umum/V_footer');
        
}
public function saldo_royalti(){
$id_account =  $this->session->userdata('id_account'); 

$saldo_royalti = $this->M_halaman_penulis->saldo_royalti($id_account)->row_array();

echo "Rp. ".number_format($saldo_royalti['royalti_diperoleh']);
}

public function download_tamplate(){

force_download('./assets/tamplate/tamplateguepedia.zip', NULL);

}

public function input_penarikan(){
if($this->input->post('jumlah_penarikan') !=''){
$id_account =  $this->session->userdata('id_account'); 
    
$saldo_royalti = $this->M_halaman_penulis->saldo_royalti($id_account)->row_array();
$input = $this->input->post();


if ($saldo_royalti['royalti_diperoleh'] < 10000){
echo "kurang";    

}else if($input['jumlah_penarikan'] > $saldo_royalti['royalti_diperoleh']){

echo "melebihi";


}
    


}else{
    
    redirect(404);    
}
    
    
}

public function hitung_penarikan(){
if($this->input->post('jumlah_penarikan') !=''){
    $input = $this->input->post();
 echo "<label>Jumlah penarikan :</label><br>Rp. ".number_format($input['jumlah_penarikan']);   
    
}else{
redirect(404);    
}
    
}
public function json_penjualan(){
echo $this->M_halaman_penulis->json_penjualan();       
}

public function laporan_penjualan(){
    
$this->load->view('Umum/V_header');
$this->load->view('Halaman_penulis/V_menu');
$this->load->view('Halaman_penulis/V_laporan_penjualan');
$this->load->view('Umum/V_footer');
    
    
}
function print_penjualan(){

$id_data_penjualan = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$wer = array(
'data_penjualan.id_data_penjualan'=>$id_data_penjualan,
'data_jumlah_penjualan.id_account_penulis'=>$this->session->userdata('id_account'),    
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
public function json_transfer_royalti(){
echo $this->M_halaman_penulis->json_transfer_royalti();       
}
public function download_bukti(){

$id_data_transfer = base64_decode($this->uri->segment(3));
$bukti_transfer = $this->db->get_where('data_transfer_royalti',array('id_data_transfer_royalti'=>$id_data_transfer))->row_array();


force_download('./uploads/bukti_transfer/'.$bukti_transfer['bukti_transfer'], NULL);
}
}