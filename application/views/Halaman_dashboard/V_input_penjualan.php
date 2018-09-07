<body onload="canvas_kasir();"></body>
<div class="container " style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   " >
<div class="row">  
<div class="col-md-12" >
<h4 align="center">Input Penjualan <span class=" fa fa-pencil"></span></h4><hr>
<div class="row">
<div class="col">    
<input type="text" id="judul" placeholder="Cari Nama Buku . . ." class="form-control">
</div>
<div class="col-md-5">
<button class="btn btn-warning" id="simpan_ppn">Set PPN <span class="fa fa-percent"></span></button>   
<button class="btn btn-warning" data-toggle="modal" data-target="#diskon">Set Diskon <span class="fa fa-percent"></span></button>   
<button class="btn btn-warning" data-toggle="modal" data-target="#biaya_lain">Set Biaya Lain <span class="fa fa-money"></span></button>   
</div>    
</div>
<hr>
<div id="canvas_kasir">
</div>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-6">
<label>Nama customer : </label>
<input type="text" id="cari_customer" class="form-control">
<label>Nomor Kontak : </label>
<input type="text" id="nomor_kontak" readonly="" class="form-control">
<label>Alamat Lengkap : </label>
<textarea readonly="" id="alamat_lengkap" class="form-control"></textarea>
<hr>
<button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah_customer">Tambahkan customer <span class="fa fa-plus"></span></button>
</div>
<div class="col-md-6">

<label>Jumlah Uang : </label>
<input type="text" id="jumlah_uang" onkeyup="hitung_uang();"  class="form-control">
<label>Kembalian : </label>
<input type="text" id="kembalian" readonly="" class="form-control">
<hr>
<button class="btn btn-success form-control" id="simpan_penjualan"> Simpan Penjualan <span class="fa fa-save"></span></button>
</div>

</div>

</div>



<!-- Diskon -->
<div class="modal fade" id="tambah_customer" tabindex="-1" role="dialog" aria-labelledby="tambah_customer" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Tambahkan customer Baru</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Nama customer : </label>
<input type="text" id="nama_customer_baru" class="form-control">
<label>Nomor Kontak : </label>
<input type="text" id="nomor_kontak_customer_baru"  class="form-control">
<label>Alamat Lengkap : </label>
<textarea  id="alamat_lengkap_customer_baru" class="form-control"></textarea>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" id="simpan_customer_baru" class="btn btn-primary">Simpan customer <span class="fa fa-save"></span></button>
</div>
</div>
</div>
</div>



<!-- Diskon -->
<div class="modal fade" id="diskon" tabindex="-1" role="dialog" aria-labelledby="diskon" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Masukan Nilai Diskon</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Nilai Diskon : </label>
<input type="text" id="nilai_diskon_total" class="form-control">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" id="simpan_diskon_total" class="btn btn-primary">Set Diskon</button>
</div>
</div>
</div>
</div>

<!-- Diskon -->
<div class="modal fade" id="biaya_lain" tabindex="-1" role="dialog" aria-labelledby="biaya_lain" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Masukan Biaya Lain</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Biaya Lain : </label>
<input type="text" id="nama_biaya_lain" value="" class="form-control">
<label>Jumlah : </label>
<input type="text" id="jumlah_biaya_lain"value="" class="form-control">
</div>
<div class="modal-footer">
<button type="button" id="simpan_biaya_lain" value="" class="btn btn-primary">Simpan Biaya Lain</button>
</div>
</div>
</div>
</div>

<?php
$this->db->group_by('data_penjualan.tanggal_transaksi');
$tanggal = $this->db->get('data_penjualan');
?>

