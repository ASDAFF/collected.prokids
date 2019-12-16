<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('iblock'))
	return;
if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$listProp = CollectDevLibParameters::GetTemplateParamsPropertiesList($arCurrentValues['IBLOCK_ID']);

$arTemplateParameters = array(
	'BRAND_PAGE' => array(
		'NAME' => GetMessage('BRAND_PAGE'),
		'TYPE' => 'STRING',
	),
	'ADD_STYLES_FOR_MAIN' => array(
		'NAME' => GetMessage('ADD_STYLES_FOR_MAIN'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
	'RSGOPRO_CHANGE_SPEED' => array(
		'NAME' => GetMessage('RSGOPRO_CHANGE_SPEED'),
		'TYPE' => 'STRING',
		'DEFAULT' => '2000',
	),
	'RSGOPRO_CHANGE_DELAY' => array(
		'NAME' => GetMessage('RSGOPRO_CHANGE_DELAY'),
		'TYPE' => 'STRING',
		'DEFAULT' => '8000',
	),
	'RSGOPRO_INCLUDE_OWL_SCRIPTS' => array(
		'NAME' => GetMessage('RSGOPRO_INCLUDE_OWL_SCRIPTS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'VALUE' => 'Y',
	),
);