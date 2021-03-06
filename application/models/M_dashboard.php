<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model{
function __construct() {
parent::__construct();
}



function insert_kategori($data){
$this->db->insert('kategori_naskah',$data);        
}

function data_kategori(){
$query = $this->db->get_where('kategori_naskah',array('nama_kategori !='=>''));

return $query;

}
function kategori_naskah(){
$query = $this->db->get('kategori_naskah');    

return $query;
}

function lihat_kategori(){
$this->datatables->select('id_file_naskah,'
. 'file_naskah_penulis.judul as judul,'
. 'file_naskah_penulis.penulis as penulis,'
. 'file_naskah_penulis.harga as harga,'
. 'file_naskah_penulis.status as status,'
. 'file_naskah_penulis.tanggal_upload as tanggal_upload,'
. 'kategori_naskah.nama_kategori as nama_kategori,'
);

$this->datatables->where('file_naskah_penulis.id_kategori_naskah',$this->session->userdata('id_kategori_naskah'));
$this->datatables->from('file_naskah_penulis');
$this->datatables->join('kategori_naskah','kategori_naskah.id_kategori_naskah = file_naskah_penulis.id_kategori_naskah');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'G_dashboard/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();

}
function data_seo(){
$this->datatables->select('id_kata_kunci,'
. 'seo.kata_kunci as kata_kunci,'
);

$this->datatables->from('seo');
$this->datatables->add_column('view','<a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'G_dashboard/hapus_seo/$1"></a>', 'base64_encode(id_kata_kunci)');
return $this->datatables->generate();

}
function lihat_file_naskah(){
$this->datatables->select('id_file_naskah,'
. 'file_naskah_penulis.judul as judul,'
. 'file_naskah_penulis.penulis as penulis,'
. 'file_naskah_penulis.harga as harga,'
. 'file_naskah_penulis.status as status,'
. 'file_naskah_penulis.tanggal_upload as tanggal_upload,'
. 'kategori_naskah.nama_kategori as nama_kategori,'
);

$this->datatables->from('file_naskah_penulis');
$this->datatables->join('kategori_naskah','kategori_naskah.id_kategori_naskah = file_naskah_penulis.id_kategori_naskah');
//$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'G_dashboard/lihat_naskah/$1"></a> || <a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'G_dashboard/hapus_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'G_dashboard/lihat_naskah/$1"></a> || <button class="btn btn-sm btn-danger fa fa-trash "  onclick=hapus_naskah("$1") ></button>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}
function lihat_file_naskah_publish(){
$this->datatables->select('id_file_naskah,'
. 'file_naskah_penulis.judul as judul,'
. 'file_naskah_penulis.penulis as penulis,'
. 'file_naskah_penulis.harga as harga,'
. 'file_naskah_penulis.status as status,'
. 'file_naskah_penulis.tanggal_upload as tanggal_upload,'
. 'kategori_naskah.nama_kategori as nama_kategori,'
);

$this->datatables->where('file_naskah_penulis.status','Publish');
$this->datatables->from('file_naskah_penulis');
$this->datatables->join('kategori_naskah','kategori_naskah.id_kategori_naskah = file_naskah_penulis.id_kategori_naskah');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'G_dashboard/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}

function json_penulis(){
$this->datatables->select('id_account,'
. 'akun_penulis.nama_lengkap as nama_lengkap,'
. 'akun_penulis.email as email,'
. 'akun_penulis.nomor_kontak as nomor_kontak,'
. 'akun_penulis.nomor_rekening as nomor_rekening,'
. 'akun_penulis.nama_bank as nama_bank,'
. 'akun_penulis.status_akun as status_akun,'
);

$this->datatables->from('akun_penulis');
$this->datatables->add_column('view','<a class="btn btn-sm btn-dark fa fa-send " href="'.base_url().'G_dashboard/halaman_email/$1"></a> || <a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'G_dashboard/data_penulis/$1"></a> || <a class="btn btn-sm btn-warning fa fa-edit " href="'.base_url().'G_dashboard/edit_penulis/$1"></a> || <a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'G_dashboard/hapus_penulis/$1"></a>', 'base64_encode(id_account)');
return $this->datatables->generate();
}

function json_user(){
$this->datatables->select('id_admin,'
. 'user.nama_admin as nama_admin,'
. 'user.email as email,'
. 'user.level as level,'
);

$this->datatables->from('user');
$this->datatables->add_column('view','<a class="btn btn-sm btn-danger fa fa-trash " href="'.base_url().'G_dashboard/hapus_user/$1"></a>', 'base64_encode(id_admin)');
return $this->datatables->generate();
}

function lihat_naskah($id_file_naskah){

$this->db->select('*');
$this->db->from('file_naskah_penulis');
$this->db->where('id_file_naskah',base64_decode($id_file_naskah));
$this->db->join('kategori_naskah', 'kategori_naskah.id_kategori_naskah = file_naskah_penulis.id_kategori_naskah');

$query = $this->db->get();

return $query;    
}
function update_naskah($data,$param){

$this->db->update('file_naskah_penulis',$data,array('id_file_naskah'=> base64_decode($param)));    
}



function lihat_naskah_penulis($id_penulis){
$this->datatables->select('id_file_naskah,'
. 'file_naskah_penulis.judul as judul,'
. 'file_naskah_penulis.penulis as penulis,'
. 'file_naskah_penulis.harga as harga,'
. 'file_naskah_penulis.status as status,'
. 'file_naskah_penulis.tanggal_upload as tanggal_upload,'
. 'kategori_naskah.nama_kategori as nama_kategori,'
);
$this->datatables->where('id_account', base64_decode($id_penulis));
$this->datatables->from('file_naskah_penulis');
$this->datatables->join('kategori_naskah','kategori_naskah.id_kategori_naskah = file_naskah_penulis.id_kategori_naskah');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'G_dashboard/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}
function json_penjualan(){
$this->datatables->select('id_data_penjualan,'
.'data_penjualan.no_invoices as no_invoices,'
.'data_penjualan.nama_customer as nama_customer,'
.'data_penjualan.tanggal_transaksi as tanggal_transaksi,'
.'data_penjualan.status_penjualan as status_penjualan,'
.'data_penjualan.resi_pengiriman as resi_pengiriman,'
.'data_penjualan.penjualan as penjualan,'
.'data_penjualan.jumlah_biaya_lain as ongkir,'        
);
$this->datatables->from('data_penjualan');
$this->datatables->add_column('view','<button data-toggle="modal" data-target=".bd-example-modal-lg" onclick=data_penjualan("$1") class="btn btn-sm btn-success fa fa-eye"></button> || <a class="btn btn-sm btn-warning fa fa-print " href="'.base_url().'G_dashboard/cetak_label/$1"> Cetak Label </a> || <button class="btn btn-sm btn-warning fa fa-edit  " onclick=edit_status("$1") > Edit </button>', 'base64_encode(id_data_penjualan)');
return $this->datatables->generate();
}

function get_penjualan($id){
$this->db->select('*');
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$this->db->where('data_penjualan.id_data_penjualan', base64_decode($id));
$query = $this->db->get();
return $query;




}
function simpan_user($data){
$this->db->insert('user',$data);    

}
function hapus_user($id_admin){

$this->db->delete('user',array('id_admin'=>$id_admin));    

}
public function cari_penulis($term){
$this->db->from("akun_penulis");
$this->db->limit(15);
$array = array('nama_lengkap' => $term);
$this->db->like($array);
$this->db->where('status_akun','aktif');
$query = $this->db->get();

if($query->num_rows() >0 ){

return $query->result();
}

}
public function cari_customer($term){
$this->db->from("data_customer");
$this->db->limit(7);
$array = array('nama_customer' => $term);
$this->db->like($array);
$query = $this->db->get();

if($query->num_rows() >0 ){

return $query->result();
}

}
public function cari_buku($term){
$this->db->from("file_naskah_penulis");
$this->db->limit(15);
$this->db->where('status','Publish');
$array = array('judul' => $term);
$this->db->like($array);
$query = $this->db->get();

if($query->num_rows() >0 ){

return $query->result();
}

}

function data_penulis($id_account){
    
$query = $this->db->get_where('akun_penulis',array('id_account'=> base64_decode($id_account)));    
  
return $query;    

    
}

function update_penulis($data,$id_account){
    
 $this->db->update('akun_penulis',$data,array('id_account'=> base64_decode($id_account)));   
    
}


function proses_publish($data){
$this->db->insert('file_naskah_penulis',$data);        
}

function hapus_penulis($id_account){
$this->db->delete('akun_penulis',array('id_account'=> base64_decode($id_account)));    
    
}


function set_laris($data){
$this->db->insert('buku_terlaris',$data);   
    
}
function set_diskon_produk($data,$param){
$this->db->update('file_naskah_penulis',$data,array('id_file_naskah'=>$param));    
}

function data_produk_laris(){
$this->db->select('buku_terlaris.id_file_naskah');
$this->db->select('judul');
$this->db->from('buku_terlaris');
$this->db->join('file_naskah_penulis', 'file_naskah_penulis.id_file_naskah = buku_terlaris.id_file_naskah');
$query = $this->db->get();
return $query;
}
function data_produk_diskon(){
$query = $this->db->get_where('file_naskah_penulis',array('status'=>'Produk Diskon'));
    
return $query;    
}

function hapus_terlaris($param){
    
$this->db->delete('buku_terlaris',array('id_file_naskah'=> base64_decode($param)));    
}

function total_naskah(){
$query = $this->db->get('file_naskah_penulis');    

return $query;
}

function simpan_penjualan($data){
    
$this->db->insert('data_penjualan',$data);    
}

function file_naskah_penulis($id_file_naskah){
         $this->db->select('id_account');
         $this->db->select('id_file_naskah');
         $this->db->select('judul');
         $this->db->select('harga');
         $this->db->select('penulis');
$query = $this->db->get_where('file_naskah_penulis',array('id_file_naskah'=>$id_file_naskah));

return $query;
    
}

function simpan_customer_baru($data){
    
 $this->db->insert('data_customer',$data);   
}

function hitung_invoices(){
$query = $this->db->get('data_penjualan')->num_rows();

return $query;
    
}

function simpan_data_penjualan($data){
    
$this->db->insert('data_penjualan',$data);    
    
}

function simpan_jumlah_penjualan($data){
    
$this->db->insert('data_jumlah_penjualan',$data);    
    
}

function update_status_penjualan($data,$id_data_penjualan){

$this->db->update('data_penjualan',$data,array('id_data_penjualan'=> base64_decode($id_data_penjualan)));    
}

function total_royalti_penulis($id_account){
$this->db->select('royalti');
$query =$this->db->get_where('data_jumlah_penjualan',array('id_account_penulis'=> base64_decode($id_account)));

return $query;

}

function total_naskah_penulis($id_account){
$query =$this->db->get_where('file_naskah_penulis',array('id_account'=> base64_decode($id_account)));

return $query;

}

function json_penjualan_customer($id){
$this->datatables->select('id_data_jumlah_penjualan,'
.'data_jumlah_penjualan.no_invoices as no_invoices,'
.'data_jumlah_penjualan.id_account_penulis as id_account,'
.'data_penjualan.id_data_penjualan as id_data_penjualan,'
.'data_penjualan.nama_customer as nama_customer,'
.'data_jumlah_penjualan.tanggal_transaksi as tanggal_transaksi,'
.'data_penjualan.status_penjualan as status_penjualan,'
);
$this->datatables->where('id_account_penulis', base64_decode($id));
$this->datatables->group_by('data_penjualan.no_invoices');
$this->datatables->from('data_penjualan');
$this->datatables->join('data_jumlah_penjualan','data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-print " href="'.base_url().'G_dashboard/print_penjualan_customer/$1/$2"></a>', 'base64_encode(id_data_penjualan),base64_encode(id_account)');
return $this->datatables->generate();
}


function json_customer_royalti(){
$this->datatables->select('id_account,'
.'akun_penulis.nama_lengkap as nama_lengkap,'
.'akun_penulis.nomor_kontak as nomor_kontak,'
.'akun_penulis.email as email,'
.'akun_penulis.royalti_diperoleh as royalti_diperoleh,'
);
$this->datatables->where('royalti_diperoleh !=',0);
$this->datatables->from('akun_penulis');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-exchange " href="'.base_url().'G_dashboard/buat_transfer/$1"> Buat Transferan</a>', 'base64_encode(id_account)');
return $this->datatables->generate();
      
}

function simpan_transfer($data,$id){

$this->db->update('data_pengajuan_royalti',$data,array('id_data_pengajuan'=> base64_decode($id)));
    
}

function json_transfer_royalti(){
$this->datatables->select('data_transfer_royalti.id_account,'
.'data_transfer_royalti.id_data_transfer_royalti as id_data_transfer_royalti,'
.'data_transfer_royalti.royalti as royalti,'
.'data_transfer_royalti.biaya_admin as biaya_admin,'
.'data_transfer_royalti.royalti_bersih as royalti_bersih,'
.'akun_penulis.nama_lengkap as nama_lengkap,'
.'akun_penulis.nomor_kontak as nomor_kontak,'
.'akun_penulis.email as email,'
        
);
$this->datatables->from('data_transfer_royalti');
$this->datatables->join('akun_penulis','akun_penulis.id_account = data_transfer_royalti.id_account');
$this->datatables->add_column('view','<button class="btn btn-sm btn-success fa fa-download " onclick=download_bukti("$1") > Download </a>', 'base64_encode(id_data_transfer_royalti)');
return $this->datatables->generate();
      
}

function json_all_order(){
$this->datatables->select('data_jumlah_penjualan_toko.id_penjualan_toko,'
.'data_jumlah_penjualan_toko.invoices_toko as invoices_toko,'
.'data_jumlah_penjualan_toko.nomor_kontak as nomor_kontak,'
.'data_jumlah_penjualan_toko.nama_penerima as nama_penerima,'
.'data_jumlah_penjualan_toko.status as status,'
.'data_jumlah_penjualan_toko.nomor_resi as nomor_resi,'
        
);
$this->datatables->from('data_jumlah_penjualan_toko');
$this->datatables->add_column('view','<a href='. base_url('G_dashboard/download_invoices/$1').' class="btn btn-sm btn-success fa fa-download "> Download invoices </a>', 'base64_encode(id_penjualan_toko)');
return $this->datatables->generate();
      
}

function orderan_masuk(){

$query = $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'pending'));

return $query;
}

function orderan_proses(){

$query = $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'proses'));

return $query;
}

function orderan_terima(){
         $this->db->order_by('tanggal_terima','DESC');
$query = $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'terima'));

return $query;
}

