<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- ���������� �������� ������ -->

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

<!-- ����� ���������� �������� ������ -->

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
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) { $FABRIKI_TYPE_ID=51; $TYPE_ID=5; } /* ���� */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) { $FABRIKI_TYPE_ID=78; $TYPE_ID=4; } /* ������ */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) { $FABRIKI_TYPE_ID=759; $TYPE_ID=17; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* ���� */
	if($arSite=="/catalog/interiers/" && ($SECTION_ID==1317||$SECTION_TOP==1317)) { $FABRIKI_TYPE_ID=140; $TYPE_ID=10; $PROPERTY="PROPERTY_CATALOG_LIGHTS"; } /* ������� */
?>

<?$numberElements=0;?>

<!-- ������ �� �������� -->
<?if($FABRIKA_ID):?>

<!-- Ambu -->
<?    
    $interierList=array();
    $arFilter = Array('IBLOCK_ID'=>$TYPE_ID, 'UF_FABRIKA' => $FABRIKA_ID); // ������ �� ��������
    $listCatalogFabrika = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, true);
    $i=0;
    while($itemCatalogFabrika = $listCatalogFabrika->GetNext()){   
	   $arSort = Array("NAME"=>"ASC");
	   $arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>$itemCatalogFabrika['ID']);
//echo($itemCatalogFabrika['NAME']);
	   $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
	   $items = CIBlockElement::GetList($arSort, $arFilter, false, Array(), $arSelect);
   	   while($arItem = $items->GetNext()){
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
	<!-- �������� �� ����������� ��������� ������ -->



	<?
	   $NAV_STRING = $items->GetPageNavStringEx($navComponentObject,  "������", "orange");
	   for($i=0; $i<count($interierList); $i++){
	      $path_pic_detail=CFile::GetPath($interierList[$i]['ITEM']["DETAIL_PICTURE"]);
	      $arSite = $APPLICATION->GetCurDir();
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* ���� */
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* ������ */
	      if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* ���� */
?>
<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- ��������� -->
       <? if($path) $title="<a href='".$path."index.php?SECTION_ID=".$interierList[$i]['ID']."'><nobr>".$interierList[$i]['NAME']."</nobr></a>"; else $title="<nobr>".$interierList[$i]['NAME']."</nobr>";?>
	<div class="item-title" style="text-align: center;"><b class='big'><?=$title?></b></div>
	<!-- ����� ��������� -->
	<?$title_text="<p style='text-align: center;'><b class='big'>".$title."</b></p>";?>
	<?$numberElements++;?>
        <div class="item-image">
	    <a  class="fancybox" data-fancybox-group="gallery" href="<?=$path_pic_detail?>" title="<?=$title_text?>"><img src="<?=$path_pic_detail?>" width="125px" height="125px" alt="<?=$interierList[$i]['NAME']?>" title="<?=$interierList[$i]['NAME']?>" id="catalog_list_image_<?=$i?>" /></a>
        </div>
      </div><!-- catalog-interier-card -->

<?endif?>
<?

           }
   	   while($arItem = $items->GetNext())
   	   {
	     $path_pic_detail=CFile::GetPath($arItem["DETAIL_PICTURE"]);
		$arSite = $APPLICATION->GetCurDir();
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==76||$SECTION_TOP==76)) $path="/catalog/oboi/"; /* ���� */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==86||$SECTION_TOP==86)) $path="/catalog/plitka/"; /* ������ */
		if($arSite=="/catalog/interiers/" && ($SECTION_ID==865||$SECTION_TOP==865)) $path="/catalog/lights/"; /* ���� */
?>

<?if($path_pic_detail):?>
      <div class="catalog-interier-card">
       <!-- ��������� -->
       <? if($path) $title="<a href='".$path."index.php?SECTION_ID=".$itemCatalogFabrika['ID']."'><nobr>".$itemCatalogFabrika['NAME']."</nobr></a>"; else $title="<nobr>".$itemCatalogFabrika['NAME']."</nobr>";?>
       <div class="item-title" style="text-align: center;"><b class='big'><?=$title?></b></div>
       <!-- ����� ��������� -->
	<?$title_text="<p style='text-align: center;'><b class='big'>".$title."</b></p>";?>
	  <?$numberElements++;?>
       <div class="item-image">
	<a class="fancybox" data-fancybox-group="gallery" href="<?=$path_pic_detail?>" title="<?=$title_text?>"><img src="<?=$path_pic_detail?>" width="125px" height="125px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" id="catalog_list_image_<?=$arItem['ID']?>" /></a>
       </div>
      </div><!-- catalog-interier-card -->
