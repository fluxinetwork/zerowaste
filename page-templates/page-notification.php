<?php /* Template Name: Notifications Slimpay */ ?>
<?php
	// HTTP Client	
	//require_once(__ROOT__.'/app/httpclient/autoload.php'); 
?>

<?php get_header(); ?>

	<header class="l-col">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>

	<?php 
		/*$body = file_get_contents('php://input');
		$order = \HapiClient\Hal\Resource::fromJson($body);*/
	?>

<?php get_footer(); ?>

