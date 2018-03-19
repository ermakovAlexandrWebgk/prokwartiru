<?
use Bitrix\Main\Grid\Declension;
$yearDeclension = new Declension(
GetMessage('ITEMS_COUNT_1'),
GetMessage('ITEMS_COUNT_2'),
GetMessage('ITEMS_COUNT_3')
);
$word=$yearDeclension->get($arResult["NavRecordCount"]);?>

<?$this->__template->SetViewTarget('items_count');?>
    <div class="items_count">
        <?=$arResult["NavRecordCount"];?> <?=$word;?>
    </div>
<?$this->__template->EndViewTarget();?>