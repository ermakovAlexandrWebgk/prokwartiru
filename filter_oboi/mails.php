<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
Cmodule::IncludeModule("iblock");
$arSelect = Array("ID", "PROPERTY_DESIGN_OBOI");
$arFilter = Array("IBLOCK_ID"=>77,"ID"=>374486 );
$propertiesArr = array();
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
$arPictureToRoom = array(
    "2666"=> array(3375,3376,3378,3381,3382),
    "2667"=> array(3375,3376,3379, 3381,3382),
    "2668"=> array(3376,3378,3380,3381,3382,3383),
    "2669"=> array(3375,3376,3378,3380,3381,3382,3383),
    "2670"=> array(3376,3377,3379,3381,3382,3383),
);
$arr = array();
while($ob = $res->Fetch()){
    if(!empty($ob["PROPERTY_DESIGN_OBOI_ENUM_ID"])){
        $arr[] = $ob["PROPERTY_DESIGN_OBOI_ENUM_ID"];

    }
}

$arItemPictureRoom = array();
foreach ($arr as $value){
    $arItemPictureRoom[] = $arPictureToRoom[$value];
}

$newArr = array();
foreach($arItemPictureRoom as $arrPropsId){
    foreach ($arrPropsId as $propId){
        if(!in_array($propId,$newArr)){
            $newArr[] = $propId;
        }
    }
}
arshow($newArr);
?> 