<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Store extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->library('pagination');
$this->load->model('M_store');
$this->load->library('cart');
}

public function index(){
$baru_terbit = $this->M_store->baru_terbit();    
$terlaris    = $this->M_store->terlaris();    

$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_banner');
$this->load->view('Store/V_home',['baru_terbit'=>$baru_terbit,'terlaris'=>$terlaris]);
$this->load->view('Umum/V_footer_toko');
}

public function kategori(){
if($this->uri->segment(3) !=''){
$id_kategori = $this->uri->segment(3);

$jumlah_data = $this->M_store->jumlah_buku($id_kategori);
$config['base_url'] = base_url().'/Store/kategori/'.$this->uri->segment(3)."/";
$config['total_rows'] = $jumlah_data;
$config['per_page'] = 12;
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['attributes'] = ['class' => 'page-link'];
$config['first_link'] = false;
$config['last_link'] = false;
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';
$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';
$from = $this->uri->segment(4);

$this->pagination->initialize($config);		
$kategori= $this->M_store->lihat_kategori($id_kategori,$config['per_page'],$from);


$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_kategori',['kategori'=>$kategori]);

echo $this->pagination->create_links();

$this->load->view('Umum/V_footer_toko');

}else {
redirect(404);    
}
}
public function cari_buku(){


$kata_kunci = $this->input->post('kata_kunci');

$hasil_cari = $this->M_store->cari_buku($kata_kunci);    

echo "<div class='row'>";
foreach ($hasil_cari->result_array() as $data){

echo "
<a style='text-decoration:none;' href='".base_url('Store/lihat_buku/'.base64_encode($data['id_file_naskah']))."'>    

<div class='col-lg-3 col-md-6 mb-4'>
<div class='card'>
<img class='card-img-top cover'  src='".base_url('uploads/file_cover/'.$data['file_cover'])."' alt=''>
<div class='card-body'>
<p class='card-text' style='height:50px; text-align: center;'>".$data['judul']."</p>
</div>
</a>
<div class='card-footer'>";
echo '<button onclick="tambah_keranjang('."'".base64_encode($data['id_file_naskah'])."'".')" class="btn btn-success form-control"><b>Rp.'.number_format($data['harga'])."</b> <span class='fa fa-shopping-basket '></span></button>    



</div>
</div>
</div>";
}
echo "</div>";

}

function lihat_buku(){
$id_file_naskah = $this->uri->segment(3);

$query = $this->M_store->data_buku($id_file_naskah);
$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_lihat_buku',['data'=>$query]);
$this->load->view('Umum/V_footer_toko');
}
function tambah_keranjang(){
if($this->input->post('id_file_naskah')){
$id_file_naskah = $this->input->post('id_file_naskah'); 
$query = $this->M_store->tambah_keranjang($id_file_naskah)->row_array();    

$data = array(
'id'            => $query['id_file_naskah'],
'qty'           => $this->input->post('qty'),
'price'         => $query['harga'],
'name'          => $query['judul'],
'berat'         => $query['berat_buku'],
'id_account'    => $query['id_account'],

);

$this->cart->insert($data);
echo $query['judul']; 
}else{
redirect(404);    
}    

}
function keranjang_header(){

foreach ($this->cart->contents() as $items){
echo "<span style='color:#28a745; font-size:15px;'>".$items['name']."</span><br> ";    
echo "Rp. ". number_format($items['price'])." X ";    
echo number_format($items['qty'])." = ";    
echo "Rp. ".number_format($items['subtotal'])."<br>";    
}    
echo "<hr><span style='color:#28a745; font-size:18px; text-align: center;'>Total : Rp. ".number_format($this->cart->total())."</span>";

}
function keranjang(){
$this->load->view('Umum/V_header');
$this->load->view('Store/V_header_toko');
$this->load->view('Store/V_keranjang');
$this->load->view('Umum/V_footer_toko');    
}
function keranjang_total(){
echo '<table style="text-align:  center;" class="table table-sm table-bordered table-striped table-condensed">
<tr>
<th>No</th>  
<th>Nama Buku</th>  
<th>Harga</th>  
<th style="width: 10%;">Qty</th>  
<th>Jumlah</th>  
<th>Aksi</th>  
</tr>';
$no=1; foreach ($this->cart->contents() as $items){ 
echo '<tr>
<td>'.$no ++.'</td>   
<td><a style="text-decoration:none;" href="'.base_url('Store/lihat_buku/'. base64_encode($items['id'])).'" > '.$items['name'] .'</a></td>
<td>Rp.'.number_format($items['price']) .'</td>
<td><input type="text" id="qty'.$items['id'].'" onchange="update_qty_keranjang('.$items['id'].')" class="form-control" value="'.$items['qty'].'"></td>
<td>Rp. '.number_format($items['subtotal']).'</td>
<td><button onclick="hapus_cart('.$items['id'].');" class="btn btn-danger"><span class="fa fa-close"></span></button></td>
</tr>';

}

echo '</table>'; 

}
function update_qty_keranjang(){
if($this->input->post('qty')){
$input = $this->input->post();
$data = array(
'rowid' => md5($input['id']),
'qty'=> $input['qty'],
);
echo print_r($input);
$this->cart->update($data);

}else{
redirect(404);    
} 
}

function hapus_cart(){
if($this->input->post('id')){
$data = array(
'rowid' => md5($this->input->post('id')),
'qty'   => 0,
);

$this->cart->update($data);    
}else{
redirect(404);    
}    
}

function input_kota(){
/*$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
"key: 2390264a2b725f30995e41292a420f65"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
$data_kota =array(
'city_id'       => $data['rajaongkir']['results'][$i]['city_id'],
'province_id'   => $data['rajaongkir']['results'][$i]['province_id'],
'province'      => $data['rajaongkir']['results'][$i]['province'],
'city_name'     => $data['rajaongkir']['results'][$i]['city_name'],
'type'          => $data['rajaongkir']['results'][$i]['type'],
'postal_code'   => $data['rajaongkir']['results'][$i]['postal_code'],
'nama_kota'     => $data['rajaongkir']['results'][$i]['type']." ".$data['rajaongkir']['results'][$i]['city_name'],
);
$this->db->insert('data_kota',$data_kota);
}

}*/
echo $this->db->get('data_kota')->num_rows();    
    
}    


public function cari_kota(){
$term = strtolower($this->input->get('term'));    

$query = $this->M_store->cari_kota($term);

foreach ($query as $d) {
$json[]= array(
'label'                     => $d->nama_kota,   
'province'                  => $d->province,   
'postal_code'               => $d->postal_code,
'city_id'               => $d->city_id,
);   

}

echo json_encode($json);
}
}

