
<?php $data = $data_penulis->row_array(); ?>
<div class="container"  style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<div class="col">
<h4 align="center"> Data  <?php echo $data['nama_lengkap'] ?></h4><hr>
<div class="row">
<div class="col-md-6">
<table class="table table-striped table-hover table-condensed ">
<h4 align="center">Data Umum</h4>
<hr>
<tr><td ><b>Nama lengkap </b></td>
<td> : <?php echo $data['nama_lengkap'] ?><td>
</tr>

<tr><td style="width: 30%;"><b>Nomor kontak </b></td>
<td> : <?php echo $data['nomor_kontak'] ?><td>
</tr>

<tr><td><b>Alamat lengkap</b></td> 
<td> : <?php echo $data['alamat_lengkap'] ?><td></tr>

<tr><td><b>Email    </b> </td>
<td> : <?php echo $data['email'] ?><td></tr>

<tr><td><b>Nama rekening :</b> </td>

<td> : <?php echo $data['nama_pemilik_rekening'] ?><td></tr>

<tr><td><b>Nomor rekening :</b></td>
<td> : <?php echo $data['nomor_rekening'] ?><td></tr>

<tr><td><b>Nama Bank </b> </td>
<td> : <?php echo $data['nama_bank'] ?><td></tr>

</table>     
</div>
<div class="col">
<h4 align="center">Data Khusus</h4><hr>

Royalti Belum di tarik : Rp.<?php echo number_format($data['royalti_diperoleh']) ?>
<hr>
Total royalti yang sudah didapatkan : Rp.<?php
$total_r = 0 ;

foreach ($total_royalti->result_array() as $r){

$total_r += $r['royalti'];   
}

echo number_format($total_r);
?>
<hr>
Jumlah Naskah : <?php echo $total_naskah->num_rows(); ?>

</div>


</div>
</div>
</div>

<div class="container"  style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<h4 align="center">Transfer Royalti </h4><hr>
<div class="row">
<div class="col">
<label>Royalti :</label>
<input type="text" readonly="" id="royalti" value="<?php echo $data['royalti_diperoleh'] ?>" class="form-control">
</div>
<div class="col">
<label>Biaya admin :</label>
<input type="text" id="biaya_admin" placeholder="Biaya admin . . . " class="form-control">
</div>
<div class="col">
<label>royalti Bersih :</label>
<input type="text" id="royalti_bersih" readonly="" class="form-control">
</div>

<div class="col">
<label>Bukti Transfer :</label>
<input type="file" name="bukti_transfer" id="bukti_transfer"  value="">
</div>


<div class="col">
<label>&nbsp;</label>
<button class="btn btn-success form-control" id="btn_transfer">Transfer <span class="fa fa-exchange"></span></button>   
</div>

</div>

</div>
<script type="text/javascript">
$(document).ready(function(){

$("#biaya_admin").keyup(function(){
var royalti        = $("#royalti").val();
var biaya_admin    = $("#biaya_admin").val();
var royalti_bersih = $("#royalti_bersih").val();

$("#royalti_bersih").val(royalti - biaya_admin);  
});

$("#btn_transfer").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";           
var royalti        = $("#royalti").val();
var biaya_admin    = $("#biaya_admin").val();
var royalti_bersih = $("#royalti_bersih").val();

var bukti_transfer = $('#bukti_transfer')[0];

var formData = new FormData();

$.each(bukti_transfer.files, function(k,file){   
formData.append('bukti_transfer',file);
});

formData.append('token',token);
formData.append('royalti',royalti);
formData.append('biaya_admin',biaya_admin);
formData.append('royalti_bersih',royalti_bersih);
formData.append('id_account',"<?php echo $this->uri->segment(3); ?>");

if (royalti !='' && biaya_admin !='' && royalti_bersih  !='' && bukti_transfer !=''){
$.ajax({
method: 'POST',
url:"<?php echo base_url('G_dashboard/simpan_transfer_royalti') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){

if(data == "berhasil"){

swal({
title:"", 
text:"Transfer Royalti Berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('G_dashboard/penarikan') ?>";
});  
}else{

swal({
title:"", 
html:data,
type:"error",
showConfirmButton: true,
});  
}

}
});   
}else{
swal({
title:"", 
text:"Masih ada data yang harus di isi",
type:"error",
showConfirmButton: true,
});

}
});

});
</script>    