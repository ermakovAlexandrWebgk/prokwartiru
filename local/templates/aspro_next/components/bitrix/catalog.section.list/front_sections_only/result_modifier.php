<?
foreach ($arResult["SECTIONS"] as $key => $arSection) {
    if ($_REQUEST["CHEAP"] && $arSection["UF_CHEAP"] != 1) {
        unset($arResult["SECTIONS"][$key]);
    } else if (isset($_SESSION["view_by_collections"]) && $arSection["DEPTH_LEVEL"] == 2) {
        unset($arResult["SECTIONS"][$key]);
    } else if (isset($_REQUEST["for_bathroom"]) || isset($_REQUEST["for_floor"]) || isset($_REQUEST["for_kitchen"]) || isset($_REQUEST["for_outdoors"])) {
        unset($arResult["SECTIONS"][$key]);
    }
}
foreach ($arResult["SECTIONS"] as $key => $arSection) {
    $sect_prices = array();
    $section_elements_list = CIBlockElement::GetList (array(), array("SECTION_ID" => $arSection["ID"]), false, false, array("ID", "CATALOG_GROUP_5"));
    while ($elements_list = $section_elements_list -> Fetch()) {  
        $sect_prices[] = intval($elements_list["CATALOG_PRICE_5"]);    
    }  
    if (!empty($sect_prices)) {
        $arResult["MIN_PRICES"][$arSection["ID"]] = min($sect_prices);    
    }
}
?>