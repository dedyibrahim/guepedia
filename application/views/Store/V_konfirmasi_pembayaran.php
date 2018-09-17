<div class="container" style="background-color: #fff; margin-top: 6.5%;">
<h4 align="center"><span class=" fa-3x fa fa-check-circle-o"></span> <br> Konfirmasi pembayaran </h4><hr>

<?php foreach ($konfirmasi->result_array() as $konfir) { ?>
<p align="center">
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".<?php echo $konfir['id_penjualan_toko'] ?>" aria-expanded="false" aria-controls="<?php echo $konfir['invoices_toko'] ?>">Konfirmasi pembayaran <?php echo $konfir['invoices_toko'] ?> <span class="fa fa-arrow-down"></span></button>
<a href='<?php echo base_url('Store/download_invoices/'.base64_encode($konfir['id_penjualan_toko'])); ?>'><button class="btn btn-success" type="button" >Download invoices <span class="fa fa-download"></span></button></a>
</p>

<div class="row">

<div class="col">
<div class="collapse <?php echo $konfir['id_penjualan_toko'] ?>" id="<?php echo $konfir['id_penjualan_toko'] ?>">
<div class="card card-body">
<h5 align="center">Data orderan</h5><hr>
<table class="table table-bordered table-sm table-condensed table-striped">
<tr>
<th>No</th>   
<th>Nama Buku</th>   
<th>Harga</th>   
<th>Qty</th>   
<th>Jumlah</th>   
</tr>

<?php 
$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$konfir['invoices_toko']));
$d=1 ;foreach ($data_orderan->result_array() as $data){
?>
<tr>
<td><?php  echo $d++?></td>
<td><?php  echo $data['nama_buku']?></td>
<td><?php  echo $data['harga_buku']?></td>        
<td><?php  echo $data['qty']?></td>
<td><?php  echo $data['subtotal']?></td>
</tr>        
<?php } ?>
<tr>
<td colspan="2">Total Belanja</td>    
<td colspan="3">Rp.<?php echo number_format($konfir['total_belanja']) ?> </td>    
</tr>
<tr>
<td colspan="2">Ongkir </td>    
<td  colspan="3">Rp.<?php echo number_format($konfir['ongkir']) ?> </td>    
</tr>
<?php if($konfir['nilai_kupon']){ ?>
<tr>
<td colspan="2">Kode promo <?php echo $konfir['nama_kupon'] ?> </td>    
<td  colspan="3" style="color:#dc3545;"> - Rp.<?php echo number_format($konfir['hasil_kupon']) ?> </td>    
</tr>
<?php  } ?>
<tr>
<td colspan="2">Total Bayar</td>    
<td  colspan="3">Rp.<?php echo number_format($konfir['total_bayar']) ?> </td>    
</tr>
<input type="hidden" id="harus_bayar<?php echo $konfir['id_penjualan_toko'] ?>"  value="<?php echo $konfir['total_bayar'] ?>">
</table>
</div>
</div>
</div>

<div class="col-md-4">
<div class="collapse <?php echo $konfir['id_penjualan_toko'] ?>" id="<?php echo $konfir['id_penjualan_toko'] ?>">
<div class="card card-body">
<label>Upload bukti bayar</label>
<div class="input-group mb-3">
<div class="custom-file">
<input type="file" id="bukti_bayar<?php echo $konfir['id_penjualan_toko'] ?>" name="bukti_bayar" class="custom-file-input" id="inputGroupFile01">
<label class="custom-file-label" for="inputGroupFile01">Bukti bayar</label>
</div>
</div>
<label>
Jumlah bayar
</label>
<input type="text" id="jumlah_bayar<?php echo $konfir['id_penjualan_toko'] ?>" placeholder="Jumlah bayar . . . " class="form-control">
<hr>
<button class="btn btn-success" onclick="konfirmasi(<?php echo $konfir['id_penjualan_toko'] ?>)">Konfirmasi <span class="fa fa-check-square-o"></span> </button>
</div>
</div>
</div>

</div><hr>
<?php } ?>
<hr>    
</div>
<script type="text/javascript">
function konfirmasi(inv){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var harus_bayar  = $("#harus_bayar"+inv).val();
var jumlah_bayar = $("#jumlah_bayar"+inv).val();
var cek_bukti    = $('#bukti_bayar'+inv).val();
var bukti_bayar  = $('#bukti_bayar'+inv)[0];
if (jumlah_bayar !='' && cek_bukti != ''){

if(parseInt(harus_bayar) > parseInt(jumlah_bayar) ){

swal({
title:"konfirmasi pembayaran tidak diterima", 
text:"Anda kurang bayar",
type:"warning",
showConfirmButton: true,
});
} else {

var formData = new FormData();

$.each(bukti_bayar.files, function(k,file){   
formData.append('bukti_bayar',file);
});

formData.append('jumlah_bayar',jumlah_bayar);
formData.append('token',token);
formData.append('inv',inv);


$.ajax({
method: 'POST',
url:"<?php echo base_url('Store/konfirmasi') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){
if(data == "berhasil"){
swal({
title:"konfirmasi pembayaran berhasil", 
text:"Terimakasih anda telah melakukan konfirmasi pembayaran pesanan anda sedang di proses dan akan dikirim 2 x 24 jam",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store')  ?>';
});
} else {

swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store/konfirmasi_pembayaran')  ?>';
});
}
}
});
}
}else{
swal({
title:"", 
text:"Masih ada data yang harus di isi",
type:"error",
showConfirmButton: true,
});
}
}
</script>    