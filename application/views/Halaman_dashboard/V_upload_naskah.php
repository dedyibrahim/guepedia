<?php echo print_r($kategori) ?>
<div class="container" style="margin-top:1%; margin-bottom:1%;  ">
<div class="row">    
<div class="col" style="background-color: #eee; padding:1%; ">
<h3 align="center"> File Naskah <?php echo $this->session->userdata('nama_lengkap') ?></h3><hr>
</div>


<div class="col-md-7" style="background-color: #eee; margin-left: 1%;  padding:1%; ">
<h3  class="text-center">Form upload </h3>
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
<input type="text" id="kategori"  placeholder="Judul Kategori . . " value="" class="form-control">
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
var setuju      =   $("#ketentuan:checked").val();
var judul       = $("#judul").val();
var penulis     = $("#penulis").val();
var file_naskah = $("#file_naskah").val();
var file_cover  = $("#file_cover").val();
var sinopsis    = $("#sinopsis").val();
var kategori    = $("#kategori").val();

if(judul !='' && penulis !='' && file_naskah !='' && sinopsis !='' && kategori !=''){

if(setuju == "setuju"){



 
 
    
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

</script>    
</div>
</div>