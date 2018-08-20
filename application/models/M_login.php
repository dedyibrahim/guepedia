<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{
function __construct() {
parent::__construct();
}

function login($data){
$this->db->where($data);  
$query = $this->db->get('user');
return $query;    

}

}
