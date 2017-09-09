<?php /* Template Name: Formulaire de don récurrent virement SEPA avec premier paiement */ ?>
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
					
					{
					    "mode": "iframeembedded",
					    "content": "PGlmcmFtZSBzcmM9Imh0dHBzOi8vc2xpbXBheS5uZXQvY2hlY2tvdXQvdXNlckFwcHJvdmFsP2FjY2Vzc0NvZGU9c3BpSzRGU01LM0h4WjkweThBejdLOG5FV3oyZ05TNXA5N0drQTAwWThobTl2QVM5QlAzMm1NNXRLN2xoRGcmYW1wO21vZGU9aWZyYW1lX2VtYmVkZGVkIiBzdHlsZT0id2lkdGg6IDEwMCU7IGhlaWdodDogMTAwJTsgbWluLWhlaWdodDogMzIwcHg7IGJvcmRlcjogbm9uZTsiPjwvaWZyYW1lPg=="
					}			

		    	endwhile;

		  	else:

		      	get_template_part( 'page-templates-parts/content', 'none' );

		  	endif;

		?>

	</div>

</div>

<?php get_footer(); ?>
