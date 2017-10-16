<div class="mobileheader-v2">
	<div class="burger pull-left">
		<i class="svg svg-burger white lg"></i>
		<i class="svg svg-close white lg"></i>
	</div>
	<div class="title-block col-sm-6 col-xs-5 pull-left"><?($APPLICATION->GetTitle() ? $APPLICATION->ShowTitle(false) : $APPLICATION->ShowTitle());?></div>
	<div class="right-icons pull-right">
		<div class="pull-right">
			<div class="wrap_icon">
				<button class="top-btn inline-search-show twosmallfont">
					<i class="svg svg-search lg white" aria-hidden="true"></i>
				</button>
			</div>
		</div>
		<div class="pull-right">
			<div class="wrap_icon wrap_basket">
				<?=CNext::ShowBasketWithCompareLink('', 'lg white');?>
			</div>
		</div>
		<div class="pull-right">
			<div class="wrap_icon wrap_cabinet">
				<?=CNext::showCabinetLink(true, false, 'lg white');?>
			</div>
		</div>
	</div>
</div>