<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-element">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
		<?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?>
			<td width="200px" valign="top">
				<?if(is_array($arResult["DETAIL_PICTURE"])):?>
					<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				<?elseif(is_array($arResult["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				<?endif?>


<!-- Цена -->
	<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
		<?if($arPrice["CAN_ACCESS"]):?>
			<br /><br /><p>Цена:&nbsp; <?=$arPrice["PRINT_VALUE"]?></p>
		<?endif;?>
	<?endforeach;?>

<!-- Конец цена -->

<!-- Кнопка купить -->


<p><a href="<?echo $arResult["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></a></p>

<!-- Конец кнопка купить -->


			</td>
		<?endif;?>
			<td align="top">
				<h2><?=$arResult["NAME"]?></h2>
				<br />
				<?if($arResult["DETAIL_TEXT"]):?>
					<br /><?=$arResult["DETAIL_TEXT"]?><br />
				<?elseif($arResult["PREVIEW_TEXT"]):?>
					<br /><?=$arResult["PREVIEW_TEXT"]?><br />
				<?endif;?>
				<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
					<?=$arProperty["NAME"]?>:<b>&nbsp;<?
					if(is_array($arProperty["DISPLAY_VALUE"])):
						echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
					elseif($pid=="MANUAL"):
						?><a href="<?=$arProperty["VALUE"]?>"><?=GetMessage("CATALOG_DOWNLOAD")?></a><?
					else:
						echo $arProperty["DISPLAY_VALUE"];?>
					<?endif?></b><br />
				<?endforeach?>
				<br /><br />
				<p><a href="/catalog/glue/">Другие виды клея</a></p>
			</td>
		</tr>
	</table>

</div>
