<div class="container" style="background-color: #fff; margin-top: 6.5%; margin-bottom:1%; ">
<h4 align="center"><span class="fa fa-pencil-square-o fa-3x fa-color"></span><br>Daftar akun</h4><hr> 
<div class="offset-3 col-md-6">
    <label>Nama Lengkap :</label>
    <input type="text" id="nama_lengkap" placeholder="Nama lengkap . . ." class="form-control">    
    <label>Email :</label>
    <input type="text" id="email_daftar" placeholder="Email . . ." class="form-control">    
    <label>Password :</label>
    <input type="password" id="password_daftar" placeholder="Password . . ." class="form-control">    
    <label>Ulangi Password :</label>
    <input type="password"  id="password_daftar1" placeholder="Ulangi Password . . ." class="form-control"> 
    <hr>
    <button class="btn btn-success form-control" id="btn_daftar">Daftar <span class="fa fa-save"></span></button>
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_daftar").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var nama_lengkap      = $("#nama_lengkap").val(); 
var email_daftar      = $("#email_daftar").val();
var password_daftar   = $("#password_daftar").val();
var password_daftar1  = $("#password_daftar1").val();
if( nama_lengkap != '' && email_daftar != '' && password_daftar != '' && password_daftar1 != ''){
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
data :"token="+token+"&nama_lengkap="+nama_lengkap+"&email="+email_daftar+"&password="+password_daftar,
success:function(data){
if(data == "berhasil"){
swal({
title:"Pendaftaran berhasil", 
text:"Pendaftaran berhasil silahkan aktivasi akun anda melalui email yang anda masukan",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store') ?>';
});  
}else if (data == 'sudah_digunakan'){
swal({
title:"", 
text:"Email Sudah dipakai silahkan gunakan email lainnya atau klik lupa password ",
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
    
});
</script>   