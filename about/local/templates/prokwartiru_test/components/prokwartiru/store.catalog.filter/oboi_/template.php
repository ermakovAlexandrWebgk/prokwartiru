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
            //echo CForm::GetDropDownField(
            //    $QUESTION_SID,           // символьный идентификатор вопроса
            //    $arDropDown,             // массив описывающий элементы списка
            //    $value,                  // значение выбранного элемента списка
            //    "class=\"inputselect\""  // стиль выпадающего списка
            //    );            
            ?-->
            <?$PRICE_ID=$_REQUEST['PRICE_ID'];?>
            <select onchange="javascript:document.location=document.location.href+'&PRICE_ID='+this.options[this.selectedIndex].value">
              <option value="" <?if($PRICE_ID==""):?>selected<?endif?> >Все</option>
              <option value="6" <?if($PRICE_ID=="6"):?>selected<?endif?> >до 1000 руб</option>
              <option value="7" <?if($PRICE_ID=="7"):?>selected<?endif?> >1000-1499 руб</option>
              <option value="8" <?if($PRICE_ID=="8"):?>selected<?endif?> >1500-1999 руб</option>
              <option value="9" <?if($PRICE_ID=="9"):?>selected<?endif?> >2000-2999 руб</option>
              <option value="10" <?if($PRICE_ID=="10"):?>selected<?endif?> >свыше 3000 руб</option>
            </select>
        </td>
        <!--td><input type="submit" name="filter" value="Найти" style="background-color: #8e8b86; color: white; border: 0px; height: 22px; padding: 0 3px;"></td-->
    </tr>
</table>
</form>
</div>
<!--? $arFilterDopt=Array('UF_PRICE' => "6");?-->
