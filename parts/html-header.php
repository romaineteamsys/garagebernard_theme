<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="fr"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="fr"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="fr"><![endif]-->
<!--[if lte IE 8]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="fr_BE"><!--<![endif]-->
	<head>
		<?php global $wp; $url = home_url(add_query_arg(array(),$wp->request)); ?>
		<title><?php wp_title(''); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#33516B">
    <?php wp_head(); ?>

		<?php 
			$analytics = get_field('analytics', 'option');
			if($analytics) {
				echo $analytics;
			}
		?>

	</head>
	<body <?php body_class(); ?>>

	<div id="global">

		<div class="main-content">  
