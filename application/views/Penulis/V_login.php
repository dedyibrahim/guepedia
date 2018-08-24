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
<hr>
<a href="#" id="belum_punnya" >Belum Punya akun ?</a>
<button class="btn btn-success float-right" id="btn_login" >Sign in <span class="fa fa-sign-in"></span></button>
<div class="clearfix"></div><br>
</div>
</div>


<script type="text/javascript">
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
var nama_lengkap      = $("#nama_lengkap").val(); 
var nomor_kontak      = $("#nomor_kontak").val();
var alamat_lengkap    = $("#alamat_lengkap").val();
var email_daftar      = $("#email_daftar").val();
var password_daftar   = $("#password_daftar").val();
var password_daftar1  = $("#password_daftar1").val();


if(nama_lengkap != '' && nomor_kontak != '' && alamat_lengkap != '' && email_daftar != '' && password_daftar != '' && password_daftar1 != ''){

if (password_daftar != password_daftar1 ){
swal({
title:"", 
text:"Password yang dimasukan tidak sesuai",
timer:1500,
icon:"error",
button:false,
});
}else {
$.ajax({
type:"POST",
url :"<?php echo base_url('Penulis/daftar') ?>",
data:"token="+token+"&nama_lengkap="+nama_lengkap+"&nomor_kontak="+nomor_kontak+"&alamat_lengkap="+alamat_lengkap+"&email="+email_daftar+"&password="+password_daftar,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Pendaftaran berhasil silahkan login",
icon:"success",
timer:1500,
button:false,
}).then(function() {
location.href = '<?php echo base_url('Penulis') ?>';
});  

}else if (data == 'sudah_digunakan'){
swal({
title:"", 
text:"Email Sudah dipakai silahkan gunakan email lainnya atau klik lupa password ",
timer:3500,
icon:"error",
button:false,
}).then(function() {
location.href = '<?php echo base_url('Penulis') ?>';
});    
}else{
swal({
title:"", 
text:"Pendaftaran gagal",
timer:2500,
icon:"error",
button:false,
}).then(function() {
location.href = '<?php echo base_url('Penulis') ?>';
});    
}


}        

});    


}
}else{
swal({
title:"", 
text:"Masih terdapat data yang perlu di isi",
timer:1500,
icon:"error",
button:false,
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
if(data == "berhasil"){
swal({
title:"", 
text:"Login berhasil",
timer:1500,
icon:"success",
button:false,
}).then(function() {
location.href = '<?php echo base_url('Halaman_penulis') ?>';
});    
    
}else if(data == "akun_gaada"){
swal({
title:"", 
text:"Akun tidak tersedia silahkan daftar terlebih dahulu",
icon:"error",
button:false,
}).then(function() {
location.href = '<?php echo base_url('Penulis') ?>';
});    
    
}    
}
    
    
});

    
}else{
swal({
title:"", 
text:"Harap isi email dan password anda",
timer:1500,
icon:"error",
button:false,
});    
    
}


});




});

</script>


</body>