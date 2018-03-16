<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">

<?
foreach($arResult["ITEMS"] as $arItem)
	if(array_key_exists("HIDDEN", $arItem))
		echo $arItem["INPUT"];
?>


		<b class="r1"></b>
		<div class="catalog-item-filter-body-inner_" style="margin-bottom: 20px;
margin-left: 16px;
/*background-color: #EFEFEF;*/
height: 26px;
padding-top: 8px;
margin-right: 20px;">

				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?if(!array_key_exists("HIDDEN", $arItem)):?>
						<?=$arItem["NAME"]?>: <span class="filter-<?=$arItem["TYPE"]?>"><?=$arItem["INPUT"]?></span>
					<?endif?>
				<?endforeach;?>

        <!--div class="filter-dropdown"><input type="submit" name="set_filter" value="Выбрать" /></div-->
        <input type="hidden" name="set_filter" value="Y" />&nbsp;<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" />

		</div>
		<b class="r1"></b>


</form>


<!--form method="get" name="<-?echo $arResult["FILTER_NAME"]."_form"?->" action="<-?echo $arResult["FORM_ACTION"]?->" spsourceindex="0">
  <table>
    <tbody>
      <tr><td style="BORDER-BOTTOM-COLOR: ; BORDER-TOP-COLOR: ; BORDER-RIGHT-COLOR: ; BORDER-LEFT-COLOR: ">Цена:</td><td style="BORDER-BOTTOM-COLOR: ; BORDER-TOP-COLOR: ; BORDER-RIGHT-COLOR: ; BORDER-LEFT-COLOR: "><-?
		// подключим модуль
		CModule::IncludeModule("form");
           $FIELD_ID = 15; // ID вопроса "Ваше образование?"
           echo CForm::GetDropDownFilter(
              $FIELD_ID, 
              "ANSWER_TEXT", 
              "ANKETA_EDUCATION_ANSWER_TEXT_dropdown", 
              "class=\"inputselect\""
           );
?-> </td><td style="BORDER-BOTTOM-COLOR: ; BORDER-TOP-COLOR: ; BORDER-RIGHT-COLOR: ; BORDER-LEFT-COLOR: "><input value="Выбрать" type="submit" spsourceindex="1" /> </td></tr>
    </tbody>
  </table>
</form-->
<script type="text/javascript">
	$(function () {
		$("#catalog_item_toogle_filter").click(function() {
			$("#catalog_item_filter_body").slideToggle();
		});
	});
</script>