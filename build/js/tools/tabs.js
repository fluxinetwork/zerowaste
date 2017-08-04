function init_tabs() {
	jQuery('.js-tab').on('click mouseenter', function(e) {
		e.preventDefault();
		active_tab(jQuery(this));
	}).eq(0).click();

	function active_tab(tab) {
		jQuery('.js-tab').removeClass('is-active');
		tab.addClass('is-active');
		var index = tab.index();

		var content = tab.parent().next();
		content.find('.js-tab-content').removeClass('is-active');
		content.find('.js-tab-content').eq(index).addClass('is-active');
		content.css('left', index*-100+'%');
	}

	jQuery('.js-tab-wrap').each(function() {
		var nb = jQuery(this).find('.js-tab').length;
		jQuery(this).attr('data-tabs', nb);
	});

	jQuery('.js-tab-content').on('mouseenter', function(){
		var index = jQuery(this).index();
		jQuery('.js-tab').eq(index).click();
	})
}