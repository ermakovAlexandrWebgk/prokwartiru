<?global $arTheme;?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header-regionality-block");?>
<?$APPLICATION->IncludeComponent(
	"aspro:regionality.list.next",
	strtolower($arTheme["USE_REGIONALITY"]["DEPENDENT_PARAMS"]["REGIONALITY_VIEW"]["VALUE"]),
	Array(
		
	)
);?>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header-regionality-block", "");?>