<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
/*******************************************
       Редактирование результата
*******************************************/

$RESULT_ID = 12; // ID результата

// если была нажата кнопка "Сохранить" то
if (strlen($_REQUEST["filter"])>0)
{
    // используем данные пришедшие с формы
    $arrVALUES = $_REQUEST; 
}
else
{
    // сформируем этот массив из данных по результату
    $arrVALUES = CFormResult::GetDataByIDForHTML($RESULT_ID); 
}
?>
<form action="" method="get">
<?
foreach($arResult["ITEMS"] as $arItem)
	if(array_key_exists("HIDDEN", $arItem))
		echo $arItem["INPUT"];
?>


<table>
    <tr>
        <td>Диапазон цен:</td>
        <td><?

            // символьный идентификатор вопроса
            $QUESTION_SID = "PRICE"; 

            // массив описывающий элементы выпадающего списка
            $arDropDown = array (

                "reference" => array (
                        "Все",
                        "до 1000 руб",
                        "1000-1499 руб",
                        "1500-1999 руб",
                        "2000-2999 руб",
                        "свыше 3000 руб"
                    ),

                "reference_id" => array (
                        "",
                        "6",
                        "7",
                        "8",
                        "9",
                        "10"
                    ),

                "param" => array (
                        //"not_answer class=\"inputselect\"", // не является ответом
                        "checked", // значение по умолчанию
                        "",
                        "",
                        "",
                        "",
                        ""
                    )
            );

            // получим текущее значение выпадающего списка
            $value = CForm::GetDropDownValue($QUESTION_SID, $arDropDown, $arrVALUES);

            // выведем выпадающий список
            echo CForm::GetDropDownField(
                $QUESTION_SID,           // символьный идентификатор вопроса
                $arDropDown,             // массив описывающий элементы списка
                $value,                  // значение выбранного элемента списка
                "class=\"inputselect\""  // стиль выпадающего списка
                );            
            ?></td>
        <td>
<!--input type="submit" name="filter" value="Подобрать"-->
<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
        </td>
    </tr>
</table>
</form>