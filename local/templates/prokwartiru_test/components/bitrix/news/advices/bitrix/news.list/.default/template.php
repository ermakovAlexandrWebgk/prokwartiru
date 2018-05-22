<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<h1><?=$arResult["NAME"]?>.</h1>
<div class="advices-list">

<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
?>
	<div class="advices-item"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
		  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="137" height="137" alt="<?echo $arItem["NAME"]?>" title="<?echo $arItem["NAME"]?>" /></a>
		<?else:?>
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			  <div class="advices-title">
			    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
			    <?else:?>
				<?echo $arItem["NAME"]?>
			    <?endif;?>
			  </div>
		        <?endif;?>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			  <div class="advices-detail"><?echo $arItem["PREVIEW_TEXT"];?></div>
			<?endif;?>
		<?endif?>
	</div>
<?endforeach;?>
</div>
<br /><br />
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>