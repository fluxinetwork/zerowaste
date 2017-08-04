/*======================================================================*\
==========================================================================

                           JS TOOL SEARCH FILTERS

==========================================================================
\*======================================================================*/

function initCustomSearch(){        	
    jQuery('.js-search-input').focus();
	// Test to select active filter option in search filters
	if((window.location.href).split("&")[1] != void 0){
		var activeFilter = (window.location.href).split("&")[1];
		var filterVal = activeFilter.substring(4);				
		jQuery('#search-filters #filter option[value='+filterVal+']').attr('selected','selected');
	}
	
	jQuery('#search-filters').change(function() {
		var filterType;
       	var filterVal = jQuery('#search-filters #filter option:selected').val();
	  	
		if(jQuery.isNumeric(filterVal)){
			filterType = 'cat';
		}else{
			filterType = 'cpt';
		}
		var urlSeach = (window.location.href).split('&')[0] ;
      location.href = urlSeach+'&'+filterType+'='+filterVal;
   });
}

