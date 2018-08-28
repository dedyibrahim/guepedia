
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_penulis') ?> ", 
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
{"data": "nomor_rekening"},
{"data": "nama_bank"},
{"data": "status_akun"},
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
<div class="container">
<div class="col" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<h4 align="center"> Data customer </h4><hr>

<table id="data_penulis" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Penulis</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Email</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Kontak</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Rekening</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Bank</th>
<th   align="center"     aria-controls="datatable-fixed-header"  >Status</th>
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
</div>
