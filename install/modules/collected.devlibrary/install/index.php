<?
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

global $MESS;
IncludeModuleLangFile(__FILE__);

Class collected_devlibrary extends CModule
{
    var $MODULE_ID = 'collected.devlibrary';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = 'Y';

	function collected_devlibrary()
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

		$this->MODULE_NAME = GetMessage('RSDF.MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('RSDF.MODULE_DESCRIPTION');
		$this->PARTNER_NAME = GetMessage('RSDF.DEVELOPER_NAME');
        $this->PARTNER_URI  = 'https://asdaff.github.io/';
	}

	// Install functions
	function InstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		RegisterModule('collected.devlibrary');
		return TRUE;
	}

	function InstallEvents()
	{
		RegisterModuleDependences('iblock', 'OnAfterIBlockElementAdd', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnAfterIBlockElementAddHandler',10000);
		RegisterModuleDependences('iblock', 'OnAfterIBlockElementUpdate', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnAfterIBlockElementUpdateHandler',10000);
		RegisterModuleDependences('catalog', 'OnPriceAdd', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnPriceUpdateAddHandler',10000);
		RegisterModuleDependences('catalog', 'OnPriceUpdate', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnPriceUpdateAddHandler',10000);
		return TRUE;
	}

	function InstallOptions()
	{
		COption::SetOptionString('collected.devlibrary', 'fakeprice_active', "Y" );
		COption::SetOptionString('collected.devlibrary', 'propcode_cml2link', "CML2_LINK" );
		COption::SetOptionString('collected.devlibrary', 'propcode_fakeprice', "PROD_PRICE_FALSE" );
		return TRUE;
	}

	function InstallFiles()
	{
		COption::SetOptionString('collected.devlibrary', 'no_photo_path', '/bitrix/modules/collected.devlibrary/img/no-photo.png');
		$arFile = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.devlibrary/img/no-photo.png');
		$fid = CFile::SaveFile($arFile, 'collected_devlibrary_nophoto');
		COption::SetOptionInt('collected.devlibrary', 'no_photo_fileid', $fid);
		
		CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.devlibrary/install/js', $_SERVER['DOCUMENT_ROOT'].'/bitrix/js', true, true);
		return TRUE;
	}

	function InstallPublic()
	{
		return TRUE;
	}

	// UnInstal functions
	function UnInstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		UnRegisterModule('collected.devlibrary');
		return TRUE;
	}

	function UnInstallEvents()
	{
		UnRegisterModuleDependences('iblock', 'OnAfterIBlockElementAdd', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnAfterIBlockElementAddHandler');
		UnRegisterModuleDependences('iblock', 'OnAfterIBlockElementUpdate', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnAfterIBlockElementUpdateHandler');
		UnRegisterModuleDependences('catalog', 'OnPriceAdd', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnPriceUpdateAddHandler');
		UnRegisterModuleDependences('catalog', 'OnPriceUpdate', 'collected.devlibrary', 'CollectDevLibOffersExtension', 'OnPriceUpdateAddHandler');
		return TRUE;
	}

	function UnInstallOptions()
	{
		COption::RemoveOption('collected.devlibrary');
		return TRUE;
	}

	function UnInstallFiles()
	{
		DeleteDirFilesEx('/bitrix/js/collected.devlibrary');
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
		$APPLICATION->IncludeAdminFile(GetMessage('SPER_INSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.devlibrary/install/install.php');
    }

    function DoUninstall()
    {
		global $APPLICATION, $step;
		$keyGoodFiles = $this->UnInstallFiles();
		$keyGoodEvents = $this->UnInstallEvents();
		$keyGoodOptions = $this->UnInstallOptions();
		$keyGoodDB = $this->UnInstallDB();
		$keyGoodPublic = $this->UnInstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage('SPER_UNINSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/collected.devlibrary/install/uninstall.php');
    }
}