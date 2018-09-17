<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?\Bitrix\Main\Loader::includeModule('aspro.next');?>
<?if($_POST["CLEAR_ALL"]=="Y"){
	Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("basket-allitems-block");
	\Bitrix\Main\Loader::includeModule('sale');
	
	$type="BASKET";
	if(isset($_POST["TYPE"]) && $_POST["TYPE"]){
		switch ($_POST["TYPE"]) {
			case 2:
				$type="DELAY";
				break;
			case 3:
				$type="SUBSCRIBE";
				break;
			case 4:
				$type="NOT_AVAILABLE";
				break;			
			default:
				
				break;
		}
	}
	$arItems=CNext::getBasketItems($iblockID, "ID");
	foreach($arItems[$type] as $id){
        $arFields = array(
           "DELAY" => "N"
        );
        CSaleBasket::Update($id, $arFields);
		CSaleBasket::Delete($id);
	}

	Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("basket-allitems-block", "");
}elseif($_POST["delete_top_item"]=="Y"){
	\Bitrix\Main\Loader::includeModule('sale');
    $arFields = array(
       "DELAY" => "N"
    );             
    CSaleBasket::Update($_POST["delete_top_item_id"], $arFields);
	CSaleBasket::Delete($_POST["delete_top_item_id"]);
}?>
<?CNextCache::ClearCacheByTag('sale_basket');?>