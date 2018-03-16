<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["NAME"]?></h1>
<?CModule::IncludeModule("iblock");
$property_countrys = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "VALUE"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"PROP2"));
$property_fabrics = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "VALUE"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"PROP1"));
while($country_fields = $property_countrys->GetNext()):
echo "country";
   while($fabric_fields = $property_fabrics->GetNext()):?>

<?
if (count($arResult['ITEMS']) < 1)
	return;
?>

<div class="catalog-item-list">
<h2><?=$fabric_fields["VALUE"]?> <span>(<?=$country_fields["VALUE"]?>)</span></h2>
<?
foreach ($arResult['ITEMS'] as $key => $arElement):

if (($country_fields["VALUE"] == $arElement['PROPERTIES']['PROP2']['VALUE']) and ($fabric_fields["VALUE"] == $arElement['PROPERTIES']['PROP1']['VALUE'])):
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>
<pre><?php //print_r( $arElement) ?></pre>
	<div class="catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<div class="catalog-item-info">
<div class="catalog-item-title"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a><?=$sticker?></div>
		<?if($bHasPicture):?>
			<div class="catalog-item-image">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>" /></a>
			</div>
		<?endif;?>

			<div class="catalog-item-desc">
				
				<div class="catalog-item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>
			<?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):?>
				<div class="catalog-item-offers">
				<?$i=0;?>
				<?foreach($arElement["OFFERS"] as $arOffer):?>
					<?if($i != 0):?>
					<div class="catalog-detail-line"></div>
					<?endif;?>
					<?$i++;?>
					<div class="catalog-item-links">	
					<?if($arOffer["CAN_BUY"]):?>
						<a href="<?echo $arOffer["ADD_URL"]?>" class="catalog-item-buy<?/*catalog-item-in-the-cart*/?>" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_ofrs_<?=$arOffer['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a>
					<?elseif(count($arResult["PRICES"]) > 0):?>
						<span class="catalog-item-not-available"><?=GetMessage("CATALOG_NOT_AVAILABLE")?></span>
					<?endif?>
					<?if($arParams["DISPLAY_COMPARE"]):?>
						<a href="<?echo $arOffer["COMPARE_URL"]?>" class="catalog-item-compare" onclick="return addToCompare(this, '<?=GetMessage("CATALOG_IN_COMPARE")?>');" rel="nofollow" id="catalog_add2compare_link_ofrs_<?=$arOffer['ID']?>"><?echo GetMessage("CATALOG_COMPARE")?></a>
					<?endif?>
					</div>
					<div class="table-offers">
					<?if(!empty($arParams["OFFERS_FIELD_CODE"]) || !empty($arOffer["DISPLAY_PROPERTIES"])):?>
					<table cellspacing="0">
					<?foreach($arParams["OFFERS_FIELD_CODE"] as $field_code):?>
						<tr><td class="catalog-item-offers-field"><span><?echo GetMessage("IBLOCK_FIELD_".$field_code)?>:</span></td><td><?
								echo $arOffer[$field_code];?></td></tr>
					<?endforeach;?>
					<?foreach($arOffer["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<tr><td class="catalog-item-offers-prop"><span><?=$arProperty["NAME"]?>:</td><td><?
							if(is_array($arProperty["DISPLAY_VALUE"]))
								echo implode(" / ", $arProperty["DISPLAY_VALUE"]);
							else
								echo $arProperty["DISPLAY_VALUE"];?></td></tr>
					<?endforeach?>
					</table>
					<?endif;?>
					<?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<div class="catalog-item-price">
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <s><?=$arPrice["PRINT_VALUE"]?></s>
							<?else:?>
								<span class="catalog-item-price"><?=$arPrice["PRINT_VALUE"]?></span>
							<?endif?>
							</div>
						<?endif;?>
					<?endforeach;?>
					</div>
				<?endforeach;?>
				</div>
			<?else:?>
			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				if($arPrice["CAN_ACCESS"]):
?>
				<div class="catalog-item-price">
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <s><?=$arPrice["PRINT_VALUE"]?></s>
				<?else:?>
					<span class="catalog-item-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif;?>
				</div>
			<?
				endif;
			endforeach;
			?>
			<?endif?>
			</div>
		</div>
		<?if(empty($arElement["OFFERS"])):?>
		<div class="catalog-item-links">
			<!--noindex-->
		<?if ($arElement['CAN_BUY']):?>
			<a href="<?echo $arElement["ADD_URL"]?>" class="catalog-item-buy<?/*catalog-item-in-the-cart*/?>" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a>
		<?elseif (count($arResult["PRICES"]) > 0):?>
			<span class="catalog-item-not-available"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></span>
		<?endif;?>

		<?if($arParams["DISPLAY_COMPARE"]):?>
			<a href="<?echo $arElement["COMPARE_URL"]?>" class="catalog-item-compare" onclick="return addToCompare(this, '<?=GetMessage("CATALOG_IN_COMPARE")?>');" rel="nofollow" id="catalog_add2compare_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_COMPARE")?></a>
		<?endif;?>
			<!--noindex-->
		</div>
		<?endif;?>
	</div>
	<div class="catalog-item-separator"></div>
<?endif;?>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
<?endwhile?>
<?endwhile?>
<pre><?print_r($arResult)?></pre>