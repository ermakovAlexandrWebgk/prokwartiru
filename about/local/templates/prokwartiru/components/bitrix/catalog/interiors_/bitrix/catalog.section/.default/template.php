<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (count($arResult['ITEMS']) < 1)
	return;
?>

<!--?$sectionID=$_REQUEST['SECTION_ID'];?-->
<?$section=GetIBlockSection($_REQUEST['SECTION_ID'], 'catalog');?>

<div class="catalog-interier-cards">
<?
foreach ($arResult['ITEMS'] as $key => $arElement):

	//$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	//$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

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




<!-- Всплывание карточки товара -->
<?if($bHasPicture):?>
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
<?endif;?>
<!-- Конец Всплывания карточки товара -->
<!-- Ссылка на каталог -->
<?
	if($arElement['PROPERTIES']['CATALOG']['VALUE']) $arSite="/catalog/oboi/index.php?SECTION_ID=".$arElement['PROPERTIES']['CATALOG']['VALUE']; 
	elseif($arElement['PROPERTIES']['INTERIER']['VALUE']) $arSite="/catalog/plitka/index.php?SECTION_ID=".$arElement['PROPERTIES']['INTERIER']['VALUE'];
?>
<!-- Конец Ссылка на каталог -->

<!-- Заголовок -->
  <div class="item-title" style="text-align: center;"><?if($arSite):?><a href=<?=$arSite?>><?endif?><b><?=$arElement["NAME"]?></b><?if($arSite):?></a><?endif?><?=$sticker?></div>
<!-- Конец Заголовок -->

  <div class="item-info">
	<div class="item-desc">				
<!-- Картинка со всплывающей карточкой товара -->
<?if($bHasPicture):?>

<!-- Формируем Текст описания товара -->

<!-- Заголовок Название товара -->
<?
	if($arSite)	$title="<a href='".$arSite."'>".$arElement['NAME']."</a>";
	else $title=$arElement['NAME'];
?>
<!-- Конец Заголовок Название товара -->

<!-- Формирование и форматирование Описания для всплывающей карточки товара -->

	<?$title_text="<table cellspacing='0' cellpadding='0' border='0' class='float-card'><tr><td style='text-align: center;'><b class='big'>".$title."</b></td></tr></table>";?>

<!-- Конец Форматирования и описания -->

<!-- Конец Текст описания -->


<div class="item-image">
	<a rel="catalog-detail-images" href="<?=$arElement['DETAIL_PICTURE']['SRC']?>" title="<?=$title_text?>"><img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement['PREVIEW_IMG']['WIDTH']?>" height="<?=$arElement['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>" /></a>
				
</div>

<?endif;?>

<!-- Конец Всплывающая картинка -->


		</div>
	    </div>
	</div>
    <div class="catalog-item-separator"></div>
<?endforeach;?>
</div>

<div id="page_navigation">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>