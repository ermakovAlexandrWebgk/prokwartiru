<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-top" style="padding: 20px;">
<table cellpadding="0" cellspacing="0" border="0">
	<?foreach($arResult["ROWS"] as $arItems):?>
		<tr valign="top">
		<?foreach($arItems as $arElement):?>
		<?if(is_array($arElement)):?>

			<td width="<?=$arResult["TD_WIDTH"]?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td valign="top" width="200px">
				<?if(is_array($arElement["DETAIL_PICTURE"])):?>
					<img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?elseif(is_array($arElement["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?endif?>

<br /><br />
<!-- Цена -->
	<?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
			<br /><br /><p>Цена:&nbsp; <?=$arPrice["PRINT_VALUE"]?></p>
		<?if($arPrice["CAN_ACCESS"]):?>
			<br /><br /><p>Цена:&nbsp; <?=$arPrice["PRINT_VALUE"]?></p>
		<?endif;?>
	<?endforeach;?>
					<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<p><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp;
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
							<?else:?>
								<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
							<?endif?>
							</p>
						<?endif;?>
					<?endforeach;?>

<!-- Конец цена -->

<!-- Кнопка купить -->


<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>

<!-- Конец кнопка купить -->


					</td>
					<td valign="top">
						<!--a href="<-?=$arElement["DETAIL_PAGE_URL"]?->"--><h2><?=$arElement["NAME"]?></h2><!--/a><br /-->
						<br />
						<?=$arElement["PREVIEW_TEXT"]?>
				<!--br />
				<-?if($arElement["DETAIL_TEXT"]):?->
					<br /><-?=$arElement["DETAIL_TEXT"]?-><br />
				<-?elseif($arElement["PREVIEW_TEXT"]):?->
					<br /><-?=$arElement["PREVIEW_TEXT"]?-><br />
				<-?endif;?-->
					</td>
				</tr>
				</table>
<br /><br />
<hr class="grey" />
<br /><br />
	</td>
		<?endif;?>
		<?endforeach?>
		</tr>

	<?endforeach?>
</table>
</div>
