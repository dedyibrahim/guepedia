
<div class="container"style="margin-top:7%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($kategori->result_array() as $kate ){ ?>
<a style="text-decoration:none;" href="<?php echo base_url('Store/lihat_buku/'.base64_encode($kate['id_file_naskah'])) ?>">    

<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
    <img  class="card-img-top cover lazyload" src="<?php echo base_url('assets/img/load.gif') ?>"  data-src="<?php echo base_url('uploads/file_cover/'.$kate['file_cover']) ?>"  alt="">
<div class="card-body">
<p class="card-text" style="height:50px;  color:#2c3e50; text-align: center;"><?php echo $kate['judul'] ?></p>
</div>
</a>

</div>
</div>
<?php } ?>
</div>    

<?php 
echo "<hr>";
echo $this->pagination->create_links();
?>
<div class="clearfix"></div>  
</div>
