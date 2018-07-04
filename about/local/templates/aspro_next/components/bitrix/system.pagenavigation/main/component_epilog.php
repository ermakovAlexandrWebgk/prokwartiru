<?
use Bitrix\Main\Grid\Declension;
$yearDeclension = new Declension(
GetMessage('ITEMS_COUNT_1'),
GetMessage('ITEMS_COUNT_2'),
GetMessage('ITEMS_COUNT_3')
);
$count = $arResult["NavRecordCount"];

$wordForItems=$yearDeclension->get($arResult["NavRecordCount"]);?>
    <?$p1 = "/catalog/";
    if (strstr($APPLICATION->GetCurDir(), $p1)) {?>
        <span style="display: none"id="productPageCount">(<?=$count;?> <?=$wordForItems;?>)</span>
    <?}?>
<script>
$(window).on("load", function() {
    var itemsCountString = $("#productPageCount").text();
    $('#replace_productPageCount').text(itemsCountString).addClass('items_count');
});


</script>