<body onload="halaman_checkout()"></body>
<div id="halaman_checkout"></div>
<script type="text/javascript">
function halaman_checkout(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
$.ajax({
type:"POST",
url:"<?php echo base_url('Store/halaman_checkout') ?>",
data:"token="+token,
success:function(data){
$("#halaman_checkout").html(data);    
}
});
    
}

$(document).ready(function(){

$("#bayar").click(function(){
var <?php echo $this->security->get_csrf_token_name();?>    = "<?php echo $this->security->get_csrf_hash(); ?>";   
var metode_pembayaran = $("#metode_pembayaran").val();    
$.ajax({
type:"POST",
url :"<?php echo base_url('Store/bayar') ?>",
data:"token="+token+"&metode_pembayaran="+metode_pembayaran,
success:function(data){
if(data == "berhasil"){    
swal({
title:"Proses Berhasil", 
text:"untuk tahap selanjutnya silahkan anda melakukan konfirmasi pembayaran",
type:"success",
showConfirmButton: true,
}).then(function() {
window.location.href = "<?php echo base_url('Store/konfirmasi_pembayaran') ?>";
});
}else{
    
swal({
title:"", 
text:data,
type:"error",
showConfirmButton: true,
});

}
}

});
});
});

</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Masukan Kode kupon Atau Promo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Kupon </label>
          <input type="text" class="form-control" id="kupon" value="" placeholder="Kode kupon . . . " >
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="tambah_kupon">Tambahkan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="metode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Plih Metode pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Metode pembayaran</label>
          <select id="metode_pembayaran" class="form-control">
              <option>Bank Transfer</option>
              <option>Cash On Delivery</option>
          </select>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary form-control" id="bayar">Bayar <span class="fa fa-money"></span></button>
      </div>
    </div>
  </div>
</div>