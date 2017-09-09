<?php /* Template Name: Notifications Slimpay */ ?>
<?php
	// HTTP Client	
	require_once(__ROOT__.'/app/httpclient/autoload.php'); 
?>

<?php get_header(); ?>

	<header class="l-col">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>

	<?php 
		if( isset($_GET['message']) ):
			$message = base64_decode($_GET['message']);
			echo $message;

		endif;
	?>

<?php get_footer(); ?>

