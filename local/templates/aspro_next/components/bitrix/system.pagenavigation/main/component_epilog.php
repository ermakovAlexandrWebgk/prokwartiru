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
    <div id="productPageCount" class="items_count">
        (<?=$count;?> <?=$wordForItems;?>)
    </div>
    <?}?>
<script>
  $( document ).ready( function () {
    var stores = $("#productPageCount");
    $("#replace_productPageCount").replaceWith(stores).remove();
  })
</script>