<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$filter_price=$_REQUEST["PRICE_ID"];
	$filter_structure=$_REQUEST["STRUCTURE_ID"];
	$filter_discounts=$_REQUEST["DISCOUNTS"]; 
	$numberFilter=0;
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* обои */
	if($arSite=="/catalog/") $IBLOCK_ID=4; /* плитка */
	if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* плитка */
	if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* мозаика */
	if($arSite=="/catalog/lepnina/") $IBLOCK_ID=20; /* лепнина */
	if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* шторы */
?>

<?
  if(($arSite=="/catalog/fabriki/")&&(CModule::IncludeModule("iblock"))){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
	if($SECTION_ID=="51") $IBLOCK_ID=5; /* обои */
	if($SECTION_ID=="78") $IBLOCK_ID=4; /* плитка */
	if($SECTION_ID=="140") $IBLOCK_ID=10; /* мозаика */
	//if($SECTION_ID=="1266") $IBLOCK_ID=20; /* лепнина */
	if($SECTION_ID=="141") $IBLOCK_ID=11; /* шторы */
    }
  }
?>
<!-- Фильтр по фабрикам -->
<!-- Заголовок -->
<?
  if($fabrika) {
    $itemFabrika = CIBlockElement::GetByID($fabrika); 
    if($ar_itemFabrika = $itemFabrika->GetNext()){
      $page_title="<h1 id='page_title' style='margin-left: 10px;'><span>".$ar_itemFabrika['NAME']."</span>";
      if($country=GetIBlockSection($ar_itemFabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
    }   
  $page_title=$page_title."</h1>"; 
  $window_title="Плитка ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords="Плитка ".$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- Конец Заголовок -->

<!-- Список каталогов -->
<div class="catalog-item-list" style="width:310px;">

<?if($section):?>
  <?
    $window_title=$arResult["SECTION"]["NAME"];
    if($section==1) $window_title="Плитка ";
    $keywords=$arResult["SECTION"]["NAME"];
  ?>

<?
// ФИЛЬТР
//$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
if($section!=1) $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
else $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => Array(31, 83, 84, 85, 401, 1881, 1882, 1883));
$arFilterDop=Array();
$arFilterDop1=Array();
if($filter_price) $arFilterDop=Array('UF_PRICE' => $filter_price);
if($filter_structure) $arFilterDop1=Array('UF_STRUCTURE' => $filter_structure);
//global $arFilterDop;
if($filter_discounts) $arFilterDop=array_merge($arFilterDop, Array('UF_SALE_PLITKA'=>array(53, 54, 55, 56, 57, 58, 59) ) );
$arFilter = array_merge($arFilterMain, $arFilterDop, $arFilterDop1);
// Конец ФИЛЬТР
?>


<!-- Скидка дня -->
<?  if($filter_discounts&&($section==1)) {
      $arFilterDiscountOfDay = array_merge($arFilterMain, Array('UF_DISCOUNT10'=>true));
      //$arFilterDiscountOfDay = array_merge($arFilterMain, Array('UF_DISCOUNT5'=>true));

      $listCatalogDiscountOfDay=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilterDiscountOfDay , false, $arSelect=array('UF_FABRIKA', 'UF_DISCOUNT10'), Array('nPageSize'=>60));

    while($itemCatalogType=$listCatalogDiscountOfDay->GetNext()) 
    {
?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><b><nobr><?=$itemCatalogType["NAME"]?></nobr></b></a></div>
	  <div class="catalog-item-title" style="font-size: 13px;">
            <nobr>
	    <?
		if($itemCatalogType['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($itemCatalogType['UF_FABRIKA']);
      	        if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	    </nobr></div>
	  <div style='position: relative; top: -175px; left: -3px;'><span id='sale'><?if($itemCatalogType["UF_DISCOUNT10"]):?>-10%<?elseif($itemCatalogType["UF_DISCOUNT5"]):?>-5%<?endif?></span></div>
	</div>
<?
    }
}
?>
<!-- Конец Скидка дня -->

<? $numberFilter=0; ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    //$listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section), false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); 
    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_DISCOUNT5', 'UF_SALE_PLITKA', 'UF_ACTION'), Array("nPageSize"=>60));
    $NAV_STRING = $listCatalogType->GetPageNavStringEx($navComponentObject,  "Товары", "orange");

    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
      $numberFilter++;

$saleID="";
$sale="";
$saleID=$itemCatalogType["UF_SALE_PLITKA"];
if($saleID){
  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_PLITKA"));
    if($ar_res = $res->GetNext())
      $sale=$ar_res["VALUE"];
  //if($sale=="нет") $sale="";
}
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogType["NAME"]?></b></nobr></a></div>
	  <div  class="catalog-item-title" style="font-size: 13px;">
	    <?
		if($itemCatalogType['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($itemCatalogType['UF_FABRIKA']);
      	  if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	  </div>
	  <!--div style='position: relative; top: -175px; left: -3px;'><-?if($itemCatalogType["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogType["UF_HIT"]) echo("<span id='hit'>ХИТ</span>");  elseif($itemCatalogType["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?-></div-->


	  <div style='position: relative; top: -175px; left:-3px; float:left;'><?if($sale) echo("<span id='sale'>SALE</span><span id='sale'>".$sale."</span>"); elseif($itemCatalogType["UF_ACTION"]) echo("<span id='sale' style='background-color: #ffce0c;'>ЛУЧШАЯ ЦЕНА</span>");  elseif($itemCatalogType["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogType["UF_DISCOUNT5"]) echo("<span id='sale'>-5%</span>"); elseif($itemCatalogType["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<div style='left: -3px; width:0px;'><span id='lable'></span></div>");?></div>

	  <?if($itemCatalogType["UF_NEWCATALOG"]) echo("<div style='position: relative; top: -175px; left:-3px; float:left;'><span id='new'>NEW</span></div>"); ?>
	  <?if($itemCatalogType["UF_HIT"]) echo("<div style='position: relative; top: -175px; left:-3px;'><span id='hit'>HIT</span></div>"); ?>
	</div>

	<!--/div-->
<?
  }
?>
<?endif?>
</div>
<!-- Конец Список каталогов По Видам -->

   <? if(($numberFilter==0) && (($CURRENT_DEPTH==2) || $fabrika)) echo("<p style='padding-left: 10px; line-height: 150%; font-size: 16px;'>Для уточнения информации по данной позиции позвоните менеджеру<br />по телефонам: 8 (985) 155 1755 или 8 (985) 118 1755.</p>"); ?>

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>
   <?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text"><?=$page_title?><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>
   <div class="catalog-item-text">
	    <?
		if($arSection["IBLOCK_SECTION_ID"]) $typeCatalog=CIBlockSection::GetByID($arSection["IBLOCK_SECTION_ID"]);
		 if($typeCatalog) if($ar_typeCatalog=$typeCatalog->GetNext()) echo $ar_typeCatalog["DESCRIPTION"];
	    ?>
   </div>



<?$APPLICATION->SetTitle($window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог плитки, ".$keywords.", плитка ".$keywords.", плитка ".$keywords." цена, плитка ".$keywords." купить");?>

