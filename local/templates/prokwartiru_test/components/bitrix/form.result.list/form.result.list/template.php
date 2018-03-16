<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?
$FORM_ID=2;

$rsResults = CFormResult::GetList($FORM_ID, 
    ($by="s_date_create"), 
    ($order="desc"), 
    $arFilter, 
    $is_filtered, 
    "Y");

$rsResults->NavStart(10);
//echo $rsResults->NavPrint("Отзывы");

while ($arResult = $rsResults->Fetch())
{

// получим данные по всем вопросам
$arAnswer = CFormResult::GetDataByID(
	$arResult["ID"], 
	array(), 
	$arResult2, 
	$arAnswer2);
?>

<!-- Дата создания -->
<?
// получим формат времени текущего сайта DD.MM.YYYY HH:MI:SS
if ($date = ParseDateTime($arAnswer[DATE][0][USER_TEXT], CSite::GetDateFormat())):?>
<p><?=$date[DD]?>.<?=$date[MM]?>.<?=$date[YYYY]?></p>
<?endif?>
<!-- Конец Дата создания -->

<!-- Имя автора -->
<p><b><?=$arAnswer[NAME][0][USER_TEXT]?></b></p>
<!-- Конец Имя автора -->

<!-- Текст сообщения -->
<div><?=$arAnswer[MESSAGE][0][USER_TEXT]?></div>
<!-- Конец Текст сообщения -->

<!-- Текст ответа -->
<?if($arAnswer[ANSWER][0][USER_TEXT]):?>
  <div style="margin-top: 10px;">&ndash; <?=$arAnswer[ANSWER][0][USER_TEXT]?></div>
<?endif?>
<!-- Конец Текст ответа -->   
<br /><br /><br />
<?
}
?>

<div id="page_navigation">
  <? echo $rsResults->NavPrint("Отзывы", false, "tablebodytext","orange"); ?>
</div>