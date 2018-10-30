<?php
class Cron extends CI_Controller{
 
public function __construct() {
parent::__construct();
$this->load->model('M_cron');
}

function index(){
redirect(404);
}

function reminder_orderan(){
$this->db->where(array('status'=>'pending'));    
$query = $this->db->get('data_jumlah_penjualan_toko');
$d = 1 ;
foreach ($query->result_array() as $static){

$email = $this->db->get_where('akun_penulis',array('id_account'=>$static['id_account']))->row_array();


$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;

$this->load->library('email',$config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($email['email']);
$this->email->subject('Harap melakukan pembayaran Store Guepedia');



$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));



$date1= date_create($static['expired']);
$tanggal_expir = date_format($date1,"d F o");


$html ="<h3 align='center'>Informasi Batas konfirmasi pembayaran Guepedia.com  </h3>";
$html .= "Hai Kakak , Mengenai pesanan kaka di Guepedia.com pada tanggal " .$static['tanggal_order']. " kami ingin mengingatkan untuk jangan lupa melakukan konfirmasi pembayaran sebelum tanggal ".$tanggal_expir." atas perhatian dan kerjasamanya kami ucapkan terimakasih." ;

$html .= "<h3 style='padding: 2%; color: #000; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .='<table style="width:100%;">
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
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3'>Rp.".number_format($static['ongkir'])." </td>    
</tr>";
if($static['nilai_kupon']){ 
$html .= "<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Kode promo ".$static['nama_kupon']."</td>    
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
</tr>";
 }
$html.= 
"<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Bayar</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3'>Rp.".number_format($static['total_bayar'])."</td>    
</tr></table><hr>";
$html .= "Nama Penerima : ".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= "Nomor Kontak : ". $static['nomor_kontak']."<br>"; 

$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{

echo "reminder orderan ".$static['nama_penerima']." Berhasil";    


}
}

}

function orderan_expired(){

$query = $this->M_cron->orderan_expired('status');

foreach ($query->result_array() as $static){

$email = $this->db->get_where('akun_penulis',array('id_account'=>$static['id_account']))->row_array();


$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;

$this->load->library('email',$config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com', 'Admin Guepedia.com');
$this->email->to($email['email']);
$this->email->subject('Harap melakukan pembayaran Store Guepedia');



$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$static['invoices_toko']));



$html ="<h3 align='center'>Informasi Dibatalkan konfirmasi pembayaran Guepedia.com  </h3>";
$html .= "Hai Kakak , Pesanan kakak telah kami batalkan, informasi ini untuk mengingatkan kakak untuk tidak melakukan konfirmasi pembayaran." ;
$html .= "<h3 style='padding: 2%; color: #000; background-color: rgb(168, 207, 69);' align='center'>RINCIAN PESANAN  ".$static['invoices_toko']."</h3>"; 

$html .='<table style="width:100%;">
        <tr>
        <th style="border-bottom: 1px solid rgb(168,207,69);" align="center">No</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Nama Buku</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Harga</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Qty</th>   
        <th style="border-bottom: 1px solid rgb(168,207,69);" align="center">Jumlah</th>   
        </tr>';
$d=1;
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
<td  style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
</tr>";
 }
$html.= 
"<tr>
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center' colspan='2'>Total Bayar</td>    
<td style='border-bottom: 1px solid rgb(168,207,69);' align='center'  colspan='3'>Rp.".number_format($static['total_bayar'])."</td>    
</tr></table><hr>";
$html .= "Nama Penerima : ".$static['nama_penerima']."<br>";
$html .= "Alamat pengiriman : ".$static['nama_kecamatan']." ".$static['nama_kota']." ".$static['nama_provinsi']." ".$static['alamat_lengkap']." ".$static['kode_pos']."<br>"; 
$html .= "Nomor Kontak : ". $static['nomor_kontak']."<br>"; 

$this->email->message($html);
if (!$this->email->send()){    

echo $this->email->print_debugger();

}else{

foreach ($query->result_array() as $expire){

$datax = array(
'status' => 'expired',
);

$this->M_cron->set_expired($datax,$expire['invoices_toko'])    ;


}


}
}    
}

function migrasi(){
/*    
$query = $this->db->get('mzt_withdraw');

foreach ($query->result_array() as $data){

if ($data['stat'] > 0){
 echo "ada";   
}else{
echo "ga ada";    
}
}*/

}

function input_balance(){
$query  = $this->db->get('data_sisa_balance');

foreach ($query->result_array() as $data){
    
$array = array(
'royalti_diperoleh' => $data['sisa_balance']    
);

$this->db->update('akun_penulis',$array,array('email'=>$data['email']));
}

}

}

