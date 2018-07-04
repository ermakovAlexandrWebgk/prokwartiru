<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (intval($arResult["ID"]) <= 0)
	return false; 
if (!function_exists("__vote_template_default_votes_ending"))
{
	function __vote_template_default_votes_ending($count)
	{
		$text = GetMessage("T_VOTES");
		$count = intVal($count);
		$iCount = intVal($count%100);
		
		if (!(10 < $iCount && $iCount < 20))
		{
			$count = intVal($count % 10);
			if ($count == 1)
				$text = GetMessage("T_VOTE");
			elseif ($count > 1 && $count < 5)
				$text = GetMessage("T_VOTES_2");
		}
		
		return $text;
	}
}

//Let's determine what value to display: rating or average ?
if($arParams["DISPLAY_AS_RATING"] == "vote_avg")
{
	if($arResult["PROPERTIES"]["vote_count"]["VALUE"])
		$DISPLAY_VALUE = round($arResult["PROPERTIES"]["vote_sum"]["VALUE"]/$arResult["PROPERTIES"]["vote_count"]["VALUE"], 2);
	else
		$DISPLAY_VALUE = 0;
}
else
{
	$DISPLAY_VALUE = $arResult["PROPERTIES"]["rating"]["VALUE"];
}

$title = "";
if ($arResult["VOTED"])
	$title = GetMessage("T_RATING").': '.$DISPLAY_VALUE;
if ($arResult["PROPERTIES"]["vote_count"]["VALUE"] > 0)
	$title .= ' ('.$arResult["PROPERTIES"]["vote_count"]["VALUE"].' '.__vote_template_default_votes_ending($arResult["PROPERTIES"]["vote_count"]["VALUE"]).')';
else
	$title .= GetMessage("T_IBLOCK_VOTE_NO_RESULTS");
$arParams["IDENTIFICATOR"] = (empty($arParams["~IDENTIFICATOR"]) ? '' : $arParams["~IDENTIFICATOR"].'_');

// Don't delete <!--BX_PHOTO_RARING-->, <!--BX_PHOTO_RARING_END--> comments - they are used in js to catch html content
?>
<!--BX_PHOTO_RARING-->
<div class="iblock-vote" id="vote_<?=$arParams["IDENTIFICATOR"]?><?= $arResult["ID"]?>" title="<?= $title?>">
	<?foreach($arResult["VOTE_NAMES"] as $i => $name):
		$id = 'vote_'.$arResult["ID"].'_'.$i;
		$class = "photo-rating-star".(($DISPLAY_VALUE && round($DISPLAY_VALUE) > $i) ? " photo-rating-star-select" : "");
	?>
		<span id="vote_<?=$arResult["ID"]?>_<?=$i?>" class="<?= $class?>" 
			<?if(!$arResult["VOTED"]):?>
				onmouseover="if(window.voteScript){voteScript.trace_vote(this, true);}"
				onmouseout="if(window.voteScript){voteScript.trace_vote(this, false);}"
				onclick="if(window.voteScript){voteScript.do_vote(this, 'vote_<?= $arResult["ID"]?>', <?= $arResult["AJAX_PARAMS"]?>);}"
			<?endif;?>
		>&nbsp;</span>
	<?endforeach;?>
</div>
<!--BX_PHOTO_RARING_END-->