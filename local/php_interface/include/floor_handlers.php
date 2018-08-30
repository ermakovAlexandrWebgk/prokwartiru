<?

    AddEventHandler("sale", "OnBeforeBasketAdd", array("floorHandlers", "changeBasketPrice"));

    class floorHandlers {      

        function changeBasketPrice(&$arFields) {
            $price = CCatalogProduct::GetOptimalPrice($arFields["PRODUCT_ID"], $arFields["QUANTITY"]);
            $arResultPrice = $price["RESULT_PRICE"];
            $itemBasePrice = $arResultPrice["DISCOUNT_PRICE"]; //текущая цена за метр квадратный

            //получаем товар, чтобы рассчитать стоимость упаковки
            $arItem = CIBlockElement::getList(array(), array("ID" => $arFields["PRODUCT_ID"]), false, false, array("PROPERTY_UPAK_KBM"))->Fetch(); 
            if ($arItem["PROPERTY_UPAK_KBM_VALUE"] && $itemBasePrice) {
                $itemTotalPrice = $itemBasePrice * $arFields["QUANTITY"] * $arItem["PROPERTY_UPAK_KBM_VALUE"];
                if ($itemTotalPrice) {
                    $arFields["PRICE"] = $itemTotalPrice;
                    $arFields["CUSTOM_PRICE"] = "Y";  
                }
                return $arFields;
            }


        }


}