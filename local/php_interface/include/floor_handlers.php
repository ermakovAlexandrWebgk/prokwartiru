<?   
    AddEventHandler("iblock", "OnAfterIblockElementUpdate", array("floorHandlers", "setPackPriceEx"));          

    //обработчики для обновления основной цены ламината 
    AddEventHandler("catalog", "OnBeforePriceUpdate", array("floorHandlers", "setPackPrice"));
    AddEventHandler("catalog", "OnPriceAdd", array("floorHandlers", "setPackPrice"));

    class floorHandlers {  

        //функция установки цены за упаковку для ламината
        function setPackPriceEx(&$arFields) {

            if (empty($arFields["ID"])) {
                return;
            }    

            //проверяем наличие цены за метр у товара
            $meterPriceID = self::getPriceIdByCode("METER_PRICE");
            $itemMeterPrice = CPrice::GetList(array(), array("PRODUCT_ID" => $arFields["ID"], "CATALOG_GROUP_ID" => $meterPriceID)) -> Fetch();  
            if ($itemMeterPrice) {
                //запускаем обновление основной цены
                $priceArray = array(
                    "PRICE" => $itemMeterPrice["PRICE"],
                    "PRODUCT_ID" => $arFields["ID"],
                );  
                
                self::setPackPrice($ID, $priceArray);     
            }

        }                  

        //функция обновления основной цены ламината при изменении цены за метр
        function setPackPrice($ID, $arFields) {
            $meterPriceID = self::getPriceIdByCode("METER_PRICE");
            //если изменяемая цена - цена за метр, нужно у данного товара обновить основную цену
            if ($arFields["CATALOG_GROUP_ID"] == $meterPriceID && $arFields["PRICE"] > 0 && !empty($arFields["PRODUCT_ID"])) {

                //получаем размер упаковки в квадратных метрах
                $arItem = CIBlockElement::GetList(array(), array("ID" => $arFields["PRODUCT_ID"]), false, false, array("PROPERTY_UPAK_KBM"))->Fetch();
                //рассчитываем цену за упаковку
                $arItem["PROPERTY_UPAK_KBM_VALUE"] = str_replace(",", ".", $arItem["PROPERTY_UPAK_KBM_VALUE"]);
                $meterPrice = $arFields["PRICE"];
                $packPrice = $meterPrice * $arItem["PROPERTY_UPAK_KBM_VALUE"];

                //проверяем наличие у данного товара обычной цены
                $basePriceID = self::getPriceIdByCode("SALE");
                $arBasePrice = CPrice::GetList(array(), array("PRODUCT_ID" => $arFields["PRODUCT_ID"], "CATALOG_GROUP_ID" => $basePriceID)) -> Fetch();

                if ($packPrice) {
                    $packPriceData = array(
                        "PRICE" => round($packPrice), 
                        "CATALOG_GROUP_ID" => $basePriceID, 
                        "PRODUCT_ID" => $arFields["PRODUCT_ID"], 
                        "CURRENCY" => "RUB"
                    );

                    //если цена за упаковку есть - обновляем ее
                    if ($arBasePrice["ID"]) {
                        CPrice::Update($arBasePrice["ID"], $packPriceData);    
                    } else {//иначе - добавляем
                        CPrice::Add($packPriceData);
                    }     
                }   
            }    

        }

        //получаем ID цены по коду
        function getPriceIdByCode($priceCode){
            if (empty($priceCode)) {
                return false;
            }
            $priceInfo = CCatalogGroup::GetList(array(), array("NAME" => $priceCode))->Fetch();
            return $priceInfo["ID"];    
        } 


}