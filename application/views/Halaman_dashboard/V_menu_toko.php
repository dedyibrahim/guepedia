<div class="container card" style=" border-radius:5px;    ">
<div class="row">

<div class="col rounded " style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff;   ">
<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/orderan_masuk') ?>">
<span class="fa fa-shopping-basket fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Orderan Masuk</h5><br>
<div class="text-center"><?php echo $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'pending'))->num_rows() ?></div>
</a>
</div>

<div class="col rounded" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff; ">
<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/orderan_proses') ?>">
<span class="fa fa-print fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Orderan di bayar</h5><br>
<div class="text-center"><?php echo $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'proses'))->num_rows() ?></div>
</a></div>

<div class="col rounded" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff;  ">
<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/orderan_terima') ?>"><span class="fa fa-truck fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Orderan di terima</h5><br>
<div class="text-center"><?php echo $this->db->get_where('data_jumlah_penjualan_toko',array('status'=>'terima'))->num_rows() ?></div>
</a></div>

<div class="col rounded" style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff; ">
<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/orderan_selesai') ?>"><span class="fa fa-check-square-o fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Orderan selesai</h5><br>
<div class="text-center"><?php 
$this->db->where('status','selesai');
$this->db->or_where('status','tolak');
$this->db->or_where('status','expired');
$this->db->from('data_jumlah_penjualan_toko');
$query = $this->db->get();
echo $query->num_rows();
?></div>
</a></div>

</div>

</div> 
<div class="container" style=" padding:1%;  color: #fff;   ">
<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/produk_diskon') ?>">
    <button class="btn btn-guepedia">Set produk diskon <span class="fa fa-percent"></span></button>    
</a>
    
    

<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/promo_kupon') ?>">
    <button class="btn btn-guepedia">Kode Promo dan Kupon <span class="fa fa-plus-circle"></span></button>    
</a>

<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/input_seo') ?>">
    <button class="btn btn-guepedia">Input SEO <span class="fa fa-plus-circle"></span></button>    
</a>


<a style="text-decoration: none; color: #fff;" href="<?php echo base_url('G_dashboard/banner') ?>">
    <button class="btn btn-guepedia">Banner <span class="fa fa-paperclip"></span></button>    
</a>    
</div>

