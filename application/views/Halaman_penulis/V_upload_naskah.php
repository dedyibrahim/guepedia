
<div class="container" style="margin-top:1%; margin-bottom:1%;  ">
<div class="row">    
<div class="col">
<?php if ($this->session->flashdata('hasil_upload')) { ?>
<body onload="tampil_hasil_upload()"></body>
 
<script type="text/javascript">

function tampil_hasil_upload(){
var status_upload = "<?php echo $this->session->flashdata('status_upload'); ?>";
console.log(status_upload);
if(status_upload == 'berhasil'){
swal({
html:"<?php echo $this->session->flashdata('hasil_upload'); ?>",    
type:"success"    
});

}else if (status_upload == "gagal"){
swal({
html:"<?php echo $this->session->flashdata('hasil_upload'); ?>",    
type:"error"    
});
}

}

</script>

<?php }?>
<div class="card P-2">    
<h4 align="center"> Ketentuan Upload Naskah </h4><hr>

<ol>
<li>Kata Pengantar.</li>
<li>Daftar Isi.</li>    
<li>Tentang Penulis.</li>    
<li>Sinopsis sebanyak 150 - 250 kata </li>    
<li>Sinopsis harus menggambarkan keseluruhan isi naskah secara jelas, bukan hanya penggalan dari isi naskah atau sekadar kata-kata yang tidak menceritakan isi naskah
(Jika bagian-bagian di atas tidak ada, naskah tidak akan diproses) 
</li>
<li>Kata Pengantar,Daftar isi,naskah dijadikan satu file (.docx) dan di upload di halaman penulis </li>
</ol>
<p>Pastikan naskah yang Anda kirim sudah sesuai dengan template guepedia.<br></p>
<p align="center"><button id="download_tamplate" class="btn btn-success">Download Tamplate <span class="fa fa-download"></span></button></p>
</div>
</div>


<div class="col-md-7 card ml-1 p-4">
<h4  class="text-center"> <span class="fa fa-upload fa-2x"></span> <br> Upload Naskah</h4>
<hr>
<?php echo validation_errors(); ?>
<form method="POST" action="<?php echo base_url('Halaman_penulis/proses_upload') ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
<input type="hidden" id="token"  name="<?php echo  $this->security->get_csrf_token_name()?>" value="<?php echo   $this->security->get_csrf_hash();?>" />
<div class="form-group">
<label for="judul">Judul Naskah</label>
<input type="text" id="judul" required="" name="judul" placeholder="Judul . . ." value="<?php echo set_value('judul'); ?>" class="form-control form-control-danger"  data-toggle="tooltip" title="Judul Buku yang ditulis">
</div>

<div class="form-group">
<label for="penulis">Penulis </label>
<input type="text" id="penulis" required="" name="penulis" placeholder="Penulis . . ."  value="<?php echo set_value('judul'); ?> <?php echo $this->session->userdata('nama_lengkap'); ?>" class="form-control" data-toggle="tooltip" title="Nama Penulis ">
</div>
<div class="form-group">
<label for="sinopsis">Sinopsis </label>
<textarea id="sinopsis" rows="10" required="" name="sinopsis" placeholder="Sinopsis . . ." value="<?php echo set_value('sinopsis'); ?> " class="form-control" data-toggle="tooltip" title="Untuk dibelakang Buku dan untuk Promosi"></textarea>
</div>
<div class="form-group">
<label for="kategori">Kategori </label>
<select class="form-control" required="" name="kategori" id="kategori" data-toggle="tooltip" title="Kategori Buku">
<?php 
foreach ($kategori->result_array() as $kate){
echo "<option value=".$kate['id_kategori_naskah'].">".$kate['nama_kategori']."</option>";    
}
?>   
</select>
</div>
<hr>
<label for="file_naskah">File Naskah </label>
<input type="file" onchange="simpan_naskah();" required="" class="form-control" id="file_naskah" name="file_naskah" value="" placeholder="File Naskah . . ." data-toggle="tooltip" title="Note : Naskah utama,Daftar Isi,Kata Pengantar,Sinopsis, Dijadikan satu Dan hannya Menerima Dalam bentuk Microsoft Word (.docx)">
<div class="progress progress_naskah mt-1" style="display: none;">
<div class="progress-bar progress-bar-striped bg-success  progress-bar-animated" id="progress_naskah" role="progressbar" style="width:0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<hr>
<label for="file_naskah">File Cover </label>
<input type="file" onchange="simpan_cover();" class="form-control" id="file_cover" name="file_cover" value="" placeholder="File Cover . . ." data-toggle="tooltip" title="Note : Hanya menerima dalam bentuk PSD">
<div class="progress progress_cover mt-1" style="display: none;">
<div class="progress-bar progress-bar-striped bg-success  progress-bar-animated" id="progress_cover" role="progressbar" style="width:0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<hr>
<div class="form-group">
<div class="form-check">
<input data-toggle="modal" data-target=".bd-example-modal-lg" class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
<label class="form-check-label" for="invalidCheck">
Saya menyetujui dan mematuhi <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><strong><u>syarat dan ketentuan </u></strong></a> ( Perjanjian Guepedia dan Penulis ) dari guepedia.com
<hr>
Jika Anda sudah memberikan centang pada pernyataan di atas, kami anggap Anda sudah membaca dan memahami segala syarat dan ketentuan yang diberlakukan di guepedia.com, dan ini  sebagai dokumen sah perjanjian
antara Guepedia dan Penulis.

