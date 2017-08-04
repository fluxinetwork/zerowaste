/*======================================================================*\
==========================================================================

                              JS TOOL DISABLE

==========================================================================
\*======================================================================*/

function disable_links() {
	jQuery('.js-disabled').click(function(e){
		e.preventDefault();
	});
}

function disable_titles() {
	jQuery('.js-disable-title').hover(
		function(){
			var cible = jQuery(this);
			cible.data( 'title', cible.attr('title') ).attr('title','');
		},
		function() {
			var cible = jQuery(this);
			cible.attr( 'title', cible.data('title') );
		}		
	);
}
