<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "������� ����� zambaiti parati, ���� zambaiti parati, ���� zambaiti parati ����, ���� zambaiti parati ������");
$APPLICATION->SetPageProperty("description", "������� ����� zambaiti parati");
$APPLICATION->SetTitle("���� Zambaiti - ���� �� ������");
?>
<?
    if($_REQUEST["SECTION_ID"]) { 
	if($SECTION_ID=="51") header('Location:/catalog/oboi/'); /* ���� */
	if($SECTION_ID=="78") header('Location:/catalog/plitka/'); /* ������ */
	if($SECTION_ID=="140") header('Location:/catalog/mosaic/'); /* ������� */
	if($SECTION_ID=="759") header('Location:/catalog/lights/'); /* ���� */
	if($SECTION_ID=="1266") header('Location:/catalog/lepnina/'); /* ������� */
	//if($SECTION_ID=="141") $IBLOCK_ID=11; /* ����� */
    }
?>

<?if($_REQUEST['FABRIKA_ID']):?> <?$APPLICATION->IncludeComponent(
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
<table style="width: 725px;" cellspacing="0" cellpadding="0" 0?=""> 
  <tbody> 
    <tr><td style="width: 137px; vertical-align: top;"><?$APPLICATION->IncludeComponent(
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
);?> </td><td style="vertical-align: top;"><?$APPLICATION->IncludeComponent("bitrix:catalog", "catalog", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "6",
	"BASKET_URL" => "#",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/catalog/fabriki/",
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
	"COMPARE_FIELD_CODE" => array(
		0 => "IBLOCK_EXTERNAL_ID",
		1 => "",
	),
	"COMPARE_PROPERTY_CODE" => array(
		0 => "",
		1 => "ARTICUL",
		2 => "PROPERTY",
		3 => "SIZE",
		4 => "RAPPORT",
		5 => "",
	),
	"COMPARE_ELEMENT_SORT_FIELD" => "sort",
	"COMPARE_ELEMENT_SORT_ORDER" => "asc",
	"DISPLAY_ELEMENT_SELECT_BOX" => "Y",
	"ELEMENT_SORT_FIELD_BOX" => "timestamp_x",
	"ELEMENT_SORT_ORDER_BOX" => "asc",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SHOW_TOP_ELEMENTS" => "N",
	"PAGE_ELEMENT_COUNT" => "1000",
	"LINE_ELEMENT_COUNT" => "",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "NEWPRODUCT",
		2 => "ARTICUL",
		3 => "PROPERTY",
		4 => "SIZE",
		5 => "RAPPORT",
		6 => "UNIT",
		7 => "",
	),
	"INCLUDE_SUBSECTIONS" => "N",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "ARTICUL",
		2 => "PROPERTY",
		3 => "SIZE",
		4 => "RAPPORT",
		5 => "UNIT",
		6 => "PROP1",
		7 => "PROP2",
		8 => "PROP3",
		9 => "",
	),
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
	"PAGER_TITLE" => "������",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "orange",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
	)
	),
	false
);?> </td></tr>
   </tbody>
 </table>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>