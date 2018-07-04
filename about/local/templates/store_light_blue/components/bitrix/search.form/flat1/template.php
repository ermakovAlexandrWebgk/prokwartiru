<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="search">
	<form action="<?=$arResult["FORM_ACTION"]?>">
		<div class="rounded-box">
			<div class="search-inner-box"><input style="width: 125px; height: 25px; border: 1px; border-color: #ffffff; background-color: #575655; border-style:solid; border-width: 1px; color: #ffffff; margin: 3px; padding-left: 5px;" type="text" name="q" value="поиск" maxlength="50" />
         	<input style="background: transparent url(<?=SITE_TEMPLATE_PATH?>/images/btn_search.png) no-repeat; width: 24px; background-position-y: center; height: 23px;     padding-top: 2px; border: none;" type="submit" name="s" onfocus="this.blur();" value="" id="search-submit-button">   
            
            </div>
            
           
        
        
		</div>
		
	</form>
</div>