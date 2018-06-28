<?define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/cat_update/functions/parse_structure.php');
require_once(__ROOT__.'/cat_update/functions/parse_fields_value.php');
require_once(__ROOT__.'/cat_update/functions/parse_elements.php');
require_once(__ROOT__.'/cat_update/functions/parse_catalog_elements.php');
require_once(__ROOT__.'/cat_update/functions/get_units.php');
require_once(__ROOT__.'/cat_update/functions/set_units.php');
require_once(__ROOT__.'/cat_update/functions/elements_test.php');
$GLOBALS['APPLICATION']->RestartBuffer();

$CATALOG_ID = $_POST["iblock"];
$COUNT = $_POST["count"];
$last_id = $_POST["last_id"];
$method = $_POST["method"];
define('NEW_IBLOCK', 77);


switch ($method) {
    case 1:
        parse_structure($CATALOG_ID);
        break;

    case 11:
        parse_fields_value($CATALOG_ID); //перенос значаний свойст типа список и сбор необходимых значений в списки
        break;

    case 2:
        parse_elements($CATALOG_ID, $COUNT, $last_id); //перенос элементов и свойств
        break;

    case 3:
        parse_catalog_elements($COUNT, $last_id); // перенос свойств товаров
        break;

    // case 4:
    //     get_units($CATALOG_ID, $COUNT, $last_id); // получение ед изм
    //     break;
    //
    // case 5:
    //     set_units($CATALOG_ID, $COUNT, $last_id); // установка ед изм
    //     break;
    case 6:
        plitka_size($COUNT, $last_id); // установка ед изм
        break;

    case 12:
        elements_test($CATALOG_ID, $COUNT, $last_id);
        break;
    case 13:
        thickness_reparse($COUNT, $last_id);
        break;

    case 14:
        set_property_fabrica($COUNT, $last_id);
        break;

    case 15:
        set_width_oboi($COUNT, $last_id);
        break;

    case 16:
        set_faset_index($COUNT, $last_id);
        break; 
	case 17:
        emptyUpdate($COUNT, $last_id);
        break;

    default:
        $result['error'] = true;
        $result['error_text'] = "NO_METHOD";
        echo json_encode($result);
        break;
}


CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

function plitka_size($COUNT,$last_id)
{
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("catalog");

    $elements = CIBlockElement::GetList (array("ID" => "asc"), array("IBLOCK_ID" => 77, "SECTION_ID" => 35615, ">ID" => $last_id , "INCLUDE_SUBSECTIONS" => "Y"), false, Array("nPageSize"=>$COUNT), array("ID", "NAME", "PROPERTY_SIZE"));
    while ($subsection_elements = $elements -> Fetch()) {
        $IDs[] = $subsection_elements["ID"];

        if (strlen($subsection_elements["PROPERTY_SIZE_VALUE"]) > 0) {
            // echo "<pre>";
            $el_length = stristr($subsection_elements["PROPERTY_SIZE_VALUE"], 'x', true);
            if (strlen($el_length) <= 0) {
                 $el_length = stristr($subsection_elements["PROPERTY_SIZE_VALUE"], 'х', true);
            }
            $el_width = substr(stristr($subsection_elements["PROPERTY_SIZE_VALUE"], 'x'), 1);
            if (strlen($el_width) <= 0) {
                 $el_width = substr(stristr($subsection_elements["PROPERTY_SIZE_VALUE"], 'х'), 1);
            }
            // echo "el_length = " . $el_length . " || el_width = " . $el_width;
            // echo json_encode("el_length = " . $el_length . " || el_width = " . $el_width);
            // echo "</pre>";
            // CIBlockElement::SetPropertyValues($subsection_elements["ID"], 77, $el_length, "LENGTH_PLITKA");
            // CIBlockElement::SetPropertyValues($subsection_elements["ID"], 77, $el_width, "WIDTH_PLITKA");
            $property_values = array();
            $property_values = array("LENGTH_PLITKA" => $el_length, "WIDTH_PLITKA" =>  $el_width);
            CIBlockElement::SetPropertyValuesEx($ar_item["ID"], $CATALOG_ID, $property_values);
            $result["info"][] = $subsection_elements["ID"]." el_length = " . $el_length . " || el_width = " . $el_width;
        }
        $last_id = $subsection_elements["ID"];
    }
    $result["last_id"] = $last_id;
    $result["method"] = $_POST["method"];
    if (count($IDs) > 0) {
        $result['end_parse'] = false;
    } else {
        $result['end_parse'] = true;
    }

    // encode
    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);

    echo $result;
}

