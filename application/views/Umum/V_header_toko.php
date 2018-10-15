<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-71848071-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-71848071-1');
</script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="title" content="Publisher Online Indonesia - Guepedia">
<meta name="description" content="Jembatan bagi penulis-penulis yang ingin menerbitkan karya tanpa mengeluarkan biaya sepeserpun dan Penerbit Buku Online yang Berikan Banyak Keuntungan Bagi Penulis">
<meta name="keywords" content="<?php  $query = $this->db->get('seo'); 
foreach ($query->result_array() as $seo){
echo $seo['kata_kunci'].",";
}
?>">
<title>Guepedia</title>
<link rel="icon" href="<?php echo base_url('assets/img/ico.jpg'); ?>" type="image/ico" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable') ?>/dataTables.bootstrap4.min.css">
<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/css/custom_guepedia.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/swal/animate.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>assets/nprogress/nprogress.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/nprogress/nprogress.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url(); ?>assets/swal/dist/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('assets/datatable') ?>/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('assets/datatable') ?>/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/elevatezoom/jquery.elevatezoom.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/chart/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/chart/dist/Chart.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/daterange/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/daterange/daterangepicker.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/daterange/daterangepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/jquery.lazy/jquery.lazy.js" type="text/javascript"></script>
</head>

<script type="text/javascript">
$(document).ajaxStart(function(){
NProgress.start();
});

$(document).ajaxComplete(function(){
NProgress.done();
NProgress.remove();
});

$(function () {
$('[data-toggle="tooltip"]').tooltip();
});
$(function () {
$('[data-toggle="popover"]').popover();
});
</script>

<script type="text/javascript">
 $(function() {
        $('.lazy').lazy({
          effect: "fadeIn",
          effectTime: 200000,
          threshold: 0
        });
    });
    </script>