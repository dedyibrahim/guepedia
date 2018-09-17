<div class="container" style="background-color: #fff;">
    <br>
<h4 align="center"><span class=" fa-3x fa fa-color fa-shopping-basket"></span> <br> Orderan masuk </h4><hr>
<?php foreach ($orderan_masuk->result_array() as $konfir) { ?>
<p align="center">
<button class="btn btn-dark" type="button" data-toggle="collapse" data-target=".<?php echo $konfir['id_penjualan_toko'] ?>" aria-expanded="false" aria-controls="<?php echo $konfir['invoices_toko'] ?>">Order Number <?php echo $konfir['invoices_toko'] ?> <span class="fa fa-arrow-down"></span></button>
<a href='<?php echo base_url('G_dashboard/download_invoices/'.base64_encode($konfir['id_penjualan_toko'])); ?>'><button class="btn btn-success" type="button" >Download invoices <span class="fa fa-download"></span></button></a>
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
</div>

<div class="col-md-4">
<div class="collapse <?php echo $konfir['id_penjualan_toko'] ?>" id="<?php echo $konfir['id_penjualan_toko'] ?>">
    <div class="card card-body">
        <h3 style="color: #dc3545;" align="center">Status penjualan <br>
        Belum melakukan pembayaran</h3>
    </div>
</div>
</div>

</div><hr>
<?php } ?>
<hr>    
</div>