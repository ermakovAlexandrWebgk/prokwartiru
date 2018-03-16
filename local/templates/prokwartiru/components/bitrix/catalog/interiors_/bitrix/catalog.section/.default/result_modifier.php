<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// cache hack to use items list in component_epilog.php
$this->__component->arResult["IDS"] = array();

if(isset($arParams["DETAIL_URL"]) && strlen($arParams["DETAIL_URL"]) > 0)
	$urlTemplate = $arParams["DETAIL_URL"];
else
	$urlTemplate = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "DETAIL_PAGE_URL");

//2 Sections subtree
$arSections = array();
$rsSections = CIBlockSection::GetList(
	array(), 
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"LEFT_MARGIN" => $arResult["LEFT_MARGIN"],
		"RIGHT_MARGIN" => $arResult["RIGHT_MARGIN"],
	), 
	false, 
	array("ID", "DEPTH_LEVEL", "SECTION_PAGE_URL")
);

while($arSection = $rsSections->Fetch())
	$arSections[$arSection["ID"]] = $arSection;

foreach ($arResult["ITEMS"] as $key => $arElement) 
{
	$this->__component->arResult["IDS"][] = $arElement["ID"];
	
	if(is_array($arElement["DETAIL_PICTURE"]))
	{
		$arFileTmp = CFile::ResizeImageGet(
			$arElement["DETAIL_PICTURE"],
			array("width" => 137, "height" => 137),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);

		$arResult["ITEMS"][$key]["PREVIEW_IMG"] = array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => IntVal($arSize[0]),
			"HEIGHT" => IntVal($arSize[1]),
		);
	}
	
	$section_id = $arElement["~IBLOCK_SECTION_ID"];

	/*
	$section_id = false;
	$rsSections = CIBlockElement::GetElementGroups($arElement["ID"]);
	while($arSection = $rsSections->Fetch())
	{
		if(array_key_exists($arSection["ID"], $arSections))
		{
			if(
				$section_id === false
				|| $arSections[$arSection["ID"]]["DEPTH_LEVEL"] > $arSections[$section_id]["DEPTH_LEVEL"]
			)
			{
				$section_id = $arSection["ID"];
			}
		}
	}*/
	
	if(array_key_exists($section_id, $arSections))
	{
		$urlSection = str_replace(
			array("#SECTION_ID#", "#SECTION_CODE#"),
			array($arSections[$section_id]["ID"], $arSections[$section_id]["CODE"]),
			$urlTemplate
		);

		$arResult["ITEMS"][$key]["DETAIL_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
			$urlSection,
			$arElement,
			true,
			"E"
		);
	}	
	
}

$this->__component->SetResultCacheKeys(array("IDS"));


?>





<!-- Вставлено -->

<?
//$arResult["PREVIEW_TEXT"] = strip_tags($arResult["PREVIEW_TEXT"]);
if ($arParams['USE_COMPARE'])
{
	$delimiter = strpos($arParams['COMPARE_URL'], '?') ? '&' : '?';

	$arResult['COMPARE_URL'] = str_replace("#ACTION_CODE#", "ADD_TO_COMPARE_LIST",$arParams['COMPARE_URL']).$delimiter."id=".$arResult['ID'];

	$arResult['COMPARE_URL'] = htmlspecialchars($APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arResult['ID'], array("action", "id")));
}

if(is_array($arResult["DETAIL_PICTURE"]))
{
	$arFileTmp = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
		array("width" => 350, 'height' => 1000),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false
	);
	$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);

	$arResult['DETAIL_PICTURE_350'] = array(
		'SRC' => $arFileTmp["src"],
		'WIDTH' => IntVal($arSize[0]),
		'HEIGHT' => IntVal($arSize[1]),
	);
}

if (is_array($arResult['MORE_PHOTO']) && count($arResult['MORE_PHOTO']) > 0)
{
	unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);

	foreach ($arResult['MORE_PHOTO'] as $key => $arFile)
	{
		$arFileTmp = CFile::ResizeImageGet(
			$arFile,
			array("width" => 50, 'height' => 50),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		$arFile['PREVIEW_WIDTH'] = IntVal($arSize[0]);
		$arFile['PREVIEW_HEIGHT'] = IntVal($arSize[1]);

		$arFile['SRC_PREVIEW'] = $arFileTmp['src'];
		$arResult['MORE_PHOTO'][$key] = $arFile;
	}
}
?>
