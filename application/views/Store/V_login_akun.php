<div class="container" style="background-color: #fff; margin-top: 6.5%; margin-bottom:1%; ">
<h4 align="center"><span class="fa fa-lock fa-3x fa-color"></span><br>Login akun</h4>  
<div class="offset-3 col-md-6">
    Jika anda belum pernah bertransaksi  di <a style="text-decoration: none;" href="<?php echo base_url(); ?>"> guepedia.com </a> silahkan anda melakukan proses pendaftaran terlebih dahulu dengan cara  klik belum punya akun atau klik <a style="text-decoration: none;" href="<?php echo base_url('Store/daftar_akun') ?>">di sini</a><hr>    
<label>Email :</label>
<input type="text" id="email_login" placeholder="Email . . ." class="form-control">    
<label>Password :</label>
<input type="password" id="password_login" placeholder="Password . . ." class="form-control">    
<hr>
<a  class="float-right" style="text-decoration:none; " href="<?php echo base_url('Store/lupa_sandi') ?>">Lupa Kata sandi ?</a>
<a  style="text-decoration:none; " href="<?php echo base_url('Store/daftar_akun') ?>">Belum Punya akun ?</a>
<hr>
<button class="btn btn-success form-control" onclick="login_akun();"> Login <span class="fa fa-sign-in"></span></button>
</div>
</div>

<script type="text/javascript">
function login_akun(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var email     = $("#email_login").val();
var password  = $("#password_login").val();

if(email !='' && password !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/login') ?>",
data:"token="+token+"&email="+email+"&password="+password,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Login berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('Store/keranjang') ?>";
});

}else{

swal({
title:"", 
text:"Email dan password yang di masukan salah",
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('Store/login_akun') ?>";
});    

}    
}    
});

}else{

swal({
type: 'question',
html: 'Email dan password Belum di isi',
showConfirmButton: false,
animation: false,
customClass: 'animated bounceInDown',
timer: 2000,
});    

}

}
</script>    