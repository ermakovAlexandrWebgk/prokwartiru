<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>
<? $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>

<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $SECTION_TOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>

<?
	$arSite = $APPLICATION->GetCurDir();
      if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; $PROPERTY="PROPERTY_CATALOG"; } /* обои */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) { $FABRIKI_TYPE_ID=78; $TYPE_ID=4; $PROPERTY="PROPERTY_INTERIER"; } /* плитка */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) { $FABRIKI_TYPE_ID=759; $TYPE_ID=17; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* свет */
      if($arSite=="/catalog/interiers/" && ($SECTION_ID==3715||$SECTION_TOP==3715)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; $PROPERTY="PROPERTY_CATALOG"; } /* фрески */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==87||$SECTION_TOP==87)) { return; } /* наши работы */
?>

<!--?
  //$SECTION_ID=51; /* обои по умолчанию */
  if(CModule::IncludeModule("iblock")){
    if($FABRIKA_ID) { 
      $arIBlockElement = GetIBlockElement($FABRIKA_ID, 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      //$SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
    }
    else
    {
	$arSite = $APPLICATION->GetCurDir();
      if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; $PROPERTY="PROPERTY_CATALOG"; } /* обои */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) { $FABRIKI_TYPE_ID=78; $TYPE_ID=4; $PROPERTY="PROPERTY_INTERIER"; } /* плитка */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) { $FABRIKI_TYPE_ID=759; $TYPE_ID=17; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* свет */
      if($arSite=="/catalog/interiers/" && ($SECTION_ID==3715||$SECTION_TOP==3715)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; $PROPERTY="PROPERTY_CATALOG"; } /* фрески */
    }
  }
?-->
<div id="left_menu">
<?if($arSite=="/catalog/interiers/" && ($SECTION_ID==3715||$SECTION_TOP==3715)):?> 
<ul>
  <li><b>Россия</b></li>
  <li><a href="<?=$arSite?>index.php?FABRIKA_ID=84883&SECTION_ID=3715"><span class='orange'>Affresco</span></a>
</ul>
<?else:?>
<ul>
<?
foreach($arResult["SECTIONS"] as $arSection):
if($arSection["IBLOCK_SECTION_ID"]==$FABRIKI_TYPE_ID) {

$country = '<b>'.$arSection["NAME"].'</b>';
$fabriki = "";

if(CModule::IncludeModule("iblock"))
{
   // выберем 10 элементов из папки $ID информационного блока $BID
   //$items = GetIBlockElementList(6, 51, Array("SORT"=>"ASC"), 10);
   $items = GetIBlockElementList(6, $arSection['ID'], Array("name"=>"ASC"));
   while($arItem = $items->GetNext())
   {
      //echo $arItem["NAME"]."<br>";
	//$fabriki = $fabriki.'<br /><a href="'.$arItem["DETAIL_PAGE_URL"].'">'.$arItem["NAME"].'</a>';
	if($arItem['ID']==$FABRIKA_ID) $fabriki = $fabriki."<br /><span class='orange'>".$arItem["NAME"]."</span>";
	else $fabriki = $fabriki."<br /><a class='fabriki' href='".$arSite."index.php?FABRIKA_ID=".$arItem['ID']."&SECTION_ID=".$SECTION_ID."'>".$arItem["NAME"]."</a>";
   }   
}
?>
	<li><img src="<?=$arSection['PICTURE']['SRC']?>" width="<?=$arSection['PICTURE']['WIDTH']?>" height="<?=$arSection['PICTURE']['HEIGHT']?>" />      
         <?=$country?>
         <?=$fabriki?>
	 <br />
      </li>

<?}?>
<?endforeach?>
</ul>
<?endif?>
</div>



