<?$APPLICATION->ShowViewContent('produkts_count');?>
<?$curDir = $APPLICATION->GetCurDir();
/*$arSelect = Array("ID", "PROPERTY_URL");
$arFilter = Array("IBLOCK_ID"=>74, "PROPERTY_URL" =>$curDir);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$tmp = '';
while($ob = $res->Fetch())
{
$tmp = $ob["PROPERTY_URL_VALUE"];
}
*/
$arSeoLn = GetSeoLinks($arResult["VARIABLES"]["SECTION_ID"]);

foreach($arSeoLn as $seoLn)
{
    // arshow($seoLn);

    // $arSeoLinks[$seoLn["NAME"]] = $seoLn["NEW_URL"];

    // if(strpos($seoLn["CONDITION"], "/��������") !== FALSE && $seoLn["REAL_URL"] == $APPLICATION->GetCurPage(false))
    // {
    //     $arSeoLinks = false;
    //     break;
    // }
    // if(strpos($seoLn["CONDITION"], "/�����") !== FALSE && $seoLn["REAL_URL"] == $APPLICATION->GetCurPage(false))
    // {
    //     $vendor = $seoLn["NEW_URL"];
    //     $vendor_code = Cutil::translit($seoLn["PROPERTIES"]["PROIZVODITEL"][0], "ru");
    //     $arSeoLinks = false;
    //     break;
    // }
    if(strpos($seoLn["CONDITION"], "/top_fil") !== FALSE )
    {
        // $name_link = str_replace("/top_fil","",$seoLn["NAME"]);
        $seo_ln_info = explode('/*/',$seoLn["NAME"]);
        $seo_ln_sort = $seo_ln_info[1];
        $seo_ln_name = $seo_ln_info[0];
        $arSeoLinks[$seo_ln_sort] = array("NEW_URL" => $seoLn["NEW_URL"], "NAME" => $seo_ln_name);
    }
}




?>
<?if (!isset($_SESSION["view_by_collections"])/* true*/ ):?>
    <div class="often_seek">
        <ul class="horisontale_filter">
            <?foreach($arSeoLinks as $ar_link):?>
            <li><a href="<?=$ar_link['NEW_URL']?>"><?=$ar_link["NAME"]?></a></li>
            <?endforeach?>
        </ul>
    </div>
<?endif;?>
<?$APPLICATION->IncludeComponent("bitrix:menu", "top_catalog", array(
                "ROOT_MENU_TYPE" => "left",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600000",
                "MENU_CACHE_USE_GROUPS" => "N",
                "CACHE_SELECTED_ITEMS" => "N",
                "MENU_CACHE_GET_VARS" => "",
                "MAX_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N" ),
                false, array( "ACTIVE_COMPONENT" => "Y" )
            );?>
<? $this_sect_info = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"]);
    while ($this_sect = $this_sect_info -> Fetch()) {
        $sect_depth_level = $this_sect["DEPTH_LEVEL"];
    }
if ($_REQUEST["view_by_items"]) {
    $_SESSION["view_by_items"] = "Y";
    unset($_SESSION["view_by_collections"]);
} else if ($_REQUEST["view_by_collections"]) {
    $_SESSION["view_by_collections"] = "Y";
    unset($_SESSION["view_by_items"]);
}
if ($sect_depth_level == 1 && !strstr($APPLICATION->GetCurDir(), "filter") && (empty($_GET) || (count($_GET) == 1 && isset($_GET["clear_cache"])))) {
    unset($_SESSION["view_by_collections"]);
    unset($_SESSION["view_by_items"]);
}
$enabled_banners = false;
if (empty($_GET) || (count($_GET) == 1 && (isset($_GET["clear_cache"])))) {
    $enabled_banners = true;
    ?>

        <?
}

