<?
//if($arResult){
    /*$catalog_id = 77;
    foreach ($arResult as $menu_item) {
        if ($menu_item["SELECTED"] == "Y") {
            $selected_menu_item = $menu_item;
            $all_sections_list = CIBlockSection::GetList (array(), array("IBLOCK_ID" => $catalog_id, "<DEPTH_LEVEL" => 2), false, array(), false);
            while ($all_sections = $all_sections_list -> Fetch()) {
                if (stristr($selected_menu_item["LINK"], $all_sections["CODE"])) {
                    $main_section_id = $all_sections["ID"];
                    $main_section_left_margin = $all_sections["LEFT_MARGIN"];
                    $main_section_right_margin = $all_sections["RIGHT_MARGIN"];
                }
            }
        }

    }
    // if ($_REQUEST["current_section"] == 6356) {
    if ($_REQUEST["current_section"] == 34639) {
        if (strlen($main_section_id) > 0) {
            $sectFilter = array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => 3, '>DEPTH_LEVEL' => 1, ">LEFT_MARGIN" => $main_section_left_margin, "<RIGHT_MARGIN" => $main_section_right_margin);
        } else {
            $sectFilter = array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => 2);
        }
        $arSections = CNextCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($catalog_id), 'GROUP' => array('ID'))), $sectFilter, false, array("ID", "NAME", "PICTURE", "LEFT_MARGIN", "RIGHT_MARGIN", "DEPTH_LEVEL", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID"));
        if($arSections){
            //$arTmpResult = array();
            $arResult = array();
            $cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
            $cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);

            foreach($arSections as $ID => $arSection){
                $arSections[$ID]['SELECTED'] = CMenu::IsItemSelected($arSection['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index);
                if($arSection['PICTURE']){
                    $img=CFile::ResizeImageGet($arSection['PICTURE'], Array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $arSections[$ID]['IMAGES']=$img;
                }
                if($arSection['IBLOCK_SECTION_ID']){
                    if(!isset($arSections[$arSection['IBLOCK_SECTION_ID']]['CHILD'])){
                        $arSections[$arSection['IBLOCK_SECTION_ID']]['CHILD'] = array();
                    }
                    $arSections[$arSection['IBLOCK_SECTION_ID']]['CHILD'][] = &$arSections[$arSection['ID']];
                }

                if (empty($selected_menu_item)) {
                    if($arSection['DEPTH_LEVEL'] == 1){
                        $arResult[] = &$arSections[$arSection['ID']];
                    }
                } else {
                    if($arSection['DEPTH_LEVEL'] == 2){
                        $arResult[] = &$arSections[$arSection['ID']];
                    }
                }
            }
            //$arResult[0]["CHILD"]=$arTmpResult;
        }
    }
    foreach ($arResult as $key => $menu_item) {
        // if ($_REQUEST["current_section"] == 6356) {
        if ($_REQUEST["current_section"] == 34639) {
            // if (isset($menu_item["ID"]) && !in_array($menu_item["ID"], array(25247, 25243, 25248))) {
            if (isset($menu_item["ID"]) && !in_array($menu_item["ID"], array(34644, 34645, 34648))) {
                unset($arResult[$key]);
            }
        }
    }
    //$aSectMenuLinks = array();
    $menu_filter["IBLOCK_ID"] = 75;
    if ($_REQUEST["current_section"]) {
        $menu_filter["PROPERTY_CATALOG_SECTION_LINK"] = $_REQUEST["current_section"];
    }
    $section_menu = CIBlockElement::GetList (array("SORT" => "DESC"), $menu_filter, false, false, array("ID", "NAME", "PROPERTY_FILTER_LINK", "PROPERTY_CATALOG_SECTION_LINK", "PICTURE", "SORT", "IMAGES"));
    if ($section_menu -> SelectedRowsCount() > 0) {
        while ($section_menu_info = $section_menu -> Fetch()) {
            array_unshift($arResult, array("NAME" => $section_menu_info["NAME"], "SECTION_PAGE_URL" => $section_menu_info["PROPERTY_FILTER_LINK_VALUE"], array(), array("FROM_IBLOCK" => 1, "DEPTH_LEVEL" => 2, "IS_PARENT" => 0)));
        }
    }*/
//}?>
