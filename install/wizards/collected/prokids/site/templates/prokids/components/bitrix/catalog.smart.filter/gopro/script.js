/*
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

/***********************************************************************/
/******************************* custom ********************************/
/***********************************************************************/
var CollectJS_tamautID = 0,
	CollectJS_timeoutDelay = 1200,
	CollectJS_inputter,
	CollectJS_modef_delay_hide = 4000,
	CollectJS_modef_posFix = 0;
var CollectJS_filtren,
	CollectJS_offsetTopFilter = 0,
	CollectJS_offsetTopFilterH = 0,
	CollectJS_content,
	CollectJS_offsetTopContent = 0,
	CollectJS_offsetTopContentH = 0;

function CollectJS_priceGoupClick() {
	if( $('.filtren').hasClass('ajaxfilter') ) {
		CollectJS_FilterAjax();
	}
}

function CollectJS_SeachProp($inputObj) {
	var value = $inputObj.val();
	var $lvl1 = $inputObj.parents('.lvl1');
	
	if(value.length<1) {
		$lvl1.find('.lvl2').css('display','block');
	} else {
		$lvl1.find('.lvl2').each(function(){
			var p_value = $(this).find('label').html().substr(0,value.length);
			if( value.toLowerCase()==p_value.toLowerCase() ) {
				$(this).css('display','block');
			} else {
				$(this).css('display','none');
			}
		});
	}
	
	// reinitialize jScrollPane
	if($inputObj.parents('.lvl1').hasClass('scrolable')) {
		CollectJS_FilterJScrollPaneReinitialize();
	}
}

function CollectJS_FilterSetPropHide() {
	// main
	if( $.cookie(BX_COOKIE_PREFIX+'COLLECTPRO_SMARTFILTER_SHOW_ALL')=='Y' ) {
		$('.filtren').addClass('opened');
	}
	// props
	var propcode = '';
	$('.filtren').find('li.lvl1').removeClass('closed');
	$('.filtren').find('li.lvl1').each(function(i){
		propcode = $(this).data('propcode');
		if( $.cookie(BX_COOKIE_PREFIX+'COLLECTPRO_SMARTFILTER_HIDE_'+propcode)=='Y' )
		{
			$(this).addClass('closed');
		}
	});
}

function CollectJS_FilterJScrollPaneReinitialize() {
	var pane2api;
	$('.f_jscrollpane').each(function(i){
		pane2api = $(this).data('jsp');
		pane2api.reinitialise();
	});
}

function CollectJS_BeforeSend(action) {
	if(action=='disable') {
		$('.filtren').find('.min, .max').each(function(i) {
			if( parseFloat($(this).data('startvalue')) == parseFloat($(this).val().replace(/[,]/g, '.').replace(/[ ]+/g, '')) ) {
				$(this).attr('disabled','disabled');
			}
		});
	} else {
		$('.filtren').find('.min, .max').removeAttr('disabled');
	}
}
function CollectJS_ReplaceProbel() {
	$('.filtren').find('.min, .max').each(function(i){
		$(this).val( $(this).val().replace(/[ ]+/g, '') );
	});
}
function CollectJS_ReturnProbel() {
	$('.filtren').find('.min, .max').each(function(i){
		$(this).val( CollectDevLib_NumberFormat( $(this).val() ) );
	});
}

function CollectJS_FixedFilterWinScroll() {
	if( CollectJS_filtren && CollectJS_filtren.length>0 ) {
		CollectJS_offsetTopFilterH = CollectJS_offsetTopFilter + CollectJS_filtren.outerHeight(true);
		CollectJS_offsetTopContentH = CollectJS_content.offset().top + CollectJS_content.outerHeight(true)
		if( window.pageYOffset > CollectJS_offsetTopFilter ) {
			CollectJS_filtren.addClass('fixed');
		} else {
			CollectJS_filtren.removeClass('fixed');
		}
		if( window.pageYOffset + CollectJS_filtren.outerHeight(true) > CollectJS_content.offset().top + CollectJS_content.outerHeight(true) ) {
			CollectJS_filtren.addClass('stop').css('top',(CollectJS_offsetTopContentH - CollectJS_offsetTopFilterH)+'px');
		} else {
			CollectJS_filtren.removeClass('stop').css('top','0px');
		}
	}
}
function CollectJS_FixedFilter() {
	if( CollectJS_filtren && CollectJS_filtren.length>0 ) 	{
		CollectJS_offsetTopFilter = CollectJS_filtren.offset().top;
		CollectJS_offsetTopFilterH = CollectJS_offsetTopFilter + CollectJS_filtren.outerHeight(true);
		CollectJS_offsetTopContent = CollectJS_content.offset().top;
		CollectJS_offsetTopContentH = CollectJS_offsetTopContent + CollectJS_content.outerHeight(true);
		window.onscroll = CollectJS_FixedFilterWinScroll;
	}
}

