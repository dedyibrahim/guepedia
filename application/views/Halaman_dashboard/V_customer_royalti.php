
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
<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
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
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_transfer_royalti') ?> ", 
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
{"data": "nomor_kontak"},
{"data": "email"},
{"data": "royalti"},
{"data": "biaya_admin"},
{"data": "royalti_bersih"},
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
<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<h4 align="center">Data Penulis yang sudah melakukan penarikan bagi hasil</h4><hr>

<table id="data_transfer" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Lengkap</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Kontak</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Email</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Bagi hasil</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Admin</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Bagi hasil Bersih</th>
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Bukti Transfer</th>
</thead>
<tbody align="center">
</table>

</div>

<script type="text/javascript">
 function download_bukti(data){
 window.location="<?php echo base_url('G_dashboard/download_bukti/')?>"+data;
    
 }
 
</script>    