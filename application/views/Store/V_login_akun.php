<div class="container batas_header">
    <div class="row ">
        <div class="col mt-3 d-none d-sm-block d-md-block">
            <img src="<?php echo base_url('assets/img/pg_login.png') ?>">  
           
        </div>       
<div class="col-md-4 mt-3  mb-3">
<div class="card ">
<div class="card-header">
<h4 align="center"><span class="fa fa-lock fa-3x fa-color"></span><br>Login akun</h4>
</div>
<div class="card-body">

<label>Email :</label>
<input type="text" id="email_login" placeholder="Email . . ." class="form-control">    
<label>Password :</label>
<input type="password" id="password_login" placeholder="Password . . ." class="form-control">    

<div class="row">
<div class="col text-right"><a  class="" style="text-decoration: none; color: #28a745;"href="<?php echo base_url('Store/lupa_sandi') ?>">Lupa Kata sandi ?</a>
</div>    

</div>
</div>
<div class="card-footer text-muted">
<button class="btn btn-success form-control" onclick="login_akun();"> Masuk <span class="fa fa-sign-in"></span></button>
<hr>
<a href="<?php echo $google_login_url ?>"<button class="btn btn-danger form-control"> Masuk dengan akun Google <span class="fa fa-google"></span></button></a>
<hr>
<p>Belum Punnya Akun Guepedia ? <a style="text-decoration: none; color: #28a745;" href="<?php echo base_url('Store/daftar_akun') ?>">Daftar</a></p>
</div>
</div>


</div>
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