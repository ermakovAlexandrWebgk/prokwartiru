<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталоги");
?><?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "4",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "Y",
	"TOP_DEPTH" => "2",
	"SECTION_FIELDS" => array(
		0 => "CODE",
		1 => "NAME",
		2 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "UF_FABRIKA",
		1 => "",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ADD_SECTIONS_CHAIN" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?> 
<div><?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфо-блока
	"IBLOCK_ID" => "6",	// Инфо-блок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => "",	// Код раздела
	"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => array(	// Поля разделов
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// Свойства разделов
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	),
	false
);?> </div>
 <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "left_menu", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "6",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "3",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "UF_COLLECTIONS",
		2 => "",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "N",
	"ADD_SECTIONS_CHAIN" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>