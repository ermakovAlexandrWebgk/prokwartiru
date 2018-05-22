<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Помощь покупателю");
?> 
<p>В этом разделе Вы можете найти ответы на многие вопросы, касающиеся работы нашего сайта. Если Вы не нашли интересующей Вас информации, то можете отправить нам запрос с помощью <a href="../contacts/" >формы обратной связи</a>.</p>
 
<p> <?$APPLICATION->IncludeComponent("bitrix:support.faq.element.list", ".default", array(
	"IBLOCK_TYPE" => "services",
	"IBLOCK_ID" => "2",
	"SECTION_ID" => "1",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?></p>
 
<p><?$APPLICATION->IncludeComponent("bitrix:iblock.element.add", ".default", array(
	"NAV_ON_PAGE" => "10",
	"USE_CAPTCHA" => "N",
	"USER_MESSAGE_ADD" => "",
	"USER_MESSAGE_EDIT" => "",
	"DEFAULT_INPUT_SIZE" => "30",
	"RESIZE_IMAGES" => "N",
	"IBLOCK_TYPE" => "services",
	"IBLOCK_ID" => "2",
	"PROPERTY_CODES" => array(
	),
	"PROPERTY_CODES_REQUIRED" => array(
	),
	"GROUPS" => array(
	),
	"STATUS" => "ANY",
	"STATUS_NEW" => "N",
	"ALLOW_EDIT" => "Y",
	"ALLOW_DELETE" => "Y",
	"ELEMENT_ASSOC" => "CREATED_BY",
	"MAX_USER_ENTRIES" => "100000",
	"MAX_LEVELS" => "100000",
	"LEVEL_LAST" => "Y",
	"MAX_FILE_SIZE" => "0",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/about/faq/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CUSTOM_TITLE_NAME" => "",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "",
	"CUSTOM_TITLE_DETAIL_PICTURE" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?></p>
 
<p></p>
 
<p></p>
 
<p> </p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>