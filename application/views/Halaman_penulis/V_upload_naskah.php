
<div class="container" style="margin-top:1%; margin-bottom:1%;  ">
<div class="row">    
<div class="col" style="background-color: #eee; padding:1%; ">
<h4 align="center"> Upload Naskah <?php echo $this->session->userdata('nama_lengkap') ?></h4><hr>
<p>Jika Anda mengalami kesulitan saat upload file naskah Anda. Anda bisa mengirimkan naskah Anda melalaui email ke <strong> info@guepedia.com</strong></p>
<p>Pastikan naskah yang Anda kirim sudah sesuai dengan template guepedia.<br></p>
<p align="center"><button id="download_tamplate" class="btn btn-success">Download Tamplate <span class="fa fa-download"></span></button></p>

</div>


<div class="col-md-7" style="background-color: #eee; margin-left: 1%;  padding:1%; ">
<h4  class="text-center">Form upload </h4>
<hr>   
<label>Judul :</label>
<input type="text" id="judul" placeholder="Judul . . ." value="" class="form-control">
<label>Penulis :</label>
<input type="text" id="penulis" placeholder="Penulis . . ."  value="" class="form-control">
<label>File Naskah :</label> <i class="text-right"  style="color:#dc3545;">Note : Naskah utama,Daftar Isi,Kata Pengantar,Sinopsis, Dijadikan satu</i>
<input type="file" id="file_naskah" name="file_naskah" value="" placeholder="File Naskah . . ." class="form-control">
<label>File Cover :</label> <i class="text-right"  style="color:#dc3545;">Note :Jika ada</i>
<input type="file" id="file_cover" name="file_cover" value="" placeholder="FIle Cover . . ."class="form-control">

<label>Sinopsis :</label>
<textarea id="sinopsis" placeholder="Sinopsis . . ." value="" class="form-control"></textarea>
<label>Kategori :</label>
<select class="form-control" id="kategori">
<?php 
foreach ($kategori->result_array() as $kate){
echo "<option value=".$kate['id_kategori_naskah'].">".$kate['nama_kategori']."</option>";    
}
?>   
</select>
<hr>
<div class="checkbox">
<label>
<input type="checkbox" id="ketentuan"  value="setuju"  > Saya menyetujui dan mematuhi <a href="syarat_ketentuan.php" target="_blank"><strong><u>syarat dan ketentuan</u></strong></a> dari guepedia.com<br>
Jika Anda sudah memberikan centang pada pernyataan di atas, kami anggap Anda sudah membaca dan memahami segala syarat dan ketentuan yang diberlakukan di guepedia.com.
</label>
</div>
<hr>
<button class="btn btn-success float-right" id="btn_upload">Upload <span class="fa fa-upload"></span></button>
</div>
<script type="text/javascript">
$("#btn_upload").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var setuju      = $("#ketentuan:checked").val();
var judul       = $("#judul").val();
var penulis     = $("#penulis").val();
var file_naskah = $("#file_naskah").val();
var file_cover  = $("#file_cover").val();
var sinopsis    = $("#sinopsis").val();
var kategori    = $("#kategori").val();

if(judul !='' && penulis !='' && file_naskah !='' && sinopsis !='' && kategori !=''){

if(setuju == "setuju"){

var fileNaskah = $('#file_naskah')[0];
var fileCover = $('#file_cover')[0];
var formData = new FormData();

$.each(fileNaskah.files, function(k,file){   
formData.append('file_naskah',file);
});

$.each(fileCover.files, function(k,file){   
formData.append('file_cover',file);
});

formData.append('token',token);
formData.append('id_kategori_naskah',kategori);
formData.append('judul',judul);
formData.append('penulis',penulis);
formData.append('sinopsis',sinopsis);


$.ajax({
method: 'POST',
url:"<?php echo base_url('Halaman_penulis/proses_upload') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Upload produk berhasil",
timer:1500,
icon:"success",
button:false,
}).then(function() {
location.href = '<?php echo base_url('Halaman_penulis/upload_naskah')  ?>';
});
} else{

swal({
title:"", 
html:true,
text:data,
timer:1500,
icon:"error",
button:false,
}).then(function() {
location.href = '<?php echo base_url('Halaman_penulis/upload_naskah')  ?>';
});

}
}


});


}else{
swal({
title:"", 
text:"Syarat dan ketentuan Belum di pilih.",
icon:"error",
timer:1500,
button:false,
});   
}

}else{
swal({
title:"", 
text:"Masih ada data yg harus di isi",
icon:"error",
timer:1500,
button:false,
});      

}

});

$(document).ready(function(){

$("#download_tamplate").click(function(){
window.location="<?php echo base_url('Halaman_penulis/download_tamplate'); ?>"

});


});
</script>    
</div>
</div>
