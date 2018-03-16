<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- Всплывание карточки товара -->
<!--?if($bHasPicture):?-->
<script type="text/javascript">

function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return title;
}
$(function() {
	$('div.item-image a').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,
		'overlayShow': false,
		'cyclic' : true,
		'padding': 20,
		'titlePosition': 'inside',
		'titleFormat': formatTitle
	});
});
</script>
<!--?endif;?-->
<!-- Конец Всплывания карточки товара -->

<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>
<? $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>
<? $STYLE_ID=$_REQUEST['STYLE_ID'];?>
<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $SECTION_TOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>
<?
     $arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; } /* обои */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) { $FABRIKI_TYPE_ID=78; $TYPE_ID=4; } /* плитка */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) { $FABRIKI_TYPE_ID=759; $TYPE_ID=17; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* свет */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==1317||$SECTION_TOP==1317)) { $FABRIKI_TYPE_ID=140; $TYPE_ID=10; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* мозаика */
?>

<?$numberElements=0;?>

<!-- Список по ФАБРИКАМ -->
<?if($FABRIKA_ID):?>
<?    
    $arFilter = Array('IBLOCK_ID'=>$TYPE_ID, 'UF_FABRIKA' => $FABRIKA_ID); // Фильтр по ФАБРИКАМ
    //$listCatalogFabrika = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
    $listCatalogFabrika = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
    while($itemCatalogFabrika = $listCatalogFabrika->GetNext()){   
?>
  <div class="item-info">
	<div class="item-desc">			
	<!-- Картинка со всплывающей карточкой товара -->
	<?
	if(CModule::IncludeModule("iblock"))
	{
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$itemCatalogFabrika['ID']);
	   $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
	
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>20), $arSelect);

	   $NAV_STRING = $items->GetPageNavStringEx($navComponentObject,  "Товары", "orange");

   	   while($arItem = $items->GetNext())
   	   {

      	     //$path_pic_preview=CFile::GetPath($arItem["PREVIEW_PICTURE"]);
	     $path_pic_detail=CFile::GetPath($arItem["DETAIL_PICTURE"]);
		$arSite = $APPLICATION->GetCurDir();
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* обои */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* плитка */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* свет */
?>

<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- Заголовок -->
       <? if($path) $text_title="<a href='".$path."index.php?SECTION_ID=".$itemCatalogFabrika['ID']."'><b><nobr>".$itemCatalogFabrika['NAME']."</nobr></b></a>"; else $text_title="<b><nobr>".$itemCatalogFabrika['NAME']."</nobr></b>";?>
       <div class="item-title" style="text-align: center;"><?=$text_title?><?=$sticker?></div>
       <!-- Конец Заголовок -->
	  <?$numberElements++;?>
       <div class="item-image">
	<a rel="catalog-detail-images" href="<?=$path_pic_detail?>" title="<?=$text_title?>"><img src="<?=$path_pic_detail?>" width="125px" height="125px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" id="catalog_list_image_<?=$arItem['ID']?>" /></a>
       </div>
      </div><!-- catalog-interier-card -->
<!--? $arParams["DISPLAY_BOTTOM_PAGER"]=true;?-->
<?endif?>
<?
   }
}
?>

<!-- Конец Всплывающая картинка -->
        </div>
  </div> <!-- Конец item-info -->

<? 
  }
?>

<div style="clear: both;"><br />

</div>

<div id="page_navigation">
  <!--?$res->NavPrint("Товары ", false, "", "orange");?-->
  <? echo($NAV_STRING); ?>
  <!--?if($arParams["DISPLAY_BOTTOM_PAGER"]):?->
	<-?=$arResult["NAV_STRING"];?->
  <-?endif;?-->
</div>

