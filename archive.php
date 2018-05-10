<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Unbelievable_Places
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); 
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
					<div class="thumbnail">
						<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail( 'medium' ) ?>
						</a>
					</div><!-- .thumbnail -->
					<div class="content-wrap">
						<header class="content-header">
							<div class="category">
								<?php
								$cats = get_the_category();
								$cat_name = $cats[0]->name;
						   		$cat_id = $cats[0]->ID;
								?>
								<a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>">
									<?php echo esc_html( $cat_name ) ?>
								</a>
							</div><!-- .category -->
							<div class="title">
								<h2 class="entry-title">
									<a href="<?php the_permalink() ?>">
										<?php the_title( ) ?>
									</a>
								</h2>
							</div><!-- .title -->
						</header>
						<div class="content">
							<?php
							/*
							 *
							 * If post has More-Tag use it, if not show the excerpt
							 *
							 */
							    if( strpos( $post->post_content, '<!--more-->' ) ) {
								the_content( '', true );
							    }
							    else {
								the_excerpt();
							    }
							?>
						</div><!-- .content -->
					</div><!-- .content-wrap -->
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
