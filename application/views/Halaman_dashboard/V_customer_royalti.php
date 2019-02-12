
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

var t = $("#data_penulis").dataTable({
initComplete: function() {
var api = this.api();
$('#data_penulis')
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_customer_royalti') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_account",
"orderable": false
},
{"data": "nama_lengkap"},
{"data": "email"},
{"data": "nomor_kontak"},
{"data": "royalti_diperoleh"},


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
<div class="container card p-2 mt-2 mb-2" >
<div style="position: absolute;">
<a href="<?php echo base_url('G_dashboard/laporan_bagi_hasil') ?>"><button type="submit" class="btn btn-primary mb-2">Buat Laporan <span class="fa fa-list-alt"></span></button></a>
</div>
    
<h4 align="center"> Data Penulis yang Memiliki Bagi Hasil</h4><hr>

<table id="data_penulis" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Penulis</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Email</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Kontak</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Bagi Hasil</th>
</thead>
<tbody align="center">
</table>

</div>


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

var t = $("#data_transfer").dataTable({

initComplete: function() {
var api = this.api();
$('#data_transfer')
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
responsive: true, 
ajax: {"url": "<?php echo base_url('G_dashboard/json_data_pengajuan_royalti') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_pengajuan",
"orderable": false
},
{"data": "nomor_penarikan"},
{"data": "nama_lengkap"},
{"data": "nomor_kontak"},
{"data": "royalti_ditarik"},
{"data": "biaya_admin"},
{"data": "jumlah_penarikan"},
{"data": "status"},
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

var t = $("#bagi_hasil_selesai").dataTable({

initComplete: function() {
var api = this.api();
$('#bagi_hasil_selesai')
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
responsive: true, 
ajax: {"url": "<?php echo base_url('G_dashboard/json_data_pengajuan_bagi_hasil_selesai') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_pengajuan",
"orderable": false
},
{"data": "nomor_penarikan"},
{"data": "nama_lengkap"},
{"data": "nomor_kontak"},
{"data": "royalti_ditarik"},
{"data": "biaya_admin"},
{"data": "jumlah_penarikan"},
{"data": "status"},
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

var t = $("#bagi_hasil_dibatalkan").dataTable({

initComplete: function() {
var api = this.api();
$('#bagi_hasil_dibatalkan')
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
responsive: true, 
ajax: {"url": "<?php echo base_url('G_dashboard/json_data_pengajuan_bagi_hasil_dibatalkan') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_pengajuan",
"orderable": false
},
{"data": "nomor_penarikan"},
{"data": "nama_lengkap"},
{"data": "nomor_kontak"},
{"data": "royalti_ditarik"},
{"data": "biaya_admin"},
{"data": "jumlah_penarikan"},
{"data": "status"}


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


<div class="container card p-2 mt-2 mb-2" >
<h4 align="center">Permintaan Pengajuan Bagi Hasil</h4><hr>
<table id="data_transfer" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Penarikan</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Lengkap</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Kontak</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Di Tarik</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Admin</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Total</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Status</th>
<th style="width: 15%; text-decoration: none;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody  align="center">
</table>
</div>


<div class="container card p-2 mt-2 mb-2" >
<h4 align="center">Permintaan Bagi Hasil Selesai</h4><hr>
<table id="bagi_hasil_selesai" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nomor Penarikan</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nama Lengkap</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nomor Kontak</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Di Tarik</th>
<th   align="center"     aria-controls="datatable-fixed-header">Admin</th>
<th   align="center"     aria-controls="datatable-fixed-header">Total</th>
<th   align="center"     aria-controls="datatable-fixed-header">Status</th>
<th style="width: 15%; text-decoration: none;" align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody  align="center">
</table>
</div>


<div class="container card p-2 mt-2 mb-2" >
<h4 align="center">Permintaan Bagi Hasil Dibatalkan</h4><hr>
<table id="bagi_hasil_dibatalkan" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nomor Penarikan</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nama Lengkap</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nomor Kontak</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Di Tarik</th>
<th   align="center"     aria-controls="datatable-fixed-header">Admin</th>
<th   align="center"     aria-controls="datatable-fixed-header">Total</th>
<th   align="center"     aria-controls="datatable-fixed-header">Status</th>
</thead>
<tbody  align="center">
</table>
</div>



<script type="text/javascript">
 function download_bukti(data){
 window.location="<?php echo base_url('G_dashboard/download_bukti/')?>"+data;
 }
 
 
function edit_pengajuan(id_account,id_data_pengajuan){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       

swal({
text: 'Update status penjualan',
input: 'select',
inputOptions: {
'Selesai': 'Selesai',
'Gagal': 'Gagal'
},
inputPlaceholder: 'Pilih Status',
showCancelButton: false,
inputValidator: function(value) {
return new Promise(function(resolve, reject) {
if(value === 'Selesai') {
window.location = "<?php echo base_url('G_dashboard/buat_transfer/') ?>"+id_account+"/"+id_data_pengajuan; 
}else if (value === "Gagal"){
swal({
type:"info",
text:"Jika anda memberikan alasan penolakan maka royalti akan dikembalikan kembali ke penulis dan di informasikan lewat email",
input: 'textarea',
inputPlaceholder: 'Masukan alasan dibatalkan . . .',
showCancelButton: true,
inputValidator: function(value) {
if (value !=''){
$.ajax({
type:"post",
data:"token="+token+"&alasan="+value+"&id_account="+id_account+"&id_data_pengajuan="+id_data_pengajuan,
url :"<?php echo base_url('G_dashboard/batalkan_penarikan') ?>",
success:function(data){
if(data == "berhasil"){
swal({
type:"success",
html:"Penarikan telah berhasil dibatalkan dan royalti berhasil dikembalikan lagi ke penulis",
});

}else{
    
swal({
type:"error",
html:data,
});

}
}
});
            
}else{
swal({
type:"warning",
html:"Anda harus memberikan alasan dibatalkan"
});
}
}

});

}
});
}
});

}
</script>    