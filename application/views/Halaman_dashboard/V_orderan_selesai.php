    
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

var t = $("#data_orderan").dataTable({
initComplete: function() {
var api = this.api();
$('#data_orderan')
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_all_order') ?> ", 
"type": "POST",
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
{"data": "nomor_resi"},
{"data": "status"},
{"data": "view"}


],
order: [[0, 'desc']],
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
<div class=" card p-3 mt-2 mb-2">
<h4 align="center"><span class=" fa-3x fa fa-color fa-check-square-o"></span> <br>Data seluruh orderan Store guepedia </h4><hr>

<table id="data_orderan" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >No Invoices</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Customer</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tanggal Transaksi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nomor Resi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status</th>
<th style="width: 25%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
</div>
