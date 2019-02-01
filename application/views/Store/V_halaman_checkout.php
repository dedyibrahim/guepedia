<?php  $alamat = $data_alamat->row_array(); ?>
<div class="container batas_header">
<h4 align="center"><span class="fa fa-list-ul fa-3x fa-color"></span><br>Checkout</h4><hr>
<div class="row">
<div class="col-md-4">
<div class="card p-3 mt-2">  
<h4 align='center'>Alamat pengiriman</h4><hr>
<?php if(!$alamat){ ?>    
<label>Nomor kontak</label>
<input type="text" class="form-control" id="nomor_kontak">

<label>Penerima</label>
<input type="text" class="form-control" value="<?php echo $this->session->userdata('nama_lengkap') ?>" id="nama_penerima">

<label>Nama kota</label>
<input type="text" class="form-control" id="nama_kota">
<input type="hidden" id="city_id" class="form-control" id="city_id">

<label>Nama Kecamatan</label>
<select  readonly="" name='kecamatan' class='form-control' id='subdistrict_id'>
</select>

<label>Nama Provinsi</label>
<input type="text" readonly=""  class="form-control" id="nama_provinsi">
<label>Kode pos</label>
<input type="text" readonly="" class="form-control" id="kode_pos">
<label>Alamat lengkap </label>
<textarea readonly=""  class="form-control" id="alamat_lengkap" rows="5" placeholder="Alamat lengkap Termasuk Nama Kelurahan, Nama jalan, RT, RW, dan Nomor Rumah"></textarea>
<hr>
<button class="btn btn-success form-control" id="simpan_alamat">Simpan Alamat <span class="fa fa-save"></span></button>
<?php } else { ?>

Penerima : <?php echo $alamat['nama_penerima'] ?><br>
Nama kota : <?php echo $alamat['nama_kota'] ?><br>
Nama kota : <?php echo $alamat['nomor_kontak'] ?><br>
Nama Provinsi : <?php echo $alamat['nama_provinsi'] ?><br>
Nama Kecamatan : <?php echo $alamat['nama_kecamatan'] ?><br>    
Kode Pos : <?php echo $alamat['kode_pos'] ?><br>    
Alamat lengkap : <?php echo $alamat['alamat_lengkap'] ?>
<hr>
<button class="btn btn-warning form-control" id="alamat_baru">Buat alamat baru <span class="fa fa-plus"></span></button>

<?php } ?>
<hr>    
</div>
</div>


<div class="col">
    <div class="card p-3 mt-2">    
<h4 align='center'>Kurir Pengiriman</h4><hr>
<?php if(!$this->session->userdata('ongkir')){ ?>
<label>Nama Kurir</label>
<select <?php  if(!$alamat){ echo "disabled='' "; }  ?> class="form-control" id="kurir" onchange="cek_cost();">
<option ></option>    
<option value="jne">JNE</option>  
</select>
<div id="data_kost">
</div>
<?php } else {  ?>
Kurir            <?php echo $this->session->userdata('kurir') ?><hr>
Service          <?php echo $this->session->userdata('service') ?><hr>
Biaya Ongkir Rp. <?php echo number_format($this->session->userdata('ongkir')) ?>
<hr>
<button class="btn btn-warning form-control" id="ubah_kurir">Ubah Kurir Pengiriman <span class="fa fa-truck"></span></button>
<hr>
<?php } ?>
</div>
</div>
    
<div class="col-md-4">
    <div class="card p-3 mt-2">    
<h4 align='center'>Ringkasan Belanja </h4><hr> 
<div class="row">
<div class="col">Total harga </div>    
<div class="col text-right"><b>Rp.<?php echo number_format($this->cart->total()) ?></b>
</div>    
</div>

<?php if ($this->session->userdata('hasil_kupon')){ ?>
<div class="row">
<div class="col">Potongan Kupon </div>    
<div class="col text-right"> <b style="color:#dc3545;"> - Rp.<?php echo number_format($this->session->userdata('hasil_kupon')) ?></b>
</div>    
</div>
<hr>
<?php } ?>

<?php if ($this->session->userdata('hasil_promo')){ ?>
<div class="row">
<div class="col">Potongan Promo </div>    
<div class="col text-right"> <b  style="color:#dc3545;"> - Rp.<?php echo number_format($this->session->userdata('hasil_promo')) ?></b>
</div>    
</div>
<hr>
<?php } ?>

<?php if ($this->session->userdata('hasil_promo') || $this->session->userdata('hasil_kupon')){ ?>
<div class="row">
<div class="col-md-8">Harga setelah diskon</div>    
<div class="col text-right"> <b>Rp.<?php echo number_format($this->cart->total()-$this->session->userdata('hasil_promo')-$this->session->userdata('hasil_kupon')) ?></b>
</div>    
</div>
<hr>
<?php } ?>


