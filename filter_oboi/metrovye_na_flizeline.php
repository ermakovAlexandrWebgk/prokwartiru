<?php                                           
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");   

die();
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_FILTER_OBOI");
$arFilter = Array("PROPERTY_FILTER_OBOI" => 3326, "IBLOCK_ID" => 77);          
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($arFields = $res->Fetch()) 
{                 
    $arProductIDs[] = $arFields["ID"];  
}
                
$arSelectWithVal = Array("ID", "IBLOCK_ID", "PROPERTY_FILTER_OBOI");
$arFilterWithVal = Array("ID" => $arProductIDs, "IBLOCK_ID" => 77);          
$resWithVal = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelectWithVal);
while($arFieldsWithVal = $resWithVal->Fetch()) {   
    if(empty($arElements[$arFieldsWithVal["ID"]])) {
        $arElements[$arFieldsWithVal["ID"]] = array();            
    }                                                                   
    if($arFieldsWithVal["PROPERTY_FILTER_OBOI_ENUM_ID"] != 3326){                                        
        $arElements[$arFieldsWithVal["ID"]][] = $arFieldsWithVal["PROPERTY_FILTER_OBOI_ENUM_ID"];
    }    
}     

foreach($arElements as $key => $value) {
    if(empty($value)){
        $arElements[$key] = false; 
    }   
          
    //arshow($arElements[$key]);                                                              
    CIBlockElement::SetPropertyValuesEx($key, false, array("FILTER_OBOI" => $arElements[$key]));    
}       
         
$arSelectNew = Array("ID", "PROPERTY_FILTER_OBOI");
$arFilterNew = Array("PROPERTY_MATERIAL" => array(2705, 2706), "PROPERTY_CML2_BASE_UNIT" => 2720, "PROPERTY_FILTER_SIZE" => array(2746, 2747));
$resNew = CIBlockElement::GetList(Array(), $arFilterNew, false, Array(), $arSelectNew);
while($arFieldsNew = $resNew->Fetch()) {         
    if(!in_array(3326, $arNewUpdate[$arFieldsNew["ID"]])) {                                                     
        $arNewUpdate[$arFieldsNew["ID"]][] = 3326;                      
    }   
    if(!empty($arFieldsNew["PROPERTY_FILTER_OBOI_ENUM_ID"])) {
        $arNewUpdate[$arFieldsNew["ID"]][] = $arFieldsNew["PROPERTY_FILTER_OBOI_ENUM_ID"];
    }                                
}   
                       
foreach($arNewUpdate as $keyUpdate => $valueUpdate) {                                                              
    if(empty($valueUpdate)){
        $arNewUpdate[$keyUpdate] = false; 
    }                 
    if(!empty($arNewUpdate[$keyUpdate])) {
        //arshow($arNewUpdate[$keyUpdate]);
        CIBlockElement::SetPropertyValuesEx($keyUpdate, false, array("FILTER_OBOI" => $arNewUpdate[$keyUpdate]));         
    }                                                                                                            
}                              
         
         
?>