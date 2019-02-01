
<body class="bg_dashboard">
<div class="container" >    
<div class="row mt-3 " style="color:#555; ">
<div class="col card mb-3">

<h3 align="center" class="mt-2">Cara Menjadi Penulis Guepedia</h3><hr>    
<div class="row">
<div class="col-sm-4" id="spy">
<div id="list-example" class="list-group">
<a class="list-group-item list-group-item-action" href="#scroll1" style="font-size:12px;"> Cara Jadi Penulis</a>
<a class="list-group-item list-group-item-action" href="#scroll2" style="font-size:12px;">Cara Masuk Ke Halaman Penulis</a>
<a class="list-group-item list-group-item-action" href="#scroll3" style="font-size:12px;">Cara Upload Naskah</a>
<a class="list-group-item list-group-item-action" href="#scroll4" style="font-size:12px;">Cara Mengambil Bagi hasil</a>
<a class="list-group-item list-group-item-action" href="#scroll5" style="font-size:12px;">Cara Lihat Laporan penjualan</a>
</div>    
</div>
<div class="col scrollspy-example" data-spy="scroll" data-target="#spy">
<div id="scroll1">
<h2>Cara Jadi Penulis</h2>
<ol>
<li>Buka Halaman <a href="<?php echo base_url('/Penulis') ?>"><?php echo base_url('/Penulis') ?></a> Maka Akan Tampil Seperti Gambar di bawah ini</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/1.png') ?>"><br> Setelah itu Klik Belum Punnya Akun Maka Form untuk mendaftaran akan muncul Seperti Gambar dibawah ini.</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/2.png') ?>"><br>Lalu Isi Semua Form Itu dan jangan sampai ada yang kosong lalu klik button Daftar  Dan horee anda telah memiliki akun penulis.</li>
<li><i>Note</i> Pastikan anda telah mendapatkan link konfirmasi akun lewat email yang telah daftarkan.</li>
</ol>

</div>
<div id="scroll2">
<h2>Masuk Ke Halaman Penulis</h2>
<ol>
<li>Buka Halaman <a href="<?php echo base_url('/Penulis') ?>"><?php echo base_url('/Penulis') ?></a> Maka Akan Tampil Seperti Gambar di bawah ini</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/3.png') ?>"><br>Isikan Email dan password yang telah dibuat dan pastikan email tersebut telah di konfirmasi via emai yang di daftarkan.setelah itu klik Button Masuk.</li>
</ol>
</div>
<div id="scroll3">
<h2>Upload Naskah</h2>
<ol>
<li>Untuk dapat mengupload naskah pastikan anda telah mendaftar menjadi Penulis dan dapat masuk ke halaman dashboard .</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/4.png') ?>"><br>Setelah anda berhasil masuk lalu klik gambar upload naskah maka akan tampil form untuk mengupload naskah.</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/5.png') ?>"><br>Lalu isikan seluruh form dan menyetujui syarat dan ketentuan yang telah di buat guepedia.</li>
<li><i>Note:</i> Untuk file cover jika tidak tersedia maka  dapat di kosongkan, dan jika ada maka hannya dalam format .PSD</li>
<li><i>Note:</i> Untuk file Naskah Hannya dalam bentuk .docs / Microsof tword</li>
</ol>
</div>

    
<div id="scroll4">
<h2>Cara Mengambil Bagi Hasil</h2>
<ol>
<li>Untuk melaukan penarikan bagi hasil hal yang pertama harus dilakukan adalah mengisi seluruh data rekening yang anda miliki seperti gambar dibawah ini.</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/panduan/21.png') ?>"><br>Jika sudah berhasil mengisi seluruh data rekening anda lalu klik menu seperti gambar dibawah ini.</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/panduan/19.png') ?>"><br>Maka akan tampil halaman seperti gambar dibawah ini.</li>
<li><img style="width:100%" src="<?php echo base_url('assets/img/panduan/20.png') ?>"><br>Lalu isikan jumlah penarikan sampai sesuai dengan jumlah saldo bagi hasil lalu klik tombol ajukan bagi hasil.</li>
</ol>
</div>

<div id="scroll5">
<h2>Cara Lihat Laporan Penjualan</h2>
<ol>
<li>Untuk dapat melihat laporan penjualan silahkan klik gambar seperti dibawah ini.</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/panduan/23.png') ?>"><br>Maka akan tampil halaman laporan penjualan seperti dibawah ini.</li>
<li><img style="width:100%;" src="<?php echo base_url('assets/img/panduan/24.png') ?>"><br>Halaman ini adalah bentuk laporan dalam bentuk grafik</li>
<li><img style="width:100%" src="<?php echo base_url('assets/img/panduan/25.png') ?>"><br>Halaman ini adalah untuk melihat invoices yang berisi tentang penjual dan pembeli.</li>
</ol>
</div>     
    
</div>
</div>
<style>
.scrollspy-example {
position: relative;
height: 550px;
overflow: auto;
}
</style>
</div>
    
<div class="col-md-4" id="login">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-sign-in fa-2x float-right"></span></h1>
<h2>Masuk </h2>
<h5 style="font-size:15px;">Masukan Email dan Password anda untuk masuk ke akun penulis </h5>
</div>
<div style="background-color:#eee; padding:5%; ">    
<label>Email :</label>
<input type="text" class="form-control" value="" id="email_login" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Email yang didaftarkan">
<label>Password :</label>
<input type="password" class="form-control" value="" id="password_login" placeholder="Masukan Password . . ." data-toggle="tooltip" title="Password yang di buat">
<hr>
<button class="btn btn-success  form-control" id="btn_login" >Masuk <span class="fa fa-sign-in"></span></button>

<hr>
<div class="row">
<div class="col"><a href="#" style="text-decoration: none; font-size:15px;" id="lupa_password" >Lupa Kata Sandi ?</a></div>    
<div class="col"><a href="#" style="text-decoration: none; font-size:15px; " id="belum_punnya" class="float-right" >Belum Punya Akun ?</a>
</div>
</div>
<hr>
<div class="clearfix"></div><br>
</div>
</div>

<div class="col-md-4" style=" display: none; " id="daftar">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-pencil fa-2x  float-right"></span></h1>
<h2>Daftar</h2>
<h5 style="font-size:15px;">Isikan form di bawah ini untuk bergabung menjadi penulis :</h5>
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
<button class="btn btn-success  form-control" id="btn_daftar">Daftar <span class="fa fa-pencil"></span></button>
<hr>
<a href="#" style="text-decoration: none; text-align: center; font-size:15px;" id="sudah_punnya" >Sudah punya akun ?</a>

<div class="clearfix"></div><br>
</div>
</div>


<div class="col-md-4" style=" display: none;" id="reset">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-exchange fa-2x float-right"></span></h1>
<h2>Reset Password</h2>
<h5 style="font-size:15px;">Masukan Email anda </h5>
</div>
<div style="background-color:#eee; padding:5%; ">    
<label>Email :</label>
<input type="text" class="form-control" value="" id="email_reset" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Email yang didaftarkan">

<hr>
<button class="btn btn-success float-right" id="btn_reset" >Reset <span class="fa fa-exchange"></span></button>
<div class="clearfix"></div><br>
</div>
</div>

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
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
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
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

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
title:"Akun Anda Belum Aktif", 
text:"Mohon maaf akun anda belum aktif silahkan aktivasi terlebih dahulu melalui email yang anda daftarkan atau perbaharui password anda dengan cara klik lupa kata sandi",
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
text:"Email atau password yang anda masukan salah",
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
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
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