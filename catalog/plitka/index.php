<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������ � ��������-�������� prokwarti.ru");
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
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?-->
 <?endif?> 
<!-- ������ -->
 <?if((($arIBlockSection['IBLOCK_SECTION_ID']=="") && ($_REQUEST['SECTION_ID'])) || ($_REQUEST['FABRIKA_ID'])):?> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"plitka",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"FILTER_NAME" => "arFilterDop",
		"FIELD_CODE" => array(0=>"",1=>"",2=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"",2=>"",),
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
 
<!--?if(($_REQUEST['SECTION_ID']=="83")||($_REQUEST['SECTION_ID']=="84")||($_REQUEST['SECTION_ID']=="85")||($_REQUEST['SECTION_ID']=="1881")||($_REQUEST['SECTION_ID']=="1882")):?-->
 
<p style="text-align: left; padding-left: 200px;"><span id="new">!</span> ������ �� ������ ����������� �� <b>10 000 ������.</b></p>
 
<!--?endif?-->
 
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
<!-- ���� ������� �������� ������� ������(����������� �������) -->
 <?if(($_REQUEST["SECTION_ID"]=="")&&($_REQUEST["FABRIKA_ID"]=="")):?> 
<!--td style="width: 137px;"> 
<a id="bxid_942162" href="/catalog/plitka/?SECTION_ID=1883" ><img id="bxid_205786" src="/catalog/plitka/images/plitka_dlya_basseyna.jpg" title="������ ��� ��������" border="0" alt="������ ��� ��������" width="137" height="137"  /></a></td-->
 
<!--a href="/catalog/plitka/?SECTION_ID=1884" ><img id="bxid_236944" src="/catalog/plitka/images/soputstvuyushchie_tovary.jpg" title="������������� ������" border="0" alt="������������� ������" width="137" height="137"  /></a-->
 
        <table class="catalog_main_page" border="0" cellspacing="0" cellpadding="0"> 
          <tbody> 
            <tr> <td><a href="/catalog/plitka/?SECTION_ID=83" ><img src="/catalog/plitka/images/keramicheskaya_plitka_dlya_vannoy.jpg" title="������������ ������ ��� ������" border="0" alt="������������ ������ ��� ������" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=1881" ><img src="/catalog/plitka/images/krupnoformatnaya_plitka_dlya_vannoy.jpg" title="��������������� ������ ��� ������" border="0" alt="��������������� ������ ��� ������" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=84" ><img src="/catalog/plitka/images/keramicheskaya_plitka_dlya_pola.jpg" title="������������ ������ ��� ����" border="0" alt="������������ ������ ��� ����" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=1882" ><img src="/catalog/plitka/images/keramogranit.jpg" title="������������" border="0" alt="������������" width="137" height="137"  /></a></td> </tr>
           
            <tr><td> 
