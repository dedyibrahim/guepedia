<div class="container batas_header p-2">
<ul class="nav nav-tabs mt-2 mb-2" role="tablist">
<li class="nav-item">
<a class="nav-link nav-link active show" href="#transaksi" role="tab" aria-selected="true" data-toggle="tab">Daftar Transaksi</a>
</li>


</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active show p-3" id="transaksi">
    <div class="card p-2">    
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

var t = $("#data_penjualan").dataTable({
initComplete: function() {
var api = this.api();
$('#data_penjualan')
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
ajax: {"url": "<?php echo base_url('Store/json_transaksi') ?> ", "type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_penjualan_toko",
"orderable": false
},
{"data": "invoices_toko"},
{"data": "nama_penerima"},
{"data": "nomor_kontak"},
{"data": "status"},
{"data": "view"},


],
order: [[1, 'asc']],
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

<table id="data_penjualan" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >No Invoices</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Customer</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tanggal Transaksi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status penjualan</th>
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>
</div>
</div>

</div>
</div>
