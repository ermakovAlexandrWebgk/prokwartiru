<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>
<? $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>

<? $filter_price=$_REQUEST["PRICE_ID"];?>
<? $COLOR_ID=$_REQUEST["COLOR_ID"];?>
<? $DESIGN_ID=$_REQUEST["DESIGN_ID"];?>
<? $WIDTH_ID=$_REQUEST["WIDTH_ID"];?>
<? $TYPE=$_REQUEST['TYPE'];?>
<? $NEW=$_REQUEST['NEW'];?>
<? $HIT=$_REQUEST['HIT'];?>
<? $DISCOUNT=$_REQUEST['DISCOUNT'];?>
<? $INSTOCK=$_REQUEST['INSTOCK'];?>
<? $STYLE_ID=$_REQUEST['STYLE_ID'];?>
<? $MATERIAL_ID=$_REQUEST['MATERIAL_ID'];?>
<? $SIZE_ID=$_REQUEST['SIZE_ID'];?>
<? $PRICE_FROM=$_REQUEST['PRICE_FROM'];?>
<? $PRICE_TO=$_REQUEST['PRICE_TO'];?>
<? $ORDER=$_REQUEST['ORDER'];?>
<? $numberFilter=0;?>

<?CModule::IncludeModule('sale');?>

<!-- Товар в корзине -->
<?
$arPageItems = array();
function inBasket($elementID)
{
// Выведем актуальную корзину для текущего пользователя
	global $arPageItems;
	$arBasketItems = array();

	$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
        false,
        false,
        array()
	);

	while ($arItems = $dbBasketItems->Fetch())
	{
	  if ($arItems['PRODUCT_ID'])
	  {
		if($arItem["DELAY"] == "Y")
			$arPageItemsDelay[] = $arItems['PRODUCT_ID'];
		else
			$arPageItems[] = $arItems['PRODUCT_ID'];		
	  }
	}
if(in_array($elementID,$arPageItems)) return true;
	else return false;
//return true; echo("$elementID");
}
?>


<!-- Всплывание карточки товара -->
<script type="text/javascript">

function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return title+"<p style='padding-bottom:10px; font-weight:normal;'>Товар: <b style='color:black;'>"+(currentIndex+1)+"</b> из "+currentArray.length+"</span></p>";
}

$(function() {
	$('div.item-image b').fancybox({
		'padding': 20,
		'imageScale': false,

/*		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,

		'overlayShow': false,
		'cyclic' : true,
		'autoScale': true,
		'titlePosition': 'inside',
		'hideOnContentClick': false,
*/
		'titlePosition': 'over',
		'frameHeight': 300,
/*		'height': 600,*/
		'titleFormat': formatTitle
	});
});

</script>
<!-- Конец Всплывания карточки товара -->

<!-- Ajax кнопки -->
<script type="text/javascript">

function Add22Compare(path) {     
     $.ajax({
             type:'POST',
             url:path
            })
}
$n=0;
function Add2Basket(path, element) {
	$.ajax({
             type:'POST',
             url:path
            });
	$(document).ready(function(){$("#catalog_add2cart1_link_"+element).click(function () {
		$("#catalog_add2cart1_link_"+element).html("Товар<br />в корзине").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
		$("#catalog_add2cart_link_"+element).html("Уже в корзине").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
	}); 	});
<!--?if($n==0) $n=1; else $n=0;?-->
}
</script>
<!-- Конец Ajax кнопки -->




<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox").fancybox({
				prevEffect : 'none',
				nextEffect : 'none',
				helpers: {
					title : {
						type : 'inside'
					}
				}
			});

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<script language="JavaScript">
   winW = document.documentElement.clientWidth*0.8;  
   winH = document.documentElement.clientHeight*0.85; 
   winWpic = winW*0.7;
   winHpic = winH-30;
   winWpic1 = winW-410;
   winHpic1 = winH-10;
   display = "none";
</script>


<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<!--?if($_REQUEST['SECTION_ID']) $section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?-->
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
if($arSite=="/catalog/lights/") $iblock_ID=17; /* свет */
if($arSite=="/catalog/floor/") $iblock_ID=24; /* паркет */
?>

<!--? $rubric=$_REQUEST["RUBRIC_ID"];?-->

