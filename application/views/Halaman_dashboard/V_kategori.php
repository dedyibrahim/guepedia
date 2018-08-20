<div class="container" style="margin-top:1%; margin-bottom:1%; ">
<div class="row">
<div class="col" style="background-color:#eee; ">
<br><h3 align="center">Buat Kategori <span class="fa fa-list-alt"></span></h3>
<hr>
<div class="form-group">
<label>Buat Kategori :</label>    
<input type="text" class="form-control" id="nama_kategori" placeholder="Nama kategori . . "><br>
<button class="fa fa-save btn btn-success float-right" id="btn_kategori"> Simpan</button>
<div class="clearfix"></div><hr>  
</div>

</div>
<div class="col-md-7" style="background-color:#eee; margin-left:1%;  ">
<h1>HALO</h1>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_kategori").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";       
var nama_kategori = $("#nama_kategori").val();

if(nama_kategori !=''){
$.ajax({
    
type:"POST",
url:"<?php echo base_url('G_dashboard/simpan_kategori') ?>",
data:"token="+token+"&nama_kategori="+nama_kategori,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Kategori berhasil di buat",
icon:"success",
timer:1500,
button:false,
}).then(function() {
location.href = '<?php echo base_url('G_dashboard') ?>';
});     
    
}    
    
}

    
});
}else{    
alert("Kategori belumm di buat");    
}
    
});    
});

</script>