<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="footer_inner <?=($arTheme["SHOW_BG_BLOCK"]["VALUE"] == "Y" ? "fill" : "no_fill");?>" >

<div class="wrapper_inner">
	<div class="footer_bottom_inner">
		<div class="left_block">
			<div id="bx-composite-banner"></div>
		</div>
		<div class="right_block">
			<div class="middle">
				<div class="row">
					<div class="item_block col-md-9 menus">
						<div class="row">
							<div class="item_block col-md-4 col-sm-4">
								<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_rework", Array(
	"ROOT_MENU_TYPE" => "footer_menu",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600000",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"COMPONENT_TEMPLATE" => "horizontal_multilevel",
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
	),
	false
);?>
							</div>
						</div>
					</div>
				
						
					
				</div>
			</div>
		</div>
	</div>
	<div class="mobile_copy">
		<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"PATH" => SITE_DIR."include/footer/copyright.php",
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => "include_area.php"
			),
			false
		);?>
	</div>
</div>
</div>
