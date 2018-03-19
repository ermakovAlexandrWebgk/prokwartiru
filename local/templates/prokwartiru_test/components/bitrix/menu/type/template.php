<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult))
	return;
?>
<?$arSite = $APPLICATION->GetCurDir();?>
<? $sectionID=$_REQUEST["SECTION_ID"];?>
<? $fabrikaID=$_REQUEST["FABRIKA_ID"];?>
<?
  if(($arSite=="/catalog/fabriki/")&&(CModule::IncludeModule("iblock"))){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
	if($SECTION_ID=="51") { $arSite="/catalog/oboi/"; $IBLOCK_ID=5; } /* обои */
	if($SECTION_ID=="78") { $arSite="/catalog/plitka/"; $IBLOCK_ID=4; } /* плитка */
	if($SECTION_ID=="140") { $arSite="/catalog/mosaic/"; $IBLOCK_ID=10; } /* мозаика */
	if($SECTION_ID=="759") { $arSite="/catalog/lights/"; $IBLOCK_ID=17; } /* свет */
	if($SECTION_ID=="1266") { $arSite="/catalog/lepnina/"; $IBLOCK_ID=20; } /* лепнина */
	if($SECTION_ID=="3209") { $arSite="/catalog/floor/"; $IBLOCK_ID=24; } /* паркет */
	//if($SECTION_ID=="141") $IBLOCK_ID=11; /* шторы */
    }
    $sectionID=1;
  }
?>
<?if(CModule::IncludeModule("iblock")):?>
<?
if($sectionID) {
  $res = CIBlockSection::GetByID($sectionID);
  if($ar_res = $res->GetNext()) {$sectionTOP=$ar_res['IBLOCK_SECTION_ID']; $sectionNAME=$ar_res['NAME'];}
}
if($sectionTOP) {
  $resTOP = CIBlockSection::GetByID($sectionTOP);
  if($ar_resTOP = $resTOP->GetNext()) $sectionNAME=$ar_resTOP['NAME'];
}
?>
<?endif?>
<div class="menu-type" style="margin-bottom: 10px;">
<?if($arSite=="/catalog/oboi/"):?>
	<div class="menu-type-item"><a href="/catalog/oboi/?CHEAP=true&amp;SECTION_ID=1" <?if($_REQUEST["CHEAP"]&&($sectionID==1)):?>class="on"<?endif?> >Недорогие обои</a>&nbsp;<b>.</b>&nbsp;</div>
	<div class="menu-type-item"><a href="/catalog/oboi/?METER=true&amp;SECTION_ID=1" <?if($_REQUEST["METER"]&&($sectionID==1)):?>class="on"<?endif?> >Метровые на флизелине</a>&nbsp;<b>.</b>&nbsp;</div>
<?endif?>
	<?foreach($arResult as $itemIdex => $arItem):?>
	<div class="menu-type-item">    
            <?if($arItem["ITEM_INDEX"]):?><b>.</b><?endif?>        
            <?if($arItem['TEXT']=="Sale"):?><span class="sale"><?endif?><a href="<?=$arItem['LINK']?><?if(($arSite=="/catalog/oboi/" || $arSite=="/catalog/plitka/")&&$fabrikaID):?>&FABRIKA_ID=<?=$fabrikaID;?><?endif?> " <?if($arItem['SELECTED']||($arItem['TEXT']==$sectionNAME)):?> class="on" <?endif?> ><nobr><?=$arItem["TEXT"]?></nobr></a><?if($arItem['TEXT']=="Sale"):?></span><?endif?>&nbsp;
	</div>
	<?endforeach;?>
<?if(($arSite!="/catalog/lights/")&&($arSite!="/catalog/lepnina/")):?>
	<div class="menu-type-item"><b>.</b>&nbsp;<a href="<?=$arSite?><?if($fabrikaID):?>index.php?FABRIKA_ID=<?=$fabrikaID;?>&SECTION_ID=1<?endif?>" <?if((!$_REQUEST["CHEAP"])&&(!$_REQUEST["METER"])&&($sectionID==1)):?>class="on"<?endif?> >Все</a></div>
<?endif?>
</div>