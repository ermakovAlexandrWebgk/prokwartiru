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
<div style="width: 580px; float: left;">
<?
  $page_title="<h1 id='page_title' style='margin-top: 0px;'><span>".$section["NAME"]."</span>";
  $arSelect=array('UF_FABRIKA','UF_NEWCATALOG', 'UF_HIT','UF_SALE','UF_GLUE','UF_MARK');
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect);
  if($type_item = $type->GetNext()){
	$page_title=$page_title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $page_title=$page_title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
        if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
        if($type_item['UF_HIT']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='hit'>HIT</span>";
        if($type_item['UF_SALE']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='sale'>SALE</span>";
 }
  $page_title=$page_title."</h1>";
?>
<?=$page_title?>
</div>
<!-- Конец Заголовок страницы -->

<!-- Интерьеры -->

<? $interiersNumber=10; if($section['ID']==842) $interiersNumber=1000; ?>
<?if($section){
   if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array("nPageSize"=>$interiersNumber), array());
   if($iblock_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array());
}?>

<?if($Interiers):?>
  <div class="catalog-interier-cards" style="width: 735px;">
    <?while($arInteriers = $Interiers->GetNext()){
		//$arInteriersPathPreview = CFile::GetPath($arInteriers["PREVIEW_PICTURE"]);
		$arInteriersPathPreview = CFile::GetPath($arInteriers["DETAIL_PICTURE"]);
		$arInteriersPathDetail = CFile::GetPath($arInteriers["DETAIL_PICTURE"]);
  ?>
	<div class="catalog-interier-card">
		<div class="item-title" style="text-align: center;"><nobr><?=$arInteriers["NAME"]?></nobr><?=$sticker?></div>
  		<div class="item-image">
			<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arInteriers['ID']?>"><img src="<?if($arInteriersPathDetail):?><?=$arInteriersPathDetail?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default150.gif<?endif?>" alt="<?=$arInteriers['NAME']?>" title="Открыть картинку" id="catalog_list_image_<?=$arInteriers['ID']?>" width="125" height="125" style="width: 125px; height: 125px;" /></a>

		   <div id="inline_<?=$arInteriers['ID']?>" style="width:650px; height:465px; display: none; text-align: center;">
			<table cellspasing="0" cellpadding="0" border="0" style="margin: auto;"><tr><td valign="top" style="width: 600px; text-align:center;"><img src="<?if($arInteriersPathDetail):?><?=$arInteriersPathDetail?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="max-width:560px; max-height:444px;"/></td></tr><tr><td valign="top"><?=$arInteriers['NAME']?></td></table>
		   </div>
		</div>
       </div>
   <? }?>
  </div>
<?endif?>
<!-- Конец Интерьеры -->

<!--?
if (count($arResult['ITEMS']) < 1)	return;
?-->

<!-- Поле белое карточки товара -->
<table style="background-color: white; width: 725px; border: 1px solid #8E8B86;">
<tr><td style="text-align: center; padding: 5px;">
<p style="padding: 5px 10px 20px 10px; text-align: center; font-size: 13px;"><i>Для получения подробной информации о товаре кликните на картинку.</i></p>
<!--div class="catalog-item-cards"-->

<?
foreach ($arResult['ITEMS'] as $key => $arElement):

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
	  <div class="item-title"><span>Арт.</span> <a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></div>
	  <!-- Конец Заголовок -->

	  <div class="item-info__">
	    <!-- Текст описания товара -->
	    <div class="item-desc__">
		<!-- Характеристики товара -->
		<?
		  if (is_array($arElement['DISPLAY_PROPERTIES']) && count($arElement['DISPLAY_PROPERTIES']) > 0){
		    $text="<div class='float-card-properties'>";
		    if($section["NAME"]) $text=$text."<p>Коллекция: <b>".$section["NAME"]."</b>";
		    if($type_item['UF_NEWCATALOG']) $text=$text."&nbsp;<span id='new'>NEW</span><br />"; else $text=$text."<br />";
		    if($fabrika['NAME']) $text=$text."Фабрика: <b>".$fabrika['NAME']."</b> ";
		    if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		    if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."Основные свойства: ".$arElement['PROPERTIES']['PROPERTY']['VALUE']."<br />";
		    if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."Размер: ".$arElement['PROPERTIES']['SIZE']['VALUE']."<br />";
		    $text=$text."</div>";
		  }
		?>
		<!-- Конец Характеристики товара -->

		<!-- Цена Товара -->
		<?
		  foreach($arElement["PRICES"] as $code=>$arPrice){
		    if($arPrice["CAN_ACCESS"]){ 
			$price="";
			if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) $price=$price."<span class='catalog-item-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span> <s>".$arPrice['PRINT_VALUE']."</s>";
			else $price=$price.$arPrice['PRINT_VALUE'];
			$price="<span class='float-card-price'>".$price."</span> / ".$arElement['PROPERTIES']['UNIT']['VALUE'];
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
		    //if($n==1) $button_buy=$button_buy."<div class='buttons' style='margin: 0px;'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		    else $button_buy=$button_buy."<div class='buttons' style='margin: 0px;'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
		    //if($n==0) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		  }
		  elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
		$button_buy=$button_buy.$on."</div>";		
		?>
		<!-- Конец Кнопки Купить -->
		<!-- Кнопка В блокнот -->
		<!--?if($arParams["DISPLAY_COMPARE"]):?->
		  <-?$button_compare="<div class='catalog-item-links'><div class='buttons' style='margin: 0px;'><a href='javascript:;' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);'>В блокнот</a></div></div>";?->
		<-?endif?-->
		<!-- Конец Кнопки В блокнот -->

		<!-- Формирование и форматирование Описания для всплывающей карточки товара -->
		<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td class='left' valign='bottom'><br /><p>".$button_buy."</p><p>".$button_compare."</p><br /></td></tr><tr><td class='left'><p>Артикул: <b class='big'>".$arElement['NAME']."</b></p><p>Цена: ".$price."</p><p>Наличие: <b class='orange'>".$quantity."</b></p></td></tr><tr><td>".$text."</td></tr></table>";?>
		<!-- Конец Форматирования и описания -->

		<!-- Конец Текст описания -->

		<!-- Картинка -->
		<div class="item-image-lepnina">
		  <a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arElement['ID']?>"><img src="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default250x60.gif<?endif?>" alt="Арт. <?=$arElement["NAME"]?>" title="Открыть картинку" id="catalog_list_image_<?=$arElement['ID']?>"/></a>
		  <div id="inline_<?=$arElement['ID']?>" style="width:860px; height:465px; display: none; text-align: center;">
		    <table><tr><td valign="top" style="width: 560px; text-align:right;"><img src="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="max-width:560px; max-height:460px;"/></td><td valign="top" /><?=$title_text?></td></table>
		  </div>
		</div>
		<!-- Конец Картинка -->
		<!-- Конец Всплывающая картинка -->

		<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>
		<!-- Цена товара -->
		<?
		  foreach($arElement["PRICES"] as $code=>$arPrice):
		  if($arPrice["CAN_ACCESS"]):
		?>
		<div class="item-price">
		  <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
		    <span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <s><?=$arPrice["PRINT_VALUE"]?></s>
		  <?else:?>
		    <span class="item-price"><?=$arPrice["PRINT_VALUE"]?></span>
		  <?endif;?>
		</div>
		<?
		  endif;
		  endforeach;
		?>
		<!-- Конец Цена товара -->

	    <!-- Конец Текст описания товара -->
	    </div>
	  </div>

	  <!-- Кнопки -->
	  <div class="catalog-item-links" style="height: 25px; overflow: hidden;">
		<!--noindex-->
		<?if ($arElement['CAN_BUY']||true):?>
		  <div class="buttons"><a href="<?echo $arElement["ADD_URL"]?>" class="catalog-item-buy" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a></div>
		<?elseif (count($arResult["PRICES"]) > 0):?>
		  <span class="catalog-item-not-available"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></span>
		<?endif;?>	
		<!--noindex-->
	  </div>
	  <!-- Конец Кнопки -->

	</div> <!-- catalog-item-card -->
<?endforeach;?> 
<!--/div--> <!-- catalog-item-cards -->
</td></tr>
</table>

<div id="page_navigation">
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