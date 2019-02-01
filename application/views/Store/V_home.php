<?php

if($buku_diskon->num_rows() >0){  ?>
<div class="container" style="margin-top:1%; margin-bottom: 1%; ">
<div style="width: 100%; height: 20px; border-bottom: 1px solid #2c3e50; text-align: center">
<span style="font-size:25px; background-color: #2c3e50; color:#fff;  padding: 0 10px;">
BUKU DISKON 
</span>
</div>
</div>

<div class="container"style="margin-top:2%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($buku_diskon->result_array() as $diskon ){ ?>
<a style="text-decoration:none;" href="<?php echo base_url('Store/lihat_buku_diskon/'.base64_encode($diskon['id_file_naskah'])) ?>">    
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
<h5><span style="position:absolute;" class="badge m-3 pull-right badge-danger">Diskon <?php echo $diskon['nilai_diskon'] ?> %</span></h5>
<img class="card-img-top cover lazyload"  src="<?php echo base_url('assets/img/load.gif') ?>" data-src="<?php echo base_url('uploads/file_cover/'.$diskon['file_cover']) ?>"  >
<div class="card-body">
<p class="card-text" style="height:50px; color:#2c3e50;  text-align: center;"><?php echo $diskon['judul'] ?></p>
</div>
</a>

</div>
</div>
<?php } ?>
</div>    
</div>
<?php }?>

<?php 

  
if($terlaris->num_rows() >0){  ?>
 
<div class="container" style="margin-top:1%; margin-bottom: 1%; ">
<div style="width: 100%; height: 20px; border-bottom: 1px solid #2c3e50; text-align: center">
<span style="font-size:25px; background-color: #2c3e50; color:#fff;  padding: 0 10px;">
BUKU TERLARIS 
</span>
</div>
</div>

<div class="container"style="margin-top:2%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($terlaris->result_array() as $laris ){ ?>
<a style="text-decoration:none;" href="<?php echo base_url('Store/lihat_buku/'.base64_encode($laris['id_file_naskah'])) ?>">    
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
<img class="card-img-top cover lazyload"  src="<?php echo base_url('assets/img/load.gif') ?>" data-src="<?php echo base_url('uploads/file_cover/'.$laris['file_cover']) ?>"  >
<div class="card-body">
<p class="card-text" style="height:50px; color:#2c3e50;  text-align: center;"><?php echo $laris['judul'] ?></p>
</div>
</a>

</div>
</div>
<?php } ?>
</div>    
</div>

<?php } ?>
<div class="container-fluid" style="
padding-top: 80px !important;
padding-bottom: 60px !important; 
background-image:url(<?php echo base_url('assets/img/bg_jadi_penulis.jpg') ?>)  !important;">
<h3 align="center"  style="color:#fff;">Bergabung dengan ratusan penulis lainnya dan publikasikan <br> buku kamu di Guepedia.com  </h3>
<div class="text-center">
<h2 align="center"  style="color:#fff;" >Buku Terpublish <br><span class="timer count-title count-number" data-to="<?php echo $total_buku->num_rows() ?>" data-speed="2000"></span> </h2>      
</div>
<h2 align="center"><a href="<?php echo base_url('penulis') ?>"><button class="btn btn-success">Bergabung Menjadi Penulis <span class="fa fa-angle-right"></span> </button></a></h2>
</div>



<div class="container" style="margin-top:1%; margin-bottom: 1%; ">
<div style="width: 100%; height: 20px; border-bottom: 1px solid #2c3e50; text-align: center">
<span style="font-size:25px; background-color: #2c3e50; color:#fff;  padding: 0 10px;">
BARU TERBIT
</span>
</div>
</div>

<div class="container" style="margin-top:2%; margin-bottom: 1%; ">
<div class="row">
<?php foreach ($baru_terbit->result_array() as $new_book ){ ?>
<a style="text-decoration:none;" href="<?php echo base_url('Store/lihat_buku/'.base64_encode($new_book['id_file_naskah'])) ?>">    
<div class="col-lg-3 col-md-6 mb-4">
<div class="card">
    
    <h5><span style="position:absolute;" class="badge m-3 pull-right badge-success">Buku baru terbit</span></h5>
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


<script type="text/javascript">
(function ($) {
$.fn.countTo = function (options) {
options = options || {};

return $(this).each(function () {

var settings = $.extend({}, $.fn.countTo.defaults, {
from:            $(this).data('from'),
to:              $(this).data('to'),
speed:           $(this).data('speed'),
refreshInterval: $(this).data('refresh-interval'),
decimals:        $(this).data('decimals')
}, options);

var loops = Math.ceil(settings.speed / settings.refreshInterval),
increment = (settings.to - settings.from) / loops;

var self = this,
$self = $(this),
loopCount = 0,
value = settings.from,
data = $self.data('countTo') || {};

$self.data('countTo', data);

// if an existing interval can be found, clear it first
if (data.interval) {
clearInterval(data.interval);
}
data.interval = setInterval(updateTimer, settings.refreshInterval);

// initialize the element with the starting value
render(value);

function updateTimer() {
value += increment;
loopCount++;

render(value);

if (typeof(settings.onUpdate) == 'function') {
        settings.onUpdate.call(self, value);
}

if (loopCount >= loops) {
        // remove the interval
        $self.removeData('countTo');
        clearInterval(data.interval);
        value = settings.to;

        if (typeof(settings.onComplete) == 'function') {
                settings.onComplete.call(self, value);
        }
}
}

function render(value) {
var formattedValue = settings.formatter.call(self, value, settings);
$self.html(formattedValue);
}
});
};

$.fn.countTo.defaults = {
from: 0,               // the number the element should start at
to: 0,                 // the number the element should end at
speed: 1000,           // how long it should take to count between the target numbers
refreshInterval: 100,  // how often the element should be updated
decimals: 0,           // the number of decimal places to show
formatter: formatter,  // handler for formatting the value before rendering
onUpdate: null,        // callback method for every time the element is updated
onComplete: null       // callback method for when the element finishes updating
};

function formatter(value, settings) {
return value.toFixed(settings.decimals);
}
}(jQuery));

jQuery(function ($) {
// custom formatting example
$('.count-number').data('countToOptions', {
formatter: function (value, options) {
return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
}
});

// start all the timers
$('.timer').each(count);  

function count(options) {
var $this = $(this);
options = $.extend({}, options || {}, $this.data('countToOptions') || {});
$this.countTo(options);
}
});
</script>