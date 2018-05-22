<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать звонок в интернет-магазине современного интерьера  www.prokwarti.ru");
?>
<h3 style="TEXT-ALIGN: center">Оставитьте номер телефона и мы перезвоним в удобное для Вас время</h3>
<div style="TEXT-ALIGN: center">
  <div style="TEXT-ALIGN: left; WIDTH: 520px">
<?$APPLICATION->IncludeComponent("bitrix:form", ".default", array(
	"START_PAGE" => "new",
	"SHOW_LIST_PAGE" => "N",
	"SHOW_EDIT_PAGE" => "N",
	"SHOW_VIEW_PAGE" => "N",
	"SUCCESS_URL" => "",
	"WEB_FORM_ID" => "6",
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
	"SEF_FOLDER" => "/about/telephone/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
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
</div></div>
<!--p><-?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"form",
	Array(
		"AJAX_MODE" => "N",
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "3",
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"START_PAGE" => "new",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"SUCCESS_URL" => "",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_STATUS" => "Y",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "Y",
		"NOT_SHOW_FILTER" => array(),
		"NOT_SHOW_TABLE" => array(),
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"VARIABLE_ALIASES" => Array(
			"action" => "action"
		)
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?-> </p-->
 
<!--div style="TEXT-ALIGN: center">
  <div style="TEXT-ALIGN: left; WIDTH: 520px"><-?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"telephone",
	Array(
		"WEB_FORM_ID" => "3",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "result_list.php",
		"EDIT_URL" => "result_edit.php",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => Array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID"
		)
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?-></div>
</div-->

<!--?$APPLICATION->IncludeComponent(
	"bitrix:main.clock",
	"clock",
	Array(
		"INPUT_ID" => "",
		"INPUT_NAME" => "",
		"INPUT_TITLE" => "",
		"INIT_TIME" => "",
		"STEP" => "5"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?-> <-?$APPLICATION->IncludeComponent(
	"bitrix:main.calendar",
	".default",
	Array(
		"SHOW_INPUT" => "N",
		"FORM_NAME" => "",
		"INPUT_NAME" => "date_fld",
		"INPUT_NAME_FINISH" => "date_fld_finish",
		"INPUT_VALUE" => "",
		"INPUT_VALUE_FINISH" => "",
		"SHOW_TIME" => "N",
		"HIDE_TIMEBAR" => "N"
	)
);?-->
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>