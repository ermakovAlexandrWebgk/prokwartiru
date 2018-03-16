<?
//$catalog_id=\Bitrix\Main\Config\Option::get("aspro.next", "CATALOG_IBLOCK_ID", CNextCache::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0]);
$catalog_id = 70;
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
if (strlen($main_section_id) > 0) {
    $sectFilter = array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => 6, ">LEFT_MARGIN" => $main_section_left_margin, "<RIGHT_MARGIN" => $main_section_right_margin);
} else {
    $sectFilter = array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => 3);
}
$arSections = CNextCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($catalog_id), 'GROUP' => array('ID'))), $sectFilter, false, array("ID","IBLOCK_ID", "NAME", "PICTURE", "LEFT_MARGIN", "RIGHT_MARGIN", "DEPTH_LEVEL", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID", "UF_CATALOG_ICON"));
if($arSections){  
	$arResult = array();
	$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
	$cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);

	foreach($arSections as $ID => $arSection){
        //if (stristr($arSection["SECTION_PAGE_URL"], $selected_menu_item["LINK"])) {
		    $arSections[$ID]['SELECTED'] = CMenu::IsItemSelected($arSection['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index);
		    if($arSection['UF_CATALOG_ICON'])
		    {
			    $img=CFile::ResizeImageGet($arSection['UF_CATALOG_ICON'], Array('width'=>36, 'height'=>36), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			    $arSections[$ID]['IMAGES']=$img;
		    }
		    elseif($arSection['PICTURE']){
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
        //}
	}
}?>