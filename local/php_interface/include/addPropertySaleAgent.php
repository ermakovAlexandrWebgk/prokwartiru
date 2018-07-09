<?
function AddPropertySaleAgent()
  {
    CModule::IncludeModule("iblock");
    $res = CCatalogDiscount::GetList(array(),array(),false,false,array('SECTION_ID'));                                                            //собираем ID разделов на которые распространяется скидка
    while($ob = $res->Fetch()){
      $needSectionId[] = $ob['SECTION_ID'];
    }
    $saleData = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>WORK_CATALOG_ID, "PROPERTY_FILTER_OBOI" => 3330), false, false, Array("ID", 'ACTIVE'));              //Собираем ID элементов с свойстом SALE
    while($result = $saleData->Fetch()){                                                                                                                                                  //Ставим пустое свойство SALE
       CIBlockElement::SetPropertyValuesEx($result['ID'], false, array('FILTER_OBOI' => ''));
       $step1 = new CIBlockElement;
       $result1 = $step1->Update($result['ID'], array('ACTIVE'=>$result['ACTIVE']));
       \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(WORK_CATALOG_ID, $result['ID']);
    }

  $sectionElementIds = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>WORK_CATALOG_ID, "SECTION_ID" => $needSectionId), false, false, Array("ID", "ACTIVE")); //Собираем все ID элементов разделов,
  while($ids = $sectionElementIds->Fetch()){                                                                                                        //на которые распространяется скидка на данный момент
        CIBlockElement::SetPropertyValuesEx($ids['ID'], false, array('FILTER_OBOI' => 3330));           //Проставляем всем элементам свойство SALE,
        $step2 = new CIBlockElement;                                                                    //пересчитываем фасетный индекс, делаем апдейт текущей активностью, сбрасываем кеш в разделе
        $result2 = $step2->Update($ids['ID'], array('ACTIVE'=> $ids['ACTIVE']));
        \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(WORK_CATALOG_ID, $ids['ID']);
        BXClearCache(true, "/catalog/oboi/sale/");
  }
  return "AddPropertySaleAgent();";
}

?>
