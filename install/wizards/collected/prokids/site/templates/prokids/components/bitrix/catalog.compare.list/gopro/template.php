<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Copyright (c) 16/12/2019 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$frame = $this->createFrame('compare', false)->begin();
?><div class="comparelist clearfix"><?
	if($arResult['COMPARE_CNT']>0)
	{
		?><div class="comparelistinner"><div class="title"><?=GetMessage('CATALOG_IN_COMPARE')?>:</div><a href="<?=$arParams["COMPARE_URL"]?>"><?=$arResult['COMPARE_CNT']?> <?=GetMessage('CATALOG_COMPARE_PRODUCT')?><?=$arResult["RIGHT_WORD"]?></a></div><?
	}
?></div><?
?><script>COLLECTEDGoPro_CompareShowHideAndCopy();</script><?
$frame->end();