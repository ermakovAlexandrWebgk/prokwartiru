$(document).ready(function(){
	$('.confirm_region .aprove').on('click', function(e){
		var _this = $(this);
		$.removeCookie('current_region');
		$.cookie('current_region', _this.data('id'), {path: '/',domain: arNextOptions['SITE_ADDRESS']});
		location.href = _this.data('href');
	})
	$('.js_city_change').on('click', function(){
		var _this = $(this);
		$('.region_wrapper .dropdown').fadeIn(100);
		_this.closest('.confirm_region').remove();
	})
	$('.js_city_chooser').on('click', function(){
		var _this = $(this);
		_this.closest('.region_wrapper').find('.confirm_region').remove();
		_this.closest('.region_wrapper').find('.dropdown').fadeToggle(100);
	})
	/* close search block */
	$("html, body").on('mousedown', function(e){
		e.stopPropagation();
		if(!$(e.target).hasClass('dropdown'))
		{
			$('.region_wrapper .dropdown').fadeOut(100);
		}

	});
	$('.region_wrapper').find('*').on('mousedown', function(e){
		e.stopPropagation();
	});
	$('.region_wrapper .more_item:not(.current) span').on('click', function(e){
		$.removeCookie('current_region');
		$.cookie('current_region', $(this).data('region_id'), {path: '/',domain: arNextOptions['SITE_ADDRESS']});
		
		location.href = $(this).data('href');
	});
});