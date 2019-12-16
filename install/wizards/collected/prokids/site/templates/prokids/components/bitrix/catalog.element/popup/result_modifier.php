<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

if(!empty($arResult))
{
	if(is_array($arResult['OFFERS']) && count($arResult['OFFERS'])>0)
	{
		// Get sorted properties
		$arResult['OFFERS_EXT'] = CollectDevLibOffersExtension::GetSortedProperties($arResult['OFFERS'],$arParams['PROPS_ATTRIBUTES']);
		// /Get sorted properties
	}
	
	// compare URL fix
	$arResult['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=ADD_TO_COMPARE_LIST&id='.$arItem['ID'], array('action', 'id', 'ajaxpages', 'ajaxpagesid')));
	// /compare URL fix
	
	// get other data
	$params = array(
		'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
		'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
		'MAX_WIDTH' => 210,
		'MAX_HEIGHT' => 140,
	);
	$arItems = array(0 => &$arResult);
	CollectDevLib::GetDataForProductItem($arItems,$params);
	// /get other data
	
	// get no photo
	$arResult['NO_PHOTO'] = CollectDevLib::GetNoPhoto(array('MAX_WIGHT' => 210, 'MAX_HEIGHT' => 140));
	// /get no photo
}