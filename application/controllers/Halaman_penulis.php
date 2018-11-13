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
'email'         =>$input['email'],
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
'id_bank'               =>$input['id_bank'],   
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
$input = $this->input->post();
    
$config2['upload_path']          = './uploads/dokumen_naskah/';
$config2['allowed_types']        = 'docx|doc';
$config2['file_size']            = "2004800";
$config2['encrypt_name']         = TRUE;

$config3['upload_path']          = './uploads/file_cover/';
$config3['allowed_types']        = 'psd';
$config3['file_size']            = "2004800";
$config3['encrypt_name']         = TRUE;


$this->upload->initialize($config2);
if (!$this->upload->do_upload('file_naskah')){
echo $this->upload->display_errors();

}else{     
$file_naskah = $this->upload->data('file_name');
$this->upload->initialize($config3);

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
$this->email_upload_naskah($input);

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
$this->email_upload_naskah($input);
}

}

}

public function email_upload_naskah($input){
 
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;

$this->load->library('email',$config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($this->session->userdata('email'));
$this->email->subject('Naskah '.$input['judul']);

$html = "<h3 style='padding: 2%; color: #000; background-color: rgb(168, 207, 69);' align='center'>Naskah Berhasil di Upload</h3>"; 

$html .="<h4 align='center'>Berikut data naskah yang Anda Upload </h4><hr>
    
Judul Buku :".$input['judul']."<hr>
Penulis :".$input['penulis']."<hr>
Status : Pending <br><hr><br>

"."<p>Naskah Anda telah kami terima. Naskah akan segera kami terbitkan setelah verifikasi dan mendapatkan ISBN dari guepedia.com.<br>" 
."Naskah yang Anda berikan dipromosikan melalui toko buku online guepedia.com dan media promosi lainnya. 
Anda bisa melakukan pemesanan melewati buku online guepedia.com</p></h3><br>

";
        

$this->email->message($html);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{    
echo "berhasil";    
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
$data_rekening = $this->M_halaman_penulis->data_penulis();

$this->load->view('Umum/V_header');
$this->load->view('Halaman_penulis/V_menu');
$this->load->view('Halaman_penulis/V_tarik_royalti',['data_rekening'=>$data_rekening]);
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
        . '<th>Bagi Hasil</th>'
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
</tr>';
}

$html.= '</table>';
    
$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));
}
public function json_data_pengajuan_royalti(){
echo $this->M_halaman_penulis->json_data_pengajuan_royalti();       
}
public function download_bukti(){
$bukti_transfer = $this->M_halaman_penulis->data_bukti($this->uri->segment(3))->row_array();

$html  ="<img src='".base_url('assets/img/logo-toko.png')."'>";
$html .="<h2 style='position:fixed;' align='right'><br>Data Penarikan Bagi Hasil</h2><hr>";
$html .="<p >Nomor Penarikan : ".$bukti_transfer['nomor_penarikan']."<br>"
        . "Akun Penulis : ".$bukti_transfer['nama_lengkap']."<br>"
        . "Nomor Kontak : ".$bukti_transfer['nomor_kontak']."<br>"
        . "Tanggal Pengajuan : ".$bukti_transfer['tanggal_pengajuan']."<br>"
        . "Nama Rekening : ".$bukti_transfer['nama_pemilik_rekening']."<br>"
        . "Nomor Rekening : ".$bukti_transfer['nomor_rekening']."<br>"
        . "Nama Bank : ".$bukti_transfer['nama_bank']."<br>"
        . "</p>";

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
  $html.="<hr> Note : Bukti Transfer<br>"
          . "<img src=". base_url('uploads/bukti_transfer/'.$bukti_transfer['bukti_transfer']).">";  
}


$dompdf = new Dompdf(array('enable_remote'=>true));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream('INV.pdf',array('Attachment'=>0));
}
public function edit_rekening(){
$data= array(
'id_account'            =>$this->session->userdata('id_account'),    
'nama_pemilik_rekening' =>'',
'nomor_rekening'        =>'',
'nama_bank'             =>'',   
'id_bank'               =>'',   
);
$this->M_halaman_penulis->simpan_rekening_penulis($data,$this->session->userdata('id_account'));    
 

redirect(base_url('Halaman_penulis'));
}

public function ajukan_penarikan(){
if($this->input->post('jumlah_penarikan')){

$data = $data_rekening = $this->M_halaman_penulis->data_penulis()->row_array();

if($data['id_bank'] != 1){
$biaya_admin = 6500;    
//ada admin
$jumlah_ditarik = 6500+$this->input->post('jumlah_penarikan');    
}else{
// ga ada admin
$biaya_admin =0;
$jumlah_ditarik = 0+$this->input->post('jumlah_penarikan');        
}

if($jumlah_ditarik > $data['royalti_diperoleh']){

echo "Saldo Bagi Hasil Tidak Mencukupi";    

}else{
    
$data_penarikan = $this->M_halaman_penulis->hitung_jumlah_penarikan();
$angka = 6;
$nomor_penarikan = "GP/PNRKN/".$this->session->userdata('id_account')."/".str_pad($data_penarikan, $angka ,"0",STR_PAD_LEFT);

$input = array(
'nomor_penarikan'    => $nomor_penarikan,
'jumlah_penarikan'   => $jumlah_ditarik,
'id_account'         => $this->session->userdata('id_account'),
'biaya_admin'        => $biaya_admin,
'royalti_sebelumnya' => $data['royalti_diperoleh'],
'royalti_ditarik'    => $this->input->post('jumlah_penarikan'),     
'status'             => "Pending",
'tanggal_pengajuan'  =>date('d F o H:i:s'),  
);
$this->M_halaman_penulis->input_pengajuan($input);    
echo "berhasil";
    
}

}else{
redirect(404);    
}    
}

}