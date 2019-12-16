<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$arComponentParameters = array(
	"PARAMETERS" => array(
		"DISPLAY_PROPERTIES" => array(
			"NAME" => GetMessage("COLLECT_MSG_DISPLAY_PROPERTIES"),
			"TYPE" => "STRING",
			"PARENT" => "BASE",
		),
		"CACHE_TIME"  =>  Array(
			"PARENT" => "CACHE_SETTINGS",
			"DEFAULT" => 3600000,
		),
	)
);