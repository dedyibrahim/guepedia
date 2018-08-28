<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_penulis extends CI_Model{
function __construct() {
parent::__construct();

}
function cek_email_daftar($email){

$hasil_cek = $this->db->get_where('akun_penulis',array('email'=>$email))->num_rows();

if($hasil_cek > 0){
return $hasil_cek;    
    
}

    
}

function daftar_penulis($data,$input_total){
    
$this->db->insert('akun_penulis',$data); 
$this->db->insert('id_penulis',$input_total); 

    
}

function login($email,$password){

$login = $this->db->get_where('akun_penulis',array('email'=>$email,'password'=>$password));

if($login->num_rows() > 0){
return $login;    
}else {
return $login;   
    
}

    
}

function hitung_penulis(){

$data_pendaftar = $this->db->get('id_penulis')->num_rows();

return $data_pendaftar;

}

function aktivasi($data,$email){
    
$this->db->update('akun_penulis',$data,array('email'=> base64_decode($email)));    
    
}

function cek_email($email){
    
$query = $this->db->get_where('akun_penulis',array('email'=>$email));

if($query->num_rows() > 0){
return $query;
}

}

function update_password($data,$param){
    
$this->db->update('akun_penulis',$data,array('email'=> base64_decode($param)));    
    
}


}

