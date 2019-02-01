<body class="bg_dashboard_admin">
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#2c3e50; color:#fff; border-bottom:4px solid #fff;  ">
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


<div class="container card mt-2 p-2" >
<div class="row" style="text-align: center;">
<div class="col"  ><a style="text-decoration:none;  color: #2c3e50;" href="<?php echo base_url('G_dashboard'); ?>"><span class="fa fa-book fa-3x"></span><br> Kategori</a></div>        
<div class="col"><a style="text-decoration:none;  color: #2c3e50;" href="<?php echo base_url('G_dashboard/orderan_masuk'); ?>"> <span class="fa fa-gears fa-3x"></span><br> Pengaturan Toko</a></div>  
<div class="col"><a style="text-decoration:none;  color: #2c3e50;" href="<?php echo base_url('G_dashboard/data_file_naskah'); ?>"> <span class="fa fa-download fa-3x"></span><br> File Naskah</a></div>   
<div class="col"><a style="text-decoration:none;  color: #2c3e50;" href="<?php echo base_url('G_dashboard/halaman_publish'); ?>"> <span class="fa fa-bookmark-o fa-3x"></span><br> Halaman Publish</a></div>    
<div class="col"><a style="text-decoration:none;  color: #2c3e50;" href="<?php echo base_url('G_dashboard/laporan_penjualan'); ?>"> <span class="fa fa-bar-chart-o fa-3x"></span><br> Laporan </a></div>   
<div class="col"><a style="text-decoration:none;  color: #2c3e50;"  href="<?php echo base_url('G_dashboard/penarikan'); ?>"><span class="fa fa-exchange fa-3x"></span><br> Penarikan</a></div>   
<div class="col"><a style="text-decoration:none;  color: #2c3e50;" href="<?php echo base_url('G_dashboard/user'); ?>"> <span class="fa fa-user fa-3x"></span><br> User</a></div>   
</div>
</div>
<?php if($this->session->userdata('level') == 'Super Admin'){ ?>
<div class="container " >

<div class="row">
<div class="col  rounded" style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff;   ">
<span class="fa fa-shopping-cart fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Buku terjual  di <br><?php echo date('F') ?></h5><br>
<div class="text-center"><?php 
$awal  = date('Y-m-d',strtotime("first day of this month"));
$akhir = date('Y-m-d',strtotime("last day of this month"));


$this->db->select('*');
$this->db->where('data_penjualan.tanggal_transaksi >=',$awal);
$this->db->where('data_penjualan.tanggal_transaksi <=',$akhir);
$this->db->from('data_penjualan');
$this->db->join('data_jumlah_penjualan', 'data_jumlah_penjualan.no_invoices = data_penjualan.no_invoices');
$query2 = $this->db->get()->num_rows() ;
echo $query2;        
        ?></div>
</div>
<div class="col rounded" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff; ">
<span class="fa fa-money fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Keuntungan di<br><?php echo date('F') ?> </h5><br>
<div class="text-center">Rp. <?php

$this->db->from('data_penjualan');
$this->db->where('tanggal_transaksi >=',$awal);
$this->db->where('tanggal_transaksi <=',$akhir);

$query =  $this->db->get();

$total_bersih = 0;
foreach ($query->result_array() as $bersih ){
$total_bersih +=$bersih['total_bersih'];   
}
echo number_format($total_bersih);
?>
</div>
</div> 
<div class="col rounded" style="background-color: #2c3e50; margin:1%; padding:1%; color: #fff;  ">
<span class="fa fa-magic fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Bagi Hasil</h5><br>
<div class="text-center">Rp. <?php $query =  $this->db->get_where('akun_penulis',array('royalti_diperoleh !='=>'0'));
$royalti = 0;
foreach ($query->result_array() as $bersih ){
$royalti +=$bersih['royalti_diperoleh'];   
}
echo number_format($royalti);
?></div>
</div> 
<div class="col rounded" style="background-color: #2c3e50; margin:1%; padding:1%;  color: #fff; ">
<span class="fa fa-book fa-4x " style="position:absolute; "> </span>
<h5 class="text-right">Naskah terpublish</h5><br>
<div class="text-center"><?php echo $this->db->get_where('file_naskah_penulis',array('status'=>'Publish'))->num_rows() ?></div>
</div>
</div>

</div>
<?php } ?>

