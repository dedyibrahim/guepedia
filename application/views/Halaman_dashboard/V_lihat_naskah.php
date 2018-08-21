<?php $data = $data_naskah->row_array() ?>
<div class="container">
<div class="row" style=" background-color:#fff;  padding:1%; margin-top:1%; margin-bottom:1%;   ">    
<div class="col" >
<h4 align="center">Lihat Naskah </h4>
<hr>
<label>Judul :</label>
<input type="text" id="judul"   placeholder="Judul . . ." value="<?php echo $data['judul'] ?>" class="form-control">
<label>Penulis :</label>
<input type="text" id="penulis"  placeholder="Penulis . . ."  value="<?php echo $data['penulis'] ?>" class="form-control">
<label>Sinopsis :</label>
<textarea id="sinopsis"  placeholder="Sinopsis . . ." value="" class="form-control"><?php echo $data['sinopsis'] ?></textarea>
<label>Kategori :</label>
<input type="text" id="kategori"   placeholder="Judul Kategori . . " value="<?php echo $data['nama_kategori'] ?>" class="form-control">
<label>Status: </label>
<select class="form-control">
    <option>Proses</option>    
    <option>Publish</option>    
</select>

<hr>
<button class="btn btn-success float-right">Update <span class="fa fa-save"></span></button>
</div>
<div class="col-md-6">
<h4 align="center">File Naskah Dan File Cover</h4>
<hr>
<h5 align='center'>Download File Naskah</h5>
<button class="btn btn-success form-control">Download Naskah <span class="fa fa-download"></span></button>
<hr>
<h5 align='center'>Download File Cover</h5>
<?php if($data['file_cover'] != NULL){ ?>
<button class="btn btn-success form-control">Download Cover <span class="fa fa-download"></span></button>
<?php }else{ ?>
<h5 align='center' style="color:#d14"> File Cover Tidak Tersedia</h5>
<?php } ?>
<hr>

</div> 

</div>   
</div>
