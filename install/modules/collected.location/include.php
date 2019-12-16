<?
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

global $DBType, $DB, $MESS, $APPLICATION;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	"collected.location",
	array(
		"CRS_Location" => "classes/general/main.php",
		"IPGeoBase" => "classes/general/ipGeo.php"
	)
);
?>