<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������� � ��������-�������� ������������ ���������  www.prokwarti.ru");
?> 
<div style="text-align: center;" id="login"><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"auth",
	Array(
		"REGISTER_URL" => "/auth/",
		"PROFILE_URL" => "/personal/profile/"
	)
);?></div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:store.sale.basket.basket",
	"basket1",
	Array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(0=>"NAME",1=>"PRICE",2=>"QUANTITY",3=>"DELETE",4=>"DELAY",5=>"DISCOUNT",),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "Y",
		"QUANTITY_FLOAT" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SET_TITLE" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>�<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>