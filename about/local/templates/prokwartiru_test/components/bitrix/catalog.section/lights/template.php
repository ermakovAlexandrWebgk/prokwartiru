<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $filter_price=$_REQUEST["PRICE_ID"];?>
<? $numberFilter=0;?>

<?CModule::IncludeModule('sale');?>

<!-- Товар в корзине -->
<?
$arPageItems = array();
function inBasket($elementID)
{
// Выведем актуальную корзину для текущего пользователя
	global $arPageItems;
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
	if(in_array($elementID,$arPageItems)) return true;
	else return false;
//return true; echo("$elementID");
}
?>


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
		'autoScale': true,
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
$n=0;
function Add2Basket(path, element) {
	$.ajax({
             type:'POST',
             url:path
            });
	$(document).ready(function(){$("#catalog_add2cart1_link_"+element).click(function () {
		$("#catalog_add2cart1_link_"+element).html("<?=GetMessage("CATALOG_IN_CART")?>").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
		$("#catalog_add2cart_link_"+element).html("<?=GetMessage("CATALOG_IN_CART")?>").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
	}); 	});
}
</script>
<!-- Конец Ajax кнопки -->



<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?if($_REQUEST['SECTION_ID']) $section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
if($arSite=="/catalog/lights/") $iblock_ID=17; /* свет */
?>

<? $rubric=$_REQUEST["RUBRIC_ID"];?>

<!-- Заголовок страницы -->
<?
  if($rubric) {
    $itemRubric = CIBlockElement::GetByID($rubric); 
    if($ar_itemRubric = $itemRubric->GetNext()){
      $page_title="<h1 id='page_title' style='padding-left: 10px;'><span>".$ar_itemRubric['NAME']."</span>";
    }   
  $page_title=$page_title."</h1>"; 
  $window_title="Светильники ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords="Светильники ".$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- Конец Заголовок страницы -->

<div class="catalog-item-cards" style="width: 588px; padding-left: 10px;">

<?if($rubric):?>

<?
$arSort = Array("SORT"=>"ASC");
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_*");

// ФИЛЬТР
$arFilterMain=Array('ACTIVE' => 'Y', "IBLOCK_ID"=>17, "PROPERTY_RUBRIC"=>$rubric);
//global $arFilterDop;

switch ($filter_price) {
case 1:
    $price_min=0; $price_max=3000;
    break;
case 2:
    $price_min=3000; $price_max=5000;
    break;
case 3:
    $price_min=5000; $price_max=10000;
    break;
case 4:
    $price_min=10000; $price_max=15000;
    break;
case 5:
    $price_min=15000; $price_max=1000000;
    break;
default:
    $price_min=0; $price_max=1000000;
    break;
}

$arFilterPrice=Array(">=CATALOG_PRICE_1"=>$price_min, "<=CATALOG_PRICE_1"=>$price_max);

$arFilter = array_merge($arFilterMain, $arFilterPrice);

// Конец ФИЛЬТР
?>
<!-- Конец Фильтр -->

<?$res = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>40), $arSelect);?>

<?$NAV_STRING = $res->GetPageNavStringEx($navComponentObject,  "Товары", "orange");?>
<? $numberElements=0; ?>
<? while($arElement = $res->GetNext())
{ 
//<!-- ЦЕНА -->
   $price = CPrice::GetBasePrice($arElement['ID']);
   $price_print=CurrencyFormat($price['PRICE'], $price['CURRENCY']);
//<!-- Конец ЦЕНА -->

// ОТБОР ПО ДИАПАЗОНУ ЦЕН
//if (($price['PRICE']>$price_min)&&($price['PRICE']<=$price_max))
//{
   $numberElements++;
//echo ($price['PRICE']);

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("HIT", "NEW", "SALE") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>
	<div class="_catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">

<!-- КАРТОЧКА ТОВАРА -->
	<div class="catalog-item-card">
<? $page_url="index.php?SECTION_ID=".$arElement['IBLOCK_SECTION_ID']."&ELEMENT_ID=".$arElement['ID'];?>


<!-- Заголовок карточки -->
  <div class="item-title"><nobr><span>Арт.</span> <a href="<?=$page_url?>" title="<?=$arElement['NAME']?>"><!--?=$arElement["ID"]?--><b><?=$arElement["NAME"]?></b></a><?=$sticker?></nobr></div>
<!-- Конец Заголовок карточки -->



  <div class="item-info">
	<div class="item-desc">
				
<!-- Картинка со всплывающей карточкой товара -->

<!-- Формируем Текст описания товара -->

<!-- Заголовок Название товара -->
	<?$title=$arElement['NAME'];?>
<!-- Конец Заголовок Название товара -->

<!-- Характеристики товара -->
<? $section=GetIBlockSection($arElement["IBLOCK_SECTION_ID"], 'catalog');
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEW','UF_GLUE'));
  if($type_item = $type->GetNext()){
	$fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog');
	$country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog'); 
        //if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
 }
?>
<?
if(CModule::IncludeModule('iblock') && ($element = CIBlockElement::GetByID($arElement["ID"]))) 
{
	if($ar_element = $element->GetNext())
		{
		  $property = CIBlockElement::GetProperty($ar_element['IBLOCK_ID'], $ar_element['ID'], "sort", "asc", Array());
		$text="";
		if($section['NAME']) $text=$text."<p>Коллекция: <b>".$section['NAME']."</b><br />";
		if($fabrika['NAME']) $text=$text."Фабрика: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		while ($ar_property=$property->GetNext())	
			if($ar_property['CODE']=='POWER' || $ar_property['CODE']=='PROPERTY' || $ar_property['CODE']=='SIZE') $text=$text."<p>".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
			elseif($ar_property['CODE']=='NEW') $new=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='HIT') $hit=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='SALE') $sale=$ar_property['VALUE'];
			//$text=$text."<p>".$ar_property['CODE']." ".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
		}
}
?>
<!-- Конец характеристики -->


