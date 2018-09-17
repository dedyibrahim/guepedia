<div class="container" style="background-color: #fff;  padding:1%; margin-bottom:1%; " >
<h4 align="center">Buat kode promo</h4>  
<hr>   
<div class="row">
<div class="col-md-6">
<h4 align="center">Kode promo</h4><hr>
<label>Kode promo</label>
<input type="text" class="form-control" id="kode_promo" placeholder="Kode Promo . . .">

<label>Kode promo</label>
<input type="text" class="form-control" id="nilai_promo" placeholder="Nilai Promo 1-100 . . .">

<hr>
<button class="btn btn-success float-right" id="btn_promo">Simpan kode promo <span class="fa fa-save"></span></button>


</div>

<div class="col">
<h4 align="center">Data kode promo</h4><hr>
<table class="table table-striped table-condensed table-bordered">
<tr><th>No</th><th>Kode</th><th>Nilai</th><th>Aksi</th></tr>
<?php $no =1; 
foreach ($data_promo->result_array() as $promo){
?>
<tr>
<td><?php echo $no++ ?></td>
<td><?php echo $promo['kode_promo'] ?></td>
<td><?php echo $promo['nilai_promo'] ?></td>
<td>
<a href="<?php echo base_url('G_dashboard/hapus_kupon/'. base64_encode($promo['id_data_kode_promo'])); ?>"    <button class="btn btn-danger"><span class="fa fa-trash"></span></button></a>
</td>
</tr>

<?php } ?>
</table>     
</div>
</div>    
</div>


<div class="container" style="background-color: #fff;  padding:1%; margin-bottom:1%; " >
<h4 align="center">Buat kode kupon</h4>  
<hr>   
<div class="row">
<div class="col-md-6">
<h4 align="center">Set produk laris</h4><hr>
<label>Cari Buku :</label>
<input type="hidden" class="form-control" id="id_file_naskah" >
<input type="text" class="form-control" id="cari_buku" placeholder="Cari Buku. . . ">
<hr>
<button class="btn btn-success float-right" id="btn_laris">Set laris <span class="fa fa-save"></span></button>


</div>

<div class="col">
<h4 align="center">Data Produk laris</h4><hr>
<table class="table table-striped table-condensed table-bordered">
<tr><th>No</th><th>Judul</th><th>Aksi</th></tr>
<?php $no =1; 
foreach ($produk_laris->result_array() as $laris){
?>
<tr>
<td><?php echo $no++ ?></td>
<td><?php echo $laris['judul'] ?></td>
<td>
<a href="<?php echo base_url('G_dashboard/hapus_terlaris/'. base64_encode($laris['id_file_naskah'])); ?>"    <button class="btn btn-danger"><span class="fa fa-trash"></span></button></a>
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
}
}
);
});


$("#btn_promo").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     
var kode_promo     = $("#kode_promo").val();
var nilai_promo    = $("#nilai_promo").val();
if(kode_promo !='' && nilai_promo !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/set_promo') ?>",
data:"token="+token+"&kode_promo="+kode_promo+"&nilai_promo="+nilai_promo,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Set Promo berhasil",
type:"success",
showConfirmButton: true,
}).then(function(){
window.location.href = '<?php echo base_url('G_dashboard/promo_kupon')  ?>';
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
text:"Masih ada data yang harus di isi",
type:"question",
showConfirmButton: true,
});

}

});


</script>