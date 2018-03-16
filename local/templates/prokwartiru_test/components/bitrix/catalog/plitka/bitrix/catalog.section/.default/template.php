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
   //winH = winW*0.7;
   winWpic = winW*0.7;
   winHpic = winH-30;
   winWpic1 = winW;
   winHpic1 = winH-10;
   winWpic2 = winW-300;
   winHpic2 = winH-10;
   winWpic3 = winW-30;
   winHpic3 = winH-215;
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
if($arSite=="/catalog/test/") $iblock_ID=4; /* плитка */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* мозаика */
if($arSite=="/catalog/lepnina/") $iblock_ID=20; /* лепнина */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* шторы */
//$iblock_ID=5;
?>
<!-- Заголовок страницы -->
<?
  $page_title="<h1 id='page_title' style='margin-top: -10px; width: 500px; overflow: hidden; float: left;'>";
  $arSelect=array('UF_FABRIKA','UF_NEWCATALOG', 'UF_COLS', 'UF_HIT', 'UF_DISCOUNT10', 'UF_DISCOUNT5', 'UF_SALE', 'UF_SALE_PLITKA', 'UF_ACTION', 'UF_SHOWROOM');
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect);

  if($type_item = $type->GetNext()){

    $saleID="";
    $saleID=$type_item['UF_SALE_PLITKA'];
    //echo($saleID);
    if($saleID){
      $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_PLITKA"));
      if($ar_res = $res->GetNext())
        $sale=$ar_res["VALUE"];
      //if($countryName=="Не указана") $countryName="";
    }


        if($type_item['UF_SALE_PLITKA'][0]) $page_title=$page_title."<span id='sale'>SALE ".$sale."</span>&nbsp;";
        elseif($type_item['UF_ACTION']) $page_title=$page_title."<span id='sale'style='background-color:#ffce0c;'>ЛУЧШАЯ ЦЕНА</span>&nbsp;";
        elseif($type_item['UF_DISCOUNT10']) $page_title=$page_title."<span id='sale'>Скидка 10%</span>&nbsp;";
        elseif($type_item['UF_DISCOUNT5']) $page_title=$page_title."<span id='sale'>-5%</span>&nbsp;";
        elseif($type_item['UF_SALE']) $page_title=$page_title."<span id='sale'>SALE</span>&nbsp;";

        if($type_item['UF_NEWCATALOG']) $page_title=$page_title."<span id='new'>NEW</span>&nbsp;";
        if($type_item['UF_HIT']) $page_title=$page_title."<span id='hit'>HIT</span>&nbsp;";

	$page_title=$page_title."<span>".$section["NAME"]."</span> / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $page_title=$page_title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."&SECTION_ID=1'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
     // if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
      $cardCols=4;
      if($type_item['UF_COLS']==2) $cardCols=2;

  }
  $page_title=$page_title."</h1>";
  $window_title=$section["NAME"]." (".$fabrika['NAME'].")";
?>
<?=$page_title?>
<!-- Конец Заголовок страницы -->

<!-- Подарок -->
  <div id="glue" style="height: 63px; width: 175px; margin-top: -20px;"> 
    <div><a href="3d-project.php"><img src="<?=SITE_TEMPLATE_PATH?>/images/gift.png"></a></div><p style="padding-top: 10px;"><a href="3d-project.php">Дизайн-проект 3D<br />&ndash; <b style="font-size:14px;">в ПОДАРОК!</b></a></p>
  </div>
<!-- Конец Подарок -->
<!-- Разные шаблоны карточек -->
<!-- 2 карточки в ряд -->
<? if($cardCols==2) $cardWidth=342; else $cardWidth=165; ?>
<!--? if($cardCols==2) $cardWidth=342; else $cardWidth=165; ?-->
<!-- Конец Разные шаблоны карточек -->

<!-- Интерьеры -->
<? $interiersNumber=5; ?>
<?if($section&&false){
   if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array("nPageSize"=>$interiersNumber), array());
   if($iblock_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array("nPageSize"=>$interiersNumber), array());
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

			<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arInteriers['ID']?>"><img src="<?=$arInteriersPathDetail?>" alt="<?=$arInteriers['NAME']?>" title="Открыть картинку" id="catalog_list_image_<?=$arInteriers['ID']?>" width="125" height="125" style="width: 125px; height: 125px;" /></a>

	<!--div id="inline_<-?=$arInteriers['ID']?->" style="width:650px; height:465px; display: none; text-align: center;"-->

