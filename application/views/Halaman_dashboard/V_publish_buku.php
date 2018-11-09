
<div class="container" style="background-color:#fff; margin-top:1%; ">
    <div class="clearfix"></div><hr>

<h4 align="center">Publish Buku <span class="fa fa-bookmark-o"></span></h4><hr>
<div class="clearfix"></div>

<div class="row">
<div class="col-md-6">
<label>Id Account:</label>
<input type="text" disabled="" id="id_account" value="" class="form-control" >


<label>Email Penulis:</label>
<input type="text" disabled="" id="email_penulis" value="" class="form-control" >

<label>Penulis:</label>
<input type="text" id="penulis" value="" class="form-control" placeholder="Penulis . . .">

<label>Judul :</label>
<input type="text" id="judul" value="" class="form-control" placeholder="Judul Buku . . .">

<label>Harga :</label>
<input type="text" id="harga" value="" class="form-control" placeholder="Harga Buku . . .">

<label>Berat :</label>
<input type="text" id="berat" value="" class="form-control" placeholder="Berat Buku . . .">

<label>Jumlah Lembar :</label>
<input type="text" id="jumlah_lembar" value="" class="form-control" placeholder="Jumlah Lembar. . .">

</div>
    
<div class="col">
<label>Status :</label>
<select class="form-control" id="status" value="" placeholder="Status Buku . . ."><option>Pending</option>  <option>Proses</option> <option>Publish</option></select>

<label>Kategori :</label>
<select id="kategori" value="" class="form-control">
<?php foreach ($kategori->result_array() as $kategori){ ?>
    <option value="<?php echo $kategori['id_kategori_naskah'] ?>"><?php echo $kategori['nama_kategori'] ?></option>
 <?php } ?>    
</select>

<label>Sinopsis :</label>
<textarea   id="sinopsis" value="" rows="7" class="form-control"></textarea>
<label>File Cover :</label>
<input type="file" id="file_cover" name="file_cover" value="" class="form-control">
</div> 
</div>
<hr>
<button class="btn btn-success float-right" id="btn_publish">Publish Buku <span class="fa fa-save"></span></button>
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
<script>
CKEDITOR.replace( 'sinopsis' );
</script>
<script type="text/javascript">
$("#btn_publish").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
var file_cover    = $("#file_cover").val();
var judul         = $("#judul").val();
var penulis       = $("#penulis").val();
var harga         = $("#harga").val();
var berat         = $("#berat").val();
var status        = $("#status").val();
var kategori      = $("#kategori").val();
var data_sinopsis = CKEDITOR.instances.sinopsis.getData();

var id_account    = $("#id_account").val();
var jumlah_lembar = $("#jumlah_lembar").val();
if(file_cover !='' && judul !='' && penulis !='' && harga !='' && berat !='' && status !='' && kategori !='' && data_sinopsis !='' && id_account !='' && jumlah_lembar !=''){

var fileCover = $('#file_cover')[0];
var formData = new FormData();

$.each(fileCover.files, function(k,file){   
formData.append('file_cover',file);
});

formData.append('token',token);
formData.append('judul',judul);
formData.append('harga',harga);
formData.append('berat',berat);
formData.append('status',status);
formData.append('kategori',kategori);
formData.append('penulis',penulis);
formData.append('sinopsis',data_sinopsis);
formData.append('jumlah_lembar',jumlah_lembar);
formData.append('id_account',id_account);


$.ajax({
method: 'POST',
url:"<?php echo base_url('G_dashboard/proses_publish') ?>",
data: formData,
dataType: 'text',
contentType: false,
processData: false,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Publish produk Berhasil",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard/halaman_publish')  ?>';
});

} else{

swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
});

}
}


});



}else{
swal({
title:"", 
text:"Masih ada data yg harus di isi",
type:"error",
showConfirmButton: true,
});      

}

});



</script>    