<!-- Ambu -->
<?    
    $interierList=array();
    $arFilter = Array('IBLOCK_ID'=>$TYPE_ID, 'UF_FABRIKA' => $FABRIKA_ID); // Фильтр по ФАБРИКАМ
    $listCatalogFabrika = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
    $i=0;
    while($itemCatalogFabrika = $listCatalogFabrika->GetNext()){   
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$itemCatalogFabrika['ID']);
	   $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array(), $arSelect);
   	   while($arItem = $items->GetNext()){
	      $interierList[i]= $arItem; 
	      $i++;
	   }	
    }
    echo ("i=".$i); echo count($interierList);
?>

<?    
    $arFilter = Array('IBLOCK_ID'=>$TYPE_ID, 'UF_FABRIKA' => $FABRIKA_ID); // Фильтр по ФАБРИКАМ
    //$listCatalogFabrika = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
    $listCatalogFabrika = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
    while($itemCatalogFabrika = $listCatalogFabrika->GetNext()){   
?>
  <div class="item-info">
	<div class="item-desc">
	<!-- Картинка со всплывающей карточкой товара -->
	<?
	if(CModule::IncludeModule("iblock"))
	{
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$itemCatalogFabrika['ID']);
	   $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
	
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>20), $arSelect);

	   $NAV_STRING = $items->GetPageNavStringEx($navComponentObject,  "Товары", "orange");

   	   while($arItem = $items->GetNext())
   	   {

      	     //$path_pic_preview=CFile::GetPath($arItem["PREVIEW_PICTURE"]);
	     $path_pic_detail=CFile::GetPath($arItem["DETAIL_PICTURE"]);
		$arSite = $APPLICATION->GetCurDir();
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* обои */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* плитка */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* свет */
?>

<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- Заголовок -->
       <? if($path) $text_title="<a href='".$path."index.php?SECTION_ID=".$itemCatalogFabrika['ID']."'><b><nobr>".$itemCatalogFabrika['NAME']."</nobr></b></a>"; else $text_title="<b><nobr>".$itemCatalogFabrika['NAME']."</nobr></b>";?>
       <div class="item-title" style="text-align: center;"><?=$text_title?><?=$sticker?></div>
       <!-- Конец Заголовок -->
	  <?$numberElements++;?>
       <div class="item-image">
	<a rel="catalog-detail-images" href="<?=$path_pic_detail?>" title="<?=$text_title?>"><img src="<?=$path_pic_detail?>" width="125px" height="125px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" id="catalog_list_image_<?=$arItem['ID']?>" /></a>
       </div>
      </div><!-- catalog-interier-card -->
<!--? $arParams["DISPLAY_BOTTOM_PAGER"]=true;?-->
<?endif?>
<?
   }
}
?>

<!-- Конец Всплывающая картинка -->
        </div>
  </div> <!-- Конец item-info -->

<? 
  }
?>

<div style="clear: both;"><br />

</div>

<div id="page_navigation">
  <!--?$res->NavPrint("Товары ", false, "", "orange");?-->
  <? echo($NAV_STRING); ?>
  <!--?if($arParams["DISPLAY_BOTTOM_PAGER"]):?->
	<-?=$arResult["NAV_STRING"];?->
  <-?endif;?-->
</div>

<!-- End Ambu -->







<?else:?>
<!-- Фильтр по ВИДАМ -->

