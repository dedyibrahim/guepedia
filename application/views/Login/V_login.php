<body class="bg_dashboard">

<div class="offset-4 col-md-4" style="margin-top:3%;" id="login">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-sign-in fa-2x float-right"></span></h1>
<h2>Sign in</h2>
<h5>To Dashboard Page</h5>
</div>
<div style="background-color:#eee; padding:5%; ">    
<label>Email :</label>
<input type="text" class="form-control" value="" id="email_login" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Email yang didaftarkan">
<label>Password :</label>
<input type="password" class="form-control" value="" id="password_login" placeholder="Masukan Password . . ." data-toggle="tooltip" title="Password yang di buat">
<hr>
<button class="btn btn-success float-right" id="btn_login" >Sign in <span class="fa fa-sign-in"></span></button>
<div class="clearfix"></div><br>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_login").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
var email= $("#email_login").val();    
var password= $("#password_login").val();     
if (email == '' && password == ''){
 
swal({
title:"", 
text:"Email atau Password Masih Kosong",
type:"error",
showConfirmButton: true,
}); 
} else {    
$.ajax({
type:"POST",
url:"<?php echo base_url('G_login/login') ?>",
data:"token="+token+"&email="+email+"&password="+password,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Login berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('G_dashboard') ?>";
});

}else if(data == "gaada"){    

swal({
title:"", 
text:"Email dan password salah",
showConfirmButton: true,
type:"error",
button:false,
}).then(function() {
window.location.href = '<?php echo base_url('G_login') ?>';
});

}    

}
    
});
}    
});        
});

</script>   
</body>