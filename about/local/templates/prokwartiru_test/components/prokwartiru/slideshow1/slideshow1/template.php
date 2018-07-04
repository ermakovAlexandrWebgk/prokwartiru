<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/js/slideshow/jquery.js"></script>
<script type="text/javascript" src="/js/slideshow/fadeSlideShow.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#slideshow').fadeSlideShow();
});
</script>

<div id="top"> 	 
  <h1>Слайдшоу</h1>
</div>

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
<!-- Кнопки -->
<table cellpadding="0" cellspacing="20" border="0">
    <tr>
        <td style="width: 110px;"><b>Обои в интерьере</b></td>
        <td><table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px;"><tr><td style="width: 110px; padding-left: 3px;">Мы предлагаем</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="set1" value="1" <?if($SET=="1"):?>checked<?endif?> onclick="javascript:{document.location=document.location.pathname+'?IBLOCK_ID=<?=$IBLOCK_ID?>'+'&SET=<?if($SET!="1"):?>1<?endif?>';}"></td></tr></table></td>
        <td><table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px;"><tr><td style="width: 110px; padding-left: 3px;">Только новинки</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="new" value="new" <?if($TYPE=="new"):?>checked<?endif?> onclick="javascript:{document.location=document.location.pathname+'?IBLOCK_ID=<?=$IBLOCK_ID?>'+'&SECTION_ID=<?=$SECTION_ID?>'+'&FABRIKA_ID=<?=$FABRIKA_ID?>'+'&TYPE=<?if($TYPE!="new"):?>new<?endif?>';}"></td></tr></table></td>
        <td><table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px;"><tr><td style="width: 110px; padding-left: 3px;">Лидеры продаж</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="hit" value="hit" <?if($TYPE=="hit"):?>checked<?endif?> onclick="javascript:{document.location=document.location.pathname+'?IBLOCK_ID=<?=$IBLOCK_ID?>'+'&SECTION_ID=<?=$SECTION_ID?>'+'&FABRIKA_ID=<?=$FABRIKA_ID?>'+'&TYPE=<?if($TYPE!="hit"):?>hit<?endif?>';}"></td></tr></table></td></td>
   </tr>
</table>
<br />
<!-- Конец Кнопки -->

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
<? $flag=false;?>
<div id="slideshowWrapper"> 
    <ul id="slideshow">
<? foreach($sectionIDs as $sectionID){?>
<? $section=GetIBlockSection($sectionID, 'catalog');?>
<!--? while($section=$listCatalog->GetNext()){?-->
<? $interiersNumber=100;?>
<?if($section){
   $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "STYLE"); 
   if($IBLOCK_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section), false, array("nPageSize"=>$interiersNumber), $arSelect);
   //if($iblock_ID==5) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section['ID']), false, array("nPageSize"=>$interiersNumber), array());
   if($IBLOCK_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array());
}
?>
<?if($Interiers):?>
    <?while($arInterier = $Interiers->GetNext()){
	$arInterierPathPreview = CFile::GetPath($arInterier["DETAIL_PICTURE"]);
	$arInterierPathDetail = CFile::GetPath($arInterier["DETAIL_PICTURE"]);

        $type=GetIBlockElement($arInterier["IBLOCK_SECTION_ID"], 'catalog');
        $types = CIBlockSection::GetByID($arInterier["IBLOCK_SECTION_ID"]);
           if($arType = $types->GetNext()) $type_name=$arType['NAME'];

        $resCatalog = CIBlockElement::GetProperty($arInterier['IBLOCK_ID'], $arInterier["ID"], array(), array("CODE"=>"CATALOG"));
        if($arCatalog  = $resCatalog ->Fetch())
           $CatalogID = $arCatalog["VALUE"];
        $resStyle = CIBlockElement::GetProperty($arInterier['IBLOCK_ID'], $arInterier["ID"], array(), array("CODE"=>"STYLE"));
        if($arStyle = $resStyle ->Fetch())
           $StyleID = $arStyle["VALUE"];
        //$arProps = $arInteriers->GetProperty("CATALOG"); 
        //$ttt=$arProps['PROPERTIES']['CATALOG']['VALUE'];
    ?>
        <li style="text-align:center;"><div><img src="<?=$arInterierPathDetail?>" alt="<?=$arInterier['NAME']?>" border="0" /></div><p><?=$type_name?> (<?=$StyleID?>): <b><a href="/catalog/oboi/index.php?SECTION_ID=<?=$CatalogID?>"><?=$arInterier['NAME']?></a></b></p></li>
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
