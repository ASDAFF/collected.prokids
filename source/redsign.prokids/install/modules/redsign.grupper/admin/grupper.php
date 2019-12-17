<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
/**
 * Copyright (c) 15/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

IncludeModuleLangFile(__FILE__);

CModule::IncludeModule('redsign.grupper');

if($_REQUEST["action"]=="delete" && $_REQUEST["delete"]=="Y" && IntVal($_REQUEST["ID"])>0)
{
	CRSGGroups::Delete(IntVal($_REQUEST["ID"]));
}

$sTableID = "redsign_grupper_groups";
$oSort = new CAdminSorting($sTableID, "ID", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);

$arFilter = array();
$rsData = CRSGGroups::GetList(array($by=>$order),$arFilter);
$rsData = new CAdminResult($rsData, $sTableID);
$rsData->NavStart();
$lAdmin->NavText( $rsData->GetNavPrint( GetMessage("GRUPPER_PAGE_NAVI") ) );

$lAdmin->AddHeaders(
	array(
		array("id" => "ID", "content" => GetMessage("GRUPPER_LIST_HEADER_ID"), "sort" => "id", "default" => true),
		array("id" => "NAME", "content" => GetMessage("GRUPPER_LIST_HEADER_NAME"), "sort" => "name", "default" => true),
		array("id" => "CODE", "content" => GetMessage("GRUPPER_LIST_HEADER_CODE"), "sort" => "code", "default" => true),
		array("id" => "SORT", "content" => GetMessage("GRUPPER_LIST_HEADER_SORT"), "sort" => "sort", "default" => true),
	)
);

while($arRes = $rsData->NavNext(true, "f_"))
{
	$row =& $lAdmin->AddRow($f_ID, $arRes);
	$row->AddViewField("ID", '<a href="redsign_grupper_edit.php?ID='.$f_ID.'&lang='.LANG.'">'.$f_ID.'</a>' );
	$row->AddViewField("NAME", $f_NAME );
	$row->AddViewField("CODE", $f_CODE );
	$row->AddViewField("SORT", $f_SORT );
	$arActions = Array();
	$arActions[] = array(
		"ICON" => "edit",
		"DEFAULT" => true,
		"TEXT" => GetMessage("GRUPPER_ACTION_EDIT"),
		"ACTION" => $lAdmin->ActionRedirect("redsign_grupper_edit.php?ID=".$f_ID."&lang=".LANG)
	);
	$arActions[] = array(
		"ICON" => "delete",
		"DEFAULT" => false,
		"TEXT" => GetMessage("GRUPPER_ACTION_DELETE"),
		"ACTION" => "if(confirm('".GetMessage("IMYIE_ACTION_DELETE_OK")."')) ".$lAdmin->ActionRedirect("redsign_grupper.php?ID=".$f_ID."&delete=Y&action=delete&lang=".LANG)
	);
	$row->AddActions($arActions);
}

$lAdmin->AddFooter(
	array(
		array("title" => GetMessage("GRUPPER_LIST_FOOTER_COUNT"), "value" => $rsData->SelectedRowsCount()),
	)
);

$aContext = array(
	array(
		"TEXT" => GetMessage("GRUPPER_CONTEXT_ADD"),
		"LINK" => "redsign_grupper_edit.php?lang=".LANG,
		"TITLE" => "",
		"ICON" => "btn_new",
	),
);

// add context menu to table
$lAdmin->AddAdminContextMenu($aContext,false,false);
$lAdmin->CheckListMode();

// set page title
$APPLICATION->SetTitle( GetMessage("GRUPPER_PAGE_TITLE") );

// include prolog
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

// show table
$lAdmin->DisplayList();

// завершение страницы
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>