

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Masukan Kode kupon Atau Promo</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active show" href="#tab_promo" role="tab" data-toggle="tab" aria-selected="true">Kode Promo</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#tab_kupon" role="tab" data-toggle="tab">Kode Kupon</a>
</li>
</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade active show" id="tab_promo" >
<hr>
<label>Kode promo </label>
<input type="text" class="form-control" id="promo" value="" placeholder="Kode promo . . . " ><hr>
<button type="button" class="btn btn-primary" id="tambah_promo">Tambahkan promo <span class="fa fa-plus"></span></button>

</div>
<div role="tabpanel" class="tab-pane fade" id="tab_kupon">
 <hr>   
<label>Kode kupon </label>
<input type="text" class="form-control" id="kode_kupon" value="" placeholder="Kode kupon . . . " ><hr>
<button type="button" class="btn btn-primary" id="tambah_kupon">Tambahkan kupon <span class="fa fa-plus"></span></button>

    
</div>
</div>
</div>
</div>
</div>
</div>

<body onload="keranjang_total()" ></body>
<div class="container batas_header p-3" style="background-color: #fff; ">
<h4 align="center"><span class="fa fa-shopping-basket fa-3x fa-color"></span><br>Keranjang Belanja Anda</h4><hr> 
<div id="keranjang_total"></div>  
</div>


<script type="text/javascript">
function update_qty_keranjang(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
var qty = $("#qty"+id).val(); 
$.ajax({
type:"POST",
url:"<?php echo base_url('Store/update_qty_keranjang') ?>",
data:"token="+token+"&id="+id+"&qty="+qty,    
success:function(data){
keranjang_total();    
}
});
}
function keranjang_total(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/keranjang_total') ?>",
data:"token="+token,    
success:function(data){
$("#keranjang_total").html(data);    
}
});

}

function hapus_cart(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/hapus_cart') ?>",
data:"token="+token+"&id="+id,    
success:function(){
keranjang_total();    

}
});
}


$(document).ready(function(){
$("#tambah_kupon").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var kupon = $("#kode_kupon").val();
if (kupon !=''){
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/set_kupon') ?>",
data:"token="+token+"&kupon="+kupon,
success:function(data){
if(data == "berhasil") {   
keranjang_total();
$("#kode_kupon").val("");
swal({
title:"", 
text:"Kode kupon berhasil ditambahkan",
type:"success",
showConfirmButton: true
});

}else if(data == "tidak_lolos"){ 
swal({
title:"", 
text:"Syarat atau Ketentuan tidak terpenuhi",
type:"error",
showConfirmButton: true
});   
}else if(data == "login"){

 swal({
type: 'warning',
html:"Untuk menggunakan kode kupon harus login terlebih dahulu" ,
showConfirmButton: true,
animation: false,
customClass: 'animated bounceInDown',
}).then(function() {
window.location.href = "<?php echo base_url('Store/login_akun') ?>";
});
        
}else {
swal({
title:"", 
text:"Maaf kupon tidak tersedia",
type:"error",
showConfirmButton: true,
});    
}

}
});
}else{
swal({
title:"", 
text:"Kupon harus di isi",
type:"question",
showConfirmButton: true,
});   
}

});

$("#tambah_promo").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var promo = $("#promo").val();
if (promo !=''){
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/set_promo') ?>",
data:"token="+token+"&promo="+promo,
success:function(data){
if(data == "berhasil") {   
keranjang_total();
$("#promo").val("");
swal({
title:"", 
text:"Kode Promo berhasil ditambahkan",
type:"success",
showConfirmButton: true,
});

} else {
swal({
title:"", 
text:"Maaf kupon tidak tersedia",
type:"error",
showConfirmButton: true,
});    
}

}
});
}else{
swal({
title:"", 
text:"Kupon harus di isi",
type:"question",
showConfirmButton: true,
});   
}

});



});


</script>
