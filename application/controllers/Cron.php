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
$d=1 ;

$html   ="<h1 align='center'><img src='".base_url('assets/img/logo-toko.png')."'></h3>";
$html .="<h3 align='center'>Harap melakukan pembayaran di Store Guepedia sebelum tanggal ".$static['expired']."</h3>";
$html .= "<h3 align='center'>Store Guepedia <br> ".$static['invoices_toko']."</h3><hr>"; 
$html .= "<h2 align='center'>Detail orderan </h2>"; 
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
<td colspan='2'>Kode promo ".$static['nama_kupon']."</td>    
<td  colspan='3' style='color:#dc3545;'> - Rp".number_format($static['hasil_kupon'])."</td>    
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

$this->email->message($html);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
echo $html;
echo "reminder orderan ".$static['nama_penerima']." Berhasil";    


}
}
}

function orderan_expired(){
$data = array(
'expired' => date('d/m/Y'),
'status'  => 'pending'
);
$query = $this->M_cron->orderan_expired($data);

foreach ($query->result_array() as $expire){
$datax = array(
'status' => 'expired',
);

$this->M_cron->set_expired($datax,$expire['invoices_toko'])    ;


}
}
}

