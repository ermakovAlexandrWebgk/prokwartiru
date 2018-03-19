<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"]["AnDelCanBuy"] as $key=>$arBasketItems) {
    if(CModule::IncludeModule("iblock")) {
        $res = CIBlockElement::GetByID($arBasketItems["PRODUCT_ID"]);
        if($ob_res = $res->GetNextElement()) {
            $ar_res = $ob_res->GetFields();
            $ar_props = $ob_res->GetProperties();
            $arFile = CFile::GetFileArray($ar_res['PREVIEW_PICTURE']);
            $arResult["ITEMS"]["AnDelCanBuy"][$key]['IBLOCK_NAME'] = $ar_res['IBLOCK_NAME'];
            if($arFile) {
                $arResult["ITEMS"]["AnDelCanBuy"][$key]['PREVIEW_PICTURE_SRC'] = $arFile["SRC"];
            }
            $arResult["ITEMS"]["AnDelCanBuy"][$key]['ARTICUL'] = $ar_props["ARTICUL"]["VALUE"];
            $arResult["ITEMS"]["AnDelCanBuy"][$key]['COUNTRY'] = $ar_props["PROP2"]["VALUE"];
        }
    }
}
foreach($arResult["ITEMS"]["DelDelCanBuy"] as $key=>$arBasketItems) {
    if(CModule::IncludeModule("iblock")) {
        $res = CIBlockElement::GetByID($arBasketItems["PRODUCT_ID"]);
        if($ob_res = $res->GetNextElement()) {
            $ar_res = $ob_res->GetFields();
            $ar_props = $ob_res->GetProperties();
            $arFile = CFile::GetFileArray($ar_res['PREVIEW_PICTURE']);
            $arResult["ITEMS"]["DelDelCanBuy"][$key]['IBLOCK_NAME'] = $ar_res['IBLOCK_NAME'];
            if($arFile) {
                $arResult["ITEMS"]["DelDelCanBuy"][$key]['PREVIEW_PICTURE_SRC'] = $arFile["SRC"];
            }
            $arResult["ITEMS"]["DelDelCanBuy"][$key]['ARTICUL'] = $ar_props["ARTICUL"]["VALUE"];
            $arResult["ITEMS"]["DelDelCanBuy"][$key]['COUNTRY'] = $ar_props["PROP2"]["VALUE"];
        }
    }
}

?>