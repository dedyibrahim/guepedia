<?php 

class Migrasi extends CI_Controller{
function __construct() {
    parent::__construct();
$this->load->model('M_penulis');
}    

function index(){
 $id_account = $this->db->get('akun_penulis');
 
 foreach ($id_account->result_array() as $ac){
  $data = array('id_account' => $ac['id_account']);   
  
  $this->db->delete('akun_penulis',$data);
 }
   
}

}