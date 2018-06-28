<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');   
global $DB;

    $eurFilter = array(
        "CURRENCY" => "EUR"
    );
    $by = "date";
    $order = "desc";
    if(CModule::IncludeModule("currency")){
        $db_rate = CCurrencyRates::GetList($by, $order, $eurFilter);
        if($ar_rate = $db_rate->Fetch())
        {
            $ye=$ar_rate["RATE"];
            echo("<p style='color:green;'><b>Курс евро: €1=".$ye." руб</b></p>");
        }
    }

    $section = CIBlockSection::GetList(
        array("SORT"=>"ASC"),
        Array("IBLOCK_ID" => 77, "DEPTH_LEVEL" => 1),
        false,
        Array("ID", "NAME"),
        false
    );?>


<form method="POST">
<?=bitrix_sessid_post()?>
<?$selected = in_array($sect["ID"], $_REQUEST["SECTIONS"]);?>
    <select multiple="multiple" size="10" name="SECTIONS[]"> 
        <?while($sect = $section->Fetch()){?>
            <option value="<?=$sect["ID"]?>" <?if ($selected){?>selected="selected"<?}?>><?=$sect["NAME"]?></option>
            <?}?>
    </select>
<input type="submit" value="Обновить">

<? if(!empty($_POST["SECTIONS"]) && intval($_POST["SECTIONS"]) > 0){
        CModule::IncludeModule('iblock');
        $arSelect = Array("ID", "SECTION_ID");
        $arFilter = Array("IBLOCK_ID"=>77,"INCLUDE_SUBSECTIONS"=>"Y", "SECTION_ID" => $_POST["SECTIONS"]);
        $result = CIBlockElement::GetList(Array(), $arFilter, false, false, Array("ID"));
        while($ob = $result->Fetch())
        {
            $arrId[] =  $ob["ID"];
        }
        if(!empty($arrId)){
            $stringIds = implode(',', $arrId);
            $query = 'select `PRODUCT_ID`, `PRICE` FROM `b_catalog_price` where `CATALOG_GROUP_ID` = 4 and `PRODUCT_ID` in ('.$stringIds.')';
            $res = $DB->query($query);


            while($arRes = $res->Fetch()){
                $price = $arRes['PRICE'] * $ye;
                $newQuery = 'UPDATE `b_catalog_price` set `PRICE` = '.$price.' WHERE `PRODUCT_ID` = '.$arRes['PRODUCT_ID'].' and `CATALOG_GROUP_ID` = 5';
                if($DB->query($newQuery)){
                    $i++;
                }
            }
        }
        if ($i > 0){
            echo $i.' элементов обновлено';
        }else{
            echo 'В данном разделе не найден ни один элемент с ценой в евро';
        }
    }

?> 