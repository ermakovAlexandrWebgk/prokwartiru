<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$SECTION_ID=$_REQUEST['SECTION_ID'];?>
<?if(!$SECTION_ID) $SECTION_ID=1;?>
<? global $FABRIKA_ID;?>
<?$FABRIKA_ID=$_REQUEST['FABRIKA_ID'];?>
<?$COLOR_ID=$_REQUEST['COLOR_ID'];?>
<?$DESIGN_ID=$_REQUEST['DESIGN_ID'];?>
<?$STYLE_ID=$_REQUEST['STYLE_ID'];?>
<?$MATERIAL_ID=$_REQUEST['MATERIAL_ID'];?>
<?$PRICE_FROM=$_REQUEST['PRICE_FROM']; if(!$PRICE_FROM) $PRICE_FROM='1';?>
<?$PRICE_TO=$_REQUEST['PRICE_TO']; if(!$PRICE_TO) $PRICE_TO='100000';?>
<?$WIDTH_ID=$_REQUEST['WIDTH_ID'];?>
<?$TYPE=$_REQUEST['TYPE'];?>
<?$NEW=$_REQUEST['NEW'];?>
<?$HIT=$_REQUEST['HIT'];?>
<?$DISCOUNT=$_REQUEST['DISCOUNT'];?>
<?$INSTOCK=$_REQUEST['INSTOCK'];?>
<?$ORDER=$_REQUEST['ORDER'];?>
<?$COLLECT=$_REQUEST['COLLECT'];?>
<?$SIZE_ID=$_REQUEST['SIZE_ID'];?>

