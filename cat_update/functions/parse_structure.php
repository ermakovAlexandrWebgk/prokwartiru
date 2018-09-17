<?
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();

function parse_structure($CATALOG_ID) {
    // define('NEW_IBLOCK', 77);
    $result['error'] = false;

    $sections_tree = array();
    $entities_arr = array();
    $entities_names = array();
    $entities_values = array();
    $user_fields_ids = array();

    if (CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") && !empty($CATALOG_ID)) {
        $res = CIBlock::GetList(
            Array(),
            Array(
                'ID' => $CATALOG_ID,
                'TYPE'=>'catalog',
                'SITE_ID'=>SITE_ID,
                // 'ACTIVE'=>'Y',
                // "CNT_ACTIVE"=>"Y",
            )
        );

        if($ar_res = $res->Fetch())
        {
            $iblocks_props_list = CIBlock::GetProperties($CATALOG_ID);
            // print_r( $ar_res);

            $bs = new CIBlockSection;
            // $arFields = Array(
            //   "ACTIVE" => $ACTIVE,
            //   "IBLOCK_ID" => NEW_IBLOCK,
            //   "NAME" => $NAME,
            //   "SORT" => $SORT,
            //   "PICTURE" => $_FILES["PICTURE"],
            //   "DESCRIPTION" => $DESCRIPTION,
            //   "DESCRIPTION_TYPE" => $DESCRIPTION_TYPE
            //   );
            // $arFields = $ar_res;


            $arFields["IBLOCK_ID"] = NEW_IBLOCK;
            $arFields["LID"] = $ar_res["LID"];
            $arFields["NAME"] = $ar_res["NAME"];
            $arFields["CODE"] = $ar_res["CODE"];
            $arFields["ACTIVE"] = $ar_res["ACTIVE"];
            $arFields["SORT"] = $ar_res["SORT"];
            $arFields["DESCRIPTION"] = $ar_res["DESCRIPTION"];
            $arFields["DESCRIPTION_TYPE"] = $ar_res["DESCRIPTION_TYPE"];
            // $arFields["INDEX_ELEMENT"] = $ar_res["INDEX_ELEMENT"];

            // $iblock_code = $ar_res["CODE"];

            $ID = $bs->Add($arFields);

            $resres = ($ID>0);

            if( !$resres ) {
                $result['error'] = true;
                $result['error_text'] = $bs->LAST_ERROR;
                $result['end_parse'] = true;
                // print_r( $result);

                echo json_encode($result);
                return;
                // die();

            } else {
                $new_main_section = $ID;
                $result['new_main_section'] = $new_main_section;


                $entities_list = CUserTypeEntity::GetList (array(), array("ENTITY_ID" => "IBLOCK_".$CATALOG_ID."_SECTION"));
                while ($entities = $entities_list -> Fetch()) {
                    $entities_arr[$entities["FIELD_NAME"]] = $entities;
                }


                foreach ($entities_arr as $field_name => $curr_entity) {

                    $oUserTypeEntity = new CUserTypeEntity;
                    $aUserFields = array(
                        "ENTITY_ID" => "IBLOCK_".NEW_IBLOCK."_SECTION",
                        "FIELD_NAME" => $curr_entity["FIELD_NAME"],
                        "USER_TYPE_ID" => $curr_entity["USER_TYPE_ID"],
                        "XML_ID" => $curr_entity["XML_ID"],
                        "SORT" => $curr_entity["SORT"],
                        "MULTIPLE" => $curr_entity["MULTIPLE"],
                        "MANDATORY" => "N"/*$curr_entity["MANDATORY"]*/,
                        "SHOW_FILTER" => $curr_entity["SHOW_FILTER"],
                        "SHOW_IN_LIST" => $curr_entity["SHOW_IN_LIST"],
                        "EDIT_IN_LIST" => $curr_entity["EDIT_IN_LIST"],
                        "IS_SEARCHABLE" => $curr_entity["IS_SEARCHABLE"],
                        "SETTINGS" => $curr_entity["SETTINGS"]
                    );
                    $iUserFieldId = $oUserTypeEntity -> Add ($aUserFields);
                    $result["iUserFieldId"][] = $iUserFieldId;
                    if ($curr_entity["USER_TYPE_ID"] == "enumeration") {
                        $enum_list = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $curr_entity["ID"]));
                        while ($enum_fetched_list = $enum_list -> Fetch()) {
                            $entities_values[$curr_entity["FIELD_NAME"]][$enum_fetched_list['XML_ID']] = $enum_fetched_list;
                        }
                    }
                }

                $entities_list = CUserTypeEntity::GetList (array(), array("ENTITY_ID" => "IBLOCK_".$CATALOG_ID."_SECTION"));
                    while ($entities = $entities_list -> Fetch()) {
                        $entities_names[] = $entities["FIELD_NAME"];
                        $user_fields_ids[] = $entities["ID"];
                         if (!empty($entities_values[$entities["FIELD_NAME"]])) {
                             $i = 0;
                             foreach ($entities_values[$entities["FIELD_NAME"]] as $xml_id => $entity_value_arr) {
                                 $obEnum = new CUserFieldEnum();
                                 $obEnum -> SetEnumValues($entities["ID"], array(
                                     "n" . $i => array(
                                        "VALUE" => $entity_value_arr["VALUE"],
                                        "DEF" => $entity_value_arr["DEF"],
                                        "SORT" => $entity_value_arr["SORT"],
                                        "XML_ID" => $entity_value_arr["XML_ID"]
                                     )
                                 ));
                                 $i++;
                             }
                         }
                    }

                $arFilter_section = array(
                    'IBLOCK_ID' => $CATALOG_ID,
                    // '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
                    // '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
                    // '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL'],
                     // "ACTIVE" => "Y"
                ); // выберет потомков без учета активности
                $rsSect = CIBlockSection::GetList(array("DEPTH_LEVEL" => "ASC"),$arFilter_section, false, array("ID", "NAME", "SORT", "CODE", "XML_ID", "IBLOCK_SECTION_ID", "ACTIVE", "PICTURE", "UF_*", "IBLOCK_CODE"), false);
                $sections = array();
                while ($arSect = $rsSect->GetNext())
                {
                    $sections_tree[$arSect["ID"]] = $arSect;
                }

                // arshow($sections_tree);
                // echo "<pre>";
                // print_r($sections_tree);
                // echo "</pre>";

                foreach ($sections_tree as $key => $curr_iblock_section_arr) {
                    foreach ($curr_iblock_section_arr as $field_name => $field_val) {
                        if (in_array($field_name, $entities_names) && !is_array($field_val) && strlen($field_val) > 0 && $field_val > 0) {
                            $is_listed_entity = "";
                            $entity_info = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".NEW_IBLOCK."_SECTION", "FIELD_NAME" => $field_name));
                            while ($entity = $entity_info -> Fetch()) {
                                if ($entity["USER_TYPE_ID"] == "enumeration") {
                                    $is_listed_entity = "Y";
                                }
                            }
                            if (strlen($is_listed_entity) > 0) {
                                $old_enum_list = CUserFieldEnum::GetList(array(), array("ID" => $field_val));
                                while ($enum_fetched = $old_enum_list -> Fetch()) {
                                    $xml_id = $enum_fetched["XML_ID"];
                                }
                                $new_enum_list = CUserFieldEnum::GetList(array(), array("XML_ID" => $xml_id, "USER_FIELD_ID" => $user_fields_ids));
                                while ($new_enum = $new_enum_list -> Fetch()) {
                                    $sections_tree[$key][$field_name] = $new_enum["ID"];
                                }
                            }
                        }
                    }
                }
                foreach ($sections_tree as $key => $curr_iblock_section_arr) {
                    $new_subsection = new CIBlockSection;
                    $subsectFields = array(
                        "NAME" => $curr_iblock_section_arr["NAME"],
                        "SORT" => $curr_iblock_section_arr["SORT"],
                        "ACTIVE" => $curr_iblock_section_arr["ACTIVE"],
                        "CODE" => $curr_iblock_section_arr["CODE"],
                        // "PICTURE" => $curr_iblock_section_arr["PICTURE"],
                        "XML_ID" => $curr_iblock_section_arr["ID"],
                        "IBLOCK_ID" => NEW_IBLOCK
                    );
                    if (strlen($curr_iblock_section_arr["PICTURE"]) > 0 && !empty($curr_iblock_section_arr["PICTURE"])) {

                        $img_arr = CFile::MakeFileArray($curr_iblock_section_arr["PICTURE"]);

                        if ( file_exists($img_arr['tmp_name']) ) {
                            $subsectFields["PICTURE"] = $img_arr;
                        } else {
                            // $subsectFields["PICTURE"] = "";
                        }
                    }
                    foreach ($entities_names as $entity_name) {
                        $subsectFields[$entity_name] = $curr_iblock_section_arr[$entity_name];
                    }
                    if ($curr_iblock_section_arr["DEPTH_LEVEL"] == 1) {
                        $subsectFields["IBLOCK_SECTION_ID"] = $new_main_section;
                        // $subsectFields["IBLOCK_SECTION_ID"] = $result['new_main_section'];
                        // $main_section_info = CIBlockSection::GetList (array(), array("IBLOCK_ID" => NEW_IBLOCK, "CODE" => $curr_iblock_section_arr["IBLOCK_CODE"]), false, array(), false);
                        // while ($main_section = $main_section_info -> Fetch()) {
                        //     if ($main_section["ID"] > 0) {
                        //         $subsectFields["IBLOCK_SECTION_ID"] = $main_section["ID"];
                        //     }
                        // }

                    } else {
                        $old_subsection_info = CIBlockSection::GetByID($curr_iblock_section_arr["IBLOCK_SECTION_ID"]) -> Fetch();
                        if (strlen($old_subsection_info["CODE"]) > 0) {
                            $new_subsection_info = CIBlockSection::GetList (array(), array("IBLOCK_ID" => NEW_IBLOCK, "CODE" => $old_subsection_info["CODE"]), false, array(), false);
                            while ($main_section = $new_subsection_info -> Fetch()) {
                                if ($main_section["ID"] > 0) {
                                    $subsectFields["IBLOCK_SECTION_ID"] = $main_section["ID"];
                                }
                            }
                        }
                    }
                    $subsection_ID = $new_subsection -> Add ($subsectFields);
                    if ($subsection_ID>0) {
                        $result["subsection_ID"][] = $subsection_ID;
                    } else {
                        echo $subsectFields["XML_ID"]." => ";
                        echo "(picture => ".$curr_iblock_section_arr["PICTURE"].")";

                        echo $new_subsection->LAST_ERROR.";\n";
                        $text_error = $new_subsection->LAST_ERROR;
                        $text_error = str_replace('<br>','',$text_error);
                        $text_error = htmlspecialcharsEx($text_error);
                        $result["subsection_ID"][] = array(
                            "ID" => $subsectFields["XML_ID"], "TEXT_ERROR" => $text_error);
                    }

                    // echo "<pre>";
                    // print_r($subsectFields);
                    // echo "</pre>";
                }

            }
        }
    } else {
        $result['error'] = true;
        $result['error_text'] = "modules_offline";
        // echo json_encode($result);

    }
    $result['end_parse'] = true;
    echo json_encode($result);
    // print_r($result);

}
?>
