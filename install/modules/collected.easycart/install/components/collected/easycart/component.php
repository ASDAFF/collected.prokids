<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if( !\Bitrix\Main\Loader::includeModule('collected.easycart') ) {
	ShowError( GetMessage('COLLECTED_EC.ERROR_EC_NOT_INSTALLED') );
	return;
}
if( !\Bitrix\Main\Loader::includeModule('iblock') ) {
	ShowError( GetMessage('COLLECTED_EC.ERROR_IBLOCK_NOT_INSTALLED') );
	return;
}
if( !\Bitrix\Main\Loader::includeModule('catalog') ) {
	ShowError( GetMessage('COLLECTED_EC.ERROR_CATALOG_NOT_INSTALLED') );
	return;
}
if( !\Bitrix\Main\Loader::includeModule('sale') ) {
	ShowError( GetMessage('COLLECTED_EC.ERROR_SALE_NOT_INSTALLED') );
	return;
}

$arParams['SERVICE_URL'] = COption::GetOptionString('collected.easycart', 'service_url', '');
$arParams['SERVICE_URL'] = str_replace('#SITE_DIR#',SITE_DIR,$arParams['SERVICE_URL']);

$this->IncludeComponentTemplate();