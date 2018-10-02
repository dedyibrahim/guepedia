<body class="bg_dashboard">
<nav class="navbar navbar-expand-lg"style="background-color:#2c3e50; color:#fff; border-bottom:4px solid #fff;  ">
<a class="navbar-brand" href="<?php echo base_url('Halaman_penulis') ?>"><img style="height:30px; " src="<?php echo base_url() ?>assets/img/logo.png" alt=""/></a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav mr-auto">
<li class="nav-item"><b><?php echo $this->session->userdata('nama_lengkap'); ?></b></li>    
</ul>
<div class="form-inline my-2 my-lg-0">
<a href="<?php echo base_url('Halaman_penulis/logout') ?>"><button type="button" class="btn  btn-warning" > Keluar <span class="fa fa-sign-out"></span></button></a>
</div>
</div>
</nav>
<div class="container" style="background-color:#eee; border-radius:0px 0px  10px 10px; border-bottom:4px solid  #2c3e50;">
<ul class="menu_penulis">
<li class="text-center"><a href="<?php echo base_url('Halaman_penulis'); ?>">My Profile <span class="fa fa-user fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('Halaman_penulis/upload_naskah'); ?>">Upload Naskah <span class="fa fa-upload fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('Halaman_penulis/my_project'); ?>">Naskah saya <span class="fa fa-folder-open fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('Halaman_penulis/laporan_penjualan') ?>">Laporan Penjualan <span class="fa fa-bar-chart-o fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('Halaman_penulis/tarik_royalti'); ?>">Bagi hasil <span class="fa fa-money fa-3x"></span></a></li>   
</ul> 
</div>

<div class="container" style="background-color:#eee; border-radius:5px;  margin-top:1%;  ">

<div class="row">
<div class="col " style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff;   ">
<span class="fa fa-shopping-cart fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Item</h3><br>
<div class="text-center"><?php echo $this->db->get_where('data_jumlah_penjualan',array('id_account_penulis'=>$this->session->userdata('id_account')))->num_rows() ?></div>
</div>
<div class="col" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff; ">
<span class="fa fa-money fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Keuntungan</h3><br>
<div class="text-center">Rp. <?php $query =  $this->db->get_where('data_jumlah_penjualan',array('id_account_penulis'=>$this->session->userdata('id_account')));
$total_profit = 0;
foreach ($query->result_array() as $bersih ){
 $total_profit +=$bersih['royalti'];   
}
echo number_format($total_profit); ?></div>
</div> 
<div class="col" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff;  ">
<span class="fa fa-magic fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Bagi Hasil</h3><br>
<div class="text-center">Rp. <?php $rol = $this->db->get_where('akun_penulis',array('id_account'=>$this->session->userdata('id_account')))->row_array();  echo number_format($rol['royalti_diperoleh']);?></div>
</div> 
<div class="col" style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff; ">
<span class="fa fa-book fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Naskah</h3><br>
<div class="text-center"><?php echo $this->db->get_where('file_naskah_penulis',array('id_account'=>$this->session->userdata('id_account')))->num_rows(); ?></div>
</div>
</div>

</div>   

