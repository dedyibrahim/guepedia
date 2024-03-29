<body onload="canvas_kasir();" ></body>

<div class="container card mt-2 mb-2 p-2 "  >
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
<label>Penjualan</label>
<select class="form-control" id="penjualan">
<option value="Store Guepedia">Store Guepedia</option>    
<option value="Bukalapak">Bukalapak</option>    
<option value="Lazada">Lazada</option>    
<option value="Tokopedia">Tokopedia</option>    
<option value="Shopee">Shopee</option>    
<option value="Other">Other</option>    
</select>
<hr>
<button class="btn btn-success form-control" id="simpan_penjualan"> Simpan Penjualan <span class="fa fa-save"></span></button>
</div>

</div>

</div>


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
<input type="text" id="jumlah_biaya_lain" value="" class="form-control">
</div>
<div class="modal-footer">
<button type="button" id="simpan_biaya_lain" value="" class="btn btn-primary">Simpan Biaya Lain</button>
</div>
</div>
</div>
</div>


<!-------------------start grafik-------------->
<?php if($this->session->userdata('level') == 'Super Admin'){ ?>
<script>




function tampil_grafik(){

var tanggal = $("#data_chart").val();   
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       

var ctx = document.getElementById("myChart").getContext('2d');
var options = {
animation: true
};

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/data_chart') ?>",
data:"token="+token+"&tanggal="+tanggal,
success:function(data){
if(data != "kosong"){
var z = JSON.parse(data);

tanggal_transaksi = z[0].tanggal_transaksi;
jumlah_pendapatan = z[1].jumlah_pendapatan;
jumlah_royalti = z[2].jumlah_royalti;
jumlah_bersih = z[3].jumlah_bersih;


var myChart = new Chart(ctx,{
type: 'bar',
data: {
labels:tanggal_transaksi,
datasets: [{
label: 'Total Penjualan',
backgroundColor:"#36CAAB",
borderColor:"rgba(38, 185, 154, 0.7)",
pointBorderColor:"rgba(38, 185, 154, 0.7)",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data: jumlah_pendapatan
},{
label: 'Total Bersih',
backgroundColor:"#2c3e50",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data:jumlah_bersih
},{
label: 'Royalti',
backgroundColor:"#ffc107",
pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
pointHoverBackgroundColor:"#fff",
pointHoverBorderColor:"rgba(220,220,220,1)",
pointBorderWidth:1,
data:jumlah_royalti
}
]
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
});

function update_chart(){
alert("halo");    
}


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


}else{
swal({
type:"warning",
text:"tidak ada data di rentang waktu tersebut"
});  
}
}

});

}


</script>
<script type="text/javascript">
    
    
$(function() {
$('input[name="datetimes"]').daterangepicker({
timePicker: false,
startDate: moment().startOf('day').add(-30,'day'),
endDate: moment().startOf('day'),
locale: {
format:'YYYY-MM-DD'
}
});
});

</script>    
<div class="container card" >
<div class="row p-3">
<div class="col-md-3">
    <input type="text" id="data_chart" class="form-control" onchange="tampil_grafik();" name="datetimes"   value="" >
</div>
    
<div class="col">
    <h4 class="text-right"> Grafik Penjualan <span class=" fa fa-pencil"></span></h4>
</div>
</div>    
<hr>

<div style="width:100%;">
<canvas id="myChart" width="300" height="100"></canvas>
</div>

</div>
<?php } ?>

<!-------------------end grafik-------------->

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


tampil_grafik();
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
var penjualan     = $("#penjualan option:selected ").val();

if (nama_customer !='' && jumlah_bayar !='' && penjualan !=''){
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
data:"token="+token+"&penjualan="+penjualan+"&nama_customer="+nama_customer+"&nomor_kontak="+nomor_kontak+"&alamat_lengkap="+alamat_lengkap+"&jumlah_uang="+jumlah_bayar+"&kembalian="+kembalian,
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
{"data": "penjualan"},
{"data": "ongkir"},
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
<div class="container mt-2 mb-2 p-2 card" >
<form action="<?php echo base_url('G_dashboard/buat_laporan') ?>"  method="post" class="form-inline" style="position: absolute;">
<div class="form-group mx-sm-3 mb-2">

    
<input type="hidden"  class="form-control" name="<?php echo $this->security->get_csrf_token_name();?>"  value="<?php echo $this->security->get_csrf_hash(); ?>">



<input type="text" class="form-control" name="dates"  value="">
<select class="form-control" name="tipe">
    <option value="PDF">PDF</option>        
    <option value="EXCEL">EXCEL</option>        
</select>
</div>
<button type="submit" class="btn btn-primary mb-2">Buat Laporan <span class="fa fa-list-alt"></span></button>
</form> 
    <h4 align="right"> Data Seluruh Penjualan  </h4>

<hr>

<style>
.modal-lg {
    max-width: 971px;
}    
</style>    


<table id="data_penjualan" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >No Invoices</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Nama Customer</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Tanggal Transaksi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Status penjualan</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Resi</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Penjualan</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Ongkir</th>
<th style="width: 25%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>
</div>
<script type="text/javascript">
$(function() {
$('input[name="dates"]').daterangepicker({
locale :{
format:'YYYY-MM-DD'
},   
opens: 'right'
}, function(start, end, label) {
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



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Penjualan Guepedia</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="popdata">  
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar </button>
<a id="id_print" href="" ><button type="button" class="btn btn-primary">Print Penjualan <span class="fa fa-print"></span></button></a>
</div>
</div>
</div>
</div>



<script type="text/javascript">
function data_penjualan(param){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";    

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/get_penjualan') ?>",
data:"token="+token+"&id_data_penjualan="+param,
success:function(data){
document.getElementById("popdata").innerHTML = data;
$("#id_print").attr("href", "<?php echo base_url('G_dashboard/print_penjualan/') ?>"+param);
}
});


}



</script>