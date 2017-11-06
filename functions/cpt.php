<?php

/* | CPT & TAXONOMY - V1.0 - 00/00/00 | 
-------------------------------------------------------
   | create_cpts()
   |
*/

if ( CUSTOM_POST_TYPE ) {
	// CPT 
	function create_cpts() {
		// Outil
		$labels_outil = array(
			'name' => __( 'Outils', '' ),
			'singular_name' => __( 'Outil', '' ),
			);

		$args_outil = array(
			'label' 				=> __( 'Outils', '' ),
			'labels' 				=> $labels_outil,
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
			'rewrite' 				=> array( 'slug' => 'outils', 'with_front' => true ),
			'query_var' 			=> true,

			'supports' 				=> array( 'title', 'author' ),
			'taxonomies' 			=> array( 'category', 'post_tag' ),
		);
		register_post_type( 'outils', $args_outil );


	}
	//add_action( 'init', 'create_cpts' );


}


if ( CUSTOM_TAXONOMY ) {
	//fluxi_register_custom_taxo('filtres', 'Filtres', array('offres-emploi'), false);
}