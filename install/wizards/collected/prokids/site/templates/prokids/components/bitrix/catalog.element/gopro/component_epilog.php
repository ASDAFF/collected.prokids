<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

// accessories
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/omponents/bitrix/catalog.section/light/style.css',true);
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/omponents/bitrix/catalog.section/light/script.js',true);

// grouped props
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/omponents/collected/grupper.list/gopro/style.css',true);

// set
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/omponents/bitrix/catalog.set.constructor/gopro/style.css',true);
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/omponents/bitrix/catalog.set.constructor/gopro/script.js',true);