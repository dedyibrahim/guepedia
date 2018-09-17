<div class="container" style="background-color: #fff;">
<br>
<h4 align="center"><span class=" fa-3x fa fa-color fa-truck"></span> <br> Orderan Terkirim </h4><hr>
<?php foreach ($orderan_kirim->result_array() as $konfir) { ?>
<p align="center">
<button class="btn btn-dark" type="button" data-toggle="collapse" data-target=".<?php echo $konfir['id_penjualan_toko'] ?>" aria-expanded="false" aria-controls="<?php echo $konfir['invoices_toko'] ?>">Order Number <?php echo $konfir['invoices_toko'] ?> <span class="fa fa-arrow-down"></span></button>
<a href='<?php echo base_url('G_dashboard/download_invoices/'.base64_encode($konfir['id_penjualan_toko'])); ?>'><button class="btn btn-success" type="button" >Download invoices <span class="fa fa-download"></span></button></a>
<button onclick="kirim(<?php echo $konfir['id_penjualan_toko'] ?>);" class="btn btn-primary">Input penerima <span class="fa fa-hand-lizard-o"></span></button>
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
<img  class="cover3" id="zoom_01" data-zoom-image="<?php echo base_url('./uploads/bukti_bayar/'.$konfir['bukti_transfer']) ?>" src="<?php echo base_url('./uploads/bukti_bayar/'.$konfir['bukti_transfer']) ?>">

</div>
</div>
</div>

</div><hr>

<?php } ?>
<hr>    
</div>

<script type="text/javascript">
$("#zoom_01").elevateZoom({
zoomType				: "inner",
cursor: "crosshair"
});

function kirim(id){
swal({
title: 'Masukan nama penerima',
input: 'text',
inputPlaceholder: "Nama penerima packet buku",
showCancelButton: true,

}).then(function(text) {
if (text != '') {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     

$.ajax({
type:"post",
url:"<?php echo base_url('G_dashboard/input_nama_penerima') ?>",
data:"token="+token+"&id_penjualan_toko="+id+"&penerima="+text,
success:function(data){
if(data == "berhasil"){

swal({
type:"success",
text:"Nama penerima berhasil di simpan"
}).then(function(){
window.location.href = '<?php echo base_url('G_dashboard/orderan_kirim')  ?>';
});

}else{

swal({
type:"error",
text:data,
})

}    
}

});

}else{
swal({
type:"error",
text:"Resi pengiriman belum di isi"
})

}
})
}
</script>
