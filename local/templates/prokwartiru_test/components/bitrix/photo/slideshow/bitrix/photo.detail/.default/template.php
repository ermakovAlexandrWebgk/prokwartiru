<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<!-- -------------------------------------------------------- -->

<script type="text/javascript" src="/js/slideshow/jquery.js"></script>
<script type="text/javascript" src="/js/slideshow/fadeSlideShow.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#slideshow').fadeSlideShow({
        });
});
</script>

<? $interiersNumber=100;?>
<?
   $IBLOCK_ID="";
   $SECTION_ID="";
   $FABRIKA_ID="";
   $ELEMENT_ID="";
   $TYPE="";
   if($_REQUEST['SECTION_ID']==1869) $IBLOCK_ID=5; /* обои */
   if($_REQUEST['SECTION_ID']) $SECTION_ID=$_REQUEST['SECTION_ID'];
   if($_REQUEST['FABRIKA_ID']) $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];
   if($_REQUEST['ELEMENT_ID']) $ELEMENT_ID=$_REQUEST['ELEMENT_ID'];
   if($_REQUEST['TYPE']) $TYPE=$_REQUEST['TYPE'];
?>

<?
        $num_sections=0;
        $resCatalog = CIBlockElement::GetProperty(21, $ELEMENT_ID, array(), array("CODE"=>"CATALOG"));
        while($arCatalog  = $resCatalog ->Fetch()){
           $sectionIDs[$num_sections] = $arCatalog["VALUE"];
           $num_sections++;
        }
?>
<?
        $num_interiers=0;
        $resInterier = CIBlockElement::GetProperty(21, $ELEMENT_ID, array(), array("CODE"=>"INTERIER"));
        while($arInterier  = $resInterier ->Fetch()){
           $interierIDs[$num_interiers] = $arInterier["VALUE"];
           $num_interiers++;
        }
?>
<?
        // ФИЛЬТР
        $arFilterMain=Array('ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID);
        $arFilterDop=Array();
        if($TYPE=="new") $arFilterDop=array_merge($arFilterDop, Array('UF_NEWCATALOG'=>true));
        if($TYPE=="hit") $arFilterDop=array_merge($arFilterDop, Array('UF_HIT'=>true));
        $arFilter = array_merge($arFilterMain, $arFilterDop);
        // Конец ФИЛЬТР
?>

<!-- Интерьеры -->
<? $flag=false;?>
<div id="slideshowWrapper"> 
        <ul id="slideshow">

<!-- Вывод интерьеров -->
<?
        $i=0; 
        while ($i<$num_interiers) { 
          $arInterier = false;
          if($arInterier = GetIBlockElement($interierIDs[$i], 'catalog')) {
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
?>
                <li style="text-align:center;"><div><img src="<?=$arInterierPathDetail?>" alt="<?=$arInterier['NAME']?>" border="0" /></div><p><?=$type_name?><!-- (<-?=$StyleID?->)-->: <b><a href="/catalog/oboi/index.php?SECTION_ID=<?=$CatalogID?>"><?=$arInterier['NAME']?></a></b></p></li>
<?
                $flag=true;
          }
          $i++;
        }
?>
<!-- Конец Вывод интерьеров -->


<? foreach($sectionIDs as $sectionID){?>
<? $section=GetIBlockSection($sectionID, 'catalog');?>

<?if($section){
   $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "STYLE"); 
   if($IBLOCK_ID==5) $Interiers = CIBlockElement::GetList(array("sort"=>"asc"), array('IBLOCK_ID' => 9, 'PROPERTY_CATALOG' => $section), false, array("nPageSize"=>$interiersNumber), $arSelect);
   if($IBLOCK_ID==4) $Interiers = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 9, 'PROPERTY_INTERIER' => $section['ID']), false, array());
}
?>
<?if($Interiers):?>
    <?while($arInterier = $Interiers->GetNext()){
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
    ?>
        <li style="text-align:center;"><div><img src="<?=$arInterierPathDetail?>" alt="<?=$arInterier['NAME']?>" border="0" /></div><p><?=$type_name?><!-- (<-?=$StyleID?->)-->: <b><a href="/catalog/oboi/index.php?SECTION_ID=<?=$CatalogID?>"><?=$arInterier['NAME']?></a></b></p></li>
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