<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if (!CModule::IncludeModule('catalog'))
    return;

$CURRENCY_CODE = 'RUB';
$LANG_CODE = 'ru';

$arFields = array(
    'CURRENCY' => 'RUB',
    'AMOUNT' => 1,
    'AMOUNT_CNT' => 1,
    'SORT' => 0
);

if (CCurrency::GetByID($CURRENCY_CODE)) {
    CCurrency::Update($CURRENCY_CODE, $arFields);
} else {
    CCurrency::Add($arFields);
}

$arFields = array(
    'FULL_NAME' => GetMessage('COLLECT_CURRENCY_RU_NAME'),
    'FORMAT_STRING' => GetMessage('COLLECT_CURRENCY_RU_FORMAT'),
    'DEC_POINT' => '.',
    'THOUSANDS_SEP' => ' ',
    'DECIMALS' => 0,
    'CURRENCY' => 'RUB',
    'LID' => 'ru'
);
if (CCurrencyLang::GetByID($CURRENCY_CODE, $LANG_CODE)) {
    CCurrencyLang::Update($CURRENCY_CODE, $LANG_CODE, $arFields);
} else {
    CCurrencyLang::Add($arFields);
}