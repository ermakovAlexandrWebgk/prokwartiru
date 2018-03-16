<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? 
	$IBLOCK_ID=4;
	$START_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$strTitle = "";
?>
<? $sectionID=$_REQUEST["SECTION_ID"];?>
<?
if($sectionID) {
  $res = CIBlockSection::GetByID($sectionID);
  if($ar_res = $res->GetNext()) $sectionTOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>
<?
  if(CModule::IncludeModule("iblock")){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
    }
    else
    {
      $arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/"||($arSite=="/catalog/interiers/" && ($sectionID==76||$sectionTOP==76))) $SECTION_ID=51; /* обои */
	if($arSite=="/catalog/plitka/"||($arSite=="/catalog/interiers/" && ($sectionID==86||$sectionTOP==86))) $SECTION_ID=78; /* плитка */
	if($arSite=="/catalog/mosaic/") $SECTION_ID=140; /* мозаика */
	if($arSite=="/catalog/curtains/") $SECTION_ID=141; /* шторы */
    }
  }
?>
<div id="left_menu">
<ul>
<?
foreach($arResult["SECTIONS"] as $arSection):

if($arSection["IBLOCK_SECTION_ID"]==$SECTION_ID) {

  if($arSection["DEPTH_LEVEL"]>$START_DEPTH) {
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
		if($arSection["DEPTH_LEVEL"]>$START_DEPTH+1) {
			if ($_REQUEST['SECTION_ID']==$arSection['ID']){
				$link = '<b>'.$arSection["NAME"].$count.'</b>';
				$strTitle = $arSection["NAME"];
			}
			else
				$link = '<a href="'.$arSection["SECTION_PAGE_URL"].'">'.$arSection["NAME"].$count.'</a>';

		}
		else{
			$link = '<b>'.$arSection["NAME"].$count.'</b>';
		}

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
	if($arItem['ID']==$_REQUEST["FABRIKA_ID"]) $fabriki = $fabriki."<br /><span class='orange'>".$arItem["NAME"]."</span>";
	else $fabriki = $fabriki."<br /><a class='fabriki' href='".$arSite."index.php?SECTION_ID=".$sectionID."&FABRIKA_ID=".$arItem['ID']."'>".$arItem["NAME"]."</a>";
   }   
}
?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
         <img src="<?=$arSection['PICTURE']['SRC']?>" width="<?=$arSection['PICTURE']['WIDTH']?>" height="<?=$arSection['PICTURE']['HEIGHT']?>" />
      
         <?=$link?>
         <?=$fabriki?>
	 <br />
      </li>
<?}?>
<?}?>
<?endforeach?>
</ul>
</div>
<?=($strTitle?'<br/><h2>'.$strTitle.'</h2>':'')?>



<!-- -------------------------------------------- -->

<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>
<? $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>

<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $SECTION_TOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>
<br /><br />
<div id="left_menu">
<ul>

<!--?if($FABRIKA_ID):?-->
<?if($SECTION_TOP):?>
<!-- Фильтр по ФАБРИКАМ -->
<?    
	$country=false;
	$country_text="";
	$fabrika=false;
	$fabrika_text="";
	$menu_text="";
    
    //<!-- Страна -->
    $arFilter = Array('IBLOCK_ID'=>6, 'SECTION_ID'=>51);
    $listCountry = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
    while($itemCountry = $listCountry->GetNext())
    {   
       //echo("<b>".$itemCountry['NAME']."</b><br />");
       $flag_path = CFile::GetPath($itemCountry['PICTURE']);
       $country_text=" <img src='".$flag_path."' /> <b>".$itemCountry['NAME']."</b><br />";
       $arFilter = Array('SECTION_ID'=>$SECTION_ID);
	  //<!-- Фабрика -->
       $arFilter = Array();
       $listFabrika = GetIBlockElementList(6, $itemCountry['ID'], Array("NAME"=>"ASC"), $arFilter);
       while($itemFabrika = $listFabrika->GetNext())
       {
		//echo($itemFabrika['NAME']."<br />");
		//<!-- Каталог -->
		$arFilter = Array('IBLOCK_ID'=>5, 'UF_FABRIKA' => $itemFabrika['ID']);
		$listCatalog = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
		while($itemCatalog = $listCatalog->GetNext())
		{   
			//echo("<i style='font-size: 80%;'>".$itemCatalog['NAME']."</i><br />");
				//<!-- Элемент Интерьера -->
				$arFilter = Array('SECTION_ID' =>$sectionID);
				$listElement = GetIBlockElementList(9, $itemCatalog['ID'], Array("NAME"=>"left"), $arFilter);
				while($itemElement = $listElement->GetNext())
       			{
					if($itemElement)
					{
						//echo($itemElement['ID']."<br />");									
						$country=true;		
						$fabrika=true;
						//break;
					}
				} // end of $itemElement
			//if($fabrika) { echo("-".$itemFabrika['NAME']."<br/>"); break; $fabrika=false;}
			if($fabrika) { 
				if($itemFabrika['ID']==$FABRIKA_ID) $fabrika_text=$fabrika_text."<img src='".SITE_TEMPLATE_PATH."/images/galka.png'> "; else $fabrika_text=$fabrika_text."<img src='".SITE_TEMPLATE_PATH."/images/none.png'> "; 
				$fabrika_text=$fabrika_text."<a class='fabriki' href='".$arSite."index.php?SECTION_ID=".$SECTION_ID."&FABRIKA_ID=".$itemFabrika['ID']."'>".$itemFabrika['NAME']."</a><br/>";
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
<?endif?>
<!--?endif?-->
</ul>
</div>
