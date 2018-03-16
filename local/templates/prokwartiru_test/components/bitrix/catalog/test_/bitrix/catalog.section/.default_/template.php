<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (count($arResult['ITEMS']) < 1)
	return;
?>



<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<!--h2><-?=$section["NAME"];?-></h2-->

<div class="catalog-item-cards">
<?
foreach ($arResult['ITEMS'] as $key => $arElement):

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
	<div class="_catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
	<div class="catalog-item-card">
		<div class="item-title"><span>арт.</span> <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></div>
		<div class="item-info">
			<div class="item-desc">
				

		<?if($bHasPicture):?>
			<div class="item-image">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="100px<!--?=$arElement['PREVIEW_IMG']['WIDTH']?-->" height="100px<!--?=$arElement['PREVIEW_IMG']['HEIGHT']?-->" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>" /></a>
			</div>
		<?endif;?>


				<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				if($arPrice["CAN_ACCESS"]):
?>
				<div class="item-price">
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <s><?=$arPrice["PRINT_VALUE"]?></s>
				<?else:?>
					<span class="item-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif;?>
				</div>
			<?
				endif;
			endforeach;
			?>
			</div>
		</div>
		<!--div class="catalog-item-links"-->
			<!--noindex-->
		<!--?if ($arElement['CAN_BUY']):?->
			<div class="buttons"><a href="<-?echo $arElement["ADD_URL"]?->" class="catalog-item-buy<-?/*catalog-item-in-the-cart*/?->" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<-?=$arElement['ID']?->', 'list', '<-?=GetMessage("CATALOG_IN_CART")?->');" id="catalog_add2cart_link_<-?=$arElement['ID']?->">В корзину--><!--?echo GetMessage("CATALOG_ADD")?--><!--/a></div>
		<-?elseif (count($arResult["PRICES"]) > 0):?->
			<span class="item-not-available"><-?=GetMessage('CATALOG_NOT_AVAILABLE')?-></span>
		<-?endif;?-->

		<!--?if($arParams["DISPLAY_COMPARE"]):?->
			<div class="buttons"><a href="<-?echo $arElement["COMPARE_URL"]?->" class="catalog-item-compare" onclick="return addToCompare(this, '<-?=GetMessage("CATALOG_IN_COMPARE")?->');" rel="nofollow" id="catalog_add2compare_link_<-?=$arElement['ID']?->">В блокнот--><!--echo GetMessage("CATALOG_COMPARE")?--><!--/a></div>
		<-?endif;?-->
			<!--noindex-->
		<!--/div-->
	</div>
	<div class="catalog-item-separator"></div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>