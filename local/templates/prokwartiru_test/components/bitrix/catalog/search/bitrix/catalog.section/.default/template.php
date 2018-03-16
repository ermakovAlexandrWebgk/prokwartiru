<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

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

<?
function readBasket()
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
}
?>
<!-- Конец Товар в корзине -->


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
   winH = document.documentElement.clientHeight*0.7; 
   //winH = winW*0.7;
   winWpic = winW*0.7;
   winHpic = winH-30;
   winWpic1 = winW-300;
   winHpic1 = winH-10;
   display = "none";
</script>



<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->

<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* обои */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/lepnina/") $iblock_ID=20; /* лепнина */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
//$iblock_ID=5;
?>

<!-- Заголовок страницы -->
<div style="width: 580px; float: left;"><h1 id='page_title'><!--span id='sale'>SALE</span-->Распродажа остатков обоев</h1></div>
<!-- Конец Заголовок страницы -->


<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->
<div class="catalog-item-cards">
<?
foreach ($arResult['ITEMS'] as $key => $arElement):
//ambu
	//$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	//$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>






	<div class="catalog-item-card">


<!-- Заголовок -->
  <div class="item-title"><!--span>Арт.</span--><a href="/catalog/oboi/?SECTION_ID=664&ELEMENT_ID=<?=$arElement['ID']?>" title="<?=$arElement['NAME']?>"><b><nobr><?=$arElement["NAME"]?></nobr></b></a><?=$sticker?></div>
<!-- Конец Заголовок -->

  <div class="item-info">
	<div class="item-desc">				
<!-- Картинка со всплывающей карточкой товара -->
<!--?if($bHasPicture):?-->

<!-- Формируем Текст описания товара -->

<!-- Заголовок Название товара -->
	<?$title=$arElement['NAME'];?>
<!-- Конец Заголовок Название товара -->

