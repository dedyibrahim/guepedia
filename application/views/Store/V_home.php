<div class="container" style="margin-top:1%; margin-bottom: 1%; ">
<div style="width: 100%; height: 20px; border-bottom: 1px solid #2c3e50; text-align: center">
<span style="font-size:25px; background-color: #2c3e50; color:#fff;  padding: 0 10px;">
BUKU TERLARIS
</span>
</div>
</div>

<div class="container"style="margin-top:2%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($terlaris->result_array() as $laris ){ ?>
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
<img class="card-img-top" style="max-height:185px;" src="<?php echo base_url('uploads/file_cover/'.$laris['file_cover']) ?>" alt="">
<div class="card-body" >
<p class="card-text" style="height:50px; text-align: center;"><?php echo $laris['judul'] ?></p>
</div>
<hr>
<h5 align="center"><b>Rp.<?php echo number_format($laris['harga']) ?></b></h5>    
<div class="card-footer">
<a href="#" class="btn btn-success fa-color col">Beli <span class="fa fa-shopping-basket"></span></a>
</div>
</div>
</div>
<?php } ?>
</div>    
</div>

<div class="container-fluid" style="
padding-top: 90px !important;
padding-bottom: 70px !important; 
background-image:url(<?php echo base_url('assets/img/bg_jadi_penulis.jpg') ?>) !important;">
<h3 align="center"  style="color:#fff;">Bergabung dengan ratusan penulis lainnya dan publikasikan <br> buku kamu di Guepedia.com  </h3>
<h2 align="center"><a href="<?php echo base_url('penulis') ?>"><button class="btn btn-success">Bergabung Menjadi Penulis <span class="fa fa-angle-right"></span> </button></a></h2>
</div>





<div class="container" style="margin-top:1%; margin-bottom: 1%; ">
<div style="width: 100%; height: 20px; border-bottom: 1px solid #2c3e50; text-align: center">
<span style="font-size:25px; background-color: #2c3e50; color:#fff;  padding: 0 10px;">
BARU TERBIT
</span>
</div>
</div>

<div class="container"style="margin-top:2%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($baru_terbit->result_array() as $new_book ){ ?>
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
<img class="card-img-top" style="max-height:185px;" src="<?php echo base_url('uploads/file_cover/'.$new_book['file_cover']) ?>" alt="">
<div class="card-body" >
<p class="card-text" style="height:50px; text-align: center;"><?php echo $new_book['judul'] ?></p>
</div>
<hr>
<h5 align="center"><b>Rp.<?php echo number_format($new_book['harga']) ?></b></h5>    
<div class="card-footer">
<a href="#" class="btn btn-success fa-color col">Beli <span class="fa fa-shopping-basket"></span></a>
</div>
</div>
</div>
<?php } ?>
</div>    
</div>