function input_resi_toko($data,$param){
$this->db->update('data_jumlah_penjualan_toko',$data,array('id_penjualan_toko'=>$param));    
}

function input_nama_penerima($data,$param){
$this->db->update('data_jumlah_penjualan_toko',$data,array('id_penjualan_toko'=>$param));    
}

function input_alasan_penolakan($data,$param){
$this->db->update('data_jumlah_penjualan_toko',$data,array('id_penjualan_toko'=>$param));    
}

function simpan_balance($data,$param){
$this->db->update('akun_penulis',$data,array('id_account'=> base64_decode($param)));    
}

function input_promo($data){
 $this->db->insert('data_kode_promo',$data);   
}
function data_promo(){
$query = $this->db->get('data_kode_promo');
return $query;
    
}
function hapus_promo($id){
$this->db->delete('data_kode_promo',array('id_data_kode_promo'=> base64_decode($id)));    
}

function hapus_kupon($id){
$this->db->delete('data_kode_kupon',array('id_data_kupon'=> base64_decode($id)));    
}
function input_kupon($data){

$this->db->insert('data_kode_kupon',$data);    
}

function json_kode_kupon(){
$this->datatables->select('data_kode_kupon.id_data_kupon,'
.'data_kode_kupon.id_data_kupon as id_data_kupon,'
.'data_kode_kupon.email_penulis as email_penulis,'
.'data_kode_kupon.nama_penulis as penerima,'
.'data_kode_kupon.nama_kupon as nama_kupon,'
.'data_kode_kupon.nilai_kupon as nilai_kupon,'
.'data_kode_kupon.syarat_kupon as syarat_kupon,'
.'data_kode_kupon.status_kupon as status_kupon,'
.'data_kode_kupon.tanggal_expired as tanggal_expired,'
);

$this->datatables->from('data_kode_kupon');
$this->datatables->add_column('view','<a href='. base_url('G_dashboard/hapus_kupon/$1').' class="btn btn-sm btn-danger fa fa-close">  </a>', 'base64_encode(id_data_kupon)');
return $this->datatables->generate();
      
}

