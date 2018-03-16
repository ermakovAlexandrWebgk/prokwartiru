<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- Всплывание карточки товара -->

<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox").fancybox({
				prevEffect : 'none',
				nextEffect : 'none',
				helpers: {
					title : {
						type : 'inside'
					}
				}
			});

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
<!--?endif;?-->

<!-- Конец Всплывания карточки товара -->






<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>
<? $FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>
<? $STYLE_ID=$_REQUEST['STYLE_ID'];?>
<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $SECTION_TOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>
<?
     $arSite = $APPLICATION->GetCurDir();
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; } /* обои */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) { $FABRIKI_TYPE_ID=78; $TYPE_ID=4; } /* плитка */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) { $FABRIKI_TYPE_ID=759; $TYPE_ID=17; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* свет */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==1317||$SECTION_TOP==1317)) { $FABRIKI_TYPE_ID=140; $TYPE_ID=10; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* мозаика */
	if($arSite=="/catalog/oboi/" && ($SECTION_ID==3730||$SECTION_TOP==3715)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; } /* фрески */

?>
<?$numberElements=0;?>

<!-- Список по ФАБРИКАМ -->
<?if($FABRIKA_ID):?>
<!-- Ambu -->
<?    
    $interierList=array();
    $arFilter = Array("IBLOCK_ID"=>$TYPE_ID, "UF_FABRIKA" => $FABRIKA_ID); // Фильтр по ФАБРИКАМ
    $listCatalogFabrika = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
    $i=0;
    while($itemCatalogFabrika = $listCatalogFabrika->GetNext()){   
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$itemCatalogFabrika['ID'], "PROPERTY_STYLE" => $STYLE_ID);
	   $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array(), $arSelect);
   	   while($arItem = $items->GetNext()) if($arItem["IBLOCK_SECTION_ID"]==$SECTION_ID){
              $interierItem=array();
              $interierItem['ID']=$itemCatalogFabrika['ID'];
              $interierItem['NAME']=$itemCatalogFabrika['NAME'];
              $interierItem['ITEM']=$arItem;
	      $interierList[]= $interierItem; 
	      $i++;
	   }	
    }
    //echo ("i=".$i); echo(" count="); echo count($interierList);
?>

<div class="item-info">
	<div class="item-desc">
	<!-- Картинка со всплывающей карточкой товара -->



	<?
	   //$NAV_STRING = $items->GetPageNavStringEx($navComponentObject,  "Товары", "orange");
	   for($i=0; $i<count($interierList); $i++){
	      $path_pic_detail=CFile::GetPath($interierList[$i]["ITEM"]["DETAIL_PICTURE"]);
//echo($interierList[$i]['NAME']); echo(" ");
	      //$arSite = $APPLICATION->GetCurDir();
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* обои */
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* плитка */
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* свет */
	      if($arSite=="/catalog/oboi/" && ($SECTION_ID==3730||$SECTION_TOP==3715)) $path="/catalog/oboi/"; /* фрески */
?>
<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- Заголовок -->
       <? if($path) $title="<a href='".$path."index.php?SECTION_ID=".$interierList[$i]['ID']."'><nobr>".$interierList[$i]['NAME']."</nobr></a>"; else $title="<nobr>".$interierList[$i]['NAME']."</nobr>";?>
	<div class="item-title" style="text-align: center;"><b class='big'><?=$title?></b></div>
	<!-- Конец Заголовок -->
	<?$title_text="<p style='text-align: center;'><b class='big'>".$title."</b></p>";?>
	<?$numberElements++;?>
        <div class="item-image">
	    <a  class="fancybox" data-fancybox-group="gallery" href="<?=$path_pic_detail?>" title="<?=$title_text?>"><img src="<?=$path_pic_detail?>" width="125px" height="125px" alt="<?=$interierList[$i]['NAME']?>" title="<?=$interierList[$i]['NAME']?>" id="catalog_list_image_<?=$i?>" /></a>
        </div>
      </div><!-- catalog-interier-card -->

<?endif?>


<?
           }

?>
<!-- Конец Всплывающая картинка -->
        </div>
  </div> <!-- Конец item-info -->

<div style="clear: both;"><br /></div>

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>

<!-- End Ambu -->

<!-- Слайдшоу -->
<!--script type="text/javascript" src="/js/slideshow/jquery.js"></script>
<script type="text/javascript" src="/js/slideshow/fadeSlideShow.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#slideshow').fadeSlideShow();
});
</script-->