<div class="catalog-interier-cards">
<?
foreach ($arResult['ITEMS'] as $key => $arElement):
if(($STYLE_ID=="")||($arElement["PROPERTIES"]["STYLE"]["VALUE_ENUM_ID"]==$STYLE_ID)){
	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>
	<div class="_catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
	<div class="catalog-interier-card">

<!-- Ссылка на каталог -->
<?
	if($arElement['PROPERTIES']['CATALOG']['VALUE']) $arSite="/catalog/oboi/index.php?SECTION_ID=".$arElement['PROPERTIES']['CATALOG']['VALUE']; 
	elseif($arElement['PROPERTIES']['INTERIER']['VALUE']) $arSite="/catalog/plitka/index.php?SECTION_ID=".$arElement['PROPERTIES']['INTERIER']['VALUE'];
	elseif($arElement['PROPERTIES']['CATALOG_LIGHTS']['VALUE']) $arSite="/catalog/lights/index.php?SECTION_ID=".$arElement['PROPERTIES']['CATALOG_LIGHTS']['VALUE'];
?>
<!-- Конец Ссылка на каталог -->

<!-- Заголовок -->
  <div class="item-title" style="text-align: center;"><?if($arSite):?><a href=<?=$arSite?>><?endif?><b><nobr><?=$arElement["NAME"]?></nobr></b><?if($arSite):?></a><?endif?><?=$sticker?></div>
<!-- Конец Заголовок -->

  <div class="item-info">
	<div class="item-desc">				
<!-- Картинка со всплывающей карточкой товара -->
<?if($bHasPicture):?>

<!-- Формируем Текст описания товара -->

<!-- Заголовок Название товара -->
<? $title=$arElement['NAME']; ?>
<?
	if($arSite) $title="<a href='".$arSite."'>".$arElement['NAME']."</a>";
	else $title=$arElement['NAME'];
?>
<!-- Конец Заголовок Название товара -->

<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td style='text-align: center;'><b class='big'>".$title."</b></td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->

<?$numberElements++;?>
<div class="item-image">
	<a rel="catalog-detail-images" href="<?=$arElement['DETAIL_PICTURE']['SRC']?>" title="<?=$title_text?>"><img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement['PREVIEW_IMG']['WIDTH']?>" height="<?=$arElement['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>" /></a>			
</div>
<!--? $arParams["DISPLAY_BOTTOM_PAGER"]=true;?-->
<?endif?>

<!-- Конец Всплывающая картинка -->


		</div> <!-- Конец item-info -->

	    </div> <!-- Конец catalog-interier-card -->


	</div> <!-- Конец catalog-item -->


    <!--div class="catalog-item-separator"></div-->
<?}?>
<?endforeach;?>




</div>

<div id="page_navigation">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>


<!-- Ambu -->


  <div class="item-info">
	<div class="item-desc">			
	<!-- Картинка со всплывающей карточкой товара -->
	<?
	if(CModule::IncludeModule("iblock"))
	{
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$SECTION_ID);
	   $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
	
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>40), $arSelect);

	   $NAV_STRING = $items->GetPageNavStringEx($navComponentObject,  "Товары", "orange");

   	   while($arItem = $items->GetNext())
   	   {

	        $path_pic_detail=CFile::GetPath($arItem["DETAIL_PICTURE"]);
		$arSite = $APPLICATION->GetCurDir();
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* обои */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* плитка */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* свет */
?>

<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- Заголовок -->
       <? if($path) $text_title="<a href='".$path."index.php?SECTION_ID=".$SECTION_ID."'><b><nobr>".$arItem['NAME']."</nobr></b></a>"; else $text_title="<b><nobr>".$arItem['NAME']."</nobr></b>";?>
       <div class="item-title" style="text-align: center;"><?=$text_title?><?=$sticker?></div>
       <!-- Конец Заголовок -->
	  <?$numberElements++;?>
       <div class="item-image">
	<a rel="catalog-detail-images" href="<?=$path_pic_detail?>" title="<?=$text_title?>"><img src="<?=$path_pic_detail?>" width="125px" height="125px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" id="catalog_list_image_<?=$arItem['ID']?>" /></a>
       </div>
      </div><!-- catalog-interier-card -->
<!--? $arParams["DISPLAY_BOTTOM_PAGER"]=true;?-->
<?endif?>
<?
   }
}
?>

<!-- Конец Всплывающая картинка -->
        </div>
  </div> <!-- Конец item-info -->

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>
<!-- End Ambu -->







<?endif;?>
<!-- Конец фильтрам -->

<? if($numberElements==0) echo("<p style='padding-left: 5px; font-size: 16px;'>&mdash;&nbsp;Интерьеры не найдены.</p>"); ?>




