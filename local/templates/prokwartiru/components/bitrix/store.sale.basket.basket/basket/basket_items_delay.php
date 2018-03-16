<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="cart-items" id="id-shelve-list" style="display:none;">
	<div class="inline-filter cart-filter">
		<label><?=GetMessage("SALE_PRD_IN_BASKET")?>:</label>&nbsp;
			<a href="#" onclick="ShowBasketItems(1);"><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?> (<?=count($arResult["ITEMS"]["AnDelCanBuy"])?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=count($arResult["ITEMS"]["DelDelCanBuy"])?>)</strong>
			<?if(false):?>
				<a href="#" onclick="ShowBasketItems(3);"><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=count($arResult["ITEMS"]["nAnCanBuy"])?>)</a>
			<?endif;?>
	</div>
	<?if(count($arResult["ITEMS"]["DelDelCanBuy"]) > 0):?>
	<table class="cart-items-table" cellspacing="0" cellspacing="0">
		<tr class="cart-items-table-head">
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
			<?endif;?>
			<?if (in_array("VAT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-price"><?= GetMessage("SALE_VAT")?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
			<?endif;?>
	            <td><?= GetMessage('SALE_PRESENCE')?></td>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td><?= GetMessage("SALE_PRICE")?></td>
			<?endif;?>
			<td class="cart-item-actions">
				<?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
					<?= GetMessage("SALE_ACTION")?>
				<?endif;?>
			</td>
		</tr>
	<?
	$i=0;
	foreach($arResult["ITEMS"]["DelDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-name">
                            <a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>"><img style="margin: 0 0 10px;" src="<?=$arBasketItems["PREVIEW_PICTURE_SRC"]?>" width="100px" height="100px" /></a><br />
                            Арт. <a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>"><b><?=$arBasketItems["NAME"]?></b></a><br />
				<!--?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?-><a href="<-?=$arBasketItems["DETAIL_PAGE_URL"] ?->"><-?
				endif;
				?->
                            <img style="margin: 0 0 10px;" src="<-?=$arBasketItems['PREVIEW_PICTURE_SRC']?->" /><br />
				    Артикул: <b><-?=$arBasketItems["NAME"] ?-></b><-?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?-></a><-?
				endif;?-->
				<!--?if (in_array("PROPS", $arParams["COLUMNS_LIST"]))
				{
					foreach($arBasketItems["PROPS"] as $val)
					{
						echo "<br />".$val["NAME"].": ".$val["VALUE"];
					}
				}?-->
				</td>
			<?endif;?>
<?
$res = CIBlockElement::GetByID($arBasketItems["PRODUCT_ID"]);
if($ar_res = $res->GetNext())
{
  $PRODUCT_IBLOCK_ID=$ar_res["IBLOCK_ID"];
  $PRODUCT_ID=$ar_res["ID"];
}
$db_props = CIBlockElement::GetProperty($PRODUCT_IBLOCK_ID, $PRODUCT_ID, array("sort" => "asc"), Array("CODE"=>"UNIT"));
if($ar_props = $db_props->Fetch())
	$UNIT = $ar_props["VALUE_ENUM"];
else
	$UNIT = false;
if($UNIT=="рулон") $UNIT="рул.";
?>

			<?if (in_array("VAT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-price"><?=$arBasketItems["VAT_RATE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-discount"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-quantity"><?=$arBasketItems["QUANTITY"]?>&nbsp;&nbsp;<?=$UNIT;?></td>
			<?endif;?>
                    <td style="color: #d1670d;">
				<?$itemCatalog = CCatalogProduct::GetByID($arBasketItems["PRODUCT_ID"]);?>
                        <?if ($itemCatalog["QUANTITY"] > 0):?>
                            <strong>Есть на складе</strong>
                        <?else:?>
                            <strong>Под заказ</strong>
                        <?endif?>
                    </td>
                  <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
                       <?$price = split("\.", $arBasketItems["PRICE"]);?>
        				<td class="cart-item-price"><?=$price[0]?> <span class='rub'>руб.</span></td>
        		<?endif;?>
			<td class="cart-item-actions">
				<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
					<a class="cart-shelve-item_" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["add"])?>"><?=GetMessage("SALE_ADD_CART")?></a> /
				<?endif;?>
				<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
					<a class="cart-delete-item_" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>">Удалить</a>
				<?endif;?>
			</td>
		</tr>
		<?
	}
	?>
	</tbody>
</table>
	<?else:?>
		<?echo ShowNote(GetMessage("SALE_NO_ACTIVE_PRD_IN_BASKET_SHELVE"));?>
	<?endif;?>
</div>
<?