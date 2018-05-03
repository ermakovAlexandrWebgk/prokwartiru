<?
use Bitrix\Main\Grid\Declension;
$yearDeclension = new Declension(
GetMessage('ITEMS_COUNT_1'),
GetMessage('ITEMS_COUNT_2'),
GetMessage('ITEMS_COUNT_3')
);
$wordForItems=$yearDeclension->get($arResult["NavRecordCount"]);?>
    <div id="productPageCount" class="items_count">
        <? echo "(" .$arResult["NavRecordCount"].' ' .$wordForItems .")" ?>
    </div>
<script>
  $( document ).ready( function () {
    var stores = $("#productPageCount");
    $("#replase_productPageCount").replaceWith(stores);
  })
</script>