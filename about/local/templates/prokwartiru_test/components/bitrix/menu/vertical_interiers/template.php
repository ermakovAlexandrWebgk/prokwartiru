<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult))
	return;

$lastSelectedItem = null;
$lastSelectedIndex = -1;

foreach($arResult as $itemIndex => $arItem)
{
	if (!$arItem["SELECTED"])
		continue;

	if ($lastSelectedItem == null || strlen($arItem["LINK"]) >= strlen($lastSelectedItem["LINK"]))
	{
		$lastSelectedItem = $arItem;
		$lastSelectedIndex = $itemIdex;
	}
}

?>
<div id="vertical-interiers">
<ul>
<?foreach($arResult as $itemIndex => $arItem):?>
	<li <?if($arItem["TEXT"]=="Обои в интерьере"||$arItem["TEXT"]=="Плитка в интерьере"||$arItem["TEXT"]=="Свет в интерьере"||$arItem["TEXT"]=="Фрески в интерьере"||$arItem["TEXT"]=="Наши работы"):?>style="font-weight: bold;"<?endif?>>
<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
</li>

<?endforeach;?>
</ul>
</div>