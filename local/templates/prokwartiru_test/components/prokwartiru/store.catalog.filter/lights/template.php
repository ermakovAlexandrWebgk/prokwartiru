<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="filter">
<?
/*******************************************
       Редактирование результата
*******************************************/
// подключим модуль
CModule::IncludeModule("form");

//$RESULT_ID = 12; // ID результата

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
        <td>Подобрать по цене:&nbsp;</td>
        <td><!--?

            // символьный идентификатор вопроса
            $QUESTION_SID = "PRICE"; 

            // массив описывающий элементы выпадающего списка
            $arDropDown = array (

                "reference" => array (
                        "Все",
                        "до 3000 руб",
                        "3000-5000 руб",
                        "5000-10000 руб",
                        "10000-15000 руб",
                        "свыше 15000 руб"
                    ),

                "reference_id" => array (
                        "",
                        "1",
                        "2",
                        "3",
                        "4",
                        "5"
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
            ?-->
            <?$PRICE_ID=$_REQUEST['PRICE_ID'];?>
            <select onchange="javascript:document.location=document.location.href+'&PRICE_ID='+this.options[this.selectedIndex].value">
              <option value="" <?if($PRICE_ID==""):?>selected<?endif?> >Все</option>
              <option value="1" <?if($PRICE_ID=="1"):?>selected<?endif?> >до 3000 руб</option>
              <option value="2" <?if($PRICE_ID=="2"):?>selected<?endif?> >3000-5000 руб</option>
              <option value="3" <?if($PRICE_ID=="3"):?>selected<?endif?> >5000-10000 руб</option>
              <option value="4" <?if($PRICE_ID=="4"):?>selected<?endif?> >10000-15000 руб</option>
              <option value="5" <?if($PRICE_ID=="5"):?>selected<?endif?> >свыше 15000 руб</option>
            </select>
        </td>
        <!--td><input type="submit" name="filter" value="Подобрать"></td-->
    </tr>
</table>
</form>
</div>