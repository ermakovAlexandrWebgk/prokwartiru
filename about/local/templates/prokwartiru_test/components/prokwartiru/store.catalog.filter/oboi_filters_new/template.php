<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$SECTION_ID=$_REQUEST['SECTION_ID'];?><?if(!$SECTION_ID) $SECTION_ID=1;?>
<?$FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>
<?$COLOR_ID=$_REQUEST['COLOR_ID'];?>
<?$DESIGN_ID=$_REQUEST['DESIGN_ID'];?>
<?$PRICE_ID=$_REQUEST['PRICE_ID'];?>
<?$WIDTH_ID=$_REQUEST['WIDTH_ID'];?>
<?$TYPE=$_REQUEST['TYPE'];?>
<?$NEW=$_REQUEST['NEW'];?>
<?$HIT=$_REQUEST['HIT'];?>
<?$DISCOUNT=$_REQUEST['DISCOUNT'];?>
<?$INSTOCK=$_REQUEST['INSTOCK'];;?>

<script type="text/javascript">
    COLOR_ID=''; <?if($COLOR_ID):?>COLOR_ID=<?=$_REQUEST["COLOR_ID"]?>;<?endif?>
    DESIGN_ID=''; <?if($DESIGN_ID):?>DESIGN_ID=<?=$_REQUEST["DESIGN_ID"]?>;<?endif?>
    PRICE_ID=''; <?if($PRICE_ID):?>PRICE_ID=<?=$_REQUEST["PRICE_ID"]?>;<?endif?>
    WIDTH_ID=''; <?if($WIDTH_ID):?>WIDTH_ID=<?=$_REQUEST["WIDTH_ID"]?>;<?endif?>
    TYPE=''; <?if($TYPE):?>TYPE=<?=$_REQUEST["TYPE"]?>;<?endif?>
    NEW=''; <?if($NEW):?>NEW=<?=$_REQUEST["NEW"]?>;<?endif?>
    HIT=''; <?if($HIT):?>HIT=<?=$_REQUEST["HIT"]?>;<?endif?>
    DISCOUNT=''; <?if($DISCOUNT):?>DISCOUNT=<?=$_REQUEST["DISCOUNT"]?>;<?endif?>
    INSTOCK=''; <?if($INSTOCK):?>INSTOCK=<?=$_REQUEST["INSTOCK"]?>;<?endif?>
</script>




<div class="filter">
<!--?
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
?-->

<form action="" method="get">
<!--?
foreach($arResult["ITEMS"] as $arItem)
	if(array_key_exists("HIDDEN", $arItem))
		echo $arItem["INPUT"];
?-->
<table cellpadding="0"cellspacing="0" border="0" class="filters">
    <tr>
        <td class="left" rowspan="2"><div onclick="javascript: document.location='/catalog/oboi/oboi_filters.php?COLOR_ID='+COLOR_ID+'&DESIGN_ID='+DESIGN_ID+'&PRICE_ID='+PRICE_ID+'&WIDTH_ID='+WIDTH_ID+'&NEW='+NEW+'&HIT='+HIT+'&DISCOUNT='+DISCOUNT+'&INSTOCK='+INSTOCK+'&SECTION_ID=<?=$SECTION_ID?>';" class="poisk" >Подобрать обои</div></td>
        <td>
           <select onchange="javascript: COLOR_ID=this.options[this.selectedIndex].value;">
            <!--select id="Color" onchange="javascript: COLOR_ID=document.getElementById('Color').options[this.selectedIndex].value;"-->
              <option value="" <?if($COLOR_ID==""):?>selected<?endif?> >Все по цвету</option>
