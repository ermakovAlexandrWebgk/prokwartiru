<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $filter_price=$_REQUEST["PRICE_ID"];?>
<? $numberElements=0; ?>

<?CModule::IncludeModule('sale');?>

<!-- ����� � ������� -->
<?
$arPageItems = array();
function inBasket($elementID)
{
// ������� ���������� ������� ��� �������� ������������
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
// ������� ���������� ������� ��� �������� ������������
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
<!-- ����� ����� � ������� -->


<!-- ���������� �������� ������ -->
<script type="text/javascript">

function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return title+"<p style='padding-bottom:10px; font-weight:normal;'>�����: <b style='color:black;'>"+(currentIndex+1)+"</b> �� "+currentArray.length+"</span></p>";
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
<!-- ����� ���������� �������� ������ -->

<!-- Ajax ������ -->
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
<!-- ����� Ajax ������ -->


<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->

<?$SECTION_ID=$_REQUEST['SECTION_ID'];?>
<?$section=GetIBlockSection($SECTION_ID, 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* ���� */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* ������ */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* ������� */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* ����� */
if($arSite=="/catalog/lights/") $iblock_ID=17; /* ���� */
?>

<!-- ��������� �������� -->
<?
  $page_title="<h1 id='page_title' style='margin-top: 0px;'><span>".$section["NAME"]."</span>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG','UF_GLUE'));
  if($type_item = $type->GetNext()){
	$page_title=$page_title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $page_title=$page_title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
        //if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
         }
  $page_title=$page_title."</h1>";
?>
<?=$page_title?>
<!-- ����� ��������� �������� -->


<!-- ��������� -->
<?if($section){
   if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array());
   if($iblock_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array());
   if($iblock_ID==17) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG_LIGHTS' => $section['ID']), false, array());
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
<!-- ����� ��������� -->

<!-- �������� ������ -->
<div class="catalog-item-cards">

<?
$arSort = Array("SORT"=>"ASC");
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_*");

// ������
$arFilterMain=Array('ACTIVE' => 'Y', "IBLOCK_ID"=>17, "SECTION_ID"=>$SECTION_ID);
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

// ����� ������
?>
<!-- ����� ������ -->

<?$res = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>60), $arSelect);?>

<?$NAV_STRING = $res->GetPageNavStringEx($navComponentObject,  "������", "orange");?>

<!--?foreach ($arResult['ITEMS'] as $key => $arElement):?-->

<? 
while($arElement = $res->GetNext())
{ 
?>
<? $numberElements++; ?>
<?

//<!-- ���� -->
   $price = CPrice::GetBasePrice($arElement['ID']);
   $price_print=CurrencyFormat($price['PRICE'], $price['CURRENCY']);
//<!-- ����� ���� -->


	//$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	//$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>
	<!--div  class="_catalog-item<-?if (!$bHasPicture):?-> no-picture-mode<-?endif;?->" id="<-?=$this->GetEditAreaId($arElement['ID']);?->"-->
	<div class="catalog-item-card">

<!-- ��������� -->
  <div class="item-title"><nobr><span>���.</span> <a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></nobr></div>
<!-- ����� ��������� -->

  <div class="item-info">
	<div class="item-desc">				
<!-- �������� �� ����������� ��������� ������ -->
<!--?if($bHasPicture):?-->

<!-- ��������� ����� �������� ������ -->

<!-- ��������� �������� ������ -->
	<?$title=$arElement['NAME'];?>
<!-- ����� ��������� �������� ������ -->

<!-- �������������� ������ -->
<? $section=GetIBlockSection($arElement["IBLOCK_SECTION_ID"], 'catalog');
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG','UF_GLUE'));
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
		if($section['NAME']) $text=$text."<p>���������: <b>".$section['NAME']."</b><br />";
		if($fabrika['NAME']) $text=$text."�������: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		while ($ar_property=$property->GetNext()){	
			if($ar_property['CODE']=='POWER' || $ar_property['CODE']=='PROPERTY' || $ar_property['CODE']=='SIZE') $text=$text."<p>".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
			elseif($ar_property['CODE']=='NEW') $new=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='HIT') $hit=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='SALE') $sale=$ar_property['VALUE'];
			//$text=$text."<p>".$ar_property['CODE']." ".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
			//if($ar_property['CODE']=='RUBRIC') $rubric_ID=$ar_property['VALUE'];
		}
	}
}
?>
<!-- ����� �������������� -->

