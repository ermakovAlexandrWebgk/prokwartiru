<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["PREVIEW_TEXT"] = strip_tags($arResult["PREVIEW_TEXT"]);
$arParams['USE_COMPARE'] = "Y";
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
		array("max-width" => 250, 'max-height' => 250),
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