function emptyUpdate($COUNT,$last_id)
{
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("catalog");

    $elements = CIBlockElement::GetList (array("ID" => "asc"), array("IBLOCK_ID" => 77, "SECTION_ID" => 34639, ">ID" => $last_id , "INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_CML2_BASE_UNIT_ENUM_ID" => 2721, ">DATE_CREATE"=> '10.05.2018 00:00:00',), false, Array("nPageSize"=>$COUNT), array("ID"));
    while ($subsection_elements = $elements -> Fetch()) {
        $IDs[] = $subsection_elements["ID"];
        $last_id = $subsection_elements["ID"];
    }
    $result["last_id"] = $last_id;
    $result["method"] = $_POST["method"];
	foreach ($IDs as $id){
      // \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(77, $id);

      if(CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array("CML2_BASE_UNIT" => 2720))){
	      $result["SUCCESS_UPD"][] = $id;
	   }else{
	        $result["FAIL_UPDATE"][] = $id;
	 }
    }    
    if (count($IDs) > 0) {
        $result['end_parse'] = false;
    } else {
        $result['end_parse'] = true;
    }

    // encode
    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);

    echo $result;
}

function thickness_reparse($COUNT,$last_id)
{
    $CATALOG_ID = 77; // новый инфоблок

    $result = array();
    $result['error'] = false;
    $upd_res = array();
    if (!empty($CATALOG_ID) && !empty($COUNT) && !empty($last_id) ) {
        // echo "1";
        if (CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")) {
            // echo "2";
            $arSelect = Array();
            $arFilter = Array("IBLOCK_ID"=>$CATALOG_ID, ">ID" => $last_id, "ACTIVE" => "Y", "SECTION_ID" => 34377, "INCLUDE_SUBSECTIONS" => "Y");

            // unset($last_id);
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
                // $xml_ids[] = $arFields["XML_ID"];
                $IDs[] = $arFields["ID"];
                $last_id = $arFields["ID"];

                // $upd_res[] =
                // CPrice::DeleteByProduct($arFields["ID"]);

            }

            $result["elements"] = $IDs;
            $result["old_elements"] = $xml_ids;
            $result["last_id"] = $last_id;
            $result["method"] = $_POST["method"];
            $res_upd = array();

            if (count($IDs) > 0) {
                $result['end_parse'] = false;
            } else {
                $result['end_parse'] = true;
            }

            $PROPERTY_CODE  =  'THICKNESS_NEW' ;

            $properties  = CIBlockProperty::GetList( Array () ,  Array ( "ACTIVE" => "Y" ,  "IBLOCK_ID" => $CATALOG_ID , "CODE" => $PROPERTY_CODE ));
            if  ( $prop_fields  =  $properties -> GetNext() )
            {
                $PROPERTY_ID  =  $prop_fields[ "ID" ];
            }

            foreach ($full_el as $el_id => $ar_item) {
                // $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"];

                if (isset($ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]) && !empty($ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]) && $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"] != false) {

                    // $current_value = preg_replace('/[^,.0-9]/', '', $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]);
                    $current_value = preg_replace('/[,]/', '.', $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]);
                    $current_value = floatval($current_value);

                    $property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>$CATALOG_ID, "CODE"=>$PROPERTY_CODE, "VALUE" => $current_value) );
                    // while($enum_fields = $property_enums->GetNext())
                    if($enum_fields = $property_enums->GetNext())
                    {
                        CIBlockElement::SetPropertyValuesEx($ar_item["ID"], $CATALOG_ID, array($PROPERTY_CODE => $enum_fields["ID"]));
                        $res_upd[$ar_item["ID"]] = "set";
                    } else {

                        $ibpenum = new CIBlockPropertyEnum;

                        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>$PROPERTY_ID, 'VALUE'=>$current_value))){
                            CIBlockElement::SetPropertyValuesEx($ar_item["ID"], $CATALOG_ID, array($PROPERTY_CODE => $PropID));
                            $res_upd[$ar_item["ID"]] = "add_set";
                        }
                    }
                } else {
                    $res_upd[$ar_item["ID"]] = "no_value";
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
    $result['upd_info'] = $res_upd;

    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);
    echo $result;
}

