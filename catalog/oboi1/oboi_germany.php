<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фабрики обоев в интернет-магазине prokwarti.ru");
?>
<div>
<a href="/catalog/oboi/search.php" class="poisk" >ПОДБОР 
    <br />
   ПО ПАРАМЕТРАМ</a> <?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"search",
	Array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "Y",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/search/index.php",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(0=>"iblock_catalog",),
		"CATEGORY_0_iblock_catalog" => array(0=>"5",1=>"4",2=>"10",3=>"24",4=>"17",5=>"20",6=>"6",7=>"11",),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> </div>
<div style="clear: both;"></div>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"type",
	Array(
		"ROOT_MENU_TYPE" => "sub",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "sub",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> 

<h1>Немецкие обои</h1>
<table style="width: 735px; margin-left:-10px;" border="0" cellspacing="0" cellpadding="0"> 
  <tbody> 
    <tr><td style="vertical-align: top;"> 
<? 
	$IBLOCK_ID="5"; /* обои по умолчанию */
	$COUNTRY_ID=60; /* немецкие */
        $FABRIKA_ID_LIST="";


   $items = GetIBlockElementList(6, $COUNTRY_ID, Array("name"=>"ASC"));
   while($arItem = $items->GetNext())
   {
    $FABRIKA_ID_LIST.=$arItem["ID"].",";
   }
//echo($FABRIKA_ID."<br />");
   $FABRIKA_ID_LIST=explode(",", $FABRIKA_ID_LIST);
   $arFilterCatalogFabrika= Array("UF_FABRIKA"=>$FABRIKA_ID_LIST);

   $arFilterFabrika = Array("GLOBAL_ACTIVE"=>"Y", "ACTIVE" => "Y", "IBLOCK_ID"=>$IBLOCK_ID, $arFilterCatalogFabrika);
   $i=0; $list=array();
   $listFabrika=CIBlockSection::GetList(Array(), $arFilterFabrika, true, Array("ID"));
   while($arFabrika = $listFabrika->GetNext()) {
    $FABRIKA_LIST.=$arFabrika["ID"].",";
   }
//ECHO($FABRIKA_LIST);
    $arFilter = Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID, 'UF_FABRIKA' => $FABRIKA_ID_LIST);
    $listCatalogFabrika=CIBlockSection::GetList(array('name'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE', 'UF_DISCOUNT10', 'UF_DISCOUNT5', 'UF_SALE_OBOI', 'UF_ACTION'));
    while($itemCatalogFabrika=$listCatalogFabrika->GetNext()) 
    {

$saleID="";
$sale="";
$saleID=$itemCatalogFabrika['UF_SALE_OBOI'];
if($saleID){
  $res = CUserFieldEnum::GetList(array(), array("ID" => $saleID, "FIELD_NAME" => "UF_SALE_OBOI"));
    if($ar_res = $res->GetNext())
      $sale=$ar_res["VALUE"];
  //if($sale=="нет") $sale="";
}
  ?>
	<div class="catalog-item">
	  <div class="catalog-item-image"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><?if($itemCatalogFabrika["PICTURE"]):?><? echo(ShowImage($itemCatalogFabrika["PICTURE"], 150, 150, "border='0' title='Открыть каталог'", "", true));?><?else:?><img src="<?=SITE_TEMPLATE_PATH?>/images/default150.gif" width="150px" height="150px" title="Открыть каталог"><?endif?></a></div>
	  <div class="catalog-item-title"><a href="<?=$itemCatalogFabrika['SECTION_PAGE_URL']?>"><nobr><b><?=$itemCatalogFabrika["NAME"]?></b></nobr></a></div>	  
	  <div  class="catalog-item-title" style="font-size: 13px;">
	    <?
		if($itemCatalogFabrika["IBLOCK_SECTION_ID"]) $type=CIBlockSection::GetByID($itemCatalogFabrika["IBLOCK_SECTION_ID"]);
		  if($ar_type=$type->GetNext())  echo $ar_type['NAME'];
	    ?>
	  </div>
	  <div style='position: relative; top: -175px; left: -3px; float:left;'><? if($sale) echo("<span id='sale'>SALE ".$sale."</span>");  elseif($itemCatalogFabrika["UF_ACTION"]) echo("<span id='sale' style='background-color:#ffce0c;'>ЛУЧШАЯ ЦЕНА</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT10"]) echo("<span id='sale'>-10%</span>"); elseif($itemCatalogFabrika["UF_DISCOUNT5"]) echo("<span id='sale'>-5%</span>"); elseif($itemCatalogFabrika["UF_SALE"]) echo("<span id='sale'>SALE</span>"); else echo("<div style='left: -3px; width:0px;'><span id='lable'>&nbsp;</span></div>");?></div>
        <?if($itemCatalogFabrika["UF_NEWCATALOG"]) echo("<div style='position: relative; top: -175px; left:-3px; float:left;'><span id='new'>NEW</span></div>"); ?>
	  <?if($itemCatalogFabrika["UF_HIT"]) echo("<div style='position: relative; top: -175px; left:-3px;'><span id='hit'>HIT</span></div>"); ?>  
         </div>
<?
  }
?>


<div style="clear: both;"></div>

 </td></tr>
   </tbody>
 </table>






 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>OCUMENT_ROOT"]."/bitrix/footer.php");?>