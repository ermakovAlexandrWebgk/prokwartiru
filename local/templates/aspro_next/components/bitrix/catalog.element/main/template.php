<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->SetViewTarget('collection');?>

<?=$arResult['COLLECTION']?>
<?$this->EndViewTarget();?>
<div class="basket_props_block" id="bx_basket_div_<?=$arResult["ID"];?>" style="display: none;">
    <?if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])){
    foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo){?>
            <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
        <?if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
                unset($arResult['PRODUCT_PROPERTIES'][$propID]);
        }
    }

    $arResult["EMPTY_PROPS_JS"]="Y";
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if (!$emptyProductProperties){
        $arResult["EMPTY_PROPS_JS"]="N";?>
        <div class="wrapper">
            <table>
                <?foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo){?>
                    <tr>
                        <td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
                        <td>
                            <?if('L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']){
                            foreach($propInfo['VALUES'] as $valueID => $value){?>
                                    <label>
                                        <input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
                                    </label>
                            <?}
                            }else{?>
                                <select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]">
                                    <?foreach($propInfo['VALUES'] as $valueID => $value){?>
                                        <option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
                                    <?}?>
                                </select>
                            <?}?>
                        </td>
                    </tr>
                <?}?>
            </table>
        </div>
    <?}?>
</div>

<?
$this->setFrameMode(true);
$currencyList = '';
if (!empty($arResult['CURRENCIES'])){
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'STORES' => array(
        "USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
        "SCHEDULE" => $arParams["SCHEDULE"],
        "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
        "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
        "ELEMENT_ID" => $arResult["ID"],
        "STORE_PATH"  =>  $arParams["STORE_PATH"],
        "MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
        "MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
        "USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
        "SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
        "SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
        "USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
        "USER_FIELDS" => $arParams['USER_FIELDS'],
        "FIELDS" => $arParams['FIELDS'],
        "STORES" => $arParams['STORES'] = array_diff($arParams['STORES'], array('')),
    )
);
unset($currencyList, $templateLibrary);


$arSkuTemplate = array();
if (!empty($arResult['SKU_PROPS'])){
    $arSkuTemplate=CNext::GetSKUPropsArray($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], "list", $arParams["OFFER_HIDE_NAME_PROPS"]);
}
$strMainID = $this->GetEditAreaId($arResult['ID']);

$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

$arResult["strMainID"] = $this->GetEditAreaId($arResult['ID']);
$arItemIDs=CNext::GetItemsIDs($arResult, "Y");
$totalCount = CNext::GetTotalCount($arResult, $arParams);


$arQuantityData = CNext::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"], "Y");

$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());
$useStores = $arParams["USE_STORE"] == "Y" && $arResult["STORES_COUNT"] && $arQuantityData["RIGHTS"]["SHOW_QUANTITY"];
$showCustomOffer=(($arResult['OFFERS'] && $arParams["TYPE_SKU"] !="N") ? true : false);
if($showCustomOffer){
    $templateData['JS_OBJ'] = $strObName;
}
$strMeasure='';
$arAddToBasketData = array();
if($arResult["OFFERS"]){
    $strMeasure=$arResult["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
    $templateData["STORES"]["OFFERS"]="Y";
    foreach($arResult["OFFERS"] as $arOffer){
        $templateData["STORES"]["OFFERS_ID"][]=$arOffer["ID"];
    }
}else{
    if (($arParams["SHOW_MEASURE"]=="Y")&&($arResult["CATALOG_MEASURE"])){
        $arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arResult["CATALOG_MEASURE"]), false, false, array())->GetNext();
        $strMeasure=$arMeasure["SYMBOL_RUS"];
    }
    $arAddToBasketData = CNext::GetAddToBasketArray($arResult, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'btn-lg w_icons', $arParams);
}
$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

// save item viewed
$arFirstPhoto = reset($arResult['MORE_PHOTO']);
$arItemPrices = $arResult['MIN_PRICE'];
if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX'])
{
    $rangSelected = $arResult['ITEM_QUANTITY_RANGE_SELECTED'];
    $priceSelected = $arResult['ITEM_PRICE_SELECTED'];
    if(isset($arResult['FIX_PRICE_MATRIX']) && $arResult['FIX_PRICE_MATRIX'])
    {
        $rangSelected = $arResult['FIX_PRICE_MATRIX']['RANGE_SELECT'];
        $priceSelected = $arResult['FIX_PRICE_MATRIX']['PRICE_SELECT'];
    }
    $arItemPrices = $arResult['ITEM_PRICES'][$priceSelected];
    $arItemPrices['VALUE'] = $arItemPrices['BASE_PRICE'];
    $arItemPrices['PRINT_VALUE'] = \Aspro\Functions\CAsproNextItem::getCurrentPrice('BASE_PRICE', $arItemPrices);
    $arItemPrices['DISCOUNT_VALUE'] = $arItemPrices['PRICE'];
    $arItemPrices['PRINT_DISCOUNT_VALUE'] = \Aspro\Functions\CAsproNextItem::getCurrentPrice('PRICE', $arItemPrices);
}
$arViewedData = array(
    'PRODUCT_ID' => $arResult['ID'],
    'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    'NAME' => $arResult['NAME'],
    'DETAIL_PAGE_URL' => $arResult['DETAIL_PAGE_URL'],
    'PICTURE_ID' => $arResult['PREVIEW_PICTURE'] ? $arResult['PREVIEW_PICTURE']['ID'] : ($arFirstPhoto ? $arFirstPhoto['ID'] : false),
    'CATALOG_MEASURE_NAME' => $arResult['CATALOG_MEASURE_NAME'],
    'MIN_PRICE' => $arItemPrices,
    'CAN_BUY' => $arResult['CAN_BUY'] ? 'Y' : 'N',
    'IS_OFFER' => 'N',
    'WITH_OFFERS' => $arResult['OFFERS'] ? 'Y' : 'N',
);
?>
<?$instr_prop = ($arParams["DETAIL_DOCS_PROP"] ? $arParams["DETAIL_DOCS_PROP"] : "INSTRUCTIONS");?>
<script type="text/javascript">
    setViewedProduct(<?=$arResult['ID']?>, <?=CUtil::PhpToJSObject($arViewedData, false)?>);
