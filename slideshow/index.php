<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Слайдшоу");
?><?$APPLICATION->IncludeComponent("bitrix:photo", "slideshow", array(
	"IBLOCK_TYPE" => "services",
	"IBLOCK_ID" => "21",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/slideshow/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"USE_PERMISSIONS" => "N",
	"USE_RATING" => "N",
	"USE_REVIEW" => "N",
	"USE_FILTER" => "N",
	"SECTION_COUNT" => "20",
	"TOP_ELEMENT_COUNT" => "9",
	"TOP_LINE_ELEMENT_COUNT" => "3",
	"SECTION_SORT_FIELD" => "sort",
	"SECTION_SORT_ORDER" => "desc",
	"TOP_ELEMENT_SORT_FIELD" => "sort",
	"TOP_ELEMENT_SORT_ORDER" => "asc",
	"TOP_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"TOP_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"SECTION_PAGE_ELEMENT_COUNT" => "20",
	"SECTION_LINE_ELEMENT_COUNT" => "3",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_BROWSER_TITLE" => "-",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"DETAIL_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Фотографии",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
	)
	),
	false
);?>
<br />

<div>
  <div><?$APPLICATION->IncludeComponent("prokwartiru:slideshow", "slideshow", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "5",
	"BEHAVIOUR" => "SIMPLE",
	"SECTION_ID" => "",
	"ELEMENT_LAST_TYPE" => "none",
	"ELEMENT_SORT_FIELD" => "SORT",
	"ELEMENT_SORT_ORDER" => "desc",
	"ELEMENT_SORT_FIELD1" => "",
	"ELEMENT_SORT_ORDER1" => "asc",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"USE_DESC_PAGE" => "Y",
	"PAGE_ELEMENTS" => "50",
	"PAGE_NAVIGATION_TEMPLATE" => "",
	"DETAIL_URL" => "detail.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
	"DETAIL_SLIDE_SHOW_URL" => "slide_show.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
	"SEARCH_URL" => "search.php",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"SET_TITLE" => "Y",
	"USE_PERMISSIONS" => "N",
	"GROUP_PERMISSIONS" => array(
		0 => "1",
	),
	"DATE_TIME_FORMAT" => "d.m.Y",
	"SET_STATUS_404" => "N",
	"ADDITIONAL_SIGHTS" => array(
	),
	"PICTURES_SIGHT" => "",
	"THUMBS_SIZE" => "120",
	"SHOW_PAGE_NAVIGATION" => "bottom",
	"SHOW_CONTROLS" => "N",
	"SHOW_RATING" => "N",
	"SHOW_SHOWS" => "N",
	"SHOW_COMMENTS" => "N",
	"MAX_VOTE" => "5",
	"VOTE_NAMES" => array(
		0 => "1",
		1 => "2",
		2 => "3",
		3 => "4",
		4 => "5",
		5 => "",
	),
	"DISPLAY_AS_RATING" => "rating"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?> </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>