<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title(); ?> RT-VUE Theme</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-85987965-1', 'auto');
	ga('send', 'pageview');

	</script>
	<?php wp_head(); ?>
</head>
<body  <?php body_class() ?> >


	<div id="content" class="site-content" style="display:none">

	<?php

	if ( have_posts() ) {

		if ( is_home() && ! is_front_page() ) {
			echo '<h1>' . single_post_title( '', false ) . '</h1>';
		}

		while ( have_posts() ) {

			the_post();

			if ( is_singular() ) {
				the_title( '<h1>', '</h1>' );
			} else {
				the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
			}

			the_content();
		}
	}

	?>

	</div>

	<div id="app"></div>

	<?php wp_footer(); ?>

</body>
</html>
