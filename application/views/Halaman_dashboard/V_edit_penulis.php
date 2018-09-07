<?php $data = $query->row_array(); ?>

<div class="container" style="background-color:#fff; margin-top:1%; ">
<div class="clearfix"></div><hr>

<h4 align="center"><span class="fa fa-user fa-2x"></span> <br> Data <?php echo $data['nama_lengkap'] ?></h4><hr>
<div class="clearfix"></div>

<div class="row">
<div class="col-md-6">
<label>Penulis:</label>
<input type="text" readonly=""  value="<?php echo $data['nama_lengkap'] ?>" class="form-control" >

<label>Nama Pena:</label>
<input type="text" readonly=""  value="<?php echo $data['nama_pena'] ?>" class="form-control">

<label>Email:</label>
<input type="text" readonly="" value="<?php echo $data['email'] ?>" class="form-control">

<label>Alamat lengkap:</label>
<textarea readonly="" class="form-control"><?php echo $data['alamat_lengkap'] ?></textarea>
</div>

<div class="col">
<label>Nomor Kontak:</label>
<input type="text"  readonly="" value="<?php echo $data['nomor_kontak'] ?>" class="form-control" >

<label>Nama Rekening:</label>
<input type="text" readonly="" value="<?php echo $data['nama_pemilik_rekening'] ?>" class="form-control" >


<label>Nomor rekening:</label>
<input type="text" readonly=""  value="<?php echo $data['nomor_rekening'] ?>" class="form-control">

<label>Nama Bank:</label>
<input type="text" readonly="" value="<?php echo $data['nama_bank'] ?>" class="form-control">

<label>Status akun:</label>
<select class="form-control" id="status_akun">
<option><?php echo $data['status_akun'] ?></option> 
<option>aktif</option> 
<option>tidak</option> 
</select>
</div> 

</div>
<hr>
<button class="btn btn-success float-right" id="btn_edit">Edit <span class="fa fa-save"></span></button>
<div class="clearfix"></div><hr>
</div>

<script type="text/javascript">
$(document).ready(function(){
$("#btn_edit").click(function(){
var status_akun = $("#status_akun").val();
var id_account  = "<?php echo $this->uri->segment(3) ?>";
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";       
$.ajax({

type:"POST",
url:"<?php echo base_url('G_dashboard/update_penulis') ?>",
data:"token="+token+"&status_akun="+status_akun+"&id_account="+id_account,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Update Status akun "+status_akun,
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard/penulis') ?>';
});     

}    
}

});
});    
});   

</script>



