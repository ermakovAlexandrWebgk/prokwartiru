<?global $arTheme;?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"top_fixed_field",
	Array(
		"COMPONENT_TEMPLATE" => "top_fixed_field",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		//"MAX_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],
        "MAX_LEVEL" => 2,
		"ALLOW_MULTI_SELECT" => "Y",
		"ROOT_MENU_TYPE" => "fixed_top_catalog",
		"CHILD_MENU_TYPE" => "left",
		"CACHE_SELECTED_ITEMS" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"USE_EXT" => "Y"
	)
);?>