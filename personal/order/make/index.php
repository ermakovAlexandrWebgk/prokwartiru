<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������");
?><?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", ".default", array(
	"PAY_FROM_ACCOUNT" => "Y",
	"COUNT_DELIVERY_TAX" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
	"ALLOW_AUTO_REGISTER" => "Y",
	"SEND_NEW_USER_NOTIFY" => "N",
	"DELIVERY_NO_AJAX" => "Y",
	"PROP_1" => array(
	),
	"PROP_2" => array(
	),
	"PATH_TO_BASKET" => "/personal/cart/",
	"PATH_TO_PERSONAL" => "/personal/order/",
	"PATH_TO_PAYMENT" => "/personal/order/payment/",
	"PATH_TO_AUTH" => "/auth/",
	"SET_TITLE" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>