if ((isset($_GET["view_by_collections"]) || isset($_GET["view_by_items"])) && $enabled_banners === true) {
    $enabled_banners = false;
}



    global $arFilterBanners;
    $arFilterBanners = array('PROPERTY_URL' => $curDir);
    ?>


    <?
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "sections_banners",
        array(
            "IBLOCK_TYPE" => "aspro_next_adv",
            "IBLOCK_ID" => "74",
            "POSITION"    => "",
            "PAGE"        => $APPLICATION->GetCurPage(),
            "NEWS_COUNT" => "100",
            "SHOW_ALL_ELEMENTS" => 'N',
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "ASC",
            "FIELD_CODE" => array(
                0 => "NAME",
                1 => "DETAIL_PICTURE",
                2 => "PREVIEW_PICTURE",
            ),
            "PROPERTY_CODE" => array(
                0 => "CATALOG_SECTION",
                1 => "BANNER_TYPE"
            ),
            "CHECK_DATES" => "Y",
            "FILTER_NAME" => "arFilterBanners",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "150",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "PAGER_TEMPLATE" => ".default",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
            "PAGER_SHOW_ALL" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "SHOW_DETAIL_LINK" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "COMPONENT_TEMPLATE" => "banners",
            "SET_LAST_MODIFIED" => "N",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => ""
        ),
        false, array('ACTIVE_COMPONENT' => 'Y', 'HIDE_ICONS' => 'Y')
    );

?>



<?if($arSeoItem):?>
	<div class="seo_block">


		<?if($arSeoItem["DETAIL_PICTURE"]):?>
			<img src="<?=CFile::GetPath($arSeoItem["DETAIL_PICTURE"]);?>" alt="" title="" class="img-responsive"/>
		<?endif;?>
		<?if($arSeoItem["PREVIEW_TEXT"]):?>
			<?=$arSeoItem["PREVIEW_TEXT"]?>
		<?endif;?>
		<?if($arSeoItem["PROPERTY_FORM_QUESTION_VALUE"]):?>
			<table class="order-block noicons">
				<tbody>
					<tr>
						<td class="col-md-9 col-sm-8 col-xs-7 valign">
							<div class="text">
								<?$APPLICATION->IncludeComponent(
									 'bitrix:main.include',
									 '',
									 Array(
										  'AREA_FILE_SHOW' => 'page',
										  'AREA_FILE_SUFFIX' => 'ask',
										  'EDIT_TEMPLATE' => ''
									 )
								);?>
							</div>
						</td>
						<td class="col-md-3 col-sm-4 col-xs-5 valign">
							<div class="btns">
								<span><span class="btn btn-default btn-lg white transparent animate-load" data-event="jqm" data-param-form_id="ASK" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span></span></span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		<?endif;?>
		<?if($arSeoItem["PROPERTY_TIZERS_VALUE"]):?>
			<?$GLOBALS["arLandingTizers"] = array("ID" => $arSeoItem["PROPERTY_TIZERS_VALUE"]);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"next",
				array(
					"IBLOCK_TYPE" => "aspro_next_content",
					"IBLOCK_ID" => CNextCache::$arIBlocks[SITE_ID]["aspro_next_content"]["aspro_next_tizers"][0],
					"NEWS_COUNT" => "4",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arLandingTizers",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "LINK",
						1 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "j F Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => "",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"COMPONENT_TEMPLATE" => "next",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"SHOW_404" => "N",
					"MESSAGE_404" => ""
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?endif;?>
	</div>
<?endif;?>

<?if($iSectionsCount):
    if ($_REQUEST["CHEAP"] || ($sect_depth_level == 1 && isset($_SESSION["view_by_collections"]))) {
        /*$cheap_sections_IDs = array();
        $cheap_sections_list = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 70, ">DEPTH_LEVEL" => 2, "UF_CHEAP" => "Y", "ACTIVE" => "Y", false, array("ID", "UF_CHEAP", "NAME")));
        while ($cheap_sections = $cheap_sections_list -> Fetch()) {
            $cheap_sections_IDs[] = $cheap_sections["ID"];
        }
        $sections_IDs = $cheap_sections_IDs;*/
        $top_depth = 3;
    } else {
        $top_depth = 1;
        $sections_IDs = $arResult["VARIABLES"]["SECTION_ID"];
    }
    if ((!$_REQUEST["view_by_items"] && !$_SESSION["view_by_items"]) &&
        (!isset($_REQUEST["for_bathroom"]) && !isset($_REQUEST["for_floor"]) && !isset($_REQUEST["for_kitchen"]) && !isset($_REQUEST["for_outdoors"])) &&
            ($sect_depth_level != 1 || isset($_GET["view_by_collections"]))) {?>
        <div class="section_block">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "front_sections_only",
                    Array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "SECTION_USER_FIELDS" => array("UF_CHEAP"),
                        "COUNT_ELEMENTS" => "N",
                        "ADD_SECTIONS_CHAIN" => ((!$iSectionsCount || $arParams['INCLUDE_SUBSECTIONS'] !== "N") ? 'N' : 'Y'),
                        "SHOW_SECTION_LIST_PICTURES" => $arParams["SHOW_SECTION_PICTURES"],
                        "TOP_DEPTH" => $top_depth,
                    ),
                    $component
                );?>
        </div>
    <?}?>
