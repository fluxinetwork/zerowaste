<!DOCTYPE html>
<html lang="<?php echo get_locale() ?>">	
<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	<?php
		$fluxi_excerpt = get_field('extrait', false, false);
		if ($fluxi_excerpt) {
			echo '<meta name="description" content="'.$fluxi_excerpt.'">';
		} else {
			echo '<meta name="description" content="'.get_bloginfo('description').'">';
		}
	?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title><?php get_template_part( 'page-templates-parts/base/title'); ?></title>
	
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?> >

	<div id="global">

		<?php get_template_part( 'page-templates-parts/base/header'); ?>

		<div id="main" role="main">