<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">
<h4 align="center">Grafik Penjualan <span class=" fa fa-pencil"></span></h4><hr>
<div style="width:100%;">
<canvas id="myChart" width="300" height="100"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var options = {
animation: true,

};
var myChart = new Chart(ctx,{
type: 'bar',
data: {
labels: [<?php foreach ($tanggal->result_array()  as $hari) {

echo json_encode($hari['tanggal_transaksi']),',';


} ?>],
datasets: [{
label: 'Total Penjualan',
backgroundColor:"#36CAAB",
borderColor:"rgba(38, 185, 154, 0.7)",
pointBorderColor:"rgba(38, 185, 154, 0.7)",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data: [<?php 
foreach ($tanggal->result_array()  as $pendapatan) {
$query = $this->db->get_where('data_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));

$total_pendapatan = 0;
foreach($query->result_array() as  $hasil_pendapatan){
$total_pendapatan += $hasil_pendapatan['total'];
}

echo $total_pendapatan,',';
}

?>],
},{
label: 'Total Bersih',
backgroundColor:"#2c3e50",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data: [<?php 
foreach ($tanggal->result_array()  as $pendapatan) {
$query = $this->db->get_where('data_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));

$total_pendapatan = 0;
foreach($query->result_array() as  $hasil_pendapatan){
$total_pendapatan += $hasil_pendapatan['total_bersih'];
}

echo $total_pendapatan,',';
}

?>],
},{
label: 'Royalti',
backgroundColor:"#ffc107",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data: [<?php 
foreach ($tanggal->result_array()  as $pendapatan) {
$query = $this->db->get_where('data_penjualan',array('tanggal_transaksi'=>$pendapatan['tanggal_transaksi']));

$total_pendapatan = 0;
foreach($query->result_array() as  $hasil_pendapatan){
$total_pendapatan += $hasil_pendapatan['total_royalti'];
}

echo $total_pendapatan,',';
}

?>],
}
],

},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:true,
callback: function(value, index, values) {
return 'Rp. ' + number_format(value);
}
}
}]
},
tooltips: {
callbacks: {
label: function(tooltipItem, chart){
var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
return datasetLabel + ':Rp. ' + number_format(tooltipItem.yLabel, 2);
}
}
}
}

}),options;
function number_format(number, decimals, dec_point, thousands_sep) {
number = (number + '').replace(',', '').replace(' ', '');
var n = !isFinite(+number) ? 0 : +number,
prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
s = '',
toFixedFix = function (n, prec) {
var k = Math.pow(10, prec);
return '' + Math.round(n * k) / k;
};
s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
if (s[0].length > 3) {
s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
}
if ((s[1] || '').length < prec) {
s[1] = s[1] || '';
s[1] += new Array(prec - s[1].length + 1).join('0');
}
return s.join(dec);
}
</script>


</div>

<script type="text/javascript">
$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       

$("#judul").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('G_dashboard/cari_buku') ?>',
select:function(event, ui){
$('#id_account').val(ui.item.id_account);
$('#nama_penulis').val(ui.item.nama_penulis);
$('#id_file_naskah').val(ui.item.id_file_naskah);
$('#harga_buku').val(ui.item.harga_buku);

$.ajax({

type:"POST",
url:"<?php echo base_url('G_dashboard/set_kasir')?>",
data:"token="+token+"&id_file_naskah="+ui.item.id_file_naskah,
success:function(data){

$("#judul").val(""); 

canvas_kasir();
}    
});

}
}
);
});


function canvas_kasir(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/canvas_kasir') ?>",
data:"token="+token,
success:function(data){
$("#canvas_kasir").html(data);    

}


});



}

function hapus_datakasir(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      
var id_hapus = id;

$.ajax({
type:'POST',
url:'<?php echo base_url('G_dashboard/hapus_datakasir') ?>',
data:'token='+token+'&id_hapus='+id_hapus,
success:function(){

canvas_kasir();
}        

});

}
function update_qty_kasir(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      
var id_qty = id ;
var qty_kasir = $("#qty_kasir"+id).val();
$.ajax({
type:"POST",
url :"<?php echo base_url('G_dashboard/update_qty_kasir'); ?>",
data:"token="+token+"&qty_kasir="+qty_kasir+"&id_qty="+id_qty,
success:function(){

canvas_kasir();
}


});   
}