</label>
<div class="invalid-feedback">
Anda Harus Menyetujui syarat dan ketentuan yang berlaku di guepedia.com
</div>
</div>
</div>
<hr>

<button class="btn btn-success form-control float-right"   id="btn_simpan" > Simpan Upload <span class="fa fa-upload"></span></button>
</form>
</div>

<script type="text/javascript">

function simpan_naskah(){
var fileNaskah      = $('#file_naskah')[0];

if(fileNaskah.files[0].size > 10000000){
swal({
text:"Maksimal upload file naskah 10 MB",
type:"warning",
showConfirmButton: false,
});
$('#file_naskah').val("");
}else{
$(".progress_naskah").show();
var file_naskah = $('#file_naskah').get(0).files[0];
var token       = $('#token').val();
formData = new FormData();
formData.append('file_naskah',file_naskah);
formData.append('token',token);         
$.ajax( {
url        : '<?php echo base_url('halaman_penulis/simpan_naskah') ?>',
type       : 'POST',
contentType: false,
cache      : false,
processData: false,
data       : formData,
xhr        : function ()
{
var jqXHR = null;
if ( window.ActiveXObject ){
jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
}else{
jqXHR = new window.XMLHttpRequest();
}

jqXHR.upload.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

console.log( 'Uploaded percent', percentComplete );
$("#progress_naskah").attr('style',  'width:'+percentComplete+'%');
}

}, false );
jqXHR.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
console.log( 'Downloaded percent', percentComplete );

}
}, false );
return jqXHR;
},
success    : function ( data ){
 console.log(data);
         
if(data == "berhasil"){
swal({
title:"File naskah tersimpan",
type:"success",
});
$(".progress_naskah").hide();
}else{
swal({
title:data,
type:"error",
});    
$(".progress_naskah").hide();
}

}
});

}
}

function simpan_cover(){
var fileCover       = $('#file_cover')[0];
if(fileCover.files[0].size > 20000000){
swal({
text:"Maksimal upload file cover 20 MB",
type:"warning",
showConfirmButton: false,
});
$('#file_cover').val("");
}else{ 
$(".progress_cover").show();
var file_cover = $('#file_cover').get(0).files[0];
var token       = $('#token').val();
formData = new FormData();
formData.append('file_cover',file_cover);
formData.append('token',token);         
$.ajax( {
url        : '<?php echo base_url('halaman_penulis/simpan_cover') ?>',
type       : 'POST',
contentType: false,
cache      : false,
processData: false,
data       : formData,
xhr        : function ()
{
var jqXHR = null;
if ( window.ActiveXObject ){
jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
}else{
jqXHR = new window.XMLHttpRequest();
}

jqXHR.upload.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

console.log( 'Uploaded percent', percentComplete );
$("#progress_cover").attr('style',  'width:'+percentComplete+'%');
}

}, false );
jqXHR.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
console.log( 'Downloaded percent', percentComplete );

}
}, false );
return jqXHR;
},
success    : function ( data ){
 console.log(data);
         
if(data == "berhasil"){
swal({
title:"File Cover tersimpan",
type:"success",
});
$(".progress_cover").hide();
}else{
swal({
title:data,
type:"error",
});    
$(".progress_cover").hide();
}

}
});
}
}

        

</script>    

<script type="text/javascript">


$(document).ready(function(){
$("#download_tamplate").click(function(){
window.location="<?php echo base_url('Halaman_penulis/download_tamplate'); ?>"
});
});
</script>