<script language="JavaScript">document.write('<div id="inline_<?=$arInteriers['ID']?>" style="width:'+winW+'px; height:'+winH+'px; display:'+display+'; text-align:center;">');</script>

		<table cellspasing="0" cellpadding="0" border="0" style="margin: auto;"><tr><td valign="top" style="text-align:center;">

<!--img src="<-?if($arInteriersPathDetail):?-><-?=$arInteriersPathDetail?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" alt="" style="max-width:560px; max-height:444px;"/-->

<script language="JavaScript">document.write('<img src="<?if($arInteriersPathDetail):?><?=$arInteriersPathDetail?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="max-width:'+winWpic+'px; max-height:'+winHpic+'px;" />');</script>

</td></tr><tr><td valign="top"><?=$arInteriers['NAME']?></td></table>
	</div>

		</div>
	  </div>
    <? }?>
  </div>
<?endif?>
<!-- Конец Интерьеры -->
<!-- КАТАЛОГ НЕ ЗАПОЛНЕН -->
<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->

<table style="background-color: white; width: 725px; border: 1px solid #8E8B86; padding: 5px 0 10px 10px;">
<tr><td style="text-align: center;">
<p style="padding-bottom: 10px; text-align: center; font-size: 13px;"><i>Для получения подробной информации о товаре кликните на картинку.</i></p>

<!--div class="catalog-item-cards"-->
<?$row=0; $col=0;?>
<?
foreach ($arResult['ITEMS'] as $key => $arElement):

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
<?if($col==$cardCols) { $row++; $col=1; echo("<div style='clear:both; margin:0; padding: 5px 10px 5px 0;'><hr></div>"); } else $col++;?>
	<!--div class="_catalog-item<-?if (!$bHasPicture):?-> no-picture-mode<-?endif;?->" id="<-?=$this->GetEditAreaId($arElement['ID']);?->"-->

    <div class="catalog-item-card" style="width:<?=$cardWidth;?>px; height: auto; border: none; margin: 10px 10px 0 0;">

<!-- Заголовок -->
      <div class="item-title" style="text-align: center; height: 30px; width: <?=$cardWidth;?>px; margin:0;"><a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></div>
<!-- Конец Заголовок -->

  <div class="item-info">
	<div class="item-desc">				
<!-- Картинка со всплывающей карточкой товара -->
<!--?if($bHasPicture):?-->

<!-- Формируем Текст описания товара -->

<!-- Заголовок Вид товара -->
<!--? 
       if($arTitleType_child=GetIBlockSection($arElement['IBLOCK_SECTION_ID'], 'catalog')) {
          $title_type_parent=$arTitleType_child['IBLOCK_SECTION_ID'];
          if($arTitleType_parent=GetIBlockSection($title_type_parent, 'catalog'))$title_type=$arTitleType_parent['NAME'];
       }
       if($iblock_ID==4) $title_type=$title_type." плитка";

?-->
<!-- Конец Заголовок Вид товара -->

<!-- Заголовок Название товара -->
	<?$title=$arElement['NAME'];?>
<!-- Конец Заголовок Название товара -->

<!-- Количество Товара -->
<?$quantity="<nobr>Наличие: <b>";?>
<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity=$quantity."складская программа"; else $quantity=$quantity."под заказ";?>
<?$quantity=$quantity."</b></nobr>";?>
<!-- Конец Количество Товара -->