<!-- Заголовок страницы -->
<?
$db_color_list = CIBlockProperty::GetPropertyEnum("COLOR", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$iblock_ID, "ID"=>$COLOR_ID));
while($ar_color_list = $db_color_list->GetNext()) $color=$ar_color_list["VALUE"];
$db_design_list = CIBlockProperty::GetPropertyEnum("DESIGN", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>$iblock_ID, "ID"=>$DESIGN_ID));
while($ar_design_list = $db_design_list->GetNext()) $design=$ar_design_list["VALUE"];
  $page_title="<h1 id='page_title' style='padding-left: 10px;'><span>Обои";
  if($color||$design) $page_title=$page_title." &ndash;";
  if($color) $page_title=$page_title." цвет: ".$color;
  if($color&&$design) $page_title=$page_title.";";
  if($design) $page_title=$page_title." рисунок: ".$design;
  $page_title=$page_title."</span></h1>"; 
  $window_title="Обои";
  $keywords="обои ".$color.", обои ".$design;
 
?>
<!--?=$page_title?-->
<!-- Конец Заголовок страницы -->

<div class="catalog-item-cards" style="position: relative; width:750px;">

<?
$arSort = Array("SORT"=>"ASC");
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_*", "CATALOG_QUANTITY");

// ФИЛЬТР
$arFilterMain=Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "PROPERTY_COLOR"=>$COLOR_ID, "PROPERTY_DESIGN"=>$DESIGN_ID, "PROPERTY_MATERIAL"=>$MATERIAL_ID, "PROPERTY_STYLE"=>$STYLE_ID, "PROPERTY_DELIVERY"=>$ORDER, "PROPERTY_FILTER_SIZE"=>$SIZE_ID);
//global $arFilterDop;

switch ($filter_price) {
case 6:
    $price_min=1; $price_max=1000;
    break;
case 7:
    $price_min=1000; $price_max=1499;
    break;
case 8:
    $price_min=1500; $price_max=1999;
    break;
case 9:
    $price_min=2000; $price_max=2999;
    break;
case 60:
    $price_min=3000; $price_max=3999;
    break;
case 61:
    $price_min=4000; $price_max=4999;
    break;
case 10:
    $price_min=5000; $price_max=1000000;
    break;
default:
    $price_min=0; $price_max=1000000;
    break;
}

$price_min=$PRICE_FROM;
$price_max=$PRICE_TO;


$arFilterPrice=Array(">=CATALOG_PRICE_5"=>$price_min, "<=CATALOG_PRICE_5"=>$price_max);
$arFilter = array_merge($arFilterMain, $arFilterPrice);

if($INSTOCK){
    $arFilterInstock=Array(">CATALOG_QUANTITY"=>0);
    $arFilter = array_merge($arFilter, $arFilterInstock);
}

$arFilterCatalog=array();

if($SECTION_ID)
  $arFilterActive = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "!ID"=>881, "SECTION_ID"=>$SECTION_ID);
else
  $arFilterActive = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "!ID"=>881);
$listActive=array();
$listCatalogActive=CIBlockSection::GetList(Array(), $arFilterActive, true, Array("ID"));
while($arCatalogActive = $listCatalogActive->GetNext()) {
    $listActive[]=$arCatalogActive['ID'];
  }
$arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, Array("SECTION_ID"=>$listActive));

if($FABRIKA_ID){
  $arFilterFabrika = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "UF_FABRIKA"=>$FABRIKA_ID);
  $i=0; $list=array();
  $listFabrika=CIBlockSection::GetList(Array(), $arFilterFabrika, true, Array("ID"));
  while($arFabrika = $listFabrika->GetNext()) {
    //$list[]=$arWidth['ID'];
    $FABRIKA_LIST.=$arFabrika["ID"].",";
  }
