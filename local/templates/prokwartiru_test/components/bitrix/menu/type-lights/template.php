<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//if (empty($arResult))
	return;
?>
<? $sectionID=$_REQUEST["SECTION_ID"];?>

<?
if($sectionID) {
  $res = CIBlockSection::GetByID($sectionID);
  if($ar_res = $res->GetNext()) $sectionTOP=$ar_res['IBLOCK_SECTION_ID'];
}
if($sectionTOP) {
  $resTOP = CIBlockSection::GetByID($sectionTOP);
  if($ar_resTOP = $resTOP->GetNext()) $sectionNAME=$ar_resTOP['NAME'];
}
?>


<div class="menu-type">
	<?foreach($arResult as $itemIdex => $arItem):?>
	<div class="menu-type-item">    
            <?if($arItem["ITEM_INDEX"]):?><b>.</b><?endif?>        
            <?if($arItem['TEXT']=="Распродажа"):?><span class="sale"><?endif?><a href="<?=$arItem['LINK']?>" <?if($arItem['SELECTED']||($arItem['TEXT']==$sectionNAME)):?> class="on" <?endif?> ><?=$arItem["TEXT"]?></a><?if($arItem['TEXT']=="Распродажа"):?></span><?endif?>&nbsp;
	</div>
	<?endforeach;?>
	<!--div class="menu-type-item"><span class="sale"><b>.</b>&nbsp;<a href="/catalog/oboi/sale/?SECTION_ID=663">Распродажа</a></span></div-->
</div>
	