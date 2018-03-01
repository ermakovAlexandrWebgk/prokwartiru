<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Слайд-шоу");
?><?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list",
	"slide_show",
	Array(
		"ELEMENT_ID" => "",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"BEHAVIOUR" => "SIMPLE",
		"SET_TITLE" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SECTION_ID" => "76",
		"ELEMENT_LAST_TYPE" => "none",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD1" => "",
		"ELEMENT_SORT_ORDER1" => "asc",
		"PROPERTY_CODE" => array(),
		"DETAIL_URL" => "detail.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
		"DETAIL_SLIDE_SHOW_URL" => "slide_show.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
		"SEARCH_URL" => "search.php",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(),
		"USE_DESC_PAGE" => "Y",
		"PAGE_ELEMENTS" => "50",
		"PAGE_NAVIGATION_TEMPLATE" => "",
		"DATE_TIME_FORMAT" => "d.m.Y",
		"SET_STATUS_404" => "N",
		"ADDITIONAL_SIGHTS" => array()
	),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>