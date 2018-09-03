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


}



