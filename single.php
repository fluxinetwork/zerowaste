<?php

get_header(); 

echo '<article>';

	if ( have_posts() ) :

		while ( have_posts() ) : the_post();   

			if ( is_singular('post') ) {

				get_template_part( 'page-templates-parts/content', 'single' );

			} else if ( is_singular('cpt') ) {

				get_template_part( 'page-templates-parts/content', 'cpt' );
				
			}

		endwhile;

	else:

  		get_template_part( 'page-templates-parts/content', 'none' );

	endif;

echo '</article>';

get_footer();

?>