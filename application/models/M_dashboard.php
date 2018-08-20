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
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'Halaman_penulis/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
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
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'Halaman_penulis/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}

function json_penulis(){
$this->datatables->select('id_account,'
. 'akun_penulis.nama_lengkap as nama_lengkap,'
. 'akun_penulis.email as email,'
. 'akun_penulis.nomor_kontak as nomor_kontak,'
. 'akun_penulis.nomor_rekening as nomor_rekening,'
. 'akun_penulis.nama_bank as nama_bank,'
);

$this->datatables->from('akun_penulis');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'Halaman_penulis/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();
}

function json_user(){
$this->datatables->select('id_admin,'
. 'user.nama_admin as nama_admin,'
. 'user.email as email,'
);

$this->datatables->from('user');
$this->datatables->add_column('view','<a class="btn btn-sm btn-success fa fa-eye " href="'.base_url().'Halaman_penulis/lihat_naskah/$1"></a>', 'base64_encode(id_file_naskah)');
return $this->datatables->generate();


}
}
