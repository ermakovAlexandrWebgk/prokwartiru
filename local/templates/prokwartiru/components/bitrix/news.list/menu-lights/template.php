<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!--div class="catalog-item-list">

<-?foreach($arResult["ITEMS"] as $arItem):?->
	<div class="catalog-item">
			<div class="catalog-item-image" style="margin-bottom: 10px;"><a href="/catalog/lights/index.php?RUBRIC_ID=<?=$arItem["ID"]?>"><img border="0" src="<-?=$arItem["PREVIEW_PICTURE"]["SRC"]?->" width="<-?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?->" height="<-?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?->" alt="<-?=$arItem["NAME"]?->" title="<-?=$arItem["NAME"]?->" style="border: none;" /></a></div>
	  </div>
<-?endforeach;?->
</div-->
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