<!-- Характеристики товара -->
<?
	if (is_array($arElement['DISPLAY_PROPERTIES']) && count($arElement['DISPLAY_PROPERTIES']) > 0){
		$text="<div class='float-card-properties'>";
		if($section["NAME"]) $text=$text."<p>Коллекция: <a href='/catalog/plitka/index.php?SECTION_ID=".$section["ID"]."'><b>".$section["NAME"]."</b></a>";
                if($type_item['UF_NEWCATALOG']) $text=$text."&nbsp;<span id='new'>NEW</span><br />"; else $text=$text."<br />";
		//if($arElement['PROPERTIES']['ARTICUL']['VALUE']) $text=$text."Артикул: <b>".$arElement['PROPERTIES']['ARTICUL']['VALUE']."</b><br />";
		if($fabrika['NAME']) $text=$text."Фабрика: <a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item["UF_FABRIKA"]."&SECTION_ID=1'><b>".$fabrika['NAME']."</b></a> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."Основные характеристики: <br /><b>".$arElement['PROPERTIES']['PROPERTY']['VALUE']."</b><br /><a href='/catalog/plitka/?SECTION_ID=".$section["ID"]."&ELEMENT_ID=".$arElement["ID"]."' class='orange'>(подробнее)</a><br />";
		if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."Размер: <b>".$arElement['PROPERTIES']['SIZE']['VALUE']."</b><br />";
		if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']||$arElement['PROPERTIES']['UPAK_PCS']['VALUE']||$arElement['PROPERTIES']['UPAK_KG']['VALUE']) $text=$text."Упаковка: <b>";
		if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']) $text=$text.$arElement['PROPERTIES']['UPAK_KBM']['VALUE']." кв.м";
		if($arElement['PROPERTIES']['UPAK_PCS']['VALUE']) { if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']) $text=$text." / "; $text=$text.$arElement['PROPERTIES']['UPAK_PCS']['VALUE']." шт."; }
		if($arElement['PROPERTIES']['UPAK_KG']['VALUE']) { if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']||$arElement['PROPERTIES']['UPAK_PCS']['VALUE']) $text=$text." / "; $text=$text.$arElement['PROPERTIES']['UPAK_KG']['VALUE']." кг"; }
		if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']||$arElement['PROPERTIES']['UPAK_PCS']['VALUE']||$arElement['PROPERTIES']['UPAK_KG']['VALUE']) $text=$text."</b><br />";
		$text=$text.$quantity."</p>";

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
			if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
			  $price=$price."<s>".$arPrice['PRINT_VALUE']."</s> <span class='float-card-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span>";

			  $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
			    $arPrice["ID"],
			    $USER->GetUserGroupArray(),
			    "N",
			    SITE_ID
		          );
			  $discount = "<p style='margin-top:10px; margin-bottom:10px;'><b class='orange' style='font-size: 20px;'>".$arDiscounts[0]["NOTES"]."</b></p>";
			}
			else $price=$price."<span class='float-card-price'>".$arPrice['PRINT_VALUE']."</span>";	
			if($arElement['PROPERTIES']['UNIT']['VALUE']) $price=$price." / ".$arElement['PROPERTIES']['UNIT']['VALUE'];
			else $price="<span class='float-card-price'>".$price."</span> / кв.м";

		}
	}
?>
<!-- Конец Цена Товара -->

<!-- Кнопка Купить -->
<!--?
	$button_buy="<div class='catalog-item-links' style='height:30px;'>";
	if ($arElement['CAN_BUY']) $button_buy=$button_buy."<div class='buttons'><a href='".$arElement['ADD_URL']."' class='catalog-item-buy' rel='nofollow'  onclick='return addToCart(this, 'catalog_list_image_".$arElement['ID']."', 'list', 'Товар<br />в корзине');' id='catalog_add2cart_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy."</div>";
