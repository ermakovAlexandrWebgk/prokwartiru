<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CModule::IncludeModule('sale');?>
<?if (is_array($arResult['DETAIL_PICTURE_350']) || count($arResult["MORE_PHOTO"])>0):?>
<script type="text/javascript">
$(function() {
	$('div.catalog-detail-image a').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,
		'overlayShow': false,
		'cyclic' : true,
		'padding': 20,
		'titlePosition': 'inside',
		'onComplete': function() {
			$("#fancybox-title").css({ 'top': '100%', 'bottom': 'auto' });
		} 
	});
});
</script>
<?endif;?>


<script type="text/javascript">
$n=0;
function Add2Basket(path, element) {
	$.ajax({
             type:'POST',
             url:path
            });
	$(document).ready(function(){$("#catalog_add2cart1_link_"+element).click(function () {
		$("#catalog_add2cart1_link_"+element).html("�����<br />� �������").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
		$("#catalog_add2cart_link_"+element).html("��� � �������").removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart").unbind('click').css("cursor", "default");
	}); 	});
}
</script>

<div class="catalog-detail">

<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>
<?
$arSite = $APPLICATION->GetCurDir();
if($arSite=="/catalog/oboi/") $iblock_ID=5; /* ���� */
if($arSite=="/catalog/plitka/") $iblock_ID=4; /* ������ */
if($arSite=="/catalog/mosaic/") $iblock_ID=10; /* ������� */
if($arSite=="/catalog/curtains/") $iblock_ID=11; /* ����� */
?>

<?if(!$section["ACTIVE"]) { echo ("<h2 style='text-align: center; padding-top: 30px;' class='orange'>���� ������� �������� ����������</h2>"); return; }?>

