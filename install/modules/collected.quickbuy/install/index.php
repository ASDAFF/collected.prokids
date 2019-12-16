<?
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

global $MESS;
IncludeModuleLangFile(__FILE__);

Class collected_quickbuy extends CModule
{
    var $MODULE_ID = 'collected.quickbuy';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = 'Y';

	function collected_quickbuy()
	{
		$arModuleVersion = array();

		$path = str_replace('\\', '/', __FILE__);
		$path = substr($path, 0, strlen($path) - strlen('/index.php'));
		include($path.'/version.php');
	
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        } else {
            $this->MODULE_VERSION = '1.0.0';
            $this->MODULE_VERSION_DATE = '2014.01.01';
        }

		$this->MODULE_NAME = GetMessage('RSQB.MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('RSQB.MODULE_DESCRIPTION');
		$this->PARTNER_NAME = GetMessage('RSQB.MODULE_DEVELOPER_NAME');
        $this->PARTNER_URI  = 'https://asdaff.github.io/';
	}

	// Install functions
	function InstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		RegisterModule('collected.quickbuy');
		$DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.quickbuy/install/db/'.$DBType.'/install.sql');
		return TRUE;
	}

	function InstallEvents()
	{
		RegisterModuleDependences('main', 'OnAdminTabControlBegin', 'collected.quickbuy', 'CRSQUICKBUYTab', 'MyOnAdminTabControlBegin');
		RegisterModuleDependences('main', 'OnBeforeProlog', 'collected.quickbuy', 'CRSQUICKBUYMain', 'OnBeforePrologElementUpdate');
		RegisterModuleDependences('sale', 'OnOrderUpdate', 'collected.quickbuy', 'CRSQUICKBUYMain', 'OnOrderUpdate');
		return TRUE;
	}

	function InstallOptions()
	{
		return TRUE;
	}

	function InstallFiles()
	{
		CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.quickbuy/install/copyfiles/components', $_SERVER['DOCUMENT_ROOT'].'/bitrix/components', true, true);
		return TRUE;
	}

	function InstallPublic()
	{
		return TRUE;
	}

	// UnInstal functions
	function UnInstallDB($arParams = Array())
	{
		global $DB, $DBType, $APPLICATION;
		$DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.quickbuy/install/db/'.$DBType.'/uninstall.sql');
		UnRegisterModule('collected.quickbuy');
		return TRUE;
	}

	function UnInstallEvents()
	{
		UnRegisterModuleDependences('main', 'OnAdminTabControlBegin', 'collected.quickbuy', 'CRSQUICKBUYTab', 'MyOnAdminTabControlBegin');
		UnRegisterModuleDependences('main', 'OnBeforeProlog', 'collected.quickbuy', 'CRSQUICKBUYMain', 'OnBeforePrologElementUpdate');
		UnRegisterModuleDependences('sale', 'OnOrderUpdate', 'collected.quickbuy', 'CRSQUICKBUYMain', 'OnOrderUpdate');
		return TRUE;
	}

	function UnInstallOptions()
	{
		COption::RemoveOption('collected.quickbuy');
		return TRUE;
	}

	function UnInstallFiles()
	{
		return TRUE;
	}

	function UnInstallPublic()
	{
		return TRUE;
	}

    function DoInstall()
    {
		global $APPLICATION, $step;
		$keyGoodDB = $this->InstallDB();
		$keyGoodEvents = $this->InstallEvents();
		$keyGoodOptions = $this->InstallOptions();
		$keyGoodFiles = $this->InstallFiles();
		$keyGoodPublic = $this->InstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage('SPER_INSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.quickbuy/install/install.php');
    }

    function DoUninstall()
    {
		global $APPLICATION, $step;
		$keyGoodFiles = $this->UnInstallFiles();
		$keyGoodEvents = $this->UnInstallEvents();
		$keyGoodOptions = $this->UnInstallOptions();
		$keyGoodDB = $this->UnInstallDB();
		$keyGoodPublic = $this->UnInstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage('SPER_UNINSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.quickbuy/install/uninstall.php');
    }
}