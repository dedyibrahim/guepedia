<?php $lihat = $data->row_array(); ?>
<div class="container" style="margin-top:7% ; margin-bottom:1%;  ">
<div class="row">
<div class="col-md-4 img-thumbnail" style="text-align: center;">    
<img id="zoom_01" class="cover2" src="<?php echo base_url('uploads/file_cover/'.$lihat['file_cover']) ?>"  data-zoom-image="<?php echo base_url('uploads/file_cover/'.$lihat['file_cover']) ?>">
</div>
<div class="col">
<h4><?php echo $lihat['judul'] ?></h4>   
<hr>
<h5>Harga : Rp.<?php echo number_format($lihat['harga']) ?></h5>
<hr>
<h5>Berat : <?php echo $lihat['berat_buku'] ?> Gram</h5>
<hr>
<h5>Penulis : <?php echo $lihat['penulis'] ?></h5>
<hr>
<div class="row">
<div class="col-md-4">
<input placeholder="jumlah . . ." type="text" class="form-control">   
</div>
<div class="col">
<button class="btn btn-success form-control">Beli <span class=" fa fa-shopping-basket"></span></button> 
</div>
</div>
</div>
</div>
</div>


<div class="container" style=" margin-bottom:1%;">

<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link" href="#sinopsis" role="tab" data-toggle="tab">Sinopsis</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#estimasi" role="tab" data-toggle="tab">Estimasi Ongkos kirim</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#ulasan" role="tab" data-toggle="tab">Ulasan</a>
</li>
</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="sinopsis">
<?php echo $lihat['sinopsis']; ?>   
</div>
<div role="tabpanel" class="tab-pane fade" id="estimasi">
...
</div>
<div role="tabpanel" class="tab-pane fade" id="ulasan">
...   
</div>
</div>
</div>



<script type="text/javascript">
$("#zoom_01").elevateZoom();
</script>