//echo($FABRIKA_LIST);
  $FABRIKA_LIST=explode(",", $FABRIKA_LIST);
  $arFilterCatalogFabrika= Array("SECTION_ID"=>$FABRIKA_LIST);
  $arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, $arFilterCatalogFabrika);
}
if($WIDTH_ID){
  $arFilterWidth = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "UF_WIDTH"=>$WIDTH_ID);
  $i=0; $list=array();
  $listWidth=CIBlockSection::GetList(Array(), $arFilterWidth, true, Array("ID"));
  while($arWidth = $listWidth->GetNext()) {
    //$list[]=$arWidth['ID'];
    $WIDTH_LIST.=$arWidth["ID"].",";
  }
  $WIDTH_LIST=explode(",", $WIDTH_LIST);
  $arFilterCatalogWidth= Array("SECTION_ID"=>$WIDTH_LIST);
  $arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, $arFilterCatalogWidth);
}
if($NEW){
    $sectionOrder = Array('NAME'=>'ASC');
    $sectionFilter = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "UF_NEWCATALOG"=>true);
    $sectionSelect = Array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'UF_NEWCATALOG');
    $sectionNav = Array("nPageSize"=>1000000);
    $sectionList = CIBlockSection::GetList($sectionOrder, $sectionFilter, true, $sectionSelect, $sectionNav);
    $i=0;
    while($sectionItem=$sectionList->GetNext())
    {
          $SECTION_LIST.=$sectionItem["ID"].",";
    }
    $SECTION_LIST=explode(",", $SECTION_LIST);
    $arFilterNew = Array("SECTION_ID"=>$SECTION_LIST);
    //$arFilterCatalog = array_merge($arFilterCatalog, $arFilterNew);
    $arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, $arFilterNew);
}
if($HIT){
    $sectionOrder = Array('NAME'=>'ASC');
    $sectionFilter = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "UF_HIT"=>true);
    $sectionSelect = Array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'UF_HIT');
    $sectionNav = Array("nPageSize"=>1000000);
    $sectionList = CIBlockSection::GetList($sectionOrder, $sectionFilter, true, $sectionSelect, $sectionNav);
    $i=0;
    while($sectionItem=$sectionList->GetNext())
    {
          $SECTION_LIST.=$sectionItem["ID"].",";
    }
    $SECTION_LIST=explode(",", $SECTION_LIST);
    $arFilterHit = Array("SECTION_ID"=>$SECTION_LIST);
    $arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, $arFilterHit);
}
if($DISCOUNT=="true"){
    $sectionOrder = Array('NAME'=>'ASC');
    $sectionFilter1 = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "UF_SALE_OBOI"=>array(46, 47, 48, 49, 50, 51, 52, 69));
    $sectionFilter2 = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$iblock_ID, "UF_DISCOUNT10"=>true);
    $sectionFilter1 = array("LOGIC" => "AND", $sectionFilter1 , $sectionFilter2);
    $sectionSelect = Array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'UF_SALE_OBOI', 'UF_DISCOUNT10');
    $sectionNav = Array("nPageSize"=>1000000);
    $sectionList1 = CIBlockSection::GetList($sectionOrder, $sectionFilter1, true, $sectionSelect, $sectionNav);
    $i=0;
    while($sectionItem1=$sectionList1->GetNext())
    {
          $SECTION_LIST1.=$sectionItem1["ID"].",";
    }
//echo($SECTION_LIST1);

    $SECTION_LIST1=explode(",", $SECTION_LIST1);
    $arFilterDiscount = Array("SECTION_ID"=>$SECTION_LIST1);  
    $arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, $arFilterDiscount);
    //$arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalogFabrika, $arFilterDiscount);
}

$arFilterCatalog = array("LOGIC" => "AND", $arFilterCatalog, array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "!ID"=>881));
$arFilter=array_merge($arFilter, $arFilterCatalog);
?>
<!-- Конец Фильтр -->

<?
if($DISCOUNT=="true"){
// Выбрать элементы со скидкой
   $res = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>10000000), $arSelect);
   $res1=array();
   while($arElement = $res->GetNext())
   {
      $price = CPrice::GetBasePrice($arElement['ID']);
      $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
            $price["ID"],
            $USER->GetUserGroupArray(),
            "N",
            SITE_ID
        );
      $discountPrice = CCatalogProduct::CountPriceWithDiscount(
            $price["PRICE"],
            $price["CURRENCY"],
            $arDiscounts
        );
      $price["DISCOUNT_PRICE"] = $discountPrice;
      if($price["DISCOUNT_PRICE"] < $price["PRICE"]){
         $res1[]=array(
            "ID"=>$arElement["ID"],
            "IBLOCK_SECTION_ID" => $arElement["IBLOCK_SECTION_ID"],
            "NAME" => $arElement["NAME"],
            "PREVIEW_PICTURE" => $arElement["PREVIEW_PICTURE"],
            "DETAIL_PICTURE" => $arElement["DETAIL_PICTURE"]
         );
      }

   }
   $rs = new CDBResult;
   $rs->InitFromArray($res1);
   $rs->NavStart(40);
   //if($rs->IsNavPrint())
   //{
    // echo "<p>"; $rs->NavPrint("Элементы"); echo "</p>";
   //}
   $res=$rs;
}
else
// Выбрать все элементы по 40 на странице
   $res = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>40), $arSelect);