function CollectJS_FilterAjax() {
	clearTimeout(CollectJS_tamautID);
	CollectJS_tamautID = setTimeout(function(){
		CollectJS_Area2Darken( $('#catalog'), 'animashka' );
		CollectJS_ReplaceProbel();
		CollectJS_BeforeSend('disable');
		var $formObj = $('form.smartfilter');
		var seriData = $formObj.serialize(),
			url = $formObj.attr('action');
		if(url.indexOf("?")<1) 		{
			url = url + '?' + seriData + '&AJAX_CALL=Y&get=catalog&set_filter=Y';
		} else {
			url = url + '&' + seriData + '&AJAX_CALL=Y&get=catalog&set_filter=Y';
		}
		BX.ajax({
			url				: url,
			method			: 'GET',
			dataType		: 'html',
			scriptsRunFirst	: false,
			emulateOnload	: false,
			start			: true,
			cache			: false,
			onsuccess: function(data){
				$('#catalog').html( data );
				CollectJS_ScrollInit('.prices_jscrollpane');
				CollectJS_Area2Darken( $('#catalog') );
				CollectJS_FilterOnDocumentReady();
			},
			onfailure: function(){
				CollectJS_Area2Darken( $('#catalog') );
				CollectJS_FilterOnDocumentReady();
				console.warn( 'FILTER -> ajax load failed' );
			}
		});
	},CollectJS_timeoutDelay);
}

function CollectJS_FilterOnDocumentReady() {
	CollectJS_FilterSetPropHide();
	
	// shiw/hide filter
	$(document).on('click','.filtren .title a.shhi',function(){
		if($('.filtren').hasClass('opened')) { // was opened
			$.removeCookie(BX_COOKIE_PREFIX+'COLLECTPRO_SMARTFILTER_SHOW_ALL');
			$('.filtren').removeClass('opened');
		} else { // was closed
			$.cookie(BX_COOKIE_PREFIX+'COLLECTPRO_SMARTFILTER_SHOW_ALL','Y','/');
			$('.filtren').addClass('opened');
		}
		CollectJS_FilterJScrollPaneReinitialize();
		CollectJS_FixedFilterWinScroll();
		return false;
	});
	
	// shiw/hide property
	$(document).on('click','.filtren .showchild',function(){
		var $li = $(this).parents('li.lvl1');
		var propcode = $li.data('propcode');
		if($li.hasClass('closed')) { // was closed
			$.removeCookie(BX_COOKIE_PREFIX+'COLLECTPRO_SMARTFILTER_HIDE_'+propcode);
			$li.removeClass('closed');
		} else { // was opened
			$.cookie(BX_COOKIE_PREFIX+'COLLECTPRO_SMARTFILTER_HIDE_'+propcode,'Y','/');
			$li.addClass('closed');
		}
		CollectJS_FilterJScrollPaneReinitialize();
		CollectJS_FixedFilterWinScroll();
		return false;
	});
	
	// disable click on disabled property
	$(document).on('click', '.lvl2_disabled input, .lvl2_disabled label', function(e){
		e.stopPropagation();
		return false;
	});
	
	// format number in inputs
	setTimeout(function(){
		CollectJS_ReplaceProbel();
		var timeoutId;
		$('.filtren').find('.min, .max').on('keyup',function(e){
			clearTimeout(timeoutId);
			if( e.which!=8 && e.which!=37 && e.which!=39 && e.which!=191 && e.which!=190 && e.which!=188 ) 		{
				var $input = $(this);
				timeoutId = setTimeout(function(){
					$(this).val( CollectDevLib_NumberFormat( $input.val() ) );
					smartFilter.keyup( BX( $input.attr('id') ) );
				},1500);
			}
		}).each(function(){
			$(this).val( CollectDevLib_NumberFormat($(this).val()) );
		});
	},25); // fix for slow browsers
	
	// jScrollPane
	$('.f_jscrollpane').jScrollPane();
	CollectJS_FilterJScrollPaneReinitialize();
	$(window).resize(function(){
		CollectJS_FilterJScrollPaneReinitialize();
	});
	
	// search
	$(document).on('keyup', '.f_search', function(){
		var $inputObj = $(this);
		CollectJS_SeachProp($inputObj);
	});
	
	// buttons setFilter and resetFilter
	$(document).on('click','.filtren .buttons .set_filter, .filtren .buttons .del_filter',function(){
		CollectJS_BeforeSend('disable');
		CollectJS_ReplaceProbel()
		if($(this).hasClass('set_filter')) 		{
			$("#set_filter").click();
		} else {
			$("#del_filter").click();
		}
		return false;
	});
	
	// modef link click
	$(document).on('click','#modef a',function(){
		CollectJS_BeforeSend('disable');
		CollectJS_ReplaceProbel();
		$("#set_filter").click();
		return false;
	});
	
	// fixed filter on scrolling
	if(!CollectDevLib_PHONETABLET)
	{
		CollectJS_filtren = $('.filtren.filterfixed'),
		CollectJS_offsetTopFilter = 0,
		CollectJS_offsetTopFilterH = 0,
		CollectJS_content = $('.content'),
		CollectJS_offsetTopContent = 0,
		CollectJS_offsetTopContentH = 0;
		
		CollectJS_FixedFilter();
	}
}

