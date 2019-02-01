<body onload="halaman_checkout()"></body>
<div class="container batas_header">
<div id="halaman_checkout"></div>

</div>
<style>
.swal-wide{
    width:900px !important;
}    
</style>    
<script type="text/javascript">
function halaman_checkout(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
$.ajax({
type:"POST",
url:"<?php echo base_url('Store/halaman_checkout') ?>",
data:"token="+token,
success:function(data){
$("#halaman_checkout").html(data);    
}
});
}

$(document).ready(function(){
$("#bayar").click(function(){
   
    
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var metode_pembayaran = $("#metode_pembayaran").val();    
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/bayar') ?>",
data:"token="+token+"&metode_pembayaran="+metode_pembayaran,
success:function(data){
if(data != "error"){
    
   
swal({
html:data, 
showConfirmButton: true,
animation: false,
customClass: 'animated bounceInDown swal-wide'
}).then(function() {
window.location.href = "<?php echo base_url('Store/konfirmasi_pembayaran') ?>";
});
}else{

swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('Store') ?>";
});

}
}

});

   
});


});

</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Masukan Kode kupon Atau Promo</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active show" href="#tab_promo" role="tab" data-toggle="tab" aria-selected="true">Kode Promo</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#tab_kupon" role="tab" data-toggle="tab">Kupon Saya</a>
</li>
</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade active show" id="tab_promo" >
<hr>
<label>Kode promo </label>
<input type="text" class="form-control" id="promo" value="" placeholder="Kode promo . . . " ><hr>
<button type="button" class="btn btn-success" id="tambah_promo">Tambahkan promo <span class="fa fa-plus"></span></button>

</div>
<div role="tabpanel" class="tab-pane fade" id="tab_kupon">
<?php 
if(!$this->session->userdata('id_account_toko')){ ?>
    <hr>
    <h5 class="text-center p-2">Untuk dapat menggunakan kupon silahkan masuk akun terlebih dahulu</h5>
    <hr><a href="<?php echo base_url('Store/login_akun') ?>"><button class="btn btn-success">Masuk akun <span class="fa fa-sign-in"></span> <span class="fa fa-login"></span></button></a>
    
<?php }else{
     foreach ($kupon->result_array() as $k ){    
?>

<div class="card  m-3" >
<div class="row ">
<div class="col-md-7 p-1" style="background-color: #28a745; color:#fff;">
<p><span style="font-size:25px;"><?php echo $k['nama_kupon'] ?></span>
<br>
<span style="font-size:15px;">Minimal Belanja : Rp.<?php echo number_format($k['syarat_kupon']) ?> <span><br>
<span style="font-size:11px;">Masa Berlaku sampai : <?php echo $k['tanggal_expired'] ?> <span></p>
</div>
<button class="form-conttrol rounded-right btn-dark col" onclick="tambah_kupon('<?php echo base64_encode($k['id_data_kupon']) ?>');">Gunakan Kupon <span class="fa fa-plus"></span> <br> Potongan : <?php echo $k['nilai_kupon'] ?> %</button>
</div>
</div>  

    
<?php } }?>  
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="metode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Plih Metode pembayaran</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
    
<div class="modal-body">
<label>Metode pembayaran</label>
<select id="metode_pembayaran" class="form-control">
<option>Bank Transfer</option>
</select>
</div>
    
<div class="modal-footer">
    <button type="button" class="btn btn-primary form-control" id="bayar">Bayar  <i style="display:none;" id="loading_bayar" class="fa fa-spinner fa-pulse"></i></button>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#tambah_promo").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var promo = $("#promo").val();
if (promo !=''){
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/set_promo') ?>",
data:"token="+token+"&promo="+promo,
success:function(data){
if(data == "berhasil") {   
halaman_checkout();
$('#exampleModal').modal('toggle');

swal({
title:"", 
text:"Kode Promo berhasil ditambahkan",
type:"success",
showConfirmButton: true,
});

} else {
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
text:"Kode Promo harus di isi",
type:"question",
showConfirmButton: true,
});   
}
});





});    
    
function tambah_kupon(id_data_kupon){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/set_kupon') ?>",
data:"token="+token+"&id_data_kupon="+id_data_kupon,
success:function(data){
if(data == "tidak_lolos"){
swal({
title:"", 
text:"Minimal Belanja Tidak Terpenuhi",
type:"warning",
showConfirmButton: true,
}); 
}else if(data == "berhasil"){
swal({
title:"", 
text:"Kode Kupon Berhasil Di Tambahkan",
type:"success",
showConfirmButton: true,
});     
$('#exampleModal').modal('toggle');

}else{
swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
});
}

halaman_checkout();   


}
});

}   
</script>