?>

<?$NAV_STRING = $res->GetPageNavStringEx($navComponentObject,  "Товары", "orange");?>
<? $numberElements=0; ?>
<? while($arElement = $res->GetNext())
{ 
   $section=GetIBlockSection($arElement["IBLOCK_SECTION_ID"], 'catalog');
//echo("---".$section['ACTIVE']);
   //if(!$section['ACTIVE']||($section['ID']==881))  continue;
   //if(($TYPE=="new")&&(!$section['UF_NEWCATALOG'])) continue;
   
   $numberElements++;

//<!-- ЦЕНА -->
   $price = CPrice::GetBasePrice($arElement['ID']);

   $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
            $price["ID"],
            $USER->GetUserGroupArray(),
            "N",
            SITE_ID
        );
    $discount = "<p><b class='orange' style='font-size: 20px;'>".$arDiscounts[0]["NOTES"]."</b></p>";

    $discountPrice = CCatalogProduct::CountPriceWithDiscount(
            $price["PRICE"],
            $price["CURRENCY"],
            $arDiscounts
        );
    $price["DISCOUNT_PRICE"] = $discountPrice;

    $db_props = CIBlockElement::GetProperty(5, $arElement['ID'], array("sort" => "asc"), Array("CODE"=>"UNIT"));
    if($ar_props = $db_props->Fetch())
        $unitID = $ar_props["VALUE"];
    $unit = CIBlockPropertyEnum::GetByID($unitID);

    if($price["DISCOUNT_PRICE"] < $price["PRICE"]){
      $price_print="<s>".CurrencyFormat($price["PRICE"], $price['CURRENCY'])."</s> <span class='item-price'>".CurrencyFormat($price["DISCOUNT_PRICE"], $price['CURRENCY'])."</span>";
      $price_print_float="<s>".CurrencyFormat($price["PRICE"], $price['CURRENCY'])."</s> <span class='float-card-price'>".CurrencyFormat($price["DISCOUNT_PRICE"], $price['CURRENCY'])."</span> / ".$unit['VALUE'];
    }
    //elseif($DISCOUNT) {
    //   continue;
    //}
    else {
      $price_print="<span class='item-price'>".CurrencyFormat($price["DISCOUNT_PRICE"], $price['CURRENCY'])."</span>";
      $price_print_float="<span class='float-card-price'>".CurrencyFormat($price["DISCOUNT_PRICE"], $price['CURRENCY'])."</span> / ".$unit['VALUE'];
    }
//<!-- Конец ЦЕНА -->

// ОТБОР ПО ДИАПАЗОНУ ЦЕН
//if (($price['PRICE']>$price_min)&&($price['PRICE']<=$price_max))
//{
//echo ($price['PRICE']);

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("HIT", "NEW", "SALE") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>

	<div class="_catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">

<!-- КАРТОЧКА ТОВАРА -->
	<div class="catalog-item-card">
<? $page_url="index.php?SECTION_ID=".$arElement['IBLOCK_SECTION_ID']."&ELEMENT_ID=".$arElement['ID'];?>
<? $add_url="index.php?action=ADD2BASKET&id=".$arElement['ID']."&SECTION_ID=".$arElement['IBLOCK_SECTION_ID'];?>

<!-- Заголовок карточки -->
  <div class="item-title"><nobr><span>Арт.</span> <a href="<?=$page_url?>" title="<?=$arElement['NAME']?>"><!--?=$arElement["ID"]?--><b><?=$arElement["NAME"]?></b></a><?=$sticker?></nobr></div>
<!-- Конец Заголовок карточки -->



  <div class="item-info">
	<div class="item-desc">
				
