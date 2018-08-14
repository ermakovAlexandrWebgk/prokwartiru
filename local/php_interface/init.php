<?
    /************** NEW ****************/

    CModule::includeModule("iblock");
    CModule::includeModule("sale");
    CModule::includeModule("catalog");

    define("WORK_CATALOG_ID", 77); //ID рабочего каталога

    if (file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/config.php")) {
        include_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/config.php");
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/collections_handlers.php")) {
        include_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/collections_handlers.php");
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/addPropertySaleAgent.php")) {
        include_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/include/addPropertySaleAgent.php");
    }

    AddEventHandler("currency", "CurrencyFormat", "myFormat");
    function myFormat($fSum, $strCurrency)
    {
        if ($strCurrency == "RUB") {
            return number_format ( $fSum, 0, '.', ' ' ).' р';
        }
    }

    function compareByName($a, $b){
        return strcmp($a["VALUE"], $b["VALUE"]);
    }

    function arshow($array, $adminCheck = false){
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            }
        }
        echo "<pre>";
        // var_dump($array);
        print_r($array);
        echo "</pre>";
    }
    function logger($data, $file) {
        file_put_contents(
            $file,
            var_export($data, 1)."\n",
            FILE_APPEND
        );
    }
    //Выборка чпу-ссылок из модуля sotbit seo по id раздела
    function GetSeoLinks($sectionId)
    {
        GLOBAL $DB;
        $arSeoLinks = array();
        $dbResult = $DB->Query("SELECT * FROM `b_sotbit_seometa_chpu` WHERE `ACTIVE` = 'Y' AND `section_id`=".intval($sectionId));
        while ($row = $dbResult->Fetch())
        {
            $row["PROPERTIES"] = unserialize($row["PROPERTIES"]);
            $dbSubResults = $DB->Query("SELECT `NAME` FROM `b_sotbit_seometa` WHERE `ID`=".$row["CONDITION_ID"])->Fetch();
            $row["CONDITION"] = $dbSubResults["NAME"];
            $arSeoLinks[] = $row;
        }
        return $arSeoLinks;
    }

    /**
    * метод для получения компаньонов
    *
    * @param integer $ID - ID элемента каталога, для котрого ищем компаньонов
    */
    function GetCompanions($ID) {

        $ID = intval($ID);
        if (empty($ID)) {
            return false;
        }

        $items = array();
        $result = false;

        //ищем элемент инфоблока "компаньоны", в котором текущий товар связан с другими
        $companionBlock = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => "companions", "PROPERTY_ITEMS" => $ID), false, false, array("ID", "PROPERTY_ITEMS", "IBLOCK_ID"));
        while($arCompanion = $companionBlock->Fetch()) {

            //получаем значение свойство "Компаньоны" и собираем ID товаров-компаньонов
            $itemsCompanions = CIBlockElement::GetProperty($arCompanion["IBLOCK_ID"], $arCompanion["ID"], array(), array("CODE" => "ITEMS"));
            while($arItem = $itemsCompanions->Fetch()) {
                //добавляем в конечный результат все товары, кроме текущего
                if ($arItem["VALUE"] != $ID) {
                    $items[$arItem["VALUE"]] = $arItem["VALUE"];
                }
            }
        }

        if (count($items) > 0) {
            $result = $items;
        }

        return $result;

    }

    //Добавление в административном разделе пункта меню "массовое обновление цен"
    AddEventHandler("main", "OnBuildGlobalMenu", "extraMenu");
    function extraMenu(&$adminMenu, &$moduleMenu) {
        $priceMenu = array(
            "parent_menu" => "global_menu_store",
            "section"	=> "price_update",
            "sort"		=> 10,
            "url"		=> "",
            "text"		=> 'Конвертация цен',
            "title"		=> 'Конвертация цен',
            "icon"		=> "iblock_menu_icon_settings",
            "page_icon" => "form_page_icon",
            "items"		=> array()
        );
        $priceMenu["items"][] = array(
            "parent_menu" => "global_menu_store",
            "section" => "price_update",
            "sort" => 10,
            "url" => "price_update.php",
            "text" => 'Массовое обновление цен',
            "title" => 'Массовое обновление цен',
            "icon" => "form_menu_icon",
            "page_icon" => "form_page_icon",
            "items_id" => "price_update",
            "items" => array()
        );
        $priceMenu["items"][] = array(
            "parent_menu" => "global_menu_store",
            "section" => "euro_update",
            "sort" => 10,
            "url" => "euro_update.php",
            "text" => 'Массовое обновление цен в евро',
            "title" => 'Массовое обновление цен в евро',
            "icon" => "form_menu_icon",
            "page_icon" => "form_page_icon",
            "items_id" => "euro_update",
            "items" => array()
        );
        $moduleMenu[] = $priceMenu;
    }

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "setPropertyRooms");

    function setPropertyRooms(&$arFields)  {
        if (empty($arFields["PROPERTY_VALUES"]["COLLECTION_URL"])) {
            if($arFields["IBLOCK_ID"] == WORK_CATALOG_ID && $arFields["ID"] > 0 ){
                $arPictureToRoom = array(
                    "2666"=> array(3379, 3380, 3382, 3385, 3386),
                    "2667"=> array(3379, 3380, 3383, 3385, 3386),
                    "2668"=> array(3380, 3382, 3384, 3385, 3386,3387),
                    "2669"=> array(3379, 3380, 3382, 3384, 3385, 3386,3387),
                    "2670"=> array(3380, 3381, 3383, 3385, 3386,3387),
                    "2671"=> array(3379, 3380, 3381, 3383, 3385,3387),
                    "2672"=> array(3380, 3381, 3383, 3385,3387),
                    "2673"=> array(3380, 3381, 3385,3387),
                    "2674"=> array(3380, 3381, 3385,3387),
                    "2675"=> array(3379, 3380, 3382, 3384,3385,3386,3387),
                    "2676"=> array(3379, 3380, 3381, 3382,3383,3384,3385,3386,3387),
                    "2677"=> array(3379, 3380, 3382,3384,3385,3386,3387),
                    "2678"=> array(3379, 3380, 3382,3384, 3385, 3387),
                    "2679"=> array(3379, 3380, 3381, 3383, 3385, 3387),
                    "2680"=> array(3380, 3381, 3383, 3385, 3387),
                    "2681"=> array(3379, 3380, 3381, 3383, 3385, 3387),
                    "2682"=> array(3380, 3381, 3383, 3384, 3385, 3387),
                    "2683"=> array(3380, 3385, 3386, 3387),
                    "2684"=> array(3380, 3385, 3386,),
                    "2685"=> array(3380, 3384, 3385, 3386, 3387),
                    "2686"=> array(3379, 3380),
                    "2687"=> array(3380, 3386, 3387),
                    "2688"=> array(3379, 3380, 3381,3383, 3385,),
                    "2689"=> array(3380, 3385, 3387),
                    "2690"=> array(3379, 3380, 3381, 3382, 3383, 3384, 3385, 3386, 3387),
                    "2704"=> array(3379, 3384),
                    "2705"=> array(3379, 3384),
                );


                $kitchenAndCoridor = array("3379", "3384");
                $childrenRoom = "3380";

                if(isset($arFields["PROPERTY_VALUES"][959])){
                    $arItemPictureRoom = array();
                    foreach($arFields["PROPERTY_VALUES"][959] as $designId){
                        $arItemPictureRoom[] = $arPictureToRoom[$designId["VALUE"]];    //собираем ID всех свойств типа "рисуок", которые необходимо будет проставить обновляемому элементу
                    }
                }

                if(isset($arFields["PROPERTY_VALUES"][962])){
                    foreach($arFields["PROPERTY_VALUES"][962] as $materialId){          //собираем ID всех свойств типа "материал", которые необходимо будет проставить обновляемому элементу
                        if(!empty($arPictureToRoom[$materialId["VALUE"]])) {
                            $arItemMaterialRoom[] = $arPictureToRoom[$materialId["VALUE"]];
                        }
                    }
                }

                $children = false;
                if(isset($arFields["PROPERTY_VALUES"][963])){
                    foreach($arFields["PROPERTY_VALUES"][963] as $styleId){          //собираем ID всех свойств типа "материал", которые необходимо будет проставить обновляемому элементу
                       if($styleId["VALUE"] == "2872"){
                           $children = true;
                       }
                    }
                }

                if(empty($arFields["PROPERTY_VALUES"][959]) && empty($arFields["PROPERTY_VALUES"][962]) && empty($arFields["PROPERTY_VALUES"][963])){
                    $arSelect = Array("ID", "PROPERTY_DESIGN_OBOI", "PROPERTY_MATERIAL", "PROPERTY_STYLE"); // то же самое для пустого апдейта, только через гет лист.
                    $arFilter = Array("IBLOCK_ID"=>WORK_CATALOG_ID, "ID" => $arFields["ID"]);
                    $propertiesArr = array();
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                    $arr = array();
                    while($ob = $res->Fetch()){
                        if(!empty($ob["PROPERTY_DESIGN_OBOI_ENUM_ID"])){
                            $arr[] = $ob["PROPERTY_DESIGN_OBOI_ENUM_ID"];
                        }
                        if(!empty($ob["PROPERTY_MATERIAL_ENUM_ID"])){
                            $arrMaterial[] = $ob["PROPERTY_MATERIAL_ENUM_ID"];
                        }
                        if(!empty($ob["PROPERTY_STYLE_ENUM_ID"])){
                            if($ob["PROPERTY_STYLE_ENUM_ID"] == "2872") {
                                $children = true;
                            };
                        }
                    }

                    $arItemPictureRoom = array();
                    foreach ($arr as $value){
                        $arItemPictureRoom[] = $arPictureToRoom[$value];
                    }

                    foreach ($arrMaterial as $valueMaterial){
                        if(!empty($arPictureToRoom[$valueMaterial])) {
                            $arItemMaterialRoom[] = $arPictureToRoom[$valueMaterial];
                        }
                    }
                }

                $newArr = array();
                foreach($arItemPictureRoom as $arrPropsId){
                    foreach ($arrPropsId as $propId){
                        if(!in_array($propId,$newArr)){
                            $newArr[] = $propId;
                        }
                    }
                }

                //Отфильтруем по материалу
                if(empty($arItemMaterialRoom)) {
                    foreach($newArr as $arrKey => $arrValue){
                        if(in_array($arrValue, $kitchenAndCoridor)) {
                            unset($newArr[$arrKey]);
                        }
                    }
                }

                //Уберем детские из фильтра, если в стилях нет детских
                if(!$children) {
                    foreach($newArr as $arrKey => $arrValue){
                        if($arrValue == $childrenRoom) {
                            unset($newArr[$arrKey]);

                        }
                    }
                }
                if($children){
                    foreach ($newArr as $arrKey => $arrValue){
                        if ($arrValue != "3380"){
                            unset ($newArr[$arrKey]);
                        }
                    }
                }if ($children == true && empty($newArr)){
                    $newArr[] = '3380';
                }


                $PROPERTY_CODE = "ROOM";
                $PROPERTY_VALUE = $newArr;
                CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array($PROPERTY_CODE => $PROPERTY_VALUE));
                if($children == true){
                $PROP = "FILTER_OBOI";
                $PROPTOP[] = 3327;
                CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array($PROP => $PROPTOP));
                }

            }
        }
    }