<!-- ��������� �������� -->
<?
  //$title="<h1 id='page_title' style='margin-top: 10px;'><span><a href='".$APPLICATION->GetCurDir()."index.php?SECTION_ID=".$section["ID"]."'></a></span>";
  $title="<h1 id='page_title' style='margin-top: 10px;'><span><a href='".$APPLICATION->GetCurDir()."index.php?SECTION_ID=".$section["ID"]."'>".$section["NAME"]."</a></span>";
  if($section) $type = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $iblock_ID, 'ID' => $section['ID']), false, $arSelect=array('UF_FABRIKA','UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_SALE_OBOI', "UF_GLUE", "UF_SHOWROOM", "UF_DISCOUNT5"));

  if($type_item = $type->GetNext()){
	//$saleID="";
	//$saleID=$type_item['UF_SALE_OBOI'];
	//if($saleID){
	//  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_OBOI"));
	//    if($ar_res = $res->GetNext())
	//      $sale=$ar_res["VALUE"];
        //}
        
	$title=$title." / ";
	if($fabrika=GetIBlockElement($type_item['UF_FABRIKA'], 'catalog')) $title=$title."<a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."&SECTION_ID=1'>".$fabrika['NAME']."</a>";
	if($country=GetIBlockSection($fabrika['IBLOCK_SECTION_ID'], 'catalog')) $title=$title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 

        //if($type_item['UF_SALE_OBOI'][0]) $title=$title."&nbsp;&nbsp;&nbsp;<span id='sale'>SALE ".$sale."</span>";
        if($type_item['UF_ACTION']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='sale'style='background-color:#ffce0c;'>������ ����</span>";
        elseif($type_item['UF_NEWCATALOG']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='new'>NEW</span>";
        elseif($type_item['UF_HIT']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='hit'>HIT</span>&nbsp;";
        //elseif($type_item['UF_DISCOUNT10']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='sale'>������ 10%</span>";
        //elseif($type_item['UF_SALE']) $title=$title."&nbsp;&nbsp;&nbsp;<span id='sale'>SALE</span>";
  }
  $title=$title."</h1>";
?>
<?=$title?>
<!-- ����� ��������� �������� -->


	<table class="catalog-detail" cellspacing="0" border="0">
		<tr>
		<?if (is_array($arResult['DETAIL_PICTURE_350']) || count($arResult["MORE_PHOTO"])>0):?>
			<td class="catalog-detail-image">
			<?if (is_array($arResult['DETAIL_PICTURE_350'])):?>
				<div class="catalog-detail-image" id="catalog-detail-main-image">
					<a rel="catalog-detail-images" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" title="���. <?=$arResult["NAME"]?>"><img src="<?=$arResult['DETAIL_PICTURE_350']['SRC']?>" alt="<?=$arResult["NAME"]?>" id="catalog_detail_image"  /></a>
				</div>
			<?endif;?>

			</td>
		<?endif;?>

			<td class="catalog-detail-desc">
<!-- ��������� ������ -->
<!-- ��� ������ -->
<? 
       if($arTitleType_child=GetIBlockSection($arResult['IBLOCK_SECTION_ID'], 'catalog')) {
          $title_type_parent=$arTitleType_child['IBLOCK_SECTION_ID'];
          if($arTitleType_parent=GetIBlockSection($title_type_parent, 'catalog')) echo("<b class='big'>".$arTitleType_parent['NAME']."</b><br /><br />");
       }
?>
<!-- ����� ��� ������ -->	
			�������: <b class="big"><?=$arResult["NAME"]?></b>
			<?if($arResult["PREVIEW_TEXT"]):?>
				<?=$arResult["PREVIEW_TEXT"];?>
				<!--div class="catalog-detail-line"></div-->
			<?endif;?>
<!-- ����� ��������� ������-->
<!-- ���� ������ -->				
				<div class="catalog-detail-price">
				<?foreach($arResult["PRICES"] as $code=>$arPrice):
					if($arPrice["CAN_ACCESS"]):
				?>
				
				  <p>����: <!--label>����:</label-->
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-detail-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-detail-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif;?>
                                                 <?if($arResult['PROPERTIES']['UNIT']['VALUE']):?>/ <?=$arResult['PROPERTIES']['UNIT']['VALUE'];?><?endif?> 
				  </p>
				<?
						break;
					endif;
				endforeach;
				?>
				</div>
<!-- ����� ���� ������ -->

				<?if($arResult["CAN_BUY"]&&false):?>
				<div class="catalog-detail-buttons">
					<!--noindex--><a href="<?=$arResult["ADD_URL"]?>" rel="nofollow" onclick="return addToCart(this, 'catalog_detail_image', 'detail', '<?=GetMessage("CATALOG_IN_BASKET")?>');" id="catalog_add2cart_link"><span><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></span></a><!--/noindex-->
				</div>

				<?endif;?>

				<div class="catalog-item-links">
					<?if(!$arResult["CAN_BUY"] && (count($arResult["PRICES"]) > 0)):?>
					<span class="catalog-item-not-available"><!--noindex--><?=GetMessage("CATALOG_NOT_AVAILABLE");?><!--/noindex--></span>
					<?endif;?>

					<!--?if($arParams["USE_COMPARE"] == "Y"):?->
					<a href="<-?=$arSite?->index.php?action=ADD_TO_COMPARE_LIST&SECTION_ID=<-?=$section['ID']?->&id=<-?=$arResult["ID"]?->" class="catalog-item-compare" onclick="return addToCompare(this, '<-?=GetMessage("CATALOG_IN_COMPARE")?->');" rel="nofollow" id="catalog_add2compare_link" rel="nofollow"><-?echo GetMessage("CATALOG_COMPARE")?-></a>
					<-?endif;?-->
				</div>
<!-- �������������� -->
<?
if (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0):
?>
<?
		$text="<div class='catalog-detail-properties'>";
		$text=$text."<p>���������: <a href='".$APPLICATION->GetCurDir()."index.php?SECTION_ID=".$section["ID"]."'><b><u>".$section["NAME"]."</u></b></a></p>";
		$text=$text."<p>�������: <a href='".$APPLICATION->GetCurDir()."index.php?FABRIKA_ID=".$type_item['UF_FABRIKA']."&SECTION_ID=1'><b><u>".$fabrika['NAME']."</u></b></a> (".$country['NAME'].")</p>";
		if($arResult['PROPERTIES']['PROPERTY']['VALUE']) $text=$text."<p>�������� ��������������: <br /><b>".$arResult['PROPERTIES']['PROPERTY']['VALUE']."</b></p>";
		if($arResult['PROPERTIES']['SIZE']['VALUE']) $text=$text."<p>������: <b>".$arResult['PROPERTIES']['SIZE']['VALUE']."</b></p>";
		if($arResult['PROPERTIES']['RAPPORT']['VALUE']) $text=$text."<p>������� (������): <b>".$arResult['PROPERTIES']['RAPPORT']['VALUE']."</b></p>";	
		$text=$text."</div>";
?>
<?endif;?>
<?=$text?>
<!-- ����� �������������� -->

<!-- ���������� ������ -->
<?$itemCatalog = CCatalogProduct::GetByID($arResult["ID"]);?>
�������: <?if($itemCatalog["QUANTITY"]>0):?><b>��������� ���������</b><?else:?><b>��� �����</b><?endif?>
<!-- ����� ���������� ������ -->

<!-- ������ -->
				<?$arDiscounts = CCatalogDiscount::GetDiscountByPrice(
				  $arPrice["ID"],
				  $USER->GetUserGroupArray(),
				  "N",
				  SITE_ID
			        );?>
				<?if($arDiscounts[0]["VALUE"]):?><p style="margin-top:15px;"><b class='orange' style='font-size: 20px;'><?=$arDiscounts[0]["NOTES"]?></b></p><?endif?>
<!-- ����� ������ -->

<!-- �������� ������ -->
<? 
    $delivery="<div style='margin: 20px 0 0px 0px;'><p>���� ��������:</p><p><a href='/about/delivery/'><img src='".SITE_TEMPLATE_PATH."/images/delivery.png' title='��������' alt='��������'  style='width:45px; margin-top:5px; margin-right:10px; float:left;' /></a>";

    if($itemCatalog["QUANTITY"]>0) $delivery.="�������� &ndash; <b>1 ����</b><br />��������� &ndash; <b>1 ���� ����� ������</b>";
    elseif($arResult['PROPERTIES']['DELIVERY']['VALUE']) 
    {
      $delivery.="�������� &ndash; <b>";
      if(in_array($arResult['PROPERTIES']['DELIVERY']['VALUE'], array(1,21,31,41,51,61,71,81,91))) $delivery.=$arResult['PROPERTIES']['DELIVERY']['VALUE']." ���� ";
      elseif(in_array($arResult['PROPERTIES']['DELIVERY']['VALUE'], array(2,22,32,42,52,62,72,82,92,3,23,33,43,53,63,73,83,93,4,24,34,44,54,64,74,84,94))) $delivery.=$arResult['PROPERTIES']['DELIVERY']['VALUE']." ��� ";
      else $delivery.=$arResult['PROPERTIES']['DELIVERY']['VALUE']." ���� ";
      $delivery.="����� ������</b><br />��������� &ndash; <b>1 ���� ����� �����������</b>";
    }
    else $delivery.="�������� &ndash; <b>1 ���� ����� ������</b><br />��������� &ndash; <b>1 ���� ����� �����������</b>";
    $delivery.="</p></div>"; 
?>
<?=$delivery?>
<!-- ����� �������� ������ -->

<!-- ������ -->
<? $calc="<div style='margin: 7px 0 0px 0px;'><p>������ � �������:</p><p><a href='/about/contacts/'><img src='".SITE_TEMPLATE_PATH."/images/calc.png' title='������' alt='������'  style='width:20px; margin:0px 10px 0px 0px; float:left;' /></a>�������: <b>+7(985) 155-17-55</b><br />�����: <b>info@prokwarti.ru</b><p></div>";?>
<?=$calc?>
<!-- ����� ������ -->

<!-- ���������� � ��������� -->
<? $look="<div style='margin: 20px 0 0px 0px;'><p><img src='".SITE_TEMPLATE_PATH."/images/look.png' style='width:28px; height:23px; margin-top:-5px; margin-right:10px; float:left;' /> <b>���������� � ���������</b></p></div><div style='clear:both;'></div>"; ?>
<?=$look;?>
<!-- ����� ���������� � ��������� -->

<!-- ������ -->
<? if($type_item['UF_SHOWROOM']) $showroom="<div style='margin: 7px 0 0px 0px;'><p><a href='/about/contacts/'><img src='".SITE_TEMPLATE_PATH."/images/eye.png' style='width:30px; margin-top:0px; margin-right:10px; margin-top:-7px; float:left;' /></a>������ ����� ����� ���������� � ����� <a href='/about/contacts/'>���-����</a></p></div>"; ?>
<?=$showroom?>
<!-- ����� ������ -->


<!-- ������ ������ -->
<div style="margin: 15px 0 0px 0px;">
<?if($arResult["CAN_BUY"]):?>
<div class="catalog-detail-buttons_new">
<!--noindex--><div class="buttons"><a href="<?=$arResult["ADD_URL"]?>" rel="nofollow" onclick="return addToCart(this, 'catalog_detail_image', 'detail', '<?=GetMessage("CATALOG_IN_BASKET")?>');" id="catalog_add2cart_link" class='catalog-item-buy'><span>��������<br />� �������</span></a></div><!--/noindex-->
</div>
<?endif;?>
<!-- ����� ������ ������ -->

<!-- ���� -->
<?if($glue=GetIBlockElement($type_item['UF_GLUE'], 'catalog')) $glue_pic=CFile::GetPath($glue["PREVIEW_PICTURE"]);?>
<?if($glue):?>
<?$button_glue="<div class='glue' onclick='javascript: Add2Basket(&quot;/catalog/glue/?action=ADD2BASKET&id=".$glue['ID']."&quot;,&quot;".$glue['ID']."&quot;);'><img src='".$glue_pic."' title='�������� � ������� ����' alt='�������� � ������� ����'  style='width:auto; height:38px; margin:4px 4px 4px 8px;' /></div>";?>
<?endif?>
<!-- ����� -->
<?$button_curtains="<a href='/catalog/curtains/'><img src='".SITE_TEMPLATE_PATH."/images/curtains.png' title='����� ���� ���������' alt='����� ���� ���������' style='width:120px; height:47px; ' /></a>";?>
<!-- �������� ������ -->
<?$button_discount="<a href='http://prokwarti.ru/discount.php'><img src='".SITE_TEMPLATE_PATH."/images/discount.png' title='�������� ������' alt='�������� ������' style='width:120px; height:47px; margin-right:10px;' /></a>";?>

<?=$button_glue?>
<div style="clear:both;"></div>
<div style="margin-top:10px;"><?=$button_discount?><?=$button_curtains?></div>
<!-- ����� ���� � ����� -->
</div>
<!-- ������ -->
<?  if($type_item['UF_DISCOUNT5']) $discount5="<div style='margin: 15px 0 0px 0px;'><p><b class='orange' style='font-size: 16px;'>������ 5%</b>  ��������������� ��� ������ ����� ������� �����<p></div>"; else $discount5=""; ?>
<?=$discount5;?>

<div style="margin-top:20px;"><p class="back"><a href="#" onclick="history.back(); return false;">�����</a></p></div>

			</td>
		</tr>
	</table>

	
<?
if (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0):
?>
	<?$arProperty = $arResult["DISPLAY_PROPERTIES"]["RECOMMEND"]?>
	
	<?if(count($arProperty["DISPLAY_VALUE"]) > 0):?>
	<div class="catalog-detail-recommends">
		<h4><?=$arProperty["NAME"]?></h4>
			<div class="catalog-detail-recommend">
			<?
			global $arRecPrFilter;
			$arRecPrFilter["ID"] = $arResult["DISPLAY_PROPERTIES"]["RECOMMEND"]["VALUE"];
			$APPLICATION->IncludeComponent("bitrix:store.catalog.top", "", array(
				"IBLOCK_TYPE" => "",
				"IBLOCK_ID" => "",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "desc",
				"ELEMENT_COUNT" => $arParams["ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"DISPLAY_COMPARE" => "N",
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"FILTER_NAME" => "arRecPrFilter",
				"ELEMENT_COUNT" => 30,
				),
				$component
			);
			?>
		</div>
	</div>
	<?unset($arResult["DISPLAY_PROPERTIES"]["RECOMMEND"])?>
	<?endif;?>
<?endif;?>


	<?if($arResult["DETAIL_TEXT"]):?>
	<div class="catalog-detail-full-desc">
		<h4><?=GetMessage('CATALOG_FULL_DESC')?></h4>
		<div class="catalog-detail-line"></div>
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
	<?endif;?>

<br /><br />

<br />
</div>

<?$APPLICATION->SetTitle($arTitleType_parent['NAME']." ".$section['NAME']." (".$fabrika['NAME'].") ���. ".$arResult['NAME']." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetDirProperty("description", $arTitleType_parent['NAME']." ".$section['NAME']."(".$fabrika['NAME'].") ���. ".$arResult['NAME']." � ��������-�������� www.prokwarti.ru");?>
