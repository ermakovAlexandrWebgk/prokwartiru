<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="search">
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);


if($arParams["SHOW_INPUT"] !== "N"):?>
	<div id="<?echo $CONTAINER_ID?>">

	<form action="<?echo $arResult["FORM_ACTION"]?>">

		<div class="rounded-box">
			<div class="search-inner-box" style="color: white; font-size: 14px;">

		Поиск: <input id="<?echo $INPUT_ID?>" style="width: 200px;  height: 18px; border: 1px solid #8E8B86; background-color: #575655; color: #ffffff; padding: 0;" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" />&nbsp;
<input style="background: transparent url(<?=SITE_TEMPLATE_PATH?>/images/btn_search.png) left top no-repeat; width: 25px; height: 20px; border: none; color: white;" type="submit" name="s" onfocus="this.blur();" value="" id="search-submit-button">
                         </div>        
		</div>
	</form>
	</div>
<?endif?>
</div>

<script type="text/javascript">
var jsControl = new JCTitleSearch({
	//'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
	'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
	'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
	'INPUT_ID': '<?echo $INPUT_ID?>',
	'MIN_QUERY_LEN': 2
});
</script>
