<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ѕродажна€ наценка 20% на все товары ");?><?
if(CModule::IncludeModule("iblock")) 

{ 
    echo "—крипт запущен...<br>"; 
    // ¬ыведем коды 10 товаров с самым большим количеством на складе 
    // из тех, количество которых при заказе должно уменьшатьс€ 

  $ind = 0; 
    $db_res = CCatalogProduct::GetList( 
            array("ID" => "ASC"), 
            array("IBLOCK_TYPE" => "xmlcatalog"), 
            false, 
            false 
        ); 

    $ind=0; 
    while (($ar_res = $db_res->Fetch()) && ($ind < 15000)) 
    { 
            /*$arFields_quant = Array ( 
                "ID" => $ar_res["ID"], 
                "QUANTITY" => "1000", 
                "WEIGHT" => "2" 
            );*/ 
            $arFields = Array( 
                "PRODUCT_ID" =>$ar_res["ID"], 
                "CATALOG_GROUP_ID" => 2, 
                "EXTRA_ID" => 3, 
                "CURRENCY" => "RUB", 
            );         


            $res = CPrice::GetList( 
                    array(), 
                    array( 
                            "PRODUCT_ID" => $ar_res["ID"], 
                            "CATALOG_GROUP_ID" => "2" 
                        ) 
                ); 
            if ($arr = $res->Fetch()) 
            { 
                CPrice::Update($arr['ID'], $arFields); 
                print "»зменили параметры дл€ товара ".$ar_res["ID"]." ".$arr['ID']."<br>"; 
            } 
            else 
            { 
                CPrice::Add($arFields); 
                print "ƒобавили новые параметры дл€ товара ".$ar_res["ID"]." ".$ar_res["CATALOG_GROUP_ID"]." ".$ar_res["EXTRA_ID"]."<br>"; 
            }                         
        $ind++; 
    } 

}?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>