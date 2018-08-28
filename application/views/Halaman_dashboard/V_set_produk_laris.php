<div class="container" style="background-color: #fff;  padding:1%; margin-bottom:1%; " >
    <div class="row">
        <div class="col-md-6">
            <h4 align="center">Set produk laris</h4><hr>
            <label>Cari Buku :</label>
            <input type="hidden" class="form-control" id="id_file_naskah" >
            <input type="text" class="form-control" id="cari_buku" placeholder="Cari Buku. . . ">
            <hr>
            <button class="btn btn-success float-right" id="btn_laris">Set laris <span class="fa fa-save"></span></button>
            
            
        </div>
        
        <div class="col">
         <h4 align="center">Data Produk laris</h4><hr>
         <table class="table table-striped table-condensed table-bordered">
             <tr><th>No</th><th>Judul</th><th>Aksi</th></tr>
             <?php $no =1; 
             foreach ($produk_laris->result_array() as $laris){
             ?>
             <tr>
                 <td><?php echo $no++ ?></td>
                 <td><?php echo $laris['judul'] ?></td>
                 <td>
                     <a href="<?php echo base_url('G_dashboard/hapus_terlaris/'. base64_encode($laris['id_file_naskah'])); ?>"    <button class="btn btn-danger"><span class="fa fa-trash"></span></button></a>
                 </td>
             </tr>
             
             <?php } ?>
         </table>     
        </div>
    </div>    
</div>
<script type="text/javascript">
$(function () {
$("#cari_buku").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('G_dashboard/cari_buku') ?>',
select:function(event, ui){
$('#id_file_naskah').val(ui.item.id_file_naskah);
$('#cari_buku').val(ui.item.judul);
}
}
);
});


$("#btn_laris").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"  ;     
var cari_buku = $("#cari_buku").val();
var id_file_naskah = $("#id_file_naskah").val();
if(cari_buku !=''){

$.ajax({
type:"POST",
url:"<?php echo base_url('G_dashboard/set_laris') ?>",
data:"token="+token+"&id_file_naskah="+id_file_naskah,
success:function(data){
if(data == "berhasil"){
swal({
title:"", 
text:"Set laris berhasil",
timer:2000,
icon:"success",
button:false,
}).then(function(){
location.href = '<?php echo base_url('G_dashboard/pengaturan_toko')  ?>';
});  
    
}else{

swal({
title:"", 
text:data,
timer:2000,
icon:"error",
button:false,
});   
    
    
}    
    
}
    
    
});


  
}else{
    
swal({
title:"", 
text:"Buku belum terpilih",
timer:2000,
icon:"error",
button:false,
});

}

});


</script>