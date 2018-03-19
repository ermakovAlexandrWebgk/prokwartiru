<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? 
	$IBLOCK_ID=4;
	$START_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$strTitle = "";
	$arSite="";
	if($_REQUEST['SECTION_ID']) $sectionID=$_REQUEST['SECTION_ID']; else $sectionID="1";
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
<? $SECTION_ID=78; ?>
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
			if($arSite=="/catalog/oboi/"){
				$link = '<b><a href="'.$arSite.'country.php?COUNTRY_ID='.$arSection['ID'].'">'.$arSection["NAME"].'</a></b>';
			}
			else{
				$link = '<b><a href="'.$arSite.'country.php?COUNTRY_ID='.$arSection['ID'].'">'.$arSection["NAME"].'</a></b>';
			}
		}

$fabriki = "";

if(CModule::IncludeModule("iblock"))
{
   // выберем 10 элементов из папки $ID информационного блока $BID
   //$items = GetIBlockElementList(6, 51, Array("SORT"=>"ASC"), 10);
   $items = GetIBlockElementList(6, $arSection['ID'], Array("name"=>"ASC"));
   $letterPRN="";
   $letterCUR="";
   while($arItem = $items->GetNext())
   {
       // Вывод букв навигации
       if(($arSection['ID']==82)||($arSection['ID']==281)){
        $letter=$arItem["NAME"][0];
        if($letterCUR!=$arItem["NAME"][0]) $letterCUR=$arItem["NAME"][0];
        if($letterPRN!=$letterCUR) $letterPRN=$letterCUR;
        else $letter="";
	if($arItem['ID']==$_REQUEST["FABRIKA_ID"]) $fabriki = $fabriki."<br /><span class='orange'>".$arItem["NAME"]."</span>";
	else $fabriki = $fabriki."<br /><span style='position: absolute; left: -20px;'><b style='color:#322f2a;'>".$letter."</b></span><a class='fabriki' href='".$arSite."index.php?FABRIKA_ID=".$arItem['ID']."&SECTION_ID=".$sectionID."'>".$arItem["NAME"]."</a>";
       }
       else{
	if($arItem['ID']==$_REQUEST["FABRIKA_ID"]) $fabriki = $fabriki."<br /><span class='orange'>".$arItem["NAME"]."</span>";
	else $fabriki = $fabriki."<br /><a class='fabriki' href='".$arSite."index.php?FABRIKA_ID=".$arItem['ID']."&SECTION_ID=".$sectionID."'>".$arItem["NAME"]."</a>";
       }
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



