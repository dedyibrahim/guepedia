<nav class="navbar navbar-expand-lg  navbar-light fixed-top" style="background-color:#eee; border-bottom:4px solid #a8cf45;" >
    <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/img/logo-toko.png" alt=""/></a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    
  
<ul class="navbar-nav ">

<li class="nav-item dropdown active">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>    

<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="row">
<?php $kategori= $this->db->get('kategori_naskah'); foreach($kategori->result_array() as $kate){ ?>    
<a style="text-decoration: none;" class=" col-sm-4" href="<?php echo base_url('Store/kategori/'. base64_encode($kate['id_kategori_naskah'])) ?>"><div class="dropdown-item"> <span class="fa fa-book"></span> <?php echo $kate['nama_kategori'] ?> </div></a>
<?php } ?>
</div>
</div>
</ul>
<form class="form-inline my-1 my-lg-0 col" action="<?php echo base_url('Store/cari_buku') ?>" method="post" >
<div class="input-group col">

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash(); ?>">   
<input type="text"  required name="kata_kunci" class="form-control mr-md-6"  placeholder="Cari Buku . . " >
<div class="input-group-append">
<button class="btn btn-success btn-sm" type="submit" ><i class="fa fa-search"></i> Cari Buku </button>
</div>
</div>
</form>
        <hr> 
<div class="ml-1">
<button onclick="load_keranjang_header();" class="btn btn-success form-control" data-container="body" data-html="true" data-toggle="popover" data-placement="bottom" 
data-content="
<h5 align='center'>Shopping Cart</h5>
<hr>
<div id='keranjang_header'></div><hr>
<div class='row'>
<div class='col'><a style='text-decoration: none; ' href='<?php echo base_url('Store/keranjang') ?>'><button class='btn btn-success btn-sm'>Keranjang <span class='fa fa-shopping-basket'></span></button> &nbsp;</a></div>
<div class='col'><a style='text-decoration: none; ' href='<?php echo base_url('Store/checkout') ?>'><button class='btn btn-success btn-sm'> Bayar Buku <span class='fa fa-money'></span></button></a></div>
</div>
"class="btn btn-success form-control"><span class="fa fa-shopping-basket"></span></button>
</div>
<hr>    

 
<?php if($this->session->userdata('id_account_toko')){ ?>

<div class="ml-1">
<button class="btn btn-success form-control " data-container="body" data-html="true" data-toggle="popover" data-placement="bottom" 
data-content="
<hr>
<div style='font-size:18px;' class='text-center'><?php echo $this->session->userdata('nama_lengkap') ?></div>
<hr>
<a href='<?php echo base_url('Store/konfirmasi_pembayaran') ?>'><button class='btn btn-success btn-sm col form-control'>Konfirmasi Pembayaran <span class='fa fa-check'></span></button></a><br><hr>
<a href='<?php echo base_url('Store/daftar_transaksi') ?>'><button class='btn btn-success btn-sm col form-control'>Daftar Transaksi <span class='fa fa-list-alt'></span></button></a><br><hr>
<button class='btn btn-success btn-sm col form-control' onclick='logout();'>Logout <span class='fa fa-sign-out'></span></button><br>
"><span class="fa fa-user"></span></button> 
</div>  

<?php }else{ ?>
<div class="ml-1">
<a href="<?php echo base_url('Store/login_akun') ?>"><button class="btn btn-sm btn-success form-control">Login <span class="fa fa-sign-in"></span></button> 
</a>
</div>    

<?php } ?>
    <hr>    

    <a class="ml-1"  href="<?php echo base_url('store/terbit_gratis') ?>"><button class="btn btn-sm btn-success  form-control">Terbit Gratis <span class="fa fa-book"></span></button> </a>
<hr>    

    <a class="ml-1"  href="<?php echo base_url('store/cara_beli_buku') ?>"><button class="btn btn-sm btn-success  form-control">Cara Beli Buku <span class="fa fa-credit-card"></span></button> </a>
<hr>    

    <a  class="ml-1" href="<?php echo base_url('penulis') ?>"><button class="btn btn-sm btn-success  form-control">Cara Jadi Penulis <span class="fa fa-pencil"></span></button> </a>

</div>
</nav>
<script type="text/javascript">
$('.btn').on('click', function (e) {
$('.btn').not(this).popover('hide');
});

function load_keranjang_header(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
$.ajax({
type:"GET",
url:"<?php echo base_url('Store/keranjang_header') ?>",
data:"token="+token,
success:function(data){
$("#keranjang_header").html(data);

}
});
}

</script> 
<script type="text/javascript">
function tambah_keranjang(data){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$.ajax({
type :"POST",
url  :"<?php echo base_url('Store/tambah_keranjang')  ?>",
data :"token="+token+"&id_file_naskah="+data+"&qty="+"1",
success:function(data){
swal({
type: 'success',
html: data + ' <br>Berhasil di masukan ke keranjang',
showConfirmButton: true,
animation: false,
customClass: 'animated bounceInDown',
}).then(function() {
window.location.href = "<?php echo base_url('Store/keranjang') ?>";
});    

}

});

}

function login_header(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var email       = $("#email_header").val();
var password    = $("#password_header").val();


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
window.location.href = "<?php echo base_url('Store') ?>";
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
timer: 2000
});    

}
}
function logout(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$.ajax({
type:"POST",
url :"<?php echo base_url('Store/keluar') ?>",
data:"token="+token,
success:function(data){
swal({
title:"", 
text:"Logout Berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('Store') ?>";
});

}


});

}
</script>
