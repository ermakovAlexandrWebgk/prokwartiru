<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?       
die();    
$arSelectCheap = Array("ID", "IBLOCK_ID", "PROPERTY_FILTER_OBOI", "PROPERTY_FILTER_SIZE", "CATALOG_GROUP_5");
$arFilterCheap = Array("IBLOCK_ID"=>77);   
  
$res = CIBlockElement::GetList(Array(), $arFilterCheap, false, Array(), $arSelectCheap);
while($arFieldsCheap = $res->Fetch()) {   
    if(empty($arElements[$arFieldsCheap["ID"]])) {
        $arElements[$arFieldsCheap["ID"]] = array();            
    }                                                                   
    if($arFieldsCheap["PROPERTY_FILTER_OBOI_ENUM_ID"] != 3325){                                        
        $arElements[$arFieldsCheap["ID"]][] = $arFieldsCheap["PROPERTY_FILTER_OBOI_ENUM_ID"];
    }                                                                                                                                                                                    
}               

foreach($arElements as $key => $value) {
    if(empty($value)){
        $arElements[$key] = false; 
    }               
    CIBlockElement::SetPropertyValuesEx($key, false, array("FILTER_OBOI" => $arElements[$key]));    
}          

$arElements = array();
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_FILTER_OBOI", "CATALOG_GROUP_5");
$arFilter = Array("IBLOCK_ID"=>77, "PROPERTY_CML2_BASE_UNIT" => 2720, "!PROPERTY_STYLE" => 2872,
array( 
    "LOGIC" => "OR",       
    array(
        "LOGIC" => "AND",
        array(
            "<CATALOG_PRICE_5" => 2000,
            "PROPERTY_FILTER_SIZE" => array(2743, 2744, 2745),        
        )  
    ),
    array(     
        "LOGIC" => "AND",
        array(
            "<CATALOG_PRICE_5" => 3000,
            "PROPERTY_FILTER_SIZE" => 2746,         
        )  
    ),          
));   
              
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($arFields = $res->Fetch()) {    
    if(!in_array(3325, $arElements[$arFields["ID"]])) {                                                     
        $arElements[$arFields["ID"]][] = 3325;                      
    }   
    if(!in_array($arFields["PROPERTY_FILTER_OBOI_ENUM_ID"], $arElements[$arFields["ID"]]) && !empty($arFields["PROPERTY_FILTER_OBOI_ENUM_ID"])) {                                                            
        $arElements[$arFields["ID"]][] = $arFields["PROPERTY_FILTER_OBOI_ENUM_ID"];              
    }                                                                             
}

foreach($arElements as $key => $value) {    
    CIBlockElement::SetPropertyValuesEx($key, false, array("FILTER_OBOI" => $arElements[$key]));
}        

     
/*
$arSelectPrice = Array("*");
$arFilterPrice = Array("IBLOCK_ID"=>77, "PRODUCT_ID"=>376185, "CATALOG_GROUP_ID"=>5);
$res = CPrice::GetList(Array(), $arFilterPrice, false, Array(), $arSelectPrice);
while($ob = $res->Fetch()) {
    arshow($ob);
    $Id[] = $ob['ID']; 
}         
*/

 /*
foreach ($Id as $value){
$ELEMENT_ID = $value ;  // код элемента
$PROPERTY_CODE = "FILTER_OBOI";  // код свойства
$PROPERTY_VALUE = 3371;  // значение свойства
\Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(77, $value); 
*/ 

// Установим новое значение для данного свойства данного элемента
//CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));



?>      