<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--noindex-->
	<?$count=count($arResult);?>
	<a class="basket-link compare  <?=$arParams["CLASS_LINK"];?> <?=$arParams["CLASS_ICON"];?> <?=($count ? 'basket-count' : '');?>" href="<?=$arParams["COMPARE_URL"]?>" title="<?=\Bitrix\Main\Localization\Loc::getMessage('CATALOG_COMPARE_ELEMENTS_ALL');?>">
		<span class="js-basket-block"><i class="svg svg-compare <?=$arParams["CLASS_ICON"];?>" aria-hidden="true"></i><span class="title dark_link"><?=\Bitrix\Main\Localization\Loc::getMessage('CATALOG_COMPARE_ELEMENTS');?></span><span class="count"><?=$count;?></span></span>
	</a>
	<?global $compare_items;
	$compare_items = array_keys($arResult);?>
<!--/noindex-->