<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обои в интернет-магазине prokwarti.ru");
?> 
<!--script type="text/javascript"> 
function show_img(url,width,height)  
{  
  var a;  
  var b;  
  var url;  
  vidWindowWidth=width;  
  vidWindowHeight=height;  
  a=(screen.height-vidWindowHeight)/5;  
  b=(screen.width-vidWindowWidth)/2;  
  features = "top=" + a +   
             ",left=" + b +   
             ",width=" + vidWindowWidth +   
             ",height=" + vidWindowHeight +   
             ",toolbar=no," +   
             "menubar=no," +  
             "location=no," +  
             "directories=no," +  
             "scrollbars=no," +  
             "resizable=no";  
  window.open(url,'',features,true);  
} 
</script-->
 
<!--a href="#" onclick="show_img(&quot;filter.php&quot;, 300, 400);" >Открыть окно</a-->
 
<div><a href="javascript:" class="poisk" onclick="if(document.getElementById('filter').style.display=='none') { document.getElementById('filter').style.display='inline'; document.getElementById('filter_list').style.display='none'; } else { document.getElementById('filter').style.display='none'; document.getElementById('filter_list').style.display='inline';} " > ПАРАМЕТРЫ 
    <br />
   ПОДБОРА</a> <?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"search",
	Array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "Y",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/search/index.php",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(0=>"iblock_catalog",),
		"CATEGORY_0_iblock_catalog" => array(0=>"5",1=>"4",2=>"10",3=>"24",4=>"17",5=>"20",6=>"11",7=>"6",),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> </div>
 
<div style="display: none;" id="filter"> <?$APPLICATION->IncludeComponent(
	"prokwartiru:store.catalog.filter",
	"search",
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
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"PRICE_CODE" => ""
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> </div>
<div id="filter_list">
<table style="width: 725px;" border="0" cellspacing="0" cellpadding="0"> 
  <tbody> 
    <tr><td style="vertical-align: top;"><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"oboi_filters_test",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "5",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FILTER_NAME" => "arFilterDop",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(0=>"SALE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(),
		"USE_PRODUCT_QUANTITY" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "orange",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?></td></tr>
   </tbody>
 </table>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>