<!-- Картинка со всплывающей карточкой товара -->

<!-- Формируем Текст описания товара -->

<!-- Заголовок Название товара -->
	<?$title=$arElement['NAME'];?>
<!-- Конец Заголовок Название товара -->

<!-- Количество Товара -->
<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="Складская программа"; else $quantity="Под заказ";?>
<!-- Конец Количество Товара -->

<!-- Характеристики товара -->
<?
$fabrika='';
$country='';
$new_catalog='';
$hit_catalog='';
$glue='';
$section=GetIBlockSection($arElement["IBLOCK_SECTION_ID"], 'catalog');
  if($section&&($section['ID']!=881)) { 
    $type = CIBlockSection::GetList(array(), array('ACTIVE'=>'Y','IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG', 'UF_HIT', 'UF_GLUE','UF_SHOWROOM'));
    if($type_item = $type->GetNext()){
	$fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog');
	$country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog'); 
        if($type_item['UF_NEWCATALOG']) $new_catalog=true;
        if($type_item['UF_HIT']) $hit_catalog=true;
        //if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
        if($glue=GetIBlockElement($type_item['UF_GLUE'], 'catalog')) $glue_pic=CFile::GetPath($glue["PREVIEW_PICTURE"]);
     }
   }
?>
<?
if(CModule::IncludeModule('iblock') && ($element = CIBlockElement::GetByID($arElement["ID"]))) 
{
	if($ar_element = $element->GetNext())
	{
		$property = CIBlockElement::GetProperty($ar_element['IBLOCK_ID'], $ar_element['ID'], "sort", "asc", Array());
		$text="<div class='float-card-properties'>";
		if($section['NAME']) $text=$text."<p>Коллекция: <a href='/catalog/oboi/index.php?SECTION_ID=".$section["ID"]."'><b>".$section['NAME']."</a></b>";
                if($new_catalog) $text=$text."&nbsp;<span id='new'>NEW</span>";
                if($hit_catalog) $text=$text."&nbsp;<span id='hit'>HIT</span>";
                $text=$text."<br />";
		if($fabrika['NAME']) $text=$text."Фабрика: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		while ($ar_property=$property->GetNext()){	
			//if($ar_property['CODE']=='POWER' || $ar_property['CODE']=='PROPERTY' || $ar_property['CODE']=='SIZE') $text=$text."<p>".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
			if($ar_property['CODE']=='PROPERTY') $properties="Основные характеристики: ".$ar_property['VALUE']."<br />";
			elseif($ar_property['CODE']=='SIZE') $size="Размер: ".$ar_property['VALUE']."<br />";
			elseif($ar_property['CODE']=='RAPPORT') $rapport="Раппорт (подбор): ".$ar_property['VALUE']."<br />";
			elseif($ar_property['CODE']=='DELIVERY') $delivery_days=$ar_property['VALUE'];

			elseif($ar_property['CODE']=='NEW') $new=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='HIT') $hit=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='SALE') $sale=$ar_property['VALUE'];
			//$text=$text."<p>".$ar_property['CODE']." ".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
                }
		$text=$text.$properties.$size.$rapport;
		$text=$text."Наличие: <b>".$quantity."</b>";
		$text=$text."</div>";
	}
}
?>
<!-- Конец характеристики -->

<!-- Кнопка Купить -->
<?
	$button_buy="<div class='catalog-item-links_'><div class='catalog-item-links_new'>";
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons' onclick_='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'><a href='javascript:;' class='catalog-item-buy' rel='nofollow' onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>Добавить<br />в корзину</a></div>";		
		else $button_buy=$button_buy."<div class='buttons' ><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>Товар<br />в корзине</a></div>";	
	//if ($arElement['CAN_BUY']) {
	//	if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons' onclick_='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'><a href='javascript:;' class='catalog-item-buy' rel='nofollow' onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>Добавить<br />в корзину</a></div>";		
	//	else $button_buy=$button_buy."<div class='buttons' ><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>Товар<br />в корзине</a></div>";	
	//}
	//elseif (count($arElement['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
        //else $button_buy=$button_buy."777";
	$button_buy=$button_buy.$on."</div></div>";
	//$arPageItems[] = $arElement["ID"];
?>


<!-- Конец Кнопки Купить -->

