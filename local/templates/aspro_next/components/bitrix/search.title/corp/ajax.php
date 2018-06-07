<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if (empty($arResult["CATEGORIES"])) return;?>
   


<div class="bx_searche scrollbar">
    <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
        <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
        <?$sectionURL = $arItem["URL"];
        if(substr($sectionURL, '/collections_oboi/') == false){
        
?>

<?
$urls = array();
$arSelect = Array("ID", "PROPERTY_COLLECTION_URL");
$arFilter = Array("IBLOCK_ID"=>77,"ID" => $arItem["ITEM_ID"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->Fetch())
{
 $urls = $ob["PROPERTY_COLLECTION_URL_VALUE"];
 
}
 ?>        
            
            
			<?//=$arCategory["TITLE"]?>
			<?if($category_id === "all"):?>
				<div class="bx_item_block all_result">
					<div class="maxwidth-theme">
						<div class="bx_item_element">
						<?if ($urls["ID"] == $arItem[$i]["ITEM_ID"]){?><a class="all_result_title btn btn-default white bold" href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?></a> <?}?>  
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
			<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
				$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
                <?if(empty($urls)){?>
                <a class="bx_item_block" href="<?=$arItem["URL"]?>">
                <?}else{?>
				<a class="bx_item_block" href="<?=$urls?>">
                <?}?>
					<div class="maxwidth-theme">
						<div class="bx_img_element">
							<?if(is_array($arElement["PICTURE"])):?>
								<img src="<?=$arElement["PICTURE"]["src"]?>">
							<?else:?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_small.png" width="38" height="38">
							<?endif;?>
						</div>
						<div class="bx_item_element">
							<span><?=$arItem["NAME"]?></span>
							<div class="price cost prices">
								<div class="title-search-price">
									<?if($arElement["MIN_PRICE"]){?>
										<?if($arElement["MIN_PRICE"]["DISCOUNT_VALUE"] < $arElement["MIN_PRICE"]["VALUE"]):?>
											<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?></div>
											<div class="price discount">
												<strike><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></strike>
											</div>
										<?else:?>
											<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></div>
										<?endif;?>
									<?}else{?>
										<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
											<?if($arPrice["CAN_ACCESS"]):?>
												<?if (count($arElement["PRICES"])>1):?>
													<div class="price_name"><?=$arResult["PRICES"][$code]["TITLE"];?></div>
												<?endif;?>
												<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
													<div class="price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
													<div class="price discount">
														<strike><?=$arPrice["PRINT_VALUE"]?></strike>
													</div>
												<?else:?>
													<div class="price"><?=$arPrice["PRINT_VALUE"]?></div>
												<?endif;?>
											<?endif;?>
										<?endforeach;?>
									<?}?>
								</div>
							</div>
						</div>
						<div style="clear:both;"></div>
					</div>
				</a>
			<?endif;?>
            <?}?>
		<?endforeach;?>
	<?endforeach;?>
</div>