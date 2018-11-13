<?php $static = $data_rekening->row_array(); ?>

<div class="container card  p-2 mt-2 mb-2">
<h4 align="center">Ajukan Penarikan Bagi Hasil <span class="fa fa-exchange"></span> </h4><hr>
<?php if ($static['royalti_diperoleh'] < 20000){ ?>
<H4 align="center" ><span style="color:#ffc107;"> <span class="fa fa-warning fa-3x"></span><br> Anda belum bisa melakukan penarikan</span>  <br> karena bagi hasil anda kurang dari Rp.20.000</H4>
<?php }else{ ?>
<div class="row">
<div class="col">
<label>Jumlah Penarikan</label>
<input type="text" id="jumlah_penarikan" value="0" class="form-control">
</div>

<?php 
if($static['id_bank'] != 1){
?>
<div class="col">
<label>Biaya Admin</label>
<input readonly=""  value="6500" type="text" class="form-control"> 
</div>
<?php }else{ ?>
<div class="col">
<label>Biaya Admin</label>
<input readonly="" value="0" type="text" class="form-control"> 
</div>
<?php }?>
<div class="col">
<label>Ajukan</label>
<button id="ajukan" class="btn btn-success form-control">Ajukan Penarikan <span class="fa fa-exchange"></span></button>
</div>

</div>
<?php } ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#ajukan").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var jumlah_penarikan = $("#jumlah_penarikan").val();

if($.isNumeric(jumlah_penarikan) == true && jumlah_penarikan !=0){
$.ajax({
type:"POST",
url:"<?php echo base_url('Halaman_penulis/ajukan_penarikan') ?>",
data:"token="+token+"&jumlah_penarikan="+jumlah_penarikan,
success:function(data){
if(data == "berhasil"){
swal({
type:"success",
html:"Pengajuan Royalti Berhasil"
});

}else{
swal({
type:"error",
html:data
});    
}


   
} 
});
}else{
swal({
type:"warning",
html:"Contoh Input Jumlah Penarikan 210000"
});
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
ajax: {"url": "<?php echo base_url('Halaman_penulis/json_data_pengajuan_royalti') ?> ", 
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
<div class="container card p-2 mt-2 mb-2" >
<h4 align="center"> Data Transferan Bagi Hasil Yang Selesai</h4><hr>

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
<th style="width: 15%;" align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
<script type="text/javascript">
function download_bukti(data){
window.location="<?php echo base_url('Halaman_penulis/download_bukti/')?>"+data;

}

</script>

