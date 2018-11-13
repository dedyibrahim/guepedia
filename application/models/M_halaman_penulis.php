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
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'Store/lihat_buku/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}

function saldo_royalti($id_account){
         $this->db->select('royalti_diperoleh');
$query = $this->db->get_where('akun_penulis',array('id_account'=>$id_account));    

return $query;


}

function json_penjualan(){
$this->datatables->select('id_data_jumlah_penjualan,'
.'data_jumlah_penjualan.no_invoices as no_invoices,'
.'data_penjualan.id_data_penjualan as id_data_penjualan,'
.'data_penjualan.nama_customer as nama_customer,'
.'data_jumlah_penjualan.tanggal_transaksi as tanggal_transaksi,'
.'data_penjualan.status_penjualan as status_penjualan,'
);
$this->datatables->where('id_account_penulis',$this->session->userdata('id_account'));
$this->datatables->group_by('data_penjualan.no_invoices');
$this->datatables->from('data_penjualan');
$this->datatables->join('data_jumlah_penjualan','data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-print " href="'.base_url().'Halaman_penulis/print_penjualan/$1"></a>', 'base64_encode(id_data_penjualan)');
return $this->datatables->generate();
}

function json_data_pengajuan_royalti(){
$this->datatables->select('data_pengajuan_royalti.id_account,'
.'data_pengajuan_royalti.id_data_pengajuan as id_data_pengajuan,'
.'data_pengajuan_royalti.nomor_penarikan as nomor_penarikan,'
.'data_pengajuan_royalti.biaya_admin as biaya_admin,'
.'data_pengajuan_royalti.royalti_ditarik as royalti_ditarik,'
.'data_pengajuan_royalti.status as status,'
.'data_pengajuan_royalti.jumlah_penarikan as jumlah_penarikan,'
.'akun_penulis.nama_lengkap as nama_lengkap,'
.'akun_penulis.nomor_kontak as nomor_kontak,'
.'akun_penulis.email as email,'       
);
$this->datatables->where('data_pengajuan_royalti.id_account',$this->session->userdata('id_account'));
$this->datatables->from('data_pengajuan_royalti');
$this->datatables->join('akun_penulis','akun_penulis.id_account = data_pengajuan_royalti.id_account');
$this->datatables->add_column('view','<button class="btn btn-sm btn-success fa fa-download " onclick=download_bukti("$1") > Download </a>', 'base64_encode(id_data_pengajuan)');
return $this->datatables->generate();
      
}

public function hitung_jumlah_penarikan(){
$query = $this->db->get('data_pengajuan_royalti')->num_rows();
return $query;
}
public function input_pengajuan($data){
$this->db->insert('data_pengajuan_royalti',$data);

    
}
public function data_bukti($id_data_transfer){
 
$this->db->select('*');
$this->db->from('data_pengajuan_royalti');
$this->db->join('akun_penulis', 'akun_penulis.id_account = data_pengajuan_royalti.id_account');
$this->db->where('id_data_pengajuan',base64_decode($id_data_transfer));
$query = $this->db->get();
return $query;
}



}