function beri_diskon(id){

$("#id_diskon"+id).prop("readonly", false);
}

function set_diskon(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>" ;      
var id_qty = id ;
var nilai_diskon = $("#id_diskon"+id).val();

$.ajax({
type:"POST",
url :"<?php echo base_url('G_dashboard/set_diskon'); ?>",
data:"token="+token+"&nilai_diskon="+nilai_diskon+"&id_qty="+id_qty,
success:function(){

canvas_kasir();
}

}); 
}


$(document).ready(function(){
$("#simpan_biaya_lain").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var nama_biaya_lain    = $("#nama_biaya_lain").val();
var jumlah_biaya_lain  = $("#jumlah_biaya_lain").val();

if(nama_biaya_lain !='' && jumlah_biaya_lain !=''){
$.ajax({
type:"POST",
url :"<?php echo base_url('G_dashboard/simpan_biaya_lain') ?>",
data:"token="+token+"&nama_biaya_lain="+nama_biaya_lain+"&jumlah_biaya_lain="+jumlah_biaya_lain,
success:function(data){
canvas_kasir(); 
}    
});



}else{
swal({
title:"", 
text:"Masih ada data yg harus di isi",
type:"error",
showConfirmButton: true,
});    

}


});

$("#simpan_ppn").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";
var nilai_ppn = "10";
$.ajax({
type:"POST",
url :"<?php echo base_url('G_dashboard/set_ppn') ?>",
data:"token="+token+"&nilai_ppn="+nilai_ppn,
success:function(data){
canvas_kasir(); 
}    

});

});

$("#simpan_diskon_total").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var nilai_diskon_total  = $("#nilai_diskon_total").val();

if(nilai_diskon_total !=''){
$.ajax({
type:"POST",
url :"<?php echo base_url('G_dashboard/set_diskon_total') ?>",
data:"token="+token+"&nilai_diskon_total="+nilai_diskon_total,
success:function(data){
canvas_kasir(); 
}    
});



}else{
swal({
title:"", 
text:"Masih ada data yg harus di isi",
type:"error",
showConfirmButton: true,
});    

}


});

$("#simpan_customer_baru").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       

var nama_customer_baru           = $("#nama_customer_baru").val();
var alamat_lengkap_customer_baru = $("#alamat_lengkap_customer_baru").val();
var nomor_kontak_customer_baru   = $("#nomor_kontak_customer_baru").val();

if( nama_customer_baru !='' && alamat_lengkap_customer_baru !='' && nomor_kontak_customer_baru !=''){
$.ajax({
type:"POST",
url :"<?php echo base_url('G_dashboard/simpan_customer_baru') ?>",
data:"token="+token+"&nama_customer="+nama_customer_baru+"&alamat_lengkap="+alamat_lengkap_customer_baru+"&nomor_kontak="+nomor_kontak_customer_baru,
success:function(data){
if(data =="berhasil"){
swal({
title:"", 
text:"Customer berhasil ditambahkan",
type:"success",
showConfirmButton: true,
});   
$("#nama_customer_baru").val("");
$("#alamat_lengkap_customer_baru").val("");
$("#nomor_kontak_customer_baru").val("");

}else{
swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
button:false,
});    
}

}    
});



}else{
swal({
title:"", 
text:"Masih ada data yg harus di isi",
type:"error",
showConfirmButton: true,
});    

}


});


$("#simpan_penjualan").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var nama_customer = $("#cari_customer").val();
var nomor_kontak  = $("#nomor_kontak").val();
var alamat_lengkap = $("#alamat_lengkap").val();
var jumlah_bayar = $("#jumlah_uang").val();
var total_bayar   = $("#total_bayar").val();
var kembalian     = $("#kembalian").val();

