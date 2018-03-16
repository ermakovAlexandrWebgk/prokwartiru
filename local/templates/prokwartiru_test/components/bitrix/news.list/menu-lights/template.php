<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $fabrikaID=$_REQUEST["FABRIKA_ID"];?>
<? $rubric=$_REQUEST["RUBRIC_ID"];?>
<?$n=0;?>
<div class="menu-type">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="menu-type-item">    
            <?if($n>0):?><b>.</b><?endif?><?$n++;?>
            <?if($arItem['ID']==$rubric):?><span class='orange'><?=$arItem['NAME']?></span>&nbsp;
            <?else:?><a href="/catalog/lights/index.php?RUBRIC_ID=<?=$arItem['ID']?>"><?=$arItem['NAME']?></a>&nbsp;
            <?endif?>
	</div>
	<?endforeach;?>
</div>
