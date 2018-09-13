<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_store extends CI_Model{
public function __construct() {
parent::__construct();


}

function baru_terbit(){
         $this->db->where('status','Publish');
         $this->db->order_by('id_file_naskah','desc');
         $this->db->limit(8);
$query = $this->db->get('file_naskah_penulis');

    
return $query;
}

function terlaris(){
$this->db->select('*');
$this->db->from('buku_terlaris');
$this->db->join('file_naskah_penulis', 'file_naskah_penulis.id_file_naskah = buku_terlaris.id_file_naskah');
$this->db->where('status','Publish');
$query = $this->db->get();
     
return $query;

}

function lihat_kategori($id_kategori,$number,$offset){

         $this->db->where(array('id_kategori_naskah'=> base64_decode($id_kategori),'status'=>'Publish')); 
$query = $this->db->get('file_naskah_penulis',$number,$offset);    

    
return $query;

}

function cari_buku($kata_kunci){
    
$array = array('judul' => $kata_kunci);
$this->db->like($array);
$this->db->where('status','Publish');
$query = $this->db->get('file_naskah_penulis');
return $query;
   
    
}


function jumlah_buku($id_kategori){
         $this->db->where('id_kategori_naskah', base64_decode($id_kategori));
$query = $this->db->get('file_naskah_penulis')->num_rows();    
return $query;
}

function data_buku($id_file_naskah){
$query = $this->db->get_where('file_naskah_penulis',array('id_file_naskah'=> base64_decode($id_file_naskah)));  

return $query;    
}

function tambah_keranjang($id_file_naskah){
$query = $this->db->get_where('file_naskah_penulis',array('id_file_naskah'=> base64_decode($id_file_naskah)));    

return $query;
}

public function cari_kota($term){
$this->db->from("data_kota");
$this->db->limit(15);
$array = array('nama_kota' => $term);
$this->db->like($array);
$query = $this->db->get();

if($query->num_rows() >0 ){

return $query->result();
}

}
function cek_email_daftar($email){

$hasil_cek = $this->db->get_where('akun_penulis',array('email'=>$email))->num_rows();

if($hasil_cek > 0){
return $hasil_cek;    
    
}

}
function hitung_penulis(){

$data_pendaftar = $this->db->get('id_penulis')->num_rows();

return $data_pendaftar;

}
function daftar_penulis($data,$input_total){
    
$this->db->insert('akun_penulis',$data); 
$this->db->insert('id_penulis',$input_total); 

    
}

function login($data){
$query = $this->db->get_where('akun_penulis',$data);    
    
return $query;    
    
}

function input_alamat($data){
$this->db->insert('data_alamat',$data);    
}

function update_alamat($data,$param){
$this->db->update('data_alamat',$data,array('id_account_toko'=>$param));    
}

function cek_alamat($param){
$query = $this->db->get_where('data_alamat',array('id_account_toko'=>$param));    
return $query;    
}

function buat_alamat_baru($id_account){
$this->db->delete('data_alamat',array('id_account_toko'=>$id_account));    
}
function  cek_kupon($kupon){
$query = $this->db->get_where('data_kupon',array('kupon'=>$kupon));
return $query;
}
function data_penjualan_toko(){
$query = $this->db->get('data_jumlah_penjualan_toko');    

return $query;
}
function input_data_jumlah_penjualan_toko($data){
$this->db->insert('data_jumlah_penjualan_toko',$data);    
}
function input_data_penjualan_toko($data){
$this->db->insert('data_penjualan_toko',$data);    
}
}



