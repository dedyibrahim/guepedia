<body  style="background: rgba(3,84,138,1);
background: -moz-linear-gradient(-45deg, rgba(3,84,138,1) 0%, rgba(145,232,66,1) 100%);
background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(3,84,138,1)), color-stop(100%, rgba(145,232,66,1)));
background: -webkit-linear-gradient(-45deg, rgba(3,84,138,1) 0%, rgba(145,232,66,1) 100%);
background: -o-linear-gradient(-45deg, rgba(3,84,138,1) 0%, rgba(145,232,66,1) 100%);
background: -ms-linear-gradient(-45deg, rgba(3,84,138,1) 0%, rgba(145,232,66,1) 100%);
background: linear-gradient(135deg, rgba(3,84,138,1) 0%, rgba(145,232,66,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#03548a', endColorstr='#91e842', GradientType=1 );">
<div class="row mt-5">
    <div class="col-md-3 mx-auto">   
    <div class="card m-3" >
        <div class="card-header" style="color: #2c3e50;">
    <h1><span class="fa fa-sign-in fa-2x float-right"></span></h1>
    <h1>login</h1>To Dashboard Page</div>
<div class="card-body p-2">
<label>Email :</label>
<input type="text" class="form-control" value="" id="email_login" placeholder="Masukan Email . . ." data-toggle="tooltip" title="Email yang didaftarkan">
<label>Password :</label>
<input type="password" class="form-control" value="" id="password_login" placeholder="Masukan Password . . ." data-toggle="tooltip" title="Password yang di buat">
</div>
<div class="card-footer">            
<button class="btn btn-success btn-block" id="btn_login" >Masuk <span class="fa fa-sign-in"></span></button>
</div>
</div>
    </div>    
</div>  
<script type="text/javascript">
$(document).ready(function(){
$("#btn_login").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";   
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