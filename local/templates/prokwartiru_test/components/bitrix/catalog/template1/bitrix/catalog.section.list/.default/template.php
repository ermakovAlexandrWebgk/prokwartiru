<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["SECTIONS"]) == 0):?>
	<?=GetMessage('CATALOG_EMPTY_CATALOG');?>
<?endif;?>

<div class="catalog-section-list" style="background-color: #B7B6B2;">
<?
$NUM_COLS = 3;
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):

	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CATALOG_SECTION_DELETE_CONFIRM')));	

	$bHasPicture = is_array($arSection['PICTURE_PREVIEW']);
	$bHasChildren = is_array($arSection['CHILDREN']) && count($arSection['CHILDREN']) > 0;
?>
	<div style="background-color: #B7B6B2;" class="catalog-section<?=$bHasPicture ? '' : ' no-picture-mode'?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
	
		<?if ($bHasPicture):?>
		<div class="catalog-section-image" style="background-color: #B7B6B2;"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src="<?=$arSection['PICTURE_PREVIEW']['SRC']?>" width="97px" height="97px" /></a></div>
		<?endif;?>

		<div class="catalog-section-info">
		<?if ($arSection['NAME'] && $arResult['SECTION']['ID'] != $arSection['ID']):?>
			<div class="catalog-section-title" style="background-color: #B7B6B2;  text-transform: uppercase;"><a style="color:#302f2a; text-decoration: none;" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></div>
		<?endif;?>
		<?if ($arSection['DESCRIPTION']):?>
			<div class="catalog-section-desc" style="background-color: #B7B6B2;"><?=$arSection['DESCRIPTION_TYPE'] == 'text' ? $arSection['DESCRIPTION'] : $arSection['~DESCRIPTION']?></div>
		<?endif;?>

		<?if ($bHasChildren):?>
			<div class="catalog-section-childs" style="background-color: #B7B6B2;">
				<table cellspacing="0" class="catalog-section-childs">
				<?
				$cell = 0;
				foreach ($arSection['CHILDREN'] as $key => $arChild):
					if ($cell == 0):?>
					<tr>
				<?
			endif;
			$cell++;?>
						<td><a href="<?=$arChild["SECTION_PAGE_URL"]?>"><?=$arChild['NAME']?></a></td>
			<?if ($cell == $NUM_COLS):
				$cell = 0;?>
					</tr>
			<?endif;endforeach;
			
			if ($cell > 0):
				while ($cell++ < $NUM_COLS):?>
						<td>&nbsp;</td>
			<?endwhile;?>
					</tr>
		<?endif;?>
				</table>
			</div>
		<?endif;?>
		</div>

	</div>
	<div class="catalog-section-separator" style="background-color: #B7B6B2;"></div>
<?endforeach;?>
</div><pre><?//print_r($arResult)?></pre>