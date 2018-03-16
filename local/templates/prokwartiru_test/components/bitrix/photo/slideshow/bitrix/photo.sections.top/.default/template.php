<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="slideshow">
<?$i=0;?>
<?foreach($arResult["SECTIONS"] as $arSection):?>
	<?foreach($arSection["ROWS"] as $arItems):?>
		<?foreach($arItems as $arItem):?>
			<?if($arItem["NAME"]):?><div class="menu-type-item"><?if($i!=0):?>&nbsp;<b>.</b><?endif?><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"<?if($_REQUEST["ELEMENT_ID"]==$arItem["ID"]):?>class="on"<?endif?>>
<nobr><?=$arItem["NAME"]?></nobr></a></div><?endif?>
			<?$i++;?>
		<?endforeach?>
	<?endforeach?>
<?endforeach;?>
</div>
