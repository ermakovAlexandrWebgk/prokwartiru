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
<?$IBLOCK_ID=9;?>
<div style="width:140px; float:left;">Выберите стиль:</div>
<? $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>9, "CODE"=>"STYLE"));

  while($enum_fields = $property_enums->GetNext()) {
        $StyleID = $enum_fields["ID"];
        $StyleName = $enum_fields["VALUE"];
        //echo($StyleID);
?>
<div style="float:left; margin-right:20px;"><input type="checkbox" name="style_<?=$StyleID?>" value="<?=$StyleID?>" <?if($STYLE_ID==$StyleID):?>checked<?endif?> onclick="javascript:{document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&FABRIKA_ID=<?=$FABRIKA_ID?>'+'&STYLE_ID=<?=$StyleID?>';}"  style="margin-right:3px;"><?=$StyleName?></div>
<?
  }
?>
<div><input type="checkbox" name="style_all" value="" <?if($STYLE_ID==""):?>checked<?endif?> onclick="javascript:{document.location=document.location.pathname+'?SECTION_ID=<?=$SECTION_ID?>'+'&FABRIKA_ID=<?=$FABRIKA_ID?>';}"  style="margin-right:3px;">все</div>

</form>
</div>
