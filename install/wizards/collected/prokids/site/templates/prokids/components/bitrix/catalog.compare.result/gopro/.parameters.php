<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.mediamart'))
	return;

$arTemplateParameters = array(
	// more photo
	'PROPCODE_MORE_PHOTO' => array(
		'NAME' => GetMessage('MSG_PROPCODE_MORE_PHOTO'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'MORE_PHOTO',
	),
	'PROPCODE_SKU_MORE_PHOTO' => array(
		'NAME' => GetMessage('MSG_PROPCODE_SKU_MORE_PHOTO'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'SKU_MORE_PHOTO',
	),
);