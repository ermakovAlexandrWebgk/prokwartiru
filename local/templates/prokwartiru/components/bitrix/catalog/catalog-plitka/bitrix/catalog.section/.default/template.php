<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CModule::IncludeModule('sale');?>

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
  $(document).ready(function() {

	$("div.item-image a").fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,
		'overlayShow': false,
		'cyclic' : true,
		'padding': 20,
		'titlePosition': 'inside',
		'hideOnContentClick': false,
		'height': 600,
		'titleFormat': formatTitle
	});
  });

 // $(document).ready(function(){
 //   $("#fancybox-left").one("click", function () {
 //      $("#fancybox-img").after("<div id='watermark' style='position: absolute; top: 0; left: 0; border: 1px solid red; width: 100%; height: "+height+"px; z-index: 900;'><p style='text-align: center;'><img src='/img/watermark.png' style='border: 1px solid green; width: "+width+"px; height: "+height+"px;'></p></div>");
 //   });
 // });


function ShowFloatCard_(width, height) {
  $(document).ready(function(){
    $("div.item-image a").one("click", function () {
	if($("#watermark").is()){$("#watermark").replaceWith("<div id='watermark' style='position: absolute; top: 0; left: 0; border: 1px solid red; width: 100%; height: "+height+"px; z-index: 900;'><p style='text-align: center;'><img src='/img/watermark.png' style='border: 1px solid green; width: "+width+"px; height: "+height+"px;'></p></div>");}
       //$("#fancybox-inner").append("<div style='position: absolute; top: 0; left: 0; border: 1px solid red; width: 100%; height: "+height+"px; z-index: 900;'><p style='text-align: center;'><img  src='/img/watermark.png' style='border: 1px solid green; width: "+width+"px; height: "+height+"px;'></p></div>");  
      else { $("#fancybox-img").after("<div id='watermark' style='position: absolute; top: 0; left: 0; border: 1px solid red; width: 100%; height: "+height+"px; z-index: 900;'><p style='text-align: center;'><img src='/img/watermark.png' style='border: 1px solid green; width: "+width+"px; height: "+height+"px;'></p></div>");}
       //$("#fancybox-left").one("click", function () { $("#fancybox-img").after("<div id='watermark' style='position: absolute; top: 0; left: 0; border: 1px solid red; width: 100%; height: "+height+"px; z-index: 900;'><p style='text-align: center;'><img src='/img/watermark.png' style='border: 1px solid green; width: "+width+"px; height: "+height+"px;'></p></div>");});
    });
  });
}


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


<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* ���� */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* ������ */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* ������� */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* ����� */
?>

<!-- ��������� �������� -->
<?
  $page_title="<h1 id='page_title' style='margin-top: -20px;'><span>".$section["NAME"]."</span>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG'));
  if($type_item = $type->GetNext()){
	$page_title=$page_title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $page_title=$page_title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
      if($type_item['UF_NEWCATALOG']) $page_title=$page_title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
 }
  $page_title=$page_title."</h1>";
?>
<?=$page_title?>
<!-- ����� ��������� �������� -->

<!-- ��������� -->
<div id="page_navigation" style="margin-top: 0px; padding-bottom: 20px;">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>
<!-- ����� ��������� -->
<!-- ��������� -->
<?if($section){
   if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array("nPageSize"=>10), array());
   if($iblock_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array("nPageSize"=>10), array());
}?>
<?if($Interiers):?>
  <div class="catalog-interier-cards" style="width: 735px;">
    <?while($arInteriers = $Interiers->GetNext()){
		$arInteriersPathPreview = CFile::GetPath($arInteriers["PREVIEW_PICTURE"]);
		$arInteriersPathDetail = CFile::GetPath($arInteriers["DETAIL_PICTURE"]);
  ?>
	<div class="catalog-interier-card">
		<div class="item-title" style="text-align: center;"><?=$arInteriers["NAME"]?><?=$sticker?></div>
  		<div class="item-image">
			<a rel="detail-images" href="<?=$arInteriersPathDetail?>" title="<div id='interier_name'><?=$arInteriers['NAME']?></div>"><img src="<?=$arInteriersPathDetail?>" alt="<?=$arInteriers['NAME']?>" title="������� ��������" id="catalog_list_image_<?=$arInteriers['ID']?>" style="width: 125px; height: 125px;" /></a>
		</div>
	  </div>
    <? }?>
  </div>
<?endif?>
<!-- ����� ��������� -->
<!-- ������� �� �������� -->
<? if(count($arResult['ITEMS'])< 1) {
	//if(count($Interiers)==1) echo("������� ���� �� ��������");
	return;
}
?>

<table style="background-color: white; width: 725px; border: 1px solid #8E8B86;">
<tr><td style="text-align: center;">
<p style="padding: 5px 5px 10px 10px; text-align: center; font-size: 13px;"><i>��� ��������� ��������� ���������� � ������ �������� �� ��������.</i></p>
<!--div class="catalog-item-cards" style="height: auto; background-color: white; padding:0 10px 10px 0; margin-right: 10px; clear: both;"-->

<?$row=0; $col=0;?>
<?
foreach ($arResult['ITEMS'] as $key => $arElement):

	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}
?>
<?if($col==4) { $row++; $col=1; echo("<div style='clear:both; margin:0; padding:0 5px;'><hr></div>"); } else $col++;?>
  <!--div class="_catalog-item<-?if (!$bHasPicture):?-> no-picture-mode<-?endif;?->" id="<-?=$this->GetEditAreaId($arElement['ID']);?->"-->
    <div class="catalog-item-card" style="width: 155px; height: auto; border: none; margin: 10px 10px 0 12px;" >

