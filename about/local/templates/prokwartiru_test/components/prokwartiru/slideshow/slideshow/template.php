<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/js/slideshow/jquery.js"></script>
<script type="text/javascript" src="/js/slideshow/fadeSlideShow.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#slideshow').fadeSlideShow();
});
</script>

<?
   $IBLOCK_ID="5";
   $SECTION_ID="42";
   $FABRIKA_ID="";
   $SET="";
   $TYPE="";
   if($_REQUEST['IBLOCK_ID']) $IBLOCK_ID=$_REQUEST['IBLOCK_ID'];
   if($_REQUEST['SECTION_ID']) $SECTION_ID=$_REQUEST['SECTION_ID'];
   if($_REQUEST['FABRIKA_ID']) $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];
   if($_REQUEST['TYPE']) $TYPE=$_REQUEST['TYPE'];
   if($_REQUEST['SET']) $SET=$_REQUEST['SET'];
?>


<?if($SET):?>
<? $sectionIDs=array(1702, 1692, 882);?>
<?else:?>
<?
// ФИЛЬТР
$arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID);
$arFilterDop=Array();
if($TYPE=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
if($TYPE=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
$arFilter = array_merge($arFilterMain, $arFilterDop);
// Конец ФИЛЬТР
    //$listCatalog=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_FABRIKA', 'UF_NEWCATALOG', 'UF_HIT', 'UF_SALE'), Array("nPageSize"=>60));
echo($IBLOCK_ID);
echo("-");
echo($SECTION_ID);
    $listCatalog = GetIBlockSectionList($IBLOCK_ID, $SECTION_ID, array('left_margin'=>'asc'), 10, $arFilter);
    $i=0; 
    $sectionIDs=array();
    while ($section=$listCatalog->GetNext()) { 
      $sectionIDs[$i]=$section['ID'];
      //echo($sectionIDs[$i]." - ");
      $i++;
    }
?>
<?endif?>
<!-- Интерьеры -->
<!--? $sectionIDs=array(1702, 1692, 882);?-->
<?$sectionIDs=array(2031);?>
<? $flag=false;?>
<div id="slideshowWrapper"> 
    <ul id="slideshow">
<? foreach($sectionIDs as $sectionID){?>
<? $section=GetIBlockSection($sectionID, 'catalog');?>
<!--? while($section=$listCatalog->GetNext()){?-->
<? $interiersNumber=100;?>
<?if($section){
   $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "STYLE"); 
   if($IBLOCK_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $sectionID), false, array("nPageSize"=>$interiersNumber), $arSelect);
   //if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array("nPageSize"=>$interiersNumber), array());
   if($IBLOCK_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array());
}
?>
<?if($Interiers):?>
    <?while($arInterier = $Interiers->GetNext()){
	$arInterierPathPreview = CFile::GetPath($arInterier["DETAIL_PICTURE"]);
	$arInterierPathDetail = CFile::GetPath($arInterier["DETAIL_PICTURE"]);
        $StyleName = $arInterier["PROPERTIES"]["STYLE"]["VALUE"];
echo($StyleName);
        $type=GetIBlockElement($arInterier["IBLOCK_SECTION_ID"], 'catalog');
        $types = CIBlockSection::GetByID($arInterier["IBLOCK_SECTION_ID"]);
           if($arType = $types->GetNext()) $type_name=$arType['NAME'];

        $resCatalog = CIBlockElement::GetProperty($arInterier['IBLOCK_ID'], $arInterier["ID"], array(), array("CODE"=>"CATALOG"));
        if($arCatalog  = $resCatalog ->Fetch())
           $CatalogID = $arCatalog["VALUE"];
        $resStyle = CIBlockElement::GetProperty($arInterier['IBLOCK_ID'], $arInterier["ID"], array(), array("CODE"=>"STYLE"));
        if($arStyle = $resStyle ->Fetch()){
           $StyleID = $arStyle["VALUE"];
           $StyleName = "";
if($arStyle["VALUE"]){
  $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>9, "ID"=>$arStyle["VALUE"]));
  if($enum_fields = $property_enums->GetNext()) $StyleName = $enum_fields["VALUE"];
}        }
        //$arProps = $arInteriers->GetProperty("CATALOG"); 
        //$ttt=$arProps['PROPERTIES']['CATALOG']['VALUE'];
    ?>
        <li style="text-align:center;"><div><img src="<?=$arInterierPathDetail?>" alt="<?=$arInterier['NAME']?>" border="0" /></div><p><?=$type_name?> (<?=$StyleID?>-<?=$StyleName?>): <b><a href="/catalog/oboi/index.php?SECTION_ID=<?=$CatalogID?>"><?=$arInterier['NAME']?></a></b></p></li>
    <?
        $flag=true;
      }
    ?>
<?endif?>
<?}?>
  </ul>
  <br clear="all" />
<? if(!$flag) echo("<br /><p style='text-align: center;'>Нет интерьеров при заданном условии.</p>");?>
</div>
<!-- Конец Интерьеры -->
