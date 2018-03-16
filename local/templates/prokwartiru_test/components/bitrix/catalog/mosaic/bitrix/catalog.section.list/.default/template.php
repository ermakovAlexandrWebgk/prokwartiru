<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$filter_price=$_REQUEST["PRICE_ID"];
	$filter_width=$_REQUEST["WIDTH_ID"];
	$filter_type=$_REQUEST["TYPE"];
	$numberFilter=0;
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* обои */
	if($arSite=="/catalog/test/") $IBLOCK_ID=5; /* обои */
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
  $window_title="Мозаика ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords="Мозаика ".$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- Конец Заголовок -->

<!-- Список каталогов -->
<div class="catalog-item-list">
<!-- Список каталогов По фабрикам -->
<?if($fabrika):?>

<?
// ФИЛЬТР
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika);
$arFilterDop=Array();
if($filter_price) $arFilterDop=array_merge($arFilterDop, Array('UF_PRICE'=>$filter_price));
if($filter_width) $arFilterDop=array_merge($arFilterDop, Array('UF_WIDTH'=>$filter_width));
if($filter_type=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($filter_type=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// Конец ФИЛЬТР
?>

  <?

    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); //'left_margin'=>'asc'
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
      $numberFilter++;
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
	  <div  class="catalog-item-title" style="font-size: 13px;">
	    <?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?>
	  </div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogFabrika["UF_HIT"]) echo("<span id='hit'>HIT</span>");  elseif($itemCatalogFabrika["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
<?
  }
?>


<!-- Конец Список каталогов По фабрикам -->

<!-- Список каталогов По Видам -->
<?else:?>

  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <?
    $window_title=$arResult["SECTION"]["NAME"];
    $keywords=$arResult["SECTION"]["NAME"];
  ?>

<?
// ФИЛЬТР
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
$arFilterDop=Array();
//global $arFilterDop;
if($filter_price) $arFilterDop=array_merge($arFilterDop, Array('UF_PRICE'=>$filter_price));
if($filter_width) $arFilterDop=array_merge($arFilterDop, Array('UF_WIDTH'=>$filter_width));
if($filter_type=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($filter_type=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
$arFilter = array_merge($arFilterMain, $arFilterDop);
// Конец ФИЛЬТР
?>

<? $numberFilter=0; ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    //$listCatalogType=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); //'left_margin'=>'asc'

    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE'), Array("nPageSize"=>60)); 
    $NAV_STRING = $listCatalogType->GetPageNavStringEx($navComponentObject,  "Товары", "orange");

    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
      $numberFilter++;
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogType["NAME"]?></b></nobr></a></div>
	  <div class="catalog-item-title" style="font-size: 13px;">
            <nobr>
	    <!--?
		if($itemCatalogType["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?-->
	    <?
		if($itemCatalogType['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($itemCatalogType['UF_FABRIKA']);
      	        if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	    </nobr></div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($itemCatalogType["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogType["UF_HIT"]) echo("<span id='hit'>HIT</span>");  elseif($itemCatalogType["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
<?
  }
?>
<?endif?>
</div>

<? if(($numberFilter==0) && (($CURRENT_DEPTH==2) || $fabrika)) echo("<p style='padding-left: 10px; line-height: 150%; font-size: 16px;'>Для уточнения информации по данной позиции позвоните менеджеру<br />по телефонам: 8 (985) 155 1755 или 8 (985) 118 1755.</p>"); ?>

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>

<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text"><div style="margin-left:-10px;"><?=$page_title?></div><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>

<?if($arResult["SECTION"]["DESCRIPTION"]&&$CURRENT_DEPTH==2):?><div class="catalog-item-text"><h1><?=$arResult["SECTION"]["NAME"]?></h1><?=$arResult["SECTION"]["DESCRIPTION"]?></div><?endif?>


<!-- Конец Список каталогов По Видам -->

<?$APPLICATION->SetTitle($window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог мозаики, ".$keywords.", ".$keywords." цена, ".$keywords." купить");?>

