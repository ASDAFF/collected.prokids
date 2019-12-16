<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

// get other data
$params = array(
	'MAX_WIDTH' => 22,
	'MAX_HEIGHT' => 14,
);
CollectDevLib::GetDataForProductItem($arResult['ITEMS'],$params);
// /get other data