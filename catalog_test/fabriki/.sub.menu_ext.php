<?
   $IBLOCK_ID=5;
   if(CModule::IncludeModule("iblock")){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
	if($SECTION_ID=="51") $IBLOCK_ID=5; /* обои */
	if($SECTION_ID=="78") $IBLOCK_ID=4; /* плитка */
	if($SECTION_ID=="140") $IBLOCK_ID=10; /* мозаика */
	if($SECTION_ID=="759") $IBLOCK_ID=17; /* свет */
	if($SECTION_ID=="1266") $IBLOCK_ID=20; /* лепнина */
	//if($SECTION_ID=="141") $IBLOCK_ID=11; /* шторы */
     }
   }
?>
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksAdd=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "N",
	"ID" => "",
	"IBLOCK_TYPE" => "all",
	"IBLOCK_ID" => $IBLOCK_ID,
	"SECTION_URL" => "/catalog/#IBLOCK_CODE#/?SECTION_ID=#ID#",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksAdd);
?>