<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('iblock'))
	return;
if(!CModule::IncludeModule('catalog'))
	return;
if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$arTemplateParameters = array(
	"COLLECTPRO_CATALOG_PATH" => array(
		"NAME" => GetMessage("COLLECTPRO_CATALOG_PATH"),
		"TYPE" => "STRING",
		"DEFAULT" => "/catalog/",
	),
	"COLLECTPRO_MAX_ITEM" => array(
		"NAME" => GetMessage("COLLECTPRO_MAX_ITEM"),
		"TYPE" => "STRING",
		"DEFAULT" => "9",
	),
	"COLLECTPRO_IS_MAIN" => array(
		"NAME" => GetMessage("COLLECTPRO_IS_MAIN"),
		"TYPE" => "STRING",
		"DEFAULT" => "N",
	),
	"COLLECTPRO_PROPCODE_ELEMENT_IN_MENU" => array(
		"NAME" => GetMessage("COLLECTPRO_PROPCODE_ELEMENT_IN_MENU"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
);

$arDFParamsCatalog = CollectDevLibParameters::GetTemplateParamsCatalog($arCurrentValues);
foreach($arDFParamsCatalog as $PNAME => $arParam)
{
	$arTemplateParameters[$PNAME] = $arParam;
}