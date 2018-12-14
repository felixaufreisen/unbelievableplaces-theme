<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Unbelievable_Places
*/

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M3T46PJ');</script>
	<!-- End Google Tag Manager -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3T46PJ"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div id="page" class="site">
		<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'unbelievable-places' ); ?></a>

		<header id="masthead" class="site-header">
			<nav <?php // do_action( 'get_unbelievable_nav_setup' ) ?> class="navbar navbar-expand-lg navbar-light">
				<div class="container-fluid">
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Felix auf Reisen</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Menü öffnen">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown" id="travelreports">
							<a class="nav-link dropdown-toggle" data-target="#" href="<?php echo esc_url( home_url( '/' ) ); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          			Reiseberichte
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<div class="row">
									<div class="col-md-2">
										<?php do_action( 'get_unbelievable_subcats', 'Europa' ) ?>
									</div>
									<div class="col-md-2">
										<?php do_action( 'get_unbelievable_subcats', 'Afrika' ) ?>
									</div>
									<div class="col-md-2">
										<?php do_action( 'get_unbelievable_subcats', 'Naher Osten' ) ?>
									</div>
									<div class="col-md-6">
										<p class="h6">Bisher besuchte Länder</p>
										<div id="travelmap" style="position: relative; width: 100%; height: 300px;"></div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a href="https://www.felixaufreisen.de/reisetipps/" class="nav-link">Reisetipps</a>
						</li>
					</ul>
					<ul class="navbar-nav social">
						<li class="nav-item">
							<a href="https://www.facebook.com/felixaufreisen.de/" class="nav-link" target="_blank"><i class="fab fa-facebook-square" aria-hidden></i><span class="sr-only">Facebook</span></a>
						</li>
						<li class="nav-item">
							<a href="https://www.youtube.com/channel/UCWGkKJFLpjgsGG36S2feycw" class="nav-link" target="_blank"><i class="fab fa-youtube-square" aria-hidden></i><span class="sr-only">YouTube</span></a>
						</li>
						<li class="nav-item">
							<a href="https://www.instagram.com/felixaufreisen.de/" class="nav-link" target="_blank"><i class="fab fa-instagram" aria-hidden></i><span class="sr-only">Instagram</span></a>
						</li>
						<li class="nav-item">
							<a href="https://www.pinterest.de/felixaufreisen/" class="nav-link" target="_blank"><i class="fab fa-pinterest-square" aria-hidden></i><span class="sr-only">Pinterest</span></a>
						</li>
						<!-- <li class="nav-item">
							<a href="#" class="nav-link"><i class="fab fa-twitter-square" aria-hidden></i><span class="sr-only">Twitter</span></a>
						</li> -->
						<!-- <li class="nav-item">
							<a onclick="openSearch()" class="nav-link pointer"><i class="fas fa-search" aria-hidden></i><span class="sr-only">Suche</span></a>
						</li> -->
					</ul>
					</div>
				</div>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->

		<div id="myOverlay" class="overlay nav-link">
		  <span class="closebtn" onclick="closeSearch()" aria-label="Schließen" aria-hidden="true"><i class="fas fa-times"></i></span>
			<form action="" methos="get">
			  <input type="search" placeholder="Wie kann ich dir weiterhelfen?" name="s" class="form-control" id="searchInput">
				<button type="submit" class="btn btn-secondary btn-lg">Suche <i class="fas fa-search"></i></button>
			</form>
		</div>

		<div id="content" class="site-content">
