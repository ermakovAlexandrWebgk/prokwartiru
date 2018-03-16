<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && ($arItem["DEPTH_LEVEL"] < $previousLevel)):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="selected"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$previousLevel?><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

	<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

<li style="background:none; width: 150px; text-align: right; padding-top: 0px;">
<div class="menu-clear-left"></div>
<?$arSite = $APPLICATION->GetCurDir();?>            	
<?if($arSite!="/catalog/oboi/"):?>
<?$APPLICATION->IncludeComponent("bitrix:search.title", "search-top", array(
	"NUM_CATEGORIES" => "1",
	"TOP_COUNT" => "5",
	"ORDER" => "rank",
	"USE_LANGUAGE_GUESS" => "N",
	"CHECK_DATES" => "Y",
	"SHOW_OTHERS" => "N",
	"PAGE" => "#SITE_DIR#search/index.php",
	"CATEGORY_0_TITLE" => "Товары",
	"CATEGORY_0" => array(
		0 => "iblock_catalog",
	),
	"CATEGORY_0_iblock_catalog" => array(
		0 => "5",
		1 => "4",
		2 => "10",
		3 => "24",
		4 => "17",
		5 => "20",
		6 => "11",
		7 => "6",
	),
	"SHOW_INPUT" => "Y",
	"INPUT_ID" => "title-search-input",
	"CONTAINER_ID" => "title-search"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
<?else:?>
<div style="width:120px;">&nbsp;</div>
<?endif?> 
<!--?$APPLICATION->IncludeComponent("bitrix:search.form", "flat1", Array(
	"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
	),
	false
);?-->
</li>
<!--li><a href="/about/otzyvy/" class="<-?if ($arItem["SELECTED"]):?->root-item-selected<-?else:?->root-item<-?endif?->" title="<-?=GetMessage("MENU_ITEM_ACCESS_DENIED")?->">ОТЗЫВЫ</A></li-->
<li><a href="/advices/" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">СОВЕТЫ</a></li>
<li><a href="/catalog/interiers/" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">ИНТЕРЬЕРЫ</a></li>
</ul>

<?endif?>
