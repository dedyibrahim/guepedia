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

var t = $("#data_user").dataTable({
initComplete: function() {
var api = this.api();
$('#data_user')
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_naskah_penulis/'.$this->uri->segment(3)) ?> ", 
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
{"data": "penulis"},
{"data": "judul"},
{"data": "harga"},
{"data": "status"},
{"data": "tanggal_upload"},
{"data": "nama_kategori"},
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
<?php $data = $data_penulis->row_array(); ?>
<div class="container"  style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<div class="col">
<h4 align="center"> Data  <?php echo $data['nama_lengkap'] ?></h4><hr>
<div class="row">
<div class="col-md-6">
<table class="table table-striped table-hover table-condensed ">
<h4 align="center">Data Umum</h4>
<hr>
<tr><td ><b>Nama lengkap </b></td>
<td> : <?php echo $data['nama_lengkap'] ?><td>
</tr>

<tr><td style="width: 30%;"><b>Nomor kontak </b></td>
<td> : <?php echo $data['nomor_kontak'] ?><td>
</tr>

<tr><td><b>Alamat lengkap</b></td> 
<td> : <?php echo $data['alamat_lengkap'] ?><td></tr>

<tr><td><b>Email    </b> </td>
<td> : <?php echo $data['email'] ?><td></tr>

<tr><td><b>Nama rekening :</b> </td>

<td> : <?php echo $data['nama_pemilik_rekening'] ?><td></tr>

<tr><td><b>Nomor rekening :</b></td>
<td> : <?php echo $data['nomor_rekening'] ?><td></tr>

<tr><td><b>Nama Bank :</b> </td>
<td> : <?php echo $data['nama_bank'] ?><td></tr>

</table>     
</div>
<div class="col">
<h4 align="center">Data Khusus</h4><hr>

Royalti Belum di tarik : Rp.<?php echo number_format($data['royalti_diperoleh']) ?>
<hr>
Total royalti yang sudah didapatkan : Rp.<?php
$total_r = 0 ;

foreach ($total_royalti->result_array() as $r){
    
 $total_r += $r['royalti'];   
}

echo number_format($total_r);
?>
<hr>
Jumlah Naskah : <?php echo $total_naskah->num_rows(); ?>
<hr>
<label>Input balance</label>
<input type="text" class="form-control" id="balance" placeholder="Input balance . . .">
<hr>

<button id="btn_balance" class="btn btn-success pull-right">Simpan Balance <span class="fa fa-balance-scale"></span></button>
</div>


</div>
</div>
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_penjualan_customer/'.$this->uri->segment(3)) ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_jumlah_penjualan",
"orderable": false
},
{"data": "no_invoices"},
{"data": "nama_customer"},
{"data": "tanggal_transaksi"},
{"data": "status_penjualan"},
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
<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   " >
<h4 align="center"> Data Seluruh penjualan <?php echo $data['nama_lengkap'] ?> </h4><hr>

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

<div class="container"  style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%; " >
<h4 align="center"> Data Naskah <?php echo $data['nama_lengkap'] ?></h4><hr>

<table id="data_user" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"     aria-controls="datatable-fixed-header"   >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Penulis</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Judul</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Harga</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tanggal upload</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Kategori</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_balance").click(function(){
var id_account   = "<?php echo $this->uri->segment(3) ?>";
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var nilai_balance = $("#balance").val();
if(nilai_balance !=''){
$.ajax({
type:"post",
url:"<?php echo base_url('G_dashboard/input_balance') ?>",
data:"token="+token+"&id_account="+id_account+"&nilai_balance="+nilai_balance,
success:function(data){
if(data == "berhasil"){ 
swal({
title:"", 
text:"Nilai balance berhasil ditambahkan",
type:"success",
showConfirmButton: true,
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
text:"Nilai balance belum di input",
type:"question",
showConfirmButton: true,
});    
}


});        
});    
</script>    