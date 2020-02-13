var CollectJS_Hider_called = false;

function CollectJS_DetectTable() {
	$('.artables').each(function(i){
		var $artables = $(this);
		if($artables.outerWidth(true)<$artables.find('.products').outerWidth(true) && !$artables.hasClass('adap'))
		{
			$artables.addClass('adap');
		}
	});
}

// hide filter and sorter when goods is empty
function CollectJS_Hider() {
	CollectJS_Hider_called = true;
	$('.sidebar, .mix, .navi, .catalogsorter').hide();
	$('.catalog .prods').css('marginLeft','0px');
}

$(document).ready(function(){
	
	// fix tables if stupid styles didnt work
	CollectJS_DetectTable();
	$(window).resize(function(){
		CollectJS_DetectTable();
	});
	
	if( $('.prices_jscrollpane').length>0 ) {
		CollectJS_ScrollInit('.prices_jscrollpane');
		$(window).resize(function(){
			CollectJS_ScrollReinit('.prices_jscrollpane');
		});
	}
	
	$(document).on('mouseenter','.showcase .js-element',function(){
		$(this).addClass('hover');
		return false;
	}).on('mouseleave','.showcase .js-element',function(){
		$(this).removeClass('hover');
		return false;
	});
	
	if(CollectJS_Hider_called) {
		CollectJS_Hider();
	}
	
});