<div class="container" style="background-color: #fff;  padding:1%; margin-bottom:1%; " >
<br>
<h4 align="center"><span class=" fa-3x fa fa-color fa-pencil-square-o"></span> <br> Input Kata Kunci</h4><hr>
<div class="row">
    <div class="col-md-5">
        <label>Input Kata kunci </label>
            <input type="text" class="form-control" id="kata_kunci" value="" placeholder="Kata kunci . . . ">  
        <hr>
        <button class="btn btn-success pull-right " id="simpan">Simpan <span class="fa fa-save"></span></button>
    </div>
    <div class="col">
        <table id="data_seo" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header"  >No</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Kata Kunci</th>
<th  align="center"     aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>
    </div>    
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
$("#simpan").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     
var kata_kunci = $("#kata_kunci").val();

if(kata_kunci !=''){
$.ajax({
type:"POST",
url:"<?php  echo base_url('G_dashboard/simpan_kata_kunci') ?>",
data:"token="+token+"&kata_kunci="+kata_kunci,
success:function(){
swal({
type:"success",
html:"Kata kunci tersimpan"   
}).then(function(){
window.location.href="<?php echo base_url('G_dashboard/input_seo') ; ?>";    
        
});     
}
});
}else{

swal({
type:"question",
html:"Kata kunci belum di isi"   
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

var t = $("#data_seo").dataTable({
initComplete: function() {
var api = this.api();
$('#data_seo')
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_data_seo') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_kata_kunci",
"orderable": false
},
{"data": "kata_kunci"},
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