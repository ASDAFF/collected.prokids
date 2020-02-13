<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $rsCollectProFavoriteFilter;
$rsCollectProFavoriteFilter = array();
if( is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0 )
{
	foreach($arResult['ITEMS'] as $arItem)
	{
		$rsCollectProFavoriteFilter['ID'][] = $arItem['ELEMENT_ID'];
	}
}

if( (is_array($rsCollectProFavoriteFilter['ID']) && count($rsCollectProFavoriteFilter['ID'])<1) || empty($rsCollectProFavoriteFilter['ID']) )
{
	$rsCollectProFavoriteFilter['ID'] = array( '0' );
}