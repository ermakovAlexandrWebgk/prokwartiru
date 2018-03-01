<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интерьеры в интернет-магазине современного интерьера  www.prokwarti.ru");
?> <? $SECTION_ID=$_REQUEST['SECTION_ID']; ?> <? $FABRIKA_ID=$_REQUEST['FABRIKA_ID']; ?> 
<!--?=$APPLICATION->GetCurDir();?-->
 
<!--?if(CModule::IncludeModule("iblock") && ($arIBlockSection = GetIBlockSection($SECTION_ID, 'catalog'))):?-->
 <?if($SECTION_ID || $FABRIKA_ID):?> 
<div style="margin-bottom: 10px;"> <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"interiers",
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
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> </div>
 <?endif?> 
<!-- Фильтр -->
 <?if(($SECTION_ID&&$SECTION_ID!="76"&&$SECTION_ID!="86")||$FABRIKA_ID):?> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"interiers",
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
		"PRICE_CODE" => ""
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> <?endif?> 
<!-- Конец Фильтр -->
 
<table style="width: 725px;" border="0" cellspacing="0" cellpadding="0"> 
  <tbody> 
    <tr><td style="width: 137px; vertical-align: top;"> <?if(!($SECTION_ID || $FABRIKA_ID)):?> 
<!-- Левое меню -->
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"vertical_interiers",
	Array(
		"ROOT_MENU_TYPE" => "interiers",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_USE_GROUPS" => "N",
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
);?> 
<!--?$APPLICATION->IncludeComponent(
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
);?-->
 <?endif?> </td><td style="vertical-align: top;"> 
<!-- ЕСЛИ ГЛАВНАЯ СТРАНИЦА РАЗДЕЛА ИНТЕРЬЕРЫ (облегченный вариант) -->
 
<!--?if($SECTION_ID==""):?-->
 
<!--table class="catalog_main_page" border="0" cellspacing="0" cellpadding="0"> 
          <tbody> 
            <tr><td><a id="bxid_428330" href="/catalog/interiers/?SECTION_ID=76" ><img id="bxid_67428" src="/catalog/interiers/images/oboi.jpg" border="0" width="137" height="137" title="Обои в интерьере" alt="Обои в интерьере"  /></a></td> <td><a id="bxid_41419" href="/catalog/interiers/?SECTION_ID=86" ><img id="bxid_922116" src="/catalog/interiers/images/plitka.jpg" border="0" width="137" height="137" title="Плитка в интерьере" alt="Плитка в интерьере"  /></a></td> <td><a id="bxid_847373" href="/catalog/interiers/?SECTION_ID=865" ><img id="bxid_623028" src="/catalog/interiers/images/svet.jpg" border="0" width="137" height="137" title="Свет в интерьере" alt="Свет в интерьере"  /></a></td> <td><a id="bxid_936540" href="/catalog/interiers/?SECTION_ID=87" ><img id="bxid_635001" src="/catalog/interiers/images/nashi-raboty.jpg" border="0" width="137" height="137" title="Наши работы" alt="Наши работы"  /></a></td> </tr>
           </tbody>
         </table-->
 
<!--?else:?-->
 
<!-- ЕСЛИ НЕ ГЛАВНАЯ СТРАНИЦА РАЗДЕЛА ИНТЕРЬЕРЫ (тяжелый вариант) -->
 <?$APPLICATION->IncludeComponent("bitrix:catalog", "interiers", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "9",
	"BASKET_URL" => "#",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/catalog/interiers/",
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
	"COMPARE_ELEMENT_SORT_FIELD" => "name",
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
	"PAGE_ELEMENT_COUNT" => "40",
	"LINE_ELEMENT_COUNT" => "",
	"ELEMENT_SORT_FIELD" => "name",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "CATALOG",
		1 => "INTERIER",
		2 => "NEWPRODUCT",
		3 => "ARTICUL",
		4 => "PROPERTY",
		5 => "SIZE",
		6 => "RAPPORT",
		7 => "UNIT",
		8 => "",
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
	"PAGER_TITLE" => "Интерьеры",
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
);?> 
<!--?endif?-->
 <?if((($_REQUEST['SECTION_ID']=="") || ($_REQUEST['SECTION_ID']=="76") || ($_REQUEST['SECTION_ID']=="86")) &&($_REQUEST['FABRIKA_ID']=="")):?> 
        <div style="clear: both; padding-left: 10px;"> 
          <h1>Интерьеры</h1>
         
          <p>Данная страница нашего сайта сделана, чтобы помочь Вам определиться с выбором материалов для отделки Вашего дома. Здесь собрано множество гостиных, спален, детских и ванных комнат на любой вкус и кошелек. Если задумавшись о ремонте, Вы запутались в разнообразии стилей и видов отделки, пришли, как говориться, в &ldquo;творческий тупик&rdquo; или , может, Вы вообще не обладаете талантом к созданию уютного интерьера &ndash; полистайте нашу подборку фотографий помещений, созданных профессионалами. Это может натолкнуть Вас на какую-то идею или Вы сможете полностью “скопировать” понравившийся интерьер. Наши консультанты помогут Вам идентифицировать артикулы материалов, из которых была создана приглянувшаяся картинка. Если же данный просмотр не помог и Вы по-прежнему не видите “как оформить комнату”, то закажите нашу услугу по подбору обоев и плитки и мы вместе обязательно найдем решение для Вашего индивидуального интерьера.</p>
         </div>
       <?endif?> </td></tr>
   </tbody>
 </table>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>