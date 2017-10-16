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

<?$SECTION_ID=$_REQUEST['SECTION_ID'];?>
<?$FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>
<?$STYLE_ID=$_REQUEST['STYLE_ID'];?>
<table cellpadding="0"cellspacing="0" border="0">
    <tr>
        <td style="width: 200px;">Подобрать интерьеры по стилям: </td>
        <td>
            <select onchange="javascript:document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&STYLE_ID='+this.options[this.selectedIndex].value" style="min-width:200px;">
              <option value="" <?if($STYLE_ID==""):?>selected<?endif?> >Все стили</option>
              <option value="54" <?if($STYLE_ID=="54"):?>selected<?endif?> >Классический стиль</option>
              <option value="55" <?if($STYLE_ID=="55"):?>selected<?endif?> >Стиль кантри</option>
              <option value="56" <?if($STYLE_ID=="56"):?>selected<?endif?> >Современный стиль</option>
              <option value="57" <?if($STYLE_ID=="57"):?>selected<?endif?> >Хай-тек (минимализм)</option>
              <option value="58" <?if($STYLE_ID=="58"):?>selected<?endif?> >Детский стиль</option>
            </select>
        </td>
   </tr>
</table>
</form>
</div>
