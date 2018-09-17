<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>77), false, false, Array("ID", "PROPERTY_UPAK_KBM"));
while($ob = $res->Fetch())
{
$res = $ob['PROPERTY_UPAK_KBM_VALUE'];
}
echo $res;
?> 