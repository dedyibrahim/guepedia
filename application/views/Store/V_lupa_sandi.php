<div class="container batas_header">
<div class="row ">
<div class="col mt-3 d-none d-sm-block d-md-block">
<img src="<?php echo base_url('assets/img/pg_reset.png') ?>">  

</div>       

<div class="col-md-4 mt-3  mb-3">
<div class="card ">
<div class="card-header">
<h4 align="center"><span class="fa fa-exchange fa-3x fa-color"></span><br>Reset Akun</h4>
</div>
<div class="card-body">
<label>Email :</label>
<input type="text" id="email" placeholder="Email . . ." class="form-control">    

</div>
<div class="card-footer text-muted">
<button class="btn btn-success form-control" onclick="login_akun();"> Reset <span class="fa fa-exchange"></span></button>
<p>Sudah Punya Akun Guepedia ? <a style="text-decoration: none; color: #28a745;" href="<?php echo base_url('Store/login_akun') ?>">Login</a></p>
</div>
</div>


</div>
</div>
</div>   

<script type="text/javascript">
function login_akun(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var email     = $("#email").val();


if(email !='' ){


$.ajax({
type:"POST",
url:"<?php echo base_url('Store/reset_password') ?>",
data:"token="+token+"&email="+email,
success:function(data){
if(data == "berhasil"){
    
swal({
title:"", 
text:"Silahkan periksa email anda untuk melakukan reset password",
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