<? 
    /************** NEW ****************/

    CModule::includeModule("iblock");
    CModule::includeModule("sale");
    CModule::includeModule("catalog");

    define("WORK_CATALOG_ID", 77); //ID �������� ��������

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
            return number_format ( $fSum, 0, '.', ' ' ).' �';
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

    //������� ���-������ �� ������ sotbit seo �� id �������
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
    * ����� ��� ��������� �����������
    * 
    * @param integer $ID - ID �������� ��������, ��� ������� ���� �����������
    */
    function GetCompanions($ID) {

        $ID = intval($ID);
        if (empty($ID)) { 
            return false;
        }

        $items = array();
        $result = false;

        //���� ������� ��������� "����������", � ������� ������� ����� ������ � �������
        $companionBlock = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => "companions", "PROPERTY_ITEMS" => $ID), false, false, array("ID", "PROPERTY_ITEMS", "IBLOCK_ID"));
        while($arCompanion = $companionBlock->Fetch()) {

            //�������� �������� �������� "����������" � �������� ID �������-�����������
            $itemsCompanions = CIBlockElement::GetProperty($arCompanion["IBLOCK_ID"], $arCompanion["ID"], array(), array("CODE" => "ITEMS"));
            while($arItem = $itemsCompanions->Fetch()) {
                //��������� � �������� ��������� ��� ������, ����� ��������
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

    //���������� � ���������������� ������� ������ ���� "�������� ���������� ���"
    AddEventHandler("main", "OnBuildGlobalMenu", "extraMenu");
    function extraMenu(&$adminMenu, &$moduleMenu) {

        //�������� �������� ������� � "accordpost"
        $moduleMenu[] = array(
            "parent_menu" => "global_menu_store",
            "section" => "price_update",
            "sort" => 10,
            "url" => "price_update.php",
            "text" => '�������� ���������� ���',
            "title" => '�������� ���������� ���',
            "icon" => "form_menu_icon",
            "page_icon" => "form_page_icon",
            "items_id" => "price_update",
            "items" => array()
        );
    }
     AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "setPropertyRooms");
    function setPropertyRooms(&$arFields)
    {

       // $arSelect = Array("ID", "IBLOCK_ID"); // �� �� ����� ��� ������� �������, ������ ����� ��� ����.
        $arFilter = Array("ID" => $arFields["ID"]);
        $itemInfo = CIBlockElement::GetByID($arFields["ID"]);
        $arItem = $itemInfo->Fetch();
        if($arItem["IBLOCK_ID"] == WORK_CATALOG_ID && $arFields["ID"] > 0 ){ 
           
       
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
            if(isset($arFields["PROPERTY_VALUES"][959])){ 

                $arItemPictureRoom = array();
                foreach($arFields["PROPERTY_VALUES"][959] as $designId){
                    $arItemPictureRoom[] = $arPictureToRoom[$designId["VALUE"]]; //�������� ID ���� ������� ���� "������", ������� ���������� ����� ���������� ������������ ��������

                }
            }
            if(isset($arFields["PROPERTY_VALUES"][962])){

                foreach($arFields["PROPERTY_VALUES"][962] as $materialId){    //�������� ID ���� ������� ���� "��������", ������� ���������� ����� ���������� ������������ ��������
                    $arItemPictureRoom[] = $arPictureToRoom[$materialId["VALUE"]];

                }


            }
            if(empty($arFields["PROPERTY_VALUES"][959]) && empty($arFields["PROPERTY_VALUES"][962])){
                $arSelect = Array("ID", "PROPERTY_DESIGN_OBOI", "PROPERTY_MATERIAL"); // �� �� ����� ��� ������� �������, ������ ����� ��� ����.
                $arFilter = Array("IBLOCK_ID"=>WORK_CATALOG_ID, "ID" => $arFields["ID"]);
                $propertiesArr = array();
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                $arr = array();
                while($ob = $res->Fetch()){
                    if(!empty($ob["PROPERTY_DESIGN_OBOI_ENUM_ID"])){
                        $arr[] = $ob["PROPERTY_DESIGN_OBOI_ENUM_ID"];


                    }
                    if(!empty($ob["PROPERTY_MATERIAL_ENUM_ID"])){
                        $arr[] = $ob["PROPERTY_MATERIAL_ENUM_ID"];
                    }
                }

                $arItemPictureRoom = array();
                foreach ($arr as $value){
                    $arItemPictureRoom[] = $arPictureToRoom[$value];
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
           
            $PROPERTY_CODE = "ROOM"; 
            $PROPERTY_VALUE = $newArr; 
            CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array($PROPERTY_CODE => $PROPERTY_VALUE));

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
?>
