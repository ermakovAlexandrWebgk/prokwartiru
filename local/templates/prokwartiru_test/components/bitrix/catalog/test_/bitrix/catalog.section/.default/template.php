<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

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

<?
function readBasket()
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
<!--?if($n==0) $n=1; else $n=0;?-->
}
</script>
<!-- Конец Ajax кнопки -->


<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->

<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/test/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
?>

<!-- Заголовок страницы -->
<?
  $page_title="<h1 id='page_title' style='margin-top: 0px;'><span>".$section["NAME"]."</span>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG','UF_GLUE', 'UF_MARK'));
  if($type_item = $type->GetNext()){
	$page_title=$page_title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $page_title=$page_title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
        if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
        if($fabrika['NAME']=="Loymina") $page_title=$page_title." <span style='font-size: 12px;'>&nbsp;&nbsp;&mdash;&nbsp;Бесплатная доставка</span>";
 }
  $page_title=$page_title."</h1>";
?>
<?=$page_title?>
<!-- Конец Заголовок страницы -->

<!-- Условные обозначения -->
<div id="mark"> 
<!--?=$type_item['UF_MARK'][0]?-->
<?foreach($type_item['UF_MARK'] as $markID):?>
	<?if($mark=GetIBlockElement($markID, 'catalog')):?>
	   <?$mark_pic=CFile::GetPath($mark["PREVIEW_PICTURE"]);?>
	   <?if($mark_pic):?>
		<img src="<?=$mark_pic?>" style="width: 40px; height: 40px; cursor: help; margin: 0 5px 5px 0;" title="<?=$mark['NAME']?>">
  	   <?endif?>
	<?endif?>
<?endforeach?>
</div>
<!-- Конец Условные обозначения -->


<!-- Клей -->
<?if($glue=GetIBlockElement($type_item['UF_GLUE'], 'catalog')) $glue_pic=CFile::GetPath($glue["PREVIEW_PICTURE"]);?>
<?if($glue):?>
  <div id="glue"> 
	<p><a href="/catalog/glue/?ELEMENT_ID=<?=$glue['ID']?>">
	<?if($glue_pic):?><img src="<?=$glue_pic?>"><?endif?>
	С этими обоями фабрика рекомендует клей KLEO</a></p>
  </div>
<?endif?>
<!-- Конец Клей -->

<!-- Навигация -->
<div id="page_navigation" style="margin-top: 0px; padding-bottom: 20px;">
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
  <div class="catalog-interier-cards" style="width: 735px;">
    <?while($arInteriers = $Interiers->GetNext()){
		//$arInteriersPathPreview = CFile::GetPath($arInteriers["PREVIEW_PICTURE"]);
		$arInteriersPathPreview = CFile::GetPath($arInteriers["DETAIL_PICTURE"]);
		$arInteriersPathDetail = CFile::GetPath($arInteriers["DETAIL_PICTURE"]);
  ?>
	<div class="catalog-interier-card">
		<div class="item-title" style="text-align: center;"><?=$arInteriers["NAME"]?><?=$sticker?></div>
  		<div class="item-image">
			<a rel="detail-images" href="<?=$arInteriersPathDetail?>" title="<div id='interier_name'><?=$arInteriers['NAME']?></div>"><img src="<?=$arInteriersPathPreview?>" alt="<?=$arInteriers['NAME']?>" title="<?=$arInteriers['NAME']?>" id="catalog_list_image_<?=$arInteriers['ID']?>" width="125" height="125" /></a>
		</div>
	  </div>
    <? }?>
  </div>
<?endif?>

<!-- Конец Интерьеры -->
<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->
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

<!-- Заголовок Вид товара -->
<!--? 
       if($arTitleType_child=GetIBlockSection($arElement['IBLOCK_SECTION_ID'], 'catalog')) {
          $title_type_parent=$arTitleType_child['IBLOCK_SECTION_ID'];
          if($arTitleType_parent=GetIBlockSection($title_type_parent, 'catalog'))$title_type=$arTitleType_parent['NAME'];
       }
       if($iblock_ID==5) $title_type=$title_type." обои";

?-->

<!-- Конец Заголовок Вид товара -->
<!-- Заголовок Название товара -->
	<?$title=$arElement['NAME'];?>
<!-- Конец Заголовок Название товара -->

<!-- Характеристики товара -->
<?
	if (is_array($arElement['DISPLAY_PROPERTIES']) && count($arElement['DISPLAY_PROPERTIES']) > 0){
		$text="<div class='float-card-properties'>";
		if($section["NAME"]) $text=$text."<p>Коллекция: <b>".$section["NAME"]."</b>";
                if($type_item['UF_NEWCATALOG']) $text=$text."&nbsp;<span id='new'>NEW</span><br />"; else $text=$text."<br />";
		if($fabrika['NAME']) $text=$text."Фабрика: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."Основные свойства: ".$arElement['PROPERTIES']['PROPERTY']['VALUE']."<br />";
		if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."Размер: ".$arElement['PROPERTIES']['SIZE']['VALUE']."<br />";
		if($arElement['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."Раппорт (подбор): ".$arElement['PROPERTIES']['RAPPORT']['VALUE']."</p>";	
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
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	//	if($n==1) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
		//if($n==0) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
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

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td colspan='2'><b class='big'>".$title_type."</b></td></tr><tr><td class='left'>Артикул: <b class='big'>".$title."</b></td><td class='right'>".$button_compare."</td></tr><tr><td class='left'>Цена: ".$price."</td><td class='right'>".$button_buy."</td></tr><tr><td colspan='2'>Наличие: <b class='orange'>".$quantity."</b></td></tr><tr><td colspan='2'>".$text."</td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<div class="item-image">
	<a rel="detail-images" href="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" title="<?=$title_text?>"><img src="<?if($arElement['PREVIEW_IMG']['SRC']):?><?=$arElement['PREVIEW_IMG']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default150.gif?><?endif?>" style="<?if($arElement['PREVIEW_IMG']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?>width: 125px;<?else:?>height: 125px;<?endif?>" alt="Арт. <?=$arElement["NAME"]?>" title="Арт. <?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>"/></a>
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
<div class="catalog-item-links" style="height: 25px; overflow: hidden;">
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
<p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><?=$section["NAME"]?></nobr></p>

	</div>

	<div class="catalog-item-separator"></div>
<?endforeach;?>
</div>

<div id="page_navigation">
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