<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
	<div class="top_wrapper items_wrapper">
		<div class="fast_view_params" data-params="<?=urlencode(serialize($arTransferParams));?>"></div>
		<div class="catalog_block items row margin0">
		<?foreach($arResult["ITEMS"] as $arItem){?>
			<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

			$totalCount = CNext::GetTotalCount($arItem, $arParams);
			$arQuantityData = CNext::GetQuantityArray($totalCount);

			$item_id = $arItem["ID"];
			$strMeasure = '';
			if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
				if(isset($arItem["ITEM_MEASURE"]) && (is_array($arItem["ITEM_MEASURE"]) && $arItem["ITEM_MEASURE"]["TITLE"]))
				{
					$strMeasure = $arItem["ITEM_MEASURE"]["TITLE"];
				}
				else   
				{
					$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
					$strMeasure = $arMeasure["SYMBOL_RUS"];
				}
			}
			$arAddToBasketData = CNext::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, array(), 'small', $arParams);
			switch ($arParams["LINE_ELEMENT_COUNT"]){
				case '2':
					$col=6;
					break;
				case '4':
					$col=3;
					break;
				default:
					$col=4;
					break;
			}
			$elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);
			?>

			<div class="catalog_item_wrapp col-m-20 col-lg-<?=$col;?> col-md-4 col-sm-<?=floor(12 / round($arParams['LINE_ELEMENT_COUNT'] / 2))?> item" data-col="<?=$col;?>">
				<div class="catalog_item item_wrap " id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="inner_wrap">
						<div class="image_wrapper_block shine">
							<div class="stickers">
								<?$prop = ($arParams["STIKERS_PROP"] ? $arParams["STIKERS_PROP"] : "HIT");?>
								<?if (is_array($arItem["PROPERTIES"][$prop]["VALUE_XML_ID"])):?>
									<?foreach($arItem["PROPERTIES"][$prop]["VALUE_XML_ID"] as $key=>$class){?>
										<div><div class="sticker_<?=CUtil::translit($arItem["PROPERTIES"][$prop]["VALUE"][$key], "ru");?>"><?=$arItem["PROPERTIES"][$prop]["VALUE"][$key]?></div></div>
									<?}?>
								<?endif;?>
								<?if($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
									<div><div class="sticker_sale_text"><?=$arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div></div>
								<?}?>
							</div>
							<?if((!$arItem["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N" ) || ($arParams["DISPLAY_COMPARE"] == "Y")):?>
								<div class="like_icons">
									<?if($arParams["DISPLAY_WISH_BUTTONS"] == "Y" && !$arItem["OFFERS"]):?>
										<div class="wish_item_button" <?=(CNext::checkShowDelay($arParams, $totalCount, $arItem) ? '' : 'style="display:none"');?>>
											<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
											<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
										</div>
									<?endif;?>
									<?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
										<div class="compare_item_button">
											<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i></span>
											<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i></span>
										</div>
									<?endif;?>
								</div>
							<?endif;?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">								
								<?
								$a_alt=($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] );
								$a_title=($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] );
								?>
								<?if( !empty($arItem["PREVIEW_PICTURE"]) ):?>
									<img class="noborder" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
								<?elseif( !empty($arItem["DETAIL_PICTURE"])):?>
									<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 170, "height" => 170 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
									<img class="noborder" src="<?=$img["src"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
								<?else:?>
									<img class="noborder" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
								<?endif;?>
								<?if($fast_view_text_tmp = CNext::GetFrontParametrValue('EXPRESSION_FOR_FAST_VIEW'))
									$fast_view_text = $fast_view_text_tmp;
								else
									$fast_view_text = GetMessage('FAST_VIEW');?>
							</a>
							
						</div>
						<div class="item_info">
							<div class="item-title">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="dark_link"><span><?=$elementName;?></span></a>
							</div>
							<?if($arParams["SHOW_RATING"] == "Y"):?>
								<div class="rating">
									<?$APPLICATION->IncludeComponent(
									   "bitrix:iblock.vote",
									   "element_rating_front",
									   Array(
										  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
										  "IBLOCK_ID" => $arItem["IBLOCK_ID"],
										  "ELEMENT_ID" =>$arItem["ID"],
										  "MAX_VOTE" => 5,
										  "VOTE_NAMES" => array(),
										  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
										  "CACHE_TIME" => $arParams["CACHE_TIME"],
										  "DISPLAY_AS_RATING" => 'vote_avg'
									   ),
									   $component, array("HIDE_ICONS" =>"Y")
									);?>
								</div>
							<?endif;?>
							<?=$arQuantityData["HTML"];?>
							<div class="cost prices clearfix">
								<?if( $arItem["OFFERS"]){?>
									<?$minPrice = false;
									if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE'])){
										// $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
										$minPrice = $arItem['MIN_PRICE'];
									}
									$offer_id=0;
									if($arParams["TYPE_SKU"]=="N"){
										$offer_id=$minPrice["MIN_ITEM_ID"];
									}
									$min_price_id=$minPrice["MIN_PRICE_ID"];
									if(!$min_price_id)
										$min_price_id=$minPrice["PRICE_ID"];
									
									$arTmpOffer = current($arItem["OFFERS"]);
									if(!$min_price_id)
										$min_price_id=$arTmpOffer["MIN_PRICE"]["PRICE_ID"];
									$item_id = $arTmpOffer["ID"];

									$prefix = '';
									if('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] !== 'block'){
										$prefix = GetMessage("CATALOG_FROM");
									}?>
									<?$measure_block = \Aspro\Functions\CAsproSku::getMeasureRatio($arParams, $minPrice);?>
									<?if($arParams["SHOW_OLD_PRICE"]=="Y"){?>
										<div class="price">
											<?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
												<?=$prefix;?> <span class="values_wrapper"><?=$minPrice["PRINT_DISCOUNT_VALUE"];?></span><?=$measure_block;?>
											<?endif;?>
										</div>
										<div class="price discount">
											<span <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>><span class="values_wrapper"><?=$minPrice["PRINT_VALUE"];?></span></span>
										</div>
										<?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
											<div class="sale_block" <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>>
												<span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span> <div class="text"><span class="values_wrapper"><?=$minPrice["PRINT_DISCOUNT_DIFF"];?></span></div>
												<div class="clearfix"></div>
											</div>
										<?}?>
									<?}else{?>
										<div class="price only_price">
											<?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
												<?=$prefix;?> <span class="values_wrapper"><?=$minPrice['PRINT_DISCOUNT_VALUE'];?></span><?=$measure_block;?>
											<?endif;?>
										</div>
									<?}?>
								<?}else{?>
									<?
									$item_id = $arItem["ID"];
									if(isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) // USE_PRICE_COUNT
									{?>
										<?if($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1):?>
											<?=CNext::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY"));?>
										<?endif;?>
										<?=CNext::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData);?>
										<?$arMatrixKey = array_keys($arItem['PRICE_MATRIX']['MATRIX']);
										$min_price_id=current($arMatrixKey);?>
									<?	
									}
									elseif($arItem["PRICES"])
									{
										$arCountPricesCanAccess = 0;
										$min_price_id=0;?>
										<?=\Aspro\Functions\CAsproNextItem::getItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id);?>
									<?}?>
								<?}?>
							</div>
							<?if($arParams["SHOW_DISCOUNT_TIME"]=="Y"){?>
								<?$arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $USER->GetUserGroupArray(), "N", $min_price_id, SITE_ID);
								$arDiscount=array();
								if($arDiscounts)
									$arDiscount=current($arDiscounts);
								if($arDiscount["ACTIVE_TO"]){?>
									<div class="view_sale_block">
										<div class="count_d_block">
											<span class="active_to hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
											<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
											<span class="countdown values"><span class="item"></span><span class="item"></span><span class="item"></span><span class="item"></span></span>
										</div>
										<div class="quantity_block">
											<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
											<div class="values">
												<span class="item">
													<span class="value" <?=( count( $arItem["OFFERS"] ) > 0 ? 'style="opacity:0;"' : '')?>><?=$totalCount;?></span>
													<span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
												</span>
											</div>
										</div>
									</div>
								<?}?>
							<?}?>
						</div>
						<div class="footer_button">
							<div class="counter_wrapp">
								<div class="button_block">
									<!--noindex-->
										<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-default basket read_more"><?=GetMessage("CATALOG_READ_MORE");?></a>
									<!--/noindex-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?}?>
		</div>
	</div>
<?}?>