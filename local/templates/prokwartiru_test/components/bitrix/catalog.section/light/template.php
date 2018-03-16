<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $filter_price=$_REQUEST["PRICE_ID"];?>
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
		$("#catalog_add2cart1_link_"+element).html("<?=GetMessage("CATALOG_IN_CART")?>").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
		$("#catalog_add2cart_link_"+element).html("<?=GetMessage("CATALOG_IN_CART")?>").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
	}); 	});
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

			$(".buy_window").fancybox({
				//closeClick : true,
				//hideOnContentClick : 'false',
				//closeBtn  : false,
    				helpers : {
        			     overlay : {
            				css : {
                			     'background' : 'rgba(58, 42, 45, 0)'
            				}
        			     },
            			     css : {
                			     'background' : 'rgba(58, 42, 45, 0)'
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
			background: red;
		}
	</style>

<script language="JavaScript">
   winW = document.documentElement.clientWidth*0.8;  
   winH = document.documentElement.clientHeight*0.7; 
   //winH = winW*0.7;
   winWpic = winW*0.7;
   winHpic = winH-30;
   winWpic1 = winW-300;
   winHpic1 = winH-10;
   display = "none";
</script>


<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?if($_REQUEST['SECTION_ID']) $section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
if($arSite=="/catalog/lights/") $iblock_ID=17; /* свет */
?>

<? $rubric=$_REQUEST["RUBRIC_ID"];?>

<!-- Заголовок страницы -->
<?
  if($rubric) {
    $itemRubric = CIBlockElement::GetByID($rubric); 
    if($ar_itemRubric = $itemRubric->GetNext()){
      $page_title="<h1 id='page_title' style='padding-left: 10px;'><span>".$ar_itemRubric['NAME']."</span>";
    }   
  $page_title=$page_title."</h1>"; 
  $window_title=$ar_itemRubric['NAME'];
  $keywords=$ar_itemRubric['NAME'];
  }
?>
<?=$page_title?>
<!-- Конец Заголовок страницы -->

<div class="catalog-item-cards" style="width: 588px; padding-left: 10px;">
<div id="buy_help" style="display: none;"><div style="border:1px solid #dddddd; background-color: #eeeeee; padding:10px;"><h3 style="padding-top:20px; text-align: center;"><span class="orange">Товар в корзине.</span> Вы хотите<br /><a onclick="$.fancybox.close();" style="cursor: pointer;"><b>продолжить выбор</b></a> или <a href="/personal/cart/"><b>оформить покупку</b></a>?</h3></div></div>
<div id="buy_help1" style="display: none;"><div style="border:1px solid #dddddd; background-color: #eeeeee; padding:10px;"><h3 style="padding-top:20px; text-align: center;"><span class="orange">Товар в корзине.</span> Вы хотите<br /><a class="fancybox" data-fancybox-group="gallery" href="javascript:history.back();"><b>продолжить выбор</b></a> или <a href="/personal/cart/"><b>оформить покупку</b></a>?</h3></div></div>

<?if($rubric):?>
<?
$arSort = Array("name"=>"ASC");
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_*");

// ФИЛЬТР
$arFilterMain=Array('ACTIVE' => 'Y', "IBLOCK_ID"=>17, "PROPERTY_RUBRIC"=>$rubric);
//global $arFilterDop;

switch ($filter_price) {
case 1:
    $price_min=0; $price_max=3000;
    break;
case 2:
    $price_min=3000; $price_max=5000;
    break;
case 3:
    $price_min=5000; $price_max=10000;
    break;
case 4:
    $price_min=10000; $price_max=15000;
    break;
case 5:
    $price_min=15000; $price_max=1000000;
    break;
default:
    $price_min=0; $price_max=1000000;
    break;
}

$arFilterPrice=Array(">=CATALOG_PRICE_1"=>$price_min, "<=CATALOG_PRICE_1"=>$price_max);

$arFilter = array_merge($arFilterMain, $arFilterPrice);

// Конец ФИЛЬТР
?>
<!-- Конец Фильтр -->

<?$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>40), $arSelect);?>

<?$NAV_STRING = $res->GetPageNavStringEx($navComponentObject,  "Товары", "orange");?>
<? $numberElements=0; ?>
<? while($arElement = $res->GetNext())
{ 
//<!-- ЦЕНА -->
   $price = CPrice::GetBasePrice($arElement['ID']);
   $price_print=CurrencyFormat($price['PRICE'], $price['CURRENCY']);
//<!-- Конец ЦЕНА -->

// ОТБОР ПО ДИАПАЗОНУ ЦЕН
//if (($price['PRICE']>$price_min)&&($price['PRICE']<=$price_max))
//{
   $numberElements++;
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

<!-- Характеристики товара -->
<? $section=GetIBlockSection($arElement["IBLOCK_SECTION_ID"], 'catalog');
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEW','UF_GLUE'));
  if($type_item = $type->GetNext()){
	$fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog');
	$country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog'); 
        //if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
 }
?>
<?
if(CModule::IncludeModule('iblock') && ($element = CIBlockElement::GetByID($arElement["ID"]))) 
{
	if($ar_element = $element->GetNext())
		{
		  $property = CIBlockElement::GetProperty($ar_element['IBLOCK_ID'], $ar_element['ID'], "sort", "asc", Array());
		$text="";
		if($section['NAME']) $text=$text."<p>Коллекция: <b>".$section['NAME']."</b><br />";
		if($fabrika['NAME']) $text=$text."Фабрика: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		while ($ar_property=$property->GetNext())	
			if($ar_property['CODE']=='POWER' || $ar_property['CODE']=='PROPERTY' || $ar_property['CODE']=='SIZE') $text=$text."<p>".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
			elseif($ar_property['CODE']=='NEW') $new=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='HIT') $hit=$ar_property['VALUE'];
			elseif($ar_property['CODE']=='SALE') $sale=$ar_property['VALUE'];
			//$text=$text."<p>".$ar_property['CODE']." ".$ar_property['NAME'].": ".$ar_property['VALUE']."</p>";
		}
}
?>
<!-- Конец характеристики -->


<!-- Количество Товара -->
<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="Складская программа"; else $quantity="Под заказ";?>

<!-- Конец Количество Товара -->

<!-- Кнопка Купить -->
<?
	$button_buy="<div class='catalog-item-links' style='height:30px;'>";
	if ($arElement['CAN_BUY']) {
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons_'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons_'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
	}
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy.$on."</div>";
	//$arPageItems[] = $arElement["ID"];
?>

<!-- Конец Кнопки Купить -->
<!-- Цена -->
<!-- ЦЕНА -->
<!--? $price = CPrice::GetBasePrice($arElement['ID']);?-->
<!--? $price_print=CurrencyFormat($price['PRICE'], $price['CURRENCY']);?-->
<!-- Конец ЦЕНА -->

<!-- Кнопка Купить -->
<? $add_url="index.php?action=ADD2BASKET&id=".$arElement['ID']."&SECTION_ID=".$arElement['IBLOCK_SECTION_ID'];?>

<?$button_buy="<div class='catalog-item-links'>";
	if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons_'><div class='buy_window' href='#buy_help1'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;); this.innerText=\"Уже в корзине\";' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div></div>";	
	else $button_buy=$button_buy."<div class='buttons_'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$add_url."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
?>
<!--script language="JavaScript">document.write('<div id="buy_help<?=$arElement['ID']?>" style="display: none;"><div style="border:1px solid #dddddd; background-color: #eeeeee; padding:10px;"><h3 style="padding-top:20px; text-align: center;"><span class="orange">Товар в корзине.</span> Вы хотите<br /> <a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arElement['ID']?>"><b>продолжить выбор</b></a> или <a href="/personal/cart/"><b>оформить покупку</b></a>?</h3></div></div>');</script-->
<!-- Конец Кнопки Купить -->

<!-- Кнопка В блокнот -->
<? $compare_url="index.php?action=ADD_TO_COMPARE_LIST&SECTION_ID=".$arElement['IBLOCK_SECTION_ID']."&id=".$arElement['ID'];?>

<?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$compare_url."&quot;);'>В блокнот</a></div></div>";?>
<!-- Конец Кнопки В блокнот -->

<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td class='left' valign='bottom'>".$button_buy."</td></tr><tr><td class='left'><p><b class='big'>".$title_type."</b></p><p>Артикул: <b class='big'>".$title."</b></p><p>Цена: <span class='float-card-price'>".$price_print."</span> / шт.</p><p>Наличие: <b class='orange'>".$quantity."</b></p></td></tr><tr><td>".$text."</td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<? $previewPicture=CFile::GetPath($arElement["PREVIEW_PICTURE"]);?>
<? $detailPicture=CFile::GetPath($arElement["DETAIL_PICTURE"]);?>


<div class="item-image">
	<!--a rel="detail-images" href="<-?if($detailPicture):?-><-?=$detailPicture?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" title="<-?=$title_text?->"><img src="<-?if($previewPicture):?-><-?=$previewPicture?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default150.gif<-?endif?->" style="<-?if($arElement['PREVIEW_PICTURE']['WIDTH']>$arElement['PREVIEW_PICTURE']['HEIGHT']):?->width: 125px;<-?else:?->height: 125px;<-?endif?->" alt="Арт. <-?=$arElement["NAME"]?->" title="Открыть картинку" id="catalog_list_image_<-?=$arElement['ID']?->"/></a-->

	<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arElement['ID']?>"><img src="<?if($detailPicture):?><?=$detailPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif><?endif?>" style="<?if($arElement['PREVIEW_PICTURE']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?>width: 125px;<?else:?>height: 125px;<?endif?>" alt="Арт. <?=$arElement["NAME"]?>" title="Открыть картинку" id="catalog_list_image_<?=$arElement['ID']?>"/></a>

	<!--div id="inline_<-?=$arElement['ID']?->" style="width:860px; height:465px; display: none; text-align: right;"-->

<script language="JavaScript">document.write('<div id="inline_<?=$arElement['ID']?>" style="width:'+winW+'px; height:'+winH+'px; display:'+display+'; text-align: center;">');</script>

		<table><tr><td valign="top" style="width: 540px; text-align:center;">

<!--img src="<-?if($detailPicture):?-><-?=$detailPicture?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" alt="" style="max-width:540px; max-height:460px;"/-->

<script language="JavaScript">document.write('<img src="<?if($detailPicture):?><?=$detailPicture?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="max-width:'+winWpic1+'px; max-height:'+winHpic1+'px;" />'); </script>

</td><td valign="top" style="width:300px;"/><?=$title_text?></td></table>
	</div>



</div>
<!-- Конец Картинка -->

<!-- Конец Всплывающая картинка -->

<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

<div class='item-price'><span class='item-price'><?=$price_print;?></span></div>

</div>
</div>
<div class="catalog-item-links" style="height: 25px; overflow: hidden;">
<!--noindex-->

<!-- ambu -->
<div class="buttons">
   <? if(!inBasket($arElement['ID'])):?>
     <div class="buy_window" href="#buy_help"><a href="<?=$add_url?>" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a></div>
   <?else:?>
      <a class="catalog-item-in-the-cart"><?=GetMessage("CATALOG_IN_CART")?></a>
   <?endif?>
</div>
	
			<!--noindex-->

</div>
<!--p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><-?$section["NAME"]?-><-?=$section["NAME"]?--><!--?=$arElement["IBLOCK_SECTION_ID"]?--><!--/nobr> +</p-->
<p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><?=$section["NAME"]?></nobr></p>
	<div style='position: relative; top: -223px; left: -3px;'><?if($new) echo("<span id='new'>NEW</span>"); elseif($hit) echo("<span id='hit'>HIT</span>");  elseif($sale) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>

	</div>
	<div class="catalog-item-separator"></div>


<?
//}
// КОНЕЦ ОТБОР ПО ДИАПАЗОНУ ЦЕН

}
endif?>

</div>

<? if($numberElements==0) echo("<p style='padding-left: 10px; line-height: 150%; font-size: 16px;'>Для уточнения информации по данной позиции позвоните менеджеру<br />по телефонам: 8 (985) 155 1755 или 8 (985) 118 1755.</p>"); ?>

<div id="page_navigation">
  <!--?$res->NavPrint("Товары ", false, "", "orange");?-->
  <? echo($NAV_STRING); ?>
  <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
  <?endif;?>
</div>
<?if($section["DESCRIPTION"]):?>
  <div id="catalog-item-text"> 
    <h2><?=$section["NAME"]?></h2>
    <?=$section["DESCRIPTION"]?>
  </div>
<?endif?>
<?$APPLICATION->SetTitle($window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог светильников, каталог люстр, каталог ламп, ".$keywords.", ".$keywords." цена, ".$keywords." купить");?>