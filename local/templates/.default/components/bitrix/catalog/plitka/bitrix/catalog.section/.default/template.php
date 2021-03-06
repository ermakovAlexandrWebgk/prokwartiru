<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CModule::IncludeModule('sale');?>�
<!-- ����� � ������� -->
<?
$arPageItems = array();
function inBasket($elementID)
{
// ������� ���������� ������� ��� �������� ������������
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
// ������� ���������� ������� ��� �������� ������������
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
<!-- ����� ����� � ������� -->
<!-- ���������� �������� ������ -->
<script type="text/javascript">
function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return title+"<p style='padding-bottom:10px; font-weight:normal;'>�����: <b style='color:black;'>"+(currentIndex+1)+"</b> �� "+currentArray.length+"</span></p>";
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
<!-- ����� ���������� �������� ������ -->
<!-- Ajax ������ -->
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
<!-- ����� Ajax ������ -->
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
� �winW = document.documentElement.clientWidth*0.8; �
� �winH = document.documentElement.clientHeight*0.7;�
� �//winH = winW*0.7;
� �winWpic = winW*0.7;
� �winHpic = winH-30;
� �winWpic1 = winW;
� �winHpic1 = winH-10;
� �winWpic2 = winW-300;
� �winHpic2 = winH-10;
� �winWpic3 = winW-30;
� �winHpic3 = winH-215;
� �display = "none";
</script>
<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->
<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* ���� */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* ������ */
if($arSite=="/catalog/test/") $iblock_ID=4; /* ������ */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* ������� */
if($arSite=="/catalog/lepnina/") $iblock_ID=20; /* ������� */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* ����� */
//$iblock_ID=5;
?>
<!-- ��������� �������� -->
<?
  $page_title="<h1 id='page_title' style='margin-top: -5px; width: 500px; overflow: hidden; float: left;'>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG', 'UF_COLS'));
  if($type_item = $type->GetNext()){
        if($type_item['UF_NEWCATALOG']) $page_title=$page_title."<span id='new'>NEW</span>&nbsp;";
	$page_title=$page_title."<span>".$section["NAME"]."</span> / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $page_title=$page_title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
     // if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
      $cardCols=4;
      if($type_item['UF_COLS']==2) $cardCols=2;
 }
  $page_title=$page_title."</h1>";
  $window_title=$section["NAME"]." (".$fabrika['NAME'].")";
?>
<?=$page_title?>
<!-- ����� ��������� �������� -->
<!-- ������� -->
� <div id="glue" style="height: 63px; width: 175px; margin-top: -20px;">�
� � <div><a href="3d-project.php"><img src="<?=SITE_TEMPLATE_PATH?>/images/gift.png"></a></div><p style="padding-top: 10px;"><a href="3d-project.php">������-������ 3D<br />&ndash; <b style="font-size:14px;">� �������!</b></a></p>
� </div>
<!-- ����� ������� -->
<!-- ������ ������� �������� -->
<!-- 2 �������� � ��� -->
<? if($cardCols==2) $cardWidth=342; else $cardWidth=165; ?>
<!--? if($cardCols==2) $cardWidth=342; else $cardWidth=165; ?-->
<!-- ����� ������ ������� �������� -->

<!-- ��������� -->
<? $interiersNumber=10; ?>
<?if($section){
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

			<a class="fancybox" data-fancybox-group="gallery" href="#inline_<?=$arInteriers['ID']?>"><img src="<?=$arInteriersPathDetail?>" alt="<?=$arInteriers['NAME']?>" title="������� ��������" id="catalog_list_image_<?=$arInteriers['ID']?>" width="125" height="125" style="width: 125px; height: 125px;" /></a>

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
<!-- ����� ��������� -->
<!-- ������� �� �������� -->
<!--?
if (count($arResult['ITEMS']) < 1)
	return;
?-->

<table style="background-color: white; width: 725px; border: 1px solid #8E8B86; padding: 5px 0 10px 10px;">
<tr><td style="text-align: center;">
<p style="padding-bottom: 10px; text-align: center; font-size: 13px;"><i>��� ��������� ��������� ���������� � ������ �������� �� ��������.</i></p>

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

<!-- ��������� -->
      <div class="item-title" style="text-align: center; height: 30px; width: <?=$cardWidth;?>px; margin:0;"><a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></div>
<!-- ����� ��������� -->

  <div class="item-info">
	<div class="item-desc">				
<!-- �������� �� ����������� ��������� ������ -->
<!--?if($bHasPicture):?-->

<!-- ��������� ����� �������� ������ -->

<!-- ��������� ��� ������ -->
<!--? 
       if($arTitleType_child=GetIBlockSection($arElement['IBLOCK_SECTION_ID'], 'catalog')) {
          $title_type_parent=$arTitleType_child['IBLOCK_SECTION_ID'];
          if($arTitleType_parent=GetIBlockSection($title_type_parent, 'catalog'))$title_type=$arTitleType_parent['NAME'];
       }
       if($iblock_ID==4) $title_type=$title_type." ������";

?-->
<!-- ����� ��������� ��� ������ -->

<!-- ��������� �������� ������ -->
	<?$title=$arElement['NAME'];?>
<!-- ����� ��������� �������� ������ -->

<!-- �������������� ������ -->
<?
	if (is_array($arElement['DISPLAY_PROPERTIES']) && count($arElement['DISPLAY_PROPERTIES']) > 0){
		$text="<div class='float-card-properties'>";
		if($section["NAME"]) $text=$text."<p>���������: <b>".$section["NAME"]."</b>";
                if($type_item['UF_NEWCATALOG']) $text=$text."&nbsp;<span id='new'>NEW</span><br />"; else $text=$text."<br />";
		//if($arElement['PROPERTIES']['ARTICUL']['VALUE']) $text=$text."�������: <b>".$arElement['PROPERTIES']['ARTICUL']['VALUE']."</b><br />";
		if($fabrika['NAME']) $text=$text."�������: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."�������� ��������������: ".$arElement['PROPERTIES']['PROPERTY']['VALUE']."<br />";
		if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."������: ".$arElement['PROPERTIES']['SIZE']['VALUE']."<br />";
		if($arElement['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."������� (������): ".$arElement['PROPERTIES']['RAPPORT']['VALUE']."</p>";	
		if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']||$arElement['PROPERTIES']['UPAK_PCS']['VALUE']||$arElement['PROPERTIES']['UPAK_KG']['VALUE']) $text=$text."��������: ";
		if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']) $text=$text.$arElement['PROPERTIES']['UPAK_KBM']['VALUE']." ��.�";
		if($arElement['PROPERTIES']['UPAK_PCS']['VALUE']) { if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']) $text=$text." / "; $text=$text.$arElement['PROPERTIES']['UPAK_PCS']['VALUE']." ��."; }
		if($arElement['PROPERTIES']['UPAK_KG']['VALUE']) { if($arElement['PROPERTIES']['UPAK_PCS']['VALUE']) $text=$text." / "; $text=$text.$arElement['PROPERTIES']['UPAK_KG']['VALUE']." ��"; }
		if($arElement['PROPERTIES']['UPAK_KBM']['VALUE']||$arElement['PROPERTIES']['UPAK_PCS']['VALUE']||$arElement['PROPERTIES']['UPAK_KG']['VALUE']) $text=$text."</p>";

		//if($arElement["DETAIL_PAGE_URL"]) $text=$text."<p><a href='".$arElement["DETAIL_PAGE_URL"]."'>���������</a></p>";
		$text=$text."</div>";
	}
?>
<!-- ����� �������������� ������ -->

<!-- ���� ������ -->
<?
	foreach($arElement["PRICES"] as $code=>$arPrice){
		if($arPrice["CAN_ACCESS"]){ 
			$price="";
			if($arPrice["DISCOUNT_VALUE"] > $arPrice["VALUE"]) $price=$price."<span class='catalog-item-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span> <s>".$arPrice['PRINT_VALUE']."</s>";
			else $price=$price.$arPrice['PRINT_VALUE'];			
			if($arElement['PROPERTIES']['UNIT']['VALUE']) $price="<span class='float-card-price'>".$price."</span> / ".$arElement['PROPERTIES']['UNIT']['VALUE'];
			else $price="<span class='float-card-price'>".$price."</span> / ��.�";
		}
	}
?>
<!-- ����� ���� ������ -->

<!-- ���������� ������ -->
<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="��������� ���������"; else $quantity="��� �����";?>
<!-- ����� ���������� ������ -->

<!-- ������ ������ -->
<?
	$button_buy="<div class='catalog-item-links' style='height:30px;'>";
	if ($arElement['CAN_BUY']) {
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons_'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	//	if($n==1) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons_'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
		//if($n==0) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	}
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy.$on."</div>";
	//$arPageItems[] = $arElement["ID"];
?>
<!-- ����� ������ ������ -->

<!-- ������ � ������� -->
<!--?
	if($arParams["DISPLAY_COMPARE"]) $button_compare="<div class='catalog-item-links'><div class='buttons'><a href='".$arElement['COMPARE_URL']."' class='catalog-item-compare' onclick='addToCompare(this, '� ��������');' rel='nofollow' id='catalog_add2compare_link_".$arElement['ID']."'>".GetMessage('CATALOG_COMPARE')."</a></div></div>";
?-->
<!--?echo $arElement["COMPARE_URL"]?-->
<!--?
$path=$arElement["ID"];
	if($arParams["DISPLAY_COMPARE"]) $button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' class='catalog-item-compare' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);' rel='nofollow' id='catalog_add2compare_link_".$arElement['ID']."'>".$path."-".GetMessage('CATALOG_COMPARE')."</a></div></div>";
?-->

<!--?if($arParams["DISPLAY_COMPARE"]):?->
<-?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);'>� �������</a></div></div>";?->
<-?endif?-->
<!-- ����� ������ � ������� -->

<!-- ������������ � �������������� �������� ��� ����������� �������� ������ -->
	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td valign='top' style='min-width: 250px;'>".$button_buy."<p><b class='big'>".$title_type."</b></p><p>��������: <b class='big'>".$title."</b></p><p style='padding-top: 4px;'>����: ".$price."</p><p style='padding-top: 4px;'><nobr>�������: <b class='orange'>".$quantity."</b></nobr></p></td>";          
          if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']) $title_text=$title_text."</tr><tr>";
          $title_text=$title_text."<td valign='top' style='min-width: 300px;'>".$text."</td></tr></table>";?>
<!-- ����� �������������� � �������� -->

<!-- ����� ����� �������� -->

<!-- �������� -->
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
px" alt="<?=$arElement["NAME"]?>" title="������� ��������" id="catalog_list_image_<?=$arElement['ID']?>"/><!--br /><-?echo($arElement['PREVIEW_PICTURE']['WIDTH']*$cardWidth/137);?--></a>

	<!--div id="inline_<-?=$arElement['ID']?->" style="width:860px; height:465px; display: none; text-align: center;"-->

<script language="JavaScript">document.write('<div id="inline_<?=$arElement['ID']?>" style="width:'+winW+'px; height:'+winH+'px; display:'+display+'; text-align: center;">');</script>

		<!--table style="width:860px; height:465px;"><tr><td valign="top" style="text-align:center;"-->
		<table style="margin: auto;"><tr><td valign="top" style="text-align:center;">

<!--img src="<-?if($arElement['DETAIL_PICTURE']['SRC']):?-><-?=$arElement['DETAIL_PICTURE']['SRC']?-><-?else:?-><-?=SITE_TEMPLATE_PATH?->/images/default300.gif<-?endif?->" alt="<-?=$arElement['NAME']?->" style="<-?if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']):?->max-width:560px; max-height:455px;<-?else:?->max-width:860px; max-height:240px;<-?endif?->"/-->

<script language="JavaScript">document.write('<img src="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" alt="" style="<?if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']):?>max-width:'+winWpic2+'px; max-height:'+winHpic2+'px;<?else:?>max-width:'+winWpic3+'px; max-height:'+winHpic3+'px;<?endif?>" />'); </script>

<?if($arElement['DETAIL_PICTURE']['WIDTH']<=$arElement['DETAIL_PICTURE']['HEIGHT']):?></td><td valign="top" style="width: 300px;"/><?else:?></td></tr><tr><td valign="top" style="padding-top: 20px; text-align:center; vertical-align: bottom;"><?endif?><?=$title_text?></td></tr></table>
	</div>

</div>
<!-- ����� �������� -->
<!--?endif;?-->

<!-- ����� ����������� �������� -->


<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				//if($arPrice["CAN_ACCESS"]):
				if(true):
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
<?$APPLICATION->SetTitle("������ ".$window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "������� ������, ".$keywords.", ������ ".$keywords.", ������ ".$keywords." ����, ������ ".$keywords." ������");?>