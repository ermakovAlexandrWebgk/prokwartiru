<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?$APPLICATION->ShowHead();?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/script.js"></script>

<title><?$APPLICATION->ShowTitle()?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!--[if IE 6]>
 <link rel="stylesheet" type="text/css" href="css/ie6.css" />
 <script src="js/DD_belatedPNG_0.0.8a-min.js"></script>
 <script>DD_belatedPNG.fix(".png");</script>
<![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/common.css" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/jquery/jquery-

1.4.2.min.js"></script>
<?$APPLICATION->ShowHead();?>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/script.js"></script>

 <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
    <script type="text/javascript">
        $(function() {
            var offset = $(".sidebar-menu").offset();
            var topPadding = 0;
            $(window).scroll(function() {
                if ($(window).scrollTop() > offset.top) {
                    $(".sidebar-menu").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $(".sidebar-menu").stop().animate({
                        marginTop: 0
                    });
                };
            });
        });
    </script>


<!--[if IE]>
<style type="text/css">
	#fancybox-loading.fancybox-ie div	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_loading.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-close		{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_close.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-title-over	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_title_over.png', sizingMethod='scale'); zoom: 1; }
	.fancybox-ie #fancybox-title-left	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_title_left.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-title-main	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_title_main.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-title-right	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_title_right.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-left-ico		{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_nav_left.png', sizingMethod='scale'); }
	.fancybox-ie #fancybox-right-ico	{ background: transparent; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_nav_right.png', sizingMethod='scale'); }
	.fancybox-ie .fancy-bg { background: transparent !important; }
	.fancybox-ie #fancy-bg-n	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_n.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-ne	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_ne.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-e	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_e.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-se	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_se.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-s	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_s.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-sw	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_sw.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-w	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_w.png', sizingMethod='scale'); }
	.fancybox-ie #fancy-bg-nw	{ filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/fancy_shadow_nw.png', sizingMethod='scale'); }
</style>
<![endif]-->

<script type="text/javascript">if (document.documentElement) { document.documentElement.id = "js" }</script>
</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div id="wrapper">
    	<div id="header">
        	<a class="logo png" href="http://prokwarti.ru/" title=""></a>
        </div> <!-- header close -->
        
        <div class="mm">
        	
           <?
					$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel1", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "Y",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "2",
	"CHILD_MENU_TYPE" => "level2",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
					?>

<!--

		   <?$APPLICATION->IncludeComponent("bitrix:search.title", "store", array(
						"NUM_CATEGORIES" => "1",
						"TOP_COUNT" => "5",
						"CHECK_DATES" => "N",
						"SHOW_OTHERS" => "Y",
						"PAGE" => "#SITE_DIR#search/",
						"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
						"CATEGORY_0" => array(
							0 => "iblock_catalog",
						),
						"CATEGORY_0_iblock_catalog" => array(
							0 => "all",
						),
						"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
						"SHOW_INPUT" => "Y",
						"INPUT_ID" => "title-search-input",
						"CONTAINER_ID" => "search"
						),
						false
					);?> -->
       </div><!-- mm -->
        <div id="content">
        	<div id="content-inner">
            	
                <div class="clr"></div>
                <div class="links">
                
                <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "incmainlinks",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>
                
              	
  </div> <!-- links close -->
  <div class="linkst"><table width="100" border="0">
  <tr>
    <td class="twal1"><a href="/catalog/wallpaper/">Œ¡Œ»<br /><span style="font-size: 12px; font-weight: bold;">1200 ‚Ë‰Ó‚</span></a></td>
    <td class="twal2"><a href="/tile/">œÀ»“ ¿<br /><span style="font-size: 12px; font-weight: bold;">1200 ‚Ë‰Ó‚</span></a></td>
    <td class="twal3"><a href="/catalog/mosaic/">ÃŒ«¿» ¿<br /><span style="font-size: 12px; font-weight: bold;">&nbsp;</span></a></td>
    <td class="twal4"><a href="/catalog/curtains/">ÿ“Œ–€<br /><span style="font-size: 12px; font-weight: bold;">&nbsp;</span></a></td>
    <td class="twal5"><a href="/">ƒ»«¿…Õ<br /><span style="font-size: 12px; font-weight: bold;">·˛Ó</span></a></td>
  </tr>
</table>
</div>
  
  
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "template1", Array(
	"START_FROM" => "1",	
	"PATH" => "",	
	"SITE_ID" => "-",	
	),
	false
);?> 
  
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "filter",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>


                <div class="text">
				<?
					$APPLICATION->IncludeComponent(".default", array(
						"START_FROM" => "1",
						"PATH" => "",
						"SITE_ID" => "-"
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);
					?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "title",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>
