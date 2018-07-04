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
                        "2000-2499 руб",
                        "свыше 2500 руб"
                    ),

                "reference_id" => array (
                        "",
                        "12",
                        "13",
                        "14",
                        "15",
                        "16"
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
              <option value="12" <?if($PRICE_ID=="12"):?>selected<?endif?> >до 1000 руб</option>
              <option value="13" <?if($PRICE_ID=="13"):?>selected<?endif?> >1000-1499 руб</option>
              <option value="14" <?if($PRICE_ID=="14"):?>selected<?endif?> >1500-1999 руб</option>
              <option value="15" <?if($PRICE_ID=="15"):?>selected<?endif?> >2000-2499 руб</option>
              <option value="16" <?if($PRICE_ID=="16"):?>selected<?endif?> >свыше 2500 руб</option>
            </select>
        </td>
        <td style="padding-left: 10px;">по структуре поверхности:&nbsp;</td>
        <td>
          <?$STRUCTURE_ID=$_REQUEST['STRUCTURE_ID'];?>
            <select onchange="javascript:document.location=document.location.href+'&STRUCTURE_ID='+this.options[this.selectedIndex].value">
              <option value="" <?if($STRUCTURE_ID==""):?>selected<?endif?> >Все</option>
              <option value="17" <?if($STRUCTURE_ID=="17"):?>selected<?endif?> >под дерево</option>
              <option value="18" <?if($STRUCTURE_ID=="18"):?>selected<?endif?> >под камень</option>
              <option value="19" <?if($STRUCTURE_ID=="19"):?>selected<?endif?> >под мрамор</option>
              <option value="27" <?if($STRUCTURE_ID=="27"):?>selected<?endif?> >терракота</option>
              <option value="20" <?if($STRUCTURE_ID=="20"):?>selected<?endif?> >под ткань</option>
              <option value="29" <?if($STRUCTURE_ID=="29"):?>selected<?endif?> >под металл</option>
              <option value="30" <?if($STRUCTURE_ID=="30"):?>selected<?endif?> >под кожу</option>
              <option value="32" <?if($STRUCTURE_ID=="32"):?>selected<?endif?> >под мозаику</option>
              <option value="31" <?if($STRUCTURE_ID=="31"):?>selected<?endif?> >с орнаментом</option>
              <option value="21" <?if($STRUCTURE_ID=="21"):?>selected<?endif?> >без фактуры</option>
              <option value="28" <?if($STRUCTURE_ID=="28"):?>selected<?endif?> >другое</option>
            </select>
        </td>
        <!--td><input type="submit" name="filter" value="Найти" style="background-color: #8e8b86; color: white; border: 0px; height: 22px; padding: 0 3px;"></td-->
    </tr>
</table>
</form>
</div>