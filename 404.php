<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Unbelievable_Places
 */

get_header();
?>

	<div class="container-fluid">
		<div class="row">

			<section class="col-4 display-1 html-errorcode">
				404
			</section>

			<section class="col-8 error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'unbelievable-places' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'unbelievable-places' ); ?></p>

					<ul>
						<li> <a href="#" class="go-back"><?php esc_html_e('Go to Previous Page', 'unbelievable-places'); ?></a></li>
						<li> <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Go to Homepage', 'unbelievable-places'); ?></a></li>
					</ul>

					<div class="error-search">
						<?php get_search_form(); ?>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

<?php
get_footer();