function set_property_fabrica($COUNT = 10,$last_id)
{
    $CATALOG_ID = 77; // новый инфоблок

    if (!empty($CATALOG_ID) && !empty($COUNT) && !empty($last_id) ) {

        if (CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")) {


            $arFilter = Array('IBLOCK_ID' => $CATALOG_ID, ">DEPTH_LEVEL" => 1, ">ID" => $last_id);

            $arSelect = array("ID", "NAME", "SORT", "CODE", "XML_ID", "IBLOCK_SECTION_ID", "ACTIVE", "PICTURE", "UF_*", "IBLOCK_CODE");
            $db_sect_list = CIBlockSection::GetList( Array("ID" => "asc"), $arFilter, false, $arSelect, array("nTopCount" => $COUNT));
            while($ar_sections = $db_sect_list->GetNext())
            {
                $sect_IDs[] = $ar_sections["ID"];
                // echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
                $last_id = $ar_sections["ID"];
                $set_value = '';

                // echo "--===Sect===--\n";
                // var_dump($ar_sections["ID"]);
                // var_dump($ar_sections["NAME"]);
                // var_dump($ar_sections["UF_SHOWROOM"]);
                // echo "--===end_Sect===--\n";



                // $res_fabrics = CIBlockElement::GetList (array("ID" => "asc"), array("ID" => $ar_sections["UF_FABRIKA"], "IBLOCK_ID" => 6), false, false, array() );
                // if ( $fabric = $res_fabrics -> Fetch() ) {
                //
                //     $set_value = $fabric["NAME"];
                //     $val_info[$ar_sections["ID"]][] = $set_value;
                //
                //     $country_sect = GetIBlockSection($fabric["IBLOCK_SECTION_ID"], 'catalog');
                //     $country = $country_sect["NAME"];
                //     $val_info[$ar_sections["ID"]][] = $country;

                    // echo "--===country===--\n";
                    // var_dump($country);
                    // echo "--===end_country===--\n";

                    // echo "--===Fab===--\n";
                    // var_dump($fabric["NAME"]);
                    // echo "--===end_Fab===--\n";
                // }

                $PROPERTY_CODE  =  'STIKERS';

                $properties  = CIBlockProperty::GetList( Array () ,  Array ( "ACTIVE" => "Y" ,  "IBLOCK_ID" => $CATALOG_ID , "CODE" => $PROPERTY_CODE ));
                if  ( $prop_fields  =  $properties -> GetNext() )
                {
                    $PROPERTY_ID  =  $prop_fields[ "ID" ];
                }

                // $PROPERTY_CODE2  =  'COUNTRY';
                //
                // $properties2  = CIBlockProperty::GetList( Array () ,  Array ( "ACTIVE" => "Y" ,  "IBLOCK_ID" => $CATALOG_ID , "CODE" => $PROPERTY_CODE2 ));
                // if  ( $prop_fields2  =  $properties2 -> GetNext() )
                // {
                //     $PROPERTY_ID2  =  $prop_fields2[ "ID" ];
                // }


                $res_subsection_elements = CIBlockElement::GetList (array("ID" => "asc"), array("IBLOCK_ID" => $CATALOG_ID, "SECTION_ID" => $ar_sections["ID"]), false, false, array() );
                $ii = 0;
                while ( $subsection_element = $res_subsection_elements -> GetNext() ) {
                    $IDs[$ar_sections["ID"]][] = $subsection_element["ID"];

                    //if (isset($set_value) && !empty($set_value) && $set_value != false) { // фабрика


                        $VALUES = array();
                        $res = CIBlockElement::GetProperty($CATALOG_ID, $subsection_element["ID"], array("SORT" => "asc"), array("ID" => $PROPERTY_ID));
                        while ($ob = $res->GetNext())
                        {
                            $VALUES[] = $ob['VALUE'];
                        }

                        if (is_null($VALUES[0])) {
                            unset($VALUES[0]);
                        }

                        if ($ar_sections["UF_SHOWROOM"] == 1) {
                            $VALUES[] =  3369;

                            CIBlockElement::SetPropertyValuesEx($subsection_element["ID"], $CATALOG_ID, array($PROPERTY_CODE => $VALUES));
                            $res_upd[$subsection_element["ID"]] = "set";
                        }


                        // $property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>$CATALOG_ID, "CODE"=>$PROPERTY_CODE, "VALUE" => $set_value) );
                        // while($enum_fields = $property_enums->GetNext())
                        // if($enum_fields = $property_enums->GetNext())
                        // {
                        //     // CIBlockElement::SetPropertyValuesEx($subsection_element["ID"], $CATALOG_ID, array($PROPERTY_CODE => $enum_fields["ID"]));
                        //     $res_upd[$ar_sections["ID"]][$subsection_element["ID"]][] = "set";
                        // } else {
                        //
                        //     $ibpenum = new CIBlockPropertyEnum;
                        //
                        //     if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>$PROPERTY_ID, 'VALUE'=>$set_value))){
                        //         // CIBlockElement::SetPropertyValuesEx($subsection_element["ID"], $CATALOG_ID, array($PROPERTY_CODE => $PropID));
                        //         $res_upd[$ar_sections["ID"]][$subsection_element["ID"]][] = "add_set";
                        //     }
                        // }
                    // } else {
                    //     $res_upd[$ar_sections["ID"]][$subsection_element["ID"]][] = "no_value";
                    //}

                    // if (isset($country) && !empty($country) && $country != false) { // страна
                    //
                    //     $property_enums2 = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>$CATALOG_ID, "CODE"=>$PROPERTY_CODE2, "VALUE" => $country) );
                    //     // while($enum_fields = $property_enums->GetNext())
                    //     if($enum_fields2 = $property_enums2->GetNext())
                    //     {
                    //         CIBlockElement::SetPropertyValuesEx($subsection_element["ID"], $CATALOG_ID, array($PROPERTY_CODE2 => $enum_fields2["ID"]));
                    //         $res_upd[$ar_sections["ID"]][$subsection_element["ID"]][] = "set";
                    //     } else {
                    //
                    //         $ibpenum2 = new CIBlockPropertyEnum;
                    //
                    //         if($PropID2 = $ibpenum2->Add(Array('PROPERTY_ID'=>$PROPERTY_ID2, 'VALUE'=>$country))){
                    //             CIBlockElement::SetPropertyValuesEx($subsection_element["ID"], $CATALOG_ID, array($PROPERTY_CODE2 => $PropID2));
                    //             $res_upd[$ar_sections["ID"]][$subsection_element["ID"]][] = "add_set";
                    //         }
                    //     }
                    // } else {
                    //     $res_upd[$ar_sections["ID"]][$subsection_element["ID"]][] = "no_value";
                    // }

                    // echo "--===ITEM===--\n";
                    // var_dump($subsection_element["ID"]);
                    // var_dump($subsection_element["NAME"]);
                    // echo "--===end_ITEM===--\n";
                    $ii++;
                    // \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex($CATALOG_ID, $subsection_element["ID"]);


                }
                if($ii == 0) {
                    // echo "not_ITEMS\n";
                    $IDs[$ar_sections["ID"]][] = "not_ITEMS";
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

    $result["sections"] = $IDs;
    $result["upd_info"] = $res_upd;

    // $result["old_elements"] = $xml_ids;
    $result["last_id"] = $last_id;
    $result["method"] = $_POST["method"];
    $result['values'] = $val_info;

    // $result['end_parse'] = true;
    if (count($IDs) > 0) {
        $result['end_parse'] = false;
    } else {
        $result['end_parse'] = true;
    }

    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);
    echo $result;

}

function set_width_oboi($COUNT,$last_id)
{
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

            // unset($last_id);
            // $last_id = 0;
            $res = CIBlockElement::GetList(Array("ID" => "asc"), $arFilter, false, Array("nPageSize"=>$COUNT), $arSelect);
            while($ob = $res->GetNextElement())
            // if ($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                // $arProps = $ob->GetProperties();

                // $full_el[$arFields["ID"]] = ['fields' => $arFields, 'props' => $arProps];
                $full_el[$arFields["ID"]] =  $arFields;
                // $full_el[$arFields["ID"]]["PROPERTIES"] =  $arProps;
                $xml_ids[] = $arFields["XML_ID"];
                $IDs[] = $arFields["ID"];
                // $IDs[$arFields["ID"]] = array('SALELEADER' => $arProps["SALELEADER"]["VALUE"], 'NEWPRODUCT' => $arProps["NEWPRODUCT"]["VALUE"]);
                $last_id = $arFields["ID"];

                $res_xml_el = CIBlockElement::GetList(Array("ID" => "asc"), Array("ID" => $arFields["XML_ID"]), false, false, array());
                if ($ob_xml_el = $res_xml_el->GetNextElement()) {
                    $$arProps = $ob_xml_el->GetProperties();
                    $full_el[$arFields["ID"]]["PROPERTIES"] = $arProps;
                    $IDs_prop[$arFields["ID"]] = array('SALELEADER' => $arProps["SALELEADER"]["VALUE"], 'NEWPRODUCT' => $arProps["NEWPRODUCT"]["VALUE"]);
                }
            }

            $result["elements"] = $IDs;
            $result["el_props"] = $IDs_prop;
            $result["old_elements"] = $xml_ids;
            $result["last_id"] = $last_id;
            $result["method"] = $_POST["method"];
            $res_upd = array();

            if (count($IDs) > 0) {
                $result['end_parse'] = false;
            } else {
                $result['end_parse'] = true;
            }

            // $result['end_parse'] = true;

            $PROPERTY_CODE  =  'STIKERS' ;

            $properties  = CIBlockProperty::GetList( Array () ,  Array ( "ACTIVE" => "Y" ,  "IBLOCK_ID" => $CATALOG_ID , "CODE" => $PROPERTY_CODE ));
            if  ( $prop_fields  =  $properties -> GetNext() )
            {
                $PROPERTY_ID  =  $prop_fields[ "ID" ];

                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>$PROPERTY_CODE));
                while($enum_fields = $property_enums->GetNext())
                {
                    $property_values[$enum_fields["ID"]] = $enum_fields;
                }
                // echo "--===prop_v===--\n";
                // var_dump($property_values);
                // echo "--===prop_v===--\n";
            }

            foreach ($full_el as $el_id => $ar_item) {
                // $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"];

                // $arFilter_s = Array('IBLOCK_ID' => $CATALOG_ID, "ID" => $ar_item["IBLOCK_SECTION_ID"]);

                // $arSelect_s = array("ID", "NAME", "SORT", "CODE", "XML_ID", "IBLOCK_SECTION_ID", "ACTIVE", "PICTURE", "UF_*", "IBLOCK_CODE");
                // $db_sect_list = CIBlockSection::GetList( Array("ID" => "asc"), $arFilter_s, false, $arSelect_s, array());

                $VALUES = array();
                $res = CIBlockElement::GetProperty($CATALOG_ID, $ar_item["ID"], array("SORT" => "asc"), array("ID" => $PROPERTY_ID));
                while ($ob = $res->GetNext())
                {
                    $VALUES[] = $ob['VALUE'];
                }
                // echo "--===VALUES===--\n";
                // var_dump($ar_item["ID"]);
                // var_dump($VALUES);
                // echo "--===VALUES===--\n";

                // while($ar_sections = $db_sect_list->GetNext())
                // {

                    // echo "--===Sect===--\n";
                    // var_dump($ar_item["PROPERTIES"]["FILTER_SIZE"]);
                    // var_dump($ar_sections["NAME"]);
                    // var_dump($ar_sections["UF_CHEAP"]);
                    // echo "--===end_Sect===--\n";

                    // if ($ar_item["PROPERTIES"]["FILTER_SIZE"]["VALUE_ENUM_ID"] == "2746") {

                        if (is_null($VALUES[0])) {
                            unset($VALUES[0]);
                        }
                        if ($ar_item["PROPERTIES"]["NEWPRODUCT"]["VALUE"] != "" && $ar_item["PROPERTIES"]["NEWPRODUCT"]["VALUE"] != false) {
                            $VALUES[] =  3367;
                        }
                        if ($ar_item["PROPERTIES"]["SALELEADER"]["VALUE"] != "" && $ar_item["PROPERTIES"]["SALELEADER"]["VALUE"] != false) {
                            $VALUES[] =  3365;
                        }
                        // if ($ar_item["PROPERTIES"]["NEWPRODUCT"] != "" && $ar_item["PROPERTIES"]["NEWPRODUCT"] != false) {
                        //     $VALUES[] =  3367;
                        // }

                        // $VALUES[] =  3344;

                        CIBlockElement::SetPropertyValuesEx($ar_item["ID"], $CATALOG_ID, array($PROPERTY_CODE => $VALUES));
                        $res_upd[$ar_item["ID"]] = "set";
                        // echo "set\n";

                    // }
                //
                // }


                // if (isset($ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]) && !empty($ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]) && $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"] != false) {
                //
                //     // $current_value = preg_replace('/[^,.0-9]/', '', $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]);
                //     $current_value = preg_replace('/[,]/', '.', $ar_item["PROPERTIES"]["THICKNESS"]["VALUE"]);
                //     $current_value = floatval($current_value);
                //
                //     $property_enums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID"=>$CATALOG_ID, "CODE"=>$PROPERTY_CODE, "VALUE" => $current_value) );
                //     // while($enum_fields = $property_enums->GetNext())
                //     if($enum_fields = $property_enums->GetNext())
                //     {
                //         CIBlockElement::SetPropertyValuesEx($ar_item["ID"], $CATALOG_ID, array($PROPERTY_CODE => $enum_fields["ID"]));
                //         $res_upd[$ar_item["ID"]] = "set";
                //     } else {
                //
                //         $ibpenum = new CIBlockPropertyEnum;
                //
                //         if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>$PROPERTY_ID, 'VALUE'=>$current_value))){
                //             CIBlockElement::SetPropertyValuesEx($ar_item["ID"], $CATALOG_ID, array($PROPERTY_CODE => $PropID));
                //             $res_upd[$ar_item["ID"]] = "add_set";
                //         }
                //     }
                // } else {
                //     $res_upd[$ar_item["ID"]] = "no_value";
                // }
            }
        } else {
            $result['error'] = true;
            $result['error_text'][] = "modules_offline";
        }
    } else {
        $result['error'] = true;
        $result['error_text'][] = "NO_DATA";
    }
    $result['upd_info'] = $res_upd;

    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);
    echo $result;
}
function set_faset_index($COUNT,$last_id)
{
    $CATALOG_ID = 77; // новый инфоблок

    $result = array();
    $result['error'] = false;
    $upd_res = array();
    if (!empty($CATALOG_ID) && !empty($COUNT) && !empty($last_id) ) {
        // echo "1";
        if (CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")) {
            // echo "2";
            $arSelect = Array();
            $arFilter = Array("IBLOCK_ID"=>$CATALOG_ID, ">ID" => $last_id);

            // unset($last_id);
            // $last_id = 0;
            $res = CIBlockElement::GetList(Array("ID" => "asc"), $arFilter, false, Array("nPageSize"=>$COUNT), $arSelect);
            while($ob = $res->GetNextElement())
            // if ($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();

                $IDs[] = $arFields["ID"];
                $last_id = $arFields["ID"];

                // $el = new CIBlockElement;

            	// $res_upd_info[] = $el->Update($arFields["ID"], array("ACTIVE"=>$arFields["ACTIVE"]));

                // \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex($CATALOG_ID, $arFields["ID"]);

            }

            $result["elements"] = $IDs;
            // $result["old_elements"] = $xml_ids;
            $result["last_id"] = $last_id;
            $result["method"] = $_POST["method"];
            // $res_upd = array();

            if (count($IDs) > 0) {
                $result['end_parse'] = false;
            } else {
                $result['end_parse'] = true;
            }

        } else {
            $result['error'] = true;
            $result['error_text'][] = "modules_offline";
        }
    } else {
        $result['error'] = true;
        $result['error_text'][] = "NO_DATA";
    }
    $result['upd_info'] = $res_upd_info;

    $result = \Bitrix\Main\Web\Json::encode($result, $options = null);
    echo $result;
}
?>
