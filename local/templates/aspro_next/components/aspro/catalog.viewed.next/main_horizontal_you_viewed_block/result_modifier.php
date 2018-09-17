<?
$count=count($arResult["ITEMS"]);
$diff=5-$count;
if($count<5){
	for($i=1;$i<=$diff;$i++){
		$arResult["ITEMS"][]='';
	}
}
foreach($arResult["ITEMS"] as $key => $arrays){																			//
		$needId = $arrays['PRODUCT_ID'];
		$arSelect = Array("ID","DETAIL_PICTURE");
		$arFilter = Array("ID" =>$needId );
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->Fetch()){
					$arFile = CFile::GetFileArray($ob["DETAIL_PICTURE"]);
					$file = CFile::ResizeImageGet($arFile, array('width'=>220, 'height'=>220), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$arResult['ITEMS'][$key]['PICTURE']['SRC'] = $file['src'];
			}
}

?>
