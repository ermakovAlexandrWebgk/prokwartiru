<?

function parse_fields_value($CATALOG_ID, $COUNT, $last_id){
    echo json_encode("elements_test");
}

?>

<?

// define('NEW_IBLOCK', 77);
// define('OLD_IBLOCK', 14);
//
// CModule::IncludeModule("iblock");
//
// $proprties = array();
//
// $IBLOCK_ID_old = OLD_IBLOCK;
// $properties_old = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID_old) );
// while ($prop_fields_old = $properties_old->GetNext())
// {
//   echo $prop_fields_old["ID"]." - ".$prop_fields_old["NAME"]."<br>";
//
//     if ($prop_fields_old["CODE"] == "SPECIALOFFER" || $prop_fields_old["CODE"] == "NEWPRODUCT" || $prop_fields_old["CODE"] == "SALELEADER"|| $prop_fields_old["CODE"] == "SALE" || $prop_fields_old["CODE"] == "RECOMMEND") {
//         continue;
//     }
//
//     $prop_fields_old["OLD_CODE"] = $prop_fields_old["CODE"];
//
//     if ($IBLOCK_ID_old == 73 && $prop_fields_old["CODE"] == "PROPERTY")
//     {
//         $prop_fields_old["CODE"] = "PROPERTY_LIGHTS";
//     }
//
//     // if ($IBLOCK_ID_old == 20 && $prop_fields_old["CODE"] == "RECOMMEND")
//     // {
//     //     $prop_fields_old["CODE"] = "RECOMMEND_SECT";
//     // } else {
//     //     $prop_fields_old["CODE"] = "RECOMMEND_PROD";
//     // }
//
//     if ($prop_fields_old["CODE"] == "DESIGN")
//     {
//         $res = CIBlock::GetList(
//             Array(),
//             Array(
//                 'ID' => $IBLOCK_ID_old,
//                 'TYPE'=>'catalog',
//                 'SITE_ID'=>SITE_ID,
//                 'ACTIVE'=>'Y',
//                 // "CNT_ACTIVE"=>"Y",
//             )
//         );
//
//         if($ar_res = $res->Fetch())
//         {
//             $prop_fields_old["CODE"] = $prop_fields_old["CODE"]."_".strtoupper($ar_res["CODE"]);
//         }
//         else
//         {
//             $result['error'] = true;
//             $result['error_text'][] = "свойство ".$prop_fields_old["CODE"]." iblock = ".$IBLOCK_ID_old." не было передано";
//         }
//     }
//
//     if ($prop_fields_old["CODE"] == "UNIT")
//     {
//         $prop_fields_old["CODE"] = "CML2_BASE_UNIT";
//     }
//
//     if ($prop_fields_old["CODE"] == "ARTICUL")
//     {
//         $prop_fields_old["CODE"] = "CML2_ARTICLE";
//     }
//
//     $proprties[$prop_fields_old["CODE"]]["old"] = $prop_fields_old;
//     // arshow($prop_fields);
// }
//
// $IBLOCK_ID_new = NEW_IBLOCK;
// $properties_new = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID_new));
// while ($prop_fields_new = $properties_new->GetNext())
// {
//   // echo $prop_fields["ID"]." - ".$prop_fields["NAME"]."<br>";
//   $proprties[$prop_fields_new["CODE"]]["new"] = $prop_fields_new;
//   // arshow($prop_fields);
// }
//
// foreach ($proprties as $prop_code => $prop_arr)
// {
//     if (count($prop_arr) == 2)
//     {
//         echo "<pre> true\n";
//         echo "old ";
//         print_r($prop_arr["old"]['CODE']);
//         echo "\nnew ";
//         print_r($prop_arr["new"]['CODE']);
//         echo "</pre>";
//
//         if ( $prop_arr["old"]["PROPERTY_TYPE"] != $prop_arr["new"]["PROPERTY_TYPE"] ) { // записываем если типы не равны
//             $result['no_match'][] = ['iblock' => $IBLOCK_ID_old, 'prop_code' => $prop_arr['old']["OLD_CODE"], 'prop_type' => $prop_arr["old"]["PROPERTY_TYPE"]." != ".$prop_arr["new"]["PROPERTY_TYPE"]];
//             continue;
//         } else {
//             if ($prop_arr["old"]["PROPERTY_TYPE"] == 'L') {
//
//                 echo "<pre>";
//                 print_r($prop_arr["old"]["ID"]);
//                 echo"\n";
//                 print_r($prop_arr["new"]["ID"]);
//                 echo "</pre>";
//
//             $values_enum_arr[$prop_arr["new"]["ID"]] = array( "old" => array(), "new" => array() );
//
//                 $property_enums_old = CIBlockPropertyEnum::GetList(
//                     Array("SORT"=>"ASC"),
//                     Array("IBLOCK_ID"=>$IBLOCK_ID_old, "CODE"=>$prop_arr["old"]["OLD_CODE"]) );
//                 while($enum_fields_old = $property_enums_old->GetNext())
//                 {
//                     // $values_enum_arr["old"] = [ $enum_fields_old["ID"] => $enum_fields_old["VALUE"] ];
//                     $values_enum_arr[ $prop_arr["new"]["ID"] ]["old"][] = $enum_fields_old["VALUE"];
//                     // echo "<pre>\nold\n";
//                     // print_r($enum_fields_old);
//                     // echo "</pre>";
//                 }
//
//                 $property_enums_new = CIBlockPropertyEnum::GetList(
//                     Array("SORT"=>"ASC"),
//                     Array("IBLOCK_ID"=>NEW_IBLOCK, "CODE"=>$prop_code)
//                 );
//                 while($enum_fields_new = $property_enums_new->GetNext())
//                 {
//                     $values_enum_arr[ $prop_arr["new"]["ID"] ]["new"][] = $enum_fields_new["VALUE"];
//                     // echo "<pre>\nnew\n";
//                     // print_r($enum_fields_new);
//                     // echo "</pre>";
//                 }
//
//                 echo "<pre>";
//                 print_r($values_enum_arr);
//                 echo "</pre>";
//
//                 $values_enum_arr_uni = array_unique($values_enum_arr[$prop_arr["new"]["ID"]]["old"]);
//
//                 echo "<pre>";
//                 print_r($values_enum_arr_uni);
//                 echo "</pre>";
//
//                 $diff = array_diff ($values_enum_arr_uni, $values_enum_arr[$prop_arr["new"]["ID"]]["new"]);
//
//                 echo "<pre>";
//                 print_r($diff);
//                 echo "</pre>";
//
//                 foreach ($diff as $value) {
//                     // $ibpenum = new CIBlockPropertyEnum;
//                     // if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>$prop_arr["new"]["ID"], 'VALUE'=>$value))){
//                     //     echo 'New ID:'.$PropID;
//                     //     $result["new_enum"][$prop_arr["new"]["ID"]][] = $PropID;
//                     //
//                     // }
//                 }
//
//
//             } else {
//                 continue;
//             }
//         }
//
//     }
//     else
//     {
//         continue;
//     }
// }
//
// echo "<pre>";
// print_r($result);
// echo "</pre>";
