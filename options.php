<?
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/options.php');

CModule::IncludeModule('collected.prokids');

$aTabs = array(
	array('DIV' => 'collected_gopro1', 'TAB' => GetMessage('GOPRO.TAB_NAME_SETTINGS'), 'ICON' => '', 'TITLE' => GetMessage('GOPRO.TAB_TITLE_SETTINGS')),
);

$tabControl = new CAdminTabControl('tabControl', $aTabs);

if( (isset($_REQUEST['save']) ||isset($_REQUEST['apply']) ) && check_bitrix_sessid()){
	COption::SetOptionString('collected.prokids', 'adaptive', $_REQUEST['adaptive']=='Y' ? 'Y' : 'N' );
	COption::SetOptionInt('collected.prokids', 'clickprotectiondelay', IntVal($_REQUEST['clickprotectiondelay']) );
	COption::SetOptionInt('collected.prokids', 'requestdelay', IntVal($_REQUEST['requestdelay']) );
	COption::SetOptionString('collected.prokids', 'prop_option', htmlspecialchars($_REQUEST['prop_option']) );
}

$arrPropOption = array(
	'line_through' => GetMessage('GOPRO.PROP_OPTION_LINE_THROUGH'),
	'hide' => GetMessage('GOPRO.PROP_OPTION_HIDE'),
);
$tabControl->Begin();
?><form method="post" name="collected_quickbuy_options" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>"><?
echo bitrix_sessid_post();
$tabControl->BeginNextTab();
?><tr class="heading"><?
	?><td colspan="3"><?=GetMessage('GOPRO.SOLUTION')?></td><?
?></tr><?
$adaptive = COption::GetOptionString('collected.prokids', 'adaptive', 'Y');
?><tr><?
	?><td width="50%" class="adm-detail-content-cell-l"><?=GetMessage('GOPRO.ADAPTIVE')?>:</td><?
	?><td width="50%" class="adm-detail-content-cell-r"><input type="checkbox" name="adaptive" value="Y"<?if($adaptive=='Y'):?> checked="checked" <?endif;?> /></td><?
?></tr><?
$prop_option = COption::GetOptionString('collected.prokids', 'prop_option', 'line_through');
?><tr><?
	?><td width="50%" class="adm-detail-content-cell-l"><?=GetMessage('GOPRO.PROP_OPTION')?>:</td><?
	?><td width="50%" class="adm-detail-content-cell-r"><?
		?><select name="prop_option"><?
			foreach($arrPropOption as $val => $mess)
			{
				?><option value="<?=$val?>"<?if($val==$prop_option):?> selected <?endif;?>><?=$mess?></option><?
			}
		?></select><?
	?></td><?
?></tr><?
$tabControl->Buttons(array());
$tabControl->End();
?></form>