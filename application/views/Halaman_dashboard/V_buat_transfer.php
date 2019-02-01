
<?php $data = $data_penulis->row_array(); ?>
<div class="container">
<div class="row">

<div class="col-md-6 card m-2 p-2">
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
<div class="col card m-2 p-2">
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

<div class="container">
<div class="row">
<div class="col-md-6  p-2 m-2 card">
<?php $data_bukti = $data_bukti->row_array(); ?> 
<h5 align="center">Nomor Penarikan <?php echo $data_bukti['nomor_penarikan'] ?></h5>
<hr>    

<table class="table-striped table-condensed">
<tr><td>Bagi Hasil</td><td> Rp. <?php echo  number_format($data_bukti['royalti_sebelumnya']) ?> </td></tr>
<tr><td>Biaya Admin</td><td> Rp.<?php echo number_format($data_bukti['biaya_admin'])?> </td></tr>
<tr><td>Penarikan </td><td> Rp.<?php echo number_format($data_bukti['royalti_ditarik'])?> </td></tr>
<tr><td>Jumlah Penarikan</td><td> Rp.<?php echo number_format($data_bukti['jumlah_penarikan'])?> </td></tr>
<tr><td>Sisa Bagi Hasil</td><td> Rp.<?php echo number_format($data_bukti['royalti_diperoleh'])?> </td></tr>
</table>
</div>
<div class="col p-2 m-2 card">
<?php if($data_bukti['status'] != "Selesai"){ ?>
<label>Bukti Transfer :</label>
<input type="file" class="form-control" name="bukti_transfer" id="bukti_transfer"  value="">
<hr>
<button class="btn btn-success form-control" id="btn_transfer">Transfer <span class="fa fa-exchange"></span></button>   
<?php } else{ ?>
<h3 align="center">Royalti Telah behasil ditarik <br>
Nomor Penarikan <?php echo $data_bukti['nomor_penarikan'] ?>
</h3>
<?php }?>
</div>
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){



$("#btn_transfer").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";           

var bukti_transfer = $('#bukti_transfer')[0];

var formData = new FormData();

$.each(bukti_transfer.files, function(k,file){   
formData.append('bukti_transfer',file);
});

formData.append('token',token);
formData.append('id_data_pengajuan',"<?php echo $this->uri->segment(4); ?>");

if (bukti_transfer !=''){
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