AddEventHandler("iblock", "OnAfterIBlockPropertyUpdate", "sortBrandProperties");
    function sortBrandProperties(&$arFields){
        if($arFields["CODE"] == 'BRAND'){
            $sortIndex = 1;
            foreach($arFields["VALUES"] as $propsValues){
                $allPropsArray[] = $propsValues;
            }
                usort($allPropsArray, "compareByName");
                foreach ($allPropsArray as $singleProp){
                    $ibpenum = new CIBlockPropertyEnum;
                        $ibpenum->Update($singleProp["ID"], Array('SORT'=>$sortIndex++));

                }
        }

    }
AddEventHandler("sale", "OnBeforeBasketAdd", "ItemBasketPrise");
function ItemBasketPrise(&$arFields) { // округляем цену товара
    if($arFields["BASE_PRICE"]){
      $arFields["BASE_PRICE"] = round($arFields["BASE_PRICE"]);
    }
    if($arFields["PRICE"]){
        $arFields["PRICE"] = round($arFields["PRICE"]);
    }
}
AddEventHandler("search", "BeforeIndex", "logIndex");
   function logIndex($arFields){
      logger($arFields["ITEM_ID"], $_SERVER['DOCUMENT_ROOT'].'/log.log');
   }
AddEventHandler("catalog", "OnProductAdd", "setElementCount");
function setElementCount($id, $arFields){
        logger($arFields,$_SERVER['DOCUMENT_ROOT'].'/log2.log');
        CCatalogProduct::Update($id, array("QUANTITY" => 1));
}


        
        
                
                
            
   