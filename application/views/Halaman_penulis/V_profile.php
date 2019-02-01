<?php $akun = $data_akun->row_array();  $static = $data_akun->row_array();?>

<div class="container">
       
<div class="row">
<div class="col card m-2 p-2">
<h4 align="center"> <span class="fa fa-user fa-2x fa_color"></span><br> My Profile</h4><hr>
<label>Nama lengkap :</label>
<input type="text" class="form-control" id="nama_lengkap" readonly="" value="<?php echo $akun['nama_lengkap'] ?>">
<label>Nama Pena :</label>
<input type="text" class="form-control" id="nama_pena" readonly="" value="<?php echo $akun['nama_pena'] ?>">
<label>Nomor kontak :</label>
<input type="text" class="form-control" id="nomor_kontak" readonly="" value="<?php echo $akun['nomor_kontak'] ?>">
<label>Alamat lengkap :</label>
<textarea class="form-control" id="alamat_lengkap" readonly=""><?php echo $akun['alamat_lengkap'] ?></textarea>
<label>Email :</label>
<input type="text" class="form-control" id="email" readonly="" value="<?php echo $akun['email'] ?>">
<hr>
<button class="form-control btn btn-warning" id="btn_edit">Edit <span class="fa fa-edit"></span></button>
<button class="form-control btn btn-success" style="display: none;" id="btn_update">Update <span class="fa fa-save"></span></button>

</div>
    
