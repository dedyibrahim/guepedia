<body class="bg_login_penulis">

    
<div class="offset-7 col-md-4" style="margin-top:3%; margin-bottom:3% ; display: none; " id="daftar">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-pencil fa-2x  float-right"></span></h1>
<h2>Sign Up</h2>
<h5>Isikan form di bawah ini untuk bergabung menjadi penulis :</h5>
</div>
<div style="background-color:#eee; padding:5%; ">    
<label>Nama Lengkap :</label>
<input type="text" class="form-control" id="nama_lengkap" value="" placeholder="Nama Lengkap . . . " data-toggle="tooltip" title="Harus sesuai dengan Nama Asli sesuai dengan KTP atau AKTE">
<label>Nama Pena :</label>
<input type="text" class="form-control" id="nama_pena" value="" placeholder="Nama Pena . . . " data-toggle="tooltip" title="Untuk Identitas Penulis">
<label>Nomor Kontak :</label>
<input type="text" class="form-control" id="nomor_kontak" value="" placeholder="Nomor Kontak . . ." data-toggle="tooltip" title="Pastikan Nomor kontak yang dimasukan masih aktif">
<label>Alamat lengkap :</label>
<textarea class="form-control" id="alamat_lengkap" value="" placeholder="Alamat lengkap . . ." data-toggle="tooltip" title="Alamat lengkap yang di masukan mencakupi Provinsi,Kota,Kec,Kel,Nama JL/Desa,RT,RW "></textarea>
<label>Email :</label>
<input type="text" class="form-control" id="email_daftar" value="" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Pastikan email yang dimasukan masih aktif karena untuk proses aktivasi akun">
<label>Password :</label>
<input type="password" class="form-control" id="password_daftar" value="" placeholder="Masukan Password . . ." data-toggle="tooltip" title="Catet dengan baik password yang anda buat">
<label>Ulangi Password :</label>
<input type="password" class="form-control" id="password_daftar1" value="" placeholder="Masukan ulang Password . . ." data-toggle="tooltip" title="Masukan Ulang Password anda">
<hr>
<a href="#" id="sudah_punnya" >Sudah punya akun ?</a>
<button class="btn btn-success float-right" id="btn_daftar">Sign up <span class="fa fa-pencil"></span></button>
<div class="clearfix"></div><br>
</div>
</div> 


<div class="offset-7 col-md-4" style="margin-top:3%;" id="login">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-sign-in fa-2x float-right"></span></h1>
<h2>Sign in</h2>
<h5>Masukan Email dan Password anda  </h5>
</div>
<div style="background-color:#eee; padding:5%; ">    
<label>Email :</label>
<input type="text" class="form-control" value="" id="email_login" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Email yang didaftarkan">
<label>Password :</label>
<input type="password" class="form-control" value="" id="password_login" placeholder="Masukan Password . . ." data-toggle="tooltip" title="Password yang di buat">
<br><p align="center"><a href="#" id="belum_punnya" >Belum Punya akun ?</a></p>

<hr>
<a href="#" id="lupa_password" >Lupa Password ?</a>
<button class="btn btn-success float-right" id="btn_login" >Sign in <span class="fa fa-sign-in"></span></button>
<div class="clearfix"></div><br>
</div>
</div>

    
<div class="offset-7 col-md-4" style="margin-top:3%; display: none;" id="reset">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-exchange fa-2x float-right"></span></h1>
<h2>Reset Password</h2>
<h5>Masukan Email anda </h5>
</div>
<div style="background-color:#eee; padding:5%; ">    
<label>Email :</label>
<input type="text" class="form-control" value="" id="email_reset" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Email yang didaftarkan">

<hr>
<button class="btn btn-success float-right" id="btn_reset" >Reset <span class="fa fa-exchange"></span></button>
<div class="clearfix"></div><br>
</div>
</div>
    
