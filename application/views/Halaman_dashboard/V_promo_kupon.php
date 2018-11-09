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

<div class="col-md-6">
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
<a href="<?php echo base_url('G_dashboard/hapus_promo/'. base64_encode($promo['id_data_kode_promo'])); ?>"    <button class="btn btn-danger"><span class="fa fa-trash"></span></button></a>
</td>
</tr>

<?php } ?>
</table>     
</div>
</div>    
</div>

<!--------------------------------------------------------------------------------------------------------->


<div class="container" style="background-color: #fff;  padding:1%; margin-bottom:1%; " >
<h4 align="center">Buat kode kupon</h4>  
<hr>   
<div class="row">
<div class="col-md-3">
<h4 align="center">Kode kupon</h4><hr>

<label>Id Account</label>
<input type="text" readonly="" class="form-control" id="id_account" >
<label>Email Penulis</label>
<input type="text" readonly="" class="form-control" id="email_penulis" >
<label>Cari Penulis</label>
<input type="text" class="form-control" id="cari_penulis" placeholder="Cari Penulis. . . ">

<label>Nama Kupon :</label>
<input type="text" class="form-control" id="nama_kupon" value="" placeholder="Nama kupon . . .">

<label>Nilai Kupon :</label>
<input type="text" class="form-control" id="nilai_kupon" value="" placeholder="Nilai kupon . . .">

<label>Minimal Order :</label>
<input type="text" class="form-control" id="syarat_kupon" value="" placeholder="Minimal Order . . .">

<hr>
<button class="btn btn-success float-right" id="btn_kupon">Simpan kode kupon <span class="fa fa-save"></span></button>


</div>

<div class="col-md-9">
<h4 align="center">Data Kode Kupon</h4><hr>
    
<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_kupon").dataTable({
initComplete: function() {
var api = this.api();
$('#data_kupon')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('G_dashboard/json_kode_kupon') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_kupon",
"orderable": false
},
{"data": "email_penulis"},
{"data": "penerima"},
{"data": "nama_kupon"},
{"data": "nilai_kupon"},
{"data": "syarat_kupon"},
{"data": "view"},


],
order: [[1, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});


</script>    

<table id="data_kupon" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Email</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Penerima</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Kupon</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nilai</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Minimal</th>
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>


</div>
</div>
</div>    
</div>
<script type="text/javascript">
$(function () {
$("#cari_penulis").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('G_dashboard/cari_penulis') ?>',
select:function(event, ui){
$('#id_account').val(ui.item.id_account);
$('#email_penulis').val(ui.item.email_penulis);
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


$("#btn_kupon").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     
var id_account     = $("#id_account").val();
var email_penulis  = $("#email_penulis").val();
var nama_kupon     = $("#nama_kupon").val();
var nama_penulis   = $("#cari_penulis").val();
var nilai_kupon    = $("#nilai_kupon").val();
var syarat_kupon   = $("#syarat_kupon").val();

if(id_account !='' && email_penulis !='' && nama_penulis !='' && nilai_kupon !='' && syarat_kupon !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/set_kupon') ?>",
data:"token="+token+"&nama_kupon="+nama_kupon+"&id_account="+id_account+"&email_penulis="+email_penulis+"&nama_penulis="+nama_penulis+"&nilai_kupon="+nilai_kupon+"&syarat_kupon="+syarat_kupon,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Set kupon berhasil",
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