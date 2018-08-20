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

function daftar_penulis($data){
    
$this->db->insert('akun_penulis',$data);    
    
}

function login($email,$password){

$login = $this->db->get_where('akun_penulis',array('email'=>$email,'password'=>$password));

if($login->num_rows() > 0){
return $login;    
}else {
return $login;   
    
}

    
}

function data_pendaftar(){

$data_pendaftar = $this->db->get('akun_penulis')->num_rows();

return $data_pendaftar;

}
}

