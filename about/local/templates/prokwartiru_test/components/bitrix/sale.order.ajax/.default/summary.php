<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="order-item">
	<div class="order-title">
		<b class="r2"></b><b class="r1"></b><b class="r0"></b>
		<div class="order-title-inner">
			<span><?=GetMessage("SOA_TEMPL_SUM_TITLE")?></span>
		</div>
	</div>
	<div class="order-info">

	<table class="cart-items" cellspacing="0">
	<thead>
		<tr>
				<td class="cart-item-name"><?= GetMessage("SOA_TEMPL_SUM_NAME")?></td>
				<td class="cart-item-price"><?= GetMessage("SOA_TEMPL_SUM_PRICE")?></td>
				<!--td class="cart-item-price"><-?= GetMessage("SOA_TEMPL_VAT")?-></td-->
				<td class="cart-item-quantity"><?= GetMessage("SOA_TEMPL_SUM_QUANTITY")?></td>
				<td class="cart-item-quantity">Скидка</td>
		</tr>
	</thead>
	<tbody>
	<?
	foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
	{
		?>
		<tr>
			<td class="cart-item-name"><?=$arBasketItems["NAME"]?>
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo "<br />".$val["NAME"].": ".$val["VALUE"];
				}
				?>
			</td>
			<td class="cart-item-price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<!--td class="cart-item-price"><-?=$arBasketItems["VAT_RATE"]*100?->%</td-->

				<?
					$discount5="";
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
<?
					if($PRODUCT_IBLOCK_ID=='5'){
					  $PRODUCT_SECTION_ID=$ar_res["IBLOCK_SECTION_ID"];
					  //$res = CIBlockSection::GetByID($PRODUCT_SECTION_ID);
					  $arFilter=Array('IBLOCK_ID' => $PRODUCT_IBLOCK_ID, 'ID' => $PRODUCT_SECTION_ID);
					  $listCatalog=CIBlockSection::GetList(array('left_margin'=>'asc'), $arFilter, false, $arSelect=array('UF_DISCOUNT5'), Array('nPageSize'=>60));
					  while($itemCatalog=$listCatalog->GetNext())
						if($itemCatalog['UF_DISCOUNT5']) {
						  $discount5="-5%";
						  $arResult["ORDER_PRICE"]=$arResult["ORDER_PRICE"]-0.05*$arBasketItems["PRICE"]*$arBasketItems["QUANTITY"];
						}
				}
?>

			<td class="cart-item-quantity"><?=$arBasketItems["QUANTITY"]?> <?=$UNIT?></td>
			<td class="cart-item-quantity"><?=$allSum;?><!--?=$arResult["ORDER_PRICE"]?--><?=$discount5;?></td>

		</tr>
		<?
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td class="cart-item-name">
				<?if (doubleval($arResult["ORDER_WEIGHT"]) > 0):?>
					<p><?=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?></p>
				<?endif;?>
				<p><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></p>
				<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0):?>
					<p><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>:</p>
				<?endif;?>
				<?if(!empty($arResult["arTaxList"]))
				{
					foreach($arResult["arTaxList"] as $val)
					{
						?>
						<p><?=$val["NAME"]?>:</p>
						<?
					}
				}?>
				<?if (doubleval($arResult["DELIVERY_PRICE"]) > 0):?>
					<p><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></p>
				<?endif;?>
				<p><b><?=GetMessage("SOA_TEMPL_SUM_IT")?></b></p>
				<?if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0):?>
					<p><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></p>
				<?endif;?>
			</td>
			
			<td class="cart-item-price">
				<?if (doubleval($arResult["ORDER_WEIGHT"]) > 0):?>
					<p><?=$arResult["ORDER_WEIGHT_FORMATED"]?></p>
				<?endif;?>
					
				<p><?= SaleFormatCurrency($arResult["ORDER_PRICE"] - $arResult["VAT_SUM"], $arResult["BASE_LANG_CURRENCY"])?></p>

				<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0):?>
					<p><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></p>
				<?endif;?>
				<?if(!empty($arResult["arTaxList"])):?>
					<p></p>
				<?endif;?>
				<?if(!empty($arResult["arTaxList"]))
				{
					foreach($arResult["arTaxList"] as $val)
					{
						?>
						<p><?=$val["VALUE_MONEY_FORMATED"]?></p>
						<?
					}
				}?>
				<?if (doubleval($arResult["DELIVERY_PRICE"]) > 0):?>
					<p><?=$arResult["DELIVERY_PRICE_FORMATED"]?></p>
				<?endif;?>
				<!--p><b><-?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?-></b></p-->
				<p><b><?= SaleFormatCurrency($arResult["ORDER_PRICE"] - $arResult["VAT_SUM"] + $arResult["DELIVERY_PRICE"], $arResult["BASE_LANG_CURRENCY"])?></b></p>
				<?if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0):?>
					<p><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></p>
				<?endif;?>
			</td>
			<td class="cart-item-quantity">&nbsp;</td>
			<td class="cart-item-quantity">&nbsp;</td>
		</tr>
	</tfoot>
</table>
</div></div>

<div class="order-item">
	<div class="order-title">
		<b class="r2"></b><b class="r1"></b><b class="r0"></b>
		<div class="order-title-inner">
			<span><?=GetMessage("SOA_TEMPL_SUM_ADIT_INFO")?></span>
		</div>
	</div>
	<div class="order-info">
		<div align="center">
			<textarea rows="7" name="ORDER_DESCRIPTION" style="width:95%;"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
		</div>
	</div>
</div>