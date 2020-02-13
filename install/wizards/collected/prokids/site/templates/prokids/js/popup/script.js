/*
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

var CollectJS_PopupPrefix = 'rsgppopup_',
	CollectJS_DivsLeft = '<div class="outer"><div class="inner">',
	CollectJS_DivsRight = '</div></div>',
	CollectJS_ParentsObj;

function CollectJS_OnOfferChangePopup($elementObj) {
	var finedOfferID = $elementObj.find('.js-add2basketpid').val();
	var element_id = $elementObj.data('elementid');
	if(finedOfferID>0) {
		// image
		if( CollectJS_OFFERS[element_id].OFFERS[finedOfferID].IMAGES[0].src && 
			CollectJS_OFFERS[element_id].OFFERS[finedOfferID].IMAGES[0].src.indexOf("collected_devlibrary_nophoto") < 0 &&
			$elementObj.find('.pic img').length>0 ) {
			$elementObj.find('.pic img').attr('src', CollectJS_OFFERS[element_id].OFFERS[finedOfferID].IMAGES[0].src );
		}
	}
}

function CollectProPricesJScrollPaneReinitialize() {
	setTimeout(function(){ // fix for slow shit
		var pane2api;
		$('.prs_jscrollpane').parents('.prices').removeClass('jspHasScroll');
		$('.prs_jscrollpane').each(function(i){
			pane2api = $(this).data('jsp');
			pane2api.reinitialise();
			if( $(this).hasClass('jspScrollable') ) {
				$(this).parents('.prices').addClass('jspHasScroll');
			}
		});
	},50);
}

function CollectJS_FixPreviewText(element_id) {
	var max_h1 = 350;
	var line_h = 18;
	var h1 = $('#'+CollectJS_PopupPrefix+element_id).find('.block.right').outerHeight(true);
	if( h1!=null ) {
		if( h1>max_h1 ) {
			var $text = $('#'+CollectJS_PopupPrefix+element_id).find('.description').find('.text');
			var res = Math.floor( ($text.outerHeight(true)-(h1-max_h1))/line_h )*line_h;
			$text.css('maxHeight',res+'px');
		}
	}
}

function CollectJS_GoPopup(element_id,$parentsObj) {
	element_id = parseInt( element_id );
	CollectJS_ParentsObj = $parentsObj;
	if(element_id>0) {
		if( $('#'+CollectJS_PopupPrefix+element_id).length>0 ) {
			CollectJS_ShowPopup(element_id);
		} else {
			CollectJS_AddPopup(element_id);
		}
	} else {
		console.warn( 'GoPopup: element_id is empty' );
	}
}

function CollectJS_ShowPopup(element_id) {
	CollectJS_ChangePosition(element_id);
	$('#'+CollectJS_PopupPrefix+element_id).fadeIn("fast",function() {
		// Animation complete
		CollectJS_FixPreviewText(element_id);
		CollectJS_SetSet();
		//CollectProPricesJScrollPaneReinitialize();
		CollectJS_ScrollReinit('.elementpopupinner .prs_jscrollpane', 1);
	});
}

function CollectJS_HidePopup(element_id) {
	$('#'+CollectJS_PopupPrefix+element_id).fadeOut("fast",function() {
		// Animation complete
	});
}
function CollectJS_ChangePosition(element_id) {
	var $jsPos;
	if( CollectJS_ParentsObj.find('td.name').outerWidth(true) > 5 ) {
		$jsPos = CollectJS_ParentsObj.find('.js-position');
	} else {
		$jsPos = CollectJS_ParentsObj.parents('.artables').find('.js-name'+element_id).find('.js-position');
	}
	var pos_left = $jsPos.position().left + $jsPos.outerWidth(true) + 20; // 20 - td padding
	$('#'+CollectJS_PopupPrefix+element_id).css({'top':$jsPos.position().top+'px','left':pos_left+'px'});
}

function CollectJS_HideAllPopup() {
	$('.rsgppopup:visible').fadeOut("fast",function() {
		// Animation complete
	});
}

function CollectJS_AddPopup(element_id,$parentsObj) {
	var url = SITE_DIR+SITE_CATALOG_PATH+'/?AJAX_CALL=Y&action=rsgppopup&element_id='+element_id+'';
	var html = '<div id="'+CollectJS_PopupPrefix+element_id+'" class="rsgppopup" style="display:none;">'+CollectJS_DivsLeft+'<div class="loading"></div>'+CollectJS_DivsRight+'</div>';
	$('body').append( html );
	CollectJS_ShowPopup(element_id);
	$.ajax({
		url: url
	}).done(function(data){
		$('#'+CollectJS_PopupPrefix+element_id).find('.inner').html( data );
		CollectJS_SetSet();
		CollectJS_FixPreviewText(element_id);
		if( $('.elementpopupinner .prs_jscrollpane').length>0 ) {
			CollectJS_ScrollInit('.elementpopupinner .prs_jscrollpane');
			$(window).resize(function(){
				CollectJS_ScrollReinit('.elementpopupinner .prs_jscrollpane', 1);
			});
		}
	}).fail(function() {
		console.warn( 'Popup: wrong ajax request' );
	});
}

$(document).ready(function(){
	
	// listeners
	$(document).on('keydown',function(e){
		if(e.keyCode==27) { // esc
			CollectJS_HideAllPopup();
		}
	});
	$(document).on('click',function(e){
		if( $(e.target).parents('.rsgppopup').length>0 ) {
			
		} else {
			CollectJS_HideAllPopup();
		}
	});
	
	// window.resize
	$(window).resize(function(){
		CollectJS_HideAllPopup();
	});
	
	// change offer
	$(document).on('CollectProOnOfferChange',function(e,elementObj){
		CollectJS_OnOfferChangePopup(elementObj);
	});
	
});