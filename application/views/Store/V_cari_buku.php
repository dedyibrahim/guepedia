
<div class="container batas_header">
<div class="row">
<?php foreach ($data->result_array() as $new_book ){ ?>
<a style="text-decoration:none;" href="<?php echo base_url('Store/lihat_buku/'.base64_encode($new_book['id_file_naskah'])) ?>">    
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
<img class="card-img-top cover lazyload"  src="<?php echo base_url('assets/img/load.gif') ?>"   data-src="<?php echo base_url('uploads/file_cover/'.$new_book['file_cover']) ?>" alt="">
<div class="card-body">
<p class="card-text" style="height:50px; color:#2c3e50; text-align: center;"><?php echo $new_book['judul'] ?></p>
</div>
</a>

</div>
</div>

<?php } ?>
</div>    
</div>
