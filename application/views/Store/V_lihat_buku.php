<?php $lihat = $data->row_array(); ?>
<div class="container" style="margin-top:7% ; margin-bottom:1%;  ">
<div class="row">
<div class="col-md-4 img-thumbnail" style="text-align: center;">    
<img id="zoom_01" class="cover2" src="<?php echo base_url('uploads/file_cover/'.$lihat['file_cover']) ?>"  data-zoom-image="<?php echo base_url('uploads/file_cover/'.$lihat['file_cover']) ?>">
</div>
<div class="col">
<h4><?php echo $lihat['judul'] ?></h4>   
<hr>
<h5>Harga : Rp.<?php echo number_format($lihat['harga']) ?></h5>
<hr>
<h5>Berat : <?php echo $lihat['berat_buku'] ?> Gram</h5>
<hr>
<h5>Penulis : <?php echo $lihat['penulis'] ?></h5>
<hr>
<div class="row">
<div class="col-md-4">
<input id="qty" value="1" placeholder="jumlah Beli. . ." type="text" class="form-control">   
</div>
<div class="col">
<button onclick="tambah_keranjang_lihat('<?php echo base64_encode($lihat['id_file_naskah']) ?>')" class="btn btn-success form-control">Beli <span class=" fa fa-shopping-basket"></span></button> 
</div>
</div>
</div>
</div>
</div>


<div class="container" style=" margin-bottom:1%;">

<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link" href="#sinopsis" role="tab" data-toggle="tab">Sinopsis</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#estimasi" role="tab" data-toggle="tab">Estimasi Ongkos kirim</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#ulasan" role="tab" data-toggle="tab">Ulasan</a>
</li>
</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="sinopsis">
<?php echo $lihat['sinopsis']; ?>   
</div>
<div role="tabpanel" class="tab-pane fade" id="estimasi">
<div class="row">
<div class="col-md-6">    
<label>Qty</label>
<input type="text" class="form-control" id="jumlah_qty">
<label>Nama Kurir</label>

<select class="form-control">
    <option value="jne">JNE</option>    
    <option value="tiki">TIKI</option>    
    <option value="POS">POS</option>    
</select>

<label>Nama kota</label>
<input type="text" class="form-control" id="nama_kota">
<input type="hidden" class="form-control" id="city_id">
<label>Nama Provinsi</label>
<input type="text" readonly="" class="form-control" id="nama_provinsi">

<label>Kode pos</label>
<input type="text" readonly="" class="form-control" id="kode_pos">
    </div>
</div>
</div>
<div role="tabpanel" class="tab-pane fade" id="ulasan">
...   
</div>
</div>
</div>

<script type="text/javascript">
function tambah_keranjang_lihat(data){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var qty = $("#qty").val();    
if(qty !=''){
$.ajax({
type :"POST",
url  :"<?php echo base_url('Store/tambah_keranjang')  ?>",
data :"token="+token+"&id_file_naskah="+data+"&qty="+qty,
success:function(data){
swal({
type: 'success',
text: data + ' Berhasil di masukan ke keranjang',
showConfirmButton: false,
animation: false,
customClass: 'animated bounceInDown',
timer: 2000
});    
}

});
}else{
swal({
type: 'error',
text:'Jumlah pembelian belum di isi',
showConfirmButton: false,
animation: false,
customClass: 'animated tada',
timer: 2000
});

}

}
</script>

<script type="text/javascript">
$("#zoom_01").elevateZoom();
</script>

<script type="text/javascript">
$(function () {
$("#nama_kota").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Store/cari_kota') ?>',
select:function(event, ui){
$('#nama_provinsi').val(ui.item.province);
$('#kode_pos').val(ui.item.postal_code);
$('#city_id').val(ui.item.city_id);
}

}
);
});

</script>