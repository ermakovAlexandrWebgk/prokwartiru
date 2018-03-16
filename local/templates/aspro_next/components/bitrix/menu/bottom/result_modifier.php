<?
	$arResult = CNext::getChilds($arResult);
foreach ($arResult as $ID=>$arItem){
   
$arImage=CFile::ResizeImageGet($_SERVER['DOCUMENT_ROOT'].'/'.$arItem['PARAMS']['IMG'], array('width'=>10, 'height'=>10), BX_RESIZE_IMAGE_PROPORTIONAL, true);     


}
?>