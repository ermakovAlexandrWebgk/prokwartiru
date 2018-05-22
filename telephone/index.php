<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Перезвонить");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"add_recall", 
	array(
		"CUSTOM_TITLE_NAME" => "Ваше имя",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "79",
		"IBLOCK_TYPE" => "services",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
		"PROPERTY_CODES" => array(
			0 => "999",
			1 => "1000",
			2 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "999",
			1 => "NAME",
		),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Заявка добавлена",
		"USER_MESSAGE_EDIT" => "Заявка добавлена",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "add_recall",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
);?>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>