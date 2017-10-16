<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#",
		"RULE" => "REQUEST_OBJECT=\$1&METHOD=\$4",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#",
		"RULE" => "alias=\$1",
		"ID" => "",
		"PATH" => "/desktop_app/router.php",
	),
	array(
		"CONDITION" => "#^/personal/history-of-orders/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/history-of-orders/index.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/online/(/?)([^/]*)#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/desktop_app/router.php",
	),
	array(
		"CONDITION" => "#^/stssync/calendar/#",
		"RULE" => "",
		"ID" => "bitrix:stssync.server",
		"PATH" => "/bitrix/services/stssync/calendar/index.php",
	),
	array(
		"CONDITION" => "#^/contacts/stores/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/contacts/stores/index.php",
	),
	array(
		"CONDITION" => "#^/company/vacancy/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/vacancy/index.php",
	),
	array(
		"CONDITION" => "#^/contacts/stores/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/contacts/stores/index.php",
	),
	array(
		"CONDITION" => "#^/personal/order/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/order/index.php",
	),
	array(
		"CONDITION" => "#^/company/staff/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/staff/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/oboi/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/catalog/oboi/index.php",
	),
	array(
		"CONDITION" => "#^/company/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/company/news/index.php",
	),
	array(
		"CONDITION" => "#^/info/brands/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/info/brands/index.php",
	),
	array(
		"CONDITION" => "#^/personal/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.section",
		"PATH" => "/personal/index.php",
	),
	array(
		"CONDITION" => "#^/landings/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/landings/index.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/services/index.php",
	),
	array(
		"CONDITION" => "#^/projects/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/projects/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/advices/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/advices/index.php",
	),
	array(
		"CONDITION" => "#^/blog/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/blog/index.php",
	),
	array(
		"CONDITION" => "#^/auth/#",
		"RULE" => "",
		"ID" => "aspro:auth.next",
		"PATH" => "/auth/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#^/sale/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/sale/index.php",
	),
);

?>