<div class="col-md-6 card m-2 p-2">
<h4 align="center">  <span class="fa fa-money fa_color fa-2x"></span><br>  Data akun Bank</h4>
<hr>
<?php   if($static['id_bank'] == NULL ){ ?>
<label>Nama Bank : <br> <i style="color:#ff0000;">Note :</i><span style="font-size:13px;"> Menggunakan Nomor Rekening Selain BCA Akan Dikenakan Biaya Transfer Antar Bank</span>    
</label>
<select class="form-control nama_bank" name="nama_bank" id="nama_bank">
<option value="1">Bank Central Asia (BCA)</option>    
<option value="2">Bank Mandiri</option>    
<option value="3">Bank Negara Indonesia (BNI)</option>    
<option value="4">Bank Rakyat Indonesia (BRI)</option>    
<option value="5">Bank Tabungan Negara (BTN)</option>    
<option value="6">Bank BRI Agroniaga</option>    
<option value="7">Bank Anda</option>    
<option value="8">Bank Artha Graha Internasional</option>    
<option value="9">Bank Bukopin</option>    
<option value="10">Bank Bumi Arta</option>    
<option value="11">Bank Capital Indonesia</option>    
<option value="12">Bank CIMB Niaga</option>    
<option value="13">Bank Danamon Indonesia</option>    
<option value="14">Bank Ekonomi Raharja</option>    
<option value="15">Bank Ganesha</option>    
<option value="16">Bank KEB Hana</option>    
<option value="18">Bank Woori Saudara</option>    
<option value="19">Bank ICBC Indonesia</option>    
<option value="20">Bank Index Selindo</option>    
<option value="21">Bank Maybank Indonesia</option>    
<option value="22">Bank Maspion</option>    
<option value="23">Bank Mayapada</option>    
<option value="24">Bank Mega</option>
<option value="25">Bank Mestika Dharma</option>    
<option value="26">Bank Shinhan Indonesia</option>    
<option value="27">Bank MNC Internasional</option>    
<option value="28">Bank J Trust Indonesia</option>    
<option value="29">Bank Nusantara Parahyangan</option>    
<option value="30">Bank OCBC NISP</option>    
<option value="31">Bank of India Indonesia</option>    
<option value="32">Panin Bank</option>    
<option value="33">Bank Permata</option>    
<option value="34">Bank QNB Indonesia</option>    
<option value="35">Bank SBI Indonesia</option>    
<option value="36">Bank UOB Indonesia</option>    
<option value="37">Amar Bank Indonesia</option>    
<option value="38">Bank Andara</option>    
<option value="39">Bank Artos Indonesia</option>    
<option value="40">Bank Bisnis Internasional</option>    
<option value="41">Bank Tabungan Pensiunan Nasional</option>    
<option value="42">Bank Sahabat Sampoerna</option>    
<option value="43">Bank Fama Internasional</option>    
<option value="44">Bank Harda Internasional</option>    
<option value="45">Bank Mayora</option>    
<option value="46">Bank Mitraniaga</option>    
<option value="47">Bank Multi Arta Sentosa</option>    
<option value="48">Bank Pundi Indonesia</option>    
<option value="49">Bank Royal Indonesia</option>    
<option value="50">Bank Mandiri Taspen Pos</option>    
<option value="51">Bank Yudha Bhakti</option>    
<option value="52">Bank Jambi</option>    
<option value="53">Bank Bengkulu</option>    
<option value="54">Bank Sumsel Babel</option>    
<option value="55">Bank Lampung</option>    
<option value="56">Bank DKI</option>    
<option value="57">Bank BJB</option>    
<option value="58">Bank Jateng</option>    
<option value="59">Bank BPD DIY</option>    
<option value="60">Bank Jatim</option>    
<option value="61">Bank ANZ Indonesia</option>    
<option value="62">Bank Commonwealth</option>    
<option value="62">Bank Agris</option>    
<option value="63">Bank Capital Indonesia</option>    
<option value="64">Bank Rabobank International Indonesia</option>    
<option value="65">Citibank</option>    
<option value="66">HSBC</option>    
<option value="67">Bank Mega Syariah</option>    
<option value="68">Bank Muamalat Indonesia</option>    
<option value="69">Bank Syariah Mandiri</option>    
<option value="70">BCA Syariah</option>    
<option value="71">Bank BJB Syariah</option>    
<option value="72">Bank BRI Syariah</option>    
<option value="73">Panin Bank Syariah</option>    
<option value="74">Bank Syariah Bukopin</option>    
<option value="75">Bank Victoria Syariah</option>    
<option value="76">BTPN Syariah</option>    
<option value="77">Bank Maybank Syariah Indonesia</option>    
<option value="78">Bank BTN Syariah</option>    
<option value="79">Bank Danamon Syariah</option>    
<option value="80">CIMB Niaga Syariah</option>    
<option value="81">BII Syariah</option>    
<option value="82">OCBC NISP Syariah</option>    
<option value="83">Bank Permata Syariah</option>    
<option value="84">Bank DKI Syariah</option>    
<option value="85">Bank Kalbar Syariah</option>    
<option value="86">Bank Kalsel Syariah</option>    
<option value="87">Bank NTB Syariah</option>    
<option value="88">Bank Riau Kepri Syariah</option>    
<option value="89">Bank Sumsel Babel Syariah</option>    
<option value="90">Bank Syariah Mandiri</option>    
<option value="91">Bank Rakyat Indonesia Simpedes</option>    
<option value="92">Bank Negara Indonesia (BNI) Syariah</option>    
</select>

<label>Nama Pemilik Rekening :</label>
<input type="text" name="nama_pemilik_rekening" id="nama_pemilik_rekening" value="" class="form-control">
<label>Nomor Rekening:</label>
<input type="text" name="nomor_rekening" id="nomor_rekening" value="" class="form-control">

<div class="checkbox">
<label>
<input type="checkbox" id="ketentuan"  data-toggle="modal" data-target=".bd-example-modal-lg" value="setuju"  > Saya menyetujui dan mematuhi <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><strong><u>syarat dan ketentuan </u></strong></a> ( Perjanjian Guepedia dan Penulis ) dari guepedia.com<br>
Jika Anda sudah memberikan centang pada pernyataan di atas, kami anggap Anda sudah membaca dan memahami segala syarat dan ketentuan yang diberlakukan di guepedia.com, dan ini  sebagai dokumen sah perjanjian
antara Guepedia dan Penulis.
</label>
</div>
<hr>
<button class="btn btn-success" id="perbaharui">Simpan Rekening <span class="fa fa-save"></span></button>

<?php }else{ ?>
<label>Nama bank :</label>
<input type="text" class="form-control" readonly="" value="<?php echo $static['nama_bank'] ?>">
<label>Nama pemilik rekening :</label>
<input type="text" class="form-control" readonly="" value="<?php echo $static['nama_pemilik_rekening'] ?>" >

<label>Nomor rekening :</label>
<input type="text" class="form-control" readonly="" value="<?php echo $static['nomor_rekening'] ?>" >

<hr>
<a href="<?php echo base_url('Halaman_penulis/edit_rekening') ?>"><button class="btn btn-warning form-control" >Edit Rekening <span class="fa fa-edit"></span></button></a>

<?php } ?>
</div>  