?-->
<?
	$button_buy="<div class='catalog-item-links_'><div class='catalog-item-links_new'>";
	if ($arElement['CAN_BUY']) {
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons' onclick_='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'><a href='javascript:;' class='catalog-item-buy' rel='nofollow' onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>Добавить<br />в корзину</a></div>";	
	//	if($n==1) $button_buy=$button_buy."<div class='buttons' style='margin: 0px;'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons' ><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>Товар<br />в корзине</a></div>";	
		//if($n==0) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	}
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy.$on."</div></div>";
	//$arPageItems[] = $arElement["ID"];
?>


<!-- Конец Кнопки Купить -->


<!-- Кнопка Получить скидку -->
	<?$button_discount="<a href='/discount.php'><img src='".SITE_TEMPLATE_PATH."/images/discount.png' title='Получить скидку' alt='Получить скидку' style='width:120px; height:47px; margin-right:10px;' /></a>";?>
<!-- Конец Кнопка Получить скидку -->


<!-- Кнопка 3d-проект в подарок -->
	<?$button_3d="<a href='/catalog/plitka/3d-project.php'><img src='".SITE_TEMPLATE_PATH."/images/3d.png' title='3d-проект в подарок' alt='3d-проект в подарок' style='width:120px; height:47px; margin-top:10px; margin-right:10px;' /></a>";?>
<!-- Конец 3d-проект в подарок -->

<!-- Кнопка Ламинат -->
	<?$button_laminat="<a href='/catalog/plitka/laminat10.php'><img src='".SITE_TEMPLATE_PATH."/images/laminat.png' title='Каждая 10-я пачка ламината бесплатно' alt='Каждая 10-я пачка ламината бесплатно' style='width:120px; height:47px; margin-top:10px;' /></a>";?>
<!-- Конец Ламинат -->

<!-- Кнопка В блокнот -->
<!--?
	if($arParams["DISPLAY_COMPARE"]) $button_compare="<div class='catalog-item-links'><div class='buttons'><a href='".$arElement['COMPARE_URL']."' class='catalog-item-compare' onclick='addToCompare(this, 'В блокноте');' rel='nofollow' id='catalog_add2compare_link_".$arElement['ID']."'>".GetMessage('CATALOG_COMPARE')."</a></div></div>";
?-->
<!--?echo $arElement["COMPARE_URL"]?-->
<!--?
$path=$arElement["ID"];
	if($arParams["DISPLAY_COMPARE"]) $button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' class='catalog-item-compare' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);' rel='nofollow' id='catalog_add2compare_link_".$arElement['ID']."'>".$path."-".GetMessage('CATALOG_COMPARE')."</a></div></div>";
?-->

<!--?if($arParams["DISPLAY_COMPARE"]):?->
<-?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);'>В блокнот</a></div></div>";?->
<-?endif?-->
<!-- Конец Кнопки В блокнот -->


<!-- Доставка товара -->
<? 
    $delivery="<div style='margin: 0px 0 0px 0px;'><p>Срок поставки:</p><p><a href='/about/delivery/'><img src='".SITE_TEMPLATE_PATH."/images/delivery.png' title='Доставка' alt='Доставка'  style='width:45px; margin-top:5px; margin-right:10px; float:left;' /></a> доставка &ndash; <b>1 день</b></p></div>";
?>
<!-- Конец Доставка товара -->

<!-- Расчет -->
<? $calc="<div style='margin: 17px 0 0px 0px;'><p>Помощь в расчете:</p><p><a href='/about/contacts/'><img src='".SITE_TEMPLATE_PATH."/images/calc.png' title='Расчет' alt='Расчет'  style='width:20px; margin:0px 10px 0px 0px; float:left;' /></a>телефон: <b>+7(985) 155-17-55</b><br />почта: <b>info@prokwarti.ru</b><p></div>";?>
<!-- Конец Расчет -->

<!-- Посмотреть в интерьере -->
<? $look="<div style='margin: 20px 0 0px 0px;'><p><img src='".SITE_TEMPLATE_PATH."/images/look.png' style='width:28px; height:23px; margin-top:-5px; margin-right:10px; float:left;' /> <a href='/catalog/plitka/interiers.php?SECTION_ID=".$section["ID"]."' style='text-decoration:none;'><b>посмотреть в интерьере</b></a></p></div><div style='clear:both;'></div>"; ?>
<!-- Конец Посмотреть в интерьере -->

<!-- Шоурум -->
<? if($type_item['UF_SHOWROOM']) $showroom="<div style='margin: 7px 0 0px 0px;'><p><a href='/about/contacts/'><img src='".SITE_TEMPLATE_PATH."/images/eye.png' style='width:30px; margin-top:0px; margin-right:10px; float:left;' /></a>данный товар можно посмотреть<br />в нашем <a href='/about/contacts/'>шоу-руме</a></p></div>"; ?>
<!-- Конец Шоурум -->

<!-- Формирование и форматирование Описания для всплывающей карточки товара -->
<?       
          if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']) $title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td valign='top' style='min-width: 300px;'><p>Название: <b class='big'>".$title."</b></p><p style='padding-top: 4px;'>Цена: ".$price."</p>".$text."<div style='margin-top:20px;'>".$delivery."</div>".$calc.$look.$showroom."</td></tr><tr><td valign='top'>".$discount."</td></tr><tr><td class='left'>".$button_buy.$button_discount.$button_3d.$button_laminat."</td></tr></table>"; 
          else $title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td valign='top' style='min-width: 300px;'><p>Название: <b class='big'>".$title."</b></p><p style='padding-top: 4px; padding-bottom:10px;'>Цена: ".$price."</p>".$text.$look.$showroom."</td><td valign='top' style='min-width: 300px;'>".$delivery.$calc.$button_buy.$button_discount.$button_3d.$button_laminat."</td></tr></table>";
