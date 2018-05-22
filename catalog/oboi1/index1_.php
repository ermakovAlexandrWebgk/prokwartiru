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
<!-- Конец Фильтр -->
 
<!-- РАСПРОДАЖА -->
 <?if(($_REQUEST["SECTION_ID"]=="664")||($_REQUEST["SECTION_ID"]=="881")):?>    <?$APPLICATION->IncludeComponent(
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
<!-- ЕСЛИ ГЛАВНАЯ СТРАНИЦА РАЗДЕЛА ОБОИ (облегченный вариант) -->
 <?if(($_REQUEST["SECTION_ID"]=="")&&($_REQUEST["FABRIKA_ID"]=="")&&($_REQUEST["DISCOUNTS"]=="")):?> 
        <table class="catalog_main_page" border="0" cellspacing="0" cellpadding="0"> 
          <tbody> 
            <tr><td><a href="/catalog/oboi/?SECTION_ID=42" ><img src="/catalog/oboi/images/vinilovye.jpg" title="Виниловые обои" border="0" alt="Виниловые обои" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=43" ><img src="/catalog/oboi/images/flizelinovye.jpg" title="Флизелиновые обои" border="0" alt="Флизелиновые обои" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=44" ><img src="/catalog/oboi/images/tekstilnye.jpg" title="Текстильные обои" border="0" alt="Текстильные обои" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=46" ><img src="/catalog/oboi/images/bumazhnye.jpg" title="Бумажные обои" border="0" alt="Бумажные обои" width="137" height="137"  /></a></td> </tr>
           
            <tr> <td><a href="/catalog/oboi/?SECTION_ID=58" ><img src="/catalog/oboi/images/detskie.jpg" title="Детские обои" border="0" alt="Детские обои" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=45" ><img src="/catalog/oboi/images/fresky.jpg" title="Фрески" border="0" alt="Фрески" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=49" ><img src="/catalog/oboi/images/fotooboi.png" title="Фотообои" border="0" alt="Фотообои" width="137" height="137"  /></a></td><td><a href="/catalog/oboi/?SECTION_ID=664" ><img src="/catalog/oboi/images/sale.png" title="Распродажа обоев" border="0" alt="Распродажа обоев" width="137" height="137"  /></a></td></tr>
           </tbody>
         </table>
       
        <div style="padding: 15px 0px 0px 10px;"> 
          <p>Вы решили <b>купить обои</b> и растерялись в их разнообразии? Опираясь на свой многолетний опыт работы с обоями, специалисты нашей компании с удовольствием помогут Вам в этом разобраться.</p>
         
          <p>Начнем с самого популярного и распространенного вида обоев &ndash; <a href="/catalog/oboi/?SECTION_ID=42" ><b>виниловые обои</b></a>. Хотелось бы выступить в защиту виниловых обоев от общепринятых заблуждений: &quot;они не дышат&quot; и &quot;они вредные&quot;. <a href="/catalog/oboi/?SECTION_ID=42" ><b>Современные виниловые обои</b></a> – вполне безобидный материал, обладающий массой достоинств: они прочные, устойчивые к выгоранию и деформации, скрывают мелкие неровности стен, их можно мыть, а поклеить <a href="/catalog/oboi/?SECTION_ID=42" ><b>виниловые обои</b></a> может даже неспециалист. Винил, используемый при производстве виниловых обоев, делается по стандартам, применяемым для детских игрушек. А их воздухопропускные способности легко проверить, проведя несложный опыт. Возьмем небольшой кусок виниловых обоев, свернем из него кулек и нальем туда воды. Через некоторое время вода начинает просачиваться сквозь стенки кулька, а если обои пропускают воду, значит, пропускают и воздух. Главное правило – <b>покупать виниловые обои</b> только солидных и хорошо показавших себя фабрик. Наша компания рекомендует обратить внимание на <a href="/catalog/oboi/?SECTION_ID=42" ><b>виниловые обои</b></a> производства <a href="/catalog/oboi/index.php?FABRIKA_ID=142" ><b>Zambaiti Parati</b></a> (Италия), <a href="/catalog/oboi/index.php?FABRIKA_ID=157" ><b>Sirpi</b></a> (Италия), <a href="/catalog/oboi/index.php?FABRIKA_ID=137" ><b>Rasch</b></a> (Германия), <a href="/catalog/oboi/index.php?FABRIKA_ID=154" ><b>Marburg</b></a> (Германия). При покупке виниловых обоев обратите внимание на их запах, качественные виниловые обои не имеют неприятного аромата. Не стесняйтесь, понюхайте понравившиеся вам обои и, если они имеют сильный химический запах, от покупки лучше воздержаться. <a href="/catalog/oboi/?SECTION_ID=42" ><b>Виниловые обои</b></a> – двухслойный материал. Верхний слой – винил, нижний слой – основа (флизелин или бумага). Какая из основ предпочтительнее? Это вопрос спорный, на конечном результате основа никак не отражается. Ваши строители наверняка будут советовать <b>купить метровые виниловые обои на флизелиновой основе</b> (клеить такие обои значительно быстрее и легче, а деньги за работу те же), но это вопрос их личного удобства. Поэтому при покупке виниловых обоев ориентируйтесь на понравившийся вам дизайн и фактуру обоев, и неважно, на какой они основе. Данный вид обоев можно использовать абсолютно в любом помещении вашего дома, но особенно они подходят для кухни, коридора и коммерческих помещений.</p>
         
          <p>Чисто <a href="/catalog/oboi/?SECTION_ID=43" ><b>флизелиновые обои</b></a> – самый &quot;молодой&quot; вид из семейства обоев. Флизелин – это нетканый материал на основе целлюлозы (в быту это то, что подкладывают под борта пиджаков). <a href="/catalog/oboi/?SECTION_ID=43" ><b>Флизелиновые обои</b></a> бесфактурные, либо фактура на них достигается толстым слоем акриловой краски. По своим характеристикам и местам использования они приравниваются к текстильным обоям.</p>
         
          <p><a href="/catalog/oboi/?SECTION_ID=44" ><b>Текстильные обои</b></a> – элитное и, соответственно, дорогостоящее подразделение обоев. <a href="/catalog/oboi/?SECTION_ID=44" ><b>Текстильные обои</b></a> – двухслойный пирог, где нижний слой – основа (чаще всего флизелин) и верхний слой представлен тканью или наклеенными на основу текстильными нитями. Продаются <a href="/catalog/oboi/?SECTION_ID=44" ><b>текстильные обои</b></a> как рулонами, так и погонным метражом. <a href="/catalog/oboi/?SECTION_ID=44" ><b>Текстильные обои</b></a> считаются наиболее экологичным видом обоев, поэтому особо рекомендуются для спален и гостиных. Поскольку текстильные обои впитывают запахи, наименее светоустойстойчивы и не подвергаются влажной уборке,  наши специалисты не рекомендовали бы их для кухни, коридора, комнаты курильщика и для помещений с ярким солнцем. <a href="/catalog/oboi/?SECTION_ID=44" ><b>Текстильные обои</b></a> требуют деликатного обращения, любое пятно на них, скорее всего, останется с вами навсегда. Иногда производители наносят на <a href="/catalog/oboi/?SECTION_ID=44" ><b>текстильные обои</b></a> тефлоновую пропитку, которая призвана защитить их от пятен, но в этом случае они начинают мало чем отличаться от виниловых обоев. Поклейка текстильных обоев весьма тонкий процесс, который лучше доверить специалистам.</p>
         
          <p>И теперь о бумажных обоях, которые, кстати, не так уж экологичны, как принято про них думать. Для повышения их технических характеристик <a href="/catalog/oboi/?SECTION_ID=46" ><b>бумажные обои</b></a> часто покрывают виниловым или акриловым напылением. <a href="/catalog/oboi/?SECTION_ID=46" ><b>Бумажные обои</b></a> плоские и довольно тонкие, они требуют хорошей подготовки стен, подвержены усадкам, их сложно клеить и даже при наилучшем результате шов будет немного заметен. <a href="/catalog/oboi/?SECTION_ID=46" ><b>Бумажные обои</b></a> не стоит клеить на кухне и в коридорах.</p>
         <?else:?> 
<!-- ЕСЛИ НЕ ГЛАВНАЯ СТРАНИЦА РАЗДЕЛА ОБОИ (тяжелый вариант) -->
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
	"PAGER_TITLE" => "Товары",
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
 
<!-- Конец ПРОСТО ПРОДАЖА, НЕ РАСПРОДАЖА -->
 <?endif?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>