<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $SECTION_ID=$_REQUEST['SECTION_ID'];?>

<?
if($SECTION_ID) {
  $res = CIBlockSection::GetByID($SECTION_ID);
  if($ar_res = $res->GetNext()) $SECTION_TOP=$ar_res['IBLOCK_SECTION_ID'];
}
?>
<?=$arResult["FOLDER"];?>
<table cellspacing="20" style="margin-top:-20px;">
<tr><td><h1 style="text-align:center; margin-bottom:-15px;">нанх</h1></td><td><h1 style="text-align:center; margin-bottom:-15px;">окхрйю</h1></td></tr>
<tr>
<td style="border:1px solid white; width:340px; vertical-align:top; padding-top:20px; padding-left:10px;">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"oboi",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => 5,
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"DISPLAY_PANEL" => "N",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
</td>
<td style="border:1px solid white; width:340px; vertical-align:top; padding-top:20px; padding-left:10px;">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"plitka",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => 4,
		"SECTION_ID" => "SECTION_ID",
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"DISPLAY_PANEL" => "N",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
</td>
</tr>
</table>

