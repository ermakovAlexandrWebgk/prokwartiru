<?      
    require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');   

    IncludeModuleLangFile(__FILE__);
    CModule::IncludeModule('sale');
    CModule::IncludeModule('catalog');

    global $USER;
    global $APPLICATION;   

    //ID каталога
    $iblockId = 77;   


    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php"); // 
    $APPLICATION->SetTitle("Массовое обновление цен");  

    $sectionTreeList = array();
    $sectionData = array();
    $rsSections = CIBlockSection::GetList(Array("left_margin"=>"asc"), array("IBLOCK_ID" => $iblockId, "ELEMENT_SUBSECTIONS" => "N"), true);
    while($arSection = $rsSections->Fetch()) {
        $sectionData[$arSection["ID"]] = $arSection;
        $sectionTreeList[] = $arSection;        
    }


    //список типов цен
    $priceTypes = array();
    $price = CCatalogGroup::GetList();
    while ($arPrice = $price->Fetch()) {
        $priceTypes[$arPrice["ID"]] = $arPrice;   
    }

    //если отправлена форма
    if ($_REQUEST["UPDATE_PRICES"] == "Y" && check_bitrix_sessid()) {

        $sections = $_REQUEST["SECTIONS"];
        $priceId = intval($_REQUEST["PRICE_ID"]);

        $error = false;

        //массив цен для обновления (начальная => конечная)
        $priceList = array();


        if (empty($_REQUEST["SECTIONS"])) {
            $error .= "Не выбран ни один раздел!<br>";    
        }

        foreach ($_REQUEST["PRICE_FROM"] as $n => $price) {
            if (!empty($price)) {
                if (empty($_REQUEST["PRICE_TO"][$n])) {
                    $error .= "Не указана конечная цена №" . $n . ". Данная цена не будет обновлена<br>";   
                }
            } else {
                if (!empty($_REQUEST["PRICE_TO"][$n])) {
                    $error .= "Не указана начальная цена №" . $n . ". Данная цена не будет обновлена<br>";   
                } 
            }

            if (floatval($price) > 0 && floatval($_REQUEST["PRICE_TO"][$n]) > 0) {
                $priceList[$price] = floatval($_REQUEST["PRICE_TO"][$n]);
            } 
        } 

        if (empty($priceList)) {
            $error .= "Не указаны цены!<br>";    
        }   


        if (is_array($sections) 
            && !empty($sections) 
            && $priceId 
            && !$error 
            && is_array($priceList)
            && !empty($priceList)
        ) {

            //собираем ID товаров для обновления
            $itemList = array();
            $itemsId = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $iblockId, "SECTION_ID" => $sections), false, false, array("ID", "NAME"));
            while ($arItem = $itemsId->Fetch()) {
                $itemList[$arItem["ID"]] = $arItem;    
            }

            //массив с результатами
            $result = array();

            $pricesForUpdate = array();
            $itemPrices = CPrice::getList(array(), array("PRODUCT_ID" => array_keys($itemList), "CATALOG_GROUP_ID" => $priceId));
            if ($itemPrices->SelectedRowsCount() == 0) {
                $error .= "В указанных разделах не найдено ни одного товара с типом цены - " . $priceTypes[$priceId]["NAME_LANG"];   
            }
            
            while ($arPrice = $itemPrices->Fetch()) {
                $price = floatval($arPrice["PRICE"]);
                if ($priceList[$price]) {
                    $arFields = array(
                        "PRODUCT_ID" => $arPrice["PRODUCT_ID"],
                        "CATALOG_GROUP_ID" => $arPrice["CATALOG_GROUP_ID"],
                        "PRICE" => $priceList[$price],
                        "CURRENCY" => $arPrice["CURRENCY"],    
                    );

                    if (CPrice::Update($arPrice["ID"], $arFields)) {  
                        $result[] = array(
                            "ID" => $arPrice["PRODUCT_ID"],
                            "NAME" => $itemList[$arPrice["PRODUCT_ID"]]["NAME"],
                            "PRICE_FROM" => $price,
                            "PRICE_TO" => $priceList[$price]
                        ); 
                    } 

                }  
            } 
            
            if($itemPrices->SelectedRowsCount() != 0 && count($result) == 0) {
                $error .= "В выбранных разделах не найдено ни одного товара с указанными ценами: " . implode(", ", array_keys($priceList));
            }
        }

        if ($error) {?>
        <p style="color: red">Ошибка: <br><?=$error?></p>    
        <?}

    }


?>