<?endif;?>
<?//$section_elements_list = CIBlockElement::GetList(array(), array("SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"]), false, false, array());
//if ($section_elements_list -> SelectedRowsCount() > 0) {?>
    <?global $arTheme;?>
    <?$isAjax="N";?>
    <?if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest"  && isset($_GET["ajax_get"]) && $_GET["ajax_get"] == "Y" || (isset($_GET["ajax_basket"]) && $_GET["ajax_basket"]=="Y")){
	    $isAjax="Y";
    }?>
    <?if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest" && isset($_GET["ajax_get_filter"]) && $_GET["ajax_get_filter"] == "Y" ){
	    $isAjaxFilter="Y";
    }?>
    <?$section_pos_top = \Bitrix\Main\Config\Option::get("aspro.next", "TOP_SECTION_DESCRIPTION_POSITION", "UF_SECTION_DESCR", SITE_ID );?>
    <?$section_pos_bottom = \Bitrix\Main\Config\Option::get("aspro.next", "BOTTOM_SECTION_DESCRIPTION_POSITION", "DESCRIPTION", SITE_ID );?>
    <?if($itemsCnt):?>
	    <?if($arTheme["FILTER_VIEW"]["VALUE"]=="VERTICAL"){?>
		    <?ob_start()?>
            
                <div class="bx_filter">
                    <div class="bx_filter_section">
                        <!--<div class="bx_filter_parameters_box active title">
                            <div class="bx_filter_parameters_box_title">����� �������</div>
                        </div>-->
                        <? $URL = $APPLICATION->GetCurDir();?>
                        <?if (!substr_count($URL, "collections_")) {?>
                            <a href="/catalog/<?=$arResult["VARIABLES"]["SECTION_CODE"].'/collections_'.$arResult["VARIABLES"]["SECTION_CODE"]?>/">
                                <div class="bx_filter_parameters_box">�� ����������</div>
                            </a>
                        <?}else{?>
                            <a href="/catalog/<?=$URL[2]?>/">
                                <div class="bx_filter_parameters_box">�� ���������</div>
                            </a>
                        <?}?>
                    </div>
                </div>
            
			    <?if (!$_REQUEST["view_by_collections"] && !$_SESSION["view_by_collections"] || $sect_depth_level > 2) {
                    include_once(__DIR__."/../filter.php");
                }?>
		    <?$html=ob_get_clean();?>
		    <?$APPLICATION->AddViewContent('left_menu', $html);?>
	    <?}?>
	    <div class="right_block1 clearfix catalog <?=strtolower($arTheme["FILTER_VIEW"]["VALUE"]);?>" id="right_block_ajax">

		    <?if($arTheme["FILTER_VIEW"]["VALUE"]=="HORIZONTAL"){?>
			    <div class="filter_horizontal">
				    <?include_once(__DIR__."/../filter.php")?>
			    </div>
		    <?}else{?>
			    <div class="js_filter filter_horizontal">
				    <div class="bx_filter bx_filter_vertical"></div>
			    </div>
		    <?}?>
		    <div class="inner_wrapper">
    <?endif;?>
			    <?if(!$arSeoItem):?>
				    <?if($posSectionDescr=="BOTH"):?>
					    <?if ($arSection[$section_pos_top]):?>
						    <div class="group_description_block top">
							    <div><?=$arSection[$section_pos_top]?></div>
						    </div>
					    <?endif;?>
				    <?elseif($posSectionDescr=="TOP"):?>
					    <?if ($arSection[$arParams["SECTION_PREVIEW_PROPERTY"]]):?>
						    <div class="group_description_block top">
							    <div><?=$arSection[$arParams["SECTION_PREVIEW_PROPERTY"]]?></div>
						    </div>
					    <?elseif ($arSection["DESCRIPTION"]):?>
						    <div class="group_description_block top">
							    <div><?=$arSection["DESCRIPTION"]?></div>
						    </div>
					    <?elseif($arSection["UF_SECTION_DESCR"]):?>
						    <div class="group_description_block top">
							    <div><?=$arSection["UF_SECTION_DESCR"]?></div>
						    </div>
					    <?endif;?>
				    <?endif;?>
			    <?endif;?>
    <?if($itemsCnt):?>
			    <?if('Y' == $arParams['USE_FILTER']):?>
				    <div class="adaptive_filter">
					    <a class="filter_opener<?=($_REQUEST["set_filter"] == "y" ? " active" : "")?>"><i></i><span><?=GetMessage("CATALOG_SMART_FILTER_TITLE")?></span></a>
				    </div>
				    <script type="text/javascript">
				    checkTopFilter();
				    $(".filter_opener").click(function(){
					    $(this).toggleClass("opened");
					    $(".bx_filter_vertical, .bx_filter").slideToggle(333);
				    });
				    </script>
			    <?endif;?>

			    <?if($isAjax=="N"){
				    $frame = new \Bitrix\Main\Page\FrameHelper("viewtype-block");
				    $frame->begin();?>
			    <?}?>
			    <?if (!$_REQUEST["view_by_collections"] && !$_SESSION["view_by_collections"]) {
                    include_once(__DIR__."/../sort.php");
                    } else {
                        $arDisplays = array("block", "list", "table");
                        if(array_key_exists("display", $_REQUEST) || (array_key_exists("display", $_SESSION)) || $arParams["DEFAULT_LIST_TEMPLATE"]){
                            if($_REQUEST["display"] && (in_array(trim($_REQUEST["display"]), $arDisplays))){
                                $display = trim($_REQUEST["display"]);
                                $_SESSION["display"]=trim($_REQUEST["display"]);
                            }
                            elseif($_SESSION["display"] && (in_array(trim($_SESSION["display"]), $arDisplays))){
                                $display = $_SESSION["display"];
                            }
                            elseif($arSection["DISPLAY"]){
                                $display = $arSection["DISPLAY"];
                            }
                            else{
                                $display = $arParams["DEFAULT_LIST_TEMPLATE"];
                            }
                        }
                        else{
                            $display = "block";
                        }
                        $template = "catalog_".$display;
                }?>

			    <?if($isAjax=="Y"){
				    $APPLICATION->RestartBuffer();
			    }?>
			    <?$show = $arParams["PAGE_ELEMENT_COUNT"];?>
			    <?if($isAjax=="N"){?>
				    <div class="ajax_load <?=$display;?>">
			    <?}?>
				    <?
                    
                    /*
                    global $sectionFilter;
                    if ($_REQUEST["for_bathroom"]) {
                        unset($_SESSION["view_by_collections"]);
                        // $section_ids = array(25249, 25252);
                        $section_ids = array(35616, 35617);
                    } else if ($_REQUEST["for_kitchen"]) {
                        unset($_SESSION["view_by_collections"]);
                        // $section_ids = 25258;
                        $section_ids = 35620;
                    } else if ($_REQUEST["for_floor"]) {
                        unset($_SESSION["view_by_collections"]);
                        // $section_ids = 25250;
                        $section_ids = 	35618;
                    } else if ($_REQUEST["for_outdoors"]) {
                        unset($_SESSION["view_by_collections"]);
                        // $section_ids = array(25251, 25253);
                        $section_ids = array(35621, 35619);
                    }
                    if ($_REQUEST["for_bathroom"] || $_REQUEST["for_kitchen"] || $_REQUEST["for_floor"] || $_REQUEST["for_outdoors"]) {
                        $cheap_sections_arr = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 77, "SECTION_ID" => $section_ids), false, array("ID"), false);
                        while ($cheap_sections = $cheap_sections_arr -> Fetch()) {
                            $sectionFilter["SECTION_ID"][] = $cheap_sections["ID"];
                        }
                    }
                    if ($_REQUEST["CHEAP"]) {
                        $cheap_sections_arr = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 77, ">DEPTH_LEVEL" => 2, "INCLUDE_SUBSECTIONS" => "Y", "UF_CHEAP" => "Y"), false, array("ID", "UF_CHEAP"), false);
                        while ($cheap_sections = $cheap_sections_arr -> Fetch()) {
                            $sectionFilter["SECTION_ID"][] = $cheap_sections["ID"];
                        }
                    }
                    if ($_REQUEST["DESIGN_WALLPAPERS"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_DESIGN_WALLPAPER_VALUE" => "Y"), false, false, array("ID", "PROPERTY_DESIGN_WALLPAPER"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    if ($_REQUEST["FLOOR_BOARDS"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_FLOOR_BOARDS_VALUE" => "Y"), false, false, array("ID", "PROPERTY_FLOOR_BOARDS"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    if ($_REQUEST["WALL_PANELS"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_WALL_PANEL_VALUE" => "Y"), false, false, array("ID", "PROPERTY_WALL_PANEL"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    if ($_REQUEST["FACADE_DECORATION"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_FACADE_DECORATION_VALUE" => "Y"), false, false, array("ID", "PROPERTY_FACADE_DECORATION"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    if ($_REQUEST["GLUE"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_GLUE_VALUE" => "Y"), false, false, array("ID", "PROPERTY_GLUE"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    if ($_REQUEST["CHEAP_FLOOR"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_CHEAP_VALUE" => "Y"), false, false, array("ID", "PROPERTY_CHEAP"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    if ($_REQUEST["WATERPROOF"]) {
                        $design_wallpapers_elements = CIBlockElement::GetList (array(), array("IBLOCK_ID" => 77, "PROPERTY_WATERPROOF_VALUE" => "Y"), false, false, array("ID", "PROPERTY_WATERPROOF"));
                        while ($design_wallpapers = $design_wallpapers_elements -> Fetch()) {
                            $sectionFilter["ID"][] = $design_wallpapers["ID"];
                        }
                    }
                    */
                    // if (!strstr($APPLICATION->GetCurDir(), "/filter/")) {
                    //     $filter_name = 'sectionFilter';
                    // } else {
                    //     $filter_name = $arParams['FILTER_NAME'];
                    // }
                    // if (!strstr($APPLICATION->GetCurDir(), "/filter/")) {
                    //     $arParams['FILTER_NAME'] = 'sectionFilter';
                    // } else {
                    //     $arParams['FILTER_NAME'] = $arParams['FILTER_NAME'];
                    // }
                  
                        if ((!$_REQUEST["view_by_collections"] && !$_SESSION["view_by_collections"]) || $sect_depth_level > 2) {
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                'catalog_block',//$template,
                                Array(
                                    "USE_REGION" => ($arRegion ? "Y" : "N"),
                                    "STORES" => $arParams['STORES'],
                                    "SHOW_UNABLE_SKU_PROPS"=>$arParams["SHOW_UNABLE_SKU_PROPS"],
                                    "SEF_URL_TEMPLATES" => $arParams["SEF_URL_TEMPLATES"],
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                    "AJAX_REQUEST" => $isAjax,
                                    "ELEMENT_SORT_FIELD" => $sort,
                                    "ELEMENT_SORT_ORDER" => $sort_order,
                                    "ELEMENT_SORT_FIELD2" => $alternative_sort,
                                    "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                    // "FILTER_NAME" => $filter_name,
                                    "FILTER_NAME" => $arParams['FILTER_NAME'],
                                    "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                                    "PAGE_ELEMENT_COUNT" => $show,
                                    "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                                    "DISPLAY_TYPE" => $display,
                                    "TYPE_SKU" => $arTheme["TYPE_SKU"]["VALUE"],
                                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                    "SHOW_ARTICLE_SKU" => $arParams["SHOW_ARTICLE_SKU"],
                                    "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],

                                    "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                    "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                                    "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                    "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                    "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                    "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                    'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],

                                    "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                    "BASKET_URL" => $arParams["BASKET_URL"],
                                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                    "PRODUCT_PROPS_VARIABLE" => "prop",
                                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                    "AJAX_MODE" => $arParams["AJAX_MODE"],
                                    "AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
                                    "AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
                                    "AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
                                    "CACHE_TYPE" =>$arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "CACHE_FILTER" => "Y",
                                    "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                                    "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                                    "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                                    "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                                    "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                                    'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                    "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                                    "SET_TITLE" => $arParams["SET_TITLE"],
                                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                    "SHOW_404" => $arParams["SHOW_404"],
                                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                                    "FILE_404" => $arParams["FILE_404"],
                                    "PRICE_CODE" => $arParams['PRICE_CODE'],
                                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                    "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                                    "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                    "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],

                                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "ADD_CHAIN_ITEM" => "N",
                                    "SHOW_QUANTITY" => $arParams["SHOW_QUANTITY"],
                                    "SHOW_QUANTITY_COUNT" => $arParams["SHOW_QUANTITY_COUNT"],
                                    "SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
                                    "SHOW_DISCOUNT_TIME" => $arParams["SHOW_DISCOUNT_TIME"],
                                    "SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
                                    "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                                    "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                                    "USE_STORE" => $arParams["USE_STORE"],
                                    "MAX_AMOUNT" => $arParams["MAX_AMOUNT"],
                                    "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                                    "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
                                    "USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
                                    "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                    "LIST_DISPLAY_POPUP_IMAGE" => $arParams["LIST_DISPLAY_POPUP_IMAGE"],
                                    "DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
                                    "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                    "SHOW_HINTS" => $arParams["SHOW_HINTS"],
                                    "OFFER_HIDE_NAME_PROPS" => $arParams["OFFER_HIDE_NAME_PROPS"],
                                    "SHOW_SECTIONS_LIST_PREVIEW" => $arParams["SHOW_SECTIONS_LIST_PREVIEW"],
                                    "SECTIONS_LIST_PREVIEW_PROPERTY" => $arParams["SECTIONS_LIST_PREVIEW_PROPERTY"],
                                    "SHOW_SECTION_LIST_PICTURES" => $arParams["SHOW_SECTION_LIST_PICTURES"],
                                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                                    "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                    "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                    "SALE_STIKER" => $arParams["SALE_STIKER"],
                                    "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                    "SHOW_RATING" => $arParams["SHOW_RATING"],
                                ), $component, array("HIDE_ICONS" => $isAjax)
                            );
                    }?>
