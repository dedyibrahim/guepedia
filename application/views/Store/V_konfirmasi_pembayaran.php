<div class="container batas_header p-3">
   
<?php if($konfirmasi->num_rows() >0){ ?>    
    
<?php foreach ($konfirmasi->result_array() as $konfir) { ?>
    
    
    
<div class="row">
<div class="card card-body">
<h4 align="center">Rincian Pesanan No.invoices <?php echo $konfir['invoices_toko'] ?></h4>
<hr>

<table class="table table-bordered table-sm table-condensed table-striped">
<tr>
<th>No</th>   
<th>Rincian</th>   
<th>Harga</th>   
<th>Qty</th>   
<th>Total</th>   
</tr>

<?php 
$data_orderan = $this->db->get_where('data_penjualan_toko',array('invoices_toko'=>$konfir['invoices_toko']));
$d = 1 ;foreach ($data_orderan->result_array() as $data){
?>
<tr>
<td><?php  echo $d++?></td>
<td><?php  echo $data['nama_buku']?></td>
<td>Rp.<?php  echo number_format($data['harga_buku'])?></td>        
<td><?php  echo $data['qty']?></td>
<td>Rp.<?php  echo number_format($data['subtotal'])?></td>
</tr>        
<?php } ?>

<tr>
<td colspan="1"><?php echo $d ?></td>    
<td colspan="1">Ongkir </td>    
<td colspan="1"> </td>    
<td colspan="1"><?php echo number_format($konfir['total_berat']) ?> Gram </td>    
<td  colspan="1">Rp.<?php echo number_format($konfir['ongkir']) ?> </td>    
</tr>

    <?php if($konfir['nilai_kupon']){ ?>
<tr>
<th colspan="4">Kode Kupon <?php echo $konfir['nama_kupon'] ?> <?php echo $konfir['nilai_kupon'] ?> %</th>    
<th  colspan="1" style="color:#dc3545;"> - Rp.<?php echo number_format($konfir['hasil_kupon']) ?> </th>    
</tr>
<?php  } ?>
<?php if($konfir['nilai_promo']){ ?>
<tr>
<th colspan="4">Kode Promo <?php echo $konfir['nama_promo'] ?> <?php echo $konfir['nilai_promo'] ?> % </th>    
<th  colspan="1" style="color:#dc3545;"> - Rp.<?php echo number_format($konfir['hasil_promo']) ?> </th>    
</tr>
<?php  } ?>

<tr>
<th colspan="4">Total Bayar</td>    
<th  colspan="1">Rp.<?php echo number_format($konfir['total_bayar']) ?> </th>    
</tr>
<input type="hidden" id="harus_bayar<?php echo $konfir['id_penjualan_toko'] ?>"  value="<?php echo $konfir['total_bayar'] ?>">
</table>
</div>
    

<div class="col-md-4">
    <a href='<?php echo base_url('Store/download_invoices/'.base64_encode($konfir['id_penjualan_toko'])); ?>'><button class="btn btn-dark form-control" type="button" > Download invoices <span class="fa fa-download"></span></button></a>
    <hr>
<div class="card card-body">
<label>Upload bukti bayar</label>
<div class="input-group mb-3">
<div class="custom-file">
<input type="file" id="bukti_bayar<?php echo $konfir['id_penjualan_toko'] ?>" name="bukti_bayar" >
</div>
</div>
<label>Jumlah bayar</label>
<input type="text" id="jumlah_bayar<?php echo $konfir['id_penjualan_toko'] ?>" placeholder="Jumlah bayar . . . " class="form-control money">
<hr>
<button class="btn btn-success"  onclick="konfirmasi(<?php echo $konfir['id_penjualan_toko'] ?>)">Konfirmasi <span class="fa fa-check-square-o"></span> </button>
</div>
</div>

</div><hr>
<?php } }else{ ?>
<div class="container batas_header">
    <div class="text-center"><h3><span class="fa color-swatch fa-credit-card fa-5x text-center"></span><br>Tidak ada pembayaran <br> yang perlu di konfirmasi </h3></div>
    
    
</div>

<?php } ?>
 
</div>
<script type="text/javascript">
$(document).ready(function(){
$('.money').simpleMoneyFormat();        
});

    
function konfirmasi(inv){

var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var harus_bayar  = $("#harus_bayar"+inv).val();
var jumlah       = $("#jumlah_bayar"+inv).val();
var cek_bukti    = $('#bukti_bayar'+inv).val();
var bukti_bayar  = $('#bukti_bayar'+inv)[0];

var jumlah_bayar = jumlah.replace(/[^\d\.]/g, '');


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
text:"Terimakasih anda telah melakukan konfirmasi pembayaran, pembayaran anda akan kami periksa dalam waktu 1x24 jam",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Store/daftar_transakssi')  ?>';
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