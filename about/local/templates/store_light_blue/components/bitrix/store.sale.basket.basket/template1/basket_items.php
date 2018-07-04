<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="cart-items" id="id-cart-list">
	<div class="inline-filter cart-filter">
		<label><?=GetMessage("SALE_PRD_IN_BASKET")?></label>&nbsp;
			<span class="ready"><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?> <strong>(<?=count($arResult['ITEMS']['AnDelCanBuy'])?>)</strong></span>&nbsp;
			<a href="#" onclick="ShowBasketItems(2);"><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=count($arResult["ITEMS"]["DelDelCanBuy"])?>)</a>&nbsp;
			<?if(false):?>
			<a href="#" onclick="ShowBasketItems(3);"><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=count($arResult["ITEMS"]["nAnCanBuy"])?>)</a>
			<?endif;?>
	</div>

	<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0):?>
    <table class="cart-items-table" cellpadding="0" cellspacing="0">
        <tr class="cart-items-table-head">
            <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
			<?endif;?>
			
			<?if (in_array("VAT", $arParams["COLUMNS_LIST"])):?>
				<td><?= GetMessage("SALE_VAT")?></td>
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
        	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
        	{
        		?>
        		<tr>
        			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
        				<td class="cart-item-name">
            				<div style="padding: 12px 0;"><?=$arBasketItems['IBLOCK_NAME']?></div>
                            <a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>"><img style="margin: 0 0 10px;" src="<?=$arBasketItems["PREVIEW_PICTURE_SRC"]?>" /></a><br />
                            <?=$arBasketItems["ARTICUL"]?><br />
                            <?=$arBasketItems["NAME"]?><br />
                            <span style="color: #676767;">(<?=$arBasketItems["COUNTRY"]?>)</span><br /><br />
                            <strong><?=$arBasketItems["PRICE_FORMATED"]?></strong><br /><br />
        				</td>
        			<?endif;?>
        			
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
        				<td class="cart-item-quantity"><input maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3"></td>
        			<?endif;?>
                    <td style="color: #d1670d;">
                        <?if ($arBasketItems["QUANTITY"] > 0):?>
                            <strong>в наличии</strong>
                        <?else:?>
                            <strong>отсутствует</strong>
                        <?endif?>
                    </td>
                    <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
                        <?$price = split("\.", $arBasketItems["PRICE"]);?>
        				<td class="cart-item-price"><?=$price[0]?> <span class='rub'>руб.</span></td>
        			<?endif;?>
        			<td class="cart-item-actions">
        				<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
        					<a class="cart-shelve-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"><?=GetMessage("SALE_OTLOG")?></a>
        				<?endif;?>
                        <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
        					<a class="cart-delete-item" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
        				<?endif;?>
        			</td>
        		</tr>
        		<?
        		$i++;
        	}
        	?>
    </table>
    
    <div class="cart-item-price allSum">
	   <input class="input_gray" type="submit" value="<?echo GetMessage("SALE_UPDATE")?>" name="BasketRefresh">
	   <input class="input_gray" type="submit" value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2">
       <span style="font-size: 12px"><?= GetMessage("SALE_ITOGO")?>:&nbsp;&nbsp;</span><?=$arResult["allSum"]?> <span>руб.</span>
    </div>
    <div style="clear: both;"></div>
	

	<div class="cart-ordering">
		<?if ($arParams["HIDE_COUPON"] != "Y"):?>
			<div class="cart-code">
				<input <?if(empty($arResult["COUPON"])):?>onclick="if (this.value=='<?=GetMessage("SALE_COUPON_VAL")?>')this.value=''" onblur="if (this.value=='')this.value='<?=GetMessage("SALE_COUPON_VAL")?>'"<?endif;?> value="<?if(!empty($arResult["COUPON"])):?><?=$arResult["COUPON"]?><?else:?><?=GetMessage("SALE_COUPON_VAL")?><?endif;?>" name="COUPON">
			</div>
		<?endif;?>
		
	</div>
	<?else:
		echo ShowNote(GetMessage("SALE_NO_ACTIVE_PRD"));
	endif;?>
</div>
<?