function terima_pesanan($data,$param){
$this->db->update('data_jumlah_penjualan_toko',$data,array('id_penjualan_toko'=>$param));    
}

function data_pembeli($param){
    
$this->db->select('akun_penulis.email');
$this->db->from('data_jumlah_penjualan_toko');
$this->db->join('akun_penulis', 'akun_penulis.id_account = data_jumlah_penjualan_toko.id_account');
$this->db->where('data_jumlah_penjualan_toko.id_penjualan_toko',$param);
$query = $this->db->get();    
return $query;
}

function simpan_kata_kunci($data){
    
$this->db->insert('seo',$data);    
}

function hapus_seo($param){ 
$this->db->delete('seo',array('id_kata_kunci'=> base64_decode($param)));    
}
function laporan_bagi_hasil(){

$query = $this->db->get_where('akun_penulis',array('royalti_diperoleh >'=>50000));
return $query;
    
}
function data_info($id_file){
    
$this->db->select('*');
$this->db->where('file_naskah_penulis.id_file_naskah', base64_decode($id_file));
$this->db->from('file_naskah_penulis');
$this->db->join('akun_penulis', 'akun_penulis.id_account = file_naskah_penulis.id_account');
$query = $this->db->get();

return $query;
}


function hapus_naskah($id){

$this->db->delete('file_naskah_penulis',array('id_file_naskah'=> base64_decode($id)));
    
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
$this->datatables->where('data_pengajuan_royalti.status','Pending');
$this->datatables->from('data_pengajuan_royalti');
$this->datatables->join('akun_penulis','akun_penulis.id_account = data_pengajuan_royalti.id_account');
$this->datatables->add_column('view','<a href='.base_url('G_dashboard/download_bukti/$2').'  class="btn btn-sm btn-success fa fa-download "> </a> || <button class="btn btn-warning" onclick=edit_pengajuan("$1","$2")>   <span class="fa fa-edit"></span></button>', 'base64_encode(id_account),base64_encode(id_data_pengajuan)');
return $this->datatables->generate();
      
}
function json_data_pengajuan_bagi_hasil_selesai(){
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
$this->datatables->where('data_pengajuan_royalti.status','Selesai');
$this->datatables->from('data_pengajuan_royalti');
$this->datatables->join('akun_penulis','akun_penulis.id_account = data_pengajuan_royalti.id_account');
$this->datatables->add_column('view','<a href='.base_url('G_dashboard/buat_transfer/$1/$2').'  class="btn btn-sm btn-success fa fa-exchange "> </a> || <a href='.base_url('G_dashboard/download_bukti/$2').'  class="btn btn-sm btn-success fa fa-download "> </a>', 'base64_encode(id_account),base64_encode(id_data_pengajuan)');
return $this->datatables->generate();
      
}
function json_data_pengajuan_bagi_hasil_dibatalkan(){
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
$this->datatables->where('data_pengajuan_royalti.status','Dibatalkan');
$this->datatables->from('data_pengajuan_royalti');
$this->datatables->join('akun_penulis','akun_penulis.id_account = data_pengajuan_royalti.id_account');
return $this->datatables->generate();
      
}
public function data_bukti($id_data_transfer){
 
$this->db->select('*');
$this->db->from('data_pengajuan_royalti');
$this->db->join('akun_penulis', 'akun_penulis.id_account = data_pengajuan_royalti.id_account');
$this->db->where('id_data_pengajuan',base64_decode($id_data_transfer));
$query = $this->db->get();
return $query;
}

public function cek_data_kode_kupon($id_account){
$query = $this->db->get_where('data_kode_kupon',array('id_account'=>$id_account,'status_kupon'=>"Permanen"));
return $query;
}
public function input_kode_kupon($data){
$this->db->insert('data_kode_kupon',$data);    
}

public function simpan_banner($data){
$this->db->insert('banner', $data);
}
public function data_banner(){
$query = $this->db->get('banner');
return $query;
    
}
public function hapus_banner($id){

$this->db->delete('banner',array('id_banner'=> base64_decode($id)));    
}
public function data_akun($id){
         $this->db->select('nama_lengkap');
         $this->db->select('email');
$query = $this->db->get_where('akun_penulis',array('id_account'=> base64_decode($id)));

return $query;
    
}

public function data_email($id_account){
$query = $this->db->get_where('riwayat_email',array('id_account'=> base64_decode($id_account))); 
return $query;    
}
public function tampil_email($id_account,$number,$offset){
    
         $this->db->where(array('id_account'=> base64_decode($id_account))); 
$query = $this->db->get('riwayat_email',$number,$offset);    

    
return $query;
    
}


}
