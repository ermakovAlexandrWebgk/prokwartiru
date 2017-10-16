<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Помощь покупателю");
?> 
<p>В этом разделе Вы можете найти ответы на многие вопросы, касающиеся работы нашего сайта. Если Вы не нашли интересующей Вас информации, то можете отправить нам запрос с помощью <a href="../contacts/" >формы обратной связи</a>.</p>
 
<?$APPLICATION->IncludeComponent("bitrix:form", "form", array(
	"START_PAGE" => "new",
	"SHOW_LIST_PAGE" => "N",
	"SHOW_EDIT_PAGE" => "N",
	"SHOW_VIEW_PAGE" => "N",
	"SUCCESS_URL" => "",
	"WEB_FORM_ID" => "2",
	"RESULT_ID" => $_REQUEST[RESULT_ID],
	"SHOW_ANSWER_VALUE" => "N",
	"SHOW_ADDITIONAL" => "N",
	"SHOW_STATUS" => "Y",
	"EDIT_ADDITIONAL" => "N",
	"EDIT_STATUS" => "Y",
	"NOT_SHOW_FILTER" => array(
		0 => "",
		1 => "",
	),
	"NOT_SHOW_TABLE" => array(
		0 => "",
		1 => "",
	),
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/about/faq/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"action" => "action",
	)
	),
	false
);?>
<hr />
 <?$APPLICATION->IncludeComponent("bitrix:form.result.list", "form.result.list", array(
	"WEB_FORM_ID" => "2",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/about/faq/",
	"VIEW_URL" => "index.php",
	"EDIT_URL" => "result_edit.php",
	"NEW_URL" => "result_new.php",
	"SHOW_ADDITIONAL" => "N",
	"SHOW_ANSWER_VALUE" => "N",
	"SHOW_STATUS" => "N",
	"NOT_SHOW_FILTER" => array(
		0 => "",
		1 => "",
	),
	"NOT_SHOW_TABLE" => array(
		0 => "",
		1 => "",
	),
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?> 
<p><?$APPLICATION->IncludeComponent(
	"bitrix:support.faq.element.list",
	".default",
	Array(
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
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?></p>
 
<p></p>
 
<p></p>
 
<p></p>
 
<p> </p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>