<?/*$section_info = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"]);
    while ($current_section = $section_info -> Fetch()) {
        if (strlen($current_section["DESCRIPTION"])) {
            echo "<div class='section_desc'>" . $current_section["DESCRIPTION"] . "</div>";
        }
}*/?>
    <?endif;?>
			    <?if($isAjax=="N"){?>
				    <?if(!$arSeoItem):?>
					    <?/*if($posSectionDescr=="BOTH"):?>
						    <?if($arSection[$section_pos_bottom]):?>
							    <div class="group_description_block bottom">
								    <div><?=$arSection[$section_pos_bottom]?></div>
							    </div>
						    <?endif;?>
					    <?elseif($posSectionDescr=="BOTTOM"):?>
						    <?if($arSection[$arParams["SECTION_PREVIEW_PROPERTY"]]):?>
							    <div class="group_description_block bottom">
								    <div><?=$arSection[$arParams["SECTION_PREVIEW_PROPERTY"]]?></div>
							    </div>
						    <?elseif ($arSection["DESCRIPTION"]):?>
							    <div class="group_description_block bottom">
								    <div><?=$arSection["DESCRIPTION"]?></div>
							    </div>
						    <?elseif($arSection["UF_SECTION_DESCR"]):?>
							    <div class="group_description_block bottom">
								    <div><?=$arSection["UF_SECTION_DESCR"]?></div>
							    </div>
						    <?endif;?>
					    <?endif;*/?>
				    <?else:?>
					    <?if($arSeoItem["DETAIL_TEXT"]):?>
						    <?=$arSeoItem["DETAIL_TEXT"];?>
					    <?endif;?>
					    <?if($arSeoItem["PROPERTY_SECTION_VALUE"]):?>
						    <?$GLOBALS["arLandingSections"] = array("PROPERTY_SECTION" => $arSeoItem["PROPERTY_SECTION_VALUE"]);?>
						    <?$APPLICATION->IncludeComponent(
							    "bitrix:news.list",
							    "landings_list",
							    array(
								    "IBLOCK_TYPE" => "aspro_next_catalog",
								    "IBLOCK_ID" => CNextCache::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_catalog_info"][0],
								    "NEWS_COUNT" => "999",
								    "SHOW_COUNT" => $arParams["LANDING_SECTION_COUNT"],
								    "COMPARE_FIELD" => "FILTER_URL",
								    "COMPARE_PROP" => "Y",
								    "SORT_BY1" => "SORT",
								    "SORT_ORDER1" => "ASC",
								    "SORT_BY2" => "ID",
								    "SORT_ORDER2" => "DESC",
								    "FILTER_NAME" => "arLandingSections",
								    "FIELD_CODE" => array(
									    0 => "",
									    1 => "",
								    ),
								    "PROPERTY_CODE" => array(
									    0 => "LINK",
									    1 => "",
								    ),
								    "CHECK_DATES" => "Y",
								    "DETAIL_URL" => "",
								    "AJAX_MODE" => "N",
								    "AJAX_OPTION_JUMP" => "N",
								    "AJAX_OPTION_STYLE" => "Y",
								    "AJAX_OPTION_HISTORY" => "N",
								    "CACHE_TYPE" =>$arParams["CACHE_TYPE"],
								    "CACHE_TIME" => $arParams["CACHE_TIME"],
								    "CACHE_FILTER" => "Y",
								    "CACHE_GROUPS" => "N",
								    "PREVIEW_TRUNCATE_LEN" => "",
								    "ACTIVE_DATE_FORMAT" => "j F Y",
								    "SET_TITLE" => "N",
								    "SET_STATUS_404" => "N",
								    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								    "ADD_SECTIONS_CHAIN" => "N",
								    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
								    "PARENT_SECTION" => "",
								    "PARENT_SECTION_CODE" => "",
								    "INCLUDE_SUBSECTIONS" => "Y",
								    "PAGER_TEMPLATE" => "",
								    "DISPLAY_TOP_PAGER" => "N",
								    "DISPLAY_BOTTOM_PAGER" => "N",
								    "PAGER_TITLE" => "",
								    "PAGER_SHOW_ALWAYS" => "N",
								    "PAGER_DESC_NUMBERING" => "N",
								    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								    "PAGER_SHOW_ALL" => "N",
								    "AJAX_OPTION_ADDITIONAL" => "",
								    "COMPONENT_TEMPLATE" => "next",
								    "SET_BROWSER_TITLE" => "N",
								    "SET_META_KEYWORDS" => "N",
								    "SET_META_DESCRIPTION" => "N",
								    "SET_LAST_MODIFIED" => "N",
								    "PAGER_BASE_LINK_ENABLE" => "N",
								    "TITLE_BLOCK" => $arParams["LANDING_TITLE"],
								    "SHOW_404" => "N",
								    "MESSAGE_404" => ""
							    ),
							    false, array("HIDE_ICONS" => "Y")
						    );?>
					    <?endif;?>
				    <?endif;?>
    <?if($itemsCnt):?>
				    <div class="clear"></div>
				    </div>
    <?endif;?>
			    <?}?>
    <?if($itemsCnt):?>
			    <?if($isAjax!="Y"){?>
				    <?$frame->end();?>
			    <?}?>
			    <?if($isAjax=="Y"){
				    die();
			    }?>
		    </div>
	    </div>
    <?else:?>
	    <?if(!$iSectionsCount):?>
		    <div class="no_goods">
			    <div class="no_products">
				    <div class="wrap_text_empty">
					    <?if($_REQUEST["set_filter"]){?>
						    <?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
					    <?}else{?>
						    <?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
					    <?}?>
				    </div>
			    </div>
		    </div>
	    <?endif;?>
	    <?
	    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], IntVal($arSection["ID"]));
	    $arValues = $ipropValues->getValues();
	    if($arParams["SET_TITLE"] !== 'N'){
		    $page_h1 = $arValues['SECTION_PAGE_TITLE'] ? $arValues['SECTION_PAGE_TITLE'] : $arSection["NAME"];
		    if($page_h1){
			    $APPLICATION->SetTitle($page_h1);
		    }
		    else{
			    $APPLICATION->SetTitle($arSection["NAME"]);
		    }
	    }
	    $page_title = $arValues['SECTION_META_TITLE'] ? $arValues['SECTION_META_TITLE'] : $arSection["NAME"];
	    if($page_title){
		    $APPLICATION->SetPageProperty("title", $page_title);
	    }
	    if($arValues['SECTION_META_DESCRIPTION']){
		    $APPLICATION->SetPageProperty("description", $arValues['SECTION_META_DESCRIPTION']);
	    }
	    if($arValues['SECTION_META_KEYWORDS']){
		    $APPLICATION->SetPageProperty("keywords", $arValues['SECTION_META_KEYWORDS']);
	    }
	    ?>
    <?endif;?>
    <?
    if($arSeoItem)
    {
	    $langing_seo_h1 = ($arSeoItem["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "" ? $arSeoItem["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] : $arSeoItem["NAME"]);
	    $APPLICATION->SetTitle($langing_seo_h1);

	    if($arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"])
		    $APPLICATION->SetPageProperty("title", $arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"]);

	    if($arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"])
		    $APPLICATION->SetPageProperty("description", $arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]);

	    if($arSeoItem["IPROPERTY_VALUES"]['ELEMENT_META_KEYWORDS'])
		    $APPLICATION->SetPageProperty("keywords", $arSeoItem["IPROPERTY_VALUES"]['ELEMENT_META_KEYWORDS']);
    }
//}?>
<?

$APPLICATION->IncludeComponent(
   "sotbit:seo.meta",
   ".default",
   Array(
   "FILTER_NAME" => $arParams["FILTER_NAME"],
        // "SECTION_ID" => $cur_sect,
        "SECTION_ID" => $NextSectionID,
    // "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
   )
);

$APPLICATION->IncludeComponent(
   "sotbit:seo.meta.tags",
   ".default",
   Array(
     "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
     "CACHE_TIME" => $arParams["CACHE_TIME"],
     "CACHE_TYPE" => $arParams["CACHE_TYPE"],
     "CNT_TAGS" => "",
     "IBLOCK_ID" => $arParams["IBLOCK_ID"],
     "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
     "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
     // "SECTION_ID" => $cur_sect,
     "SECTION_ID" => $NextSectionID,
     // "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
     "SORT" => "CONDITIONS",
     "SORT_ORDER" => "asc",
     "COMPONENT_TEMPLATE" => ".default",
   )
);

?>
