<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$arComponentDescription = array(
	'NAME' => GetMessage('RS.EC.COM_NAME'),
	'DESCRIPTION' => GetMessage('RS.EC.COM_DESCRIPTION'),
	'SORT' => 10,
	'CACHE_PATH' => 'Y',
	'PATH' => array(
		'ID' => 'collect_com',
		'SORT' => 2000,
		'NAME' => GetMessage('RS.EC.COM_COMPONENTS'),
		'CHILD' => array(
			'ID' => 'easycart',
			'NAME' => GetMessage('RS.EC.COM_EASYCART'),
			'SORT' => 8000,
		),
	),
);