<div class="container batas_header">
<div class="row ">
<div class="col mt-3 d-none d-sm-block d-md-block">
<img src="<?php echo base_url('assets/img/pg_daftar.png') ?>">  

</div>       

<div class="col-md-4 mt-3  mb-3">
<div class="card ">
<div class="card-header">
<h4 align="center"><span class="fa fa-sign-in fa-3x fa-color"></span><br>Daftar Akun</h4>
</div>
<div class="card-body">

<label>Email :</label>
<input type="text" id="email_daftar" placeholder="Email . . ." class="form-control">    
<label>Password :</label>
<input type="password" id="password_daftar" placeholder="Password . . ." class="form-control">    
<label>Ulangi Password :</label>
<input type="password" id="password_daftar1" placeholder="Ulangi Password . . ." class="form-control">    

</div>
<div class="card-footer text-muted">
<button class="btn btn-success form-control" id="btn_daftar"> Daftar <span class="fa fa-save"></span></button>
<p>Sudah Punya Akun Guepedia ? <a style="text-decoration: none; color: #28a745;" href="<?php echo base_url('Store/login_akun') ?>">Login</a></p>
</div>
</div>


</div>
</div>
</div>   


<script type="text/javascript">
$(document).ready(function(){
$("#btn_daftar").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   

var email_daftar      = $("#email_daftar").val();
var password_daftar   = $("#password_daftar").val();
var password_daftar1  = $("#password_daftar1").val();
if(email_daftar != '' && password_daftar != '' && password_daftar1 != ''){
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
url  :"<?php echo base_url('Store/daftar') ?>",
data :"token="+token+"&email="+email_daftar+"&password="+password_daftar,
success:function(data){
if(data == "berhasil"){
swal({
title:"Pendaftaran berhasil", 
text:"Pendaftaran berhasil silahkan aktivasi akun anda melalui email yang anda masukan",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store/login_akun') ?>';
});  
}else if (data == 'sudah_digunakan'){
swal({
title:"", 
text:"Email Sudah dipakai silahkan gunakan email lainnya atau klik lupa kata sandi",
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store/login_akun') ?>';
});    
}else{
swal({
title:"", 
text:"Pendaftaran gagal",
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store/daftar_akun') ?>';
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

});
</script>   