<!-- Кнопка В блокнот -->
<? $compare_url="index.php?action=ADD_TO_COMPARE_LIST&SECTION_ID=".$arElement['IBLOCK_SECTION_ID']."&id=".$arElement['ID'];?>

<?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$compare_url."&quot;);'>В блокнот</a></div></div>";?>
<!-- Конец Кнопки В блокнот -->

<!-- Доставка товара -->
<? 
    $delivery="<div style='margin: 0px 0 0px 0px;'><p>Срок поставки:</p><p><a href='/about/delivery/'><img src='".SITE_TEMPLATE_PATH."/images/delivery.png' title='Доставка' alt='Доставка'  style='width:45px; margin-top:5px; margin-right:10px; float:left;' /></a>";

    if($itemCatalog["QUANTITY"]>0) $delivery.="доставка &ndash; 1 день<br />самовывоз &ndash; 1 день после оплаты";
    elseif($delivery_days) 
    {
      $delivery.="доставка &ndash; ";
      if(in_array($delivery_days, array(1,21,31,41,51,61,71,81,91))) $delivery.=$delivery_days." день ";
      elseif(in_array($delivery_days, array(2,22,32,42,52,62,72,82,92,3,23,33,43,53,63,73,83,93,4,24,34,44,54,64,74,84,94))) $delivery.=$delivery_days." дня ";
      else $delivery.=$delivery_days." дней ";
      $delivery.="после оплаты<br />самовывоз &ndash; 1 день после поступления";
    }
    else $delivery.="доставка &ndash; 1 день после оплаты<br />самовывоз &ndash; 1 день после поступления";
    $delivery.="</p></div>"; 
?>
<!-- Конец Доставка товара -->

<!-- Расчет -->
<? $calc="<div style='margin: 15px 0 0px 0px;'><p>Помощь в расчете:</p><p><a href='/about/contacts/'><img src='".SITE_TEMPLATE_PATH."/images/calc.png' title='Расчет' alt='Расчет'  style='width:20px; margin:0px 10px 0px 0px; float:left;' /></a>телефон: <b>+7(985) 155-17-55</b><br />почта: <b>info@prokwarti.ru</b><p></div>";?>
<!-- Конец Расчет -->

<!-- Скидка -->
<? if($type_item['UF_DISCOUNT5']) $discount5="<div style='margin: 15px 0 0px 0px;'><p><b class='orange' style='font-size: 16px;'>Скидка 5%</b>  предоставляется при заказе через корзину сайта<p></div>"; else $discount5=""; ?>
<!-- Конец Скидка -->

<!-- Шоурум -->
<? if($type_item['UF_SHOWROOM']) $showroom="<div style='margin: 0px 0 0px 0px;'><p><a href='/about/contacts/'><img src='".SITE_TEMPLATE_PATH."/images/eye.png' style='width:30px; margin-top:0px; margin-right:10px; float:left;' /></a>данный товар можно посмотреть<br />в нашем <a href='/about/contacts/'>шоу-руме</a></p></div>"; ?>
<!-- Конец Шоурум -->

<!-- Клей -->
<?  $button_glue="<div class='glue' onclick='javascript: Add2Basket(&quot;/catalog/glue/?action=ADD2BASKET&id=".$glue['ID']."&quot;, &quot;".$glue['ID']."&quot;);'><img src='".$glue_pic."' title='Добавить в корзину клей' alt='Добавить в корзину клей'  style='width:auto; height:38px; margin:4px 8px 4px 8px;' /></div><div style='clear:both;'></div><div style='margin-top:10px;'><a href='http://prokwarti.ru/discount.php'><img src='".SITE_TEMPLATE_PATH."/images/discount.png' title='Получить скидку' alt='Получить скидку' style='width:120px; height:47px; margin-right:10px;' /></a><a href='/catalog/curtains/'><img src='".SITE_TEMPLATE_PATH."/images/curtains.png' title='Пошив штор бесплатно' alt='Пошив штор бесплатно'  style='width:120px; height:47px;' /></a></div>";?>
<!-- Конец Клей -->

<!-- Шторы -->
<!-- Конец Шторы -->

