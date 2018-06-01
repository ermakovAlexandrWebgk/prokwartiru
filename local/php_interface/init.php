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

    AddEventHandler("currency", "CurrencyFormat", "myFormat");
    function myFormat($fSum, $strCurrency)
    {
        if ($strCurrency == "RUB") {
            return number_format ( $fSum, 0, '.', ' ' ).' р';
        }
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

        //страница экспорта заказов в "accordpost"
        $moduleMenu[] = array(
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
    } 

   
?>