<?php $data = $data_naskah->row_array(); ?>

<div class="container" style="background-color:#fff; margin-top:1%;  ">
    <div class="clearfix"></div><hr>

<h4 align="center">Publish Buku <span class="fa fa-bookmark-o"></span></h4><hr>
<div class="clearfix"></div>

<div class="row">
<div class="col-md-6">
<label>Id Account:</label>
<input type="text" disabled="" id="id_account" value="<?php echo $data['id_account'] ?>" class="form-control" >

<input type="hidden" disabled="" id="cover_lama" value="<?php echo $data['file_cover'] ?>" class="form-control" >


<label>Penulis:</label>
<input type="text" readonly="" id="penulis" value="<?php echo $data['penulis'] ?>" class="form-control" placeholder="Penulis . . .">

<label>Judul :</label>
<input type="text" readonly="" id="judul" value="<?php echo $data['judul'] ?>" class="form-control" placeholder="Judul Buku . . .">

<label>Harga :</label>
<input type="text" readonly="" id="harga" value="<?php echo $data['harga'] ?>" class="form-control" placeholder="Harga Buku . . .">

<label>Berat :</label>
<input type="text" readonly="" id="berat" value="<?php echo $data['berat_buku'] ?>" class="form-control" placeholder="Berat Buku . . .">

<label>Jumlah Lembar :</label>
<input type="text" readonly="" id="jumlah_lembar" value="<?php echo $data['jumlah_lembar'] ?>" class="form-control" placeholder="Jumlah Lembar. . .">
<label>Status :</label>
<select  class="form-control" disabled="" id="status" value="" placeholder="Status Buku . . .">
    <option><?php echo $data['status'] ?></option>
    <option>Dalam Antrian</option>  
    <option>Di Revisi</option> 
    <option>Proses</option> 
    <option>Publish</option>
    <option>Di tarik</option>  
    <option>Di tolak</option>  
    </select>


</div>
    
<div class="col">

<label>Kategori :</label>
<select id="kategori" disabled="" value="" class="form-control">
    <option value="<?php echo $data['id_kategori_naskah'] ?>"><?php echo $data['nama_kategori'] ?></option>   
<?php foreach ($kategori->result_array() as $kategori){ ?>
    <option value="<?php echo $kategori['id_kategori_naskah'] ?>"><?php echo $kategori['nama_kategori'] ?></option>
 <?php } ?>    
</select>

<label>Sinopsis :</label>
<textarea   id="sinopsis"  value="" rows="7" class="form-control"><?php echo $data['sinopsis'] ?></textarea>
<div class="clearfix"></div>

<hr>
<div id="data_cover">
<?php if(!file_exists('./uploads/file_cover/'.$data['file_cover'])){ ?>
<h5 align="center" style="color:#900">File cover tidak tersedia</h5>    
<?php } else if($data['file_cover'] !='' || $data['file_cover']!=NULL){ ?>
<button class="btn btn-success form-control" id="download_cover">Download cover <span class="fa fa-download"></span></button>
<?php }else{ ?>
<h5 align="center" style="color:#900">File cover tidak tersedia</h5>    
<?php } ?>
<hr>
</div>

<div id="data_naskah">
<?php if(!file_exists('./uploads/dokumen_naskah/'.$data['file_naskah'])){ ?>
<h5 align="center" style="color:#900">File naskah tidak tersedia</h5>    
<?php } else if($data['file_naskah'] ==NULL || $data['file_naskah'] == '') {  ?>
<h5 align="center" style="color:#900">File naskah tidak tersedia</h5>    
<?php }else{ ?>
<button class="btn btn-success form-control" id="download_naskah">Download naskah <span class="fa fa-download"></span></button>
<?php } ?>
</div>

<div id="input_cover" style="display: none;">
<label>File Cover :</label>
<input type="file"  id="file_cover" name="file_cover" value="" class="form-control">    
</div>

</div> 
</div>
<hr>
<button style="display:none;" class="btn btn-success float-right" id="btn_publish">Simpan Perubahan <span class="fa fa-save"></span></button>
<button  class="btn btn-warning float-right" id="edit_naskah">Edit Naskah <span class="fa fa-edit"></span></button>

