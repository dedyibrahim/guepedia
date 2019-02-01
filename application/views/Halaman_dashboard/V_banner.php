<div class="container" >
<div class="row  mb-2 p-2">

<div class="col-md-5 card p-2">
<h4 align="center">
<span class="fa-2x fa fa-upload"></span><br>Upload Banner Web  </h4>
<hr>
<form action="<?php echo base_url('G_dashboard/simpan_banner') ?>" method="post" enctype="multipart/form-data">
<label>Banner</label>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
<input type="file" name="banner" class="form-control">
<hr>
<button type="submit" class="btn btn-success">Simpan <span class="fa fa-save"></span></button>
</form>
</div>
<div class="col card ml-1">
<?php foreach ($query->result_array() as $data){ ?>
<div class="row p-2">
<div class="col"><img style=" width: 400px;" src="<?php echo base_url('uploads/banner/'.$data['nama_banner']) ?>"/></div>
<div class="col-md-2 pt-5  text-center">
    <a href="<?php echo base_url('G_dashboard/hapus_banner/'.base64_encode($data['id_banner']).'/'.$data['nama_banner']) ?>">    <button class="btn btn-danger">Hapus <span class="fa fa-close"></span></button></a>
</div>

</div><hr> <?php }?>        
</div>    
</div>
</div>
</div>