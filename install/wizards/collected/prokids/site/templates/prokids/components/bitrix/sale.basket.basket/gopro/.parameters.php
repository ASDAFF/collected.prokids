<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('iblock'))
	return;
if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$arIBlocks = array('-'=>'(-)');
$res = CIBlock::GetList(array('sort'=>'asc'), array('ACTIVE'=>'Y','CNT_ACTIVE'=>'Y'));
while($arIBlock = $res->Fetch())
{
    $arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
}

$listProp = CollectDevLibParameters::GetTemplateParamsPropertiesList($arCurrentValues['ACCESSORIES_IBLOCK']);

$arTemplateParameters = array(
	'AJAX_MODE' => array(
		'NAME' => GetMessage('AJAX_MODE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
	'PROP_ARTICLE' => array(
		'NAME' => GetMessage('PROP_ARTICLE'),
		'TYPE' => 'STRING',
	),
	'PROP_SKU_ARTICLE' => array(
		'NAME' => GetMessage('PROP_SKU_ARTICLE'),
		'TYPE' => 'STRING',
	),
	'ACCESSORIES_IBLOCK' => array(
		'NAME' => GetMessage('ACCESSORIES_IBLOCK'),
		'TYPE' => 'LIST',
		'VALUES' => $arIBlocks,
		'REFRESH' => 'Y',
	),
	'PROP_ACCESSORIES' => array(
		'NAME' => GetMessage('PROP_ACCESSORIES'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['E'],
	),
);