<?php $data = $data_akun->row_array(); ?>

<div class="container card p-3" >
<h4 align="center"><span class="fa fa-2x fa-color fa-send-o"></span> <br>Kirim Email </h4><hr>
<div class="row">
<div class="col">
<label>Nama</label>
<input type="text" name="nama" value="<?php echo $data['nama_lengkap'] ?>" readonly="" id="nama" class="form-control"></div>
<div class="col">
<label>Email</label>
<input type="text" name="email" value="<?php echo $data['email'] ?>" readonly="" id="email" class="form-control"></div>
<div class="col">
<label>Subjek</label>
<input type="text" name="subjek" id="subjek" class="form-control" placeholder="Subjek Pesan"></div>

</div>
<hr>
<h4 align="center"> Isi Email</h4>
<textarea id="isi_email" ></textarea>
<hr>
<button class="btn btn-dark" id="kirim_email">Kirim Email <span class="fa fa-send"></span></button>

<script>
CKEDITOR.replace( 'isi_email', {
toolbarGroups: [
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
{ name: 'links' },
{ name: 'paragraph', groups: [  'align',  'paragraph' ] },
]
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#kirim_email").click(function(){
    
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;       
var nama            = $("#nama").val(); 
var email           = $("#email").val();
var id_account      = "<?php echo $this->uri->segment(3) ?>";
var subjek          = $("#subjek").val();
var data_isi_email  = CKEDITOR.instances.isi_email.getData();

$.ajax({
type    :"post",
url     :"<?php echo base_url('G_dashboard/kirim_email') ?>",
data    :"token="+token+"&nama="+nama+"&email="+email+"&data_isi_email="+data_isi_email+"&subjek="+subjek+"&id_account="+id_account,
success :function(data){
if(data == "berhasil"){
swal({
type:"success",
html:"Emai telah dikirimkan ke "+nama,
});    
}else{
swal({
type:"error",
html:data,
});    
}
}
});
    
});    
    
    
});
</script>
</div>

<div class="container mt-2 mb-2 p-2 card">
<div class="row">
<div class="col-md-8 mx-auto">
<h4 align="center">Riwayat Email yang dikirimkan ke <?php echo $data['nama_lengkap'] ?></h4><hr>
<?php foreach ($data_email->result_array() as $data2){  ?>
<div class="card m-2">
    <div class="card-header">
        <?php echo $data2['nama'] ?>
    </div>
    <div class="card-body">
   
   <br><?php echo $data2['subjek'] ?>   
   <?php echo $data2['isi_email'] ?>   
  </div>
</div>          
<?php } ?>
<hr>
<?php echo $this->pagination->create_links(); ?>
</div>        
</div>
</div>
