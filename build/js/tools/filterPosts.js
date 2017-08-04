/*------------------------------*\

    #FILTERS POSTS

\*------------------------------*/

/**
 * Ajax filter posts
 */

function initFluxiFilterPosts(){

    // SUBMIT

    jQuery('#form-filter-posts').on('submit', function(e){
        var params = jQuery(this).serialize();
        var $data_item = jQuery('.js-controles-more');
        var pt_slug = $data_item.data('slug');
        var paged = $data_item.data('paged');
        var ppp = $data_item.data('ppp');

        var $btn = jQuery('#submit-filters');
        var $btnLabel = jQuery('span');
        var $btnIcon = $btn.find('div');
        $btnIcon.addClass('anim-spin');

        if ( windowW > 1049 ) {
            //show_filters();
        } else {
            jQuery('.js-filters').toggleClass('is-open');
        }

        jQuery.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajax_object.ajax_url,
            data: 'action=fluxi_filter_posts&'+params,
            success: function(data){
                if(data[0].validation == 'error'){
                    jQuery('.js-filters-notify').html('<span class="c-error">'+data[0].message+'</span></div>');
                }else{
                    if(data[0].total > 0){
                        jQuery('.js-filters-notify').html('<span class="c-'+data[0].validation+'">'+data[0].message+'</span>');
                        jQuery('.js-filters-results').html('').append(data[0].content);

                        if( jQuery('.js-load-more').length && data[0].total > ppp ){

                            $data_item.data('paged','1');
                            $data_item.data('total', data[0].total);
                            $data_item.data('cats', data[0].cats.toString());
                            $data_item.data('tags', data[0].tags);
                            $data_item.data('slug', pt_slug);

                        }else if( jQuery('.js-load-more').length && data[0].total <= ppp ){

                            jQuery('.js-load-more').remove();

                        }else if( jQuery('.js-load-more').length == 0 && data[0].total > ppp ){

                            $data_item.html('<button type="button" class="c-button c-button--cta js-load-more"><div class="icon-plus c-button__icon"></div><span>En voir plus</span></button>');
                            $data_item.data('paged','1');
                            $data_item.data('total', data[0].total);
                            $data_item.data('cats', data[0].cats.toString());
                            $data_item.data('tags', data[0].tags);
                            $data_item.data('slug', pt_slug);
                            initLoadMore();

                        }else{ 
                            // Error
                        }

                        if ( jQuery('.js-filter.is-active').length ) {
                            jQuery('.js-reset-filters').removeClass('is-none');
                        } else {
                            jQuery('.js-reset-filters').addClass('is-none');
                        }

                    }else{
                        jQuery('.js-filters-notify').html('<span class="c-error">'+data[0].message+'</span>');
                    }
                }
                $btnIcon.removeClass('anim-spin');
            },
            error : function(jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                $btnIcon.removeClass('anim-spin');
            }

        });
        return false;
    });

    // OPEN FILTER PANEL

    jQuery('.js-toggle-filters').on('click', function() {
        jQuery('.js-filters').toggleClass('is-open');

        if ( jQuery(this).hasClass('is-visible') ) {
            show_filters();
        }
    });

    // CLIC FILTER 

    jQuery('.js-filter').on('click', function(e) {
        if ( e.target.tagName == 'LABEL' ) {
            jQuery(this).toggleClass('is-active');
            setTimeout(function(){
                jQuery('#form-filter-posts').submit();
            }, 100);
        }
    })

    // RESET 

    jQuery('.js-reset-filters').on('click', function() {
        jQuery('.js-filter').removeClass('is-active');
        setTimeout(function(){
            jQuery('#form-filter-posts').submit();
        }, 100);
    })

    // REMINDER

    jQuery('.js-show-reminder').waypoint(function(direction) {
        if ( direction == 'down' ) {
            jQuery('.js-toggle-filters').addClass('is-visible');
        } else {
            jQuery('.js-toggle-filters').removeClass('is-visible');
        }
    }, {offset: '20%'});
}

function show_filters() {
    var posY = jQuery('.js-filters').offset().top;
    jQuery('body').animate({scrollTop: posY}, 250);
    jQuery('#header').addClass('is-off');
    jQuery('.js-toggle-filters').removeClass('is-visible');
}