<button  class="btn btn-success" id="infokan" >Infokan Status Naskah <span class="fa fa-send-o"></span></button>
<div class="clearfix"></div><hr>
</div>
<script type="text/javascript">
$(function () {
$("#penulis").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('G_dashboard/cari_penulis') ?>',
select:function(event, ui){
$('#id_account').val(ui.item.id_account);
$('#email_penulis').val(ui.item.email_penulis);
}

}
);
});

</script>

<script type="text/javascript">
$(document).ready(function(){
    
$("#download_naskah").click(function(data){

window.location="<?php echo base_url('G_dashboard/download_naskah/'. base64_encode($data['id_file_naskah'])); ?>"
    
});

$("#download_cover").click(function(data){

window.location="<?php echo base_url('G_dashboard/download_cover/'. base64_encode($data['id_file_naskah'])); ?>"
    
});

$("#edit_naskah").click(function(data){
CKEDITOR.instances.sinopsis.setReadOnly(false);   
$("#btn_publish").show();
$("#edit_naskah").hide();
$("#penulis").prop("readonly", false);
$("#status").prop("disabled", false);
$("#kategori").prop("disabled", false);
$("#sinopsis").prop("readonly", false); 
$("#judul").prop("readonly", false); 
$("#harga").prop("readonly", false); 
$("#berat").prop("readonly", false); 
$("#jumlah_lembar").prop("readonly", false); 
$("#input_naskah").show();
$("#input_cover").show();
$("#data_naskah").hide();
$("#data_cover").hide();

});


$("#btn_publish").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var file_cover     = $('#file_cover')[0];
var id_file_naskah = "<?php echo $this->uri->segment(3) ?>";
var cover_lama     = $("#cover_lama").val();
var penulis        = $("#penulis").val();
var status         = $("#status").val();
var kategori       = $("#kategori").val();
var data_sinopsis  = CKEDITOR.instances.sinopsis.getData();
var judul          = $("#judul").val();
var harga          = $("#harga").val();
var berat          = $("#berat").val();
var jumlah_lembar  = $("#jumlah_lembar").val();
var id_account     = $("#id_account").val();

var formData = new FormData();
if(id_file_naskah !='' && id_account !='' && penulis !=''&& status !='' && kategori !='' && data_sinopsis  !='' && judul !='' && harga !='' && berat !='' && jumlah_lembar !=''){

$.each(file_cover.files, function(k,file){   
formData.append('file_cover',file);
});

formData.append('token',token);
formData.append('id_file_naskah',id_file_naskah);
formData.append('penulis',penulis);
formData.append('status',status);
formData.append('kategori',kategori);
formData.append('sinopsis',data_sinopsis);
formData.append('judul',judul);
formData.append('harga',harga);
formData.append('berat',berat);
formData.append('jumlah_lembar',jumlah_lembar);
formData.append('id_account',id_account);
formData.append('cover_lama',cover_lama);


$.ajax({
method: 'POST',
url:"<?php echo base_url('G_dashboard/update_naskah') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){
if(data == "berhasil"){
 swal({
title:"", 
text:"Update naskah berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard/data_file_naskah')  ?>';
});
   
    
}else{
    
swal({
title:"", 
text:data,
icon:"error",
showConfirmButton: true,
});      
    
}

}
});

}else{

swal({
title:"", 
text:"Masih terdapat data yang perlu di isi",
icon:"error",
showConfirmButton: true,
});

}
});
});
$(document).ready(function(){

$("#infokan").on("click",function(){
  
swal({
  title: "Masukan Informasi Pesan",
  input:"textarea",
  showLoaderOnConfirm: true,
  animation: "slide-from-top",
  showCancelButton:true,
  inputPlaceholder: "Informasi Pesan"
}).then(function(value){

var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";       
var id_file_naskah                                        = "<?php echo $this->uri->segment(3) ?>";

$.ajax({
type:"POST",
data:"token="+token+"&id_file_naskah="+id_file_naskah+"&informasi="+value,
url:"<?php echo base_url('G_dashboard/infokan') ?>",
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Naskah telah berhasil di informasikan ke penulis",
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
 
});   
    


        
});

});

</script>
<script>
</script>
<script type="text/javascript">
$(document).ready(function(){
CKEDITOR.replace('sinopsis', {readOnly:true,
             toolbarGroups: [
               { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
 		{ name: 'links' },
                { name: 'paragraph', groups: [  'align',  'paragraph' ] },
	]});    
 
});

</script>

