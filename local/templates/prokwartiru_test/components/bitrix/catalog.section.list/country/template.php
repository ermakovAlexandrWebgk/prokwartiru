<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? 
	$IBLOCK_ID="5"; /* обои по умолчанию */
	$START_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$strTitle = "";
	$arSite="";
	$sectionID=$_REQUEST['SECTION_ID'];
	$COUNTRY_ID=$_REQUEST['COUNTRY_ID'];
?>
<?
  $SECTION_ID=5; /* обои по умолчанию */
  if(CModule::IncludeModule("iblock")){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
    }
    else
    {
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") {$IBLOCK_ID="5"; $SECTION_ID=51; $strTitle="Фабрики обоев. ";} /* обои */
	if($arSite=="/catalog/plitka/") {$IBLOCK_ID="4"; $SECTION_ID=78; $strTitle="Фабрики плитки. ";} /* плитка */
	if($arSite=="/catalog/mosaic/") {$IBLOCK_ID="10"; $SECTION_ID=140; $strTitle="Фабрики мозаики. ";} /* мозаика */
	if($arSite=="/catalog/curtains/") {$IBLOCK_ID="11"; $SECTION_ID=141; $strTitle="Фабрики штор. ";} /* шторы */
	if($arSite=="/catalog/lights/") {$IBLOCK_ID="17"; $SECTION_ID=759; $strTitle="Фабрики освещения. ";} /* свет */
	if($arSite=="/catalog/lepnina/") {$IBLOCK_ID="20"; $SECTION_ID=1266; $strTitle="Фабрики лепнины. ";} /* лепнина */

    }
  }
?>

<?
foreach($arResult["SECTIONS"] as $arSection):

if($arSection["IBLOCK_SECTION_ID"]==$SECTION_ID && ($arSection["ID"]==$COUNTRY_ID || $COUNTRY_ID=="")) {

  if($arSection["DEPTH_LEVEL"]>$START_DEPTH) {
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];

$country = '<h1>'.$strTitle.$arSection["NAME"].'</h1>';
echo $country;
$fabrika = "";

if(CModule::IncludeModule("iblock"))
{
   $items = GetIBlockElementList(6, $arSection['ID'], Array("name"=>"ASC"));
   while($arItem = $items->GetNext())
   {
	$fabrika = $arItem["NAME"];
	if($arItem["PREVIEW_PICTURE"]) {
		$arPathPreview = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
		echo '<div style="width:137px; height:137px; background-color:white; margin: 0 10px 10px 0; float:left;"><a href="'.$arSite.'index.php?FABRIKA_ID='.$arItem['ID'].'&SECTION_ID=1"><img src="'.$arPathPreview.'" style="width:137px; height:137px;" title="'.$fabrika.'"></a></div>';
	}
	else {
	//echo '<b>'.$fabrika.'</b><br />';
	echo '<div style="width:137px; height:137px; background-color:white; margin: 0 10px 10px 0; float:left;"><p style="width: 125px; margin:60px 5px 0 5px; overflow:hidden; text-align:center;"><b style="font-size: 16px;"><a href="'.$arSite.'index.php?FABRIKA_ID='.$arItem['ID'].'&SECTION_ID=1" style="text-decoration:none;">'.$fabrika.'</a></b></p></div>';
	}
        $fabrikaID=$arItem["ID"];
?>

<?if($fabrikaID&&false):?>
  <?
    $arFilter = Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrikaID);
    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA'));
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
  ?>
	  <div style="width:137px; height:137px; background-color:white; margin: 0 10px 10px 0; float:left;"><p style="width: 125px; margin:60px 5px 0 5px; overflow:hidden; text-align:center;"><b class="orange" style="font-size: 16px;"><? echo $itemCatalogFabrika["NAME"]; ?></b></p></div>	  
	  <!--? echo $itemCatalogFabrika["NAME"]."<br />"; ?-->	  
	    <!--?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo " (<nobr>".$ar_type['NAME']."</nobr>)<br />";
	    ?-->
<?
  }
?>
<div style="clear: both;"></div>
<?endif?>
<? } ?>
<div style="clear: both;"></div>
<? } ?>      
<?}?>
<?}?>
<?endforeach?>


