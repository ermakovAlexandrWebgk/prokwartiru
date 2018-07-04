<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>

<?//arshow($arResult['ITEMS']);?>
<?
$big_banner = 1;
$small_banner = 2;
?>

<?if($arResult['ITEMS']): ?>
<div class="banners_wrapper clearfix">
	<div class="section_banner">
		<?$count = count($arResult['ITEMS']);?>
		<?foreach($arResult['ITEMS'] as $i => $arItem): ?>
			<?if ($arItem["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"] == "BIG" && $big_banner) {?>
				<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

					// show preview picture?
					$bImage = strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC']);
					$imageSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				?>
				<div class="banner <?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']?> <?=$arParams['POSITION']?> <?=($arItem['PROPERTIES']['HIDDEN_SM']['VALUE_XML_ID']=='Y'?'hidden-sm':'')?> <?=($arItem['PROPERTIES']['HIDDEN_XS']['VALUE_XML_ID']=='Y'?'hidden-xs':'')?>" <?=($arItem['PROPERTIES']['BGCOLOR']['VALUE']?' style=" background:'.$arItem['PROPERTIES']['BGCOLOR']['VALUE'].';"':'')?> id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
						<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="<?=$arItem['PROPERTIES']['TARGET']['VALUE_XML_ID']?>">
					<?endif;?>
						<img src="<?=$imageSrc?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="<?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']=='CROP'?'':'img-responsive'?>" />
					<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
						</a>
					<?endif;?>
				</div>
				<?$big_banner--;?>
				<?}?>
		<?endforeach;?>

	</div>
	<div class="adiition_banners">
		<?foreach($arResult['ITEMS'] as $i => $arItem): ?>
			<?if ($arItem["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"] == "SMALL" && $small_banner) {?>
				<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

					// show preview picture?
					$bImage = strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC']);
					$imageSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				?>
				<div class="banner <?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']?> <?=$arParams['POSITION']?> <?=($arItem['PROPERTIES']['HIDDEN_SM']['VALUE_XML_ID']=='Y'?'hidden-sm':'')?> <?=($arItem['PROPERTIES']['HIDDEN_XS']['VALUE_XML_ID']=='Y'?'hidden-xs':'')?>" <?=($arItem['PROPERTIES']['BGCOLOR']['VALUE']?' style=" background:'.$arItem['PROPERTIES']['BGCOLOR']['VALUE'].';"':'')?> id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
						<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="<?=$arItem['PROPERTIES']['TARGET']['VALUE_XML_ID']?>">
					<?endif;?>
						<img src="<?=$imageSrc?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="<?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']=='CROP'?'':'img-responsive'?>" />
					<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
						</a>
					<?endif;?>
				</div>
				<?$small_banner--;?>
				<?}?>
		<?endforeach;?>




        <?/*<div class="banner">
            <a href="/catalog/oboi/vinilovye/titanium/">
                <img src="http://dev-prokwartiru.webgk.ru/upload/medialibrary/359/35960ec777e74fc16d063ddba03010e4.png" alt="">
            </a>
        </div>
        <div class="banner">
            <a href="/catalog/curtains/">
                <img src="http://dev-prokwartiru.webgk.ru/upload/medialibrary/f32/f32b9017e61136631ff9f1b009535976.png" alt="">
            </a>
        </div>*/?>
    </div>
</div>
<?endif;?>