<script type="text/javascript">
    FABRIKA_ID=''; <?if($FABRIKA_ID):?>FABRIKA_ID=<?=$FABRIKA_ID?>;<?endif?>
    COLOR_ID=''; <?if($COLOR_ID):?>COLOR_ID=<?=$_REQUEST['COLOR_ID']?>;<?endif?>
    DESIGN_ID=''; <?if($DESIGN_ID):?>DESIGN_ID=<?=$_REQUEST['DESIGN_ID']?>;<?endif?>
    STYLE_ID=''; <?if($STYLE_ID):?>STYLE_ID=<?=$_REQUEST["STYLE_ID"]?>;<?endif?>
    MATERIAL_ID=''; <?if($MATERIAL_ID):?>MATERIAL_ID=<?=$_REQUEST["MATERIAL_ID"]?>;<?endif?>
    PRICE_FROM='1'; <?if($PRICE_FROM):?>PRICE_FROM=<?=$PRICE_FROM?>;<?endif?>
    PRICE_TO='100000'; <?if($PRICE_TO):?>PRICE_TO=<?=$PRICE_TO?>;<?endif?>
    WIDTH_ID=''; <?if($WIDTH_ID):?>WIDTH_ID=<?=$_REQUEST["WIDTH_ID"]?>;<?endif?>
    TYPE=''; <?if($TYPE):?>TYPE=<?=$_REQUEST["TYPE"]?>;<?endif?>
    NEW=''; <?if($NEW):?>NEW=<?=$_REQUEST["NEW"]?>;<?endif?>
    HIT=''; <?if($HIT):?>HIT=<?=$_REQUEST["HIT"]?>;<?endif?>
    DISCOUNT=''; <?if($DISCOUNT):?>DISCOUNT=<?=$_REQUEST["DISCOUNT"]?>;<?endif?>
    INSTOCK=''; <?if($INSTOCK):?>INSTOCK=<?=$_REQUEST["INSTOCK"]?>;<?endif?>
    ORDER=''; <?if($ORDER):?>ORDER=<?=$_REQUEST["ORDER"]?>;<?endif?>
    COLLECT='off'; <?if($COLLECT=='on'):?>COLLECT='on';<?endif?>
    SIZE_ID=''; <?if($SIZE_ID):?>SIZE_ID=<?=$_REQUEST["SIZE_ID"]?>;<?endif?>

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
<table cellpadding="0"cellspacing="0" border="0" class="filters">
    <tr>
        <td>
           <h4 class="title">ПРОИЗВОДСТВО</h4>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "search", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфо-блока
	"IBLOCK_ID" => "6",	// Инфо-блок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => "",	// Код раздела
	"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
	"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
	"SECTION_FIELDS" => array(	// Поля разделов
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// Свойства разделов
		0 => "",
		1 => "UF_COLLECTIONS",
		2 => "",
	),
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"CACHE_TYPE" => "N",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "N",	// Учитывать права доступа
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
        </td>
        <td>
           <h4 class="title">ЦВЕТ</h4> 
           <?
           $db_color_list = CIBlockProperty::GetPropertyEnum("COLOR", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
           while($ar_color_list = $db_color_list->GetNext())
           {
              $color_text="<img src='".SITE_TEMPLATE_PATH."/images/colors/".$ar_color_list['ID'].".jpg' id='color_".$ar_color_list['ID']."' title='".$ar_color_list['VALUE']."' width='24' height='24' class='color' onclick='javascript: if(COLOR_ID) document.getElementById(\"color_\"+COLOR_ID).style.border=\"1px solid transparent\"; if(COLOR_ID!=".$ar_color_list['ID'].") { this.style.border=\"1px solid white\"; COLOR_ID=".$ar_color_list['ID'].";} else COLOR_ID=\"\";' onmouseover='this.style.cursor=\"pointer\";' ";
              if($ar_color_list['ID']==$COLOR_ID) $color_text=$color_text." style='border: 1px solid white;' ";
              $color_text=$color_text."/>";
              //echo("<img src='".SITE_TEMPLATE_PATH."/images/colors/".$ar_color_list['ID'].".jpg' width='24' height='24' class='color' />");
              echo($color_text);
           }
           ?>
           <br /><br />
           <h4 class="title">РИСУНОК</h4>
           <?
           $db_design_list = CIBlockProperty::GetPropertyEnum("DESIGN", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
           while($ar_design_list = $db_design_list->GetNext())
           {
              $design_text="<p><input type='checkbox' name='design' value='".$ar_design_list['ID']."' id='design_".$ar_design_list['ID']."' onclick='javascript: if(DESIGN_ID) document.getElementById(\"design_\"+DESIGN_ID).checked=false; if(this.value!=DESIGN_ID) DESIGN_ID=this.value; else DESIGN_ID=\"\";' ";
              if($ar_design_list['ID']==$DESIGN_ID) $design_text=$design_text." checked";
              $design_text=$design_text.">".$ar_design_list["VALUE"]."</p>";
              echo($design_text);
           }
           ?>
           <br />
           <h4 class="title">СТИЛЬ</h4>
           <?
           $db_style_list = CIBlockProperty::GetPropertyEnum("STYLE", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
           while($ar_style_list = $db_style_list->GetNext())
           {
              $style_text="<p><input type='checkbox' name='style' value='".$ar_style_list['ID']."' id='style_".$ar_style_list['ID']."' onclick='javascript: if(STYLE_ID) document.getElementById(\"style_\"+STYLE_ID).checked=false; if(this.value!=STYLE_ID) STYLE_ID=this.value; else STYLE_ID=\"\";' ";
              if($ar_style_list['ID']==$STYLE_ID) $style_text=$style_text." checked";
              $style_text=$style_text.">".$ar_style_list["VALUE"]."</p>";
              echo($style_text);
           }
           ?>
           <br />
           <h4 class="title">МАТЕРИАЛ/ВИД</h4>
           <?
           $db_material_list = CIBlockProperty::GetPropertyEnum("MATERIAL", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
           while($ar_material_list = $db_material_list->GetNext())
           {
              $material_text="<p><input type='checkbox' name='material' value='".$ar_material_list['ID']."' id='material_".$ar_material_list['ID']."' onclick='javascript: if(MATERIAL_ID) document.getElementById(\"material_\"+MATERIAL_ID).checked=false; if(this.value!=MATERIAL_ID) MATERIAL_ID=this.value; else MATERIAL_ID=\"\";' ";
              if($ar_material_list['ID']==$MATERIAL_ID) $material_text=$material_text." checked";
              $material_text=$material_text.">".$ar_material_list["VALUE"]."</p>";
              echo($material_text);
           }
           ?>
           <br />
        </td>
        <td>
<div onclick="javascript: document.location='/catalog/oboi/search.php';" class="poisk" style="width:65px; margin:30px 15px 45px 0; padding:10px 23px 10px 23px; float: right;">СБРОСИТЬ</div><div onclick="javascript: if(FABRIKA_ID&&(COLLECT=='on')) document.location='/catalog/oboi/index.php?FABRIKA_ID='+FABRIKA_ID+'&SECTION_ID=1'; else document.location='/catalog/oboi/search_list.php?COLOR_ID='+COLOR_ID+'&FABRIKA_ID='+FABRIKA_ID+'&DESIGN_ID='+DESIGN_ID+'&STYLE_ID='+STYLE_ID+'&MATERIAL_ID='+MATERIAL_ID+'&PRICE_FROM='+PRICE_FROM+'&PRICE_TO='+PRICE_TO+'&WIDTH_ID='+WIDTH_ID+'&NEW='+NEW+'&HIT='+HIT+'&DISCOUNT='+DISCOUNT+'&INSTOCK='+INSTOCK+'&ORDER='+ORDER+'&COLLECT='+COLLECT+'&SIZE_ID='+SIZE_ID+'&SECTION_ID=<?=$SECTION_ID?>';" class="poisk" style="width:40px; margin:30px 0 45px 0;">НАЙТИ</div>

<h4 class="title">ВЫВОДИТЬ</h4>
 
            <p><input type="checkbox" name="collect" id="collect_off" value="off" <?if($COLLECT=='off'):?>checked<?endif?> onclick="javascript: if(COLLECT=='on') document.getElementById('collect_'+COLLECT).checked=false; COLLECT='off';">по-артикульно</p>
            <p><input type="checkbox" name="collect" id="collect_on" value="on" <?if($COLLECT=='on'):?>checked<?endif?> onclick="javascript: if(COLLECT=='off') document.getElementById('collect_'+COLLECT).checked=false; COLLECT='on';">по коллекциям</p>

<br/>
<h4 class="title">ЦЕНА</h4>
            <p>от <input type="text" name="price_from" value="<?=$PRICE_FROM?>" class="price" onchange="javascript: PRICE_FROM=this.value;"> до <input type="text" name="price_to" name="price_to" value="<?=$PRICE_TO?>" class="price" onchange="javascript: PRICE_TO=this.value;"></p>
            <br />
            <p><input type="checkbox" name="new" value="new" <?if($NEW):?>checked<?endif?> onclick="javascript:<?if(!$NEW):?>NEW=true;<?else:?>NEW='';<?endif?>">новинки</p>
            <p><input type="checkbox" name="hit" value="hit" <?if($HIT):?>checked<?endif?> onclick="javascript:<?if(!$HIT):?>HIT=true;<?else:?>HIT='';<?endif?>">лидеры продаж</p>
            <p><input type="checkbox" name="discount" value="discount" <?if($DISCOUNT):?>checked<?endif?> onclick="javascript:<?if(!$DISCOUNT):?>DISCOUNT=true;<?else:?>DISCOUNT='';<?endif?>">со скидкой</p>

            <br />
<h4 class="title">НАЛИЧИЕ</h4>
            <p><input type="checkbox" name="instock" value="instock" <?if($INSTOCK):?>checked<?endif?> id='instock' onclick="javascript: if(ORDER) { document.getElementById('order_'+ORDER).checked=false; ORDER=''; } <?if(!$INSTOCK):?>INSTOCK=true;<?else:?>INSTOCK='';<?endif?>">склад</p>
            <p><input type="checkbox" name="order" id="order_10" value="10" <?if($ORDER==10):?>checked<?endif?> onclick="javascript: if(INSTOCK) { document.getElementById('instock').checked=false; INSTOCK=''; } if(ORDER) document.getElementById('order_'+ORDER).checked=false; ORDER=this.value;">заказ до 10 дней</p>
            <p><input type="checkbox" name="order" id="order_20" value="20" <?if($ORDER==20):?>checked<?endif?> onclick="javascript: if(INSTOCK) { document.getElementById('instock').checked=false; INSTOCK=''; } if(ORDER) document.getElementById('order_'+ORDER).checked=false; ORDER=this.value;">заказ до 20 дней</p>
            <p><input type="checkbox" name="order" id="order_30" value="30" <?if($ORDER==30):?>checked<?endif?> onclick="javascript: if(INSTOCK) { document.getElementById('instock').checked=false; INSTOCK=''; } if(ORDER) document.getElementById('order_'+ORDER).checked=false; ORDER=this.value;">заказ до 30 дней</p>
            <p><input type="checkbox" name="order" id="order_40" value="40" <?if($ORDER==40):?>checked<?endif?> onclick="javascript: if(INSTOCK) { document.getElementById('instock').checked=false; INSTOCK=''; } if(ORDER) document.getElementById('order_'+ORDER).checked=false; ORDER=this.value;">заказ до 40 дней</p>
            <p><input type="checkbox" name="order" id="order_50" value="50" <?if($ORDER==50):?>checked<?endif?> onclick="javascript: if(INSTOCK) { document.getElementById('instock').checked=false; INSTOCK=''; } if(ORDER) document.getElementById('order_'+ORDER).checked=false; ORDER=this.value;">заказ до 50 дней</p>
            <br />
<h4 class="title">РАЗМЕР/ТИП</h4>
           <?
           $db_size_list = CIBlockProperty::GetPropertyEnum("FILTER_SIZE", Array("SORT"=>"asc"), Array("IBLOCK_ID"=>5));
           while($ar_size_list = $db_size_list->GetNext())
           {
              $size_text="<p><input type='checkbox' name='size' value='".$ar_size_list['ID']."' id='size_".$ar_size_list['ID']."' onclick='javascript: if(SIZE_ID) document.getElementById(\"size_\"+SIZE_ID).checked=false; if(this.value!=SIZE_ID) SIZE_ID=this.value; else SIZE_ID=\"\";' ";
              if($ar_size_list['ID']==$SIZE_ID) $size_text=$size_text." checked";
              $size_text=$size_text.">".$ar_size_list["VALUE"]."</p>";
              echo($size_text);
           }
           ?>

           <br />
<!--div onclick="javascript: if(FABRIKA_ID&&(COLLECT=='on')) document.location='/catalog/oboi/index.php?FABRIKA_ID='+FABRIKA_ID+'&SECTION_ID=1'; else document.location='/catalog/oboi/search_list.php?COLOR_ID='+COLOR_ID+'&FABRIKA_ID='+FABRIKA_ID+'&DESIGN_ID='+DESIGN_ID+'&STYLE_ID='+STYLE_ID+'&MATERIAL_ID='+MATERIAL_ID+'&PRICE_FROM='+PRICE_FROM+'&PRICE_TO='+PRICE_TO+'&WIDTH_ID='+WIDTH_ID+'&NEW='+NEW+'&HIT='+HIT+'&DISCOUNT='+DISCOUNT+'&INSTOCK='+INSTOCK+'&ORDER='+ORDER+'&COLLECT='+COLLECT+'&SIZE_ID='+SIZE_ID+'&SECTION_ID=<?=$SECTION_ID?>';" class="poisk" >НАЙТИ</div-->
        </td>
   </tr>
</table>

</form>
</div>
  