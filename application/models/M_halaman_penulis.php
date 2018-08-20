<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_halaman_penulis extends CI_Model {
function __construct() {
    parent::__construct();
   $this->load->library('datatables'); 
}

function update_penulis($data,$param){
    
$this->db->update('akun_penulis',$data,array('id_account'=>$param));    
    
}

function simpan_rekening_penulis($data,$param){
$this->db->update('akun_penulis',$data,array('id_account'=>$param));
}

function data_penulis(){
$data_penulis = $this->db->get_where('akun_penulis',array('id_account'=>$this->session->userdata('id_account')));    
    
return($data_penulis);    
    
    
}
function data_kategori_naskah(){
$query = $this->db->get('kategori_naskah');
return $query;
}

function simpan_naskah($data){
$this->db->insert('file_naskah_penulis',$data);       
}

function json_file_naskah(){
$this->datatables->select('id_file_naskah,'
. 'file_naskah_penulis.judul as judul,'
. 'file_naskah_penulis.penulis as penulis,'
. 'file_naskah_penulis.harga as harga,'
. 'file_naskah_penulis.status as status,'
. 'file_naskah_penulis.tanggal_upload as tanggal_upload,'
. 'kategori_naskah.nama_kategori as nama_kategori,'
);

$this->datatables->where('file_naskah_penulis.id_account',$this->session->userdata('id_account'));
$this->datatables->from('file_naskah_penulis');
$this->datatables->join('kategori_naskah','kategori_naskah.id_kategori_naskah = file_naskah_penulis.id_kategori_naskah');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'Halaman_penulis/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}    
   
}
