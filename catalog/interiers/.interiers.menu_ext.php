<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksAdd=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "N",
	"ID" => "",
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "9",
	"SECTION_URL" => "/catalog/interiers/?SECTION_ID=#ID#",
	"DEPTH_LEVEL" => "2",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksAdd);
?>