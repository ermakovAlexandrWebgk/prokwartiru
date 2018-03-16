<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
	//$IBLOCK_ID=4;
	//$START_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	//$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	//$strTitle = "";
?>

<!--? $sectionID=$_REQUEST["SECTION_ID"];?->
<-?
if($sectionID) {
  $res = CIBlockSection::GetByID($sectionID);
  if($ar_res = $res->GetNext()) $sectionTOP=$ar_res['IBLOCK_SECTION_ID'];
}
?-->

<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>
<? $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>

<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $SECTION_TOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>

<?
	$FABRIKI_TYPE_ID=0; $TYPE_ID=0; 
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; $PROPERTY="PROPERTY_CATALOG"; } /* обои */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) { $FABRIKI_TYPE_ID=78; $TYPE_ID=4; $PROPERTY="PROPERTY_INTERIER"; } /* плитка */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) { $FABRIKI_TYPE_ID=759; $TYPE_ID=17; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* свет */
?>

<div id="left_menu">
<ul>
<!-- Фильтр по ФАБРИКАМ -->
<?    
	$country=false;
	$country_text="";
	$fabrika=false;
	$fabrika_text="";
	$menu_text="";
    
    //<!-- Страна -->
    $arFilter = Array('IBLOCK_ID'=>6, 'SECTION_ID'=>$FABRIKI_TYPE_ID);
    $listCountry = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
	while($itemCountry = $listCountry->GetNext())
	{   
		$flag_path = CFile::GetPath($itemCountry['PICTURE']);
		$country_text=" <img src='".$flag_path."' /> <b>".$itemCountry['NAME']."</b><br />";
		//<!-- Фабрика -->
		$listFabrika = GetIBlockElementList(6, $itemCountry['ID'], Array("NAME"=>"ASC"));

		while($itemFabrika = $listFabrika->GetNext())
		{
		//<!-- Каталог -->
		$arFilter = Array('IBLOCK_ID'=>$TYPE_ID, 'UF_FABRIKA' => $itemFabrika['ID']);
		$listCatalog = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
		while($itemCatalog = $listCatalog->GetNext())
		{   
			//<!-- Элемент Интерьера -->
$arSelect = Array("ID", "NAME", $PROPERTY);
			$arFilter = Array("IBLOCK_ID" => 9, $PROPERTY =>$itemCatalog['ID']);
			$listElement = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			while($itemElement = $listElement->GetNext())
			{
				if($itemElement)	{
					$country=true;		
					$fabrika=true;
					break;
				}
			} // end of $itemElement
			if($fabrika) { 
				//$fabrika_text=$fabrika_text."<p  class='fabriki'>";		
			   if($itemFabrika['ID']==$FABRIKA_ID) 														$fabrika_text=$fabrika_text."<span class='orange'>".$itemFabrika['NAME']."</span><br />";	
			   elseif($SECTION_TOP)	$fabrika_text=$fabrika_text."<a class='fabriki' href='".$arSite."index.php?SECTION_ID=".$SECTION_TOP."&FABRIKA_ID=".$itemFabrika['ID']."'>".$itemFabrika['NAME']."</a><br />";
			   else	$fabrika_text=$fabrika_text."<a class='fabriki' href='".$arSite."index.php?SECTION_ID=".$SECTION_ID."&FABRIKA_ID=".$itemFabrika['ID']."'>".$itemFabrika['NAME']."</a><br />";
			   $fabrika=false;
			   break;
			}
		} // end of $itemCatalog 
       } // end of $itemFabrika
	  if(!$country) $country_text="";
	  $country=false;		
	  $menu_text=$menu_text."<li>".$country_text.$fabrika_text."</li>";
	  $fabrika_text="";
    } // end of $itemCountry
?>
<?=$menu_text?>
</ul>
</div>
