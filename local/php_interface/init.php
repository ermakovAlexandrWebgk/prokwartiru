<? 
/************** NEW ****************/

    if (file_exists($_SERVER['DOCUMENT_ROOT']."/local/php_interface/config.php")) {
        include_once($_SERVER['DOCUMENT_ROOT']."/local/php_interface/config.php");
    }

    AddEventHandler("currency", "CurrencyFormat", "myFormat");
    function myFormat($fSum, $strCurrency)
    {
        if ($strCurrency == "RUB") {
            return number_format ( $fSum, 0, '.', ' ' ).' �';
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
?>