<nav class="navbar navbar-expand-lg  navbar-light fixed-top" style="background-color:#eee; border-bottom:4px solid #a8cf45;" >
<a class="navbar-brand" href="#"><img src="<?php echo base_url() ?>assets/img/logo-toko.png" alt=""/></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ">
<li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>">Home <span class="fa fa-home"></span></a>
</li>
<li class="nav-item active">
<a class="nav-link" href="<?php echo base_url('penulis') ?>">Penulis <span class="fa fa-pencil"></span></a>
</li>
<li class="nav-item active">
<a class="nav-link" href="<?php echo base_url('Store/konfirmasi_pembayaran') ?>">Konfirmasi pembayaran <span class="fa fa-money"></span></a>
</li>
<style>
.dropdown-menu{
min-width: 45rem;
}    

</style>
<li class="nav-item dropdown active">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Kategori Buku
</a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

<div class="row">
<?php $kategori= $this->db->get('kategori_naskah'); foreach($kategori->result_array() as $kate){ ?>    
    <a class=" col-sm-4" href="<?php echo base_url('Store/kategori/'. base64_encode($kate['id_kategori_naskah'])) ?>"><div class="dropdown-item"> <span class="fa fa-book"></span> <?php echo $kate['nama_kategori'] ?> </div></a>
    
        <?php } ?>
</div>

</div>
</ul>
</li>
</ul>
<form class="form-inline my-1 my-lg-0 col">
    <input class="form-search mr-md-6 col-md-12" value="" id="cari" type="search" placeholder="Cari Buku . . " aria-label="Cari Buku">
</form>
<a data-container="body" data-html="true" data-toggle="popover" data-placement="bottom" 
data-content="
<label>Email : </label>
<input type='text' class='form-control' placeholder='Email . . .'>
<label>Password : </label>
<input type='password' class='form-control' placeholder='Password . . .'>
<hr>
<button class='btn btn-success col'>Login <span class='fa fa-sign-in'></span></button>
" href="#">    

<span class="fa fa-user fa-color fa-3x"></span></a>    


<a data-container="body" data-html="true" data-toggle="popover" data-placement="bottom" 
data-content="
<label>Email : </label>
<input type='text' class='form-control' placeholder='Email . . .'>
<label>Password : </label>
<input type='password' class='form-control' placeholder='Password . . .'>
<hr>
<button class='btn btn-success col'>Login <span class='fa fa-sign-in'></span></button>
" href="#">    

<span class="fa fa-cart-plus fa-color fa-3x" style="margin-left:5px; "></span></a>    

</div>
</nav>
<script type="text/javascript">
$(document).ready(function(){

$("#cari").keyup(function(){
var kata_kunci = $("#cari").val();
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/cari_buku') ?>",
data:"kata_kunci="+kata_kunci+"&token="+token,
success:function(data){
if(data == 'tidak_ditemukan'){
swal({
title:"", 
text:"Pencarian tidak ditemukan",
timer:1500,
type:"error",
showCancelButton :false,
showConfirmButton :false
});
$("#cari").val("");
}else{
    
if (kata_kunci != ''){
$("#hasil_cari").show();
$("#hasil_cari").html(data);
$("#konten").hide();
}else{
$("#hasil_cari").hide();
$("#konten").show();

}
}    
}
});    
});
}); 
</script> 

<div class="container" id="hasil_cari" style="display:none; margin-top:7%; "></div>


<div id="konten">