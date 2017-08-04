/*======================================================================*\
==========================================================================

                                 GRID HELPER

==========================================================================
\*======================================================================*/

jQuery(document).ready(function() {
	if (true) {
		jQuery('.js-toggle-grid').on('click', function(e) {
			e.preventDefault();
			jQuery(this).toggleClass('is-active');
			jQuery('.global').toggleClass('has-grid');
			jQuery('.cb-navAdmin').toggleClass('is-on-top');
		}).removeClass('is-none');
	}
	
	jQuery('.js-close-adminBar').on('click', function(){
		jQuery('.cb-adminTools').addClass('is-off')
	})
});
