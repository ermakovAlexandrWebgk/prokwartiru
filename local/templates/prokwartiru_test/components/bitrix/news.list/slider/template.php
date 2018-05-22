<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script src="/slider/js/jquery.js" type="text/javascript"></script>
<script src="/slider/js/mobilyslider.js" type="text/javascript"></script>
<script src="/slider/js/init.js" type="text/javascript"></script>

	<div id="slider_content">
		<div class="slider slider4">
			<div class="sliderContent">
<?foreach($arResult["ITEMS"] as $arItem):?>
<div class="item"><a href="<?=$arItem["PROPERTIES"]["URL"]["VALUE"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a></div>
<?endforeach;?>
			</div>
		</div>
	</div>
