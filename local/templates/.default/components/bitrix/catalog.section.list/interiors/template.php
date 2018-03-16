<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? 
	$IBLOCK_ID=4;
	$START_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	$strTitle = "";

	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/interiors/" && $_REQUEST['SECTION_ID']==76) $SECTION_ID=51; /* обои */
	if($arSite=="/catalog/interiors/" && $_REQUEST['SECTION_ID']==86) $SECTION_ID=78; /* плитка */

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
   $items = GetIBlockElementList(6, $arSection['ID'], Array("SORT"=>"ASC"));
   while($arItem = $items->GetNext())
   {
      //echo $arItem["NAME"]."<br>";
	//$fabriki = $fabriki.'<br /><a href="'.$arItem["DETAIL_PAGE_URL"].'">'.$arItem["NAME"].'</a>';
	$fabriki = $fabriki."<br /><a href='".$arSite."index.php?FABRIKA_ID=".$arItem['ID']."'>".$arItem["NAME"]."</a>";


   }   
}
?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
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



