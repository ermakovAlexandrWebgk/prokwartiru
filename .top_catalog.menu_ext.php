<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION, $arTheme;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", "",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "70",
		//"DEPTH_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],
        "DEPTH_LEVEL" => "1", 
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"CACHE_SELECTED_ITEMS" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
	)
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>