<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$max_width_size = 225;
$max_height_size = 150;

// get other data
$params = array(
	'MAX_WIDTH' => $max_width_size,
	'MAX_HEIGHT' => $max_height_size,
);
CollectDevLib::GetDataForProductItem($arResult['ITEMS'],$params);
// /get other data

// get no photo
$arResult['NO_PHOTO'] = CollectDevLib::GetNoPhoto(array('MAX_WIDTH'=>$max_width_size,'MAX_HEIGHT'=>$max_height_size));
// /get no photo