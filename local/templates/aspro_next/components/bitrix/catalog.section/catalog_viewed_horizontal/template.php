<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
	<div class="viewed_block horizontal">
		<h3 class="title_block sm"><?=($arParams["TITLE_BLOCK"] ? $arParams["TITLE_BLOCK"] : GetMessage("TITLE_BLOCK_NAME"))?></h3>
		<div class="outer_wrap flexslider shadow items border custom_flex top_right" data-plugin-options='{"animation": "slide", "directionNav": true, "itemMargin":10, "controlNav" :false, "animationLoop": true, "slideshow": false, "counts": [4]}'>
			<ul class="rows_block slides">
				<?foreach($arResult["ITEMS"] as $arItem){
					$isItem=(isset($arItem['ID']) ? true : false);?>
					<li class="item_block visible">
						<div class="item_wrap item <?=($isItem ? 'has-item' : '' );?>" <?=($isItem ? "id='".$this->GetEditAreaId($arItem['ID'])."'" : "")?>>
							<?if($isItem){?>
								<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

								$item_id = $arItem["ID"];
								$strMeasure = '';
								if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
									$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
									$strMeasure = $arMeasure["SYMBOL_RUS"];
								}
								$elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);?>
								<div class="inner_wrap">
									<div class="image_wrapper_block">
										<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">
											<?
											$a_alt=($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arItem["NAME"] );
											$a_title=($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arItem["NAME"] );
											?>
											<?if(isset($arItem["IMG"]) && $arItem["IMG"]):?>
												<img src="<?=$arItem["IMG"]["src"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
											<?else:?>
												<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
											<?endif;?>
										</a>
									</div>
									<div class="item_info">
										<div class="item-title">
											<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="dark-color"><span><?=$elementName;?></span></a>
                                            <span class="price">Артикул:<?=$arItem['NAME'];?> </a> </span><br>
                                                <span class="price-slider price">
                                                Цена:<?=$arItem['PROPERTIES']['MAXIMUM_PRICE']['VALUE']?>р </span><br>
                                                <span class="price-slider">Бренд:<?=$arItem['PROPERTIES']['BRAND']['VALUE']?></span><br>
                                                <span class="price-slider">Страна:<?=$arItem['PROPERTIES']['COUNTRY']['VALUE']?></span><br>
                                                <span class="price-slider">Размер:<?=$arItem['PROPERTIES']['SIZE']['VALUE']?></span><br>
										</div>
										
									</div>
								</div>
                                </li>
							<?}?>
                      <?}?>
                    </ul>
            </div>
    </div>


