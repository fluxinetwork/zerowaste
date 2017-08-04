/*======================================================================*\
==========================================================================

                              JS TOOL SCROLL TO

==========================================================================
\*======================================================================*/

jQuery('.js-scroll-to').click(function(e){
	e.preventDefault();
	id = jQuery(jQuery(this).attr('href'));
	scroll_to(id);
})

jQuery('.js-scroll-top').click(function(e){
	scroll_to('top');
})

jQuery('.js-scroll-bottom').click(function(e){
	scroll_to('bottom');
})

function scroll_to(position, duration, relative) {
	var coef;
	var top;
	var bottom;

	if (position === 'top') {
		position = 0;
		top = true;
	} else if (position === 'bottom') {
		position = jQuery(document).height();
		bottom = true;
	} else {
		position = position.offset().top;
	}

	if (duration === 'fast') {
		coef = 0.1;
		duration = 200;
	} else if (duration === 'slow') {
		coef = 0.4;
		duration = 600;
	} else {
		coef = 0.25;
		duration= 400;
	}

	if (relative === true) {
		calc_windowH();
		if (top) {
			duration = jQuery(document).scrollTop()*coef;
		} else if (bottom) {
			duration = (jQuery(document).height()-jQuery(document).scrollTop())*coef;
		}
	}

	jQuery('html, body').animate({scrollTop: position}, duration);
}
