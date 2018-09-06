<body class="bg_login_penulis">


<div class="offset-7 col-md-4" style="margin-top:3%;" id="login">
<div style="background-color:#fff; padding:5%; border:1px solid #eee; color:#555;  ">
<h1><span class="fa fa-exchange fa-2x float-right"></span></h1>
<h2>Reset Password</h2>
<h5>Masukan Password Baru anda  </h5>
</div>
<div style="background-color:#eee; padding:5%; ">    

<label>Password :</label>
<input type="password" class="form-control" value="" id="password" placeholder="Masukan Password . . ." data-toggle="tooltip" title="Password Baru">

<label>Ulangi Password :</label>
<input type="password" class="form-control" value="" id="password1" placeholder="Masukan ulang Password. . ." data-toggle="tooltip" title="Masukan ulang">
<hr>

<button class="btn btn-success float-right" id="btn_reset" >Reser <span class="fa fa-exchange"></span></button>
<div class="clearfix"></div><br>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
$("#btn_reset").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var password  = $("#password").val();
var password1 = $("#password1").val();
var e     = "<?php echo $this->uri->segment(3) ?>";

if(password !='' && password1 !=''){

if(password1 == password){

$.ajax({
type:"POST",
url :"<?php echo base_url('Penulis/password_baru') ?>",
data:"token="+token+"&password="+password+"&e="+e,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Email berhasil di reset silahkan login",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Penulis') ?>';
});  

}else{

swal({
title:"", 
text:data,
timer:3000,
type:"error",
showConfirmButton: true,
});  

}


}
});



}else{

swal({
title:"", 
text:"Password yang di masukan tidak sama",
type:"error",
showConfirmButton: true,
});    

}



}else{

swal({
title:"", 
text:"Masih ada inputan yang kosong",
timer:3000,
type:"error",
showConfirmButton: true,
});   

}

});


});
</script>



</body>