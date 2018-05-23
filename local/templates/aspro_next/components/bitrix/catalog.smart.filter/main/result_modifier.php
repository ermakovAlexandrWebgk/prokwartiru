<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    //arshow($arResult["ITEMS"]);

    $arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

    foreach($arResult["ITEMS"] as $key => $arItem)
    {
        if($arItem["CODE"]=="IN_STOCK"){
            sort($arResult["ITEMS"][$key]["VALUES"]);
            if($arResult["ITEMS"][$key]["VALUES"])
                $arResult["ITEMS"][$key]["VALUES"][0]["VALUE"]=$arItem["NAME"];
        }
    }
    $arItemsProps = array();
    foreach ($arResult["ITEMS"] as $arItem) {
        if (!empty($arItem["VALUES"])) {
            $arItemsProps[] = $arItem["ID"];
        }
    }

    //кеширование запроса списка свойств
    $arIblockProps = array();
    
    
    $cache = new CPHPCache();
    if ($cache->InitCache(36000000, "IBLOCK_CATALOG_PROPS_" . $arParams["IBLOCK_ID"], "/work_catalog")) {
        $data = $cache->GetVars();
        $arIblockProps = $data['result'];
    } elseif ($cache->StartDataCache()) {
       
        $res = CIBlock::GetProperties($arParams["IBLOCK_ID"], array(), array());
        while ($arRes = $res -> Fetch()) {
            if (in_array($arRes["ID"], $arItemsProps)) {
                $arIblockProps[$arRes["ID"]] = $arRes["SORT"];
            }
        }  
        $cache->EndDataCache(array("result" => $arIblockProps)); // записываем в кеш  
    }                                              
    

    global $sotbitFilterResult;
    $sotbitFilterResult = $arResult;

    CModule::IncludeModule("iblock");
    $arSection = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["SECTION"]["ID"]), false, Array("UF_HIDDEN"))->GetNext();
    $arSect = array();
    if($arSection["UF_HIDDEN"])
        {$arSect = $arSection["UF_HIDDEN"];}

    $arParentSection = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arSection["IBLOCK_SECTION_ID"]), false, Array("UF_HIDDEN"))->GetNext();
    $arParentSect = array();
    if($arParentSection["UF_HIDDEN"])
        {$arParentSect = $arParentSection["UF_HIDDEN"];}

    $arParentParentSection = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arParentSection["IBLOCK_SECTION_ID"]), false, Array("UF_HIDDEN"))->GetNext();
    $arParentParentSect = array();
    if($arParentParentSection["UF_HIDDEN"])
        {$arParentParentSect = $arParentParentSection["UF_HIDDEN"];}


    if (!empty($arIblockProps)) {
        asort($arIblockProps);
        usort($arResult["ITEMS"], function($a, $b) use ($arIblockProps) {
            if ($arIblockProps[$a["ID"]] == $arIblockProps[$b["ID"]]) {
                return 0;
            }
            return ($arIblockProps[$a["ID"]] < $arIblockProps[$b["ID"]]) ? -1 : 1;
        });
    }

    $arResult["HIDDEN_PROPS"] = array_merge($arSect, $arParentSect, $arParentParentSect);
