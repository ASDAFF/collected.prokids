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
	'COLLECTPRO_LINK' => array(
		'NAME' => GetMessage('COLLECTPRO_LINK'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_BANNER_TYPE' => array(
		'NAME' => GetMessage('COLLECTPRO_BANNER_TYPE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_BLANK' => array(
		'NAME' => GetMessage('COLLECTPRO_BLANK'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_TITLE1' => array(
		'NAME' => GetMessage('COLLECTPRO_TITLE1'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_TITLE2' => array(
		'NAME' => GetMessage('COLLECTPRO_TITLE2'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_PRICE' => array(
		'NAME' => GetMessage('COLLECTPRO_PRICE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_TEXT' => array(
		'NAME' => GetMessage('COLLECTPRO_TEXT'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'COLLECTPRO_CHANGE_SPEED' => array(
		'NAME' => GetMessage('COLLECTPRO_CHANGE_SPEED'),
		'TYPE' => 'STRING',
		'DEFAULT' => '2000',
	),
	'COLLECTPRO_CHANGE_DELAY' => array(
		'NAME' => GetMessage('COLLECTPRO_CHANGE_DELAY'),
		'TYPE' => 'STRING',
		'DEFAULT' => '8000',
	),
	'COLLECTPRO_BANNER_HEIGHT' => array(
		'NAME' => GetMessage('COLLECTPRO_BANNER_HEIGHT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '402',
	),
	'COLLECTPRO_BANNER_VIDEO_MP4' => array(
		'NAME' => GetMessage('COLLECTPRO_BANNER_VIDEO_MP4'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'COLLECTPRO_BANNER_VIDEO_WEBM' => array(
		'NAME' => GetMessage('COLLECTPRO_BANNER_VIDEO_WEBM'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'COLLECTPRO_BANNER_VIDEO_PIC' => array(
		'NAME' => GetMessage('COLLECTPRO_BANNER_VIDEO_PIC'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
);