<!-- ���� ������ -->
<?
	foreach($arElement["PRICES"] as $code=>$arPrice){
		if($arPrice["CAN_ACCESS"]){ 
			$price="";
			if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) $price=$price."<span class='catalog-item-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span> <s>".$arPrice['PRINT_VALUE']."</s>";
			else $price=$price.$arPrice['PRINT_VALUE'];
			$price="<span class='float-card-price'>".$price."</span> / ��.".$arElement['PROPERTIES']['UNIT']['VALUE'];
		}
	}
?>

<!-- ����� ���� ������ -->

<!-- ���������� ������ -->
<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="���� �� ������"; else $quantity="��� �����";?>
<!-- ����� ���������� ������ -->

<!-- ������ ������ -->
<? $add_url="index.php?action=ADD2BASKET&id=".$arElement['ID']."&SECTION_ID=".$arElement['IBLOCK_SECTION_ID'];?>

<?$button_buy="<div class='catalog-item-links'>";
	if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	else $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
?>
<!-- ����� ������ ������ -->

<!-- ������ � ������� -->
<? $compare_url="index.php?action=ADD_TO_COMPARE_LIST&SECTION_ID=".$arElement['IBLOCK_SECTION_ID']."&id=".$arElement['ID'];?>

<?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$compare_url."&quot;);'>� �������</a></div></div>";?>
<!-- ����� ������ � ������� -->


<!-- ������������ � �������������� �������� ��� ����������� �������� ������ -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card' style='width: 350px;'><tr><td class='left'>�������: <b class='big'>".$title."</b></td><td class='right'>".$button_compare."</td></tr><tr><td class='left'>����: <span class='float-card-price'>".$price_print."</span> / ��.</td><td class='right'>".$button_buy."</td></tr><tr><td colspan='2'>�������: <b class='orange'>".$quantity."</b></td></tr><tr><td colspan='2'>".$text."</td></tr></table>";?>

<!-- ����� �������������� � �������� -->


<!-- ����� ����� �������� -->

<!-- �������� -->
<? $previewPicture=CFile::GetPath($arElement["PREVIEW_PICTURE"]);?>
<? $detailPicture=CFile::GetPath($arElement["DETAIL_PICTURE"]);?>

<div class="item-image">
	<a rel="detail-images" href="<?if($detailPicture):?><?=$detailPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" title="<?=$title_text?>"><img src="<?if($previewPicture):?><?=$previewPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default150.gif?><?endif?>" style="<?if($arElement['PREVIEW_IMG']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?>width: 125px;<?else:?>height: 125px;<?endif?>" alt="���. <?=$arElement["NAME"]?>" title="���. <?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>"/></a>
</div>
<!-- ����� �������� -->
<!--?endif;?-->

<!-- ����� ����������� �������� -->


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
<!--?$rubric=GetIBlockElement($rubric_ID, 'catalog');?-->
<p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><!--?=$rubric['NAME']?--><?=$section["NAME"]?></nobr></p>
	<div style='position: relative; top: -223px; left: -3px;'><?if($new) echo("<span id='new'>NEW</span>"); elseif($hit) echo("<span id='hit'>HIT</span>");  elseif($sale) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>

	<div class="catalog-item-separator"></div>

<? } ?>
<!--?endforeach;?-->

<? if($numberElements==0) echo("<p style='padding-left: 5px; font-size: 16px;'>&mdash;&nbsp;����� � ������ ��������� ��� �� ������.</p>"); ?>

</div>
<!-- ����� �������� ������ -->

<div id="page_navigation">
  <!--?$res->NavPrint("������ ", false, "", "orange");?-->
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
