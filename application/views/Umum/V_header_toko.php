<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-71848071-1"></script>

<meta name="google-site-verification" content="gBU3MkXDsnk78GEqIJPO4zyPzSSw7IPQVKMSSr7olC4" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="title" content="Penerbit Online Indonesia - Guepedia">
<meta name="description" content="Jembatan bagi penulis-penulis yang ingin menerbitkan karya tanpa mengeluarkan biaya sepeserpun dan Penerbit Buku Online yang Berikan Banyak Keuntungan Bagi Penulis">
<meta name="keywords" content="<?php  $query = $this->db->get('seo'); 
foreach ($query->result_array() as $seo){
echo $seo['kata_kunci'].",";
}
?>">
<title>Penerbit Online Indonesia - Guepedia </title>
<link rel="icon" href="<?php echo base_url('assets/img/ico.jpg'); ?>" type="image/ico" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable') ?>/dataTables.bootstrap4.min.css">
<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/swal/animate.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/nprogress/nprogress.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/nprogress/nprogress.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/swal/dist/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/datatable') ?>/jquery.dataTables.min.js" type="text/javascript" language="javascript" ></script>
<script  src="<?php echo base_url('assets/datatable') ?>/dataTables.bootstrap4.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/elevatezoom/jquery.elevatezoom.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/chart/dist/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/daterange/daterangepicker.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/daterange/daterangepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/jquery.lazy/lazyload.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery/simple.money.format.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/slick/slick.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/slick/slick-theme.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/slick/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slick/slick.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/css/custom_guepedia.css" rel="stylesheet" type="text/css"/>
</head>

<script type="text/javascript">
$(document).ajaxStart(function(){
NProgress.start();
$("#loading_bayar").show();
});

$(document).ajaxComplete(function(){
NProgress.done();
NProgress.remove();
$("#loading_bayar").hide();
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
var $q = function(q, res){
if (document.querySelectorAll) {
res = document.querySelectorAll(q);
} else {
var d=document
, a=d.styleSheets[0] || d.createStyleSheet();
a.addRule(q,'f:b');
for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
l[b].currentStyle.f && c.push(l[b]);

a.removeRule(0);
res = c;
}
return res;
}
, addEventListener = function(evt, fn){
window.addEventListener
? this.addEventListener(evt, fn, false)
: (window.attachEvent)
? this.attachEvent('on' + evt, fn)
: this['on' + evt] = fn;
}
, _has = function(obj, key) {
return Object.prototype.hasOwnProperty.call(obj, key);
}
;

function loadImage (el, fn) {
var img = new Image()
, src = el.getAttribute('data-src');
img.onload = function() {
if (!! el.parent)
el.parent.replaceChild(img, el)
else
el.src = src;

fn? fn() : null;
}
img.src = src;
}

function elementInViewport(el) {
var rect = el.getBoundingClientRect()

return (
rect.top    >= 0
&& rect.left   >= 0
&& rect.top <= (window.innerHeight || document.documentElement.clientHeight)
)
}

var images = new Array()
, query = $q('img.lazyload')
, processScroll = function(){
for (var i = 0; i < images.length; i++) {
if (elementInViewport(images[i])) {
loadImage(images[i], function () {
images.splice(i, i);
});
}
};
}
;
// Array.prototype.slice.call is not callable under our lovely IE8
for (var i = 0; i < query.length; i++) {
images.push(query[i]);
};

processScroll();
addEventListener('scroll',processScroll);

});
</script>    


