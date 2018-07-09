<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if($_REQUEST["delete_top_item"]=="Y"){
    \Bitrix\Main\Loader::includeModule('sale');
    $arFields = array(
       "DELAY" => "N"
    );
    
    CSaleBasket::Update($_REQUEST["delete_top_item_id"], $arFields);
    CSaleBasket::Delete($_REQUEST["delete_top_item_id"]);
}
?>