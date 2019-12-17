<?define('NEED_AUTH', true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

if (isset($_REQUEST['backurl']) && strlen($_REQUEST['backurl'])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Authorization");

?>

<p>You have successfully registered and logged in on the site!</p>

<div class="sorter_and_name clearfix">
	<h3 class="name">Best Goods</h3>
	<div class="sorter">
	<?
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
$APPLICATION->IncludeComponent('redsign:catalog.sorter', 'gopro', array(
	'ALFA_ACTION_PARAM_NAME' => 'alfaction',
	'ALFA_ACTION_PARAM_VALUE' => 'alfavalue',
	'ALFA_CHOSE_TEMPLATES_SHOW' => 'Y',
	'ALFA_CNT_TEMPLATES' => '3',
	'ALFA_DEFAULT_TEMPLATE' => 'showcase',
	'ALFA_CNT_TEMPLATES_0' => 'List',
	'ALFA_CNT_TEMPLATES_NAME_0' => 'table',
	'ALFA_CNT_TEMPLATES_1' => 'Gallery',
	'ALFA_CNT_TEMPLATES_NAME_1' => 'gallery',
	'ALFA_CNT_TEMPLATES_2' => 'Showcase',
	'ALFA_CNT_TEMPLATES_NAME_2' => 'showcase',
	'ALFA_SORT_BY_SHOW' => 'N',
	'ALFA_OUTPUT_OF_SHOW' => 'N',
	'AJAXPAGESID' => 'ajaxpages_auth',
	),
	false
);
?>
	</div>
</div>
<div id="ajaxpages_auth" class="ajaxpages_auth">
<?
global $APPLICATION,$JSON;
$IS_SORTERCHANGE = 'N';
if($_REQUEST['AJAX_CALL']=='Y' && $_REQUEST['sorterchange']=='ajaxpages_auth')
{
	$IS_SORTERCHANGE = 'Y';
	$JSON['TYPE'] = 'OK';
}
$IS_AJAXPAGES = 'N';
if($_REQUEST['ajaxpages']=='Y' && $_REQUEST['ajaxpagesid']=='ajaxpages_auth')
{
	$IS_AJAXPAGES = 'Y';
	$JSON['TYPE'] = 'OK';
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"gopro", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "#IBLOCK_ID_catalog#",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "timestamp_x",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "5",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "BRAND",
			2 => "YEAR",
			3 => "OS",
			4 => "WEIGHT",
			5 => "FORUM_MESSAGE_CNT",
			6 => "RSFAVORITE_COUNTER",
			7 => "FORUM_TOPIC_ID",
			8 => "HEIGHT",
			9 => "TICKNESS",
			10 => "WIDTH",
			11 => "DIAGONAL",
			12 => "SOLUTION",
			13 => "INTERNET_ACCESS",
			14 => "INTERFACES",
			15 => "NAVI",
			16 => "CARD",
			17 => "VIDEO",
			18 => "ACCESSORIES",
			19 => "POHOZHIE",
			20 => "BUY_WITH_THIS",
			21 => "YEARS",
			22 => "",
		),
		"OFFERS_LIMIT" => "0",
		"TEMPLATE_THEME" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "Buy now",
		"MESS_BTN_ADD_TO_BASKET" => "Add in basket",
		"MESS_BTN_SUBSCRIBE" => "Subscribe",
		"MESS_BTN_DETAIL" => "More info",
		"MESS_NOT_AVAILABLE" => "Not available",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "WHOLE",
			2 => "RETAIL",
			3 => "EXTPRICE",
			4 => "EXTPRICE2",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "#SITE_DIR#personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => "gopro",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Goods",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "COLOR_DIRECTORY",
			2 => "COLOR2_DIRECTORY",
			3 => "STORAGE",
			4 => "MORE_PHOTO",
			5 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "asc",
		"PROP_MORE_PHOTO" => "MORE_PHOTO",
		"PROP_ARTICLE" => "CML2_ARTICLE",
		"PROP_ACCESSORIES" => "ACCESSORIES",
		"USE_FAVORITE" => "Y",
		"USE_SHARE" => "Y",
		"SHOW_ERROR_EMPTY_ITEMS" => "Y",
		"DONT_SHOW_LINKS" => "N",
		"USE_STORE" => "Y",
		"USE_MIN_AMOUNT" => "Y",
		"MIN_AMOUNT" => "10",
		"MAIN_TITLE" => "Stock Availability",
		"PROP_SKU_MORE_PHOTO" => "MORE_PHOTO",
		"PROP_SKU_ARTICLE" => "CML2_ARTICLE",
		"PROPS_ATTRIBUTES" => array(
			0 => "COLOR_DIRECTORY",
			1 => "SKU_SIZE",
			2 => "PROD_ZOOMER",
		),
		"OFFERS_CART_PROPERTIES" => array(
		),
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"AJAXPAGESID" => "ajaxpages_auth",
		"IS_AJAXPAGES" => $IS_AJAXPAGES,
		"IS_SORTERCHANGE" => $IS_SORTERCHANGE,
		"AJAX_OPTION_ADDITIONAL" => "",
		"VIEW" => "showcase",
		"COLUMNS5" => "Y"
	),
	false
);?>
</div><?
if($IS_AJAXPAGES=='Y' || $IS_SORTERCHANGE=='Y')
{
	$APPLICATION->RestartBuffer();
	if(SITE_CHARSET!='utf-8')
	{
		$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
		$json_str_utf = json_encode($data);
		$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
		echo $json_str;
	} else {
		echo json_encode($JSON);
	}
	die();
}
?>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>