<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card' style='min-width:400px;'><tr><td class='left'><p>Артикул: <b class='big'>".$title."</b></p><p>Цена: ".$price_print_float."</p></td></tr><tr><td>".$text."</td></tr><tr><td>".$discount.$delivery.$calc."</td></tr><tr><td class='left'>".$button_buy.$button_glue."</td></tr><tr><td valign='top' style='height: 30px;'>".$discount5."</td></tr><tr><td valign='bottom' style='height: 40px;'>".$showroom."</td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<? $previewPicture=CFile::GetPath($arElement["PREVIEW_PICTURE"]);?>
<? $detailPicture=CFile::GetPath($arElement["DETAIL_PICTURE"]);?>


<div class="item-image">
	<!--a rel="detail-images" href="<-?if($detailPicture):?-><-?=$detailPicture?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" title="<-?=$title_text?->"><img src="<-?if($previewPicture):?-><-?=$previewPicture?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default150.gif<-?endif?->" style="<-?if($arElement['PREVIEW_PICTURE']['WIDTH']>$arElement['PREVIEW_PICTURE']['HEIGHT']):?->width: 125px;<-?else:?->height: 125px;<-?endif?->" alt="Арт. <-?=$arElement["NAME"]?->" title="Открыть картинку" id="catalog_list_image_<-?=$arElement['ID']?->"/></a-->

	<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arElement['ID']?>"><img src="<?if($detailPicture):?><?=$detailPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" style="<?if($arElement['PREVIEW_PICTURE']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?>width: 125px;<?else:?>height: 125px;<?endif?> margin-left:3px;" alt="Арт. <?=$arElement["NAME"]?>" title="Открыть картинку" id="catalog_list_image_<?=$arElement['ID']?>"/></a>

	<!--div id="inline_<-?=$arElement['ID']?->" style="width:860px; height:465px; display: none; text-align: right;"-->

<script language="JavaScript">document.write('<div id="inline_<?=$arElement['ID']?>" style="width:'+winW+'px; min-height:'+winH+'px; display:'+display+'; text-align: center;">');</script>

		<table style="width:100%;"><tr><td valign="top" style="text-align:center;">

<!--img src="<-?if($detailPicture):?-><-?=$detailPicture?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" alt="" style="max-width:540px; max-height:460px;"/-->

<script language="JavaScript">document.write('<img src="<?if($detailPicture):?><?=$detailPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="max-width:'+winWpic1+'px; max-height:'+winHpic1+'px;" />'); </script>

</td><td valign="top" style="width:400px;"/><?=$title_text?></td></table>
	</div>



</div>
<!-- Конец Картинка -->

<!-- Конец Всплывающая картинка -->

<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

<div class='item-price'><?=$price_print;?></div>

</div>
</div>
<div class="catalog-item-links" style="height: 25px; overflow: hidden;">
<!--noindex-->


<div class="buttons">
   <? if(!inBasket($arElement['ID'])):?>
      <a href="<?=$add_url?>" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a>
   <?else:?>
      <a class="catalog-item-in-the-cart"><?=GetMessage("CATALOG_IN_CART")?></a>
   <?endif?>
</div>
	
			<!--noindex-->

</div>
<p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><?$section["NAME"]?><?=$section["NAME"]?><!--?=$arElement["IBLOCK_SECTION_ID"]?--></nobr></p>
	<div style='position: relative; top: -223px; left: -3px;'><?if($new) echo("<span id='new'>NEW</span>"); elseif($hit) echo("<span id='hit'>HIT</span>");  elseif($sale) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>

	</div>
	<div class="catalog-item-separator"></div>


<?
//}
// КОНЕЦ ОТБОР ПО ДИАПАЗОНУ ЦЕН
}?>
</div>
<? if($numberElements==0) echo("<p style='padding-left: 10px; line-height: 150%; font-size: 16px;'>К сожалению, не удалось найти товар по вашему запросу,<br />попробуйте изменить параметры поиска или воспользуйтесь помощью<br />продавцы-консультанта, позвонив по телефону (985)155-17-55.</p>"); ?>

<div id="page_navigation">
  <!--?$res->NavPrint("Товары ", false, "", "orange");?-->
  <? echo($NAV_STRING); ?>
  <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
  <?endif;?>
</div>



<br /><br />




<?$APPLICATION->SetTitle($window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "обои, каталог обоев, ".$keywords.", ".$keywords." цена, ".$keywords." купить");?>