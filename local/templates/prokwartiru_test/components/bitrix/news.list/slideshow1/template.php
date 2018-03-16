<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!--script type="text/javascript" src="/js/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="/js/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="/js/js/main.js"></script>
<script type="text/javascript" src="/js/js/jquery.dropDown.pack.js"></script-->

<script type="text/javascript" src="/js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="/js/colorbox/jquery.colorbox-min.js"></script>


<div class="partners">


<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycolorbox').colorbox();
});
/*jQuery("#ttt").colorbox();*/
</script>


<div class="section-head section-head-yellow">
  <h3 class="section-headline">ѕоказ слайдов</h3>
  <!--a href="/about/partners/" class="show-all">все партнеры</a-->
</div>

<div class="gallery-holder">
<div class="gallery">
<ul id="mycolorbox">
<?foreach($arResult["ITEMS"] as $arItem):?>
  <li>
    
<!--  артинка -->
<?
if($arIBlockElement = GetIBlockElement($arItem["ID"], 'catalog'))
{

   // выведем детальную картинку
   $previewPicture=CFile::GetPath($arIBlockElement["DETAIL_PICTURE"]);
//echo($arIBlockElement['DETAIL_PICTURE']);
//echo(" - ".$previewPicture);
   //echo ShowImage($arIBlockElement['DETAIL_PICTURE'], 150, 150, 'border="0"', '', true);
   // выведем детальное описание
   //echo $arIBlockElement['DETAIL_TEXT'].'<br>';
}
?>
     <div class="visual">
	<a href="<?=$arItem["PREVIEW_PICTURE"]["DESCRIPTION"]?>" id="ttt"><img src="<?=$previewPicture?>" style="min-width: 80px; min-height: 30px; max-width:400px; max-height:400px; height:400px;"></a>
     </div> 

     <div class="text">
	<!--?=$arItem["ID"]?--><!--?=$arItem["PREVIEW_PICTURE"]["SRC"]?--> <a href="<?=$arItem["PREVIEW_PICTURE"]["DESCRIPTION"]?>"><span class="name"><?echo $arItem["NAME"]?></span></a>
     </div>
  </li>
<?endforeach;?>
</ul>
</div>
</div>
</div>