function CollectJS_FilterOnSubmitForm() {
	CollectJS_ReplaceProbel();
	CollectJS_BeforeSend('disable');
	return true;
}

/* bitrix */
function JCSmartFilter(ajaxURL)
{
	this.ajaxURL = ajaxURL;
	this.form = null;
	this.timer = null;
}

JCSmartFilter.prototype.keyup = function(input)
{
	if( $('.filtren').hasClass('ajaxfilter') )
	{
		CollectJS_FilterAjax();
	} else {
		if(this.timer)
			clearTimeout(this.timer);
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(input);
		}, this), CollectJS_timeoutDelay);
	}
}

JCSmartFilter.prototype.click = function(checkbox)
{
	if( $('.filtren').hasClass('ajaxfilter') )
	{
		CollectJS_FilterAjax();
	} else {
		if( $(checkbox).is(':checked') )
		{
			$('.filtren').find('label[for="'+$(checkbox).attr('id')+'"]').addClass('checked');
		} else {
			$('.filtren').find('label[for="'+$(checkbox).attr('id')+'"]').removeClass('checked');
		}
		if(this.timer)
			clearTimeout(this.timer);
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(checkbox);
		}, this), CollectJS_timeoutDelay);
	}
}

JCSmartFilter.prototype.reload = function(input)
{
	if(!CollectDevLib_PHONETABLET)
	{
		/* GoPro */
		CollectJS_inputter = input;
		
		var lvl1 = BX.pos(BX.findParent(input, {'tag':'ul'}), true);
		CollectJS_Area2Darken( $(input).closest('.filtren'), 'animashka', {'progressTop': lvl1.top + lvl1.height/2});
		
		this.position = BX.pos(input, true);
		this.form = BX.findParent(input, {'tag':'form'});
		if(this.form)
		{
			CollectJS_ReplaceProbel();
			CollectJS_BeforeSend('disable');
			var values = new Array;
			values[0] = {name: 'ajax', value: 'y'};
			this.gatherInputsValues(values, BX.findChildren(this.form, {'tag':'input'}, true));
			BX.ajax.loadJSON(
				this.ajaxURL,
				this.values2post(values),
				BX.delegate(this.postHandler, this)
			);
			CollectJS_ReturnProbel();
			CollectJS_BeforeSend();
		}
	}
}

