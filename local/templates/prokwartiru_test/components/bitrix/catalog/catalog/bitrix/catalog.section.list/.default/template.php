<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$filter_price=$_REQUEST["PRICE_ID"];
	$numberFilter=0;
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* ���� */
	if($arSite=="/catalog/test/") $IBLOCK_ID=5; /* ���� */
	if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* ������ */
	if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* ������� */
	if($arSite=="/catalog/lights/") $IBLOCK_ID=17; /* ���� */
	if($arSite=="/catalog/lepnina/") $IBLOCK_ID=20; /* ������� */
	//if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* ����� */
?>

<?
  if(($arSite=="/catalog/fabriki/")&&(CModule::IncludeModule("iblock"))){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
	if($SECTION_ID=="51") { $window_title="���� "; $keywords="���� "; $IBLOCK_ID=5; } /* ���� */
	if($SECTION_ID=="78") { $window_title="������ "; $keywords="������ "; $IBLOCK_ID=4; } /* ������ */
	if($SECTION_ID=="140") { $window_title="������� "; $keywords="������� "; $IBLOCK_ID=10; } /* ������� */
	if($SECTION_ID=="759") { $window_title="����������� "; $keywords="����������� "; $IBLOCK_ID=17; } /* ���� */
	if($SECTION_ID=="1266") { $window_title="������� "; $keywords="������� ";$IBLOCK_ID=20; } /* ������� */
	//if($SECTION_ID=="141") $IBLOCK_ID=11; /* ����� */
    }
  }
?>
<!-- ������ �� �������� -->
<!-- ��������� -->
<?
  if($fabrika) {
    $itemFabrika = CIBlockElement::GetByID($fabrika); 
    if($ar_itemFabrika = $itemFabrika->GetNext()){
      $page_title="<h1 id='page_title' style='margin-left: 10px;'><span>".$ar_itemFabrika['NAME']."</span>";
      if($country=GetIBlockSection($ar_itemFabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
    }   
  $page_title=$page_title."</h1>"; 
  $window_title=$window_title.$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords=$keywords.$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- ����� ��������� -->
<!-- ������ ��������� -->
<div class="catalog-item-list">
<!-- ������ ��������� �� �������� -->
<?if($fabrika):?>

<?
// ������
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $fabrika);
$arFilterDop=Array();
if($filter_price) $arFilterDop=Array('UF_PRICE' => $filter_price);
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// ����� ������
?>
  <?

    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); 
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
      $numberFilter++;
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
	  <div  class="catalog-item-title" style="font-size: 13px;">
	    <?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo "<nobr>".$ar_type['NAME']."</nobr>";
	    ?>
	  </div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogFabrika["UF_HIT"]) echo("<span id='hit'>HIT</span>");  elseif($itemCatalogFabrika["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
<?
  }
?>

<!-- ����� ������ ��������� �� �������� -->

<!-- ������ ��������� �� ����� -->
<?else:?>

  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <?
    $window_title=$arResult["SECTION"]["NAME"];
    $keywords=$arResult["SECTION"]["NAME"];
  ?>

<?
// ������
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
$arFilterDop=Array();
if($filter_price) $arFilterDop=Array('UF_PRICE' => $filter_price);
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// ����� ������
?>
<? $numberFilter=0; ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE')); 
    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
      $numberFilter++;
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogType["NAME"]?></b></nobr></a></div>
	  <div class="catalog-item-title" style="font-size: 13px;">
            <nobr>
	    <!--?
		if($itemCatalogType["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?-->
	    <?
		if($itemCatalogType['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($itemCatalogType['UF_FABRIKA']);
      	        if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	    </nobr></div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($itemCatalogType["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($itemCatalogType["UF_HIT"]) echo("<span id='hit'>HIT</span>");  elseif($itemCatalogType["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
<?
  }
?>
<?endif?>

<!-- ���������� ��������� � ������� SECTION_ID 679 � 826 -->
<?if($section==58):?>
<?
  $id=array(679, 826);
  for( $i=0; $i<count($id); $i++)
  {
 	$arFilter = array_merge(Array('ACTIVE' => 'Y', 'IBLOCK_ID' => 5, 'ID' => $id[$i]), $arFilterDop);
	$catalogPhoto=CIBlockSection::GetList(array(), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE'));
	
	while($ar_catalogPhoto=$catalogPhoto->GetNext()) 
    	{
  	?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$ar_catalogPhoto['SECTION_PAGE_URL']?>"><?if($ar_catalogPhoto["PICTURE"]):?><? echo(ShowImage($ar_catalogPhoto["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$ar_catalogPhoto['SECTION_PAGE_URL']?>"><nobr><b><?=$ar_catalogPhoto["NAME"]?></b></nobr></a></div>
	  <div class="catalog-item-title" style="font-size: 13px;">
            <nobr>
	    <?
		if($ar_catalogPhoto['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($ar_catalogPhoto['UF_FABRIKA']);
      	        if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	    </nobr></div>
	  <div style='position: relative; top: -175px; left: -3px;'><?if($ar_catalogPhoto["UF_NEWCATALOG"]) echo("<span id='new'>NEW</span>"); elseif($ar_catalogPhoto["UF_HIT"]) echo("<span id='hit'>HIT</span>");  elseif($ar_catalogPhoto["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<span id='lable'>&nbsp;</span>");?></div>
	</div>
  <?}?>
	<?}?>
<?endif?>
<!-- ����� ���������� ��������� � ������� -->


</div>

<? if(($numberFilter==0) && (($CURRENT_DEPTH==2) || $fabrika)) echo("<p style='padding-left: 5px; font-size: 16px;'>&ndash;&nbsp;�������� � ������ ��������� ��� �� �������.</p>"); ?>

<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text"><div style="margin-left:-10px;"><?=$page_title?></div><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>

<?if($arResult["SECTION"]["DESCRIPTION"]&&$CURRENT_DEPTH==2):?><div class="catalog-item-text"><h1><?=$arResult["SECTION"]["NAME"]?></h1><?=$arResult["SECTION"]["DESCRIPTION"]?></div><?endif?>


<!-- ����� ������ ��������� �� ����� -->

<?$APPLICATION->SetTitle($window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "������� ".$keywords.", ".$keywords.", ".$keywords." ����, ".$keywords." ������");?>

