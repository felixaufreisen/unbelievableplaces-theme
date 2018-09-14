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
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'unbelievable-places' ); ?></a>

		<header id="masthead" class="site-header">
			<nav <?php do_action( 'get_unbelievable_nav_setup' ) ?>>
				<div class="container-fluid">
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Felix auf Reisen</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Menü öffnen">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<?php
					wp_nav_menu( array(
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => 'div',
						// 'container_class'   => 'collapse navbar-collapse',
						// 'container_id'      => 'navbarNavDropdown',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
						'walker'            => new WP_Bootstrap_Navwalker()
					) );
					?>
					<ul class="navbar-nav social">
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="fab fa-facebook-square" aria-hidden></i><span class="sr-only">Facebook</span></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="fab fa-youtube-square" aria-hidden></i><span class="sr-only">YouTube</span></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="fab fa-instagram" aria-hidden></i><span class="sr-only">Instagram</span></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="fab fa-pinterest-square" aria-hidden></i><span class="sr-only">Pinterest</span></a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link"><i class="fab fa-twitter-square" aria-hidden></i><span class="sr-only">Twitter</span></a>
						</li>
						<li class="nav-item">
							<a onclick="openSearch()" class="nav-link pointer"><i class="fas fa-search" aria-hidden></i><span class="sr-only">Suche</span></a>
						</li>
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