JCSmartFilter.prototype.postHandler = function (result)
{
	/* GoPro */
	clearInterval(CollectJS_tamautID);
	CollectJS_Area2Darken( $('.filtren') );
	/* /GoPro */
	if(result.ITEMS)
	{
		for(var PID in result.ITEMS)
		{
			var arItem = result.ITEMS[PID];
			if(arItem.PROPERTY_TYPE == 'N' || arItem.PRICE)
			{
			}
			else if(arItem.VALUES)
			{
				for(var i in arItem.VALUES)
				{
					var ar = arItem.VALUES[i];
					var control = BX(ar.CONTROL_ID);
					if(control)
					{
						control.parentNode.className = ar.DISABLED? 'lvl2 lvl2_disabled': 'lvl2';
					}
				}
			}
		}
		var modef = BX('modef');
		var modef_num = BX('modef_num');
		if(modef && modef_num)
		{
			modef_num.innerHTML = result.ELEMENT_COUNT;
			var hrefFILTER = BX.findChildren(modef, {tag: 'A'}, true);

			if(result.FILTER_URL && hrefFILTER)
				hrefFILTER[0].href = BX.util.htmlspecialcharsback(result.FILTER_URL);

			if(result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID)
			{
				BX.bind(hrefFILTER[0], 'click', function(e)
				{
					var url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
					BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
					return BX.PreventDefault(e);
				});
			}

			if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID)
			{
				var url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
				BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
			}
			else
			{
				if(modef.style.display == 'none')
					modef.style.display = 'block';
				/* GoPro */
				var NewPoStop = this.position.top;
				if($(CollectJS_inputter).hasClass('min') || $(CollectJS_inputter).hasClass('max')){
					NewPoStop = NewPoStop + CollectJS_modef_posFix + 1;
				}
				else if($(CollectJS_inputter).parents('.f_jscrollpane').length>0){
					var id = $(CollectJS_inputter).parents('.f_jscrollpane').attr('id');
					NewPoStop = NewPoStop + CollectJS_modef_posFix + BX(id).offsetTop - $('#'+id).data('jsp').getContentPositionY();
				}
				else{
					NewPoStop = NewPoStop + CollectJS_modef_posFix;
				}
				modef.style.top = NewPoStop + 'px';
				/* /GoPro */
			}
			/* GoPro */
			CollectJS_tamautID = setInterval(function(){
				modef.style.display = 'none';
				clearInterval(CollectJS_tamautID);
			},CollectJS_modef_delay_hide);
			/* /GoPro */
		}
	}
}

JCSmartFilter.prototype.gatherInputsValues = function (values, elements)
{
	if(elements)
	{
		for(var i = 0; i < elements.length; i++)
		{
			var el = elements[i];
			if (el.disabled || !el.type)
				continue;

			switch(el.type.toLowerCase())
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'hidden':
				case 'select-one':
					if(el.value.length)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'radio':
				case 'checkbox':
					if(el.checked)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'select-multiple':
					for (var j = 0; j < el.options.length; j++)
					{
						if (el.options[j].selected)
							values[values.length] = {name : el.name, value : el.options[j].value};
					}
					break;
				default:
					break;
			}
		}
	}
}

JCSmartFilter.prototype.values2post = function (values)
{
	var post = new Array;
	var current = post;
	var i = 0;
	while(i < values.length)
	{
		var p = values[i].name.indexOf('[');
		if(p == -1)
		{
			current[values[i].name] = values[i].value;
			current = post;
			i++;
		}
		else
		{
			var name = values[i].name.substring(0, p);
			var rest = values[i].name.substring(p+1);
			if(!current[name])
				current[name] = new Array;

			var pp = rest.indexOf(']');
			if(pp == -1)
			{
				//Error - not balanced brackets
				current = post;
				i++;
			}
			else if(pp == 0)
			{
				//No index specified - so take the next integer
				current = current[name];
				values[i].name = '' + current.length;
			}
			else
			{
				//Now index name becomes and name and we go deeper into the array
				current = current[name];
				values[i].name = rest.substring(0, pp) + rest.substring(pp+1);
			}
		}
	}
	return post;
}

/***********************************************************************/
/******************************* custom ********************************/
/***********************************************************************/
$(document).ready(function(){
	
	CollectJS_FilterOnDocumentReady();
	
});