/*======================================================================*\
==========================================================================

                          JS TOOL IMG LOADING

==========================================================================
\*======================================================================*/

/*
Using Images Loaded : http://imagesloaded.desandro.com
*/


function loading_img(container) {
	container.addClass('is-loading')
		.imagesLoaded()
		.progress( onProgress )
		.always( onAlways );

	jQuery('.js-baseLoader').addClass('is-visible');

	var stepLoad = 0;
	function onProgress( imgLoad, image ) {
		stepLoad++;
		var percent = Math.round((stepLoad)*(100/imgLoad.images.length));
		jQuery('.js-baseLoader-bar').css('width', percent+'%');
	};

	function onAlways(imgLoad) {
		jQuery('.js-baseLoader').removeClass('is-visible');
		container.removeClass('is-loading');
		setTimeout(function() {
			jQuery('.js-baseLoader-bar').css('width', '0%');
		}, 400);
	};
}