<p>Выберите раздел. В скобках указано количество элементов в разделе</p>
<form method="POST">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="UPDATE_PRICES" value="Y">
    <p>
        <select multiple="multiple" size="10" name="SECTIONS[]"> 
            <?foreach ($sectionTreeList as $section) {
                    $preName = "";
                    if ($section["DEPTH_LEVEL"] == 2) {
                        $preName .= $sectionData[$section["IBLOCK_SECTION_ID"]]["NAME"] ." - ";    
                    }

                    if ($section["DEPTH_LEVEL"] == 3) {
                        $parentSection = $sectionData[$section["IBLOCK_SECTION_ID"]];
                        $preName .= $sectionData[$parentSection["IBLOCK_SECTION_ID"]]["NAME"] ." - ";    
                        $preName .= $sectionData[$section["IBLOCK_SECTION_ID"]]["NAME"] ." - ";    
                    }

                    $cnt = $section["ELEMENT_CNT"];
                    $selected = in_array($section["ID"], $_REQUEST["SECTIONS"]);

                ?>
                <option value="<?=$section["ID"]?>" <?if (!$cnt) {?> disabled="disabled"<?}?> <?if ($selected){?>selected="selected"<?}?>><?=$preName . $section["NAME"]?><?if ($section["ELEMENT_CNT"]) {?> (<?=$section["ELEMENT_CNT"]?>)<?}?></option>
                <?}?>
        </select>
    </p>

    <p>Тип цены:
        <select name="PRICE_ID">
            <?foreach ($priceTypes as $type) {?>
                <option value="<?=$type["ID"]?>" <?if ($type["ID"] == intval($_REQUEST["PRICE_ID"])) {?>selected="selected"<?}?>><?=$type['NAME_LANG']?></option>
                <?}?>
        </select>
    </p>

    <p>
        <table>
            <tr>
                <th></th>
                <th>Старая цена</th>
                <th></th>
                <th>Новая цена</th>
            </tr>
            <tr>
                <th>1</th>
                <td><input name="PRICE_FROM[1]" type="text" value="<? if (floatval($_REQUEST["PRICE_FROM"][1]) != 0) echo floatval($_REQUEST["PRICE_FROM"][1])?>"></td>
                <th>=></th>
                <td><input name="PRICE_TO[1]" type="text" value="<? if (floatval($_REQUEST["PRICE_TO"][1]) != 0) echo floatval($_REQUEST["PRICE_TO"][1])?>"></td>
            </tr>
            <tr>
                <th>2</th>
                <td><input name="PRICE_FROM[2]" type="text" value="<? if (floatval($_REQUEST["PRICE_FROM"][2]) != 0) echo floatval($_REQUEST["PRICE_FROM"][2])?>"></td>
                <th>=></th>
                <td><input name="PRICE_TO[2]" type="text" value="<? if (floatval($_REQUEST["PRICE_TO"][2]) != 0) echo floatval($_REQUEST["PRICE_TO"][2])?>"></td>
            </tr>
            <tr>
                <th>3</th>
                <td><input name="PRICE_FROM[3]" type="text" value="<? if (floatval($_REQUEST["PRICE_FROM"][3]) != 0) echo floatval($_REQUEST["PRICE_FROM"][3])?>"></td>
                <th>=></th>
                <td><input name="PRICE_TO[3]" type="text" value="<? if (floatval($_REQUEST["PRICE_TO"][3]) != 0) echo floatval($_REQUEST["PRICE_TO"][3])?>"></td>
            </tr>
        </table>
    </p>
    <p>
        <input type="submit" value="Обновить">
    </p>

</form>

<?if (!empty($result)) {?>
    <p>

        <table class="adm-list-table">
            <tr class="adm-list-table-header">
                <td colspan="5" class="adm-list-table-cell">
                    <div class="adm-list-table-cell-inner">
                        Обработано товаров: <?=count($result)?>
                    </div>
                </td>
            </tr>
            <tr class="adm-list-table-header">
                <td class="adm-list-table-cell">
                    <div class="adm-list-table-cell-inner">#</div>
                </td>
                <td class="adm-list-table-cell">
                    <div class="adm-list-table-cell-inner">ID</div>
                </td>
                <td class="adm-list-table-cell">
                    <div class="adm-list-table-cell-inner">Артикул</div>
                </td>
                <td class="adm-list-table-cell">
                    <div class="adm-list-table-cell-inner">Старая цена</div>
                </td>
                <td class="adm-list-table-cell">
                    <div class="adm-list-table-cell-inner">Новая цена</div>
                </td>
            </tr>
            <?foreach ($result as $i => $item) {?>
                <tr class="adm-list-table-row">
                    <td class="adm-list-table-cell"><?=($i + 1)?></td>
                    <td class="adm-list-table-cell"><?=$item["ID"]?></td>
                    <td class="adm-list-table-cell"><?=$item["NAME"]?></td>
                    <td class="adm-list-table-cell"><?=$item["PRICE_FROM"]?></td>
                    <td class="adm-list-table-cell"><?=$item["PRICE_TO"]?></td>
                </tr>    
                <?}?>
        </table>
    </p>    
    <?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>
    
    