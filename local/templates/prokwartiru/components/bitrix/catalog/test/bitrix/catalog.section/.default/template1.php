<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CModule::IncludeModule('sale');?>
<!-- Товар в корзине -->

<?
// Выведем актуальную корзину для текущего пользователя

$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
        false,
        false,
        array()
    );

while ($arItems = $dbBasketItems->Fetch())
{
	if ($arItems['PRODUCT_ID'])
	{
		if($arItem["DELAY"] == "Y")
			$arPageItemsDelay[] = $arItems['PRODUCT_ID'];
		else
			$arPageItems[] = $arItems['PRODUCT_ID'];
	}
}
?>
<!-- Конец Товар в корзине -->

<!-- Всплывание карточки товара -->
<script type="text/javascript">

function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return title+"<p style='padding-bottom:10px; font-weight:normal;'>Товар: <b style='color:black;'>"+(currentIndex+1)+"</b> из "+currentArray.length+"</span></p>";
}
$(function() {
	$('div.item-image a').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,
		'overlayShow': false,
		'cyclic' : true,
		'padding': 20,
		'titlePosition': 'inside',
		'hideOnContentClick': false,
		'height': 600,
		'titleFormat': formatTitle
	});
});
</script>
<!-- Конец Всплывания карточки товара -->

<!-- Ajax кнопки -->
<script type="text/javascript">

function Add22Compare(path) {     
     $.ajax({
             type:'POST',
             url:path
            })
}

function Add2Basket(path, element) {
	$.ajax({
             type:'POST',
             url:path
            });
	$(document).ready(function(){$("#catalog_add2cart_link").click(function () {
		$(this).html("<?=GetMessage("CATALOG_IN_CART")?>").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
		$("#catalog_add2cart_link_"+element).html("<?=GetMessage("CATALOG_IN_CART")?>").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
	}); 	});
}
</script>
<!-- Конец Ajax кнопки -->


<?
if (count($arResult['ITEMS']) < 1)
	return;
?>

<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
?>

<!-- Заголовок страницы -->
<?
  $title="<div id='page_title'><span>".$section["NAME"]."</span>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA'));
  if($type_item = $type->GetNext()){
	$title=$title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $title=$title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $title=$title." .<span style='font-size: 80%;'>".$country['NAME']."</span>"; 
  }
  $title=$title."</div>";
?>
<?=$title?>
<!-- Конец Заголовок страницы -->
<!-- Навигация -->
<div id="page_navigation" style="padding-bottom: 20px;">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>
<!-- Конец Навигация -->
<!-- Интерьеры -->
<?if($section){
   if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array());
   if($iblock_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array());
}?>
<?if($Interiers):?>
  <div class="catalog-interier-cards">
    <?while($arInteriers = $Interiers->GetNext()){
		$arInteriersPathPreview = CFile::GetPath($arInteriers["PREVIEW_PICTURE"]);
		$arInteriersPathDetail = CFile::GetPath($arInteriers["DETAIL_PICTURE"]);
  ?>
	<div class="catalog-interier-card">
		<div class="item-title" style="text-align: center;"><?=$arInteriers["NAME"]?><?=$sticker?></div>
  		<div class="item-image">
			<a rel="detail-images" href="<?=$arInteriersPathDetail?>" title="<div id='interier_name'><?=$arInteriers['NAME']?></div>"><img src="<?=$arInteriersPathPreview?>" alt="<?=$arInteriers['NAME']?>" title="<?=$arInteriers['NAME']?>" id="catalog_list_image_<?=$arInteriers['ID']?>" /></a>
		</div>
	  </div>
    <? }?>
  </div>
<?endif?>

<!-- Конец Интерьеры -->

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


<!-- Заголовок -->
  <div class="item-title"><span>Арт.</span> <a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></div>
<!-- Конец Заголовок -->

  <div class="item-info">
	<div class="item-desc">				
<!-- Картинка со всплывающей карточкой товара -->
<!--?if($bHasPicture):?-->

<!-- Формируем Текст описания товара -->

<!-- Заголовок Название товара -->
	<?$title=$arElement['NAME'];?>
<!-- Конец Заголовок Название товара -->

