<div class="container" style="background-color: #fff;  padding:1%; margin-bottom:1%; " >
<div class="row">
<div class="col-md-3">
<h4 align="center">Set produk diskon</h4><hr>
<label>Cari Buku :</label>
<input type="hidden" class="form-control" id="id_file_naskah" >
<input type="text" class="form-control" id="cari_buku" placeholder="Cari Buku. . . ">

<label>Harga Buku</label>
<input readonly="" id="harga_buku" type="text" class="form-control">
<label>Nilai Diskon</label>
<input type="text" id="nilai_diskon" onkeyup="hitung_diskon();" class="form-control">
<label>Hasil Diskon</label>
<input readonly="" id="hasil_diskon" type="text" class="form-control">
<hr>
<button class="btn btn-success float-right" id="btn_diskon">Set Diskon <span class="fa fa-save"></span></button>
</div>
<div class="col">
<h4 align="center">Data Produk diskon</h4><hr>
<table class="table table-striped table-condensed table-bordered">
<tr>
<th>No</th>
<th>Judul</th>
<th>Harga Buku</th>
<th>Nilai Diskon</th>
<th>Hasil Diskon</th>
<th>Aksi</th>
</tr>
<?php $no =1; 
foreach ($produk_diskon->result_array() as $diskon){
?>
<tr>
<td><?php echo $no++ ?></td>
<td><?php echo $diskon['judul'] ?></td>
<td><?php echo $diskon['harga'] ?></td>
<td><?php echo $diskon['nilai_diskon'] ?></td>
<td><?php echo $diskon['hasil_diskon'] ?></td>
<td>
<a href="<?php echo base_url('G_dashboard/hapus_produk_diskon/'. base64_encode($diskon['id_file_naskah'])); ?>"    <button class="btn btn-danger"><span class="fa fa-trash"></span></button></a>
</td>
</tr>

<?php } ?>
</table>     
</div>
</div>    
</div>
<script type="text/javascript">
$(function () {
$("#cari_buku").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('G_dashboard/cari_buku') ?>',
select:function(event, ui){
$('#id_file_naskah').val(ui.item.id_file_naskah);
$('#cari_buku').val(ui.item.judul);
$('#harga_buku').val(ui.item.harga_buku);
}
}
);
});


$("#btn_diskon").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     
var cari_buku    = $("#cari_buku").val();
var harga_buku   = parseInt($("#harga_buku").val());
var nilai_diskon = parseInt($("#nilai_diskon").val());
var hasil_diskon = parseInt($("#hasil_diskon").val());
var id_file_naskah = $("#id_file_naskah").val();

if(cari_buku !='' && nilai_diskon !='' && hasil_diskon !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/set_diskon_produk') ?>",
data:"token="+token+"&id_file_naskah="+id_file_naskah+"&harga_buku="+harga_buku+"&nilai_diskon="+nilai_diskon+"&hasil_diskon="+hasil_diskon,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Diskon Produk Berhasil",
type:"success",
showConfirmButton: true,
}).then(function(){
window.location.href = '<?php echo base_url('G_dashboard/produk_diskon')  ?>';
});  

}else{

swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
});   


}    

}


});



}else{

swal({
title:"", 
text:"Buku belum terpilih",
type:"error",
showConfirmButton: true,
});

}

});


function hitung_diskon(){
var harga_buku   = parseFloat($("#harga_buku").val());
var nilai_diskon = parseFloat($("#nilai_diskon").val());

var hasil_diskon = harga_buku - ( harga_buku * nilai_diskon / 100) ;

$("#hasil_diskon").val(hasil_diskon);
}

</script>