<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование");
?>

<div class="photo-info-box photo-info-box-photo-list"> 
  <div class="photo-info-box-inner"><?$result2 = $APPLICATION->IncludeComponent(
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
);?> </div>
 </div>
 
<div class="photo-info-box photo-info-box-photo-list"> 	 
  <div class="photo-info-box-inner"> <?$result2 = $APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list", 
	"", 
	Array(
		"IBLOCK_TYPE" => "catalog", // $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => "9", // $arParams["IBLOCK_ID"],
		"BEHAVIOUR" => "SIMPLE",
		"USER_ALIAS" => "",
		"PERMISSION" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"], //$arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => "", //$arResult["VARIABLES"]["SECTION_CODE"],
 		
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
		"THUMBS_SIZE"	=> "220", //$arParams["THUMBS_SIZE"],
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
);?> 	</div>
 </div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.detail.list",
	".default",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"BEHAVIOUR" => "SIMPLE",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"ELEMENT_LAST_TYPE" => "none",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD1" => "",
		"ELEMENT_SORT_ORDER1" => "asc",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
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
		"GROUP_PERMISSIONS" => array(0=>"1",),
		"DATE_TIME_FORMAT" => "d.m.Y",
		"SET_STATUS_404" => "N",
		"ADDITIONAL_SIGHTS" => array(),
		"PICTURES_SIGHT" => "",
		"THUMBS_SIZE" => "120",
		"SHOW_PAGE_NAVIGATION" => "bottom",
		"SHOW_CONTROLS" => "N",
		"SHOW_RATING" => "N",
		"SHOW_SHOWS" => "N",
		"SHOW_COMMENTS" => "N",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(0=>"1",1=>"2",2=>"3",3=>"4",4=>"5",5=>"",),
		"DISPLAY_AS_RATING" => "rating"
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:photogallery",
	"interiors",
	Array(
		"USE_LIGHT_VIEW" => "Y",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"UPLOAD_MAX_FILE_SIZE" => "8M",
		"ALBUM_PHOTO_THUMBS_SIZE" => "220",
		"ALBUM_PHOTO_SIZE" => "0",
		"THUMBS_SIZE" => "0",
		"PREVIEW_SIZE" => "0",
		"ORIGINAL_SIZE" => "0",
		"PATH_TO_FONT" => "",
		"WATERMARK_RULES" => "USER",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "Y",
		"USE_RATING" => "N",
		"SHOW_TAGS" => "N",
		"USE_COMMENTS" => "N",
		"SHOW_LINK_ON_MAIN_PAGE" => array(),
		"USE_LIGHT_TEMPLATE" => "N",
		"WATERMARK" => "Y",
		"WATERMARK_COLORS" => array(0=>"FF0000",1=>"FFFF00",2=>"FFFFFF",3=>"000000",4=>"",),
		"ELEMENTS_USE_DESC_PAGE" => "Y",
		"SECTION_PAGE_ELEMENTS" => "15",
		"ELEMENTS_PAGE_ELEMENTS" => "50",
		"PAGE_NAVIGATION_TEMPLATE" => "orange",
		"SECTION_SORT_BY" => "UF_DATE",
		"SECTION_SORT_ORD" => "DESC",
		"ELEMENT_SORT_FIELD" => "name",
		"ELEMENT_SORT_ORDER" => "desc",
		"JPEG_QUALITY1" => "95",
		"JPEG_QUALITY2" => "95",
		"JPEG_QUALITY" => "90",
		"ADDITIONAL_SIGHTS" => array(),
		"WATERMARK_MIN_PICTURE_SIZE" => "200",
		"DATE_TIME_FORMAT_SECTION" => "d.m.Y",
		"DATE_TIME_FORMAT_DETAIL" => "d.m.Y",
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
			"PAGE_NAME" => "PAGE_NAME",
			"ACTION" => "ACTION"
		)
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>