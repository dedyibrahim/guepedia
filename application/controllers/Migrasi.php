<?php 

class Migrasi extends CI_Controller{
    
function __construct() {
    parent::__construct();
$this->load->model('M_penulis');
    
}    

function index(){
 $query =  $this->db->get('mzt_customer');
 
foreach ($query->result_array() as $cs){
$hasil_pendaftar = $this->M_penulis->hitung_penulis();

$angka = 6;
$pendaftar = $hasil_pendaftar;

$id_account = str_pad($pendaftar, $angka ,"0",STR_PAD_LEFT);
   
    $data = array(
        
     'id_account'           =>$id_account,
     'nama_lengkap'         =>$cs['firstname']." ".$cs['lastname'],
     'email'                =>$cs['email'],
     'password'             =>$cs['password'],
     'nomor_kontak'         =>$cs['telephone'],  
     'nama_pemilik_rekening'=>$cs['nama_rek'],
     'nomor_rekening'       =>$cs['no_rek'],
     'nama_bank'            =>$cs['bank'],
     'status_akun'          =>'tidak',  
        
    ); 
    
    $input_total =array(
     'id_account'           =>$id_account,
    );
    
    $this->M_penulis->daftar_penulis($data,$input_total);
 }
 
 echo "berhasil";
    
   
}

}