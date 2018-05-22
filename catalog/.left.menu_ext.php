<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();
if ($_REQUEST["current_section"] == 6356) {
    if($arMenuParametrs = CNext::GetDirMenuParametrs(__DIR__))
    {
        if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y')
        {
            //$catalog_id = \Bitrix\Main\Config\Option::get('aspro.next', 'CATALOG_IBLOCK_ID', CNextCache::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0]);
            $catalog_id = 70;
            $arSections = CNextCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($catalog_id), 'MULTI' => 'Y')), array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => 3));
            foreach ($arSections as $key => $arSection) {
                if ($_REQUEST["current_section"] == 6356) {
                    /*if (!in_array($arSection["ID"], array(25247, 25243, 25248))) {
                    unset($arSections[$key]);
                    }*/    
                }
            }
            $arSectionsByParentSectionID = CNextCache::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));


        }                                                
        if($arSections)
            CNext::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
    }    
}
/*foreach ($aMenuLinksExt as $key => $MenuLinkExt) {
    if (!in_array($MenuLinkExt["ID"], array(6356, 25247, 25243, 25248))) {
        unset($aMenuLinksExt[$key]);
    }
}*/
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
$aSectMenuLinks = array();
$menu_filter["IBLOCK_ID"] = 75;
if ($_REQUEST["current_section"]) {
    $menu_filter["PROPERTY_CATALOG_SECTION_LINK"] = $_REQUEST["current_section"];
}
$section_menu = CIBlockElement::GetList (array(), $menu_filter, false, false, array("ID", "NAME", "PROPERTY_FILTER_LINK", "PROPERTY_CATALOG_SECTION_LINK", "PICTURE", "SORT", "IMAGES"));
if ($section_menu -> SelectedRowsCount() > 0) {
    while ($section_menu_info = $section_menu -> Fetch()) {
        //$aSectMenuLinks[] = array(0 => $section_menu_info["NAME"], 1 => $section_menu_info["PROPERTY_FILTER_LINK_VALUE"], 2 => array(), 3 => array("FROM_IBLOCK" => 1, "DEPTH_LEVEL" => 2, "IS_PARENT" => 0));
    }    
}
$aMenuLinks = array_merge($aMenuLinks, $aSectMenuLinks);

?>