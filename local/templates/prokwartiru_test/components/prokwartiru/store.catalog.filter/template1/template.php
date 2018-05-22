<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">

<?
foreach($arResult["ITEMS"] as $arItem)
	if(array_key_exists("HIDDEN", $arItem))
		echo $arItem["INPUT"];
?>


		<b class="r1"></b>
		<div class="catalog-item-filter-body-inner" style="margin-bottom: 20px;
margin-left: 16px;
background-color: #EFEFEF;
height: 360px;
padding-top: 8px;
margin-right: 20px;">

				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?if(!array_key_exists("HIDDEN", $arItem)):?>
						<div class="filter-<?=$arItem["TYPE"]?>"><?=$arItem["INPUT"]?></div>
					
					<?endif?>
				<?endforeach;?>
        <div class="filter-dropdown"><input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" /></div>
        <!-- <input type="hidden" name="set_filter" value="Y" />&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /> -->

		</div>
		<b class="r1"></b>


</form>

<script type="text/javascript">
	$(function () {
		$("#catalog_item_toogle_filter").click(function() {
			$("#catalog_item_filter_body").slideToggle();
		});
	});
</script>