<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?><div class="basketinhead"><?
	?><a href="<?=$arParams['PATH_TO_BASKET']?>"><?
		?><i class="icon pngicons"></i><?
		?><div class="title opensansbold"><?=GetMessage('COLLECTPRO.SMALLBASKET_TITLE')?></div><?
		?><div id="basketinfo" class="descr"><?
			$frame = $this->createFrame('basketinfo',false)->begin();
				if($arResult['NUM_PRODUCTS']>0)
				{
					?><?=$arResult["NUM_PRODUCTS"]?> <?=GetMessage('COLLECTPRO.SMALLBASKET_TOVAR')?><?=$arResult['RIGHT_WORD']?> <?=GetMessage('COLLECTPRO.SMALLBASKET_NA')?> <?=$arResult['PRINT_FULL_PRICE']?><?
				} else {
					echo GetMessage('COLLECTPRO.SMALLBASKET_PUSTO');
				}
			$frame->beginStub();
				echo GetMessage('COLLECTPRO.SMALLBASKET_PUSTO');
			$frame->end();
		?></div><?
	?></a><?
?></div>