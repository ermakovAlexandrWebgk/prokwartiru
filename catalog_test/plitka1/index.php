<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Плитка в интернет-магазине prokwarti.ru");
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
<!-- Фильтр -->
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
<!-- Конец Фильтр -->
 
<!--?if(($_REQUEST['SECTION_ID']=="83")||($_REQUEST['SECTION_ID']=="84")||($_REQUEST['SECTION_ID']=="85")||($_REQUEST['SECTION_ID']=="1881")||($_REQUEST['SECTION_ID']=="1882")):?-->
 
<p style="text-align: left; padding-left: 200px;"><span id="new">!</span> Заказы по плитке принимаются от <b>10 000 рублей.</b></p>
 
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
<!-- ЕСЛИ ГЛАВНАЯ СТРАНИЦА РАЗДЕЛА ПЛИТКА(облегченный вариант) -->
 <?if(($_REQUEST["SECTION_ID"]=="")&&($_REQUEST["FABRIKA_ID"]=="")):?> 
<!--td style="width: 137px;"> 
<a id="bxid_942162" href="/catalog/plitka/?SECTION_ID=1883" ><img id="bxid_205786" src="/catalog/plitka/images/plitka_dlya_basseyna.jpg" title="Плитка для бассейна" border="0" alt="Плитка для бассейна" width="137" height="137"  /></a></td-->
 
<!--a href="/catalog/plitka/?SECTION_ID=1884" ><img id="bxid_236944" src="/catalog/plitka/images/soputstvuyushchie_tovary.jpg" title="Сопутствующие товары" border="0" alt="Сопутствующие товары" width="137" height="137"  /></a-->
 
        <table class="catalog_main_page" border="0" cellspacing="0" cellpadding="0"> 
          <tbody> 
            <tr> <td><a href="/catalog/plitka/?SECTION_ID=83" ><img src="/catalog/plitka/images/keramicheskaya_plitka_dlya_vannoy.jpg" title="Керамическая плитка для ванной" border="0" alt="Керамическая плитка для ванной" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=1881" ><img src="/catalog/plitka/images/krupnoformatnaya_plitka_dlya_vannoy.jpg" title="Крупноформатная плитка для ванной" border="0" alt="Крупноформатная плитка для ванной" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=84" ><img src="/catalog/plitka/images/keramicheskaya_plitka_dlya_pola.jpg" title="Керамическая плитка для пола" border="0" alt="Керамическая плитка для пола" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=1882" ><img src="/catalog/plitka/images/keramogranit.jpg" title="Керамогранит" border="0" alt="Керамогранит" width="137" height="137"  /></a></td> </tr>
           
            <tr><td> 
