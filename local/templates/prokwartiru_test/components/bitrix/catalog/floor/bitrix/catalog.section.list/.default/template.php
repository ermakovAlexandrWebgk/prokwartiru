<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$filter_price=$_REQUEST["PRICE_ID"];
	$filter_width=$_REQUEST["WIDTH_ID"];
	$filter_type=$_REQUEST["TYPE"]; 
	$filter_discounts=$_REQUEST["DISCOUNTS"]; 
	$numberFilter=0;
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* обои */
	if($arSite=="/catalog/test/") $IBLOCK_ID=5; /* обои */
	if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* плитка */
	if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* мозаика */
	if($arSite=="/catalog/lepnina/") $IBLOCK_ID=20; /* лепнина */
	if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* шторы */
	if($arSite=="/catalog/floor/") $IBLOCK_ID=24; /* паркет */

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
	if($SECTION_ID=="3209") $IBLOCK_ID=24; /* паркет */

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
  $window_title="Паркет ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $description=$window_title;
  $keywords="Паркет ".$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- Конец Заголовок -->

<!-- Список каталогов -->
<div class="catalog-item-list" style="width:590px; margin-left:0px;">
<!-- Список каталогов По фабрикам -->
<?if($fabrika):?>
<?
// ФИЛЬТР
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika); 
$arFilterDop=Array();
if($section&&$section!=1) $arFilterDop=array_merge($arFilterDop, Array('SECTION_ID'=>$section));
if($filter_price) $arFilterDop=array_merge($arFilterDop, Array('UF_PRICE'=>$filter_price));
if($filter_width) $arFilterDop=array_merge($arFilterDop, Array('UF_WIDTH'=>$filter_width));
if($filter_type=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($filter_type=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// Конец ФИЛЬТР
?>

  <?

    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_SALE_FLOOR', 'UF_ACTION')); //'left_margin'=>'asc'
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
      $numberFilter++;
$saleID="";
$sale="";
$saleID=$itemCatalogFabrika['UF_SALE_FLOOR'];
if($saleID){
  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_FLOOR"));
    if($ar_res = $res->GetNext())
      $sale=$ar_res["VALUE"];
  //if($sale=="нет") $sale="";
}
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
	  <div style='position: relative; top: -175px; left: -3px;'><? if($sale) echo("<span id='sale'>SALE ".$sale."</span>");  elseif($itemCatalogFabrika["UF_ACTION"]) echo("<span id='sale' style='background-color:#ffce0c;'>ЛУЧШАЯ ЦЕНА</span>"); elseif($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogFabrika["UF_HIT"]) echo("<span id='hit'>HIT</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogFabrika["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
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
    if($section==1) $window_title="Паркет ";
    $description=$window_title;
    $keywords=$arResult["SECTION"]["NAME"];
  ?>

<?
// ФИЛЬТР
if($section!=1) $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
else $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => Array(42, 43, 44, 45, 46, 48, 49, 50, 58));
$arFilterDop=Array();
//global $arFilterDop;
if($filter_discounts) $arFilterDop=array_merge($arFilterDop, Array('UF_SALE_FLOOR'=>array(46, 47, 48, 49, 50, 51, 52) ) );
if($filter_price) $arFilterDop=array_merge($arFilterDop, Array('UF_PRICE'=>$filter_price));
if($filter_width) $arFilterDop=array_merge($arFilterDop, Array('UF_WIDTH'=>$filter_width));
if($filter_type=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($filter_type=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
$arFilter = array_merge($arFilterMain, $arFilterDop);
// Конец ФИЛЬТР
?>


<!-- Скидка дня -->
<?  if($filter_discounts&&($section==1)) {
      $arFilterDiscountOfDay = array_merge($arFilterMain, Array('UF_DISCOUNT10'=>true));

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
	  <div style='position: relative; top: -175px; left: -3px;'><span id='sale'>-10%</span></div>
	</div>
<?
    }
}
?>
<!-- Конец Скидка дня -->

<? $numberFilter=0; ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    //$listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_ACTION')); 

    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_SALE_FLOOR', 'UF_ACTION'), Array('nPageSize'=>60)); 
    $NAV_STRING = $listCatalogType->GetPageNavStringEx($navComponentObject,  "Товары", "orange");

    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
      $numberFilter++;
$saleID="";
$sale="";
$saleID=$itemCatalogType["UF_SALE_FLOOR"];
if($saleID){
  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_FLOOR"));
    if($ar_res = $res->GetNext())
      $sale=$ar_res["VALUE"];
  //if($sale=="нет") $sale="";
}
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><b><nobr><?=$itemCatalogType["NAME"]?></nobr></b></a></div>
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
	  <div style='position: relative; top: -175px; left: -3px;'><?if($sale) echo("<span id='sale'>SALE</span><span id='sale'>".$sale."</span>"); elseif($itemCatalogType["UF_ACTION"]) echo("<span id='sale' style='background-color: #ffce0c;'>ЛУЧШАЯ ЦЕНА</span>"); elseif($itemCatalogType["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogType["UF_HIT"]) echo("<span id='hit'>HIT</span>"); elseif($itemCatalogType["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogType["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
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
<!--?
        $arButtons = CIBlock::GetPanelButtons(
            $ar_itemFabrika["IBLOCK_ID"],
            $ar_itemFabrika["ID"],
            0,
            array("SECTION_BUTTONS"=>false, "SESSID"=>false)
        );
        $ar_itemFabrika["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $ar_itemFabrika["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
?-->
<!--? $this->AddEditAction($ar_itemFabrika['ID'], $ar_itemFabrika['EDIT_LINK'], CIBlock::GetArrayByID("6", "ELEMENT_EDIT")); ?-->
<? $this->AddEditAction($ar_itemFabrika['ID'], $ar_itemFabrika['EDIT_LINK'], CIBlock::GetArrayByID($ar_itemFabrika["IBLOCK_ID"], "SECTION_EDIT"));?>
<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text" id="<?=$this->GetEditAreaId($ar_itemFabrika['ID']);?>><div style="margin-left:-10px;"><?=$page_title?></div><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>

<?if($arResult["SECTION"]["DESCRIPTION"]&&$CURRENT_DEPTH==2):?><div class="catalog-item-text"><h1><?=$arResult["SECTION"]["NAME"]?></h1><?=$arResult["SECTION"]["DESCRIPTION"]?></div><?endif?>


<!-- Конец Список каталогов По Видам -->
<!-- ПРОДВИЖЕНИЕ -->
<?$window_title=$window_title." в интернет-магазине www.prokwarti.ru";?>


<?$APPLICATION->SetTitle($window_title);?>
<?$APPLICATION->SetPageProperty("description", $description." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог обоев, ".$keywords.", ".$keywords." цена, ".$keywords." купить");?>