<!--? $arParams["DISPLAY_BOTTOM_PAGER"]=true;?-->
<?endif?>
<?
   }
?>

<!-- ����� ����������� �������� -->
        </div>
  </div> <!-- ����� item-info -->


<div style="clear: both;"><br /></div>

<div id="page_navigation">
  <? echo($NAV_STRING); ?>
</div>

<!-- End Ambu -->







<?else:?>
<!-- ������ �� ����� -->

<div class="catalog-interier-cards">
<?
foreach ($arResult['ITEMS'] as $key => $arElement):
if(($STYLE_ID=="")||($arElement["PROPERTIES"]["STYLE"]["VALUE_ENUM_ID"]==$STYLE_ID)){
	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>
	<div class="_catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
	<div class="catalog-interier-card">

<!-- ������ �� ������� -->
<?
	if($arElement['PROPERTIES']['CATALOG']['VALUE']) $arSite="/catalog/oboi/index.php?SECTION_ID=".$arElement['PROPERTIES']['CATALOG']['VALUE']; 
	elseif($arElement['PROPERTIES']['INTERIER']['VALUE']) $arSite="/catalog/plitka/index.php?SECTION_ID=".$arElement['PROPERTIES']['INTERIER']['VALUE'];
	elseif($arElement['PROPERTIES']['CATALOG_LIGHTS']['VALUE']) $arSite="/catalog/lights/index.php?SECTION_ID=".$arElement['PROPERTIES']['CATALOG_LIGHTS']['VALUE'];
?>
<!-- ����� ������ �� ������� -->

<!-- ��������� -->
  <div class="item-title" style="text-align: center;"><?if($arSite):?><a href=<?=$arSite?>><?endif?><b><nobr><?=$arElement["NAME"]?></nobr></b><?if($arSite):?></a><?endif?><?=$sticker?></div>
<!-- ����� ��������� -->

  <div class="item-info">
	<div class="item-desc">				
<!-- �������� �� ����������� ��������� ������ -->
<?if($bHasPicture):?>

<!-- ��������� ����� �������� ������ -->

<!-- ��������� �������� ������ -->
<? $title=$arElement['NAME']; ?>
<?
	if($arSite) $title="<a href='".$arSite."'>".$arElement['NAME']."</a>";
	else $title=$arElement['NAME'];
?>
<!-- ����� ��������� �������� ������ -->

<!-- ������������ � �������������� �������� ��� ����������� �������� ������ -->

	<?$title_text="<p style='text-align: center;'><b class='big'>".$title."</b></p>";?>


<!-- ����� �������������� � �������� -->

<!-- ����� ����� �������� -->

<?$numberElements++;?>
<div class="item-image">
	<a class="fancybox" data-fancybox-group="gallery" href="<?=$arElement['DETAIL_PICTURE']['SRC']?>" title="<?=$title_text?>"><img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement['PREVIEW_IMG']['WIDTH']?>" height="<?=$arElement['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>" /></a>		
</div>
<!--? $arParams["DISPLAY_BOTTOM_PAGER"]=true;?-->
<?endif?>

<!-- ����� ����������� �������� -->


		</div> <!-- ����� item-info -->

	    </div> <!-- ����� catalog-interier-card -->


	</div> <!-- ����� catalog-item -->


    <!--div class="catalog-item-separator"></div-->
<?}?>
<?endforeach;?>




</div>

<div id="page_navigation">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"];?>
<?endif;?>
</div>









<?endif;?>
<!-- ����� �������� -->

<? if($numberElements==0) echo("<p style='padding-left: 5px; font-size: 16px;'>&mdash;&nbsp;��������� �� �������.</p>"); ?>




