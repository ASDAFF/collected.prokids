/*
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

var CollectJS_JSPParentSelector = '.scrollp';
var CollectJS_JSPScrollSelector = '.scroll';
var CollectJS_JSPAllChildrensSelector = '.scrollinner';
var CollectJS_JSPOneChildrenSelector = '.scrollitem';
var CollectJS_JSPButtonsSelector = '.scrollbtn';
var CollectJS_SimpleScrollScrollSpeed = 500;

(function($){
    $.fn.hasScrollBarY = function(){
        var divnode = this.get(0);
        if(divnode.scrollHeight>divnode.clientHeight)
            return true;
    }
	 $.fn.hasScrollBarX = function(){
        var divnode = this.get(0);
        if(divnode.scrollWidth>divnode.clientWidth)
            return true;
    }
})(jQuery);

function CollectJS_JSPInit(selector)
{
	var $scroll = $(selector);
	if( $scroll.length>0 )
	{
		$scroll.parents(CollectJS_JSPParentSelector).addClass('jsp');
		$scroll.jScrollPane({animateScroll:true,mouseWheelSpeed:30,verticalGutter:0});
		$scroll.each(function(i){
			if( $(this).hasClass('jspScrollable') )
			{
				$(this).parents(CollectJS_JSPParentSelector).addClass('jspHasScroll');
			}
		});
	}
}
function CollectJS_JSPReinit(selector,needDestroy)
{
	var $scroll = $(selector);
	if( $scroll.length>0 )
	{
		if( $scroll.parents(CollectJS_JSPParentSelector).hasClass('horizontal') )
		{
			var count=0,elemWidth=0;
			$scroll.each(function(i){
				count = $(this).find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).length;
				elemWidth = $(this).find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).filter(':first').outerWidth(true);
				$(this).find(CollectJS_JSPAllChildrensSelector).css({width:(count*elemWidth)+'px'});
			});
		}
		if( needDestroy )
		{
			$scroll.data('jsp').destroy();
			CollectJS_JSPInit(selector);
		} else {
			var pane2api;
			setTimeout(function(){ // fix for slow shit
				$scroll.parents(CollectJS_JSPParentSelector).removeClass('jspHasScroll');
				$scroll.each(function(i){
					pane2api = $(this).data('jsp');
					pane2api.reinitialise();
					if( $(this).hasClass('jspScrollable') )
					{
						$(this).parents(CollectJS_JSPParentSelector).addClass('jspHasScroll');
					}
				});
			},50);
		}
	}
}

function CollectJS_SimpleScrollInit(selector)
{
	var $scroll = $(selector);
	if( $scroll.length>0 )
	{
		var count=0,elemWidth=0;
		if( $scroll.parents(CollectJS_JSPParentSelector).hasClass('horizontal') )
		{
			$scroll.each(function(i){
				count = $(this).find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).length;
				elemSize = $(this).find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).filter(':first').outerWidth(true);
				$(this).css({overflowX:'auto',overflowY:'hidden'}).find(CollectJS_JSPAllChildrensSelector).css({width:(count*elemSize)+'px'});
				if( $(this).hasScrollBarX() )
				{
					$(this).parents(CollectJS_JSPParentSelector).addClass('jspHasScroll');
				}
			});
		} else {
			$scroll.each(function(i){
				count = $(this).find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).length;
				elemSize = $(this).find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).filter(':first').outerHeight(true);
				//$(this).css({overflowX:'hidden',overflowY:'auto'}).find(CollectJS_JSPAllChildrensSelector).css({width:(count*elemSize)+'px'});
				if( $(this).hasScrollBarY() )
				{
					$(this).parents(CollectJS_JSPParentSelector).addClass('jspHasScroll');
				}
			});
		}
		$scroll.parents(CollectJS_JSPParentSelector).addClass('simple');
	}
}
function CollectJS_SimpleScrollReinit(selector)
{
	$(selector).each(function(i){
		if( $(this).hasScrollBarY() )
		{
			$(this).parents(CollectJS_JSPParentSelector).addClass('jspHasScroll');
		}
	});
}

function CollectJS_ScrollInit(selector)
{
	if(CollectDevLib_PHONETABLET) // this is tablet or phone
	{
		// init
		CollectJS_SimpleScrollInit(selector);
	} else { // this is PC
		// init
		CollectJS_JSPInit(selector);
	}
}
function CollectJS_ScrollReinit(selector,needDestroy)
{
	if(CollectDevLib_PHONETABLET) // this is tablet or phone
	{
		// reinit
		CollectJS_SimpleScrollReinit(selector);
	} else {
		// reinit
		CollectJS_JSPReinit(selector,needDestroy);
	}
}
function CollectJS_ScrollPressButton($btn)
{
	var $scroll = $btn.parents(CollectJS_JSPParentSelector).find(CollectJS_JSPScrollSelector);
	if( $btn.parents(CollectJS_JSPParentSelector).hasClass('horizontal') )
	{
		var elemSize = $scroll.find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).filter(':first').outerWidth(true);
	} else {
		var elemSize = $scroll.find(CollectJS_JSPAllChildrensSelector).find(CollectJS_JSPOneChildrenSelector).filter(':first').outerHeight(true);
	}
	if( $btn.parents(CollectJS_JSPParentSelector).hasClass('horizontal') && $btn.hasClass('prev') && $btn.parents(CollectJS_JSPParentSelector).hasClass('jsp') )
	{
		$scroll.data('jsp').scrollByX( -(elemSize) );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('horizontal') && $btn.hasClass('prev') && $btn.parents(CollectJS_JSPParentSelector).hasClass('simple') )
	{
		$scroll.stop().scrollTo( {top:'+=0px',left:'-='+(elemSize)}, CollectJS_SimpleScrollScrollSpeed );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('horizontal') && $btn.hasClass('next') && $btn.parents(CollectJS_JSPParentSelector).hasClass('jsp') )
	{
		$scroll.data('jsp').scrollByX( (elemSize) );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('horizontal') && $btn.hasClass('next') && $btn.parents(CollectJS_JSPParentSelector).hasClass('simple') )
	{
		$scroll.stop().scrollTo( {top:'+=0px',left:'+='+(elemSize)}, CollectJS_SimpleScrollScrollSpeed );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('vertical') && $btn.hasClass('prev') && $btn.parents(CollectJS_JSPParentSelector).hasClass('jsp') )
	{
		$scroll.data('jsp').scrollByY( -(elemSize) );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('vertical') && $btn.hasClass('prev') && $btn.parents(CollectJS_JSPParentSelector).hasClass('simple') )
	{
		$scroll.stop().scrollTo( {top:'-='+(elemSize),left:'+=0px'}, CollectJS_SimpleScrollScrollSpeed );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('vertical') && $btn.hasClass('next') && $btn.parents(CollectJS_JSPParentSelector).hasClass('jsp') )
	{
		$scroll.data('jsp').scrollByY( (elemSize) );
	} else if( $btn.parents(CollectJS_JSPParentSelector).hasClass('vertical') && $btn.hasClass('next') && $btn.parents(CollectJS_JSPParentSelector).hasClass('simple') )
	{
		$scroll.stop().scrollTo( {top:'+='+(elemSize),left:'+=0px'}, CollectJS_SimpleScrollScrollSpeed );
	}
}
function CollectJS_ScrollGoToElement($element)
{
	var $scroll = $element.parents(CollectJS_JSPParentSelector).find(CollectJS_JSPScrollSelector);
	if( $element.parents(CollectJS_JSPParentSelector).hasClass('jsp') )
	{
		$scroll.data('jsp').scrollToElement( $element, false );
	} else if( $element.parents(CollectJS_JSPParentSelector).hasClass('simple') ) {
		$scroll.stop().scrollTo( $element, CollectJS_SimpleScrollScrollSpeed );
	}
}


$(document).ready(function(){
	
	// press button
	$(document).on('click',CollectJS_JSPParentSelector+' '+CollectJS_JSPButtonsSelector,function(){
		var $btn = $(this);
		if( $btn.parents(CollectJS_JSPParentSelector).length>0 )
		{
			CollectJS_ScrollPressButton($btn);
		}
		return false;
	});
	
});