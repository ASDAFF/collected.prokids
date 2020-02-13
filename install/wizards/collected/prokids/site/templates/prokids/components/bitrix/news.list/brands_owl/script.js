$(document).ready(function(){
	if(parseInt(CollectJS_change_speed_brands)<1) {
		CollectJS_change_speed_brands = 2000;
	}
	if(parseInt(CollectJS_change_delay_brands)<0) {
		CollectJS_change_delay_brands = 8000;
	}
	
	if($('#owl_brandslist1').find('.item').length>1) {
		$('#owl_brandslist1').owlCarousel({
			loop 			: true,
			autoplay		: true,
			margin 			: 20,
			nav 			: true,
			navText			: ['<span><i class="icon pngicons"></i></span>','<span><i class="icon pngicons"></i></span>'],
			navClass		: ['owl-prev', 'owl-next'],
			dots			: false,
			responsive:{
				0: {
					items 	: 2
				},
				600: {
					items 	: 3
				},
				800: {
					items 	: 4
				},
				1000: {
					items 	: 5
				},
				1200: {
					items 	: 6
				}
			},
			autoplaySpeed		: CollectJS_change_speed_brands,
			autoplayTimeout		: CollectJS_change_delay_brands,
			smartSpeed			: CollectJS_change_speed_brands
		});
	}
	
});