<script type="text/javascript">
$("#lupa_password").click(function(){
$("#login").fadeOut(300);
$("#reset").fadeIn(300);  
});

    
$(document).ready(function(){
$("#belum_punnya").click(function(){
$("#daftar").fadeIn(300);
$("#login").fadeOut(300);  
});

$("#sudah_punnya").click(function(){
$("#daftar").fadeOut(300);
$("#login").fadeIn(300);  
});

$("#btn_daftar").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var nama_pena         = $("#nama_pena").val(); 
var nama_lengkap      = $("#nama_lengkap").val(); 
var nomor_kontak      = $("#nomor_kontak").val();
var alamat_lengkap    = $("#alamat_lengkap").val();
var email_daftar      = $("#email_daftar").val();
var password_daftar   = $("#password_daftar").val();
var password_daftar1  = $("#password_daftar1").val();


if(nama_pena !='' && nama_lengkap != '' && nomor_kontak != '' && alamat_lengkap != '' && email_daftar != '' && password_daftar != '' && password_daftar1 != ''){

if (password_daftar != password_daftar1 ){
swal({
title:"", 
text:"Password yang dimasukan tidak sesuai",
showConfirmButton: true,
type:"error",
});
}else {
$.ajax({
type :"POST",
url  :"<?php echo base_url('Penulis/daftar') ?>",
data :"token="+token+"&nama_pena="+nama_pena+"&nama_lengkap="+nama_lengkap+"&nomor_kontak="+nomor_kontak+"&alamat_lengkap="+alamat_lengkap+"&email="+email_daftar+"&password="+password_daftar,
success:function(data){
if(data == "berhasil"){
swal({
title:"Pendaftaran berhasil", 
text:"Pendaftaran berhasil silahkan aktivasi akun anda melalui email yang anda masukan",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});  

}else if (data == 'sudah_digunakan'){
swal({
title:"", 
text:"Email Sudah dipakai silahkan gunakan email lainnya atau klik lupa password ",
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});    
}else{
swal({
title:"", 
text:"Pendaftaran gagal",
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});    
}


}        

});    


}
}else{
swal({
title:"", 
text:"Masih terdapat data yang perlu di isi",
type:"error",
showConfirmButton: true,
});
}

});


$("#btn_login").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   

var email_login    = $("#email_login").val();
var password_login = $("#password_login").val();

if(email_login !='' && password_login !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('Penulis/login') ?>",
data:"token="+token+"&email="+email_login+"&password="+password_login,
success:function(data){
if(data == 'tidak'){
    
swal({
title:"Sedang dalam perbaikan", 
text:"Mohon maaf kami sedang melakukan perbaikan system agar dapat masuk silahkan perbaharui password anda terlebih dahulu dengan cara klik lupa kata sandi",
type:"warning",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});    
    
}else if(data == "berhasil"){
swal({
title:"", 
text:"Login berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis') ?>';
});    
    
}else if(data == "akun_gaada"){
swal({
title:"", 
text:"Akun tidak tersedia silahkan daftar terlebih dahulu",
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});    
    
}    
}
    
    
});

    
}else{
swal({
title:"", 
text:"Harap isi email dan password anda",
type:"error",
showConfirmButton: true,
});    
    
}


});




});

$("#btn_reset").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var email_reset = $("#email_reset").val();

if(email_reset !=''){

$.ajax({
type:"POST",
url :"<?php echo base_url('Penulis/reset_password') ?>",
data:"token="+token+"&email_reset="+email_reset,
success:function(data){
if(data == "berhasil"){
    
swal({
title:"", 
text:"Link reset password telah dikirimkan ke alamat email "+email_reset,
icon:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});     
        
    
}else if(data == "gaada"){

swal({
title:"", 
text:"Email yang anda masukan tidak tersedia silahkan daftar terlebih dahulu",
icon:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});     
    
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
text:"Email masih kosong",
icon:"error",
showConfirmButton: true,
});

}

});

</script>


</body>