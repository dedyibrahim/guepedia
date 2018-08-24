<?php $data = $data_naskah->row_array(); ?>
<div class="container">
<div class="row" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">    
<div class="col" >
<h4 align="center">Lihat Naskah </h4>
<hr>
<label>Judul :</label>
<input type="text" id="judul" readonly=""  placeholder="Judul . . ." value="<?php echo $data['judul'] ?>" class="form-control">
<label>Penulis :</label>
<input type="text" id="penulis" readonly=""  placeholder="Penulis . . ."  value="<?php echo $data['penulis'] ?>" class="form-control">
<label>Sinopsis :</label>
<textarea id="sinopsis"  readonly="" placeholder="Sinopsis . . ." value="" class="form-control"><?php echo $data['sinopsis'] ?></textarea>
<label>Kategori :</label>
<input type="text" id="kategori" readonly=""  placeholder="Judul Kategori . . " value="<?php echo $data['nama_kategori'] ?>" class="form-control">
<label>Status: </label>
<select disabled="" class="form-control" id="status">
    <option><?php echo $data['status'] ?></option>    
    <option>Tolak</option>    
    <option>Pending</option>    
    <option>Proses</option>    
    <option>Publish</option>    
</select>

<hr>
<button class="btn btn-warning float-right" id="edit_status">Edit Status <span class="fa fa-save"></span></button>
<button style="display: none;" class="btn btn-success float-right" id="update_status">Update Status <span class="fa fa-save"></span></button>

<div style="display:none; "  id="data_publish">
<label>Berat Buku :</label>
<input type="text" class="form-control" id="berat_buku" placeholder="Berat . . . ">

<label>Harga Buku :</label>
<input type="text" class="form-control" id="harga_buku" placeholder="Haga Buku . . . ">

<label>File Cover :</label>
<input type="file" name="file_cover_jadi" value="" class="form-control" id="file_cover_jadi" placeholder="File Cover . . . ">


<hr>
<button class="btn btn-success float-right" id="publish_buku"> Publish Buku <span class="fa fa-book"></span></button>
</div>

</div>
<div class="col-md-6">
<h4 align="center">File Naskah Dan File Cover</h4>
<hr>
<h5 align='center'>Download File Naskah</h5>
<button class="btn btn-success form-control" id="download_naskah">Download Naskah <span class="fa fa-download"></span></button>
<hr>
<h5 align='center'>Download File Cover</h5>
<?php if($data['file_cover'] != NULL){ ?>
<button class="btn btn-success form-control" id="download_cover">Download Cover <span class="fa fa-download"></span></button>
<?php }else{ ?>
<h5 align='center' style="color:#d14"> File Cover Tidak Tersedia</h5>
<?php } ?>
<hr>
</div> 
</div>   
</div>
<script type="text/javascript">
$(document).ready(function(){
    
$("#download_naskah").click(function(data){

window.location="<?php echo base_url('G_dashboard/download_naskah/'. base64_encode($data['id_file_naskah'])); ?>"
    
});

$("#download_cover").click(function(data){

window.location="<?php echo base_url('G_dashboard/download_cover/'. base64_encode($data['id_file_naskah'])); ?>"
    
});

$("#edit_status").click(function(data){
$("#update_status").show();
$("#edit_status").hide();
$("#status").prop("disabled", false);
    
});



$("#update_status").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var status = $("#status").val();
var id_file_naskah ="<?php echo $this->uri->segment(3) ?>"; 

if(status == "Publish"){
$("#data_publish").show();
$("#update_status").hide();
$("#status").prop("disabled", true);

}else{
$.ajax({
type:"post",
url :"<?php echo base_url('G_dashboard/update_status_naskah') ?>",
data:"token="+token+"&status="+status+"&id_file_naskah="+id_file_naskah,
success:function(data){       
if(data == "berhasil"){
swal({
title:"", 
text:"Update Status naskah dengan Judul "+$("#judul").val()+" Berhasil",
timer:3500,
icon:"success",
button:false,
}).then(function() {
location.href = '<?php echo base_url('G_dashboard/data_file_naskah')  ?>';
});    
    
} else {
swal({
title:"", 
text:data,
timer:1500,
icon:"error",
button:false,
});
   
}

}

});
}       
});

$("#publish_buku").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var fileCover  = $('#file_cover_jadi')[0];
var cover_cek  = $('#file_cover_jadi').val();
var berat_buku = $("#berat_buku").val();
var harga_buku = $("#harga_buku").val();
var id_file_naskah = "<?php echo $this->uri->segment(3) ?>";
var formData = new FormData();

if(cover_cek !='' && berat_buku !='' && harga_buku !=''){

$.each(fileCover.files, function(k,file){   
formData.append('file_cover_jadi',file);
});

formData.append('token',token);
formData.append('berat_buku',berat_buku);
formData.append('harga_buku',harga_buku);
formData.append('id_file_naskah',id_file_naskah);

$.ajax({
method: 'POST',
url:"<?php echo base_url('G_dashboard/publish_buku') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){
if(data == "berhasil"){
 swal({
title:"", 
html:true,
text:"Publish produk berhasil",
timer:2000,
icon:"success",
button:false,
}).then(function() {
location.href = '<?php echo base_url('G_dashboard/data_file_naskah')  ?>';
});
   
    
}else{
    
swal({
title:"", 
text:data,
icon:"error",
timer:2000,
button:false,
});      
    
}

}
});

}else{

swal({
title:"", 
text:"Masih terdapat data yang perlu di isi",
timer:1500,
icon:"error",
button:false,
});

}
});
});
</script>