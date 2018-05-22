<?php                                           
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");    


$db_res = CPrice::GetList(
                    array(),
                    array(
                    "IBLOCK_ID"=>77,
                    "PRODUCT_ID",
                    "CATALOG_GROUP_ID"=> 1,
                    ),
                    array("nTopCount" => 10),
                    array()
);
while ($ar_res = $db_res->Fetch())
{
arshow($ar_res);
echo $i++;
//CPrice::Update($ar_res["ID"], $arFields);
}


$arSelect = Array("ID", "PROPERTY_MAXIMUM_PRICE");
$arFilter = Array("ID"=>78614);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

while($ob = $res->Fetch())
{
 
 //arshow($ob);
}
 




require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>