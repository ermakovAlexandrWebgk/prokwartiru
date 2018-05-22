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
      $page_title="<h1 id='page_title'><span>".$ar_itemFabrika['NAME']."</span>";
      if($country=GetIBlockSection($ar_itemFabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title." .<span style='font-size: 80%;'>".$country['NAME']."</span>"; 
    }   
  $page_title=$page_title."</h1>"; 
  $window_title=$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  }
?>
<?=$page_title?>
<!-- Конец Заголовок -->

<!-- Список каталогов -->
<div class="catalog-item-list">
<!-- Список каталогов По фабрикам -->
<?if($fabrika):?>
  <?

    $listCatalogFabrika=CIBlockSection::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika), false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG')); 
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
	  <div style="text-align: center; font-size: 80%;">
	    <?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?>
	  </div>
	  <br />	  
	  <?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<div style='position: relative; top: -204px; left: 6px;'><span style='background-color: #F58220; color: white; padding: 2px 4px;'>NEW</span></div>");?>
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
    $CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
    foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
  ?>

<div class="catalog-item">


            <div class="catalog-item-image"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src="<? if($arSection['PICTURE']['SRC']):?> <?=$arSection['PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default150.gif?><?endif?>" width="150px<!--?=$arSection['PICTURE']['WIDTH']?-->" height="150px<!--?=$arSection['PICTURE']['HEIGHT']?-->" /></a></div>

          <div class="catalog-item-title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><nobr><?=$arSection["NAME"]?></nobr><!--?if($arParams["COUNT_ELEMENTS"]):?->&nbsp;(<-?=$arSection["ELEMENT_CNT"]?->)<-?endif;?--></a></div><br />
<!-- Фабрика (не получилась) -->
  <?if($section):?>
    <?$type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 4, 'SECTION_ID' => 160), false, $arSelect=array('UF_FABRIKA'));?>
<!--?=$arSection["ID"]?-->
<?$res = CIBlockSection::GetByID($arSection["ID"]);if($ar_res = $res->GetNext())  echo $ar_res['UF_FABRIKA'];?>

    <?if($type_item = $type->GetNext()){?>
<?=$type_item['UF_FABRIKA']?>
<?echo("111");?>
        <?if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $title="1<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";?>
	<?}?>
<?=$title?>

  <?endif?>
<!-- Конец фабрика -->



</div>
<?endforeach?>
<?endif?>
</div>
<?if($ar_res['PREVIEW_TEXT']):?>
<div class="catalog-item-text"><!--h1><-?=$ar_res['NAME']?-></h1--><?=$ar_res['PREVIEW_TEXT']?></div>
<?endif?>

<!-- Конец Список каталогов По Видам -->

<?$APPLICATION->SetTitle("Обои ".$window_title." в интернет магазине ROKWARTI.RU");?>
<?$APPLICATION->SetPageProperty("description", "Виниловые обои");?>
<?$APPLICATION->SetPageProperty("keywords", "виниловые обои купить, виниловые обои каталог, виниловые обои rasch, виниловые обои zambaiti ".$fabrika['NAME']);?>


