<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$elementId = intval($_POST['elementID']);
$countElements = intval($_POST['elementCount']);
if($elementId > 0 && $countElements > 0){
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>77, "ID" =>$elementId), false, false, Array("ID", "PROPERTY_UPAK_KBM"));
        while($ob = $res->Fetch()){
            $number = str_replace(',', '.', $ob['PROPERTY_UPAK_KBM_VALUE']);
            $result = floatval($number);
        }
$propM2 = round($result * $countElements, 2);
    if($propM2 > 0){
      echo 'Количество квадратных метров: '.$propM2.'м2';
    }else{
        echo 'error';
    }
}
?>