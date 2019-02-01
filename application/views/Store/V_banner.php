
<div class="batas_header">
<div class="hero-slider">
<?php 
$query = $this->db->get('banner');
foreach ( $query->result_array() as $data){ ?>
    <div><img class=" w-100 lazyload " src="<?php echo base_url('uploads/banner/'.$data['nama_banner']) ?>" alt=""></div>

<?php } ?>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
$('.hero-slider').slick({
dots: true,
focusOnSelect: true,
autoplay: true,
draggable: true,
autoplaySpeed: 6000,
infinite: true,
pauseOnHover: false,
swipeToSlide: true,
arrows: true,
accessibility: true,
prevArrow: '<button type=\'button\' class=\'prevArrow\'><i class=\'fa fa-arrow-circle-left\'></i></button>',
nextArrow: '<button type=\'button\' class=\'nextArrow\'><i class=\'fa fa-arrow-circle-right\'></i></button>'

});
});</script>
