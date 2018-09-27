<div class="container" style="background-color: #fff; margin-top: 6.5%; margin-bottom:1%; ">
<h4 align="center"><span class="fa fa-exchange fa-3x fa-color"></span><br>Masukan Password Baru</h4><hr> 
<div class="offset-3 col-md-6">
<label>Password baru :</label>
<input type="password" id="password_baru" placeholder="Password baru . . ." class="form-control">    

<label>Ulangi Password:</label>
<input type="password" id="password_baru1" placeholder="Ulangi Password . . ." class="form-control">    

<hr>
 <a  style="text-decoration:none; " href="<?php echo base_url('Store/login_akun') ?>">Sudah punya akun ?</a>
 <hr>
<button class="btn btn-success form-control" onclick="login_akun();"> Reset <span class="fa fa-exchange"></span></button>
</div>
</div>

<script type="text/javascript">
function login_akun(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var password      = $("#password_baru").val();
var password1     = $("#password_baru1").val();
var e             = "<?php echo $this->uri->segment(3) ?>"; 

if( password !='' && password1 !='' ) {

if(password  == password1){
$.ajax({
type:"POST",
url:"<?php echo base_url('Store/set_password_baru') ?>",
data:"token="+token+"&e="+e+"&password="+password,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Email Berhasil di reset silahkan anda login",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('Store/login_akun') ?>";
});

}else{

swal({
title:"", 
text:"Email yang di masukan salah",
type:"error",
showConfirmButton: true,
});    

}    
}    
});

}else{
swal({
title:"", 
text:"Password yang dimasukan tidak sesuai",
type:"error",
showConfirmButton: true,
});
}

}else{

swal({
type: 'question',
html: 'password Belum di isi',
showConfirmButton: false,
animation: false,
customClass: 'animated bounceInDown',
timer: 2000,
});    

}

}
</script>