<!--a href="/catalog/plitka/?SECTION_ID=31" ><img id="bxid_40490" src="/catalog/plitka/images/plitka_dlya_fartuka.jpg" title="Плитка для кухонного фартука" border="0" alt="Плитка для кухонного фартука" width="137" height="137"  /></a-->
 <a href="/catalog/plitka/?SECTION_ID=4163" ><img id="bxid_232843" src="/catalog/plitka/images/plitka_dlya_fartuka.jpg" title="Плитка для кухонного фартука" border="0" alt="Плитка для кухонного фартука" width="137" height="137"  /></a></td> <td><a href="/catalog/plitka/?SECTION_ID=85" ><img src="/catalog/plitka/images/klinkernaya_plitka_stupeni.jpg" width="137" height="137"  /></a></td> <td><a href="/catalog/mosaic/" ><img src="/catalog/plitka/images/mosaic.jpg" title="Мозаика" border="0" alt="Мозаика" width="137" height="137"  /></a></td> <td> <a href="/catalog/plitka/3d-project.php" ><img src="/catalog/plitka/images/3d-project.jpg" title="3D-проект в подарок" border="0" alt="3D-проект в подарок" width="137" height="137"  /></a> </td> </tr>
           </tbody>
         </table>
       
        <div style="padding: 15px 10px 0px 10px;"> 
          <p><a href="/about/contacts/" >Магазин современного интерьера &laquo;ПроКвартиРу&raquo;</a> предлагает широкий спектр керамической плитки для самых разных интерьеров. Наши специалисты имеют многолетний опыт работы с керамикой и с удовольствием помогут Вам разобраться во всем этом разнообразии материалов. Ввиду большого количества противоречивой информации об этом продукте мы подготовили перечень наиболее часто задаваемых вопросов, ответы на которые, надеемся, удовлетворят Вас в полной мере и склонят покупать плитку именно в <a href="/about/contacts/" >нашем магазине</a>.</p>
         		 		 
          <p><b>Плитку какого производителя предпочесть?</b></p>
         		 
          <p>Наиболее преуспели в керамической отрасли (так сложилось исторически) такие страны, как Испания и Италия. Распознать среди них солидного производителя можно, оценив количество коллекций керамической плитки, выпускаемых фабрикой и завозимых в Россию, и частотой встречаемости их в интернете.</p>
         		 
          <p><b>Какую плитку выбрать, если нужно сэкономить?</b></p>
         		 
          <p>Ценовой разброс керамики, представленной на рынке, довольно велик. Хотя, зачастую кажется, что плитка почти вся одинаковая. Вследствие этого у покупателя может возникнуть вполне закономерный вопрос: стоит ли переплачивать при покупке плитки, когда каждая копейка во время ремонта на счету? Для наглядности и четкого понимания вопроса ценообразования мы хотели бы привести пример, наиболее полно иллюстрирующий разницу. Возьмем отечественный автомобиль и противопоставим ему автомобиль немецкого производства, есть между ними разница? Здесь Вы однозначно ответите &ndash; да, даже если Вы не продвинутый автомобилист. Хотя, казалось бы, и тут машина и тут, и колеса есть и багажник на месте&hellip; В ситуации с плиткой все ровно так же. Поэтому, покупая плитку отечественного производства, не ждите от нее отличного качества. Если же Ваш бюджет ограничен и нет возможности потратиться на продукцию премиум класса таких производителей, как, скажем: <a href="/catalog/plitka/index.php?FABRIKA_ID=4667" >Porcelanosa</a> (Порчеланоса), <a href="/catalog/plitka/index.php?FABRIKA_ID=5034" >Venis</a> (Венис), <a href="/catalog/plitka/index.php?FABRIKA_ID=5862" >Atlas Concorde</a> (Атлас Конкорд) или <a href="/catalog/plitka/index.php?FABRIKA_ID=26149" >Ariostea</a> (Ариостеа), то мы бы посоветовали в этом случае присмотреться к испанской плитке в эконом-сегменте: <a href="/catalog/plitka/index.php?FABRIKA_ID=30779" >Cristacer</a> (Кристакер), <a href="/catalog/plitka/index.php?FABRIKA_ID=6959" >Gaya</a> (Гайя), <a href="/catalog/plitka/index.php?FABRIKA_ID=21379" >Halcon</a> (Халкон), <a href="/catalog/plitka/index.php?FABRIKA_ID=23150" >Novogres</a> (Новогрес). По цене выйдет почти как отечественная, но качество будет значительно лучше.</p>
         		 
          <p><b>Какого цвета выбрать плитку для ванной комнаты?</b></p>
         		 
          <p>Что касается цветовой гаммы, тут сложно что-либо советовать. Берите тот цвет, который Вам нравится, ведь выбор сейчас огромный: и модные пастельные оттенки, и бодрящие по утрам яркие цвета, и классические бежевые тональности. Традиционные приемы, вроде «холодные светлые оттенки зрительно расширяют пространство» и т.д., в ванной комнате работают плохо (слишком маленькое помещение).</p>
         		 
          <p><b>Какой формат плитки для ванной комнаты выбрать?</b></p>
         		 
          <p>Последние несколько лет все мировые производители керамической плитки последовательно идут в сторону увеличения формата выпускаемой ими продукции, такие знакомые и дорогие сердцу форматы, как: 20х25 и 20х30 – почти канули в лету. Между тем, многие покупатели настороженно и порой даже негативно относятся к этой тенденции. Мы твердо убеждены, что не нужно бояться крупного формата плитки на стенах в маленькой ванной. Крупная настенная ректифицированная плитка кладется с минимальным швом и создает ощущение единой поверхности, не разделенной на сегменты, что работает на зрительное увеличение пространства (нет ощущения, что смотришь на школьную тетрадь в клетку). Поэтому, нет смысла ограничивать себя в выборе, зацикливаясь на каком-то определенном формате (например, удобном Вашему мастеру), который является скорее стилистическим ограничением. Если Вам нравится плитка, ее цвет, фактура, декоры – берите, не обращая внимания на формат!</p>
         
          <p><b>Что такое ректифицированная плитка?</b></p>
         
          <p>Ректифицированная плитка, это керамическая плитка, прошедшая процесс ректификации (дополнительная обработка края плитки с помощью лазерной резки). После данной обработки геометрия и размеры плитки становится почти идеальными, что, в свою очередь, позволяет укладывать такую плитку с минимально возможным швом в 1,5 мм. Делать шов меньше, чем 1,5 мм, не рекомендуется из-за затруднения процесса заполнения межплиточных швов затиркой. Ректифицированию, как правило, подвергается крупноформатная плитка из белой глины (белая глина более пластична и лучше держит форму).</p>
         		 
          <p><b>Глянцевую или матовую плитку для ванной выбрать?</b></p>
         		 
          <p>У каждой из этих двух видов есть свои достоинства и недостатки. Глянцевая поверхность из-за своего отражающего свет эффекта дает ощущение увеличения пространства и его парадности, но подобная поверхность потребует частого ухода, так как на глянцевой поверхности более заметны подтеки и капли от воды. Матовая поверхность в этом отношении более практична, смотрится теплее и уютнее, от отражающего эффекта не даст.</p>
         		 
          <p><b>Какой должна быть напольная плитка для ванной комнаты?</b></p>
         		 
          <p>Как правило, в коллекцию плитки для ванной комнаты, предлагаемой производителем, уже входит пол, подходящий по цвету и формату. Что же касается его технических характеристик, то ничего особенного от него не требуется, разве что, быть нескользким. Однако, уважающие себя фабрики это обязательно учитывают.</p>
         		 
          <p><b>Как выбрать напольную плитку для кухни или коридора? Обязательно ли брать керамогранит?</b></p>
         		 
          <p>Прежде всего, необходимо отметить, что у каждого вида керамической плитки есть определенные технические характеристики, которые и определяют место ее применения. Например, для стен производят настенную плитку, чьи характеристики не позволяют укладывать ее на пол или на стены фасада дома. Существует также керамическая напольная плитка, предназначенная для укладки на пол в коридор или кухню квартиры или частного дома. Кроме того, имеется специальная плитка (керамогранит), предназначенная для укладки в помещения с повышенной проходимостью и сложными эксплуатационными условиями, например, торговых центров. Таким образом, покупать на пол кухни или коридора в квартире керамогранит, это все равно, что приобретать полноприводный внедорожник для езды по городу… Нет никакой необходимости, но если очень хочется, тогда конечно! Возвращаясь к теме выбора напольной керамической плитки для кухни и коридора: цвет, фактура и размер могут быть любыми, соответствующими вашему стилистическому решению и, конечно, сочетающимися с остальной обстановкой вашего помещения. Что же касаемо ее технических характеристик, то у данной плитки должна быть степень износоустойчивости 3 или 4 (обозначается символом PEI 3 или PEI 4). Эти параметры должны быть указаны в генеральном каталоге фабрики производителя.</p>
         		 
          <p><b>Нравится глянцевая напольная плитка, но боимся, что будет скользко, так ли это?</b></p>
         		 
          <p>Глянцевая поверхность у плитки получается двумя способами: методом полировки уже готовой плитки и методом нанесения на нее глянцевой глазури. Полированная плитка, особенно при попадании на нее воды, действительно довольно скользкая. Что же касается второго метода, то в глазурь многие фабрики подмешивают разные добавки (например, измельченный в порошок корунд), с помощью которых достигается так называемый «антискользящий эффект». Кроме того, существует еще лапатированная глянцевая плитка, - это когда поверхность плитки имеет небольшие выщербинки (эффект состаренности), подскользнуться на такой поверхности сложнее.</p>
         	 </div>
       <?else:?> 
<!-- ЕСЛИ НЕ ГЛАВНАЯ СТРАНИЦА РАЗДЕЛА ПЛИТКА (тяжелый вариант) -->
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
);?><?endif?> </td></tr>
   </tbody>
 </table>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>