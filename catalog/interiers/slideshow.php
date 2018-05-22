<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Слайд-шоу");
?> 
<h1>Слайд-шоу интерьеров</h1>
 
<!--?$APPLICATION->IncludeComponent(
	"bitrix:photogallery",
	"interiors",
	Array(
		"SHOW_LINK_ON_MAIN_PAGE" => array("id","shows","rating","comments"),
		"USE_LIGHT_TEMPLATE" => "N",
		"WATERMARK" => "Y",
		"WATERMARK_COLORS" => array("FF0000","FFFF00","FFFFFF","000000"),
		"USE_LIGHT_VIEW" => "Y",
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"SECTION_SORT_BY" => "UF_DATE",
		"SECTION_SORT_ORD" => "DESC",
		"ELEMENT_SORT_FIELD" => "name",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENTS_USE_DESC_PAGE" => "Y",
		"SECTION_PAGE_ELEMENTS" => "15",
		"ELEMENTS_PAGE_ELEMENTS" => "50",
		"PAGE_NAVIGATION_TEMPLATE" => "",
		"UPLOAD_MAX_FILE_SIZE" => "16M",
		"ALBUM_PHOTO_THUMBS_SIZE" => "200",
		"ALBUM_PHOTO_SIZE" => "120",
		"THUMBS_SIZE" => "250",
		"JPEG_QUALITY1" => "95",
		"PREVIEW_SIZE" => "700",
		"JPEG_QUALITY2" => "95",
		"ORIGINAL_SIZE" => "0",
		"JPEG_QUALITY" => "90",
		"ADDITIONAL_SIGHTS" => array(),
		"WATERMARK_MIN_PICTURE_SIZE" => "200",
		"PATH_TO_FONT" => "",
		"WATERMARK_RULES" => "USER",
		"DATE_TIME_FORMAT_SECTION" => "d.m.Y",
		"DATE_TIME_FORMAT_DETAIL" => "d.m.Y",
		"SET_TITLE" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"USE_RATING" => "N",
		"SHOW_TAGS" => "N",
		"USE_COMMENTS" => "N",
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
			"PAGE_NAME" => "PAGE_NAME",
			"ACTION" => "ACTION"
		)
	)
);?-->
 <?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.section.list",
	".default",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"BEHAVIOUR" => "SIMPLE",
		"SORT_BY" => "UF_DATE",
		"SORT_ORD" => "ASC",
		"PAGE_ELEMENTS" => "0",
		"INDEX_URL" => "index.php",
		"SECTION_URL" => "slideshow.php?SECTION_ID=#SECTION_ID#",
		"SECTION_EDIT_URL" => "section_edit.php?SECTION_ID=#SECTION_ID#",
		"SECTION_EDIT_ICON_URL" => "section_edit_icon.php?SECTION_ID=#SECTION_ID#",
		"UPLOAD_URL" => "upload.php?SECTION_ID=#SECTION_ID#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"ALBUM_PHOTO_SIZE" => "200",
		"ALBUM_PHOTO_THUMBS_SIZE" => "120",
		"PAGE_NAVIGATION_TEMPLATE" => "",
		"DATE_TIME_FORMAT" => "d.m.Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list",
	"slideshow",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"BEHAVIOUR" => "SIMPLE",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"ELEMENT_LAST_TYPE" => "none",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD1" => "",
		"ELEMENT_SORT_ORDER1" => "asc",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"USE_DESC_PAGE" => "Y",
		"PAGE_ELEMENTS" => "40",
		"PAGE_NAVIGATION_TEMPLATE" => "orange",
		"DETAIL_URL" => $arResult["URL_TEMPLATES"]["detail"],
		"DETAIL_SLIDE_SHOW_URL" => $arResult["URL_TEMPLATES"]["detail_slide_show"],
		"SEARCH_URL" => "search.php",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(0=>"1",),
		"DATE_TIME_FORMAT" => "d.m.Y",
		"SET_STATUS_404" => "N",
		"ADDITIONAL_SIGHTS" => array(),
		"PICTURES_SIGHT" => "",
		"THUMBS_SIZE" => "150",
		"SHOW_PAGE_NAVIGATION" => "bottom",
		"SHOW_CONTROLS" => "N",
		"SHOW_RATING" => "N",
		"SHOW_SHOWS" => "N",
		"SHOW_COMMENTS" => "N",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"",),
		"DISPLAY_AS_RATING" => "rating"
	)
);?>  
<!--?$result2 = $APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list", 
	"", 
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"BEHAVIOUR" => "SIMPLE",
		"USER_ALIAS" => "",
		"PERMISSION" => "",
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
 		
		"ELEMENTS_LAST_COUNT" => "",
		"ELEMENT_LAST_TIME" => "",
		"ELEMENTS_LAST_TIME_FROM" => "", 
		"ELEMENTS_LAST_TIME_TO" => "", 
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD1" => "",
		"ELEMENT_SORT_ORDER1" => "",
		"ELEMENT_FILTER" => array(),
		"ELEMENT_SELECT_FIELDS" => array(), 
		"PROPERTY_CODE" => $arParams["PROPERTY_CODE"], 
 		
		"GALLERY_URL"	=>	"",
		"DETAIL_URL"	=>	$arResult["URL_TEMPLATES"]["detail"],
		"DETAIL_SLIDE_SHOW_URL"	=>	$arResult["URL_TEMPLATES"]["detail_slide_show"],
		"SEARCH_URL"	=>	$arResult["URL_TEMPLATES"]["search"],
		
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		
		"USE_DESC_PAGE" => $arParams["ELEMENTS_USE_DESC_PAGE"],
		"PAGE_NAVIGATION_TEMPLATE" => $arParams["PAGE_NAVIGATION_TEMPLATE"],
		"PAGE_ELEMENTS" => $arParams["ELEMENTS_PAGE_ELEMENTS"],
		
 		"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT_DETAIL"],
		
		"ADDITIONAL_SIGHTS" => $arParams["~ADDITIONAL_SIGHTS"],
		"PICTURES_SIGHT" => ($_REQUEST["slider"] == "Y" ? "real" : ""),
		"GALLERY_SIZE" => 0,
		
		"SHOW_PHOTO_USER" => "N",
		"GALLERY_AVATAR_SIZE" => "0",

		"RETURN_FORMAT" => "LIST", 

		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"SET_TITLE" => "N",
		
		"CELL_COUNT"	=>	$arParams["CELL_COUNT"],
		"THUMBS_SIZE"	=>	"300",
		"SHOW_PAGE_NAVIGATION"	=>	"bottom",
		
		"SHOW_CONTROLS"	=>	"Y",
		"SHOW_RATING" => $arParams["USE_RATING"],
		"SHOW_SHOWS" => $arParams["SHOW_SHOWS"],
		"SHOW_COMMENTS" => $arParams["USE_COMMENTS"],
		"SHOW_TAGS" => $arParams["SHOW_TAGS"],
		"SHOW_DATE" => $arParams["SHOW_DATE"],
		"SHOW_DESRIPTION" => $arParams["SHOW_DESRIPTION"],
		
		"USE_RATING" => $arParams["USE_RATING"],
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
		"USE_COMMENTS" => $arParams["USE_COMMENTS"], 
		"INCLUDE_SLIDER" => "Y", 
		
		"COMMENTS_TYPE" => $arParams["COMMENTS_TYPE"], 
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"]
	),
	$component, 
	array("HIDE_ICONS" => "Y")
);?-->
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>