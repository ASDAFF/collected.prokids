<?
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

global $DBType, $DB, $MESS, $APPLICATION;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	"collected.grupper",
	array(
		"CRSGrupper" => "classes/general/main.php",
		"CRSGGroups" => "classes/".$DBType."/groups.php",
		"CRSGBinds" => "classes/".$DBType."/binds.php",
	)
);
?>