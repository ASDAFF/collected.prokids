<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $rsCollectProViewedFilter;
$rsCollectProViewedFilter = array();
if( is_array($templateData['ITEMS']) && count($templateData['ITEMS'])>0 )
{
	foreach($templateData['ITEMS'] as $arItem)
	{
		$rsCollectProViewedFilter['ID'][] = $arItem['ID'];
	}
}

if( (is_array($rsCollectProViewedFilter['ID']) && count($rsCollectProViewedFilter['ID'])<1) || empty($rsCollectProViewedFilter['ID']) )
{
	$rsCollectProViewedFilter['ID'] = array( '0' );
}