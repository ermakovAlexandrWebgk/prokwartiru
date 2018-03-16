<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CModule::IncludeModule('sale');?>
<?if (is_array($arResult['DETAIL_PICTURE_350']) || count($arResult["MORE_PHOTO"])>0):?>
<script type="text/javascript">
$(function() {
	$('div.catalog-detail-image a').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,
		'overlayShow': false,
		'cyclic' : true,
		'padding': 20,
		'titlePosition': 'inside',
		'onComplete': function() {
			$("#fancybox-title").css({ 'top': '100%', 'bottom': 'auto' });
		} 
	});
});
</script>
<?endif;?>

<div class="catalog-detail">

<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
?>

<?if(!$section["ACTIVE"]) { echo ("<h2 style='text-align: center; padding-top: 30px;' class='orange'>Этот артикул временно недоступен</h2>"); return; }?>

<!-- Заголовок страницы -->
<?
  $title="<h1 id='page_title' style='margin-top: 10px;'><span>".$section["NAME"]."</span>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG', 'UF_HIT', 'UF_SALE'));
  if($type_item = $type->GetNext()){
	$title=$title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $title=$title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $title=$title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
        if($type_item['UF_NEWCATALOG']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
        if($type_item['UF_HIT']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='hit'>HIT</span>";
        if($type_item['UF_SALE']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='sale'>SALE</span>";
  }
  $title=$title."</h1>";
?>
<?=$title?>
<!-- Конец Заголовок страницы -->


	<table class="catalog-detail" cellspacing="0" border="0">
		<tr>

		<?if (is_array($arResult['DETAIL_PICTURE_350']) || count($arResult["MORE_PHOTO"])>0):?>
			<td class="catalog-detail-image">
			<?if (is_array($arResult['DETAIL_PICTURE_350'])):?>
				<div class="catalog-detail-image" id="catalog-detail-main-image">
					<a rel="catalog-detail-images" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" title="Арт. <?=$arResult["NAME"]?>"><img src="<?=$arResult['DETAIL_PICTURE_350']['SRC']?>" alt="<?=$arResult["NAME"]?>" id="catalog_detail_image"  /></a>
				</div>
			<?endif;?>

			</td>
		<?endif;?>

			<td class="catalog-detail-desc">
<!-- Заголовок товара -->
<!-- Вид товара -->
<? 
       if($arTitleType_child=GetIBlockSection($arResult['IBLOCK_SECTION_ID'], 'catalog')) {
          $title_type_parent=$arTitleType_child['IBLOCK_SECTION_ID'];
          if($arTitleType_parent=GetIBlockSection($title_type_parent, 'catalog')) echo("<b>".$arTitleType_parent['NAME']."</b><br /><br />");
       }
?>
<!-- Конец Вид товара -->	
			Артикул: <b><?=$arResult["NAME"]?></b>
			<?if($arResult["PREVIEW_TEXT"]):?>
				<?=$arResult["PREVIEW_TEXT"];?>
				<div class="catalog-detail-line"></div>
			<?endif;?>
<!-- Конец Заголовок товара-->
<!-- Цена Товара -->				
				<div class="catalog-detail-price">
				<?foreach($arResult["PRICES"] as $code=>$arPrice):
					if($arPrice["CAN_ACCESS"]):
				?>
				
				  <p>Цена: <!--label>Цена:</label-->
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<span class="catalog-detail-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <span><s><?=$arPrice["PRINT_VALUE"]?></s></span>
					<?else:?>
						<span class="catalog-detail-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif;?>
                                                 <?if($arResult['PROPERTIES']['UNIT']['VALUE']):?>/ <?=$arResult['PROPERTIES']['UNIT']['VALUE'];?><?endif?> 
				  </p>
				<?
						break;
					endif;
				endforeach;
				?>
				</div>
<!-- Конец Цена Товара -->
<!-- Количество Товара -->
<?$itemCatalog = CCatalogProduct::GetByID($arResult["ID"]);?>
Наличие: <?if($itemCatalog["QUANTITY"]>0):?><b class="orange">Есть на складе</b><?else:?><b class="orange">Под заказ</b><?endif?>
<!-- Конец Количество Товара -->
				<?if($arResult["CAN_BUY"]):?>
				<div class="catalog-detail-buttons">
					<!--noindex--><a href="<?=$arResult["ADD_URL"]?>" rel="nofollow" onclick="return addToCart(this, 'catalog_detail_image', 'detail', '<?=GetMessage("CATALOG_IN_BASKET")?>');" id="catalog_add2cart_link"><span><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></span></a><!--/noindex-->
				</div>
				<?endif;?>

				<div class="catalog-item-links">
					<?if(!$arResult["CAN_BUY"] && (count($arResult["PRICES"]) > 0)):?>
					<span class="catalog-item-not-available"><!--noindex--><?=GetMessage("CATALOG_NOT_AVAILABLE");?><!--/noindex--></span>
					<?endif;?>

					<?if($arParams["USE_COMPARE"] == "Y"):?>
					<a href="<?=$arSite?>index.php?action=ADD_TO_COMPARE_LIST&SECTION_ID=<?=$section['ID']?>&id=<?=$arResult["ID"]?>" class="catalog-item-compare" onclick="return addToCompare(this, '<?=GetMessage("CATALOG_IN_COMPARE")?>');" rel="nofollow" id="catalog_add2compare_link" rel="nofollow"><?echo GetMessage("CATALOG_COMPARE")?></a>
					<?endif;?>
				</div>
			</td>
		</tr>
	</table>
	
<?
if (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0):
?>
	<?$arProperty = $arResult["DISPLAY_PROPERTIES"]["RECOMMEND"]?>
	
	<?if(count($arProperty["DISPLAY_VALUE"]) > 0):?>
	<div class="catalog-detail-recommends">
		<h4><?=$arProperty["NAME"]?></h4>
			<div class="catalog-detail-recommend">
			<?
			global $arRecPrFilter;
			$arRecPrFilter["ID"] = $arResult["DISPLAY_PROPERTIES"]["RECOMMEND"]["VALUE"];
			$APPLICATION->IncludeComponent("bitrix:store.catalog.top", "", array(
				"IBLOCK_TYPE" => "",
				"IBLOCK_ID" => "",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "desc",
				"ELEMENT_COUNT" => $arParams["ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"DISPLAY_COMPARE" => "N",
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"FILTER_NAME" => "arRecPrFilter",
				"ELEMENT_COUNT" => 30,
				),
				$component
			);
			?>
		</div>
	</div>
	<?unset($arResult["DISPLAY_PROPERTIES"]["RECOMMEND"])?>
	<?endif;?>
<?endif;?>
<?
if (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0):
?>
<?
		$text="<div class='catalog-detail-properties'>";
		$text=$text."<br /><p>Коллекция: <a href='".$APPLICATION->GetCurDir()."index.php?SECTION_ID=".$section["ID"]."'><b><u>".$section["NAME"]."</u></b></a></p>";
		$text=$text."<p>Фабрика: <a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'><b><u>".$fabrika['NAME']."</u></b></a> (".$country['NAME'].")</p>";
		if($arResult['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."<p>Основные свойства: <b>".$arResult['PROPERTIES']['PROPERTY']['VALUE']."</b></p>";
		if($arResult['PROPERTIES']['SIZE']['VALUE']) $text=$text."<p>Размер: <b>".$arResult['PROPERTIES']['SIZE']['VALUE']."</b></p>";
		if($arResult['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."<p>Раппорт (подбор): <b>".$arResult['PROPERTIES']['RAPPORT']['VALUE']."</b></p>";	
		$text=$text."</div>";
?>
<?endif;?>
<?=$text?>

	<?if($arResult["DETAIL_TEXT"]):?>
	<div class="catalog-detail-full-desc">
		<h4><?=GetMessage('CATALOG_FULL_DESC')?></h4>
		<div class="catalog-detail-line"></div>
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
	<?endif;?>
	
</div>

<?$APPLICATION->SetTitle($arTitleType_parent['NAME']." ".$section['NAME']." (".$fabrika['NAME'].") арт. ".$arResult['NAME']." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetDirProperty("description", $arTitleType_parent['NAME']." ".$section['NAME']."(".$fabrika['NAME'].") арт. ".$arResult['NAME']." в интернет-магазине www.prokwarti.ru");?>
