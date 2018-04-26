<?
global $arTheme, $arRegion;
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
?>
<div class="mobileheader-v1">
	<div class="burger pull-left">
		<i class="svg svg-burger mask"></i>
		<i class="svg svg-close black lg"></i>
	</div>
	<div class="logo-block pull-left">
		<div class="logo<?=$logoClass?>">
			<?=CNext::ShowLogo();?>
		</div>
	</div>
    <div class="phone-block">
        <li>
            <a rel="nofollow" href="tel:79851551755" class="dark-color">
                <i class="svg svg-phone"></i>
            </a>
        </li>
    
    </div>
	<div class="right-icons pull-right">
		<div class="pull-right">
			<div class="wrap_icon">
				<button class="top-btn inline-search-show twosmallfont">
					<i class="svg svg-search lg" aria-hidden="true"></i>
				</button>
			</div>
		</div>
		<div class="pull-right">
			<div class="wrap_icon wrap_basket">
				<?=CNext::ShowBasketWithCompareLink('', 'lg');?>
			</div>
		</div>
		<div class="pull-right">
			<div class="wrap_icon wrap_cabinet">
				<?//=CNext::showCabinetLink(true, false, 'lg');?>
			</div>
		</div>
	</div>
</div>