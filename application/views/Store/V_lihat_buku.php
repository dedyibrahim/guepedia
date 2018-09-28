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
<h5>Berat : <span id="berat"><?php echo $lihat['berat_buku'] ?></span> Gram</h5>
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
<a class="nav-link nav-link active show" href="#sinopsis" role="tab" aria-selected="true" data-toggle="tab">Sinopsis</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#estimasi" role="tab" data-toggle="tab">Estimasi Ongkos kirim</a>
</li>

</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active show" id="sinopsis">
<?php echo $lihat['sinopsis']; ?>   
</div>
<div role="tabpanel" class="tab-pane fade" id="estimasi">
<div class="row">
<div class="col-md-6">    
<label>Qty</label>
<input type="text" id="qty_cost" value="1" class="form-control" id="jumlah_qty">

<label>Nama kota</label>
<input type="text" class="form-control" id="nama_kota">
<input type="hidden" id="city_id" class="form-control" id="city_id">

<div id="data_kecamatan"></div>    


<label>Nama Provinsi</label>
<input type="text" readonly=""  class="form-control" id="nama_provinsi">

<label>Kode pos</label>
<input type="text" readonly="" class="form-control" id="kode_pos">

<label>Nama Kurir</label>
<select class="form-control" id="kurir" onchange="cek_cost();">
    <option ></option>    
    <option value="jne">JNE</option>    
    <option value="wahana">WAHANA</option>    
 </select>
</div>
    <div class="col" id="data_kost">
        
    </div>
    
</div>

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
html: data + ' <br>Berhasil di masukan ke keranjang',
showConfirmButton: true,
animation: false,
customClass: 'animated bounceInDown',
}).then(function() {
window.location.href = "<?php echo base_url('Store/keranjang') ?>";
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
$("#zoom_01").elevateZoom({
zoomType				: "inner",
cursor: "crosshair"
});
</script>

<script type="text/javascript">
$(function () {
    var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$("#nama_kota").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Store/cari_kota') ?>',
select:function(event, ui){
$('#nama_provinsi').val(ui.item.province);
$('#kode_pos').val(ui.item.postal_code);
$('#city_id').val(ui.item.city_id);

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/data_kecamatan') ?>",
data:"token="+token+"&city_id="+ui.item.city_id,
success:function(data){
$("#data_kecamatan").html(data);    
}
    
});
}

}
);
});

function cek_cost(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var qty            = $("#qty_cost").val();
var city_id        = $("#city_id").val();
var berat          = $("#berat").html();
var total_berat     = berat * qty;
var subdistrict_id = $("#subdistrict_id  option:selected").val();
var kurir          = $("#kurir  option:selected").val();

if(total_berat > 10000){
swal({
title:"", 
text:"Maksimal berat adalah 1 TON",
type:"error",
showConfirmButton: true,
});
}else if(city_id !='' && total_berat !='' && subdistrict_id !='' && kurir !=''){

$.ajax({
type:"post",
url:"<?php echo base_url('Store/cek_cost') ?>",
data:"token="+token+"&city_id="+city_id+"&total_berat="+total_berat+"&subdistrict_id="+subdistrict_id+"&kurir="+kurir,
success:function(data){
$("#data_kost").html(data);   

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

}


</script>
