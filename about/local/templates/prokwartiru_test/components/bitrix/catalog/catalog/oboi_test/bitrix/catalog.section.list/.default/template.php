<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$fabrika=$_REQUEST["FABRIKA_ID"];
	$section=$_REQUEST["SECTION_ID"];
	$filter_price=$_REQUEST["PRICE_ID"];
	$filter_width=$_REQUEST["WIDTH_ID"];
	$filter_type=$_REQUEST["TYPE"]; 
	$filter_discounts=$_REQUEST["DISCOUNTS"]; 
	$numberFilter=0;
	$IBLOCK_ID=1;
	$arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/oboi/") $IBLOCK_ID=5; /* ���� */
	if($arSite=="/catalog/") $IBLOCK_ID=4; /* ���� */
	if($arSite=="/catalog/plitka/") $IBLOCK_ID=4; /* ������ */
	if($arSite=="/catalog/mosaic/") $IBLOCK_ID=10; /* ������� */
	if($arSite=="/catalog/lepnina/") $IBLOCK_ID=20; /* ������� */
	if($arSite=="/catalog/curtains/") $IBLOCK_ID=11; /* ����� */
	if($arSite=="/catalog/floor/") $IBLOCK_ID=24; /* ����� */

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
	//if($SECTION_ID=="1266") $IBLOCK_ID=20; /* ������� */
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
      if($country=GetIBlockSection($ar_itemFabrika['IBLOCK_SECTION_ID'], 'catalog')) $page_title=$page_title.". <span style='font-size: 80%;'>".$country['NAME']."</span>"; 
      if(($ar_itemFabrika['NAME']=="Loymina")||($fabrika['NAME']=="Seabrook")) $page_title=$page_title."<a href='/about/delivery/'><img src='".SITE_TEMPLATE_PATH."/images/free.png' title='���������� ��������' alt='���������� ��������'  style='width:145px; height:30px; margin-bottom:-5px; margin-left:30px;' /></a>";
    }   
  $page_title=$page_title."</h1>"; 
  $window_title="���� ".$ar_itemFabrika['NAME']." (".$country['NAME'].")";
  $description=$window_title;
  $keywords="���� ".$ar_itemFabrika['NAME'];
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
if($section&&$section!=1) $arFilterDop=array_merge($arFilterDop, Array('SECTION_ID'=>$section));
if($filter_price) $arFilterDop=array_merge($arFilterDop, Array('UF_PRICE'=>$filter_price));
if($filter_width) $arFilterDop=array_merge($arFilterDop, Array('UF_WIDTH'=>$filter_width));
if($filter_type=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($filter_type=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
//global $arFilterDop;
$arFilter = array_merge($arFilterMain, $arFilterDop);
// ����� ������
?>
  <?

    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_DISCOUNT5', 'UF_SALE_OBOI', 'UF_ACTION')); //'left_margin'=>'asc'
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {
      $numberFilter++;
$saleID="";
$sale="";
$saleID=$itemCatalogFabrika['UF_SALE_OBOI'];
if($saleID){
  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_OBOI"));
    if($ar_res = $res->GetNext())
      $sale=$ar_res["VALUE"];
  //if($sale=="���") $sale="";
}
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
	  <div  class="catalog-item-title" style="font-size: 13px;">
	    <?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?>
	  </div>
	  <div style='position: relative; top: -175px; left: -3px; float:left;'><? if($sale) echo("<span id='sale'>SALE ".$sale."</span>");  elseif($itemCatalogFabrika["UF_ACTION"]) echo("<span id='sale' style='background-color:#ffce0c;'>������ ����</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT5"]) echo("<span id='sale'>-5%</span>"); elseif($itemCatalogFabrika["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<div style='left: -3px; width:0px;'><span id='lable'>&nbsp;</span></div>");?></div>
        <?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<div style='position: relative; top: -175px; left:-3px; float:left;'><span id='new'>NEW</span></div>"); ?>
	<?if($itemCatalogFabrika["UF_HIT"]) echo("<div style='position: relative; top: -175px; left:-3px;'><span id='hit'>HIT</span></div>"); ?>
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
    if($section==1) $window_title="���� ";
    $description=$window_title;
    $keywords=$arResult["SECTION"]["NAME"];
  ?>
<?
// ������
if($section!=1) $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => $section);
else $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'SECTION_ID' => Array(42, 43, 44, 45, 46, 48, 49, 50, 58));
$arFilterDop=Array();
//global $arFilterDop;
if($filter_discounts) $arFilterDop=array_merge($arFilterDop, Array('UF_SALE_OBOI'=>array(46, 47, 48, 49, 50, 51, 52, 69) ) );
if($filter_price) $arFilterDop=array_merge($arFilterDop, Array('UF_PRICE'=>$filter_price));
if($filter_width) $arFilterDop=array_merge($arFilterDop, Array('UF_WIDTH'=>$filter_width));
if($filter_type=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($filter_type=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
$arFilter = array_merge($arFilterMain, $arFilterDop);
// ����� ������
?>



<!-- ������ ��� -->
<?  if($filter_discounts&&($section==1)) {
      $arFilterDiscountOfDay = array_merge($arFilterMain, Array('UF_DISCOUNT10'=>true));
      //$arFilterDiscountOfDay = array_merge($arFilterMain, Array('UF_DISCOUNT5'=>true));

      $listCatalogDiscountOfDay=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilterDiscountOfDay , false, $arSelect=array('UF_FABRIKA', 'UF_DISCOUNT10'), Array('nPageSize'=>60));

    while($itemCatalogType=$listCatalogDiscountOfDay->GetNext()) 
    {
?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><b><nobr><?=$itemCatalogType["NAME"]?></nobr></b></a></div>
	  <div class="catalog-item-title" style="font-size: 13px;">
            <nobr>
	    <?
		if($itemCatalogType['UF_FABRIKA']) $fabrika_list = CIBlockElement::GetByID($itemCatalogType['UF_FABRIKA']);
      	        if($fabrika_item = $fabrika_list->GetNext())  echo $fabrika_item['NAME'];  
	    ?>
	    </nobr></div>
	  <div style='position: relative; top: -175px; left: -3px;'><span id='sale'><?if($itemCatalogType["UF_DISCOUNT10"]):?>-10%<?elseif($itemCatalogType["UF_DISCOUNT5"]):?>-5%<?endif?></span></div>
	</div>
<?
    }
}
?>
<!-- ����� ������ ��� -->

<? $numberFilter=0; ?>
  <?$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;?>
  <?
    //$listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_ACTION')); 

    $listCatalogType=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_DISCOUNT5', 'UF_SALE_OBOI', 'UF_ACTION'), Array('nPageSize'=>60)); 
    $NAV_STRING = $listCatalogType->GetPageNavStringEx($navComponentObject,  "������", "orange");

    while($itemCatalogType=$listCatalogType->GetNext()) 
    {
      $numberFilter++;
$saleID="";
$sale="";
$saleID=$itemCatalogType["UF_SALE_OBOI"];
if($saleID){
  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_OBOI"));
    if($ar_res = $res->GetNext())
      $sale=$ar_res["VALUE"];
  //if($sale=="���") $sale="";
}
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><?if($itemCatalogType["PICTURE"]):?><? echo(ShowImage($itemCatalogType["PICTURE"], 150, 150, "border='0' title='������� �������'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="������� �������"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogType['SECTION_PAGE_URL']?>"><b><nobr><?=$itemCatalogType["NAME"]?></nobr></b></a></div>
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
	  <div style='position: relative; top: -175px; left:-3px; float:left;'><?if($sale) echo("<span id='sale'>SALE</span><span id='sale'>".$sale."</span>"); elseif($itemCatalogType["UF_ACTION"]) echo("<span id='sale' style='background-color: #ffce0c;'>������ ����</span>");  elseif($itemCatalogType["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogType["UF_DISCOUNT5"]) echo("<span id='sale'>-5%</span>"); elseif($itemCatalogType["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<div style='left: -3px; width:0px;'><span id='lable'></span></div>");?></div>

	  <?if($itemCatalogType["UF_NEWCATALOG"]) echo("<div style='position: relative; top: -175px; left:-3px; float:left;'><span id='new'>NEW</span></div>"); ?>
	  <?if($itemCatalogType["UF_HIT"]) echo("<div style='position: relative; top: -175px; left:-3px;'><span id='hit'>HIT</span></div>"); ?>
	</div>
<?
  }
?>
<?endif?>
</div>

<? if(($numberFilter==0) && (($CURRENT_DEPTH==2) || $fabrika)) echo("<p style='padding-left: 10px; line-height: 150%; font-size: 16px;'>��� ��������� ���������� �� ������ ������� ��������� ���������<br />�� ���������: 8 (985) 155 1755 ��� 8 (985) 118 1755.</p>"); ?>

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>
<!--?
        $arButtons = CIBlock::GetPanelButtons(
            $ar_itemFabrika["IBLOCK_ID"],
            $ar_itemFabrika["ID"],
            0,
            array("SECTION_BUTTONS"=>false, "SESSID"=>false)
        );
        $ar_itemFabrika["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $ar_itemFabrika["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
?-->
<!--? $this->AddEditAction($ar_itemFabrika['ID'], $ar_itemFabrika['EDIT_LINK'], CIBlock::GetArrayByID("6", "ELEMENT_EDIT")); ?-->
<? $this->AddEditAction($ar_itemFabrika['ID'], $ar_itemFabrika['EDIT_LINK'], CIBlock::GetArrayByID($ar_itemFabrika["IBLOCK_ID"], "SECTION_EDIT"));?>
<?if($ar_itemFabrika['PREVIEW_TEXT']):?><div class="catalog-item-text" id="<?=$this->GetEditAreaId($ar_itemFabrika['ID']);?>><div style="margin-left:-10px;"><?=$page_title?></div><?=$ar_itemFabrika['PREVIEW_TEXT']?></div><?endif?>

<?if($arResult["SECTION"]["DESCRIPTION"]&&$CURRENT_DEPTH==2):?><div class="catalog-item-text"><h1><?=$arResult["SECTION"]["NAME"]?></h1><?=$arResult["SECTION"]["DESCRIPTION"]?></div><?endif?>


<!-- ����� ������ ��������� �� ����� -->
<!-- ����������� -->
<?$window_title=$window_title." � ��������-�������� www.prokwarti.ru";?>
<?
switch ($section) {
    case 43:
        $window_title="������������ ���� � ������- ������ ���� ��� �������� �������� � �������� ��������";
        break;
    case 42:
        $window_title="��������� ���� � ������- ������ ���� ��� �������� �������� � �������� ��������";
        break;
    case 58:
        $window_title="������� ���� � ������- ������ ���� ��� ��������� � ������� � �������� ��������";
        break;
    case 46:
        $window_title="�������� ���� � ������- ������ ���� ��������: ����, ����, �������";
        break;
}
switch ($fabrika) {
    case 11194:
        $window_title="Architects paper � ������- ������ ���� Architects paper ��������: ����, ����, �������";
        break;
    case 153:
        $window_title="Bn international � ������ - ������ ���� bn international ��������: ����, ����, �������";
        break;
    case 10490:
        $window_title="Chesapeake � ������ - ������ ���� Chesapeake ��������: ����, ����, �������";
        break;
    case 18646:
        $window_title="Grandeco � ������ - ������ ���� grandeco ��������: ����, ����, �������";
        break;
    case 149:
        $window_title="Hookedonwalls � ������ - ������ ���� hookedonwalls ��������: ����, ����, �������";
        break;
    case 3682:
        $window_title="kt exclusive � ������ - ������ ���� kt exclusive ��������: ����, ����, �������";
        break;
    case 1246:
        $window_title="limonta � ������ - ������ ���� limonta ��������: ����, ����, �������";
        break;
    case 156:
        $window_title="lincrusta � ������ - ������ ���� lincrusta ��������: ����, ����, �������";
        break;
    case 158:
        $window_title="loymina � ������ - ������ ���� loymina ��������: ����, ����, �������";
        break;
    case 2060:
        $window_title="Portofino � ������ - ������ ���� portofino ��������: ����, ����, �������";
        break;
    case 500:
        $window_title="Rasch textil � ������ - ������ ���� rasch textil ��������: ����, ����, �������";
        break;
    case 8854:
        $window_title="Seabrook � ������ - ������ ���� seabrook ��������: ����, ����, �������";
        break;
    case 13201:
        $window_title="Sergio rossellini � ������ - ������ ���� sergio rossellini ��������: ����, ����, �������";
        break;
    case 2326:
        $window_title="Texdecor � ������ - ������ ���� texdecor ��������: ����, ����, �������";
        break;
    case 152:
        $window_title="������������ ���� wallquest - ������  wallquest�� ������: ����, ����, �������";
        break;
    case 2346:
        $window_title="York � ������ - ������ ���� york ��������: ����, ����, �������";
        break;
    case 154:
        $window_title="���� Marburg � ������- ������ ���� ������� ��� �������� ��� ����: ����, ����";
        break;
    case 3311:
        $window_title="���� as creation � ������- ������ ���� ��������: ����, ����, �������";
        break;
    case 142:
        $window_title="����������� ���� zambaiti � ������- ������ zambaiti ��������: ����, ����, �������";
        break;
    case 157:
        $window_title="������� ����� sirpi  � ������- ������ ���� sirpi ������: ����, ����";
        break;
}
//if($section==1) $window_title="���� ";
?>

<?$APPLICATION->SetTitle($window_title);?>
<?$APPLICATION->SetPageProperty("description", $description." � ��������-�������� www.prokwarti.ru");?>
<?$APPLICATION->SetPageProperty("keywords", "������� �����, ".$keywords.", ".$keywords." ����, ".$keywords." ������");?>

