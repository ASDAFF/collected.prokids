<?$IS_AJAX = isset($_SERVER['HTTP_X_REQUESTED_WITH']) || isset($_REQUEST['AJAX_CALL']) && 'Y' == $_REQUEST['AJAX_CALL'];
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if ($IS_AJAX) {
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
} else {
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
	$APPLICATION->SetTitle("Want cheaper?");
}
?>

<?$APPLICATION->IncludeComponent(
	"collected:recall2", 
	"cheaper", 
	array(
		"COLLECT_EMAIL_TO" => "",
		"SHOW_FIELDS" => array(
			0 => "RS_AUTHOR_NAME",
			1 => "RS_COMPANY_NAME",
			2 => "RS_AUTHOR_PHONE",
			3 => "RS_AUTHOR_COMMENT",
		),
		"REQUIRED_FIELDS" => array(
			0 => "RS_AUTHOR_NAME",
			1 => "RS_AUTHOR_PHONE",
		),
		"COLLECT_USE_CAPTCHA" => "Y",
		"COLLECT_MESSAGE_AGREE" => "Your message is accepted! In the near future you will contact our consultant.",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);
?>

<?if(!$IS_AJAX):?>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>
<?endif;?>