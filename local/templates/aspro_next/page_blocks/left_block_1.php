<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<? global $arTheme, $APPLICATION;?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/menu.left_menu.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false
);?>

<?$APPLICATION->ShowViewContent('left_menu');?>
<?$APPLICATION->ShowViewContent('under_sidebar_content');?>

<div class="chat" style="text-align: right;">
<!-- webim button --><a href="http://prokwarti.ru/webim/client.php?locale=ru&amp;style=original" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('http://prokwarti.ru/webim/client.php?locale=ru&amp;style=original&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="http://prokwarti.ru/webim/b.php?i=mgreen&amp;lang=ru" border="0" width="169" alt=""/></a><!-- / webim button -->
                </div>

<?CNext::get_banners_position('SIDE', 'Y');?>

<?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/comp_subscribe.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false
);*/?>
<?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/comp_news.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false
);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/comp_news_articles.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false
);*/?>