<!-- ��������� -->
      <div class="item-title" style="text-align: center; width: 145px; height: 30px;"><a href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>"><b><?=$arElement["NAME"]?></b></a><?=$sticker?></div>
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
		if($arElement['PROPERTIES']['ARTICUL']['VALUE']) $text=$text."�������: <b>".$arElement['PROPERTIES']['ARTICUL']['VALUE']."</b><br />";
		if($fabrika['NAME']) $text=$text."�������: <b>".$fabrika['NAME']."</b> ";
		if($country['NAME']) $text=$text."(".$country['NAME'].")<br />";
		if($arElement['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."�������� ��������: ".$arElement['PROPERTIES']['PROPERTY']['VALUE']."<br />";
		if($arElement['PROPERTIES']['SIZE']['VALUE']) $text=$text."������: ".$arElement['PROPERTIES']['SIZE']['VALUE']."<br />";
		if($arElement['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."������� (������): ".$arElement['PROPERTIES']['RAPPORT']['VALUE']."</p>";	
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
			if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) $price=$price."<span class='catalog-item-price'>".$arPrice['PRINT_DISCOUNT_VALUE']."</span> <s>".$arPrice['PRINT_VALUE']."</s>";
			else $price=$price.$arPrice['PRINT_VALUE'];
			if($arElement['PROPERTIES']['UNIT']['VALUE']) $price="<span class='float-card-price'>".$price."</span> / ".$arElement['PROPERTIES']['UNIT']['VALUE'];
			else $price="<span class='float-card-price'>".$price."</span> / ��.�";
		}
	}
?>

<!-- ����� ���� ������ -->

<!-- ���������� ������ -->

<?$itemCatalog = CCatalogProduct::GetByID($arElement["ID"]);?>
<?if($itemCatalog["QUANTITY"]>0) $quantity="���� �� ������"; else $quantity="��� �����";?>

<!-- ����� ���������� ������ -->

<!-- ������ ������ -->
<!--?
	$button_buy="<div class='catalog-item-links'>";
	if ($arElement['CAN_BUY']) $button_buy=$button_buy."<div class='buttons'><a href='".$arElement['ADD_URL']."' class='catalog-item-buy' rel='nofollow'  onclick='return addToCart(this, 'catalog_list_image_".$arElement['ID']."', 'list', '".GetMessage('CATALOG_IN_CART')."');' id='catalog_add2cart_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";
	elseif (count($arResult['PRICES']) > 0) $button_buy=$button_buy."<span class='catalog-item-not-available'>".GetMessage('CATALOG_NOT_AVAILABLE')."</span>";
	$button_buy=$button_buy."</div>";
?-->
<?
	$button_buy="<div class='catalog-item-links'>";
	if ($arElement['CAN_BUY']) {
		if(!inBasket($arElement['ID'])) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
	//	if($n==1) $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-buy' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_ADD')."</a></div>";	
		else $button_buy=$button_buy."<div class='buttons'><a href='javascript:;' class='catalog-item-in-the-cart' rel='nofollow'  onclick='javascript: Add2Basket(&quot;".$arElement['ADD_URL']."&quot;, &quot;".$arElement['ID']."&quot;);'  style='cursor:default' id='catalog_add2cart1_link_".$arElement['ID']."'>".GetMessage('CATALOG_IN_CART')."</a></div>";	
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

<?if($arParams["DISPLAY_COMPARE"]):?>
<?$button_compare="<div class='catalog-item-links'><div class='buttons'><a href='javascript:;' onclick='Add22Compare(&quot;".$arElement['COMPARE_URL']."&quot;);'>� �������</a></div></div>";?>
<?endif?>

<!-- ����� ������ � ������� -->


<!-- ������������ � �������������� �������� ��� ����������� �������� ������ -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td colspan='2'><p><b class='big'>".$title_type."</b></p><p>��������: <b class='big'>".$title."</b></p></td></tr><tr><td class='left'>����: ".$price."</td><td class='right'>".$button_compare."</td></tr><tr><td class='left'>�������: <b class='orange'>".$quantity."</b></td><td class='right'>".$button_buy."</td></tr><tr><td colspan='2'>".$text."</td></tr></table>";?>

<!-- ����� �������������� � �������� -->

<!-- ����� ����� �������� -->

<!-- �������� -->
<div class="item-image" style="width: 145px; height: auto;">
	<a rel="detail-images" /*onclick="javascript: ShowFloatCard(<-?=$arElement['DETAIL_PICTURE']['WIDTH']?->, <-?=$arElement['DETAIL_PICTURE']['HEIGHT']?->);"*/ href="<?if($arElement['DETAIL_PICTURE']['SRC']):?><?=$arElement['DETAIL_PICTURE']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default300.gif<?endif?>" title="<?=$title_text?>"><img src="<?if($arElement['PREVIEW_IMG']['SRC']):?><?=$arElement['PREVIEW_IMG']['SRC']?><?else:?><?=SITE_TEMPLATE_PATH?>/images/default100.gif?><?endif?>" style="max-width: 145px; max-height: 145px; width: <?=$arElement['PREVIEW_IMG']['WIDTH']?>; height: <?=$arElement['PREVIEW_IMG']['WIDTH']?>;" alt="<?=$arElement["NAME"]?>" title="������� ��������" id="catalog_list_image_<?=$arElement['ID']?>"/></a>
</div>
<!-- ����� �������� -->
<!--?endif;?-->

<!-- ����� ����������� �������� -->


			<div class="item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				if($arPrice["CAN_ACCESS"]):?>
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


<div class="catalog-item-links">
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



        </div>
      </div>




    </div>
  <!--/div-->

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
  <div id="catalog-item-text"> 
    <h2><?=$section["NAME"]?></h2>
    <?=$section["DESCRIPTION"]?>
  </div>
<?endif?>