</div>   


</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_edit").click(function(){
$("#nama_lengkap").attr("readonly", false);
$("#nomor_kontak").attr("readonly", false);
$("#alamat_lengkap").attr("readonly", false);
$("#nama_pena").attr("readonly", false);
$("#email").attr("readonly", false);

$("#btn_edit").hide(); 
$("#btn_update").show(); 
});  

$("#btn_update").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   

var nama_lengkap  = $("#nama_lengkap").val();
var nama_pena     = $("#nama_pena").val();
var nomor_kontak  = $("#nomor_kontak").val();
var alamat_lengkap= $("#alamat_lengkap").val();
var email         = $("#email").val();

$.ajax({
type:"POST",
url:"<?php echo base_url('Halaman_penulis/update_penulis') ?>",
data:"token="+token+"&nama_pena="+nama_pena+"&nama_lengkap="+nama_lengkap+"&nomor_kontak="+nomor_kontak+"&alamat_lengkap="+alamat_lengkap+"&email="+email,
success:function(data){
    
if(data == 'berhasil'){
swal({
title:"", 
text:"Update profile berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis') ?>';
});      

}

}
});

});


});



</script>    
</body>


<script type="text/javascript">
$(document).ready(function() {
$("#perbaharui").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>"   
var pemilik_rekening = $("#nama_pemilik_rekening").val(); 
var nomor_rekening   = $("#nomor_rekening").val();
var nama_bank        = $("#nama_bank option:selected").text();
var setuju           = $("#ketentuan:checked").val();
var id_bank          = $("#nama_bank option:selected").val();

if (pemilik_rekening != '' && nomor_rekening !='' && nama_bank !=''){

if(setuju == "setuju"){   
$.ajax({
type:"POST",
url:"<?php echo base_url('Halaman_penulis/simpan_rekening') ?>",
data:"token="+token+"&pemilik_rekening="+pemilik_rekening+"&nomor_rekening="+nomor_rekening+"&nama_bank="+nama_bank+"&id_bank="+id_bank,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Rekening berhasil tersimpan",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('Halaman_penulis') ?>';
});     

}else{
swal({
title:"", 
text:"Server error",
type:"error",
showConfirmButton: true,
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
text:"Data rekening harus di isi semua",
type:"warning",
showConfirmButton: true,
});    

}



});   
});

</script>
<script type="text/javascript">
$(document).ready(function() {


$('.nama_bank').select2({
theme: "bootstrap"
});
});

</script>
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


<ul>
<li>dengan ini saya menyatakan rekening yang saya isikan ini benar dan sah merupakan rekening untuk bagi hasil dari guepedia.</li> 
<li>saya menyatakan bahwa selama saya belum merubah rekening rekening saya,maka rekening yang sebelumnya adalah rekening yang sah untuk menerima hasil.</li>
<li>jika saat ini atau dikemudian hari penulis dikenakan pajak sepenuhnya pajak ditanggung penulis, guepedia tidak bertanggung jawab atas pajak yang dikenakan.</li>
<li>guepedia hannya akan mentransfer kerening yang tercantum di web ini.
</ul>





</div>
</div>
</div>
</div>
</div>