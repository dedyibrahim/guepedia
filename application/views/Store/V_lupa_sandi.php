<div class="container" style="background-color: #fff; margin-top: 6.5%; margin-bottom:1%; ">
<h4 align="center"><span class="fa fa-exchange fa-3x fa-color"></span><br>Reset Password</h4><hr> 
<div class="offset-3 col-md-6">
<label>Email :</label>
<input type="text" id="email" placeholder="Email . . ." class="form-control">    
<hr>
   <a  style="text-decoration:none; " href="<?php echo base_url('Store/login_akun') ?>">Sudah punya akun ?</a>
 <hr>
<button class="btn btn-success form-control" onclick="login_akun();"> Reset <span class="fa fa-exchange"></span></button>
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