<?
$db_color_list = CIBlockProperty::GetPropertyEnum("COLOR", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
while($ar_color_list = $db_color_list->GetNext())
{
?>
              <option value="<?=$ar_color_list["ID"]?>" <?if($COLOR_ID==$ar_color_list["ID"]):?>selected<?endif?> ><?=$ar_color_list["VALUE"]?></option>
<?
}
?>
            </select> 
        </td>
        <td class="separator"></td>
        <td>
            <select onchange="javascript: DESIGN_ID=this.options[this.selectedIndex].value;">
            <!--select id="Design" onchange="javascript: DESIGN_ID=document.getElementById('Design').options[this.selectedIndex].value;"-->
              <option value="" <?if($DESIGN_ID==""):?>selected<?endif?> >Все по рисунку</option>
<?
$db_design_list = CIBlockProperty::GetPropertyEnum("DESIGN", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
while($ar_design_list = $db_design_list->GetNext())
{
?>
              <option value="<?=$ar_design_list["ID"]?>" <?if($DESIGN_ID==$ar_design_list["ID"]):?>selected<?endif?> ><?=$ar_design_list["VALUE"]?></option>
<?
}
?>
            </select>
        </td>
        <td class="separator"></td>
        <td>
            <select onchange="javascript: PRICE_ID=this.options[this.selectedIndex].value;">
              <option value="" <?if($PRICE_ID==""):?>selected<?endif?> >Все по цене</option>
              <option value="6" <?if($PRICE_ID=="6"):?>selected<?endif?> >до 1000 руб</option>
              <option value="7" <?if($PRICE_ID=="7"):?>selected<?endif?> >1000-1499 руб</option>
              <option value="8" <?if($PRICE_ID=="8"):?>selected<?endif?> >1500-1999 руб</option>
              <option value="9" <?if($PRICE_ID=="9"):?>selected<?endif?> >2000-2999 руб</option>
              <option value="60" <?if($PRICE_ID=="60"):?>selected<?endif?> >3000-3999 руб</option>
              <option value="61" <?if($PRICE_ID=="61"):?>selected<?endif?> >4000-4999 руб</option>
              <option value="10" <?if($PRICE_ID=="10"):?>selected<?endif?> >свыше 5000 руб</option>
            </select>
        </td>
        <td class="separator"></td>
        <td>
            <select onchange="javascript: WIDTH_ID=this.options[this.selectedIndex].value;">
              <option value="" <?if($WIDTH_ID==""):?>selected<?endif?> >Все по ширине</option>
              <option value="33" <?if($WIDTH_ID=="33"):?>selected<?endif?> >0,53 м</option>
              <option value="34" <?if($WIDTH_ID=="34"):?>selected<?endif?> >0,68 м</option>
              <option value="35" <?if($WIDTH_ID=="35"):?>selected<?endif?> >0,70 м</option>
              <option value="36" <?if($WIDTH_ID=="36"):?>selected<?endif?> >0,92 м</option>
              <option value="37" <?if($WIDTH_ID=="37"):?>selected<?endif?> >1,00 м</option>
            </select>
        </td>
   </tr>
   <tr>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px; margin-left:1px; margin-top: 10px;"><tr><td style="width: 110px; padding-left: 3px;">Только новинки</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="new" value="new" <?if($NEW):?>checked<?endif?> onclick="javascript:<?if(!$NEW):?>NEW=true;<?else:?>NEW='';<?endif?>"></td></tr></table>
        </td>
        <td class="separator"></td>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px; margin-left:1px; margin-top: 10px;"><tr><td style="width: 110px; padding-left: 3px;">Лидеры продаж</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="hit" value="hit" <?if($HIT):?>checked<?endif?> onclick="javascript:<?if(!$HIT):?>HIT=true;<?else:?>HIT='';<?endif?>"></td></tr></table>
        </td>
        <td class="separator"></td>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px; margin-left:1px; margin-top: 10px;"><tr><td style="width: 110px; padding-left: 3px;">Со скидкой</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="discount" value="discount" <?if($DISCOUNT):?>checked<?endif?> onclick="javascript:<?if(!$DISCOUNT):?>DISCOUNT=true;<?else:?>DISCOUNT='';<?endif?>"></td></tr></table>
        </td>
        <td class="separator"></td>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" style="background-color: white; height: 18px; margin-left:1px; margin-top: 10px;"><tr><td style="width: 110px; padding-left: 3px;">В наличии</td><td style="width: 20px; text-align: right; padding-right: 2px;"><input type="checkbox" name="instock" value="instock" <?if($INSTOCK):?>checked<?endif?> onclick="javascript:<?if(!$INSTOCK):?>INSTOCK=true;<?else:?>INSTOCK='';<?endif?>"></td></tr></table>
        </td>
   </tr>

</table>

</form>
</div>
