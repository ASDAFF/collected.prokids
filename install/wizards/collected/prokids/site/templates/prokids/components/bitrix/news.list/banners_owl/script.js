$(document).ready(function(){
	if(parseInt(CollectJS_change_speed)<1) {
		CollectJS_change_speed = 2000;
	}
	if(parseInt(CollectJS_change_delay)<0) {
		CollectJS_change_delay = 8000;
	}
	
	if($('#owl_slider1').find('.item').length>1) {
		$('#owl_slider1').owlCarousel({
			items				: 1,
			loop				: true,
			autoplay			: true,
			nav					: true,
			navText				: ['<span><i class="icon pngicons"></i></span>','<span><i class="icon pngicons"></i></span>'],
			navClass			: ['owl-prev', 'owl-next'],
			autoplaySpeed		: CollectJS_change_speed,
			autoplayTimeout		: CollectJS_change_delay,
			smartSpeed			: CollectJS_change_speed
		});
	}
	
	// play video
	$('.aroundowlslider1').find('video').each(function(){
		if( $(this).attr('autoplay')=='autoplay' ) {
			$(this).get(0).play();
		}
	});
	
});