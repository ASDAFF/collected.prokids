<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if(!CModule::IncludeModule('collected.devlibrary'))
	return;

// get no photo
$arResult['NO_PHOTO'] = CollectDevLib::GetNoPhoto(array('MAX_WIDTH'=>95,'MAX_HEIGHT'=>55));
// /get no photo

if(!CModule::IncludeModule('collected.location'))
	return;
if(!CModule::IncludeModule('sale'))
	return;

$COM_SESS_PREFIX = "RSLOCATION";
$detectedLocID = 0;
$detectedLocID = IntVal($_SESSION[$COM_SESS_PREFIX]['LOCATION']['ID']);
$arResult['RSDETECTED_LOCATION_VALUE'] = '-';
if( $detectedLocID>0 )
{
	$arResult['RSDETECTED_LOCATION_VALUE'] = $detectedLocID;
} else {
	$detected = array();
	$detected = CRS_Location::GetCityName();
	
	if( isset($detected['CITY_NAME']) )
	{
		$dbRes = CSaleLocation::GetList(
			array('SORT'=>'ASC','CITY_NAME_LANG'=>'ASC'),
			array('LID'=>LANGUAGE_ID,'CITY_NAME'=>$detected['CITY_NAME'])
		);
		if($arFields = $dbRes->Fetch())
		{
			$arResult['RSDETECTED_LOCATION_VALUE'] = $arFields['ID'];
		}
	}
}