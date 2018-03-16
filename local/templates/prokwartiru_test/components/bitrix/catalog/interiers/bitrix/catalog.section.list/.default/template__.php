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
    $res = CIBlockElement::GetByID($fabrika); 
    if($ar_res = $res->GetNext()){
      $page_title="<h1 id='page_title'><span>".$ar_res['NAME']."</span>";
      //$title=$title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$ar_res['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
      if($country=GetIBlockSection($ar_res['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title." .<span style='font-size: 80%;'>".$country['NAME']."</span>"; 
    }   
  $page_title=$page_title."</h1>"; 
  }
?>
<?=$page_title?>
<!-- Конец Заголовок -->

<table cellspacing="0" cellpadding="0" border="0">
<tr><td>
<div class="catalog-item-list">
<?if($fabrika):?>
<?
  $fabrika_list=CIBlockSection::GetList(array(), array('IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika), false, $arSelect=array('UF_FABRIKA')); 
  while($fabrika_item=$fabrika_list->GetNext()) 
  {
?>
<div class="catalog-item">
<?//echo $fabrika_item['ID'].' - '.$fabrika_item['UF_FABRIKA'].' -> '; ?>
<?if($fabrika_item["IBLOCK_SECTION_ID"]) $type = CIBlockSection::GetByID($fabrika_item["IBLOCK_SECTION_ID"]);?>
<?//if($type_item = $type->GetNext())  echo ("<div class='catalog-item-type'>(".$type_item['NAME'].")</div>");?>
<div class="catalog-item-image"><a href="<?=$fabrika_item['SECTION_PAGE_URL']?>"><?if($fabrika_item["PICTURE"]):?><? echo(ShowImage($fabrika_item["PICTURE"], 150, 150, "border='0'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px"><?endif?></a></div>
<div class="catalog-item-title"><a href="<?=$fabrika_item['SECTION_PAGE_URL']?>"><nobr><?=$fabrika_item["NAME"]?></nobr></a></div><br />
</div>

<?
  }
?>

<?else:?>
  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <?
    $CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
    foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
  ?>
<!--?=$arSection["ID"]?-->
<? $catalog=GetIBlockSection($arSection['ID'], 'catalog');
   //$fabrika=$catalog['ID'];
   //echo("Ф=".$fabrika);
?>
<?=$fabrika?>
<?
if($arSection['ID']) $type = CIBlockSection::GetList(array(), array(), false, $arSelect=array('UF_FABRIKA'));
 if($type_item = $type->GetNext()){
      echo ($type_item['UF_FABRIKA']);
    }
?>
<div class="catalog-item">
            <div class="catalog-item-image"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src="<? if($arSection['PICTURE']['SRC']):?> <?=$arSection['PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default150.gif?><?endif?>" width="150px<!--?=$arSection['PICTURE']['WIDTH']?-->" height="150px<!--?=$arSection['PICTURE']['HEIGHT']?-->" /></a><!--img src="/img/new.png" style="position: absolute; top: 0; left: 0; width: 150px; height: 150; z-index: 1000;"--></div>

          <div class="catalog-item-title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><nobr><b><?=$arSection["NAME"]?></b></nobr></a><?=$arSection["UF_FABRIKA"]?></div><br />

  <!--?
    if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 5, 'SECTION_ID' => $section), false, $arSelect=array('UF_FABRIKA'));
    if($type_item = $type->GetNext()){
      echo "<p>".$type_item['UF_FABRIKA']."</p>";
      if($type_item['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($type_item['UF_FABRIKA']);
      if($fabrika_item = $fabrika_list->GetNext())  echo "<p>".$fabrika_item['NAME']."</p>";  }
  ?-->




</div>
<?endforeach?>
<?endif?>
</div>
</td></tr>
<?if($ar_res['PREVIEW_TEXT']):?>
<tr><td>
<div class="catalog-item-text"><!--p><-?=$ar_res['NAME']?-></p--><?=$ar_res['PREVIEW_TEXT']?></div>
</td></tr>
<?endif?>
</table>

<?$APPLICATION->SetTitle("Обои ".$page_title." в интернет магазине ROKWARTI.RU");?>
<?$APPLICATION->SetPageProperty("description", "Виниловые обои");?>
<?$APPLICATION->SetPageProperty("keywords", "виниловые обои купить, виниловые обои каталог, виниловые обои rasch, виниловые обои zambaiti ".$fabrika['NAME']);?>