<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "������� ����� zambaiti parati, ���� zambaiti parati, ���� zambaiti parati ����, ���� zambaiti parati ������");
$APPLICATION->SetPageProperty("description", "������� ����� zambaiti parati");
$APPLICATION->SetTitle("���� Zambaiti - ���� �� ������");
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
 
<!-- ������ -->
 
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
 
<!-- ����� ������ -->
 
<!-- ������ -->
 <?if((($arIBlockSection['IBLOCK_SECTION_ID']=="") && ($_REQUEST['SECTION_ID'])) || ($_REQUEST['FABRIKA_ID'])):?> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"oboi_filters",
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
);?> <?elseif(!$_REQUEST['SECTION_ID']):?> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"oboi_filters",
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
<!-- ����� ������ -->
 
<!-- ���������� -->
 <?if(($_REQUEST["SECTION_ID"]=="664")||($_REQUEST["SECTION_ID"]=="881")):?> �� <?$APPLICATION->IncludeComponent(
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
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"USE_FILTER" => "N",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(0=>"SALE",1=>"BASE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SHOW_TOP_ELEMENTS" => "Y",
		"TOP_ELEMENT_COUNT" => "10",
		"TOP_LINE_ELEMENT_COUNT" => "1",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_PROPERTY_CODE" => array(0=>"",1=>"",),
		"PAGE_ELEMENT_COUNT" => "1000",
		"LINE_ELEMENT_COUNT" => "1",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"LIST_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"RAPPORT",4=>"UNIT",5=>"",),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"RAPPORT",4=>"UNIT",5=>"SALELEADER",6=>"",),
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
		"PAGER_TITLE" => "������",
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
<!-- ����� ���������� -->
 <?else:?> 
<!-- ������ �������, �� ���������� -->
 
<table style="width: 725px;" border="0" cellspacing="0" cellpadding="0"> 
  <tbody> 
    <tr><?if($arIBlockSection['IBLOCK_SECTION_ID']==""):?><td style="width: 137px; vertical-align: top;" ><?$APPLICATION->IncludeComponent(
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
);?> </td><?endif?><td style="vertical-align: top;" > 
<!-- ���� ������� �������� ������� ���� (����������� �������) -->
 <?if(($_REQUEST["SECTION_ID"]=="")&&($_REQUEST["FABRIKA_ID"]=="")&&($_REQUEST["DISCOUNTS"]=="")):?> 
        <table class="catalog_main_page" border="0" cellspacing="0" cellpadding="0"> 
          <tbody> 
            <tr><td><a href="/catalog/oboi/?SECTION_ID=42" ><img src="/catalog/oboi/images/vinilovye.jpg" title="��������� ����" border="0" alt="��������� ����" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=43" ><img src="/catalog/oboi/images/flizelinovye.jpg" title="������������ ����" border="0" alt="������������ ����" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=44" ><img src="/catalog/oboi/images/tekstilnye.jpg" title="����������� ����" border="0" alt="����������� ����" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=46" ><img src="/catalog/oboi/images/bumazhnye.jpg" title="�������� ����" border="0" alt="�������� ����" width="137" height="137"  /></a></td> </tr>
           
            <tr> <td><a href="/catalog/oboi/?SECTION_ID=58" ><img src="/catalog/oboi/images/detskie.jpg" title="������� ����" border="0" alt="������� ����" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=45" ><img src="/catalog/oboi/images/fresky.jpg" title="������" border="0" alt="������" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=49" ><img src="/catalog/oboi/images/fotooboi.png" title="��������" border="0" alt="��������" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=664" ><img src="/catalog/oboi/images/sale.png" title="���������� �����" border="0" alt="���������� �����" width="137" height="137"  /></a></td></tr>
           </tbody>
         </table>
       
        <div style="padding: 15px 0px 0px 10px;"> 
          <p>�� ������ <b>������ ����</b> � ����������� � �� ������������? �������� �� ���� ����������� ���� ������ � ������, ����������� ����� �������� � ������������� ������� ��� � ���� �����������.</p>
         
          <p>������ � ������ ����������� � ����������������� ���� ����� &ndash; <a href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a>. �������� �� ��������� � ������ ��������� ����� �� ������������ �����������: &quot;��� �� �����&quot; � &quot;��� �������&quot;. <a href="/catalog/oboi/?SECTION_ID=42" ><b>����������� ��������� ����</b></a> � ������ ���������� ��������, ���������� ������ ����������: ��� �������, ���������� � ��������� � ����������, �������� ������ ���������� ����, �� ����� ����, � �������� <a href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a> ����� ���� ������������. �����, ������������ ��� ������������ ��������� �����, �������� �� ����������, ����������� ��� ������� �������. � �� ����������������� ����������� ����� ���������, ������� ��������� ����. ������� ��������� ����� ��������� �����, ������� �� ���� ����� � ������ ���� ����. ����� ��������� ����� ���� �������� ������������� ������ ������ ������, � ���� ���� ���������� ����, ������, ���������� � ������. ������� ������� � <b>�������� ��������� ����</b> ������ �������� � ������ ���������� ���� ������. ���� �������� ����������� �������� �������� �� <a href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a> ������������ <a href="/catalog/oboi/index.php?FABRIKA_ID=142" ><b>Zambaiti Parati</b></a> (������), <a href="/catalog/oboi/index.php?FABRIKA_ID=157" ><b>Sirpi</b></a> (������), <a href="/catalog/oboi/index.php?FABRIKA_ID=137" ><b>Rasch</b></a> (��������), <a href="/catalog/oboi/index.php?FABRIKA_ID=154" ><b>Marburg</b></a> (��������). ��� ������� ��������� ����� �������� �������� �� �� �����, ������������ ��������� ���� �� ����� ����������� �������. �� �����������, ��������� ������������� ��� ���� �, ���� ��� ����� ������� ���������� �����, �� ������� ����� ������������. <a href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a> � ����������� ��������. ������� ���� � �����, ������ ���� � ������ (�������� ��� ������). ����� �� ����� ����������������? ��� ������ �������, �� �������� ���������� ������ ����� �� ����������. ���� ��������� ��������� ����� ���������� <b>������ �������� ��������� ���� �� ������������ ������</b> (������ ����� ���� ����������� ������� � �����, � ������ �� ������ �� ��), �� ��� ������ �� ������� ��������. ������� ��� ������� ��������� ����� �������������� �� ������������� ��� ������ � ������� �����, � �������, �� ����� ��� ������. ������ ��� ����� ����� ������������ ��������� � ����� ��������� ������ ����, �� �������� ��� �������� ��� �����, �������� � ������������ ���������.</p>
         
          <p>����� <a href="/catalog/oboi/?SECTION_ID=43" ><b>������������ ����</b></a> � ����� &quot;�������&quot; ��� �� ��������� �����. �������� � ��� �������� �������� �� ������ ��������� (� ���� ��� ��, ��� ������������ ��� ����� ��������). <a href="/catalog/oboi/?SECTION_ID=43" ><b>������������ ����</b></a> ������������, ���� ������� �� ��� ����������� ������� ����� ��������� ������. �� ����� ��������������� � ������ ������������� ��� �������������� � ����������� �����.</p>
         
          <p><a href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> � ������� �, ��������������, ������������� ������������� �����. <a href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> � ����������� �����, ��� ������ ���� � ������ (���� ����� ��������) � ������� ���� ����������� ������ ��� ����������� �� ������ ������������ ������. ��������� <a href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ��� ��������, ��� � �������� ��������. <a href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ��������� �������� ����������� ����� �����, ������� ����� ������������� ��� ������ � ��������. ��������� ����������� ���� ��������� ������, �������� ������������������ � �� ������������ ������� ������, ����� ����������� �� ������������� �� �� ��� �����, ��������, ������� ���������� � ��� ��������� � ����� �������. <a href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ������� ����������� ���������, ����� ����� �� ���, ������ �����, ��������� � ���� ��������. ������ ������������� ������� �� <a href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ���������� ��������, ������� �������� �������� �� �� �����, �� � ���� ������ ��� �������� ���� ��� ���������� �� ��������� �����. �������� ����������� ����� ������ ������ �������, ������� ����� �������� ������������.</p>
         
          <p>� ������ � �������� �����, �������, ������, �� ��� �� ����������, ��� ������� ��� ��� ������. ��� ��������� �� ����������� ������������� <a href="/catalog/oboi/?SECTION_ID=46" ><b>�������� ����</b></a> ����� ��������� ��������� ��� ��������� ����������. <a href="/catalog/oboi/?SECTION_ID=46" ><b>�������� ����</b></a> ������� � �������� ������, ��� ������� ������� ���������� ����, ���������� �������, �� ������ ������ � ���� ��� ��������� ���������� ��� ����� ������� �������. <a href="/catalog/oboi/?SECTION_ID=46" ><b>�������� ����</b></a> �� ����� ������ �� ����� � � ���������.</p>
         <?else:?> 
<!-- ���� �� ������� �������� ������� ���� (������� �������) -->
 <?$APPLICATION->IncludeComponent("bitrix:catalog", "oboi_test", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "5",
	"BASKET_URL" => "#",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/catalog/oboi/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"USE_FILTER" => "N",
	"USE_REVIEW" => "N",
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "SALE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SHOW_TOP_ELEMENTS" => "N",
	"PAGE_ELEMENT_COUNT" => "100",
	"LINE_ELEMENT_COUNT" => "",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "NEWPRODUCT",
		1 => "ARTICUL",
		2 => "PROPERTY",
		3 => "SIZE",
		4 => "RAPPORT",
		5 => "UNIT",
		6 => "DELIVERY",
		7 => "SALELEADER",
		8 => "",
	),
	"INCLUDE_SUBSECTIONS" => "N",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "ARTICUL",
		1 => "PROPERTY",
		2 => "SIZE",
		3 => "RAPPORT",
		4 => "UNIT",
		5 => "PROP1",
		6 => "PROP2",
		7 => "PROP3",
		8 => "",
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
);?> <?endif?> </div>
       </td></tr>
   </tbody>
 </table>
 
<!-- ����� ������ �������, �� ���������� -->
 <?endif?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>