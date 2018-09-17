<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$res = CCatalogDiscount::GetList(array(),array(),false,false,array('SECTION_ID'));                                                            //собираем ID разделов на которые распространяется скидка
while($ob = $res->Fetch()){
  $needSectionId[] = $ob['SECTION_ID'];
}
//arshow($needSectionId);
$saleData = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>77, "PROPERTY_FILTER_OBOI" => 3330), false, false, Array("ID"));              //Собираем ID элементов с свойстом SALE
while($result = $saleData->Fetch()){
                                                                                                                                              //Ставим пустое свойство SALE
 CIBlockElement::SetPropertyValuesEx($result['ID'], false, array('FILTER_OBOI' => ''));
}

$sectionElementIds = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>77, "SECTION_ID" => $needSectionId), false, false, Array("ID")); //Собираем все ID элементов разделов,
while($ids = $sectionElementIds->Fetch()){                                                                                               //на которые распространяется скидка на данный момент

CIBlockElement::SetPropertyValuesEx($ids['ID'], false, array('FILTER_OBOI' => 3330));                                              //Проставляем всем элементам свойство SALE
}
