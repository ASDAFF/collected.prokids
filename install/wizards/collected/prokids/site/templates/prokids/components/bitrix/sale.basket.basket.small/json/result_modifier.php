<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

$arResult = CollectDevLibResultModifier::SaleBasketBasketSmall($arResult);
$arResult['RIGHT_WORD'] = CollectDevLib::BasketEndWord($arResult['NUM_PRODUCTS']);