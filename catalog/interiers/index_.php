<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интерьеры");
?> 
<!--?=$APPLICATION->GetCurDir();?-->
 <?if(CModule::IncludeModule("iblock") && ($arIBlockSection = GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog')))?> 
<!--?=$arIBlockSection['IBLOCK_SECTION_ID']?-->
 
<!-- Верхнее меню -->
 <?if($_REQUEST['SECTION_ID']):?> <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"interiers",
	Array(
		"ROOT_MENU_TYPE" => "interiers",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "interiers",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> 
<!-- Верхнее меню -->
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => ""
	)
);?><?else:?> 
<br />
 <?endif?> 
<!-- Конец Верхнее меню -->
 
<!-- --------------------------------------------- -->
 
<!--?=$APPLICATION->GetCurDir();?-->
 <?if(CModule::IncludeModule("iblock") && ($arIBlockSection = GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog')))?> 
<!--?=$arIBlockSection['IBLOCK_SECTION_ID']?-->
 
<table style="width: 725px;" border="0" cellspacing="0" cellpadding="0"> 
  <tbody> 
    <tr><td style="width: 137px; vertical-align: top;"> <?if(!($_REQUEST['SECTION_ID']):?> 
<!-- Левое меню -->
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"vertical_interiers",
	Array(
		"ROOT_MENU_TYPE" => "interiers",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => "",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "interiers",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => ""
	)
);?> 
<!-- Конец Левое меню -->
 <?else:?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"left_menu_interiers",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_USER_FIELDS" => array(0=>"",1=>"UF_COLLECTIONS",2=>"",),
		"SECTION_URL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> <?endif?> </td><td style="vertical-align: top;"><?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"interiors",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "9",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"USE_FILTER" => "N",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "Y",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_FIELD_CODE" => array(0=>"IBLOCK_EXTERNAL_ID",1=>"",),
		"COMPARE_PROPERTY_CODE" => array(0=>"",1=>"ARTICUL",2=>"PROPERTY",3=>"SIZE",4=>"RAPPORT",5=>"",),
		"COMPARE_ELEMENT_SORT_FIELD" => "name",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"PRICE_CODE" => array(0=>"BASE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SHOW_TOP_ELEMENTS" => "N",
		"PAGE_ELEMENT_COUNT" => "40",
		"LINE_ELEMENT_COUNT" => "1",
		"ELEMENT_SORT_FIELD" => "name",
		"ELEMENT_SORT_ORDER" => "asc",
		"LIST_PROPERTY_CODE" => array(0=>"CATALOG",1=>"INTERIER",2=>"",),
		"INCLUDE_SUBSECTIONS" => "N",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(0=>"CATALOG",1=>"INTERIER",2=>"ARTICUL",3=>"PROPERTY",4=>"SIZE",5=>"RAPPORT",6=>"PROP1",7=>"PROP2",8=>"PROP3",9=>"",),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "NAME",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "orange",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID"
		)
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> </td></tr>
   </tbody>
 </table>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>