<?php

/* | CONFIG & PARAMS - V1.0 - 00/00/00 | 
-------------------------------------------------------
   | 
*/

// DEV
if ( !defined(THEME_DIR_NAME) ) { define('THEME_DIR_NAME', 'zerowaste'); }
if ( !defined(THEME_DIR_PATH) ) { define('THEME_DIR_PATH', get_template_directory_uri()); }
if ( !defined(__ROOT__) ) { define('__ROOT__', dirname(dirname(__FILE__))); }
if ( !defined(DEV) ) { define('DEV', true); }
if ( !defined(ADMIN_STYLE) ) { define('ADMIN_STYLE', false); }
if ( !defined(EDITOR_STYLE) ) { define('EDITOR_STYLE', false); }

// VALUES

if ( !defined(POST_EXCERPT_LENGTH) ) { define('POST_EXCERPT_LENGTH', 40); }
if ( !defined(GOOGLE_ANALYTICS_ID) ) { define('GOOGLE_ANALYTICS_ID', ''); }
if ( !defined(GOOGLE_MAP_API_KEY) ) { define('GOOGLE_MAP_API_KEY', ''); }
/* ACF Google Maps */
function wpc_acf_init() {
	acf_update_setting('google_api_key', GOOGLE_MAP_API_KEY);
}
add_action('acf/init', 'wpc_acf_init');

// SLIMP
if ( !defined(CREDITOR_REF) ) { define('CREDITOR_REF', 'hbil7wmezce4'); }
if ( !defined(API_KEY) ) { define('API_KEY', 'hbil7wmezce4'); }
if ( !defined(SECR_KEY) ) { define('SECR_KEY', 't8lWqtLCz4hdre~lSNH2pIb3V1r8DAQhUDvX'); }

if ( !defined(RETURN_AFTER_URL) ) { define('RETURN_AFTER_URL', 32); }
if ( !defined(NOTIFICATION_URL) ) { define('NOTIFICATION_URL', 20); }

// LINKS

if ( !defined(FACEBOOK) ) { define('FACEBOOK', 'https://www.facebook.com/'); }
if ( !defined(TWITTER) ) { define('TWITTER', 'https://twitter.com/'); }


// MAILS

if ( !defined(CONTACT_GENERAL) ) { define('CONTACT_GENERAL', 'rollandyann@gmail.com'); }
if ( !defined(CONTACT_GENERAL_2) ) { define('CONTACT_GENERAL_2', 'thibaut.caroli.pro@gmail.com'); }


// ACTIVATE

if ( !defined(PAGE_EXCERPT) ) { define('PAGE_EXCERPT', false); }
if ( !defined(PAGE_TAXO) ) { define('PAGE_TAXO', false); }
if ( !defined(ADD_THUMBNAILS) ) { define('ADD_THUMBNAILS', false); }
if ( !defined(CUSTOM_POST_TYPE) ) { define('CUSTOM_POST_TYPE', true); }
if ( !defined(CUSTOM_TAXONOMY) ) { define('CUSTOM_TAXONOMY', true); }
if ( !defined(ACF_OPTION_PAGE) ) { define('ACF_OPTION_PAGE', true); }
if ( !defined(DISALLOW_FILE_EDIT) ) { define('DISALLOW_FILE_EDIT', true); }


/*
Add excerpt to pages
*/

if ( PAGE_EXCERPT ) {
	function add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'add_excerpts_to_pages' );
}


/*
Add WP core taxonomy to pages
*/

if ( PAGE_TAXO ) {
	function add_taxo_to_pages() {
		register_taxonomy_for_object_type( 'category', 'page' );
	}
	add_action( 'init', 'add_taxo_to_pages' );
}


/*
Add post thumbnail
*/

if ( ADD_THUMBNAILS ) {
	function add_post_thumb() {
		add_theme_support( 'post-thumbnails', array('post','page') );
	}
	add_action('after_setup_theme', 'add_post_thumb');
}


/*
EXCERPT LENGHT
*/

function custom_excerpt_length($length) {
  return POST_EXCERPT_LENGTH;
}
add_filter('excerpt_length', 'custom_excerpt_length');


/*
Activate ACF option page
*/

if ( ACF_OPTION_PAGE && function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page(array(
		'page_title'    => 'Options',
		'menu_title'    => 'Options',
		'menu_slug'     => 'options-generales',
		'capability'    => 'edit_posts',
		'redirect'      => true
	));

	/*acf_add_options_sub_page(array(
		'page_title'    => 'Formulaires',
		'menu_title'    => 'Formulaires',
		'menu_slug'     => 'formulaires',
		'parent_slug'   => $parent['menu_slug'],
	));*/
}