<!-- Характеристики товара -->
<?
	if (is_array($arElement['DISPLAY_PROPERTIES']) && count($arElement['DISPLAY_PROPERTIES']) > 0){
		$text="<div class='float-card-properties'>";
		//if($section["NAME"]) $text=$text."<p>Коллекция: <b>".$section["NAME"]."</b>";
                //if($type_item['UF_NEWCATALOG']) $text=$text."&nbsp;<span id='new'>NEW</span><br />"; else $text=$text."<br />";
		//if($fabrika['NAME']) $text=$text."Фабрика: <b>".$fabrika['NAME']."</b> ";
		//if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."Основные характеристики: ".$arElement['PROPERTIES']['PROPERTY']['VALUE']."<br />";
		if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."Размер: ".$arElement['PROPERTIES']['SIZE']['VALUE']."<br />";
		if($arElement['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."Раппорт (подбор): ".$arElement['PROPERTIES']['RAPPORT']['VALUE']."</p>";	
		//if($arElement["DETAIL_PAGE_URL"]) $text=$text."<p><a href='".$arElement["DETAIL_PAGE_URL"]."'>Подробнее</a></p>";	
		$text=$text."</div>";
	}
?>
<!-- Конец Характеристики товара -->

<!-- Цена Товара -->
<?
	foreach($arElement["PRICES"] as $code=>$arPrice){
		if($arPrice["CAN_ACCESS"]){ 
			$price="";
			$discount = "";

//			if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
//			  $price=$price."<s>".$arPrice['PRINT_VALUE']."</s> <span class='float-card-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span>";
//
//			$arDiscounts = CCatalogDiscount::GetDiscountByPrice(
//			  $arPrice["ID"],
//			  $USER->GetUserGroupArray(),
//			  "N",
//			  SITE_ID
//		        );
//			$discount = "<p><b class='orange' style='font-size: 20px;'>".$arDiscounts[0]["NOTES"]."</b></p>";
//			}
//			else $price=$price."<span class='float-card-price'>".$arPrice['PRINT_VALUE']."</span>";
//			//$price=$price."</div>";
if($arElement["PRICES"]["BASE"]["VALUE"]) $price="<s>".$arElement["PRICES"]["BASE"]["VALUE"]." руб</s> ";
if($arElement["PRICES"]["SALE"]["VALUE"]) $price=$price."<span class='float-card-price'>".$arElement["PRICES"]["SALE"]["VALUE"]." руб</span>";
			$price=$price." / ".$arElement['PROPERTIES']['UNIT']['VALUE']."</div>";

		}
	}

?>


<!-- Конец Цена Товара -->

<!-- Количество Товара -->

<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="Складская программа"; else $quantity="Под заказ";?>

<!-- Конец Количество Товара -->

<!-- Кнопка Купить -->
<?
	$button_buy="<div class='catalog-item-links'>";
	if ($arElement['CAN_BUY']) {
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons'  style='margin: 0px;'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	//	if($n==1) $button_buy=$button_buy."<div class='buttons' style='margin: 0px;'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons_' style='margin: 0px;'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
		//if($n==0) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	}
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy.$on."</div>";
	//$arPageItems[] = $arElement["ID"];
?>


<!-- Конец Кнопки Купить -->


<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td class='left' valign='bottom'>".$button_buy."</td></tr><tr><td class='left'><p><b class='big'>".$title."</b></p><p>".$arElement['PREVIEW_TEXT']."</p><p>Цена: ".$price."</p></td></tr><tr><td>".$text."</td></tr><tr><td>".$discount."<p style='margin: 10px 0 0 -30px;'>".$delivery."</p></td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<div class="item-image" style="padding: 0 6px;">
	<!--a rel="detail-images" href="<-?if($arElement['DETAIL_PICTURE']['SRC']):?-><-?=$arElement['DETAIL_PICTURE']['SRC']?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" title="<-?=$title_text?->"><img src="<-?if($arElement['PREVIEW_IMG']['SRC']):?-><-?=$arElement['PREVIEW_IMG']['SRC']?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default150.gif><-?endif?->" style="<-?if($arElement['PREVIEW_IMG']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?->width: 125px;<-?else:?->height: 125px;<-?endif?->" alt="Арт. <-?=$arElement["NAME"]?->" title="Открыть картинку" id="catalog_list_image_<-?=$arElement['ID']?->"/></a-->

	<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arElement['ID']?>"><img src="<?if($arElement['PREVIEW_IMG']['SRC']):?><?=$arElement['PREVIEW_IMG']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default125.gif<?endif?>" style="<?if($arElement['PREVIEW_IMG']['WIDTH']>$arElement['PREVIEW_IMG']['HEIGHT']):?>width: 125px;<?else:?>height: 125px;<?endif?>" alt="Арт. <?=$arElement["NAME"]?>" title="Открыть картинку " id="catalog_list_image_<?=$arElement['ID']?>"/></a>



<script language="JavaScript">document.write('<div id="inline_<?=$arElement['ID']?>" style="width:'+winW+'px; height:'+winH+'px; display:'+display+'; text-align: center;">');</script>


		<table style="margin: auto;"><tr><td valign="top" style="text-align:right;">



<script language="JavaScript">document.write('<img src="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="max-width:'+winWpic1+'px; max-height:'+winHpic1+'px;" />'); </script>

</td><td valign="top" /><?=$title_text?></td></table>
	</div>

</div>
<!-- Конец Картинка -->
<!--?endif;?-->

<!-- Конец Всплывающая картинка -->

			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				if($arPrice["CAN_ACCESS"]):
?>
<?if($code=="SALE"):?>
				<div class="item-price">
<?if($arElement["PRICES"]["BASE"]["VALUE"]):?><s><?=$arElement["PRICES"]["BASE"]["VALUE"]?> руб</s> <?endif?>
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
<!-- ambu -->
					<!--span class="catalog-item-price"><-?=$arPrice["PRINT_VALUE"]?-></span--> 
					<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
				<?else:?>
					<span class="item-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif;?>
				</div>
<?endif?>
			<?
				endif;
			endforeach;
			?>
			</div>
		</div>
<div class="catalog-item-links" style="height: 25px; overflow: hidden;">
			<!--noindex-->
		<!--?if($arParams["DISPLAY_COMPARE"]):?->
			<div class="buttons"><a href="<-?echo $arElement["COMPARE_URL"]?->" class="catalog-item-compare" onclick="return addToCompare(this, '<-?=GetMessage("CATALOG_IN_COMPARE")?->');" rel="nofollow" id="catalog_add2compare_link_<-?=$arElement['ID']?->"><-?echo GetMessage("CATALOG_COMPARE")?-></a></div>
		<-?endif;?-->
		<?if ($arElement['CAN_BUY']):?>
			<!--div class="buttons"><a href="<-?echo $arElement["ADD_URL"]?->" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<-?=$arElement['ID']?->', 'list', '<-?=GetMessage("CATALOG_IN_CART")?->');" id="catalog_add2cart_link_<-?=$arElement['ID']?->"><-?echo GetMessage("CATALOG_ADD")?-></a></div-->
			<div class="buttons"><a href="<?echo $arElement["ADD_URL"]?>" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a></div>
			<!--div class="buttons"><a href="javascript:;" class="catalog-item-buy" rel="nofollow"  onclick="javascript: Add2Basket('<-?=$arElement["ADD_URL"]?->'); addToCart(this, 'catalog_list_image_<-?=$arElement['ID']?->', 'list', '<-?=GetMessage("CATALOG_IN_CART")?->');" id="catalog_add2cart_link_<-?=$arElement['ID']?->"><-?echo GetMessage("CATALOG_ADD")?-></a></div-->
		<?elseif (count($arResult["PRICES"]) > 0):?>
			<span class="catalog-item-not-available"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></span>
		<?endif;?>	
			<!--noindex-->

</div>
<p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><?=$arElement['PREVIEW_TEXT']?></nobr></p>
<!--p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><-?=$section["NAME"]?-></nobr></p-->

	</div>

	<div class="catalog-item-separator"></div>
<?endforeach;?>
</div>

<div id="page_navigation">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>
<?if($section["DESCRIPTION"]):?>
  <div id="catalog-item-text"> 
    <h2 style="padding: 10px 0 7px 0;"><?=$section["NAME"]?></h2>
    <?=$section["DESCRIPTION"]?>
  </div>
<?endif?>

<?$APPLICATION->SetTitle("Распродажа обоев в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title."обоев в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог обоев, ".$keywords.", ".$keywords." цена, ".$keywords." купить");?>