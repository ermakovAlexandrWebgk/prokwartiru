<?


function parse_catalog_elements($COUNT, $last_id = -1){

    $CATALOG_ID = 77; // новый инфоблок

    $result = array();
    $result['error'] = false;
    $upd_res = array();
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
                $xml_ids[] = $arFields["XML_ID"];
                $IDs[] = $arFields["ID"];
                $last_id = $arFields["ID"];

                // $upd_res[] =
                // CPrice::DeleteByProduct($arFields["ID"]);

            }
            $result["elements"] = $IDs;
            $result["old_elements"] = $xml_ids;
            $result["last_id"] = $last_id;
            $result["method"] = $_POST["method"];

            if (count($IDs) > 0) {
                $result['end_parse'] = false;
            } else {
                $result['end_parse'] = true;
            }

            // $result['end_parse'] = true;



            foreach ($full_el as $el_id => $ar_item) {

                $db_res = CCatalogProduct::GetList(
                    array(),
                    array("ID" => $ar_item["XML_ID"]),
                    false                );


                $table_exists = array(
                    'рулон' => 6,
                    'шт.' => 5,
                    'пог.м.' => 7,
                    'набор' => 10,
                    'кв.м.' => 8,
                    'комплект' => 11,
                    'м1' => 7,
                    'м3' => 9
                );
                $measure = "";
                foreach ($table_exists as $m_key => $m_id) {
                    if ($ar_item["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"] == $m_key && $ar_item["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"] != "" && $ar_item["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"] != false && !empty($ar_item["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"])) {
                        $measure = $m_id;
                    }
                }

                // $ar_item["PROPERTIES"]["CML2_BASE_UNIT"];

                if ($ar_res = $db_res->Fetch() )
                {
                    // arshow($ar_res);
                    $result["old_product"][$ar_res["ID"]] = $ar_res;
                    // echo "<pre>";
                    // print_r($ar_res);
                    // echo "</pre>";
                    $PRODUCT_ID = $ar_item["ID"];
                    $productFields = array(
                        "ID" => $PRODUCT_ID,
                        "QUANTITY" => $ar_res["QUANTITY"],
                        "QUANTITY_RESERVED" => $ar_res["QUANTITY_RESERVED"],
                        "QUANTITY_TRACE" => "D",
                        "CAN_BUY_ZERO" => "D",
                        "AVAILABLE" => $ar_res["AVAILABLE"],
                        "SUBSCRIBE" => $ar_res["SUBSCRIBE"],
                        "TYPE" => $ar_res["TYPE"],
                        "PRICE_TYPE" => $ar_res["PRICE_TYPE"],
                        "VAT_ID" => $ar_res["VAT_ID"],
                        "VAT_INCLUDED" => $ar_res["VAT_INCLUDED"],
                        "MEASURE"  => $measure
                    );

                    // $upd_res[] = CCatalogProduct::Add($productFields);

                    $product_prices = array();
                    $rs_product_prices = CPrice::GetList(array(), array("PRODUCT_ID" => $ar_res["ID"]), false, false, array());
                    while ($rs_prices = $rs_product_prices -> Fetch()) {
                        $product_prices[$PRODUCT_ID][] = $rs_prices;
                        $prices_upd[$PRODUCT_ID] = array();
                        $prices_add[$PRODUCT_ID] = array();

                        $price_fields = Array(
                            "PRODUCT_ID" => $ar_item["ID"],
                            "CATALOG_GROUP_ID" => $rs_prices["CATALOG_GROUP_ID"],
                            "PRICE" => $rs_prices["PRICE"],
                            "CURRENCY" => $rs_prices["CURRENCY"],
                        );

                        $price_fields_info[$PRODUCT_ID][] = $price_fields;

                        $res_pr = CPrice::GetList(
                            array(),
                            array(
                                    "PRODUCT_ID" => $PRODUCT_ID,
                                    "CATALOG_GROUP_ID" => $rs_prices["CATALOG_GROUP_ID"]
                                )
                        );

                        if ($arr_p = $res_pr->Fetch())
                        {
                            $prices_upd[$PRODUCT_ID][] = CPrice::Update($arr_p["ID"], $price_fields,false);
                        }
                        else
                        {
                            $prices_add[$PRODUCT_ID][] = CPrice::Add($price_fields);
                        }

                        unset($price_fields);
                        unset($res_pr);
                        unset($arr_p);

                    }

                    $result['new_prices'][] = $product_prices;
                    // if (is_array($product_prices) && count($product_prices) > 0) {
                    //     foreach ($product_prices as $price) {
                    //         $price_fields = Array(
                    //             "PRODUCT_ID" => $PRODUCT_ID,
                    //             "CATALOG_GROUP_ID" => $price["CATALOG_GROUP_ID"],
                    //             "PRICE" => $price["PRICE"],
                    //             "CURRENCY" => $price["CURRENCY"],
                    //         );
                    //
                    //         if ($arr = $res->Fetch())
                    //         {
                    //             CPrice::Update($PRODUCT_ID, $price_fields);
                    //         }
                    //         else
                    //         {
                    //             CPrice::Add($price_fields);
                    //         }
                    //         // CPrice::Add($price_fields);
                    //     }
                    // }
                } else {
                    $result['error'] = false;
                    $result['error_text'][] = $arFields["XML_ID"]." not_parse";
                }

                \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex($CATALOG_ID, $ar_item["ID"]);
            }

            $result['upd_info'] = $upd_res;
            $result['prices_upd'] = $prices_upd;
            $result['prices_add'] = $prices_add;
            $result['prices_info'] = $price_fields_info;
            // $result['end_parse'] = true;
        } else {
            $result['error'] = true;
            $result['error_text'][] = "modules_offline";
        }
    } else {
        $result['error'] = true;
        $result['error_text'][] = "NO_DATA";
    }

    // $result['end_parse'] = true;
    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);
    echo $result;

        // echo json_encode($result);
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
}
?>
