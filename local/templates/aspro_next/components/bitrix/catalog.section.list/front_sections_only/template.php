<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true );?>
<?$number = 40;?>
<?$count_section = count($arResult['SECTIONS']);
$key = 0;?>
<?if($arResult['SECTIONS']):?>
    <?if($count_section > $number){?>
    <?$count_section_count = ceil($count_section / $number)?>
    <div class="row">
        <div class="module-pagination">
            <div class="nums">
                <ul class="flex-direction-nav">
                    <?if($_GET["PAGEN"] > 1){?>
                        <li class="flex-nav-prev">
                            <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$_GET["PAGEN"] - 1?>" class="flex-prev"></a>
                        </li>
                    <?}?>
                    <?if((!$_GET["PAGEN"] || $_GET["PAGEN"] > 2 || $_GET["PAGEN"]) && $_GET["PAGEN"] != $count_section_count){?>
                        <li class="flex-nav-next">
                            <?if(!$_GET["PAGEN"]){?>
                                <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$_GET["PAGEN"] + 2?>" class="flex-next"></a>
                            <?} else {?>
                                <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$_GET["PAGEN"] + 1?>" class="flex-next"></a>
                            <?}?>
                        </li>
                    <?}?>
                </ul>
                
                    <?$i = 0?>
                    <?while($i < $count_section_count){
                            $i++;
                        ?>
                            <?if ($_GET["PAGEN"] == $i || (!$_GET["PAGEN"] && $i == 1)) {?>
                                <span class="cur"><?= $i ?></span>
                            <?} else if (($_GET["PAGEN"] && ($i == $_GET["PAGEN"] - 1) || ($i == $_GET["PAGEN"] + 1))
                                || (!$_GET["PAGEN"] && $i == 2)) {?>
                                <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$i?>" class="dark_link"><?=$i?></a>
                            <?}?>
                        
                        <?
                    }?>
                
                <?/*?>
                <ul class="arrow-p">
                    <?if($_GET["PAGEN"] > 1){?>
                        <li class="pagination__item pagination__item-first">
                            <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$_GET["PAGEN"] - 1?>" class="pagination__link pagination__link-first"></a>
                        </li>
                        <?}
                        if((!$_GET["PAGEN"] || $_GET["PAGEN"] > 2 || $_GET["PAGEN"]) && $_GET["PAGEN"] != $count_section_count){?>
                        <li class="pagination__item pagination__item-last">
                            <?if(!$_GET["PAGEN"]){?>
                                <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$_GET["PAGEN"] + 2?>" class="pagination__link pagination__link-last"></a>
                                <?} else {?>
                                <a href="<?=$APPLICATION->GetCurPage()?>?PAGEN=<?=$_GET["PAGEN"] + 1?>" class="pagination__link pagination__link-last"></a>
                                <?}?>
                        </li>
                        <?}?>
                </ul><?*/?>
            </div>
        </div>
    </div>
    <?}?>
    <div class="sections_wrapper">
        <?if($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]):?>
            <div class="top_block">
                <h3 class="title_block"><?=$arParams["TITLE_BLOCK"];?></h3>
                <a href="<?=SITE_DIR.$arParams["ALL_URL"];?>"><?=$arParams["TITLE_BLOCK_ALL"] ;?></a>
            </div>
        <?endif;?>
        <div class="list items">
            <div class="row margin0">
                <?$pattern = $number * $_GET["PAGEN"];
                if($pattern != $number && $_GET["PAGEN"]){
                    $number = $pattern - $number;
                }?>
                <?foreach($arResult['SECTIONS'] as $arSection):
                    $key++;
                    if(($key <= $number && !$_GET["PAGEN"]) || ($key <= $number && $_GET["PAGEN"] == 1) || ($key > $number && $key <= $pattern && $_GET["PAGEN"] > 1)){
                        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                                <?if ($arParams["SHOW_SECTION_LIST_PICTURES"]!="N"):?>
                                    <div class="img shine">
                                        <?if($arSection["PICTURE"]["SRC"]):?>
                                            <?$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
                                            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])?>" /></a>
                                        <?elseif($arSection["~PICTURE"]):?>
                                            <?$img = CFile::ResizeImageGet($arSection["~PICTURE"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
                                            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])?>" /></a>
                                        <?else:?>
                                            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=SITE_TEMPLATE_PATH?>/images/catalog_category_noimage.png" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" /></a>
                                        <?endif;?>
                                    </div>
                                <?endif;?>
                                <div class="name">
                                    <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link"><?=$arSection['NAME'];?></a>
                                </div>
                                <?if ($arResult["MIN_PRICES"][$arSection["ID"]]) {?>
                                    <span>от <?= $arResult["MIN_PRICES"][$arSection["ID"]] ?> руб.</span>
                                <?}?>
                            </div>
                        </div>
                    <?}?>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>