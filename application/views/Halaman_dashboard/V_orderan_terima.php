<div class="container" style="background-color: #fff;">
<br>
<h4 align="center"><span class=" fa-3x fa fa-color fa-truck"></span> <br> Orderan yang perlu dikirim </h4><hr>
<?php foreach ($orderan_terima->result_array() as $konfir) { ?>
<div class="row">
<div class="col">
    <p><b>Nama Pemesan / No.Kontak :</b> <?php echo  $konfir['nama_penerima']." / ".$konfir['nomor_kontak'] ?>
    <br><b>Alamat pengiriman :</b> <?php echo $konfir['nama_kecamatan']." ".$konfir['nama_kota']." ".$konfir['nama_provinsi']." ".$konfir['alamat_lengkap']." ".$konfir['kode_pos'] ?>
</p>
<div class="card card-body">
<h5 align="center">Detail pesanan  <?php echo $konfir['invoices_toko'] ?></h5><hr>
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
<td colspan="2">Kode kupon <?php echo $konfir['nama_kupon'] ?> </td>    
<td  colspan="3" style="color:#dc3545;"> - Rp.<?php echo number_format($konfir['hasil_kupon']) ?> </td>    
</tr>
<?php  } ?>
<?php if($konfir['nilai_promo']){ ?>
<tr>
<td colspan="2">Kode promo <?php echo $konfir['nama_promo'] ?> </td>    
<td  colspan="3" style="color:#dc3545;"> - Rp.<?php echo number_format($konfir['hasil_promo']) ?> </td>    
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

<div class="col-md-4">
<button onclick="kirim(<?php echo $konfir['id_penjualan_toko'] ?>);" class="btn btn-primary form-control">Input Resi <span class="fa fa-pencil-square-o"></span></button>
<hr>
<a href='<?php echo base_url('G_dashboard/download_invoices/'.base64_encode($konfir['id_penjualan_toko'])); ?>'><button class="btn btn-dark form-control" type="button" >Download invoices <span class="fa fa-download"></span></button></a>
    
<div class="card card-body">
<img  class="cover3" id="zoom<?php echo $konfir['id_penjualan_toko'] ?>" data-zoom-image="<?php echo base_url('./uploads/bukti_bayar/'.$konfir['bukti_transfer']) ?>" src="<?php echo base_url('./uploads/bukti_bayar/'.$konfir['bukti_transfer']) ?>">

</div>
</div>

</div><hr>
<script type="text/javascript">
$("#zoom<?php echo $konfir['id_penjualan_toko'] ?>").elevateZoom({
  scrollZoom : true,
    zoomType				: "inner"
  });


</script> 
<?php } ?>
<hr>    
</div>

<script type="text/javascript">
function kirim(id){
swal({
title: 'Masukan resi pengiriman',
input: 'text',
inputPlaceholder: "Resi pengiriman",
showCancelButton: true,

}).then(function(text) {
if (text != '') {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     

$.ajax({
type:"post",
url:"<?php echo base_url('G_dashboard/input_resi_toko') ?>",
data:"token="+token+"&id_penjualan_toko="+id+"&resi="+text,
success:function(data){
if(data == "berhasil"){

swal({
type:"success",
text:"Resi pengiriman tersimpan dan terkirim"
}).then(function(){
window.location.href = '<?php echo base_url('G_dashboard/orderan_terima')  ?>';
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
type:"question",
text:"Resi pengiriman belum di isi"
})

}
})
}</script>    