<!--a href="/catalog/plitka/?SECTION_ID=31" ><img id="bxid_40490" src="/catalog/plitka/images/plitka_dlya_fartuka.jpg" title="������ ��� ��������� �������" border="0" alt="������ ��� ��������� �������" width="137" height="137"  /></a-->
 <a href="/catalog/plitka/?SECTION_ID=4163" ><img id="bxid_232843" src="/catalog/plitka/images/plitka_dlya_fartuka.jpg" title="������ ��� ��������� �������" border="0" alt="������ ��� ��������� �������" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=85" ><img src="/catalog/plitka/images/klinkernaya_plitka_stupeni.jpg" width="137" height="137"  /></a></td> <td><a href="/catalog/mosaic/" ><img src="/catalog/plitka/images/mosaic.jpg" title="�������" border="0" alt="�������" width="137" height="137"  /></a></td> <td> <a href="/catalog/plitka/3d-project.php" ><img src="/catalog/plitka/images/3d-project.jpg" title="3D-������ � �������" border="0" alt="3D-������ � �������" width="137" height="137"  /></a> </td> </tr>
           </tbody>
         </table>
       
        <div style="padding: 15px 10px 0px 10px;"> 
          <p><a href="/about/contacts/" >������� ������������ ��������� &laquo;�����������&raquo;</a> ���������� ������� ������ ������������ ������ ��� ����� ������ ����������. ���� ����������� ����� ����������� ���� ������ � ��������� � � ������������� ������� ��� ����������� �� ���� ���� ������������ ����������. ����� �������� ���������� �������������� ���������� �� ���� �������� �� ����������� �������� �������� ����� ���������� ��������, ������ �� �������, ��������, ������������ ��� � ������ ���� � ������� �������� ������ ������ � <a href="/about/contacts/" >����� ��������</a>.</p>
         		 		 
          <p><b>������ ������ ������������� �����������?</b></p>
         		 
          <p>�������� ��������� � ������������ ������� (��� ��������� �����������) ����� ������, ��� ������� � ������. ���������� ����� ��� ��������� ������������� �����, ������ ���������� ��������� ������������ ������, ����������� �������� � ��������� � ������, � �������� ������������� �� � ���������.</p>
         		 
          <p><b>����� ������ �������, ���� ����� ����������?</b></p>
         		 
          <p>������� ������� ��������, �������������� �� �����, �������� �����. ����, �������� �������, ��� ������ ����� ��� ����������. ���������� ����� � ���������� ����� ���������� ������ ������������ ������: ����� �� ������������� ��� ������� ������, ����� ������ ������� �� ����� ������� �� �����? ��� ����������� � ������� ��������� ������� ��������������� �� ������ �� �������� ������, �������� ����� �������������� �������. ������� ������������� ���������� � ��������������� ��� ���������� ��������� ������������, ���� ����� ���� �������? ����� �� ���������� �������� &ndash; ��, ���� ���� �� �� ����������� ������������. ����, �������� ��, � ��� ������ � ���, � ������ ���� � �������� �� �����&hellip; � �������� � ������� ��� ����� ��� ��. �������, ������� ������ �������������� ������������, �� ����� �� ��� ��������� ��������. ���� �� ��� ������ ��������� � ��� ����������� ����������� �� ��������� ������� ������ ����� ��������������, ���, ������: <a href="/catalog/plitka/index.php?FABRIKA_ID=4667" >Porcelanosa</a> (�����������), <a href="/catalog/plitka/index.php?FABRIKA_ID=5034" >Venis</a> (�����), <a href="/catalog/plitka/index.php?FABRIKA_ID=5862" >Atlas Concorde</a> (����� �������) ��� <a href="/catalog/plitka/index.php?FABRIKA_ID=26149" >Ariostea</a> (��������), �� �� �� ������������ � ���� ������ ������������� � ��������� ������ � ������-��������: <a href="/catalog/plitka/index.php?FABRIKA_ID=30779" >Cristacer</a> (���������), <a href="/catalog/plitka/index.php?FABRIKA_ID=6959" >Gaya</a> (����), <a href="/catalog/plitka/index.php?FABRIKA_ID=21379" >Halcon</a> (������), <a href="/catalog/plitka/index.php?FABRIKA_ID=23150" >Novogres</a> (��������). �� ���� ������ ����� ��� �������������, �� �������� ����� ����������� �����.</p>
         		 
          <p><b>������ ����� ������� ������ ��� ������ �������?</b></p>
         		 
          <p>��� �������� �������� �����, ��� ������ ���-���� ����������. ������ ��� ����, ������� ��� ��������, ���� ����� ������ ��������: � ������ ���������� �������, � �������� �� ����� ����� �����, � ������������ ������� �����������. ������������ ������, ����� ��������� ������� ������� ��������� ��������� ������������ � �.�., � ������ ������� �������� ����� (������� ��������� ���������).</p>
         		 
          <p><b>����� ������ ������ ��� ������ ������� �������?</b></p>
         		 
          <p>��������� ��������� ��� ��� ������� ������������� ������������ ������ ��������������� ���� � ������� ���������� ������� ����������� ��� ���������, ����� �������� � ������� ������ �������, ���: 20�25 � 20�30 � ����� ������ � ����. ����� ���, ������ ���������� ������������ � ����� ���� ��������� ��������� � ���� ���������. �� ������ ��������, ��� �� ����� ������� �������� ������� ������ �� ������ � ��������� ������. ������� ��������� ����������������� ������ �������� � ����������� ���� � ������� �������� ������ �����������, �� ����������� �� ��������, ��� �������� �� ���������� ���������� ������������ (��� ��������, ��� �������� �� �������� ������� � ������). �������, ��� ������ ������������ ���� � ������, ������������ �� �����-�� ������������ ������� (��������, ������� ������ �������), ������� �������� ������ �������������� ������������. ���� ��� �������� ������, �� ����, �������, ������ � ������, �� ������� �������� �� ������!</p>
         
          <p><b>��� ����� ����������������� ������?</b></p>
         
          <p>����������������� ������, ��� ������������ ������, ��������� ������� ������������ (�������������� ��������� ���� ������ � ������� �������� �����). ����� ������ ��������� ��������� � ������� ������ ���������� ����� ����������, ���, � ���� �������, ��������� ���������� ����� ������ � ���������� ��������� ���� � 1,5 ��. ������ ��� ������, ��� 1,5 ��, �� ������������� ��-�� ����������� �������� ���������� ������������ ���� ��������. ����������������, ��� �������, ������������ ��������������� ������ �� ����� ����� (����� ����� ����� ��������� � ����� ������ �����).</p>
         		 
          <p><b>��������� ��� ������� ������ ��� ������ �������?</b></p>
         		 
          <p>� ������ �� ���� ���� ����� ���� ���� ����������� � ����������. ��������� ����������� ��-�� ������ ����������� ���� ������� ���� �������� ���������� ������������ � ��� ����������, �� �������� ����������� ��������� ������� �����, ��� ��� �� ��������� ����������� ����� ������� ������� � ����� �� ����. ������� ����������� � ���� ��������� ����� ���������, ��������� ������ � ������, �� ����������� ������� �� ����.</p>
         		 
          <p><b>����� ������ ���� ��������� ������ ��� ������ �������?</b></p>
         		 
          <p>��� �������, � ��������� ������ ��� ������ �������, ������������ ��������������, ��� ������ ���, ���������� �� ����� � �������. ��� �� �������� ��� ����������� �������������, �� ������ ���������� �� ���� �� ���������, ����� ���, ���� �����������. ������, ��������� ���� ������� ��� ����������� ���������.</p>
         		 
          <p><b>��� ������� ��������� ������ ��� ����� ��� ��������? ����������� �� ����� ������������?</b></p>
         		 
          <p>������ �����, ���������� ��������, ��� � ������� ���� ������������ ������ ���� ������������ ����������� ��������������, ������� � ���������� ����� �� ����������. ��������, ��� ���� ���������� ��������� ������, ��� �������������� �� ��������� ���������� �� �� ��� ��� �� ����� ������ ����. ���������� ����� ������������ ��������� ������, ��������������� ��� ������� �� ��� � ������� ��� ����� �������� ��� �������� ����. ����� ����, ������� ����������� ������ (������������), ��������������� ��� ������� � ��������� � ���������� ������������� � �������� ����������������� ���������, ��������, �������� �������. ����� �������, �������� �� ��� ����� ��� �������� � �������� ������������, ��� ��� �����, ��� ����������� �������������� ����������� ��� ���� �� ������ ��� ������� �������������, �� ���� ����� �������, ����� �������! ����������� � ���� ������ ��������� ������������ ������ ��� ����� � ��������: ����, ������� � ������ ����� ���� ������, ���������������� ������ ��������������� ������� �, �������, ������������� � ��������� ����������� ������ ���������. ��� �� ������� �� ����������� �������������, �� � ������ ������ ������ ���� ������� ������������������ 3 ��� 4 (������������ �������� PEI 3 ��� PEI 4). ��� ��������� ������ ���� ������� � ����������� �������� ������� �������������.</p>
         		 
          <p><b>�������� ��������� ��������� ������, �� ������, ��� ����� ��������, ��� �� ���?</b></p>
         		 
          <p>��������� ����������� � ������ ���������� ����� ���������: ������� ��������� ��� ������� ������ � ������� ��������� �� ��� ��������� �������. ������������ ������, �������� ��� ��������� �� ��� ����, ������������� �������� ���������. ��� �� �������� ������� ������, �� � ������� ������ ������� ����������� ������ ������� (��������, ������������ � ������� ������), � ������� ������� ����������� ��� ���������� ��������������� ������. ����� ����, ���������� ��� �������������� ��������� ������, - ��� ����� ����������� ������ ����� ��������� ���������� (������ �������������), ��������������� �� ����� ����������� �������.</p>
         	 </div>
       <?else:?> 
<!-- ���� �� ������� �������� ������� ������ (������� �������) -->
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"plitka",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
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
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"USE_FILTER" => "N",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(0=>"SALE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "0",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SHOW_TOP_ELEMENTS" => "N",
		"PAGE_ELEMENT_COUNT" => "1000",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"LIST_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"UNIT",4=>"PROP5",5=>"PROP1",6=>"PROP2",7=>"PROP3",8=>"RAPPORT",9=>"",),
		"INCLUDE_SUBSECTIONS" => "N",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(0=>"ARTICUL",1=>"PROPERTY",2=>"SIZE",3=>"UNIT",4=>"PROP5",5=>"PROP1",6=>"PROP2",7=>"PROP3",8=>"RAPPORT",9=>"",),
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
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID"
		)
	)
);?><?endif?> </td></tr>
   </tbody>
 </table>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>