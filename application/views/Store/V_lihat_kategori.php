<div class="container"style="margin-top:7%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($kategori->result_array() as $kate ){ ?>
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
    <img class="card-img-top" style="max-height:185px;" src="<?php echo base_url('uploads/file_cover/'.$kate['file_cover']) ?>" alt="">
<div class="card-body" >
<p class="card-text" style="height:50px; text-align: center;"><?php echo $kate['judul'] ?></p>
</div>
<hr>
<h5 align="center"><b>Rp.<?php echo number_format($kate['harga']) ?></b></h5>    
<div class="card-footer">
<a href="#" class="btn btn-success fa-color col">Beli <span class="fa fa-shopping-basket"></span></a>
</div>
</div>
</div>
<?php } ?>
</div>    
</div>