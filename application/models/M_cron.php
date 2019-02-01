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
$query =  $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'pending','expired <=' => date('Y-m-d') ));    

return $query;
}

function set_expired($data,$param){
    
$this->db->update('data_jumlah_penjualan_toko',$data,array('invoices_toko'=>$param));
}

function kupon_expired(){
$query  = $this->db->get_where('data_kode_kupon',array('tanggal_expired'=>date('d-m-Y')));

return $query;
}
function hapus_kupon($id_data_kupon){
$this->db->delete('data_kode_kupon',array('id_data_kupon'=>$id_data_kupon));    
}
}
