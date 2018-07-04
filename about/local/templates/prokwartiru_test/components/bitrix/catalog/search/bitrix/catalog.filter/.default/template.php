<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form name="<?echo $arResult["FILTER_NAME"];?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table" cellspacing="0" cellpadding="2">
	<thead>
		<tr>
			<td colspan="2" align="center"><?=GetMessage("IBLOCK_FILTER_TITLE")?></td>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top"><?=$arItem["ID"]?>-<?=$arItem["CODE"]?>-<?=$arItem["NAME"]?>:</td>
					<td valign="top"><?=$arItem["INPUT"]?></td>
				</tr>
			<?endif?>
		<?endforeach;?>
<tr><td colspan="2"><?echo $arResult["FILTER_NAME"];?>---<?echo $arResult["FILTER_NAME"];?>---<?echo $arResult["FORM_ACTION"]?></td></tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				<input type="submit" name="set_filter" value="1" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /></td>
		</tr>
	</tfoot>
	</table>
</form>