<!--?if(count($interierList)>0):?->
<div id="slideshowWrapper">
    <ul id="slideshow">
    <-?for($i=0; $i<count($interierList); $i++){
	$arInterierPathPreview = CFile::GetPath($interierList[$i]["ITEM"]["DETAIL_PICTURE"]);
	$arInterierPathDetail = CFile::GetPath($interierList[$i]["ITEM"]["DETAIL_PICTURE"]);;
    ?->
        <li style="text-align:center;"><div><img src="<-?=$arInterierPathDetail?->" alt="<-?=$interierList[$i]['NAME']?->" border="0" /></div><p><b><a href="<-?=$path?->index.php?SECTION_ID=<-?=$interierList[$i]['ID']?->"><-?=$interierList[$i]['NAME']?-></a></b></p></li>
    <-?
      }
    ?->
  </ul>
  <br clear="all" />
</div>
<-?endif?-->
<!-- Конец Слайдшоу -->

<?else:?>
<!-- Фильтр по ВИДАМ -->

<!-- Ambu -->
<?    
    $interierList=array();
    $i=0;
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$SECTION_ID, "PROPERTY_STYLE"=>$STYLE_ID );
	   $arSelect = Array("ID", "NAME", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_*");
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>40), $arSelect);
	   $NAV_STRING = $items ->GetPageNavStringEx($navComponentObject,  "Товары", "orange");
   	   while($arItem = $items->GetNext()) {
              $interierItem=array();
	      $property = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], "sort", "asc", Array());
              while ($ar_property=$property->GetNext()){ if($ar_property['VALUE']&&(($ar_property['CODE']=="CATALOG")||($ar_property['CODE']=="INTERIER"))) $interierItem['ID']=$ar_property['VALUE']; }
              $interierItem['NAME']=$arItem['NAME'];
              $interierItem['ITEM']=$arItem;
	      $interierList[]= $interierItem; 
	      $i++;
	   }	
?>





<div class="item-info">
	<div class="item-desc">
	<!-- Картинка со всплывающей карточкой товара -->
	<?
	   for($i=0; $i<count($interierList); $i++){
	      $path_pic_detail=CFile::GetPath($interierList[$i]["ITEM"]["DETAIL_PICTURE"]);
	      if($interierList[$i]["ITEM"]["PREVIEW_PICTURE"]) $path_pic=CFile::GetPath($interierList[$i]["ITEM"]["PREVIEW_PICTURE"]); else $path_pic=CFile::GetPath($interierList[$i]["ITEM"]["DETAIL_PICTURE"]);
	      //$arSite = $APPLICATION->GetCurDir();
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* обои */
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* плитка */
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* свет */
	      if($arSite=="/catalog/oboi/" && ($SECTION_ID==3730||$SECTION_TOP==3715)) $path="/catalog/oboi/"; /* фрески */
?>
<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- Заголовок -->
       <? if($path) $title="---<a href='".$path."index.php?SECTION_ID=".$interierList[$i]['ID']."'><nobr>".$interierList[$i]['NAME']."</nobr></a>"; else $title="---<nobr>".$interierList[$i]['NAME']."</nobr>";?>
	<div class="item-title" style="text-align: center;"><b class='big'><?=$title?></b></div>
	<!-- Конец Заголовок -->
	<?$title_text="<p style='text-align: center;'><b class='big'>".$title."</b></p>";?>
	<?$numberElements++;?>
        <div class="item-image">
	    <a  class="fancybox" data-fancybox-group="gallery" href="<?=$path_pic_detail?>" title="<?=$title_text?>"><img src="<?=$path_pic?>" width="125px" height="125px" alt="<?=$interierList[$i]['NAME']?>" title="<?=$interierList[$i]['NAME']?>" id="catalog_list_image_<?=$i?>" /></a>
        </div>
      </div><!-- catalog-interier-card -->

<?endif?>
<?}?>

<!-- Конец Всплывающая картинка -->
        </div>
  </div> <!-- Конец item-info -->

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>
<!-- End Ambu -->



<?endif;?>
<!-- Конец фильтрам -->

<? if($numberElements==0) echo("<p style='padding-left: 5px; font-size: 16px;'>&mdash;&nbsp;Нет интерьеров при заданном условии.</p>"); ?>



