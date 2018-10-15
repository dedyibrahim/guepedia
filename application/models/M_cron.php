<?php
class M_cron extends CI_Model{

function index(){

}
function reminder_orderan(){
$this->db->select('*');
$this->db->from('data_jumlah_penjualan_toko');
$this->db->join('data_penjualan_toko', 'data_penjualan_toko.invoices_toko = data_jumlah_penjualan_toko.invoices_toko');
$this->db->where('data_jumlah_penjualan_toko.status','pending');
$query = $this->db->get();

return $query;
}

function orderan_expired(){
$query =  $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'pending','expired <=' => date('d-m-Y') ));    

return $query;
}

function set_expired($data,$param){
    
$this->db->update('data_jumlah_penjualan_toko',$data,array('invoices_toko'=>$param));

}
}
