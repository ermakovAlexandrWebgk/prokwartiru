<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksAdd=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "N",
	"ID" => $_REQUEST["ID"],
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "6",
	"SECTION_URL" => "/catalog/oboi/list.php?SECTION_ID=#ID#",
	"DEPTH_LEVEL" => "4",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksAdd);
?>