if (nama_customer !='' && jumlah_bayar !=''){
if (parseInt(jumlah_bayar) <  parseInt(total_bayar)){
swal({
title:"", 
text:"Maaf anda kurang bayar",
type:"error",
showConfirmButton: true,
});     
}else{
$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/simpan_penjualan') ?>",
data:"token="+token+"&nama_customer="+nama_customer+"&nomor_kontak="+nomor_kontak+"&alamat_lengkap="+alamat_lengkap+"&jumlah_uang="+jumlah_bayar+"&kembalian="+kembalian,
success:function(data){
if(data == "berhasil"){

swal({
title:"Input Penjualan Berhasil", 
text:"Berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard/laporan_penjualan')  ?>';
});     
canvas_kasir();
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

}

}else{
swal({
title:"", 
text:"Masih ada data yg harus di isi",
type:"error",
showConfirmButton: true,
});    

}    


});

});


$(function () {
$("#cari_customer").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('G_dashboard/cari_customer') ?>',
select:function(event, ui){
$('#nama_customer').val(ui.item.nama_customer);
$('#nomor_kontak').val(ui.item.nomor_kontak);
$('#alamat_lengkap').val(ui.item.alamat_lengkap);
}

}
);
});



function hitung_uang(){
var total_bayar   = $("#total_bayar").val();
var jumlah_bayar = $("#jumlah_uang").val();


$("#kembalian").val(jumlah_bayar - total_bayar);    

}

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
ajax: {"url": "<?php echo base_url('G_dashboard/json_penjualan') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_penjualan",
"orderable": false
},
{"data": "no_invoices"},
{"data": "nama_customer"},
{"data": "tanggal_transaksi"},
{"data": "status_penjualan"},
{"data": "resi_pengiriman"},
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
<div class="container"  style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   " >
<form action="<?php echo base_url('G_dashboard/buat_laporan') ?>"  method="post" class="form-inline" style="position: absolute;">
<div class="form-group mx-sm-3 mb-2">
<input type="hidden" class="form-control" name="token"  value="<?php echo $this->security->get_csrf_hash(); ?>" placeholder="token">

<input type="text" class="form-control" name="dates"  placeholder="Tanggal">
</div>
<button type="submit" class="btn btn-primary mb-2">Buat Laporan <span class="fa fa-list-alt"></span></button>
</form> <h4 align="center"> Data Seluruh Penjualan  </h4>

<hr>
<table id="data_penjualan" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >No Invoices</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Customer</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tanggal Transaksi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status penjualan</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Resi</th>
<th style="width: 25%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>


</div>


<script type="text/javascript">
$(function() {
$('input[name="dates"]').daterangepicker({
locale :{
format:'DD/MM/YYYY'
},   
opens: 'right'
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
});
});

function edit_status(data){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
swal({
text: 'Update status penjualan',
input: 'select',
inputOptions: {
'Selesai': 'Selesai',
'Pending': 'Pending'
},
inputPlaceholder: 'Pilih Status',
showCancelButton: false,
inputValidator: function(value) {
return new Promise(function(resolve, reject) {
if (value === 'Selesai') {
swal({
text: 'Masukan Resi Pengiriman',
input: 'text',
inputPlaceholder: 'Resi pengiriman . . . ',
inputValidator: function(value2) {
return new Promise(function(resolve, reject) {
if (value2 != ''){
$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/update_status_penjualan') ?>",
data:"token="+token+"&status_penjualan="+value+"&resi_pengiriman="+value2+"&id_data_penjualan="+data,
success:function(data){
    
swal({
title:"", 
text:"Update berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard/laporan_penjualan') ?>';
});     
}
    
});
}else{
reject('Resi Pengiriman belum di masukan :(');
}

});
}

});

} else {
reject('Anda Harus Memilih Selesai :)');
}
});
}

});

}

</script>                    