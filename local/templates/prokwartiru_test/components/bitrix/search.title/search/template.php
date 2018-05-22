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
 			<div class="search-inner-box" style="float:right; margin-right:-3px; color: white; font-size: 14px; background-color: #ffffff; border: 1px solid #22211f; width:577px;">
<input id="<?echo $INPUT_ID?>" style="width: 530px; height: 36px; background-color: #ffffff; color: #bab9b9; font-size:12px; padding-left: 10px; border:none;" type="text" name="q" value="" placeholder="                                                                                                                                    ÏÎÈÑÊ ÏÎ ÀÐÒÈÊÓËÓ" size="150" maxlength="150" autocomplete="off" /><input style="background: white url(<?=SITE_TEMPLATE_PATH?>/images/btn_search.jpg) 5px 5px no-repeat; width: 35px; height: 36px; cursor:pointer; border:none;" type="submit" name="s" onfocus="this.blur();" value=" " id="search-submit-button">
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
