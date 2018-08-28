
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

var t = $("#data_file_naskah").dataTable({
initComplete: function() {
var api = this.api();
$('#data_file_naskah')
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_file_naskah_publish') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_file_naskah",
"orderable": false
},
{"data": "tanggal_upload"},
{"data": "judul"},
{"data": "penulis"},
{"data": "nama_kategori"},
{"data": "status"},
{"data": "harga"},
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
<h4 align="center"> File Naskah yang sudah terpublish</h4><hr>

<table id="data_file_naskah" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tgl Upload</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Judul</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Penulis</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Kategori</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Harga</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
</div>
