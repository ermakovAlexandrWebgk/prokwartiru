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

		<div class="rounded-box" style="width: 120px; margin-left:26px;">
 			<div class="search-inner-box" style="float:left; color: white; font-size: 12px; background-color: #ffffff; border: 1px solid #22211f; height:20px; margin-top:4px;"><input id="<?echo $INPUT_ID?>" style="width: 80px; height: 20px; background-color: #ffffff; color: #bab9b9; font-size:12px; padding-left: 5px; border:none; type="text" name="q" value="" placeholder="ÏÎÈÑÊ" size="1540" maxlength="250" autocomplete="off" /></div><input style="background: transparent url(<?=SITE_TEMPLATE_PATH?>/images/btn_search.png) left 3px no-repeat; float:right; width: 25px; height: 21px; border: none;  cursor:pointer;" type="submit" name="s" onfocus="this.blur();" value="" id="search-submit-button">
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
