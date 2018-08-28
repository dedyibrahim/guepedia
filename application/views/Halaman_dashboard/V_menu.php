<body class="bg_dashboard">
<nav class="navbar navbar-expand-lg"style="background-color:#2c3e50; color:#fff; border-bottom:4px solid #fff;  ">
<a class="navbar-brand" href="<?php echo base_url('G_dashboard') ?>"><img style="height:30px; " src="<?php echo base_url() ?>assets/img/logo.png" alt=""/></a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav mr-auto">
<li class="nav-item"><b><?php echo $this->session->userdata('nama_lengkap'); ?></b></li>    
</ul>
<div class="form-inline my-2 my-lg-0">
<a href="<?php echo base_url('G_dashboard/logout') ?>"><button type="button" class="btn  btn-warning" > Keluar <span class="fa fa-sign-out"></span></button></a>
</div>
</div>
</nav>
<div class="container" style="background-color:#eee; border-radius:0px 0px  10px 10px; border-bottom:4px solid  #2c3e50;">
<ul class="menu_penulis">
<li class="text-center"><a href="<?php echo base_url('G_dashboard'); ?>">Kategori <span class="fa fa-book fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('G_dashboard/pengaturan_toko'); ?>">Toko <span class="fa fa-gears fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('G_dashboard/data_file_naskah'); ?>">File Naskah <span class="fa fa-download fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('G_dashboard/halaman_publish'); ?>">Halaman Publish <span class="fa fa-bookmark-o fa-3x"></span></a></li>   
<li class="text-center"><a href="">Laporan Penjualan <span class="fa fa-bar-chart-o fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('G_dashboard/penulis'); ?>">Penulis <span class="fa fa-users fa-3x"></span></a></li>   
<li class="text-center"><a href="<?php echo base_url('G_dashboard/user'); ?>">User <span class="fa fa-user fa-3x"></span></a></li>   
 </ul> 
</div>

<div class="container" style="background-color:#eee; border-radius:5px;  margin-top:1%;  ">

<div class="row">
<div class="col " style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff;   ">
<span class="fa fa-shopping-cart fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Item</h3><br>
<div class="text-center">0</div>
</div>
<div class="col" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff; ">
<span class="fa fa-money fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Total Profit</h3><br>
<div class="text-center">0</div>
</div> 
<div class="col" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff;  ">
<span class="fa fa-magic fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Total Royalti</h3><br>
<div class="text-center">0</div>
</div> 
<div class="col" style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff; ">
<span class="fa fa-book fa-4x " style="position:absolute; "> </span>
<h3 class="text-right">Naskah</h3><br>
<div class="text-center">0</div>
</div>
</div>

</div>   

