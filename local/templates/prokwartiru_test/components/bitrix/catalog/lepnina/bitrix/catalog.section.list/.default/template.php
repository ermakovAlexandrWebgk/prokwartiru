<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$filter_price=$_REQUEST["PRICE_ID"];
	$numberFilter=0;
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* ���� */
	if($arSite=="/catalog/test/") $IBLOCK_ID=20; /* ���� */
	if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* ������ */
	if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* ������� */
	if($arSite=="/catalog/lepnina/") $IBLOCK_ID=20; /* ������� */
	if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* ����� */
?>

<?
  if(($arSite=="/catalog/fabriki/")&&(CModule::IncludeModule("iblock"))){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
	if($SECTION_ID=="51") $IBLOCK_ID=5; /* ���� */
	if($SECTION_ID=="78") $IBLOCK_ID=4; /* ������ */
	if($SECTION_ID=="140") $IBLOCK_ID=10; /* ������� */
	//if($SECTION_ID=="1266") $IBLOCK_ID=20; /* ������� */
	if($SECTION_ID=="141") $IBLOCK_ID=11; /* ����� */
    }
  }
?>
<!-- ������ �� �������� -->
<!-- ��������� -->
<?
  if($fabrika) {
    $itemFabrika = CIBlockElement::GetByID($fabrika); 
    if($ar_itemFabrika = $itemFabrika->GetNext()){
      $page_title="<h1 id='page_title' style='margin-left: 10px;'><span>".$ar_itemFabrika['NAME']."</span>";
      if($country=GetIBlockSection($ar_itemFabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
    }   
  $page_title=$page_title."</h1>"; 
  $window_title="������� ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords="������� ".$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- ����� ��������� -->
<!-- ������ ��������� -->
<div class="catalog-item-list">
<!-- ������ ��������� �� �������� -->
<?if($fabrika):?>

<?
// ������
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika);
$arFilterDop=Array();
if($filter_price) $arFilterDop=Array('UF_PRICE' => $filter_price);
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// ����� ������
?>
  <?

    $listCatalogFabrika=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); 
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
      $numberFilter++;
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>&FABRIKA_ID=<?=$fabrika?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>&FABRIKA_ID=<?=$fabrika?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
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

<!-- ����� ������ ��������� �� �������� -->

<!-- ������ ��������� �� ����� -->
<?else:?>

  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <?
    $window_title=$arResult["SECTION"]["NAME"];
    $keywords=$arResult["SECTION"]["NAME"];
  ?>

<?
// ������
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
$arFilterDop=Array();
if($filter_price) $arFilterDop=Array('UF_PRICE' => $filter_price);
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// ����� ������
?>
<? $numberFilter=0; ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); 
    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
      $numberFilter++;
  ?>
	<div class="catalog-item">
<?if(($section==1268)||($section==1269)):?>
  <?$template="karnizy";?>
<?else:?>
  <?$template="lepnina";?>
<?endif?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", $template, array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "20",
	"SECTION_ID" => $itemCatalogType["ID"],
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "N",
	"PAGE_ELEMENT_COUNT" => "40",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => array(
		0 => "ARTICUL",
		1 => "UNIT",
		2 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "SALE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
		0 => "UNIT",
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "������",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "orange",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>




<?
  }
?>
<?endif?>
</div>

<? if(($numberFilter==0) && (($CURRENT_DEPTH==2) || $fabrika)) echo("<p style='padding-left: 10px; line-height: 150%; font-size: 16px;'>��� ��������� ���������� �� ������ ������� ��������� ���������<br />�� ���������: 8 (985) 155 1755 ��� 8 (985) 118 1755.</p>"); ?>

<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text"><div style="margin-left:-10px;"><?=$page_title?></div><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>

<?if($arResult["SECTION"]["DESCRIPTION"]&&$CURRENT_DEPTH==2):?><div class="catalog-item-text"><h1><?=$arResult["SECTION"]["NAME"]?></h1><?=$arResult["SECTION"]["DESCRIPTION"]?></div><?endif?>


<!-- ����� ������ ��������� �� ����� -->

<?$APPLICATION->SetTitle($window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "������� �����, ".$keywords.", ".$keywords." ����, ".$keywords." ������");?>

