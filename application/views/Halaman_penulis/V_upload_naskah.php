
<div class="container" style="margin-top:1%; margin-bottom:1%;  ">
<div class="row">    
<div class="col" style="background-color: #eee; padding:1%; ">
<h4 align="center"> Upload Naskah <?php echo $this->session->userdata('nama_lengkap') ?></h4><hr>
<p>Jika Anda mengalami kesulitan saat upload file naskah Anda. Anda bisa mengirimkan naskah Anda melalaui email ke <strong> info@guepedia.com</strong></p>
<p>Pastikan naskah yang Anda kirim sudah sesuai dengan template guepedia.<br></p>
<p align="center"><button id="download_tamplate" class="btn btn-success">Download Tamplate <span class="fa fa-download"></span></button></p>

</div>


<div class="col-md-6" style="background-color: #eee; margin-left: 1%;  padding:1%; ">
<h4  class="text-center">Form upload </h4>
<hr>   
<label>Judul :</label>
<input type="text" id="judul" placeholder="Judul . . ." value="" class="form-control"  data-toggle="tooltip" title="Judul Buku yang ditulis">
<label>Penulis :</label>
<input type="text" id="penulis" placeholder="Penulis . . ."  value="<?php echo $this->session->userdata('nama_lengkap'); ?>" class="form-control" data-toggle="tooltip" title="Nama Penulis ">

<label>Sinopsis :</label>
<textarea id="sinopsis" rows="5" placeholder="Sinopsis . . ." value="" class="form-control" data-toggle="tooltip" title="Untuk dibelakang Buku dan untuk Promosi"></textarea>
<label>Kategori :</label>
<select class="form-control" id="kategori" data-toggle="tooltip" title="Kategori Buku">
<?php 
foreach ($kategori->result_array() as $kate){
echo "<option value=".$kate['id_kategori_naskah'].">".$kate['nama_kategori']."</option>";    
}
?>   
</select>
<label>File Naskah :</label><br>
<input type="file" id="file_naskah" name="file_naskah" value="" placeholder="File Naskah . . ." data-toggle="tooltip" title="Note : Naskah utama,Daftar Isi,Kata Pengantar,Sinopsis, Dijadikan satu Dan hannya Menerima Dalam bentuk Microsoft Word (.docx)"><br>
<label>File Cover :</label><br>
<input type="file" id="file_cover" name="file_cover" value="" placeholder="FIle Cover . . ."  data-toggle="tooltip" title="Note : Jika ada Dan hannya Menerima Dalam bentuk Photoshop (.PSD)" ><br>

<hr>
<div class="checkbox">
<label>
<input type="checkbox" id="ketentuan"  data-toggle="modal" data-target=".bd-example-modal-lg" value="setuju"  > Saya menyetujui dan mematuhi <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><strong><u>syarat dan ketentuan </u></strong></a> ( Perjanjian Guepedia dan Penulis ) dari guepedia.com<br>
Jika Anda sudah memberikan centang pada pernyataan di atas, kami anggap Anda sudah membaca dan memahami segala syarat dan ketentuan yang diberlakukan di guepedia.com, dan ini  sebagai dokumen sah perjanjian
antara Guepedia dan Penulis.
</label>
</div>
<hr>
<button class="btn btn-success float-right" id="btn_upload" > Upload <span class="fa fa-upload"></span></button>
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
text:"Upload Naskah Berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis/upload_naskah')  ?>';
});
} else{

swal({
title:"", 
html :data,
type :"error",
showConfirmButton: true
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis/upload_naskah')  ?>';
});

}
}


});


}else{
swal({
title:"", 
text:"Syarat dan ketentuan Belum di pilih.",
type:"warning",
showConfirmButton: true,
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

$(document).ready(function(){

$("#download_tamplate").click(function(){
window.location="<?php echo base_url('Halaman_penulis/download_tamplate'); ?>"

});



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