<script>
(function() {
'use strict';
window.addEventListener('load', function() {
var forms = document.getElementsByClassName('needs-validation');
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {

if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}else{


}
form.classList.add('was-validated');
}, false);
});
}, false);
})();
</script>
<script>
CKEDITOR.replace( 'sinopsis', {
toolbarGroups: [
{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
{ name: 'links' },
{ name: 'paragraph', groups: [  'align',  'paragraph' ] },
]
});
</script>
</div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<div class="container">
<h4 align="center"><span style="color:#ff0000; ">Harap di baca sampai Habis </span></span> 
<br>Perjanjian Guepedia dan Penulis</h4>
</div>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div style="padding:1%; "><div class=" form">

<p>1. DEFINISI</p>

<ul>
<li>Kepatuhan Anda: Sebelum menggunakan, mengakses atau memanfaatkan situs ini, Anda sudah membaca dengan baik setiap dan seluruh Syarat dan Ketentuan ini yang antara lain berisi mengenai Hak Cipta, Kewajiban Penulis, Bagi hasil Penulis dan ketentuan menerbitkan buku yang berkaitan dengan penulis guepedia.com. Dan dengan melanjutkan penggunaan atau pemanfaatan fasilitas yang diberikan oleh guepedia.com maka Anda telah menyatakan persetujuan Anda terhadap setiap dan seluruh ketentuan dalam Syarat dan Ketentuan ini.</li>
<li>Keanggotaan di Guepedia.com adalah terbuk bagi semua kalangan, baik penulis buku, pembeli buku maupun penikmat buku.</li>
<li>Keanggotaan di Guepedia.com adalah GRATIS dengan mengisi form data keanggotaan secara lengkap dan benar.</li>
</ul>


<p>2. HAK CIPTA</p>

<ul>
<li>Penulis menyatakan dengan sebenarnya telah menyerahkan sebuah naskah yang telah diketik kepada Guepedia.com</li>
<li>Penulis menyerahkan hak terbit kepada Guepedia.com selama kurun waktu 5 (lima) tahun sejak perjanjian disetujui. Selama itu penulis tidak boleh menerbitkan di penerbit lain dan menarik naskah dalam hal apapun.</li>
<li>Selama Perjanjian ini berlaku, Guepedia.com dan Penulis bersama – sama melindungi Hak Cipta intelektual Penulis yang ada pada kedua belah pihak.</li>
</ul>


<p>3. KEWAJIBAN PENULIS</p>

<ul>
<li>Penulis menjamin bahwa ia tidak menyerahkan karya tersebut kepada pihak lain untuk diterbitkan atau diterjemahkan.</li>
<li>Penulis menjamin naskah yang akan diterbitkan oleh Guepedia.com belum pernah diterbitkan oleh penebit lain. Jika penulis sudah pernah menerbitkan dipenerbit lain dan ingin diterbitkan hanya di guepedia.com maka harus ada surat keterangan pencabutan naskah dari penerbit sebelumnya.</li>
<li>Penulis menjamin bahwa karya tersebut tidak mengandung sesuatu yang melanggar hak cipta orang lain dan melanggar hukum.</li>
<li>Penulis menjamin bahwa karya tersebut tidak mengandung sesuatu yang dapat dianggap sebagai penghinaan atau fitnahan terhadappihak lain.</li>
<li>Penulis menjamin bahwa karya tersebut tidak mengandung sesuatu yang berbau pornografi, SARA, LGBT dan mengandung kontroversi.</li>
<li>Penulis membebaskan Guepedia.com dari segala tuntutan pihak ketiga berdasarkan hal – hal yang ia jamin dalam hal ketiga ayat tersebut di atas, jika kesalahan terbukti semata – mata ada pada Penulis, terutama yang mengenai isi buku.</li>
<li>Penulis tidak diperkenankan membuat karangan lain yang judul dan isinya sama atau judul yang diubah tapi isi sama atau judul sama tapi isi di ubah atau dalam bentuk apa pun yang merugikan Guepedia.com dalam penjualan karya tersebut.</li>
<li>Penulis tidak di perkenankan menyuruh orang lain menerbitkan atau membantu usaha orang lain untuk menerbitkan karya yang judul &amp; isinya sama, atau judul yang diubah tapi isi sama atau judul sama tapi isi diubah atau dalam bentuk apa pun.</li>
<li>Penulis tetap mempunyai hak untuk melakukan revisi, perbaikan atau penyempurnaan apabila pada naskah tersebut ditemukan kesalahan atau ketidaksempurnaan atau apabila diminta oleh Guepedia.com</li>

</ul>

<ul>
<li>Apabila diperlukan, penulis wajib memberikan diskripsi tentang tata wajah, ringkasan cerita, ilustrasi naskah, daftar gambar, foto-foto, daftar istilah, atau hal-hal lain yang berhubungan dengan kelengkapan naskah.</li>
</ul>


<p>4. KEWAJIBAN GUEPEDIA.COM</p>

<ul>
<li>Guepedia.com menyanggupi untuk segera menerbitkan naskah penulis dalam bentuk buku fisik maupun digital.</li>
<li>Guepedia.com akan mempromosikan serta memasarkan buku tersebut seluas mungkin.</li>
<li>Guepedia.com berhak memperbaiki naskah, menetapkan tata wajah, tata letak, bentuk buku, jumlah halaman, ilustrasi, penentuan harga, proses cetakan, dan cara penjualannya.</li>
<li>Guepedia.com juga diberikan hak untuk menyebarluaskan karya penulis tersebut dalam bentuk lain, seperti Film, Sinetron, Video, dan lain-lain, baik sebagian ataupun keseluruhan naskah.</li>
<li>Guepedia.com berhak untuk menarik dan tidak menerbitkan naskah yang sedang berjalan dengan atau tanpa alasan apapun.</li>
<li>Guepedia.com tidak bertanggung jawab atas isi naskah yang diterbitkan jika dikemudian hari ditemukann hal-hal yang melanggar hukum,norma,dan asusila.</li>
</ul>


<p>5. ROYALTY ATAU BAGI HASIL</p>

<ul>
<li>Guepedia.com akan membayar bagi hasil kepada Penulis sebesar 15% dari harga jual buku sebelum pajak tambahan. Dan bagi hasil akan dikurangkan pajak sesuai dengan UUD perpajakan yang berlaku di Indonesia.</li>
<li>Bagi hasil penulis tidak terikat dalam jumlah 15% (bisa lebih dari 15%) tergantung promo yang akan ditawarkan oleh Guepedia.com</li>
<li>Penulis bisa menarik bagi hasil setiap bulannya.</li>
</ul>


<p>6. PENERJEMAHAN NASKAH</p>

<ul>
<li>Jika naskah atau buku di terbitkan dalam bahasa lain, maka Guepedia.com berhak menerjemahkannya. Segala biaya penerjemahan akan di bicarakan kepada penulis Apabila penulis meninggal dunia, maka segala hak dan kewajibannya yang berhubungan 
dengan surat perjanjian ini beralih kepada ahli warisnya yang sah menurut hukum</li>
<li>Apabila ahli waris penulis lebih dari seorang, maka mereka harus menunjuk seorang ahli waris yang diberi surat kuasa penuh
untuk berhubungan dengan guepedia.com</li>
<li>Apabila penunjukkan tersebut tidak dilakukan dan diberitahukan kepada Guepedia.com, maka Guepedia.com berhak melakukan segala sesuatu mengenai hak-hak dan kewajiban-kewajiban mereka dengan layak dan sebaik-baiknya.</li>
</ul>

<p>7. PENYELESAIAN PERSELISIHAN</p>

<ul>
<li>Apabila penulis sudah menyetujui perjanjian ini sebelum kurun waktu lima tahun melanggar perjanjian maka bagi hasil penulis akan dibekukan oleh Guepedia.com</li>
</ul>

<p>8. UU ITE NO.11 TAHUN 2008 BAB III MENGENAI SURAT ELEKTRONIK </p>

<ul>
<li>PASAL 5 <br> 
Informasi Elektronik dan/atau Dokumen
Elektronik dan/atau hasil cetaknya merupakan
alat bukti hukum yang sah. <br>
PASAL 5 AYAT 4 <br>Surat yang menurut undang-undang harus
dibuat tertulis meliputi tetapi tidak terbatas
pada surat berharga, surat yang berharga,
dan surat yang digunakan dalam proses
penegakan hukum acara perdata, pidana, dan
administrasi negara. 

</li>
<li>PASAL 6 <br> Dalam hal terdapat ketentuan lain selain yang
diatur dalam Pasal 5 ayat (4) yang mensyaratkan
bahwa suatu informasi harus berbentuk tertulis
atau asli, Informasi Elektronik dan/atau Dokumen
Elektronik dianggap sah sepanjang informasi yang
tercantum di dalamnya dapat diakses, ditampilkan,
dijamin keutuhannya, dan dapat
dipertanggungjawabkan sehingga menerangkan
suatu keadaan. </li>
<li>PASAL 7 <br>Setiap Orang yang menyatakan hak, memperkuat
hak yang telah ada, atau menolak hak Orang lain
berdasarkan adanya Informasi Elektronik dan/atau
Dokumen Elektronik harus memastikan bahwa
Informasi Elektronik dan/atau Dokumen
Elektronik yang ada padanya berasal dari Sistem
Elektronik yang memenuhi syarat berdasarkan
Peraturan Perundang-undangan.  </li>
</ul>



</div></div>
</div>
</div>
</div>


