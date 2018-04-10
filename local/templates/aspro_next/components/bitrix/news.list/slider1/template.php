<div class="viewed_block">
        <h3 class="title_block sm">Компаньоны</h3>
        <div class="outer_wrap flexslider shadow items border custom_flex top_right" data-plugin-options='{"animation": "slide", "directionNav": true, "itemMargin":10, "controlNav" :false, "animationLoop": true, "slideshow": false, "counts": [8,4,3,2,1]}'>
            <ul class="rows_block slides">
                <?foreach($arResult["ITEMS"] as $arItem){
                    $isItem=(isset($arItem['ID']) ? true : false);?>
                    <li class="item_block visible">
                        <div class="item_wrap item <?=($isItem ? 'has-item' : '' );?>" <?=($isItem ? "id='".$this->GetEditAreaId($arItem['ID'])."'" : "")?>>
                            
                                <div class="inner_wrap">
                                    <div class="image_wrapper_block">
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">                                
                                            
                                            
                                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                                            
                                        </a>
                                    </div>
                                    <div class="item_info">
                                        <div class="item-title">
                                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="dark-color"><span><?=$arItem['NAME'];?></span></a>
                                        </div>
                                        <div class="cost prices clearfix">
                                        <?=$arItem['PROPERTIES']['MAXIMUM_PRICE']['VALUE']?><span>р</span>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                          
                        </div>
                    </li>
                <?}?>
            </ul>
        </div>
    </div>

