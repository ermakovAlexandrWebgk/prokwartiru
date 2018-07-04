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

$FABRIKA_ID="1246,94043";
$FABRIKA_ID=explode(",", $FABRIKA_ID);
$arFilterCatalogFabrika= Array("UF_FABRIKA"=>$FABRIKA_ID);

  $arFilterFabrika = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$IBLOCK_ID, $arFilterCatalogFabrika);
  $i=0; $list=array();
  $listFabrika=CIBlockSection::GetList(Array(), $arFilterFabrika, true, Array("ID"));
  while($arFabrika = $listFabrika->GetNext()) {
    //$list[]=$arWidth['ID'];
    $FABRIKA_LIST.=$arFabrika["ID"].",";
  }
  //$FABRIKA_LIST=explode(",", $FABRIKA_LIST);
  //$arFilterCatalogFabrika= Array("SECTION_ID"=>$FABRIKA_LIST);
  //$arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, $arFilterCatalogFabrika);
ECHO($FABRIKA_LIST);


  
    $arFilter = Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $FABRIKA_ID);
    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_DISCOUNT5', 'UF_SALE_OBOI', 'UF_ACTION'));
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
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
	  <div style='position: relative; top: -175px; left: -3px; float:left;'><? if($sale) echo("<span id='sale'>SALE ".$sale."</span>");  elseif($itemCatalogFabrika["UF_ACTION"]) echo("<span id='sale' style='background-color:#ffce0c;'>ЛУЧШАЯ ЦЕНА</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT5"]) echo("<span id='sale'>-5%</span>"); elseif($itemCatalogFabrika["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<div style='left: -3px; width:0px;'><span id='lable'>&nbsp;</span></div>");?></div>
        <?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<div style='position: relative; top: -175px; left:-3px; float:left;'><span id='new'>NEW</span></div>"); ?>
	  <?if($itemCatalogFabrika["UF_HIT"]) echo("<div style='position: relative; top: -175px; left:-3px;'><span id='hit'>HIT</span></div>"); ?>  
         </div>
<?
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


<? } ?>
<div style="clear: both;"></div>
<? } ?>      
<?}?>
<?}?>
<?endforeach?>


