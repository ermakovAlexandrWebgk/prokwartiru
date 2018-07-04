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
<?$PRICE_ID=$_REQUEST['PRICE_ID'];?>
<?$WIDTH_ID=$_REQUEST['WIDTH_ID'];?>
<!--?$NEW=$_REQUEST['NEW'];?-->
<!--?$HIT=$_REQUEST['HIT'];?-->
<?$TYPE=$_REQUEST['TYPE'];?>
<table cellpadding="0"cellspacing="0" border="0">
    <tr>
        <td><p>Подобрать обои</p></td>
        <td>
            <select onchange="javascript:document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&PRICE_ID='+this.options[this.selectedIndex].value+'&WIDTH_ID=<?=$WIDTH_ID?>'+'&TYPE=<?=$TYPE?>'">
              <option value="" <?if($PRICE_ID==""):?>selected<?endif?> >Все по цене</option>
              <option value="6" <?if($PRICE_ID=="6"):?>selected<?endif?> >до 1000 руб</option>
              <option value="7" <?if($PRICE_ID=="7"):?>selected<?endif?> >1000-1499 руб</option>
              <option value="8" <?if($PRICE_ID=="8"):?>selected<?endif?> >1500-1999 руб</option>
              <option value="9" <?if($PRICE_ID=="9"):?>selected<?endif?> >2000-2999 руб</option>
              <option value="10" <?if($PRICE_ID=="10"):?>selected<?endif?> >свыше 3000 руб</option>
            </select>
        </td>
        <td>
            <select onchange="javascript:document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&PRICE_ID=<?=$PRICE_ID?>'+'&WIDTH_ID='+this.options[this.selectedIndex].value+'&TYPE=<?=$TYPE?>'">
              <option value="" <?if($WIDTH_ID==""):?>selected<?endif?> >Все по ширине</option>
              <option value="33" <?if($WIDTH_ID=="33"):?>selected<?endif?> >0,53 м</option>
              <option value="34" <?if($WIDTH_ID=="34"):?>selected<?endif?> >0,68 м</option>
              <option value="35" <?if($WIDTH_ID=="35"):?>selected<?endif?> >0,70 м</option>
              <option value="36" <?if($WIDTH_ID=="36"):?>selected<?endif?> >1,00 м</option>
              <option value="37" <?if($WIDTH_ID=="37"):?>selected<?endif?> >1,06 м</option>
            </select>
        </td>
        <td>
            <div class="box"><div style="width: 15px; padding-top: 0px; float: right;"><input type="checkbox" name="new" value="new" <?if($TYPE=="new"):?>checked<?endif?> onchange="javascript:{document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&PRICE_ID=<?=$PRICE_ID?>'+'&WIDTH_ID=<?=$WIDTH_ID?>'+'&TYPE=<?if($TYPE!="new"):?>new<?endif?>';}"></div><div style="width: 100px;"><p>Только новинки</p></div></div>
        </td>
        <td>
            <div class="box"><div style="width: 15px; padding-top: 0px; float: right;"><input type="checkbox" name="hit" value="hit" <?if($TYPE=="hit"):?>checked<?endif?> onchange="javascript:{document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&PRICE_ID=<?=$PRICE_ID?>'+'&WIDTH_ID=<?=$WIDTH_ID?>'+'&TYPE=<?if($TYPE!="hit"):?>hit<?endif?>';}"></div><div style="width: 100px;"><p>Лидеры продаж</p></div></div>
        </td>
        <!--td>
            <div class="box"><div style="width: 15px; padding-top: 0px; float: right;"><input type="checkbox" name="new" value="new" <-?if($NEW=="new"):?->checked<-?endif?-> onchange="javascript:{document.location=document.location.pathname+'?SECTION_ID=<-?=$SECTION_ID?->'+'&PRICE_ID=<-?=$PRICE_ID?->'+'&WIDTH_ID=<-?=$WIDTH_ID?->'+'&NEW='+<-?if($NEW!="new"):?->'new'+<-?endif?->'&HIT=<-?=$HIT?->';}"></div><div style="width: 100px;"><p>Только новинки</p></div></div>
        </td-->
        <!--td>
            <div class="box"><div style="width: 15px; padding-top: 0px; float: right;"><input type="checkbox" name="hit" value="hit" <-?if($HIT=="hit"):?->checked<-?endif?-> onchange="javascript:{document.location=document.location.pathname+'?SECTION_ID=<-?=$SECTION_ID?->'+'&PRICE_ID=<-?=$PRICE_ID?->'+'&WIDTH_ID=<-?=$WIDTH_ID?->'+'&NEW=<-?=$NEW?->'+'&HIT=<-?if($HIT!="hit"):?->hit<-?endif?->';}"></div><div style="width: 100px;"><p>Лидеры продаж</p></div></div>
        </td-->
    </tr>
</table>
</form>
</div>