<?php if ($this->session->userdata('ongkir')){ ?>
<div class="row">
<div class="col">Ongkos Kirim</div>    
<div class="col text-right"> <b>Rp.<?php echo number_format($this->session->userdata('ongkir')) ?></b></div>    
</div>
<?php } ?>

<?php if ($this->session->userdata('ongkir')){ ?>
<hr>
<div class="row p-2 m-2" style="color: #28a745; border: 2px #dc3545 solid; ">
    <div class="col text-center"><b>Total yang harus dibayar</b> <br>
    <b>Rp.<?php echo number_format($this->session->userdata('ongkir') + $this->cart->total() - $this->session->userdata('hasil_kupon') - $this->session->userdata('hasil_promo')) ?></b>
    </div>    
   
</div>
<hr>
<button data-toggle="modal" data-target="#metode"  class="form-control btn btn-success">Pilih Metode Pembayaran <span class=" fa fa-money"></span></button>


<?php } ?>

<?php if(!$this->session->userdata('nilai_kupon') && !$this->session->userdata('nilai_promo')){ ?>
<hr>
<button class="btn btn-dark form-control" data-toggle="modal" data-target="#exampleModal"></span> Gunakan Kode Kupon Atau Promo</button>
<?php } ?>

<hr>
</div>
<hr>
</div>
</div>
<hr>
</div>


<script type="text/javascript">
$(function () {
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$("#nama_kota").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Store/cari_kota') ?>',
select:function(event, ui){
$('#nama_provinsi').val(ui.item.province);
$('#kode_pos').val(ui.item.postal_code);
$('#city_id').val(ui.item.city_id);
$("#subdistrict_id").attr("readonly", false); 
$("#alamat_lengkap").attr("readonly", false); 
$.ajax({
type:"POST",
url:"<?php echo base_url('Store/data_kecamatan') ?>",
data:"token="+token+"&city_id="+ui.item.city_id,
success:function(data){
$("#subdistrict_id").html(data);    
}

});
}

}
);
});

function cek_cost(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var kurir  = $("#kurir  option:selected").val();

if( kurir !='' ){

$.ajax({
type:"post",
url:"<?php echo base_url('Store/cost_checkout') ?>",
data:"token="+token+"&kurir="+kurir,
success:function(data){
$("#data_kost").html(data);   

}


});

}else{
swal({
title:"", 
text:"Masih ada data yang harus di isi",
type:"error",
showConfirmButton: true,
});    
}
}
$(document).ready(function(){
$("#simpan_alamat").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var nama_penerima   = $("#nama_penerima").val();
var nama_kota       = $("#nama_kota").val();
var city_id         = $("#city_id").val();
var nama_provinsi   = $("#nama_provinsi").val();
var nomor_kontak    = $("#nomor_kontak").val();
var kode_pos        = $("#kode_pos").val();
var alamat_lengkap  = $("#alamat_lengkap").val();
var subdistrict_id  = $("#subdistrict_id  option:selected").val();
var nama_kecamatan  = $("#subdistrict_id option:selected").html();

if(nama_penerima !='' && nomor_kontak !='' && nama_kecamatan !='' && nama_kota !='' && city_id !='' && nama_provinsi !='' && kode_pos !='' && alamat_lengkap !='' && subdistrict_id !='' ){

$.ajax({
type :"POST",
url  :"<?php echo base_url('Store/simpan_alamat') ?>",
data :"token="+token+"&nama_penerima="+nama_penerima+"&nomor_kontak="+nomor_kontak+"&nama_kota="+nama_kota+"&city_id="+city_id+"&nama_provinsi="+nama_provinsi+"&kode_pos="+kode_pos+"&alamat_lengkap="+alamat_lengkap+"&subdistrict_id="+subdistrict_id+"&nama_kecamatan="+nama_kecamatan,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Data alamat pengiriman tersimpan",
type:"success",
showConfirmButton: true,
});
halaman_checkout();
}else{
swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
});     
} 
}
});



}else{
swal({
title:"", 
text:"Masih ada data yang harus di isi",
type:"error",
showConfirmButton: true,
});   
}

});

$("#alamat_baru").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/buat_alamat_baru') ?>",
data:"token="+token,
success:function(data){
halaman_checkout();   
}
});

});


$("#ubah_kurir").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/ubah_kurir') ?>",
data:"token="+token,
success:function(data){
halaman_checkout();   
}
});

});




});

function set_ongkir(id){
var ongkir     = $("input[name='ongkir']:checked").val();
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var nama_kurir  = $("#nama_kurir").html();
var nama_service =$("#nama_service" + id).html();

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/set_ongkir') ?>",
data:"token="+token+"&ongkir="+ongkir+"&nama_kurir="+nama_kurir+"&nama_service="+nama_service,
success:function(data){
halaman_checkout();   
}
});

}
</script>

