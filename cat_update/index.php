<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<h1>UPDATE</h1>

<?


// function arshow($array, $adminCheck = false){
//     global $USER;
//     $USER = new Cuser;
//     if ($adminCheck) {
//         if (!$USER->IsAdmin()) {
//             return false;
//         }
//     }
//     echo "<pre><code>";
//     print_r($array);
//     echo "</code></pre>";
// }

?>
<form class="" method="post" id="load_IB">

    <input type="text" name="IBLOCK" value="" placeholder="id инфоблока"><br>
    <input type="text" name="count" value="" placeholder="количество"><br>
    <select name="method">
     <?/*<option value="1"> перенос структуры </option>
        <option value="11"> перенос значений для свойств типа список </option>
        <option value="2"> перенос элементов </option>
        <option value="3"> установить цены </option>
        <option value="4"> получить единицы измерения </option>
        <option value="5"> установить единицы измерения </option>
        <option value="6"> длина ширина плитки </option>
        <option value="12"> тестировать элементы</option>
        <option value="13"> обновить свойство толщина</option>
        <option value="14"> передача свойства фабрика</option>
        <option value="15"> передача свойства ширина обоев</option>
        <option value="16"> пересчет фасетного индекса</option>
		*/?>
        <option value="17"> название</option>
    </select><hr>
    <input type="submit" name="send" value="load">

</form>

<div class="info" id="res_info">

</div>

<script type="text/javascript">
    var kkk = 0;
    $("#load_IB").submit(function( event ) {
        // alert( "Handler for .submit() called." );
        event.preventDefault();
        var s_iblock = parseInt($("input[name='IBLOCK']").val());
        var s_count = parseInt($("input[name='count']").val());
        var s_method = parseInt($("select[name='method']").val());

        send_parse_info(s_iblock,s_count,s_method);
    });

    function send_parse_info(iblock,count,method,last_id = -1, end_parse = false) {

        if (end_parse) {
            console.log('parse_end');
            // console.log('elements', kkk);
        } else {
            $.post("ajax.php", {iblock: iblock, count: count, method: method, last_id: last_id},
                function(data){
                    var res = JSON.parse(data);
                    // console.log(data);
                    // $("#res_info").append($( "p" ).text(res));
                    // $( "p" ).text(res).appendTo($("#res_info"));

                    last_id = res.last_id;
                    end_parse = res.end_parse;
                    // kkk = kkk + parseInt(res.l);
                    method = res.method;
                    console.log(res);

                    if (res.error) {
                        console.log(res.error_text)
                        return false;
                    } else {
                        send_parse_info(iblock,count,method,last_id,end_parse);
                    }

            });
        }
    }
</script>

<?
// CModule::IncludeModule("iblock");
//
// $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>77, "CODE"=>"CML2_BASE_UNIT", "VALUE" => 'кв.м.' ));
// while($enum_fields = $property_enums->GetNext())
// {
//     // echo $enum_fields["ID"]." - ".$enum_fields["VALUE"]."<br>";
//     arshow($enum_fields);
// }

// $db_enum_list = CIBlockProperty::GetPropertyEnum("UNIT", Array(), Array("IBLOCK_ID"=>4));
// if($ar_enum_list = $db_enum_list->GetNext())
// {
//     arshow($ar_enum_list);
// }
//
// $IBLOCK_ID = 10;
// $properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
// while ($prop_fields = $properties->GetNext())
// {
//   // echo $prop_fields["ID"]." - ".$prop_fields["NAME"]."<br>";
//   $proprties[$prop_fields["CODE"]]["old"][] = $prop_fields
//   // arshow($prop_fields);
// }
//
// $IBLOCK_ID = 10;
// $properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
// while ($prop_fields = $properties->GetNext())
// {
//   // echo $prop_fields["ID"]." - ".$prop_fields["NAME"]."<br>";
//   $proprties[$prop_fields["CODE"]]["old"][] = $prop_fields
//   // arshow($prop_fields);
// }
//
// $file = CFile::MakeFileArray(7117);
// arshow($file);

// $full_el = array();
// $IDs = array();
// if (CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")) {
//
//     $arSelect = Array();
//     $arFilter = Array("IBLOCK_ID"=>CATALOG_ID);
//     $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
//     // while($ob = $res->Fetch())
//     if ($ob = $res->GetNextElement())
//     {
//         $arFields = $ob->GetFields();
//         $arProps = $ob->GetProperties();
//
//         $full_el[$arFields["ID"]] = ['fields' => $arFields, 'props' => $arProps];
//         $IDs[] = $arFields["ID"];
//         // arshow($arFields);
//         // echo "-++===++-";
//         // arshow($arProps);
//         // print_r($arFields);
//     }
//
//
//
//     $db_res = CCatalogProduct::GetList(
//         array(),
//         array("ELEMENT_IBLOCK_ID" => CATALOG_ID, "ID" => $IDs),
//         false,
//         array("nTopCount" => 1)
//     );
//     // while (($ar_res = $db_res->Fetch()))
//     if ($ar_res = $db_res->Fetch())
//     {
//         $full_el[$ar_res["ID"]]['cat_param'] = $ar_res;
//         // arshow ($ar_res);
//     }
//
//     arshow($full_el);
//
// }

// $arFilter_section = array(
//     'IBLOCK_ID' => 10,
//     // '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
//     // '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
//     // '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL'],
//      "ACTIVE" => "Y"
// ); // выберет потомков без учета активности
// $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter_section);
// $sections = array();
// while ($arSect = $rsSect->GetNext())
// {
//     $sections[$arSect["ID"]] = $arSect;
// }
// arshow($sections);


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
