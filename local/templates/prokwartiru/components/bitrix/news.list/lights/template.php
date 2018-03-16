<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-item-list">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="catalog-item">
			<div class="catalog-item-image" style="margin-bottom: 10px;"><a href="/catalog/lights/index.php?RUBRIC_ID=<?=$arItem["ID"]?>"><img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="border: none;" /></a></div>
	  </div>
<?endforeach;?>
</div>
