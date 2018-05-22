<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы в интернет-магазине современного интерьера  www.prokwarti.ru");
?><h3 style="text-align: center;">Отзывы о работе нашего магазина</h3> 
<!--h3 style="text-align: center;">Вы можете оставить отзыв о работе нашего магазина</h3-->
 <!--?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"form",
	Array(
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
		"NOT_SHOW_FILTER" => array(0=>"",1=>"",),
		"NOT_SHOW_TABLE" => array(0=>"",1=>"",),
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"VARIABLE_ALIASES" => Array(
			"action" => "action"
		)
	)
);?--> <!--hr style="height: 1px; color: rgb(145, 144, 141); background-color: rgb(145, 144, 141);" /> 
<br />
 
<br /-->
 
<div style="margin: 0px auto; width: 600px;"> <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.list",
	"form.result.list",
	Array(
		"WEB_FORM_ID" => "2",
		"SEF_MODE" => "N",
		"VIEW_URL" => "index.php",
		"EDIT_URL" => "result_edit.php",
		"NEW_URL" => "result_new.php",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_STATUS" => "N",
		"NOT_SHOW_FILTER" => array(0=>"",1=>"",),
		"NOT_SHOW_TABLE" => array(0=>"",1=>"",),
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => ""
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>