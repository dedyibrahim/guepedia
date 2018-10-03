<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="<?php echo base_url('assets/img/ico.jpg'); ?>" type="image/ico" />

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Guepedia</title>
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
  $('[data-toggle="tooltip"]').tooltip()
})
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
<div class="loading" id="loading"></div>