<!-- Количество Товара -->
<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="Есть на складе"; else $quantity="Под заказ";?>

<!-- Конец Количество Товара -->

<!-- Кнопка Купить -->
<?
	$button_buy="<div class='catalog-item-links'>";
	if ($arElement['CAN_BUY']) {
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
	}
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy.$on."</div>";
	//$arPageItems[] = $arElement["ID"];
?>

<!-- Конец Кнопки Купить -->
<!-- Цена -->
<!-- ЦЕНА -->
<!--? $price = CPrice::GetBasePrice($arElement['ID']);?-->
<!--? $price_print=CurrencyFormat($price['PRICE'], $price['CURRENCY']);?-->
<!-- Конец ЦЕНА -->

<!-- Кнопка Купить -->
<? $add_url="index.php?action=ADD2BASKET&id=".$arElement['ID']."&SECTION_ID=".$arElement['IBLOCK_SECTION_ID'];?>

<?$button_buy="<div class='catalog-item-links'>";
	if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	else $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
?>
<!-- Конец Кнопки Купить -->

<!-- Кнопка В блокнот -->
<? $compare_url="index.php?action=ADD_TO_COMPARE_LIST&SECTION_ID=".$arElement['IBLOCK_SECTION_ID']."&id=".$arElement['ID'];?>

<?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$compare_url."&quot;);'>В блокнот</a></div></div>";?>
<!-- Конец Кнопки В блокнот -->

<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td colspan='2'><b class='big'>".$title_type."</b></td></tr><tr><td class='left'>Артикул: <b class='big'>".$title."</b></td><td class='right'>".$button_compare."</td></tr><tr><td class='left'>Цена: <span class='float-card-price'>".$price_print."</span> / шт.</td><td class='right'>".$button_buy."</td></tr><tr><td colspan='2'>Наличие: <b class='orange'>".$quantity."</b></td></tr><tr><td colspan='2'>".$text."</td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<? $previewPicture=CFile::GetPath($arElement["PREVIEW_PICTURE"]);?>
<? $detailPicture=CFile::GetPath($arElement["DETAIL_PICTURE"]);?>


<div class="item-image">
	<a rel="detail-images" href="<?if($detailPicture):?><?=$detailPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" title="<?=$title_text?>"><img src="<?if($previewPicture):?><?=$previewPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default150.gif<?endif?>" style="<?if($arElement['PREVIEW_PICTURE']['WIDTH']>$arElement['PREVIEW_PICTURE']['HEIGHT']):?>width: 125px;<?else:?>height: 125px;<?endif?>" alt="Арт. <?=$arElement["NAME"]?>" title="Открыть картинку" id="catalog_list_image_<?=$arElement['ID']?>"/></a>
</div>
<!-- Конец Картинка -->

<!-- Конец Всплывающая картинка -->

<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

<div class='item-price'><span class='item-price'><?=$price_print;?></span></div>

</div>
</div>
<div class="catalog-item-links" style="height: 25px; overflow: hidden;">
<!--noindex-->


<div class="buttons">
   <? if(!inBasket($arElement['ID'])):?>
      <a href="<?=$add_url?>" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a>
   <?else:?>
      <a class="catalog-item-in-the-cart"><?=GetMessage("CATALOG_IN_CART")?></a>
   <?endif?>
</div>
	
			<!--noindex-->

</div>
<p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><?$section["NAME"]?><?=$section["NAME"]?><!--?=$arElement["IBLOCK_SECTION_ID"]?--></nobr></p>
	<div style='position: relative; top: -223px; left: -3px;'><?if($new) echo("<span id='new'>NEW</span>"); elseif($hit) echo("<span id='hit'>HIT</span>");  elseif($sale) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>

	</div>
	<div class="catalog-item-separator"></div>


<?
//}
// КОНЕЦ ОТБОР ПО ДИАПАЗОНУ ЦЕН

}
endif?>

</div>

<? if($numberElements==0) echo("<p style='padding-left: 5px; font-size: 16px;'>&mdash;&nbsp;Товар в данном диапазоне цен не найден.</p>"); ?>

<div id="page_navigation">
  <!--?$res->NavPrint("Товары ", false, "", "orange");?-->
  <? echo($NAV_STRING); ?>
  <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
  <?endif;?>
</div>
<?if($section["DESCRIPTION"]):?>
  <div id="catalog-item-text"> 
    <h2><?=$section["NAME"]?></h2>
    <?=$section["DESCRIPTION"]?>
  </div>
<?endif?>