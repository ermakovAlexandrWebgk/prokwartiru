<?php                                           
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");   
                                                
die();                                                   
$arSections = array("34646", "34645");
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_FILTER_OBOI");
$arFilter = Array("SECTION_ID" => $arSections, "INCLUDE_SUBSECTIONS"=>"Y", "IBLOCK_ID" => 77, "!PROPERTY_FILTER_OBOI" => 3329);          
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($arFields = $res->Fetch()) 
{    
    //$arIDs[$arFields["ID"]][] = $arFields["PROPERTY_FILTER_OBOI_ENUM_ID"];                                                                                                                               
    CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("FILTER_OBOI" => "3329"));
}
                                               
die();                        
?>