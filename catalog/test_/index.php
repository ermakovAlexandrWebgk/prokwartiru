<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "каталог обоев zambaiti parati, обои zambaiti parati, обои zambaiti parati цена, обои zambaiti parati купить");
$APPLICATION->SetPageProperty("description", "Каталог обоев zambaiti parati");
$APPLICATION->SetTitle("Обои Zambaiti - мода из Италии");
?>
<!--?=$APPLICATION->GetCurDir();?-->
 <?if(CModule::IncludeModule("iblock") && ($arIBlockSection = GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog')))?> 
<!--?=$arIBlockSection['IBLOCK_SECTION_ID']?-->
 
<!--?=$arIBlockSection['DEPTH_LEVEL']?-->
 <?if($_REQUEST['SECTION_ID'] || $_REQUEST['FABRIKA_ID']):?> <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"type",
	Array(
		"ROOT_MENU_TYPE" => "sub",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "sub",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> 
<!--?$APPLICATION->IncludeComponent(
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
);?-->
 <?endif?> 
<!--br /-->
 
<!-- Баннер -->
 
<!--?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"title-banner",
	Array(
		"TYPE" => "TITLE_BANNER",
		"NOINDEX" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "0"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?-->
 
<!-- Конец Баннер -->
 
<!-- Фильтр -->
 <?if((($arIBlockSection['IBLOCK_SECTION_ID']=="") && ($_REQUEST['SECTION_ID'])) || ($_REQUEST['FABRIKA_ID'])):?> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"test",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"FILTER_NAME" => "arFilterDop",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"LIST_HEIGHT" => "5",
		"TEXT_WIDTH" => "20",
		"NUMBER_WIDTH" => "5",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"PRICE_CODE" => array()
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> <?endif?> 
<!-- Конец Фильтр -->
 
<!-- РАСПРОДАЖА -->
 <?if($_REQUEST["SECTION_ID"]=="664"):?> 
<h1>Распродажа обоев</h1>
   <?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"sale",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
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
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"USE_FILTER" => "N",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(0=>"BASE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SHOW_TOP_ELEMENTS" => "Y",
		"TOP_ELEMENT_COUNT" => "10",
		"TOP_LINE_ELEMENT_COUNT" => "1",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_PROPERTY_CODE" => array(0=>"",1=>"",),
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "1",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"LIST_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"RAPPORT",4=>"UNIT",5=>"",),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(0=>"",1=>"",),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"OFFERS_FIELDS" => array(0=>"NAME",1=>"",),
		"OFFERS_PROPERTIES" => array(0=>"",1=>"",),
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
);?> 
<!-- Конец РАСПРОДАЖА -->
 <?else:?> 
<!-- ПРОСТО ПРОДАЖА, НЕ РАСПРОДАЖА -->
 
<table style="WIDTH: 725px" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr><?if($arIBlockSection['IBLOCK_SECTION_ID']==""):?><td style="BORDER-BOTTOM-COLOR: ; BORDER-TOP-COLOR: ; WIDTH: 137px; BORDER-RIGHT-COLOR: ; VERTICAL-ALIGN: top; BORDER-LEFT-COLOR: ; border-image: initial" ><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"left_menu",
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
);?> </td><?endif?><td style="BORDER-BOTTOM-COLOR: ; BORDER-TOP-COLOR: ; BORDER-RIGHT-COLOR: ; VERTICAL-ALIGN: top; BORDER-LEFT-COLOR: ; border-image: initial" ><?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"test",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"BASKET_URL" => "#",
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
		"COMPARE_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"RAPPORT",4=>"",),
		"COMPARE_ELEMENT_SORT_FIELD" => "name",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "Y",
		"ELEMENT_SORT_FIELD_BOX" => "timestamp_x",
		"ELEMENT_SORT_ORDER_BOX" => "asc",
		"PRICE_CODE" => array(0=>"BASE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SHOW_TOP_ELEMENTS" => "N",
		"PAGE_ELEMENT_COUNT" => "60",
		"LINE_ELEMENT_COUNT" => "",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"LIST_PROPERTY_CODE" => array(0=>"NEWPRODUCT",1=>"ARTICUL",2=>"PROPERTY",3=>"SIZE",4=>"RAPPORT",5=>"UNIT",6=>"",),
		"INCLUDE_SUBSECTIONS" => "N",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"RAPPORT",4=>"UNIT",5=>"PROP1",6=>"PROP2",7=>"PROP3",8=>"",),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
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
	)
);?> </td></tr>
  </tbody>
</table>

<!-- Конец ПРОСТО ПРОДАЖА, НЕ РАСПРОДАЖА -->
 <?endif?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>