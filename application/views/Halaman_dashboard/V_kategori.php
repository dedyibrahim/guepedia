<div class="container" style="margin-top:1%; margin-bottom:1%; ">
<div class="row">
<div class="col" style="background-color:#eee; padding: 1%;">
<h4 align="center">Buat Kategori <span class="fa fa-list-alt"></span></h4>
<hr>
<div class="form-group">
<label>Buat Kategori :</label>    
<input type="text" class="form-control" id="nama_kategori" placeholder="Nama kategori . . "><br>
<button class="fa fa-save btn btn-success float-right" id="btn_kategori"> Simpan</button>
<div class="clearfix"></div><hr>  
</div>

</div>
<div class="col-md-7" style="background-color:#eee; margin-left:1%;  padding:1%;  ">
<h4 align="center">Data Kategori <span class="fa fa-list"></span></h4><hr>
<table class="table table-bordered table-condensed table-striped table-sm table-hover">
<tr>
<th>No</th>
<th>Nama Kategori</th>
<th>Jumlah Buku</th>
<th>Aksi</th>
</tr>    
<?php $no=1; foreach ($nama_kategori->result_array() as $kategori){ 

$jumlah_buku = $this->db->get_where('file_naskah_penulis',array('id_kategori_naskah'=>$kategori['id_kategori_naskah']))->num_rows();
?>


<tr>
<td><?php echo $no++ ?></td>
<td><?php echo $kategori['nama_kategori'] ?></td>
<td><?php echo $jumlah_buku ?></td>
<td align="center"><a href="<?php echo base_url('G_dashboard/lihat_kategori/'.base64_encode($kategori['id_kategori_naskah']).'') ?>"><button class="btn btn-success btn-sm"><span class="fa fa-eye"></span></button></a> <a href="<?php echo base_url('G_dashboard/hapus_kategori/'.base64_encode($kategori['id_kategori']).'') ?>"><button class="btn btn-danger btn-sm"><span class="fa fa-close"></span></button></a></td>
</tr>


<?php } ?>
<tr><td colspan="2" >Total Naskah</td> <td colspan="2"  ><?php echo $jumlah_naskah->num_rows() ?></td></tr>    
</table>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#btn_kategori").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";       
var nama_kategori = $("#nama_kategori").val();

if(nama_kategori !=''){
$.ajax({

type:"POST",
url:"<?php echo base_url('G_dashboard/simpan_kategori') ?>",
data:"token="+token+"&nama_kategori="+nama_kategori,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Kategori berhasil di buat",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = '<?php echo base_url('G_dashboard') ?>';
});     

}    

}


});
}else{    
swal({
title:"", 
text:"Kategori belum dibuat",
icon:"error",
timer:1500,
button:false,
})
}

});    
});

</script>