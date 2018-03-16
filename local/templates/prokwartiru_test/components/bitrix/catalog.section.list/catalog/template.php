<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? 
	$IBLOCK_ID=4;
	$START_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$strTitle = "";
	$arSite="";
	$sectionID=$_REQUEST['SECTION_ID'];
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
	if($arSite=="/catalog/oboi/") $SECTION_ID=51; /* обои */
	if($arSite=="/catalog/plitka/") $SECTION_ID=78; /* плитка */
	if($arSite=="/catalog/mosaic/") $SECTION_ID=140; /* мозаика */
	if($arSite=="/catalog/curtains/") $SECTION_ID=141; /* шторы */
	if($arSite=="/catalog/lights/") $SECTION_ID=759; /* свет */
	if($arSite=="/catalog/lepnina/") $SECTION_ID=1266; /* лепнина */

    }
  }
?>




<!-- !!! -->

<?
foreach($arResult["SECTIONS"] as $arSection):

if($arSection["IBLOCK_SECTION_ID"]==$SECTION_ID) {

  if($arSection["DEPTH_LEVEL"]>$START_DEPTH) {
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];

$country = '<h3 style="margin:10px 0 5px 0;"><b style="color: #cc0000;">'.$arSection["NAME"].'</b></h3>';
echo $country;
$fabrika = "";

if(CModule::IncludeModule("iblock"))
{
   $items = GetIBlockElementList(6, $arSection['ID'], Array("name"=>"ASC"));
   while($arItem = $items->GetNext())
   {
	$fabrika = $arItem["NAME"];
	echo '<b>'.$fabrika.'</b><br />';
        $fabrikaID=$arItem["ID"];
?>

<?if($fabrikaID):?>

  <?
    $arFilter = Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrikaID);
    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_SALER_PLITKA'));
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
$saler="";
$num=count($itemCatalogFabrika["UF_SALER_PLITKA"]);
for($i=0; $i<$num; $i++) {
  $res = CIBlockElement::GetByID($itemCatalogFabrika["UF_SALER_PLITKA"][$i]);
  if($ar_res = $res->GetNext()){
    if($saler!="") $saler=$saler.", ";
    $saler=$saler.$ar_res['NAME'];
  }
}
  ?>
	  <!--? echo "- &nbsp;".$itemCatalogFabrika["NAME"]." (".$saler.")<br />"; ?-->	 
	  <? echo $itemCatalogFabrika["NAME"]."<br />"; ?>	  
	    <!--?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo " (<nobr>".$ar_type['NAME']."</nobr>)<br />";
	    ?-->
<?
  }
?>
<?endif?>

<?

   }   
}
?>      
<?}?>
<?}?>
<?endforeach?>



