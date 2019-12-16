<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('iblock'))
	return;
if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$listProp = CollectDevLibParameters::GetTemplateParamsPropertiesList($arCurrentValues['IBLOCK_ID']);

$arTemplateParameters = array(
	// section, element
	'PROP_CODE_FILE' => array(
		'NAME' => GetMessage('PROP_CODE_FILE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
);