?>
<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<!-- Картинка -->
<div class="item-image" style="width:<?=$cardWidth;?>px; height: auto; text-align: center;">

	<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arElement['ID']?>"><img src="<?if($cardCols==2){ 
  if($arElement['DETAIL_PICTURE']['SRC']) echo ($arElement['DETAIL_PICTURE']['SRC']);
  else echo (SITE_TEMPLATE_PATH."/images/default150.gif");
}
else {
  if($arElement['PREVIEW_PICTURE']['SRC']) echo ($arElement['PREVIEW_PICTURE']['SRC']);
  else echo (SITE_TEMPLATE_PATH."/images/default150.gif");
}
?>" style="max-width:<?=$cardWidth;?>px; max-height: 500px; width: <?
if($arElement['PREVIEW_PICTURE']['WIDTH']){
  if($cardCols==2) echo($arElement['PREVIEW_PICTURE']['WIDTH']*$cardWidth/137);
  else echo($arElement['PREVIEW_PICTURE']['WIDTH']);
}
else echo(137);?>
px" alt="<?=$arElement["NAME"]?>" title="Открыть картинку" id="catalog_list_image_<?=$arElement['ID']?>"/><!--br /><-?echo($arElement['PREVIEW_PICTURE']['WIDTH']*$cardWidth/137);?--></a>

	<!--div id="inline_<-?=$arElement['ID']?->" style="width:860px; height:465px; display: none; text-align: center;"-->

<script language="JavaScript">document.write('<div id="inline_<?=$arElement['ID']?>" style="width:'+winW+'px; height:'+winH+'px; display:'+display+'; text-align: center;">');</script>

		<!--table style="width:860px; height:465px;"><tr><td valign="top" style="text-align:center;"-->
		<table style="margin: auto;"><tr><td valign="top" style="text-align:center;">

<!--img src="<-?if($arElement['DETAIL_PICTURE']['SRC']):?-><-?=$arElement['DETAIL_PICTURE']['SRC']?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" alt="<-?=$arElement['NAME']?->" style="<-?if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']):?->max-width:560px; max-height:455px;<-?else:?->max-width:860px; max-height:240px;<-?endif?->"/-->

<script language="JavaScript">document.write('<img src="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="<?if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']):?>max-width:'+winWpic2+'px; max-height:'+winHpic2+'px;<?else:?>max-width:'+winWpic3+'px; max-height:'+winHpic3+'px;<?endif?>" />'); </script>

<?if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']):?></td><td valign="top" style="width: 300px;"/><?else:?></td></tr><tr><td valign="top" style="padding-top: 20px; text-align:center; vertical-align: bottom;"><?endif?><?=$title_text?></td></tr></table>
	</div>

</div>
<!-- Конец Картинка -->
<!--?endif;?-->

<!-- Конец Всплывающая картинка -->


<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				//if($arPrice["CAN_ACCESS"]):
				if(true):
?>
				<div class="item-price">
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
				<?else:?>
					<span class="item-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif;?>
				<!--span class="item-price"><-?=$arPrice["PRINT_VALUE"]?-></span-->
				</div>
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
		<!--?elseif (count($arResult["PRICES"]) > 0):?->
			<span class="catalog-item-not-available"><-?=GetMessage('CATALOG_NOT_AVAILABLE')?-></span-->
		<?endif;?>	
			<!--noindex-->

</div>
<!--p style="text-align: center; font-size: 11px; clear: both; margin: 0 auto; padding: 0 3px; overflow: hidden;"><nobr><?=$section["NAME"]?></nobr></p-->
	</div>

	<!--div class="catalog-item-separator"></div-->
<?endforeach;?>
<!--/div-->
</td></tr></table>

<div id="page_navigation">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>

<?if($section["DESCRIPTION"]):?>
  <div id="catalog-item-text" style="padding-top: 20px;"> 
    <h2><?=$section["NAME"]?></h2>
    <?=$section["DESCRIPTION"]?>
  </div>
<?endif?>
<?$APPLICATION->SetTitle("Плитка ".$window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." в интернет-магазине www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "каталог плитки, ".$keywords.", плитка ".$keywords.", плитка ".$keywords." цена, плитка ".$keywords." купить");?>