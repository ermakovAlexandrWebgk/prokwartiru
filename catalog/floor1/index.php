<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������/������� � ��������-�������� prokwarti.ru");
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
		"IBLOCK_ID" => "24",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
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
	"oboi",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "24",
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
		"PRICE_CODE" => ""
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?> <?elseif(!$_REQUEST['SECTION_ID']):?> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"color_design_floor",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "24",
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
		"PRICE_CODE" => ""
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> <?endif?> 
<!-- ����� ������ -->
 
<p style="text-align: right; padding-right: 0px;"><span id="new">!</span> ��������� �������� ����������� ������ <b>������ ��������</b>. ������ ����������� �� <b>10 000 ������</b>.</p>
 
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
 <?if(false&&($_REQUEST["SECTION_ID"]=="")&&($_REQUEST["FABRIKA_ID"]=="")&&($_REQUEST["DISCOUNTS"]=="")):?> 
        <table class="catalog_main_page" border="0" cellspacing="0" cellpadding="0"> 
          <tbody> 
            <tr><td> 
<!--a href="/catalog/oboi/?SECTION_ID=42" ><img id="bxid_664073" src="/catalog/oboi/images/vinilovye.jpg" title="��������� ����" border="0" alt="��������� ����" width="137" height="137"  /></a></td><td><a id="bxid_502582" href="/catalog/oboi/?SECTION_ID=43" ><img id="bxid_283184" src="/catalog/oboi/images/flizelinovye.jpg" title="������������ ����" border="0" alt="������������ ����" width="137" height="137"  /></a></td><td><a id="bxid_599068" href="/catalog/oboi/?SECTION_ID=44" ><img id="bxid_784818" src="/catalog/oboi/images/tekstilnye.jpg" title="����������� ����" border="0" alt="����������� ����" width="137" height="137"  /></a></td><td><a id="bxid_191118" href="/catalog/oboi/?SECTION_ID=46" ><img id="bxid_117425" src="/catalog/oboi/images/bumazhnye.jpg" title="�������� ����" border="0" alt="�������� ����" width="137" height="137"  /></a></td> </tr>
           
            <tr> <td><a id="bxid_992301" href="/catalog/oboi/?SECTION_ID=58" ><img id="bxid_233287" src="/catalog/oboi/images/detskie.jpg" title="������� ����" border="0" alt="������� ����" width="137" height="137"  /></a></td><td><a id="bxid_119014" href="/catalog/oboi/?SECTION_ID=50" ><img id="bxid_5209" src="/catalog/oboi/images/oboi-iz-naturalnykh-volokon.jpg" title="���� �� ����������� �������" border="0" alt="���� �� ����������� �������" width="137" height="137"  /></a></td><td><a id="bxid_902422" href="/catalog/oboi/?SECTION_ID=49" ><img id="bxid_878730" src="/catalog/oboi/images/fotooboi.png" title="��������" border="0" alt="��������" width="137" height="137"  /></a></td><td><a id="bxid_666137" href="/catalog/oboi/?SECTION_ID=664" ><img id="bxid_379724" src="/catalog/oboi/images/sale.png" title="���������� �����" border="0" alt="���������� �����" width="137" height="137"  /></a></td></tr>
           </tbody>
         </table>
       
        <div style="padding: 15px 0px 0px 10px;"> 
          <p>�� ������ <b>������ ����</b> � ����������� � �� ������������? �������� �� ���� ����������� ���� ������ � ������, ����������� ����� �������� � ������������� ������� ��� � ���� �����������.</p>
         
          <p>������ � ������ ����������� � ����������������� ���� ����� &ndash; <a id="bxid_435802" href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a>. �������� �� ��������� � ������ ��������� ����� �� ������������ �����������: &quot;��� �� �����&quot; � &quot;��� �������&quot;. <a id="bxid_495271" href="/catalog/oboi/?SECTION_ID=42" ><b>����������� ��������� ����</b></a> &ndash; ������ ���������� ��������, ���������� ������ ����������: ��� �������, ���������� � ��������� � ����������, �������� ������ ���������� ����, �� ����� ����, � �������� <a id="bxid_833950" href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a> ����� ���� ������������. �����, ������������ ��� ������������ ��������� �����, �������� �� ����������, ����������� ��� ������� �������. � �� ����������������� ����������� ����� ���������, ������� ��������� ����. ������� ��������� ����� ��������� �����, ������� �� ���� ����� � ������ ���� ����. ����� ��������� ����� ���� �������� ������������� ������ ������ ������, � ���� ���� ���������� ����, ������, ���������� � ������. ������� ������� &ndash; <b>�������� ��������� ����</b> ������ �������� � ������ ���������� ���� ������. ���� �������� ����������� �������� �������� �� <a id="bxid_49188" href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a> ������������ <a id="bxid_928195" href="/catalog/oboi/index.php?FABRIKA_ID=142" ><b>Zambaiti Parati</b></a> (������), <a id="bxid_317785" href="/catalog/oboi/index.php?FABRIKA_ID=157" ><b>Sirpi</b></a> (������), <a id="bxid_820490" href="/catalog/oboi/index.php?FABRIKA_ID=137" ><b>Rasch</b></a> (��������), <a id="bxid_348074" href="/catalog/oboi/index.php?FABRIKA_ID=154" ><b>Marburg</b></a> (��������). ��� ������� ��������� ����� �������� �������� �� �� �����, ������������ ��������� ���� �� ����� ����������� �������. �� �����������, ��������� ������������� ��� ���� �, ���� ��� ����� ������� ���������� �����, �� ������� ����� ������������. <a id="bxid_896056" href="/catalog/oboi/?SECTION_ID=42" ><b>��������� ����</b></a> &ndash; ����������� ��������. ������� ���� &ndash; �����, ������ ���� &ndash; ������ (�������� ��� ������). ����� �� ����� ����������������? ��� ������ �������, �� �������� ���������� ������ ����� �� ����������. ���� ��������� ��������� ����� ���������� <b>������ �������� ��������� ���� �� ������������ ������</b> (������ ����� ���� ����������� ������� � �����, � ������ �� ������ �� ��), �� ��� ������ �� ������� ��������. ������� ��� ������� ��������� ����� �������������� �� ������������� ��� ������ � ������� �����, � �������, �� ����� ��� ������. ������ ��� ����� ����� ������������ ��������� � ����� ��������� ������ ����, �� �������� ��� �������� ��� �����, �������� � ������������ ���������.</p>
         
          <p>����� <a id="bxid_730682" href="/catalog/oboi/?SECTION_ID=43" ><b>������������ ����</b></a> &ndash; ����� &quot;�������&quot; ��� �� ��������� �����. �������� &ndash; ��� �������� �������� �� ������ ��������� (� ���� ��� ��, ��� ������������ ��� ����� ��������). <a id="bxid_174585" href="/catalog/oboi/?SECTION_ID=43" ><b>������������ ����</b></a> ������������, ���� ������� �� ��� ����������� ������� ����� ��������� ������. �� ����� ��������������� � ������ ������������� ��� �������������� � ����������� �����.</p>
         
          <p><a id="bxid_802806" href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> &ndash; ������� �, ��������������, ������������� ������������� �����. <a id="bxid_449277" href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> &ndash; ����������� �����, ��� ������ ���� &ndash; ������ (���� ����� ��������) � ������� ���� ����������� ������ ��� ����������� �� ������ ������������ ������. ��������� <a id="bxid_460266" href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ��� ��������, ��� � �������� ��������. <a id="bxid_721632" href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ��������� �������� ����������� ����� �����, ������� ����� ������������� ��� ������ � ��������. ��������� ����������� ���� ��������� ������, �������� ������������������ � �� ������������ ������� ������, ����� ����������� �� ������������� �� �� ��� �����, ��������, ������� ���������� � ��� ��������� � ����� �������. <a id="bxid_910920" href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ������� ����������� ���������, ����� ����� �� ���, ������ �����, ��������� � ���� ��������. ������ ������������� ������� �� <a id="bxid_71515" href="/catalog/oboi/?SECTION_ID=44" ><b>����������� ����</b></a> ���������� ��������, ������� �������� �������� �� �� �����, �� � ���� ������ ��� �������� ���� ��� ���������� �� ��������� �����. �������� ����������� ����� ������ ������ �������, ������� ����� �������� ������������.</p>
         
          <p>� ������ � �������� �����, �������, ������, �� ��� �� ����������, ��� ������� ��� ��� ������. ��� ��������� �� ����������� ������������� <a id="bxid_444034" href="/catalog/oboi/?SECTION_ID=46" ><b>�������� ����</b></a> ����� ��������� ��������� ��� ��������� ����������. <a id="bxid_894312" href="/catalog/oboi/?SECTION_ID=46" ><b>�������� ����</b></a> ������� � �������� ������, ��� ������� ������� ���������� ����, ���������� �������, �� ������ ������ � ���� ��� ��������� ���������� ��� ����� ������� �������. <a id="bxid_393852" href="/catalog/oboi/?SECTION_ID=46" ><b>�������� ����</b></a> �� ����� ������ �� ����� � � ���������.</p-->
 <?else:?> 
<!-- ���� �� ������� �������� ������� ���� (������� �������) -->
 <?$APPLICATION->IncludeComponent("bitrix:catalog", "floor", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "24",
	"BASKET_URL" => "#",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/catalog/floor/",
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
		1 => "SALELEADER",
		2 => "ARTICUL",
		3 => "PROPERTY",
		4 => "SIZE",
		5 => "UNIT",
		6 => "RAPPORT",
		7 => "",
	),
	"INCLUDE_SUBSECTIONS" => "N",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "ARTICUL",
		1 => "PROPERTY",
		2 => "SIZE",
		3 => "UNIT",
		4 => "RAPPORT",
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
);?> <?endif?> </td></tr>
           </tbody>
         </table>
       </td></tr>
   </tbody>
 </table>
 
<p></p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>