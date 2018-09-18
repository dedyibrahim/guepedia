<body onload="keranjang_total()" ></body>
<div class="container " style="background-color: #fff; margin-top: 6.5%;">
<h4 align="center"><span class="fa fa-shopping-basket fa-3x fa-color"></span><br>Keranjang Belanja Anda</h4><hr> 
<div id="keranjang_total"></div>  
</div>
<script type="text/javascript">
function update_qty_keranjang(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
var qty = $("#qty"+id).val(); 
$.ajax({
type:"POST",
url:"<?php echo base_url('Store/update_qty_keranjang') ?>",
data:"token="+token+"&id="+id+"&qty="+qty,    
success:function(data){
keranjang_total();    
}
});
}
function keranjang_total(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/keranjang_total') ?>",
data:"token="+token,    
success:function(data){
$("#keranjang_total").html(data);    
}
});

}

function hapus_cart(id){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"   
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/hapus_cart') ?>",
data:"token="+token+"&id="+id,    
success:function(){
keranjang_total();    

}
});
}
</script>