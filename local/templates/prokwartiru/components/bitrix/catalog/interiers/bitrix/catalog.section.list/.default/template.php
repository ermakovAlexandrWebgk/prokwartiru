<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	//if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* ���� */
	//if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* ������ */
	//if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* ������� */
	//if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* ����� */
	if($arSite=="/catalog/interiers/") $IBLOCK_ID=9; /* ��������� */
?>

<?
  if(($arSite=="/catalog/fabriki/")&&(CModule::IncludeModule("iblock"))){
    if($_REQUEST["FABRIKA_ID"]) { 
      $arIBlockElement = GetIBlockElement($_REQUEST['FABRIKA_ID'], 'catalog');
      $arIBlockSection = GetIBlockSection($arIBlockElement['IBLOCK_SECTION_ID'], 'catalog');
      $SECTION_ID=$arIBlockSection['IBLOCK_SECTION_ID'];
	if($SECTION_ID=="51") $IBLOCK_ID=5; /* ���� */
	if($SECTION_ID=="78") $IBLOCK_ID=4; /* ������ */
	if($SECTION_ID=="140") $IBLOCK_ID=10; /* ������� */
	if($SECTION_ID=="141") $IBLOCK_ID=11; /* ����� */
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
      if($country=GetIBlockSection($ar_itemFabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title." .<span style='font-size: 80%;'>".$country['NAME']."</span>"; 
      if($ar_itemFabrika['NAME']=="Loymina") $page_title=$page_title." <span style='font-size: 12px;'>&nbsp;&nbsp;&mdash;&nbsp;���������� ��������</span>";
    }   
  $page_title=$page_title."</h1>"; 
  $window_title="���� ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $keywords="���� ".$ar_itemFabrika['NAME'];
  }
?>
<?=$page_title?>
<!-- ����� ��������� -->
<!-- ������ ��������� -->
<div class="catalog-item-list" >
<!-- ������ ��������� �� �������� -->
<?if($fabrika):?>
  <?    
    $arFilter = Array('IBLOCK_ID'=>5, 'UF_FABRIKA' => $fabrika);
    $listCatalogFabrika = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
    while($itemCatalogFabrika = $listCatalogFabrika->GetNext())
    {    
  ?>
	<div class="catalog-item" style="margin-bottom: 10px;">
<!-- ������� ��������� -->
	<div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='".$itemCatalogFabrika["NAME"]."'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px"><?endif?></a></div>
<!-- ����� ������� ��������� -->
	</div>
<?
  }
?>

<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text"><div style="margin-left:-10px;"><?=$page_title?></div><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>

<!-- ����� ������ ��������� �� �������� -->

<!-- ������ ��������� �� ����� -->
<?else:?>
  <!--h1><-?=$arResult["SECTION"]["NAME"]?-></h1-->
  <?
    $window_title=$arResult["SECTION"]["NAME"];
    $keywords=$arResult["SECTION"]["NAME"];
  ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section), false, $arSelect); 
    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
  ?>
	<div class="catalog-item" style="margin-bottom: 10px;">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='".$itemCatalogType["NAME"]."'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px"><?endif?></a></div>
	  <!--div class="catalog-item-title">&nbsp;</div-->	  
	</div>
<?
  }
?>

<!-- ����� ������ ��������� �� ����� -->
<?endif?>
</div>

<?if($arResult["SECTION"]["DESCRIPTION"]&&$CURRENT_DEPTH==2):?><div class="catalog-item-text"><h1><?=$arResult["SECTION"]["NAME"]?></h1><?=$arResult["SECTION"]["DESCRIPTION"]?></div><?endif?>

<?$APPLICATION->SetTitle($window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("description", $window_title." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "������� �����, ".$keywords.", ".$keywords." ����, ".$keywords." ������");?>

