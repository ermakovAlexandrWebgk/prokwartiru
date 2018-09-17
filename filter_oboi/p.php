<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("iblock");
    Cmodule::IncludeModule('catalog');


   $arSelect = Array("ID", "PROPERTY_PRICE_PER_M2", "PROPERTY_UPAK_KBM");
    $arFilter = Array("IBLOCK_ID"=>77, "SECTION_ID" => array(34378), "INCLUDE_SUBSECTIONS"=>"Y");
    $result = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
   
   while($ob = $result->Fetch()){
       $tempArr[$ob['ID']] = array("KF"=>$ob["PROPERTY_UPAK_KBM_VALUE"], "MEASURE" =>12);
     
       
   }
   foreach($tempArr as $key => $value){
        $db_res = CPrice::GetList(array(),array("PRODUCT_ID" => $key, "CATALOG_GROUP_ID" => 5));
         while($prices = $db_res->Fetch()){
           if($prices['PRODUCT_ID'] == $key){
               $tempArr[$key]['ID'] = $key;
               $tempArr[$key]["PRICE_ID"] = $prices["ID"];
               $tempArr[$key]["PRICE"] = $prices["PRICE"];
               $tempArr[$key]["UPAK_PRICE"] = floatval(str_replace(',', '.', $tempArr[$key]['KF'])) *  $tempArr[$key]["PRICE"];
               $tempArr[$key]["UPAK_PRICE"] = number_format((float)$tempArr[$key]["UPAK_PRICE"], 2, '.', '');
           }
         }
   }
   foreach($tempArr as $key => $value){
     //   CIBlockElement::SetPropertyValuesEx($key, false, array("PRICE_PER_M2" => $value['PRICE']));
     //   CPrice::Update($value["PRICE_ID"], array("PRODUCT_ID" => $key, "CATALOG_GROUP_ID" => 5, "PRICE" => $value['UPAK_PRICE'], "CURRENCY" => "RUB"));
      //  CCatalogProduct::Update($key, array("MEASURE"=>12));
   }
    $fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/filter_oboi/laminat.csv', 'w');

    foreach ($tempArr as $field) {
       fputcsv($fp, $field, ";");
    }

    fclose($fp);
arshow($tempArr);

 
