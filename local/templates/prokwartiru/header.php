<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--?$APPLICATION->ShowHead();?-->

<!--script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script-->
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/jquery/fancybox/jquery.fancybox-1.3.1.css" media="screen" />

<!--script type="text/javascript" src="/js/jquery-1.3.2.js"></script-->

<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/script.js"></script>
<!--title><-?$APPLICATION->ShowTitle()?-></title-->
<title><?$APPLICATION->ShowTitle(false)?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!--[if IE 6]>
 <link rel="stylesheet" type="text/css" href="css/ie6.css" />
 <script src="js/DD_belatedPNG_0.0.8a-min.js"></script>
 <script>DD_belatedPNG.fix(".png");</script>
<![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/common.css" />




<?$APPLICATION->ShowHead();?>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/script.js"></script>

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
<meta name='yandex-verification' content='4bcac561823608b5' />
<meta name="google-site-verification" content="XrlsaGQF-SoWI6r2UnJ7-KTDrX5fFslU73TfxVQjrUc" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35983755-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!-- Последняя вставка -->


</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div id="wrapper">
    	<div id="header">
        	<a class="logo png" href="http://prokwarti.ru/" title=""></a>
        	<!--div class="telephone">8 985 <b>1551755</b></div-->
        </div> <!-- header close -->
        
        <div class="mm">
        	
        <?$APPLICATION->IncludeComponent("bitrix:menu", "main-menu", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "Y",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "2",
	"CHILD_MENU_TYPE" => "sub",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
       </div><!-- mm -->
        <div id="content">
          <div id="content-inner">
            <?$arSite = $APPLICATION->GetCurDir();?>            	
              <!--div class="clr"></div-->
              <div id="top-menu">
              <?if($arSite=="/"):?>
                <div class="links">  
		<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "incmainlinks",
	"EDIT_TEMPLATE" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>

                
              	
  </div><?endif?> <!-- links close -->
  <div class="linkst">
<table /*width="100"*/ border="0" cellpadding="0" cellspacing="10">
  <tr>
    <td <?if($arSite=="/catalog/oboi/"):?>class="twal_on"<?else:?>class="twal1"<?endif?> ><a href="/catalog/oboi/">ОБОИ<br /><span style="font-size: 12px; font-weight: bold;">17400 видов</span></a></td>
    <td <?if($arSite=="/catalog/plitka/"):?>class="twal_on"<?else:?>class="twal2"<?endif?> ><a href="/catalog/plitka/">ПЛИТКА<br /><span style="font-size: 12px; font-weight: bold;">6500 коллекций</span></a></td>
    <td <?if($arSite=="/catalog/mosaic/"):?>class="twal_on"<?else:?>class="twal3"<?endif?> ><a href="/catalog/mosaic/">МОЗАИКА<br /><span style="font-size: 12px; font-weight: bold;">&nbsp;</span></a></td>
    <td <?if($arSite=="/catalog/lights/"):?>class="twal_on"<?else:?>class="twal4"<?endif?> ><a href="/catalog/lights/">СВЕТ<br /><span style="font-size: 12px; font-weight: bold;">&nbsp;</span></a></td>
    <td <?if($arSite=="/catalog/lepnina/"):?>class="twal_on"<?else:?>class="twal5"<?endif?> ><a href="/catalog/lepnina/">ЛЕПНИНА<br /><span style="font-size: 12px; font-weight: bold;">&nbsp;</span></a></td>
  </tr>
</table>
</div>
<!--p style="text-align: center; padding-bottom: 3px; font-size: 14px;"><b>Дизайн-проект 3Д - В ПОДАРОК!</b></p-->  
<!--?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "template1", array(
	"START_FROM" => "1",
	"PATH" => "",
	"SITE_ID" => "s1"
	),
	false
);?-->

<?$arSite = $APPLICATION->GetCurDir();?>
<?if($arSite=="/catalog/test/"):?><p style="text-align: center; padding-bottom: 6px; font-size: 14px;"><b>Дизайн-проект 3D - в ПОДАРОК!</b></p><?endif?> 

<!--?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "filter",
	"AREA_FILE_RECURSIVE" => "N",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?-->
              </div><!-- top-menu close -->

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
<!--?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "title",
	"EDIT_TEMPLATE" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?-->
<div id="workarea">