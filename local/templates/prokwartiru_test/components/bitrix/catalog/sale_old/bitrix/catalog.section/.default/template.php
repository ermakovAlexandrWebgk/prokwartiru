<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
<div style="background-color: white; padding: 20px; border: 1px solid #91908d; margin-bottom: 30px;">
<table cellpadding="0" cellspacing="0" border="0">
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<tr>
		<?endif;?>

		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%" id="<?=$this->GetEditAreaId($arElement['ID']);?>">

			<table cellpadding="0" cellspacing="2" border="0">
				<tr>
					<?if(is_array($arElement["DETAIL_PICTURE"])):?>
						<td valign="top" style="text-align: right; padding-right: 40px; min-width: 250px;">
						    <!--a href="<-?=$arElement['DETAIL_PAGE_URL']?->"--><img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" style="max-width: 250px; max-height: 280px" /><!--/a--><br />
						 </td>
					<?endif?>
					<td valign="top"><h2><!--a href="<-?=$arElement["DETAIL_PAGE_URL"]?->"--><?=$arElement["NAME"]?><!--/a><br /--></h2>
						<div style="margin-bottom: 20px;"><?=$arElement["PREVIEW_TEXT"]?></div>
						<!--?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?->
							<-?=$arProperty["NAME"]?->:&nbsp;<-?
								if(is_array($arProperty["DISPLAY_VALUE"]))
									echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
								else
									echo $arProperty["DISPLAY_VALUE"];?-><br />
						<-?endforeach?-->
<!-- ХАРАКТЕРИСТИКИ -->
		<div class="catalog-detail-properties">
			<?if($arElement['PROPERTIES']['ARTICUL']['VALUE']):?><p>Артикул: <b><?=$arElement['PROPERTIES']['ARTICUL']['VALUE']?></b></p><?endif?>
			<?if($arElement['PROPERTIES']['PROPERTY']['VALUE']):?><p>Основные свойства:<b> <?=$arElement['PROPERTIES']['PROPERTY']['VALUE']?></b></p><?endif?>
			<?if($arElement['PROPERTIES']['SIZE']['VALUE']):?><p>Размер: <b><?=$arElement['PROPERTIES']['SIZE']['VALUE']?></b></p><?endif?>
			<?if($arElement['PROPERTIES']['RAPPORT']['VALUE']):?><p>Раппорт (подбор): <b><?=$arElement['PROPERTIES']['RAPPORT']['VALUE']?></b></p><?endif?>	
		</div>


<!-- Конец ХАРАКТЕРИСТИКИ -->
						
						<br />

<!-- РАСПРОДАЖНАЯ ЦЕНА -->
		<div class="catalog-detail-price">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<p>Цена со скидкой<!--?=$arResult['PRICES'][$code]['TITLE'];?-->:&nbsp;&nbsp;
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif?>
/ <?=$arElement['PROPERTIES']['UNIT']['VALUE']?>
					</p>
				<?endif;?>
			<?endforeach;?>
			<?if(is_array($arElement["PRICE_MATRIX"])):?>
				<table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
				<thead>
				<tr>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<td valign="top" nowrap><?= GetMessage("CATALOG_QUANTITY") ?></td>
					<?endif?>
					<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
						<td valign="top" nowrap><?= $arType["NAME_LANG"] ?></td>
					<?endforeach?>
				</tr>
				</thead>
				<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
				<tr>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<th nowrap><?
							if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
							elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
							elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
						?></th>
					<?endif?>
					<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
						<td><?
							if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>
								<s><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])?></s><span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
							<?else:?>
								<span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
							<?endif?>&nbsp;
						</td>
					<?endforeach?>
				</tr>
				<?endforeach?>
				</table><!--br /-->
			<?endif?>
		</div>
<!-- Конец РАСПРОДАЖНАЯ ЦЕНА -->

			<?if($arParams["DISPLAY_COMPARE"]):?>
				<noindex><a href="<?echo $arElement["COMPARE_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_COMPARE")?></a>&nbsp;</noindex>
			<?endif?>
			<!-- КНОПКА КУПИТЬ -->
			<!--?if($arElement["CAN_BUY"]):?->
				<input name="buy" type="button" value="<-?= GetMessage("CATALOG_BUY") ?->" OnClick="window.location='<-?echo CUtil::JSEscape($arElement["DETAIL_PAGE_URL"]."#buy")?->'" />
			<-?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?->
				<-?=GetMessage("CATALOG_NOT_AVAILABLE")?->
			<-?endif?-->

			<?if($arElement["CAN_BUY"]):?>
				<div class="catalog-detail-buttons">
					<!--noindex--><a href="<?=$arElement["ADD_URL"]?>" rel="nofollow" onclick="return addToCart(this, 'catalog_detail_image', 'detail', '<?=GetMessage("CATALOG_IN_BASKET")?>');" id="catalog_add2cart_link"><span><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></span></a><!--/noindex-->
				</div>
			<?endif;?>
			<!-- Конец КНОПКА КУПИТЬ -->


					</td>
				</tr>
			</table>


		</td>

		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif?>
</table>
</div>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>



<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<?$APPLICATION->SetTitle("Распродажа обоев в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title."обоев в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог обоев, ".$keywords.", ".$keywords." цена, ".$keywords." купить");?>
