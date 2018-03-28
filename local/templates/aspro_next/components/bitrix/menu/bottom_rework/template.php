<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
        <div> <img class="menu_image <?if (isset($arItem["PARAMS"]["YANDEX"]) && $arItem["PARAMS"]["YANDEX"] == "Y"):?> yandex_reviews <?endif;?>" src="<?=$arItem["PARAMS"]["IMG"]?>">
			<li class="bottom_navigation"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </div>
				<ul>
		<?else:?>
        <div> <img class="menu_image <?if (isset($arItem["PARAMS"]["YANDEX"]) && $arItem["PARAMS"]["YANDEX"] == "Y"):?> yandex_reviews <?endif;?>" src="<?=$arItem["PARAMS"]["IMG"]?>">
			<li class="bottom_navigation"><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
            </div> 
				<ul>                      
		<?endif?>
        

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
             <div> <img class="menu_image <?if (isset($arItem["PARAMS"]["YANDEX"]) && $arItem["PARAMS"]["YANDEX"] == "Y"):?> yandex_reviews <?endif;?>" src="<?=$arItem["PARAMS"]["IMG"]?>">
				<li class="bottom_navigation"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                </div>
			<?else:?>
             <div> <img class="menu_image <?if (isset($arItem["PARAMS"]["YANDEX"]) && $arItem["PARAMS"]["YANDEX"] == "Y"):?> yandex_reviews <?endif;?>" src="<?=$arItem["PARAMS"]["IMG"]?>">
				<li class="bottom_navigation"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                </div>
			<?endif?>

		<?else:?>

			

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?> 

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>