<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$arResult['JSON_EXT'] = CollectDevLibOffersExtension::GetJSONElement(
	$arResult,
	$arParams['PROPS_ATTRIBUTES'],
	$arParams['PRICE_CODE'],array('SKU_MORE_PHOTO_CODE'=>$arParams['PROP_SKU_MORE_PHOTO'],'SIZES'=>array('WIDTH'=>210,'HEIGHT'=>140))
);