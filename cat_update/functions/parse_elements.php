<?function parse_elements($CATALOG_ID,$COUNT,$last_id) {
    $result = array();
    $result['error'] = false;
    if (!empty($CATALOG_ID) && !empty($COUNT) && !empty($last_id) ) {
        // echo "1";
        if (CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")) {
            // echo "2";
            $arSelect = Array();
            $arFilter = Array("IBLOCK_ID"=>$CATALOG_ID, ">ID" => $last_id, "ACTIVE" => "Y");

            unset($last_id);
            // $last_id = 0;
            $res = CIBlockElement::GetList(Array("ID" => "asc"), $arFilter, false, Array("nPageSize"=>$COUNT), $arSelect);
            while($ob = $res->GetNextElement())
            // if ($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();

                // $full_el[$arFields["ID"]] = ['fields' => $arFields, 'props' => $arProps];
                $full_el[$arFields["ID"]] =  $arFields;
                $full_el[$arFields["ID"]]["PROPERTIES"] =  $arProps;

                $IDs[] = $arFields["ID"];
                $last_id = $arFields["ID"];
            }
            unset($arSelect);
            unset($arFilter);
            unset($res);

            // echo "3";

            $result['old_IDs'] = $IDs;
            if (count($IDs) > 0) {
                $result['end_parse'] = false;
            } else {
                $result['end_parse'] = true;
            }

            $result["l"] = count($IDs);
            $result["last_id"] = $last_id;
            $result["method"] = $_POST["method"];
            // echo json_encode($result);

            // print_r($full_el[ $last_id]);

            $new_elements = array();
            foreach ($full_el as $el_id => $item_arr) {

                $sect_res = CIBlockSection::GetList(
                    Array("SORT"=>"ASC"),
                    Array("XML_ID" => $item_arr['IBLOCK_SECTION_ID'], "IBLOCK_ID" => NEW_IBLOCK),
                    false,
                    Array()
                );

                if ($cur_sect_ar = $sect_res->GetNext()){
                    // $cur_sect_ar["ID"];
                } else {
                    // $result['error'] = true;
                    $result['error_text'][] = $item_arr["ID"]." - ".$item_arr['IBLOCK_SECTION_ID']." NO_SECTION";
                    continue;
                }

                // echo "4";
                $new_elements[$el_id] = array(
                    "XML_ID" => $el_id,
                    'IBLOCK_SECTION_ID' => $cur_sect_ar["ID"],
                    "IBLOCK_ID" => NEW_IBLOCK,
                    "NAME" => $item_arr['NAME'],
                    "CODE" => $item_arr['CODE'],
                    "ACTIVE" => $item_arr['ACTIVE'],
                    "SORT" => $item_arr['SORT'],
                    // "PREVIEW_PICTURE" => $item_arr['PREVIEW_PICTURE'],
                    "PREVIEW_TEXT" => $item_arr['PREVIEW_TEXT'],
                    "PREVIEW_TEXT_TYPE" => $item_arr['PREVIEW_TEXT_TYPE'],
                    // "DETAIL_PICTURE" => $item_arr['DETAIL_PICTURE'],
                    "DETAIL_TEXT" => $item_arr['DETAIL_TEXT'],
                    "DATE_CREATE" => $item_arr['DATE_CREATE'],
                    "CREATED_BY" => $item_arr['CREATED_BY'],



                    "PROPERTY_VALUES" => array()
                );

                if (strlen($item_arr["PREVIEW_PICTURE"]) > 0 && !empty($item_arr["PREVIEW_PICTURE"])) {

                    $img_arr_pre = CFile::MakeFileArray($item_arr["PREVIEW_PICTURE"]);
                    // $img_arr_det = CFile::MakeFileArray($item_arr["DETAIL_PICTURE"]);

                    if ( file_exists($img_arr_pre['tmp_name']) ) {
                        // $subsectFields["PICTURE"] = $img_arr;
                        $new_elements[$el_id]["PREVIEW_PICTURE"] = $img_arr_pre;
                    } else {
                        // $result['error'] = true;
                        $result['error_text'][] = $item_arr["ID"]." - ".$item_arr['PREVIEW_PICTURE']." NOT_IMAGE";
                    }
                }

                if (strlen($item_arr["DETAIL_PICTURE"]) > 0 && !empty($item_arr["DETAIL_PICTURE"])) {

                    $img_arr_det = CFile::MakeFileArray($item_arr["DETAIL_PICTURE"]);
                    // $img_arr_det = CFile::MakeFileArray($item_arr["DETAIL_PICTURE"]);

                    if ( file_exists($img_arr_det['tmp_name']) ) {
                        // $subsectFields["PICTURE"] = $img_arr;
                        $new_elements[$el_id]["DETAIL_PICTURE"] = $img_arr_det;
                    } else {
                        // $result['error'] = true;
                        $result['error_text'][] = $item_arr["ID"]." - ".$item_arr['DETAIL_PICTURE']." NOT_IMAGE";
                    }
                }

                foreach ($item_arr["PROPERTIES"] as $key => $prop_arr) {

                    if ($prop_arr["VALUE"] == "" || $prop_arr["VALUE"] == false) {
                        continue;
                    }

                    if ($prop_arr["CODE"] == "RECOMMEND")
                    {
                        continue;
                    }

                    if ($prop_arr["CODE"] == "SPECIALOFFER" || $prop_arr["CODE"] == "NEWPRODUCT" || $prop_arr["CODE"] == "SALELEADER"|| $prop_arr["CODE"] == "SALE" ) {

                            if ( !empty($prop_arr["VALUE"]) ){
                                $new_elements[$el_id]["PROPERTY_VALUES_TYPE_L"][$prop_arr["CODE"]] = "Y";
                            }
                            continue;
                    }

                    if ($CATALOG_ID == 73 && $prop_arr["CODE"] == "PROPERTY")
                    {
                        // $prop_arr["CODE"] = "PROPERTY_LIGHTS";
                        $new_elements[$el_id]["PROPERTY_VALUES"]["PROPERTY_LIGHTS"] = $prop_arr["VALUE"];
                        continue;
                    }

                    if ($prop_arr["CODE"] == "DESIGN")
                    {
                        $res = CIBlock::GetList(
                            Array(),
                            Array(
                                'ID' => $CATALOG_ID,
                                'TYPE'=>'catalog',
                                'SITE_ID'=>SITE_ID,
                                'ACTIVE'=>'Y',
                                // "CNT_ACTIVE"=>"Y",
                            )
                        );

                        if($ar_res = $res->Fetch())
                        {
                            // $prop_arr["CODE"] = $prop_arr["CODE"]."_".strtoupper($ar_res["CODE"]);
                            $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>NEW_IBLOCK, "CODE"=>$prop_arr["CODE"]."_".strtoupper($ar_res["CODE"]), "VALUE" => $prop_arr["VALUE"] ));
                            if($enum_fields = $property_enums->GetNext())
                            {
                                $new_elements[$el_id]["PROPERTY_VALUES"][$prop_arr["CODE"]."_".strtoupper($ar_res["CODE"])] = $enum_fields["ID"];
                                // $prop_arr["VALUE"] = $enum_fields["ID"];
                            }

                        }
                        else
                        {
                            // $result['error'] = true;
                            $result['error_text'][] = "элемент ".$el_id." свойство ".$prop_arr["CODE"]." iblock = ".$CATALOG_ID." не было передано";
                        }

                        continue;
                    }

                    if ($prop_arr["CODE"] == "UNIT")
                    {

                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>NEW_IBLOCK, "CODE"=>"CML2_BASE_UNIT", "VALUE" => $prop_arr["VALUE"] ));
                        if($enum_fields = $property_enums->GetNext())
                        {
                            $prop_arr["VALUE"] = $enum_fields["ID"];
                        }
                        $new_elements[$el_id]["PROPERTY_VALUES"]["CML2_BASE_UNIT"] = $prop_arr["VALUE"];

                        continue;
                    }

                    if ($prop_arr["CODE"] == "ARTICUL")
                    {
                        // $prop_arr["CODE"] = "CML2_ARTICLE";
                        $new_elements[$el_id]["PROPERTY_VALUES"]["CML2_ARTICLE"] = $prop_arr["VALUE"];
                        continue;
                    }

                    $new_elements[$el_id]["PROPERTY_VALUES"][$prop_arr["CODE"]] = $prop_arr["VALUE"];
                }

                foreach ($item_arr["PROPERTIES"] as $prop_arr) {
                    if ($prop_arr["PROPERTY_TYPE"] == "L" && $prop_arr["CODE"] != "DESIGN" && $prop_arr["CODE"] != "UNIT" && $prop_arr["VALUE"] != "" && $prop_arr["VALUE"] != false) {

                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>NEW_IBLOCK, "CODE"=>$prop_arr["CODE"], "VALUE" => $prop_arr["VALUE"] ));
                        if($enum_fields = $property_enums->GetNext())
                        {
                            $prop_arr["VALUE"] = $enum_fields["ID"];
                        }

                        $new_elements[$el_id]["PROPERTY_VALUES"][$prop_arr["CODE"]] = $prop_arr["VALUE"];
                    } else {
                        continue;
                    }

                }
            }
            // $result['new_elements'] = $new_elements;

            foreach ($new_elements as $xml_id_k => $Item) {
                $el = new CIBlockElement;

                if($PRODUCT_ID = $el->Add($Item)) {

                    $result['new_elements'][] = $PRODUCT_ID;

                } else {
                    // echo "Error: ".$el->LAST_ERROR;
                    // $result['error'] = true;
                    $result['error_text'][] = "El ".$xml_id_k." NOT_ADD";
                }
            }

        } else {
            $result['error'] = true;
            $result['error_text'][] = "modules_offline";
        }
    } else {
        $result['error'] = true;
        $result['error_text'][] = "NO_DATA";
    }
    echo json_encode($result);
    // print_r($result);
    // var_dump($result);
}
?>
