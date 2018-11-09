<?php if($this->session->userdata('level') == 'Super Admin'){ ?>
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
ajax: {"url": "<?php echo base_url('G_dashboard/json_user') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_admin",
"orderable": false
},
{"data": "nama_admin"},
{"data": "email"},
{"data": "level"},
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


$(document).ready(function(){

$("#simpan_user").click(function(){
var level      = $("#level option:selected ").val();
var nama_admin = $("#nama_admin").val();
var email      = $("#email").val();
var password   = $("#password").val();
var password1  = $("#password1").val();
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";       


if(nama_admin !='' && level !='' && email !='' && password1 !=''&& password !=''){
    
if(password1 != password){
swal({
title:"", 
text:"Password tidak sesuai",
type:"error",
showConfirmButton: true,
});

}else{

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/tambah_user') ?>",
data:"token="+token+"&nama_admin="+nama_admin+"&email="+email+"&password="+password+"&level="+level,
success:function(data){
if(data == "berhasil"){
    
swal({
title:"", 
text:"User berhasil di buat",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard/user') ?>';
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

    
}

   
    
}else{
    
swal({
title:"", 
text:"Masih ada data yang perlu di isi",
type:"error",
showConfirmButton: true,
});  

}
    

});

});

</script>

<div class="container" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;  ">
    <div class="row">
    <div class="col-md-6">

 <h4 align="center" class="fa-color"> Tambahkan user Dashboard <span class="fa fa-plus-circle"></span> </h4><hr>
<label>Nama admin</label>
<input type="text" class="form-control" value="" name="nama_admin" id="nama_admin" placeholder="Nama admin . . .">
<label>Email</label>
<input type="text" class="form-control" value="" name="email" id="email" placeholder="Email . . . ">
<label>Level</label>
<select class="form-control" id="level">
    <option>Admin</option>    
    <option>Super Admin</option>    
</select>
<label>Password</label>
<input type="password" class="form-control" value="" name="password" id="password" placeholder="Password . . .">
<label>Ulangi Password</label>
<input type="password" class="form-control" value="" name="password1" id="password1" placeholder="Ulangi Password . . .">
<hr>
<button class="btn btn-success float-right" id="simpan_user">Simpan <span class="fa fa-save"></span></button>
<div class="clearfix"></div>

</div>
    <div class="col-md-6">
 <h4 align="center" class="fa-color">Data User <span class="fa fa-user"></span> </h4><hr>
        <table id="data_user" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center"    aria-controls="datatable-fixed-header" >No</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Nama User</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Email</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Level</th>
<th  align="center"     aria-controls="datatable-fixed-header" >Aksi</th>
</thead>
<tbody align="center">
</table>
    </div>    
    </div></div>

<?php } ?> 