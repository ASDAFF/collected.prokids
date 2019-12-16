<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$arComponentDescription = array(
	"NAME" => GetMessage("RS_FAVORITE_COM_NAME"),
	"DESCRIPTION" => GetMessage("RS_FAVORITE_DESCRIPTION"),
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "collect_com",
		"SORT" => 2000,
		"NAME" => GetMessage("COLLECT_COM_COMPONENTS"),
		"CHILD" => array(
			"ID" => "favorite",
			"NAME" => GetMessage("COLLECT_FAVORITE_COM_SEC_NAME"),
			"SORT" => 10,
		)
	),
);
