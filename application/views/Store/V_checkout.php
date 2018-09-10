<div class="container" style="background-color: #fff; margin-top: 6.5%;">
<h4 align="center"><span class="fa fa-list-ul fa-3x fa-color"></span><br>Checkout</h4><hr> 
<div class="row">
<div class="col-md-4">
<h4 align="center"><span class="fa fa-truck fa-3x fa-color"></span><br>Alamat pengiriman</h4><hr> 
<label>Nama kota</label>
<input type="text" class="form-control" id="nama_kota">
<input type="hidden" id="city_id" class="form-control" id="city_id">

<div id="data_kecamatan"></div>    


<label>Nama Provinsi</label>
<input type="text" readonly=""  class="form-control" id="nama_provinsi">

<label>Kode pos</label>
<input type="text" readonly="" class="form-control" id="kode_pos">

<label>Nama Kurir</label>
<select class="form-control" id="kurir" onchange="cek_cost();">
<option ></option>    
<option value="jne">JNE</option>    
<option value="wahana">WAHANA</option>    
</select>
<div id="data_kost">
    
</div>
</div>
</div>
<hr>
</div>

<script type="text/javascript">
$(function () {
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   

$("#nama_kota").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Store/cari_kota') ?>',
select:function(event, ui){
$('#nama_provinsi').val(ui.item.province);
$('#kode_pos').val(ui.item.postal_code);
$('#city_id').val(ui.item.city_id);

$.ajax({
type:"POST",
url:"<?php echo base_url('Store/data_kecamatan') ?>",
data:"token="+token+"&city_id="+ui.item.city_id,
success:function(data){
$("#data_kecamatan").html(data);    
}

});
}

}
);
});

function cek_cost(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var city_id        = $("#city_id").val();
var subdistrict_id = $("#subdistrict_id  option:selected").val();
var kurir          = $("#kurir  option:selected").val();

if(city_id !='' && subdistrict_id !=''){

$.ajax({
type:"post",
url:"<?php echo base_url('Store/cost_checkout') ?>",
data:"token="+token+"&city_id="+city_id+"&subdistrict_id="+subdistrict_id+"&kurir="+kurir,
success:function(data){
$("#data_kost").html(data);   

}


});

}else{
swal({
title:"", 
text:"Masih ada data yang harus di isi",
type:"error",
showConfirmButton: true,
});    

}

}
</script>