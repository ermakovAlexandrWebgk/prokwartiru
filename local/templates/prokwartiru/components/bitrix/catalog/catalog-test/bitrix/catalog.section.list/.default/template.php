<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* обои */
	if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* плитка */
	if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* мозаика */
	if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* шторы */
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
  $window_title=$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords=$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- Конец Заголовок -->

<!-- Список каталогов -->
<div class="catalog-item-list">
<!-- Список каталогов По фабрикам -->
<?if($fabrika):?>
  <?

    $listCatalogFabrika=CIBlockSection::GetList(array('left_margin'=>'asc'), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika), false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG')); 
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
	  <div  class="catalog-item-title" style="font-size: 13px;">
	    <?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo ("<nobr>".$ar_type['NAME']."</nobr>");
	    ?>
	  </div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
<?
  }
?>

<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text"><?=$page_title?><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>
<!-- Конец Список каталогов По фабрикам -->

<!-- Список каталогов По Видам -->
<?else:?>

  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <?
    $window_title=$arResult["SECTION"]["NAME"];
    $keywords=$arResult["SECTION"]["NAME"];
  ?>

  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section), false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG')); 
    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogType["NAME"]?></b></nobr></a></div>
	  <div class="catalog-item-title" style="font-size: 13px;">
	    <!--?
		if($itemCatalogType["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?-->
	    <?
		if($itemCatalogType['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($itemCatalogType['UF_FABRIKA']);
      	  if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	  </div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($itemCatalogType["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
<?
  }
?>

  <!--?
    foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
  ?-->

<!--div class="catalog-item">
          <div class="catalog-item-image"><a href="<-?=$arSection["SECTION_PAGE_URL"]?->"><img src="<-? if($arSection['PICTURE']['SRC']):?-> <-?=$arSection['PICTURE']['SRC']?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default150.gif?-><-?endif?->" width="150px<!-?=$arSection['PICTURE']['WIDTH']?->" height="150px<!-?=$arSection['PICTURE']['HEIGHT']?->" /></a></div>
          <div class="catalog-item-title"><a href="<-?=$arSection["SECTION_PAGE_URL"]?->"><nobr><b><-?=$arSection["NAME"]?-></b></nobr></a></div>
	    <-?
		if($arSection["ID"]) $type=CIBlockSection::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'ID' => $arSection["ID"]), false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG'));
		  if($ar_type=$type->GetNext()){  //echo $ar_type['UF_FABRIKA'];
			if($ar_type['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($ar_type['UF_FABRIKA']);
	      	  if($fabrika_item = $fabrika_list->GetNext())  echo "<div style='text-align: center; font-size: 80%;'>".$fabrika_item['NAME']."</div><br />";  
	    		if($ar_type['UF_NEWCATALOG']) echo("<div style='position: relative; top: -204px; left: 6px;'><span id='new'>NEW</span></div>");
		  }
	    ?->
</div>
<-?endforeach?-->
<?endif?>
</div>
<div class="catalog-item-text">
	    <?
		if($arSection["IBLOCK_SECTION_ID"]) $typeCatalog=CIBlockSection::GetByID($arSection["IBLOCK_SECTION_ID"]);
		  if($typeCatalog) if($ar_typeCatalog=$typeCatalog->GetNext()) echo $ar_typeCatalog["DESCRIPTION"];
	    ?>
</div>
<!-- Конец Список каталогов По Видам -->

<?$APPLICATION->SetTitle("Мозаика ".$window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", "Мозаика");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог мозаики ".$keywords.", мозаика ".$keywords.", мозаика ".$keywords." цена, мозаика ".$keywords." купить");?>

