<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

// get other data
$params = array(
	'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
	'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
	'MAX_WIDTH' => 220,
	'MAX_HEIGHT' => 220,
);
CollectDevLib::GetDataForProductItem($arResult['ITEMS'],$params);
// /get other data

// ADD AJAX URL
$arResult['AJAXPAGE_URL'] = $APPLICATION->GetCurPageParam('',array('ajaxpages', 'ajaxpagesid', 'get', 'AJAX_CALL', 'PAGEN_'.($arResult['NAV_RESULT']->NavNum)));