</script>
<meta itemprop="name" content="<?=$name = strip_tags(!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'])?>" />
<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
<meta itemprop="description" content="<?=(strlen(strip_tags($arResult['PREVIEW_TEXT'])) ? strip_tags($arResult['PREVIEW_TEXT']) : (strlen(strip_tags($arResult['DETAIL_TEXT'])) ? strip_tags($arResult['DETAIL_TEXT']) : $name))?>" />
<div class="item_main_info <?=(!$showCustomOffer ? "noffer" : "");?> <?=($arParams["SHOW_UNABLE_SKU_PROPS"] != "N" ? "show_un_props" : "unshow_un_props");?>" id="<?=$arItemIDs["strMainID"];?>">
    <div class="img_wrapper">
      <div class="stickers">
          <?if (is_array($arResult["RELATED_ELEMENT_STICKER"])):?>
              <?foreach($arResult["RELATED_ELEMENT_STICKER"] as $xmlId=>$stickerDescription){?>
                  <div><div class="sticker_<?=$xmlId;?>"><?=$stickerDescription?></div></div>
              <?}?>
              <?if(isset($arResult['RATIO_PRICE'])){?>
                 <?if(!empty($arResult["RATIO_PRICE"]["DISCOUNT_DIFF_PERCENT"]) &&$arResult["RATIO_PRICE"]["DISCOUNT_DIFF_PERCENT"] > 0 ){?>
                     <div><div class="sticker_STOCK"><?='-'.$arResult["RATIO_PRICE"]["DISCOUNT_DIFF_PERCENT"].'%'?></div></div>
                 <?}?>
             <?}?>
          <?endif;?>
          <?if($arParams["SALE_STIKER"] && $arResult["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
              <div><div class="sticker_sale_text"><?=$arResult["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div></div>
          <?}?>
      </div>
        <div class="item_slider">
            <?if(((!$arResult["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N") || ($arParams["DISPLAY_COMPARE"] == "Y")) || (strlen($arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer))):?>
                <div class="like_wrapper">
                    <?if((!$arResult["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N") || ($arParams["DISPLAY_COMPARE"] == "Y")):?>
                        <div class="like_icons iblock">
                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                <?if(!$arResult["OFFERS"]):?>
                                    <div class="wish_item text" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>">
                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>" ><i></i></span>
                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>"><i></i></span>
                                    </div>
                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !empty($arResult['OFFERS_PROP'])):?>
                                    <div class="wish_item text " <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="" data-iblock="<?=$arResult["IBLOCK_ID"]?>" <?=(!empty($arResult['OFFERS_PROP']) ? 'data-offers="Y"' : '');?> data-props="<?=$arOfferProps?>">
                                        <span class="value <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>"><i></i></span>
                                        <span class="value added <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>"><i></i></span>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                <?if(!$arResult["OFFERS"]):?>
                                    <div data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=($arResult["OFFERS"] ? $arParams["TYPE_SKU"] : "");?>" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['COMPARE_LINK']; ?>">
                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"><i></i></span>
                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"><i></i></span>
                                    </div>
                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1'):?>
                                    <div data-item="" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=$arParams["TYPE_SKU"];?>">
                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"><i></i></span>
                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"><i></i></span>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                        </div>
                    <?endif;?>
                </div>
            <?endif;?>

            <?reset($arResult['MORE_PHOTO']);
            $arFirstPhoto = current($arResult['MORE_PHOTO']);
            $viewImgType=$arParams["DETAIL_PICTURE_MODE"];?>
            <div class="slides">
                <?if($showCustomOffer && !empty($arResult['OFFERS_PROP'])){?>
                    <div class="offers_img wof">
                        <?$alt=$arFirstPhoto["ALT"];
                        $title=$arFirstPhoto["TITLE"];?>
                        <?if($arFirstPhoto["BIG"]["src"]){?>
                            <a href="<?=($viewImgType=="POPUP" ? $arFirstPhoto["BIG"]["src"] : "javascript:void(0)");?>" class="<?=($viewImgType=="POPUP" ? "popup_link" : "line_link");?>" title="<?=$title;?>">
                                <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?=$arFirstPhoto['SMALL']['src']; ?>" <?=($viewImgType=="MAGNIFIER" ? 'data-large="" xpreview="" xoriginal=""': "");?> alt="<?=$alt;?>" title="<?=$title;?>" itemprop="image">
                                <div class="zoom"></div>
                            </a>
                        <?}else{?>
                            <a href="javascript:void(0)" class="" title="<?=$title;?>">
                                <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?=$arFirstPhoto['SRC']; ?>" alt="<?=$alt;?>" title="<?=$title;?>" itemprop="image">
                                <div class="zoom"></div>
                            </a>
                        <?}?>
                    </div>
                    <?}else{
                    if($arResult["MORE_PHOTO"]){
                    $bMagnifier = ($viewImgType=="MAGNIFIER");?>
                        <ul>
                            <?foreach($arResult["MORE_PHOTO"] as $i => $arImage){
                            if($i && $bMagnifier):?>
                                    <?continue;?>
                                <?endif;?>
                                <?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
                                <?
                                $alt=$arImage["ALT"];
                                $title=$arImage["TITLE"];
                                ?>
                                <li id="photo-<?=$i?>" <?=(!$i ? 'class="current"' : 'style="display: none;"')?>>
                                    <?if(!$isEmpty){?>
                                        <a href="<?=($viewImgType=="POPUP" ? $arImage["BIG"]["src"] : "javascript:void(0)");?>" <?=($bIsOneImage ? '' : 'data-fancybox-group="item_slider"')?> class="<?=($viewImgType=="POPUP" ? "popup_link fancy" : "line_link");?>" title="<?=$title;?>">
                                            <img  src="<?=$arImage["SMALL"]["src"]?>" <?=($viewImgType=="MAGNIFIER" ? "class='zoom_picture'" : "");?> <?=($viewImgType=="MAGNIFIER" ? 'xoriginal="'.$arImage["BIG"]["src"].'" xpreview="'.$arImage["THUMB"]["src"].'"' : "");?> alt="<?=$alt;?>" title="<?=$title;?>"<?=(!$i ? ' itemprop="image"' : '')?>/>
                                            <div class="zoom"></div>
                                        </a>
                                    <?}else{?>
                                        <img  src="<?=$arImage["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
                                    <?}?>
                                </li>
                            <?}?>
                        </ul>
                <?}
                }?>
            </div>
            <?/*thumbs*/?>
            <?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])){
            if(count($arResult["MORE_PHOTO"]) > 1):?>
                    <div class="wrapp_thumbs xzoom-thumbs">
                        <div class="thumbs flexslider" data-plugin-options='{"animation": "slide", "selector": ".slides_block > li", "directionNav": true, "itemMargin":10, "itemWidth": 54, "controlsContainer": ".thumbs_navigation", "controlNav" :false, "animationLoop": true, "slideshow": false}' style="max-width:320px;">
                            <ul class="slides_block" id="thumbs">
                                <?foreach($arResult["MORE_PHOTO"]as $i => $arImage):?>
                                    <li <?=(!$i ? 'class="current"' : '')?> data-big_img="<?=$arImage["BIG"]["src"]?>" data-small_img="<?=$arImage["SMALL"]["src"]?>">
                                        <span><img class="xzoom-gallery" width="50" xpreview="<?=$arImage["THUMB"]["src"];?>" src="<?=$arImage["THUMB"]["src"]?>" alt="<?=$arImage["ALT"];?>" title="<?=$arImage["TITLE"];?>" /></span>
                                    </li>
                                <?endforeach;?>
                            </ul>
                            <span class="thumbs_navigation custom_flex"></span>
                        </div>

                    </div>
                    <span class"interior"><?=GetMessage('INTERIOR')?> <?=$arResult["COLLECTION"]?></span>

                    <script>
                        $(document).ready(function(){
                            $('.item_slider .thumbs li').first().addClass('current');
                            $('.item_slider .thumbs').delegate('li:not(.current)', 'click', function(){
                                var slider_wrapper = $(this).parents('.item_slider'),
                                index = $(this).index();
                                if(arNextOptions['THEME']['DETAIL_PICTURE_MODE'] == 'MAGNIFIER')
                                {
                                    var li = $(this).parents('.item_slider').find('.slides li');
                                    li.find('img').attr('src', $(this).data('small_img'));
                                    li.find('img').attr('xoriginal', $(this).data('big_img'));
                                }
                                else
                                {
                                    $(this).addClass('current').siblings().removeClass('current')//.parents('.item_slider').find('.slides li').fadeOut(333);
                                    slider_wrapper.find('.slides li').removeClass('current').hide();
                                    slider_wrapper.find('.slides li:eq('+index+')').addClass('current').show();
                                }
                            });
                        })
                    </script>
                <?endif;?>
            <?}else{?>
                <div class="wrapp_thumbs">
                    <div class="sliders">
                        <div class="thumbs" style="">
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
        <?/*mobile*/?>
        <?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])){?>
            <div class="item_slider flex flexslider" data-plugin-options='{"animation": "slide", "directionNav": false, "animationLoop": false, "slideshow": true, "slideshowSpeed": 10000, "animationSpeed": 600}'>
                <ul class="slides">
                    <?if($arResult["MORE_PHOTO"]){
                    foreach($arResult["MORE_PHOTO"] as $i => $arImage){?>
                            <?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
                            <li id="mphoto-<?=$i?>" <?=(!$i ? 'class="current"' : 'style="display: none;"')?>>
                                <?
                                $alt=$arImage["ALT"];
                                $title=$arImage["TITLE"];
                                ?>
                                <?if(!$isEmpty){?>
                                    <a href="<?=$arImage["BIG"]["src"]?>" data-fancybox-group="item_slider_flex" class="fancy" title="<?=$title;?>" >
                                        <img src="<?=$arImage["SMALL"]["src"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
                                        <div class="zoom"></div>
                                    </a>
                                <?}else{?>
                                    <img  src="<?=$arImage["SRC"];?>" alt="<?=$alt;?>" title="<?=$title;?>" />
                                <?}?>
                            </li>
                    <?}
                    }?>
                </ul>
            </div>
        <?}else{?>
            <div class="item_slider flex"></div>
        <?}?>
    </div>
    <div class="right_info">
        <div class="info_item">
            <div class="back-button">
                <a href="<?=$_SERVER['HTTP_REFERER']?>" class="back_url"><?=GetMessage('BACK')?></a>
            </div>

            <div class="price_txt">
                <span class="properties-string">
                    <?=$arResult["PROPERTIES"]["PROPERTIES_STRING"]?>
                    <?foreach($arResult['COLOR'] as $value){?>
                      <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/color-is-<?=$value['CODE']?>/apply/"><?=$value['NAME'].','?></a>
                    <?}?>
                    <?=$arResult["PROPERTIES"]["SURFACE"]?>
                    <?=$arResult["PROPERTIES"]["FASKA"]?>
                    <?=$arResult["PROPERTIES"]["CLASS"]?>
                    <?=$arResult["PROPERTIES"]["THICKNESS_NEW"]?>
                    <?=$arResult['UF_MARK_CURRENT_VALUES'];?>
                    <?foreach($arResult['STYLE'] as $value){?>
                      <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/style-is-<?=$value['CODE']?>/apply/"><?=$value['NAME'];?></a>
                    <?}?>
                    <?foreach($arResult['DESIGN'] as $value){?>
                      <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/design_oboi-is-<?=$value['CODE']?>/apply/"><?=$value['NAME'];?></a>
                    <?}?>
                    <?=$arResult["PROPERTIES"]["LAMEL"]?><br>
                    <?if($arResult['COUNTRY']){
                      echo 'производство';
                    foreach($arResult['COUNTRY'] as $code => $value){?>
                   <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/country-is-<?=$code?>/apply/"><?=$value;?></a><br>
                    <?}?>
                  <?}?>     
                    <?$countItems = count($arResult['ROOM']);
                    $i = 0;
                    if($arResult['ROOM']){
                    echo 'Подходят для:';
                    foreach($arResult['ROOM'] as $value){
                      if(++$i === $countItems){?>
                        <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/room-is-<?=$value['CODE']?>/apply/"><?=$value['NAME'];?></a>
                      <?}else{?>
                        <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/room-is-<?=$value['CODE']?>/apply/"><?=$value['NAME'].',';?></a>
                        <?}?>
                    <?}?>
                  <?}?>
                    <?=$arResult["PROPERTIES"]["LOCK"]?>
                    <?=$arResult["PROPERTIES"]["PERIOD"]?>
                    <?=$arResult["PROPERTIES"]["WATERPROOF_FLOOR"]?>
                </span>
            </div>
            <?$isArticle=(strlen($arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer));?>
            <?if($isArticle || $arResult["BRAND_ITEM"] || $arParams["SHOW_RATING"] == "Y" || strlen($arResult["PREVIEW_TEXT"])){?>
                <!--<div class="top_info">
                <div class="rows_block">
                <?/*$col=1;
                if($isArticle && $arResult["BRAND_ITEM"] && $arParams["SHOW_RATING"] == "Y"){
                $col=3;
                }elseif(($isArticle && $arResult["BRAND_ITEM"]) || ($isArticle && $arParams["SHOW_RATING"] == "Y") || ($arResult["BRAND_ITEM"] && $arParams["SHOW_RATING"] == "Y")){
                $col=2;
                }?>
                <?if($arParams["SHOW_RATING"] == "Y"):?>
                <div class="item_block col-<?=$col;?>">
                <?$frame = $this->createFrame('dv_'.$arResult["ID"])->begin('');?>
                <div class="rating">
                <?$APPLICATION->IncludeComponent(
                "bitrix:iblock.vote",
                "element_rating",
                Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                "ELEMENT_ID" => $arResult["ID"],
                "MAX_VOTE" => 5,
                "VOTE_NAMES" => array(),
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "DISPLAY_AS_RATING" => 'vote_avg'
                ),
                $component, array("HIDE_ICONS" =>"Y")
                );?>
                </div>
                <?$frame->end();?>
                </div>
                <?endif;?>
                <?if($isArticle):?>
                <div class="item_block col-<?=$col;?>">
                <div class="article iblock" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue" <?if($arResult['SHOW_OFFERS_PROPS']){?>id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_ARTICLE_DIV'] ?>" style="display: none;"<?}?>>
                <span class="block_title" itemprop="name"><?=GetMessage("ARTICLE");?>:</span>
                <span class="value" itemprop="value"><?=$arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span>
                </div>
                </div>
                <?endif;?>

                <?if($arResult["BRAND_ITEM"]){?>
                <div class="item_block col-<?=$col;?>">
                <div class="brand">
                <?if(!$arResult["BRAND_ITEM"]["IMAGE"]):?>
                <b class="block_title"><?=GetMessage("BRAND");?>:</b>
                <a href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>"><?=$arResult["BRAND_ITEM"]["NAME"]?></a>
                <?else:?>
                <a class="brand_picture" href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>">
                <img  src="<?=$arResult["BRAND_ITEM"]["IMAGE"]["src"]?>" alt="<?=$arResult["BRAND_ITEM"]["NAME"]?>" title="<?=$arResult["BRAND_ITEM"]["NAME"]?>" />
                </a>
                <?endif;?>
                </div>
                </div>
                <?}?>
                </div>
                <?if(strlen($arResult["PREVIEW_TEXT"])):?>
                !!!<div class="preview_text dotdot"><?=$arResult["PREVIEW_TEXT"]?></div>
                <?if(strlen($arResult["DETAIL_TEXT"])):?>
                <div class="more_block icons_fa color_link"><span><?=GetMessage('MORE_TEXT_BOTTOM');?></span></div>
                <?endif;?>
                <?endif;*/?>
                </div>-->
            <?}?>
            <div class="middle_info main_item_wrapper">
                <?=$arResult["IMP_PROPS_STR"]?>
                
                <?if ($arResult["METER_PRICE"]) {?>  
                    <div class="meter_price_block">
                    <span class="price_value"><?=$arResult["METER_PRICE"]["PRICE_FORMATED"]?></span>
                    <br>
                    <span class="upakData"><?=$arResult["PROPERTIES"]["UPAK_UNDER"]?></span>
                    </div>
                    
                <?}?>

                <div class="prices_block">
                    <div class="cost prices clearfix">
                        <?if( count( $arResult["OFFERS"] ) > 0 ){
                            $minPrice = false;
                            $min_price_id=0;
                            if (isset($arResult['MIN_PRICE']) || isset($arResult['RATIO_PRICE']))
                                $minPrice = $arResult['MIN_PRICE'];
                            $offer_id=0;
                            if($arParams["TYPE_SKU"]=="N"){
                                $offer_id=$minPrice["MIN_ITEM_ID"];
                            }
                            $min_price_id=$minPrice["MIN_PRICE_ID"];
                            if(!$min_price_id)
                                $min_price_id=$minPrice["PRICE_ID"];
                            $arTmpOffer = current($arResult["OFFERS"]);
                            if(!$min_price_id)
                                $min_price_id=$arTmpOffer["MIN_PRICE"]["PRICE_ID"];
                            $item_id = $arTmpOffer["ID"];

                            $prefix='';
                            if('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] =='table' || empty($arResult['OFFERS_PROP'])){
                                $prefix=GetMessage("CATALOG_FROM");
                        }?>
                            <div class="with_matrix" style="display:none;">
                                <div class="price price_value_block">
                                    <span class="values_wrapper"><?=$minPrice["PRINT_DISCOUNT_VALUE"];?></span>
                                </div>
                                <?//if($arParams["SHOW_OLD_PRICE"]=="Y" && $minPrice["DISCOUNT_DIFF"]):?>
                                <div class="price discount"></div>
                                <?//endif;?>
                                <?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
                                    <div class="sale_block matrix" <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>>
                                        <span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
                                        <div class="text">
                                            <span class="values_wrapper"><?=$minPrice["PRINT_DISCOUNT_DIFF"];?></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?}?>
                            </div>
                            <?$measure_block = \Aspro\Functions\CAsproSku::getMeasureRatio($arParams, $minPrice);?>
                            <?if($arParams["SHOW_OLD_PRICE"]=="Y"){?>
                                <div class="price offers_price_wrapper" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE']; ?>">
                                    <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                        <?=$prefix;?> <span class="values_wrapper"><?=$minPrice["PRINT_DISCOUNT_VALUE"];?></span><?=$measure_block;?>
                                    <?endif;?>
                                </div>
                                <div class="price discount" >
                                    <span id="<?=$arItemIDs["ALL_ITEM_IDS"]['OLD_PRICE']?>" <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>><span class="values_wrapper"><?=$minPrice["PRINT_VALUE"];?></span></span>
                                </div>
                            <?}else{?>
                                <div class="price" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE']; ?>">
                                    <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                        <?=$prefix;?> <span class="values_wrapper"><?=$minPrice['PRINT_DISCOUNT_VALUE'];?></span><?=$measure_block;?>
                                    <?endif;?>
                                </div>
                                <span class="price_measure">/<?=$arResult['PROPERTIES']['CML2_BASE_UNIT']['VALUE']?></span>
                            <?}?>
                            <?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
                                <div class="sale_block not_matrix" <?=(!$minPrice["DISCOUNT_DIFF"] ? 'style="display:none;"' : '')?>>
                                    <span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
                                    <div class="text"><span class="values_wrapper"><?=$minPrice["PRINT_DISCOUNT_DIFF"];?></span></div>
                                    <div class="clearfix"></div>
                                </div>
                            <?}?>
                        <?}else{?>
                            <?
                            $item_id = $arResult["ID"];
                            if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX']) // USE_PRICE_COUNT
                            {
                                if($arResult['PRICE_MATRIX']['COLS'])
                                {
                                    $arCurPriceType = current($arResult['PRICE_MATRIX']['COLS']);
                                    $arCurPrice = current($arResult['PRICE_MATRIX']['MATRIX'][$arCurPriceType['ID']]);
                            $min_price_id = $arCurPriceType['ID'];?>
                                    <div class="" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <meta itemprop="price" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'])?>" />
                                        <meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
                                        <link itemprop="availability" href="http://schema.org/<?=($arResult['PRICE_MATRIX']['AVAILABLE'] == 'Y' ? 'InStock' : 'OutOfStock')?>" />
                                    </div>
                                <?}?>
                                <?if($arResult['ITEM_PRICE_MODE'] == 'Q' && count($arResult['PRICE_MATRIX']['ROWS']) > 1):?>
                                    <?=CNext::showPriceRangeTop($arResult, $arParams, GetMessage("CATALOG_ECONOMY"));?>
                                <?endif;?>
                                <?=CNext::showPriceMatrix($arResult, $arParams, $strMeasure, $arAddToBasketData);?>
                                <?
                            }
                            else
                            {
                                $arCountPricesCanAccess = 0;
                                $min_price_id=0;?>                                   
                                <?=\Aspro\Functions\CAsproNextItem::getItemPrices($arParams, $arResult["PRICES"], $strMeasure, $min_price_id);?>
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
                                            <span class="value" <?=((count( $arResult["OFFERS"] ) > 0 && $arParams["TYPE_SKU"] == 'TYPE_1') ? 'style="opacity:0;"' : '')?>><?=$totalCount;?></span>
                                            <span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                    <?}?>
                </div>
                <div class="buy_block">
                    <?if($arResult["OFFERS"] && $showCustomOffer){?>
                        <div class="sku_props">
                            <?if (!empty($arResult['OFFERS_PROP'])){?>
                                <div class="bx_catalog_item_scu wrapper_sku" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>">
                                    <?foreach ($arSkuTemplate as $code => $strTemplate){
                                        if (!isset($arResult['OFFERS_PROP'][$code]))
                                            continue;
                                        echo str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate);
                                    }?>
                                </div>
                            <?}?>
                            <?$arItemJSParams=CNext::GetSKUJSParams($arResult, $arParams, $arResult, "Y");?>
                            <script type="text/javascript">
                                var <? echo $arItemIDs["strObName"]; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arItemJSParams, false, true); ?>);
                            </script>
                        </div>
                    <?}?>
                    <?if(!$arResult["OFFERS"]):?>
                        <script>
                            $(document).ready(function() {
                                $('.catalog_detail input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
                            });
                        </script>
                        <div class="counter_wrapp">
                            <?if(($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] && $arAddToBasketData["ACTION"] == "ADD") && $arAddToBasketData["CAN_BUY"]):?>
                                <div class="counter_block big_basket" data-offers="<?=($arResult["OFFERS"] ? "Y" : "N");?>" data-item="<?=$arResult["ID"];?>" <?=(($arResult["OFFERS"] && $arParams["TYPE_SKU"]=="N") ? "style='display: none;'" : "");?>>
                                    <span class="minus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>">-</span>
                                    <input type="text" class="text" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=$arAddToBasketData["MIN_QUANTITY_BUY"]?>" />
                                    <span class="plus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?=($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='".$arAddToBasketData["MAX_QUANTITY_BUY"]."'" : "")?>>+</span>
                                </div>
                            <?endif;?>
                            <div id="<? echo $arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>" class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER" /*&& !$arResult["CAN_BUY"]*/) || !$arAddToBasketData["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] || ($arAddToBasketData["ACTION"] == "SUBSCRIBE" && $arResult["CATALOG_SUBSCRIBE"] == "Y")  ? "wide" : "");?>">
                                <!--noindex-->
                                <?=$arAddToBasketData["HTML"]?>
                                <!--/noindex-->
                            </div>
                            <?if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX']) // USE_PRICE_COUNT
                            {?>
                                <?if($arResult['ITEM_PRICE_MODE'] == 'Q' && count($arResult['PRICE_MATRIX']['ROWS']) > 1):?>
                                    <?$arOnlyItemJSParams = array(
                                        "ITEM_PRICES" => $arResult["ITEM_PRICES"],
                                        "ITEM_PRICE_MODE" => $arResult["ITEM_PRICE_MODE"],
                                        "ITEM_QUANTITY_RANGES" => $arResult["ITEM_QUANTITY_RANGES"],
                                        "MIN_QUANTITY_BUY" => $arAddToBasketData["MIN_QUANTITY_BUY"],
                                        "ID" => $arItemIDs["strMainID"],
                                    )?>
                                    <script type="text/javascript">
                                        var <? echo $arItemIDs["strObName"]; ?>el = new JCCatalogOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
                                    </script>
                                <?endif;?>
                            <?}?>
                        </div>
                        </div>
                        <?if($arAddToBasketData["ACTION"] !== "NOTHING"):?>
                            <?if($arAddToBasketData["ACTION"] == "ADD" && $arAddToBasketData["CAN_BUY"] && $arParams["SHOW_ONE_CLICK_BUY"]!="N"):?>
                                <div class="wrapp_one_click">
                                    <span class="btn btn-default white btn-lg type_block transition_bg one_click" data-item="<?=$arResult["ID"]?>" data-iblockID="<?=$arParams["IBLOCK_ID"]?>" data-quantity="<?=$arAddToBasketData["MIN_QUANTITY_BUY"];?>" onclick="oneClickBuy('<?=$arResult["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>', this)">
                                        <span><?=GetMessage('ONE_CLICK_BUY')?></span>
                                    </span>
                                </div>
                            <?endif;?>
                        <?endif;?>
                    <?elseif($arResult["OFFERS"] && $arParams['TYPE_SKU'] == 'TYPE_1'):?>
                        <div class="offer_buy_block buys_wrapp" style="display:none;">
                            <div class="counter_wrapp">
                            </div>
                            
                        </div>
                    <?elseif($arResult["OFFERS"] && $arParams['TYPE_SKU'] != 'TYPE_1'):?>
                        <span class="btn btn-default btn-lg slide_offer transition_bg type_block"><i></i><span><?=GetMessage("MORE_TEXT_BOTTOM");?></span></span>
                    <?endif;?>

                </div>

                <input id="hiddenId" value="<?=$arResult["ID"]?>" hidden> 
                <div class="totalCount">
                    <div>
                        
                    </div>
                </div>
                <div class="discount_block">
                    <a href="/discount.php" class="btn-get_discount btn-lg btn transition_bg btn-default white">Получить скидку
                        <img height="16" width="16" src="<?=SITE_TEMPLATE_PATH?>/images/perIcon.png"></a>
                    <div class="wishButton">
                        <div class="btn-get_discount btn-lg btn transition_bg btn-default white wish_item text" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>">
                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                <?if(!$arResult["OFFERS"]):?>

                                    <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>" >Добавить в избранное <img height="20" width="20" src="<?=SITE_TEMPLATE_PATH?>/images/redheart.png"></span>
                                    <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>">В избранном</span>

                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !empty($arResult['OFFERS_PROP'])):?>
                                    <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="" data-iblock="<?=$arResult["IBLOCK_ID"]?>" <?=(!empty($arResult['OFFERS_PROP']) ? 'data-offers="Y"' : '');?> data-props="<?=$arOfferProps?>">
                                    <span class="value <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>">Добавить в избранное <img height="20" width="20" src="<?=SITE_TEMPLATE_PATH?>/images/redheart.png"></span>
                                    <span class="value added <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>">В избранном</span>

                                <?endif;?>
                            <?endif;?>
                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                <?if(!$arResult["OFFERS"]):?>
                                    <div data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=($arResult["OFFERS"] ? $arParams["TYPE_SKU"] : "");?>" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['COMPARE_LINK']; ?>">
                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"></span>
                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"></span>
                                    </div>
                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1'):?>
                                    <div data-item="" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=$arParams["TYPE_SKU"];?>">
                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>">Добавить в избранное <img height="20" width="20" src="<?=SITE_TEMPLATE_PATH?>/images/redheart.png"></span>
                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>">В избранном</span>
                                    </div>
                                <?endif;?>
                            <?endif;?>



                        </div>

                    </div>
                    <?
                    $arFiles = array();
                    if($arResult["PROPERTIES"][$instr_prop]["VALUE"]){
                        $arFiles = $arResult["PROPERTIES"][$instr_prop]["VALUE"];
                    } else {
                        $arFiles = $arResult["SECTION_FULL"]["UF_FILES"];
                    }

                    if(is_array($arFiles)){
                        foreach($arFiles as $key => $value){
                            if(!intval($value)){
                                unset($arFiles[$key]);
                            }
                        }
                    }
                    ?>
                    <?if($arFiles):?>

                        <?foreach($arFiles as $arItem):?>

                            <?$arFile=CNext::GetFileInfo($arItem);?>
                            <div class="btn-get_discount btn-lg btn transition_bg btn-default white">
                                <a target="_blank" href="<?=$arFile["SRC"];?>"><?=GetMessage('MANUAL');?></a>
                            </div>
                        <?endforeach;?>



                    <?endif;?>
                        <?
                        
                        $p1 = "/catalog/oboi/";
                        if (strstr($APPLICATION->GetCurDir(), $p1) && !empty($arResult['ITEM']['GLUE_CATALOG_ID'])) {?>
                            <div class="btn-lg w_icons to-cart btn btn-default glue"
                                data-item="<?=$arResult['ITEM']['GLUE_CATALOG_ID']?>"
                                    data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_381473" data-props="" data-part_props="Y"
                                        data-add_props="Y" data-empty_props="Y" data-offers=""
                                            data-iblockid="77" data-quantity="1"><?=GetMessage('ADD_GLUE');?>
                            </div>
                        <?}?>
                            <a rel="nofollow" href="/basket/" class="btn-lg w_icons in-cart btn btn-default transition_bg"  data-item="<?=$arResult['ITEM']['GLUE_CATALOG_ID']?>" style="display: none;"><i></i>
                                <span><?=GetMessage('CATALOG_GLUE_ADDED_TO_BASKET');?></span>
                            </a>


        </div>
        <?if(is_array($arResult["STOCK"]) && $arResult["STOCK"]):?>
            <div class="stock_wrapper">
                <?foreach($arResult["STOCK"] as $key => $arStockItem):?>
                    <div class="stock_board">
                        <div class="title"><a class="dark_link" href="<?=$arStockItem["DETAIL_PAGE_URL"]?>"><?=$arStockItem["NAME"];?></a></div>
                        <div class="txt"><?=$arStockItem["PREVIEW_TEXT"]?></div>
                    </div>
                <?endforeach;?>
            </div>
        <?endif;?>
        <div class="element_detail_text wrap_md">
            <!--<div class="price_txt">
            <?/*$APPLICATION->IncludeFile(SITE_DIR."include/element_detail_text.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('CT_BCE_CATALOG_DOP_DESCR')));*/?>
            </div>-->
            <div class="properties-block">
                <div class="properties-brand-collection">
                 <span class="properties-element">
                    <span class="properties-text">
                        <?=GetMessage('COLLECTION');?>
                    </span>
                    <?$page = explode('/', $APPLICATION->GetCurPage());
                      unset ($page[count($page)-2]); // удаляем детальный товар из ссылки
                      $page_new = implode("/", $page);// формируем ссылку заново?>
                       <a href="<?=$page_new?>"><?=$arResult["COLLECTION"]?></a>
                     <a href="<?=$page_new?>"><?=GetMessage("ALL_COLLECTIONS")?></a>
                </span>
  <?$brandUrl = strtolower($arResult['PROPERTIES']['BRAND']['VALUE_XML_ID']);?>

                <?if (($arResult['PROPERTIES']['COUNTRY']['VALUE']) && ($arResult['PROPERTIES']['BRAND']['VALUE']) ){?>
                    <span class="properties-element">
                        <span class="properties-text">
                            <?=GetMessage('FACTORY');?>
                        </span>
                        <a href="/catalog/<?=$arResult['CURRENT_SECTION'];?>/filter/brand-is-<?=$brandUrl?>/apply/"><?=$arResult['PROPERTIES']['BRAND']['VALUE']?></a>
                        <?foreach($arResult['COUNTRY'] as $code => $value){?>
                       <a href="/catalog/<?=$arResult['CURRENT_SECTION']?>/filter/country-is-<?=$code?>/apply/">(<?=$value;?>)</a>
                        <?}?>



                    <a href="/catalog/<?=$arResult['CURRENT_SECTION'];?>/filter/brand-is-<?=$brandUrl?>/apply/"><?=GetMessage("ALL_BRAND")?></a>
                    </span>
                <?}?>
                </div>
 <?$catalogQuantity = $arResult['CATALOG_QUANTITY'];?>

                <!--<span class="properties-element">
                <?/*if ($arResult['PROPERTIES']['PROPERTY']['VALUE']){?>
                <?=GetMessage('CHARACTERISTICS');?><span class="properties-text"><?=$arResult['PROPERTIES']['PROPERTY']['VALUE']?></span>
                <?}*/?>
                </span>
                <br-->
                <div class="delivery">
                <? if(empty($catalogQuantity) || $catalogQuantity <=0){?>
                    <span class="properties-element">
                        <span class="properties-text">
                            <?=GetMessage('STOCK');?>
                        </span>
                        <?=GetMessage('ON_ORDER');?>

                    <?}else{?>
                        <span class="properties-text"><?=GetMessage('STOCK');?></span><?=GetMessage('IN_STOCK');?>
                    <?}?>

                </span>
                <!-- Доставка товара -->
                <?$currentDir = $APPLICATION->GetCurDir();?>
                <?
                use Bitrix\Main\Grid\Declension; /*   Склонение слова "День" в зависимости от количества */
                $yearDeclension = new Declension(
                    GetMessage('ITEMS_COUNT_1'),
                    GetMessage('ITEMS_COUNT_2'),
                    GetMessage('ITEMS_COUNT_3')
                );
                $wordForDays=$yearDeclension->get($arResult['PROPERTIES']['DELIVERY']['VALUE']);
                if(empty($catalogQuantity) || $catalogQuantity <=0){?>
                    <span class="properties-element">
                        <span class="properties-text">
                            <?=GetMessage('DELIVERY_TIME');?>
                        </span>
                        <?if(empty($arResult['PROPERTIES']['DELIVERY']['VALUE'])){?>
                            <?=GetMessage('ONE_DAY');?>
                        <?}else{?>
                            <?=$arResult['PROPERTIES']['DELIVERY']['VALUE']?> <?=$wordForDays?>
                        <?}?>
                    </span>
                    <span class="properties-element">
                        <span class="properties-text"> <?=GetMessage('PICKUP_TIME');?></span>
                        <?=GetMessage('PICKUP_TIME2');?>
                    </span>
                <?}else{?>
                    <span class="properties-element">
                        <span class="properties-text">
                            <?=GetMessage('DELIVERY');?>
                        </span>
                        <?$i = 10;?>
                        <?if(strstr($currentDir,'/catalog/floor')){?>
                             <?=GetMessage('DELIVERY3');?>
                        <?}else{?>
                        <?=GetMessage('DELIVERY2');?>
                        <?}?>
                        
                    </span>
                  <?if(strstr($APPLICATION->GetCurDir, "/catalog/oboi/")){?>
                    <span class="properties-element">
                        <span class="properties-text">
                            <?=GetMessage('PICKUP_SECOND_TIME');?>
                        </span>
                        <?=GetMessage('PICKUP_SECOND_TIME2');?>
                    </span>
                    <?}?>
                <?}?>
                </div>

                <!-- Доставка товара -->
                <?if ($arResult["SHOWROOM"]){?>
                    <div class="showroom_txt">
                        <a href="/contacts/"><span>Посмотреть в шоуруме по адресу:</span><br>
                            <span>г. Москва, ул. Азовская, д. 24, к. 3, офис 71, ст.м. Севастопольская</span></a>
                    </div>
                <?}?>



            </div>
        </div>
    </div>
    <?$bPriceCount = ($arParams['USE_PRICE_COUNT'] == 'Y');?>
    <?if($arResult['OFFERS']):?>
        <span itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="display:none;">
            <meta itemprop="offerCount" content="<?=count($arResult['OFFERS'])?>" />
            <meta itemprop="lowPrice" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'] )?>" />
            <meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
            <?foreach($arResult['OFFERS'] as $arOffer):?>
                <?$currentOffersList = array();?>
                <?foreach($arOffer['TREE'] as $propName => $skuId):?>
                    <?$propId = (int)substr($propName, 5);?>
                    <?foreach($arResult['SKU_PROPS'] as $prop):?>
                        <?if($prop['ID'] == $propId):?>
                            <?foreach($prop['VALUES'] as $propId => $propValue):?>
                                <?if($propId == $skuId):?>
                                    <?$currentOffersList[] = $propValue['NAME'];?>
                                    <?break;?>
                                <?endif;?>
                            <?endforeach;?>
                        <?endif;?>
                    <?endforeach;?>
                <?endforeach;?>
                <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <meta itemprop="sku" content="<?=implode('/', $currentOffersList)?>" />
                    <a href="<?=$arOffer['DETAIL_PAGE_URL']?>" itemprop="url"></a>
                    <meta itemprop="price" content="<?=($arOffer['MIN_PRICE']['DISCOUNT_VALUE']) ? $arOffer['MIN_PRICE']['DISCOUNT_VALUE'] : $arOffer['MIN_PRICE']['VALUE']?>" />
                    <meta itemprop="priceCurrency" content="<?=$arOffer['MIN_PRICE']['CURRENCY']?>" />
                    <link itemprop="availability" href="http://schema.org/<?=($arOffer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
                </span>
            <?endforeach;?>
        </span>
        <?unset($arOffer, $currentOffersList);?>
    <?else:?>
        <?if(!$bPriceCount):?>
            <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="price" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'])?>" />
                <meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
                <link itemprop="availability" href="http://schema.org/<?=($arResult['MIN_PRICE']['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
            </span>
        <?endif;?>
    <?endif;?>
    <div class="clearleft"></div>
    <?if($arResult["TIZERS_ITEMS"]){?>
        <div class="tizers_block_detail tizers_block">
            <div class="row">
                <?$count_t_items=count($arResult["TIZERS_ITEMS"]);?>
                <?foreach($arResult["TIZERS_ITEMS"] as $arItem){?>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="inner_wrapper item">
                            <?if($arItem["UF_FILE"]){?>
                                <div class="img">
                                    <?if($arItem["UF_LINK"]){?>
                                        <a href="<?=$arItem["UF_LINK"];?>" <?=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')?>>
                                        <?}?>
                                        <img src="<?=$arItem["PREVIEW_PICTURE"]["src"];?>" alt="<?=$arItem["UF_NAME"];?>" title="<?=$arItem["UF_NAME"];?>">
                                    <?if($arItem["UF_LINK"]){?>
                                        </a>
                                    <?}?>
                                </div>
                            <?}?>
                            <div class="title">
                                <?if($arItem["UF_LINK"]){?>
                                    <a href="<?=$arItem["UF_LINK"];?>" <?=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')?>>
                                    <?}?>
                                    <?=$arItem["UF_NAME"];?>
                                <?if($arItem["UF_LINK"]){?>
                                    </a>
                                <?}?>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    <?}?>

    <?if($arParams["SHOW_KIT_PARTS"] == "Y" && $arResult["SET_ITEMS"]):?>
        <div class="set_wrapp set_block">
            <div class="title"><?=GetMessage("GROUP_PARTS_TITLE")?></div>
            <ul>
                <?foreach($arResult["SET_ITEMS"] as $iii => $arSetItem):?>
                    <li class="item">
                        <div class="item_inner">
                            <div class="image">
                                <a href="<?=$arSetItem["DETAIL_PAGE_URL"]?>">
                                    <?if($arSetItem["PREVIEW_PICTURE"]):?>
                                        <?$img = CFile::ResizeImageGet($arSetItem["PREVIEW_PICTURE"], array("width" => 140, "height" => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                        <img  src="<?=$img["src"]?>" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
                                    <?elseif($arSetItem["DETAIL_PICTURE"]):?>
                                        <?$img = CFile::ResizeImageGet($arSetItem["DETAIL_PICTURE"], array("width" => 140, "height" => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                        <img  src="<?=$img["src"]?>" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
                                    <?else:?>
                                        <img  src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_small.png" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
                                    <?endif;?>
                                </a>
                            </div>
                            <div class="item_info">
                                <div class="item-title">
                                    <a href="<?=$arSetItem["DETAIL_PAGE_URL"]?>"><span><?=$arSetItem["NAME"]?></span></a>
                                </div>
                                <?if($arParams["SHOW_KIT_PARTS_PRICES"] == "Y"):?>
                                    <div class="cost prices clearfix">
                                        <?
                                        $arCountPricesCanAccess = 0;
                                        foreach($arSetItem["PRICES"] as $key => $arPrice){
                                            if($arPrice["CAN_ACCESS"]){
                                                $arCountPricesCanAccess++;
                                            }
                                        }?>
                                        <?foreach($arSetItem["PRICES"] as $key => $arPrice):?>
                                            <?if($arPrice["CAN_ACCESS"]):?>
                                                <?$price = CPrice::GetByID($arPrice["ID"]);?>
                                                <?if($arCountPricesCanAccess > 1):?>
                                                    <div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div>
                                                <?endif;?>
                                                <?if($arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"]  && $arParams["SHOW_OLD_PRICE"]=="Y"):?>
                                                    <div class="price">
                                                        <?=$arPrice["PRINT_DISCOUNT_VALUE"];?><?if(($arParams["SHOW_MEASURE"] == "Y") && $strMeasure):?><small>/<?=$strMeasure?></small><?endif;?>
                                                    </div>
                                                    <div class="price discount">
                                                        <span><?=$arPrice["PRINT_VALUE"]?></span>
                                                    </div>
                                                <?else:?>
                                                    <div class="price">
                                                    <?=$arPrice["PRINT_VALUE"];?><?if(($arParams["SHOW_MEASURE"] == "Y") && $strMeasure):?><small>/<?=$strMea