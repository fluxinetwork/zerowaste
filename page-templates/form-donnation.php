<?php /* Template Name: Formulaire de don */ ?>
<?php acf_form_head();
	function my_kses_post( $value ) {
		if( is_array($value) ) {
			return array_map('my_kses_post', $value);
		}
		return wp_kses_post( $value );
	}
	add_filter('acf/update_value', 'my_kses_post', 10, 1);
?>

<?php get_header(); ?>

<div class="l-row">

	<div class="l-col l-col--content mgnBottom--l">
		
		<h2><?php echo get_the_title(); ?></h2>
		
		<?php

		  	if ( have_posts() ) :
		    	while ( have_posts() ) : the_post();	

					the_content();
					
					$settings_acf_form_add = array(
						'post_id' 		=> 'new_post',
						'new_post'		=> array(
							'post_type'		=> 'dons',
							'post_status'	=> 'draft',
						),
						'uploader' => 'basic',
						'updated_message' => __("Votre don a était ajouté.", 'acf'),
						'html_updated_message'	=> '<div id="message" class="updated"><p>%s</p></div>',						
						'html_after_fields' => '<input type="hidden" id="is_adding_don" name="is_adding_don" value="yes">',
						'field_groups' => array('group_597b30139d914'),
						'submit_value'	=> 'Envoyer',
						'html_submit_button'	=> '<input type="submit" value="%s" />',
						'html_submit_spinner'	=> '<span class="acf-spinner"></span>'
					);
					acf_form($settings_acf_form_add);					

		    	endwhile;

		  	else:

		      	get_template_part( 'page-templates-parts/content', 'none' );

		  	endif;

		?>

	</div>

</div>

<?php get_footer(); ?>
