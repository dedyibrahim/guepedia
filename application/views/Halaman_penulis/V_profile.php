<?php $akun = $data_akun->row_array();?>

<div class="container">
       
<div class="row">
<div class="col" style="background-color:#eee; margin:1%; padding: 1%;  ">
<h3 align="center"> <span class="fa fa-user fa-2x fa_color"></span><br> My Profile</h3><hr>
<label>Nama lengkap :</label>
<input type="text" class="form-control" id="nama_lengkap" readonly="" value="<?php echo $akun['nama_lengkap'] ?>">
<label>Nama Pena :</label>
<input type="text" class="form-control" id="nama_pena" readonly="" value="<?php echo $akun['nama_pena'] ?>">
<label>Nomor kontak :</label>
<input type="text" class="form-control" id="nomor_kontak" readonly="" value="<?php echo $akun['nomor_kontak'] ?>">
<label>Alamat lengkap :</label>
<textarea class="form-control" id="alamat_lengkap" readonly=""><?php echo $akun['alamat_lengkap'] ?></textarea>
<label>Email :</label>
<input type="text" class="form-control" id="email" readonly="" value="<?php echo $akun['email'] ?>">
<hr>
<button class="form-control btn btn-warning" id="btn_edit">Edit <span class="fa fa-edit"></span></button>
<button class="form-control btn btn-success" style="display: none;" id="btn_update">Update <span class="fa fa-save"></span></button>
<hr>
</div>

<div class="col-md-5 " style="background-color:#eee; margin:1%; padding: 1%;  ">
<h3 align="center">  <span class="fa fa-money fa_color fa-2x"></span><br>  Data akun Bank</h3><hr>
<label>Nama pemilik rekening :</label>
<input type="text" class="form-control" <?php if($akun['nomor_rekening']){ echo"readonly=''";}  ?> value="<?php echo $akun['nama_pemilik_rekening'] ?>" id="nama_pemilik_rekening" placeholder="Pemilik rekening . . ">

<label>Nomor rekening :</label>
<input type="text" class="form-control" <?php if($akun['nomor_rekening']){ echo"readonly=''";}  ?> value="<?php echo $akun['nomor_rekening'] ?>" id="nomor_rekening" placeholder="Nomor rekening . . . " >

<label>Nama bank :</label>
<input type="text" class="form-control" <?php if($akun['nomor_rekening']){ echo"readonly=''";}  ?> value="<?php echo $akun['nama_bank'] ?>" id="nama_bank" placeholder="Nama Bank . . . ">
<hr>
<?php if($akun['nomor_rekening'] !=''){ ?>
<button class="form-control btn btn-warning" id="btn_edit_rekening">Edit <span class="fa fa-edit"></span></button>
<button class="form-control btn btn-success" style="display:none;" id="btn_rekening">Simpan <span class="fa fa-save"></span></button>
<?php }else{ ?>
<button class="form-control btn btn-success" id="btn_rekening">Simpan <span class="fa fa-save"></span></button>
<?php } ?>
<hr>
</div> 
</div>   


</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_edit").click(function(){
$("#nama_lengkap").attr("readonly", false);
$("#nomor_kontak").attr("readonly", false);
$("#alamat_lengkap").attr("readonly", false);
$("#nama_pena").attr("readonly", false);

$("#btn_edit").hide(); 
$("#btn_update").show(); 
});  

$("#btn_update").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   

var nama_lengkap  = $("#nama_lengkap").val();
var nama_pena     = $("#nama_pena").val();
var nomor_kontak  = $("#nomor_kontak").val();
var alamat_lengkap= $("#alamat_lengkap").val();
$.ajax({
type:"POST",
url:"<?php echo base_url('Halaman_penulis/update_penulis') ?>",
data:"token="+token+"&nama_pena="+nama_pena+"&nama_lengkap="+nama_lengkap+"&nomor_kontak="+nomor_kontak+"&alamat_lengkap="+alamat_lengkap,
success:function(data){
if(data == 'berhasil'){
swal({
title:"", 
text:"Update profile berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis') ?>';
});      

}

}
});
});

$("#btn_rekening").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var pemilik_rekening = $("#nama_pemilik_rekening").val(); 
var nomor_rekening   = $("#nomor_rekening").val();
var nama_bank        = $("#nama_bank").val();
if (pemilik_rekening != '' && nomor_rekening !='' && nama_bank !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('Halaman_penulis/simpan_rekening') ?>",
data:"token="+token+"&pemilik_rekening="+pemilik_rekening+"&nomor_rekening="+nomor_rekening+"&nama_bank="+nama_bank,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Rekening berhasil tersimpan",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis') ?>';
});     

}else{
swal({
title:"", 
text:"Server error",
type:"error",
showConfirmButton: true,
});   

} 

}   


});




}else{
swal({
title:"", 
text:"Data rekening harus di isi semua",
type:"error",
showConfirmButton: true,
});    

}



});

$("#btn_edit_rekening").click(function(){
$("#nama_pemilik_rekening").attr("readonly", false);
$("#nomor_rekening").attr("readonly", false);
$("#nama_bank").attr("readonly", false);

$("#btn_edit_rekening").hide();
$("#btn_rekening").show();

});

});
</script>    
</body>
