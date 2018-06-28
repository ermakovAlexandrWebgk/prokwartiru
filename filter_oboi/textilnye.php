<?php                                           
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");   
die();                                   
$arMaterial = array("2709", "2710", "2711");
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_FILTER_OBOI");
$arFilter = Array("PROPERTY_MATERIAL" => $arMaterial, "IBLOCK_ID" => 77);          
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($arFields = $res->Fetch()) 
{                   
    CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("FILTER_OBOI" => "3371"));        
    $el = new CIBlockElement;        
    $resNew = $el->Update($arFields["ID"], array());
}
                            
die();                        
?>