<?php

/* | CPT & TAXONOMY - V1.0 - 00/00/00 | 
-------------------------------------------------------
   | create_cpts()
   |
*/

if ( CUSTOM_POST_TYPE ) {
	// CPT 
	function create_cpts() {
		// Don
		$labels_dons = array(
			'name' => __( 'Dons', '' ),
			'singular_name' => __( 'Don', '' ),
			);

		$args_don = array(
			'label' 				=> __( 'Dons', '' ),
			'labels' 				=> $labels_dons,
			'description' 			=> '',
			'public' 				=> true,
			'show_ui' 				=> true,
			'show_in_rest' 			=> false,
			'rest_base' 			=> '',
			'has_archive' 			=> false,
			'show_in_menu' 			=> true,
			'exclude_from_search' 	=> false,
			'capability_type' 		=> 'post',
			'map_meta_cap' 			=> true,
			'hierarchical' 			=> false,
			'rewrite' 				=> array( 'slug' => 'dons', 'with_front' => true ),
			'query_var' 			=> true,

			'supports' 				=> array( 'title', 'author' ),
			'taxonomies' 			=> array( ),
		);
		register_post_type( 'dons', $args_don );


	}
	add_action( 'init', 'create_cpts' );


}


if ( CUSTOM_TAXONOMY ) {
	//fluxi_register_custom_taxo('filtres', 'Filtres', array('offres-emploi'), false);
}