<!-- Характеристики товара -->
<?
	if (is_array($arElement['DISPLAY_PROPERTIES']) && count($arElement['DISPLAY_PROPERTIES']) > 0){
		$text="<div class='float-card-properties'>";
		if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."<p><b>".$arElement['PROPERTIES']['PROPERTY']['VALUE']."</b><br />";
		if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."Размер: <b>".$arElement['PROPERTIES']['SIZE']['VALUE']."</b><br />";
		if($arElement['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."Раппорт (подбор): <b>".$arElement['PROPERTIES']['RAPPORT']['VALUE']."</b></p>";	
		//if($arElement["DETAIL_PAGE_URL"]) $text=$text."<p><a href='".$arElement["DETAIL_PAGE_URL"]."'>Подробнее</a></p>";	
		$text=$text."</div>";
	}
?>
<!-- Конец Характеристики торава -->

<!-- Цена Товара -->
<?
	foreach($arElement["PRICES"] as $code=>$arPrice){
		if($arPrice["CAN_ACCESS"]){ 
			$price="";
			if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) $price=$price."<span class='catalog-item-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span> <s>".$arPrice['PRINT_VALUE']."</s>";
			else $price=$price.$arPrice['PRINT_VALUE'];
			$price="<span class='float-card-price'>".$price."</span> / ".$arElement['PROPERTIES']['UNIT']['VALUE'];
		}
	}
?>

<!-- Конец Цена Товара -->

<!-- Количество Товара -->

<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="Есть на складе"; else $quantity="Под заказ";?>

<!-- Конец Количество Товара -->

<!-- Кнопка Купить -->
<!--?
	$button_buy="<div class='catalog-item-links'>";
	if ($arElement['CAN_BUY']) $button_buy=$button_buy."<div class='buttons'><a href='".$arElement['ADD_URL']."' class='catalog-item-buy' rel='nofollow'  onclick='return addToCart(this, 'catalog_list_image_".$arElement['ID']."', 'list', '".GetMessage('CATALOG_IN_CART')."');' id='catalog_add2cart_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy."</div>";
?-->
<?
	$button_buy="<div class='catalog-item-links'>";
	if ($arElement['CAN_BUY']) {
		if(!in_array($arElement["ID"],$arPageItems)) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart_link'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart_link'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
	}
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy.$on."</div>";
	//$arPageItems[] = $arElement["ID"];
?>


<!-- Конец Кнопки Купить -->

<!-- Кнопка В блокнот -->
<!--?
	if($arParams["DISPLAY_COMPARE"]) $button_compare="<div class='catalog-item-links'><div class='buttons'><a href='".$arElement['COMPARE_URL']."' class='catalog-item-compare' onclick='addToCompare(this, 'В блокноте');' rel='nofollow' id='catalog_add2compare_link_".$arElement['ID']."'>".GetMessage('CATALOG_COMPARE')."</a></div></div>";
?-->
<!--?echo $arElement["COMPARE_URL"]?-->
<!--?
$path=$arElement["ID"];
	if($arParams["DISPLAY_COMPARE"]) $button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' class='catalog-item-compare' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);' rel='nofollow' id='catalog_add2compare_link_".$arElement['ID']."'>".$path."-".GetMessage('CATALOG_COMPARE')."</a></div></div>";
?-->

<?if($arParams["DISPLAY_COMPARE"]):?>
<?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);'>В блокнот</a></div></div>";?>
<?endif?>
<!-- Конец Кнопки В блокнот -->


<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td class='left'>Артикул: <b class='big'>".$title."</b></td><td class='right'>".$button_compare."</td></tr><tr><td class='left'>Цена: ".$price."</td><td class='right'>".$button_buy."</td></tr><tr><td colspan='2'>Наличие: <b class='orange'>".$quantity."</b></td></tr><td colspan='2'>".$text."</td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<div class="item-image">
	<a rel="detail-images" href="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" title="<?=$title_text?>"><img src="<?if($arElement['PREVIEW_IMG']['SRC']):?><?=$arElement['PREVIEW_IMG']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default100.gif?><?endif?>" style="<?if($arElement['PREVIEW_IMG']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?>width: 100px;<?else:?>height: 100px;<?endif?>" alt="Арт. <?=$arElement["NAME"]?>" title="Арт. <?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>"/></a>
</div>
<!-- Конец Картинка -->
<!--?endif;?-->

<!-- Конец Всплывающая картинка -->


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

<div class="catalog-item-links">
			<!--noindex-->
		<!--?if($arParams["DISPLAY_COMPARE"]):?->
			<div class="buttons"><a href="<-?echo $arElement["COMPARE_URL"]?->" class="catalog-item-compare" onclick="return addToCompare(this, '<-?=GetMessage("CATALOG_IN_COMPARE")?->');" rel="nofollow" id="catalog_add2compare_link_<-?=$arElement['ID']?->"><-?echo GetMessage("CATALOG_COMPARE")?-></a></div>
		<-?endif;?-->

		<?if ($arElement['CAN_BUY']):?>
			<!--div class="buttons"><a href="<-?echo $arElement["ADD_URL"]?->" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<-?=$arElement['ID']?->', 'list', '<-?=GetMessage("CATALOG_IN_CART")?->');" id="catalog_add2cart_link_<-?=$arElement['ID']?->"><-?echo GetMessage("CATALOG_ADD")?-></a></div-->
			<div class="buttons"><a href="<?echo $arElement["ADD_URL"]?>" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a></div>
			<!--div class="buttons"><a href="javascript:;" class="catalog-item-buy" rel="nofollow"  onclick="javascript: Add2Basket('<-?=$arElement["ADD_URL"]?->'); addToCart(this, 'catalog_list_image_<-?=$arElement['ID']?->', 'list', '<-?=GetMessage("CATALOG_IN_CART")?->');" id="catalog_add2cart_link_<-?=$arElement['ID']?->"><-?echo GetMessage("CATALOG_ADD")?-></a></div-->
		<?elseif (count($arResult["PRICES"]) > 0):?>
			<span class="catalog-item-not-available"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></span>
		<?endif;?>	
			<!--noindex-->



</div>


	</div>
	<div class="catalog-item-separator"></div>
<?endforeach;?>
</div>

<div id="page_navigation">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>
