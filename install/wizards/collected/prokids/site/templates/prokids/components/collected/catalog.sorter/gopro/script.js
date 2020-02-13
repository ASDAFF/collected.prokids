function CollectProSorterGo(ajaxpagesid,$obj,url,isBigdata) {
	if($obj) {
		var catalog_selector = '#'+ajaxpagesid;
		CollectJS_Area2Darken($(catalog_selector),'animashka');
		$obj.parent().find('a').removeClass('selected');
		$obj.addClass('selected');
		var val = $obj.html();
		if( $obj.parents('.dropdown').find('.select').length>0 ) {
			$obj.parents('.dropdown').find('.select').html(val);
		}
		if(isBigdata!='Y' && url && url!='') {
			$.getJSON(url, {}, function(json){
				CollectJS_PutJSon( json,false,ajaxpagesid );
				setTimeout(function(){
					CollectJS_ScrollInit('.prices_jscrollpane');
					CollectJS_TIMER();
					CollectJS_SetSet();
				},75); // for slow shit
			}).fail(function(json){
				console.warn( 'sorter - change template -> error responsed' );
			}).always(function(){
				CollectJS_Area2Darken($(catalog_selector),'animashka');
			});
		}
	}
}

$(document).ready(function(){
	
	// ajax sorter -> change (click link)
	$(document).on('click','.catalogsorter .template a, .catalogsorter .output .cool .dropdownin a, .catalogsorter .sort .cool .dropdownin a',function(){
		var $link = $(this);
		if( $link.parents('.catalogsorter').length>0 ) {
			var ajaxpagesid = $link.parents('.catalogsorter').data('ajaxpagesid');
			if( ajaxpagesid && ajaxpagesid!='' ) {
				if( $link.parents('.js-bigdata').length>0 ) { // big data
					console.log( 'sorter - bigdata' );
					CollectProSorterGo(ajaxpagesid,$link,'','Y');
					var $jsBigdata = $link.parents('.js-bigdata');
					BX.ajax({
						url: $jsBigdata.data('url'),
						method: 'POST',
						data: {'parameters':$jsBigdata.data('parameters'), 'template':$jsBigdata.data('template'), 'rcm':'yes', 'view':$link.data('fvalue')},
						dataType: 'html',
						processData: false,
						start: true,
						onsuccess: function (html) {
							var ob = BX.processHTML(html);
							// inject
							BX($jsBigdata.data('injectId')).innerHTML = ob.HTML;
							BX.ajax.processScripts(ob.SCRIPT);
							CollectJS_ScrollInit('.prices_jscrollpane');
							CollectJS_Area2Darken($('#'+ajaxpagesid),'animashka');
							CollectJS_TIMER();
							CollectJS_SetSet();
						}
					});

				} else { // normal components
					var url = $link.attr('href') + '&AJAX_CALL=Y&sorterchange='+ajaxpagesid;
					CollectProSorterGo(ajaxpagesid,$link,url,'N');
					if( $link.parents('.dropdown').length>0 ) {
						$link.parents('.dropdown').removeClass('hover');
					}
				}
			}
		}
		return false;
	});
	
	$(document).on('mouseenter','.catalogsorter .dropdown',function(){
		$(this).addClass('hover');
		return false;
	}).on('mouseleave','.catalogsorter .dropdown',function(){
		$(this).removeClass('hover');
		return false;
	}).on('click','.catalogsorter .dropdown',function(){
		$(this).toggleClass('hover');
		return false;
	});
	
	$('.mix .catalogsorter').addClass('used');
	
});