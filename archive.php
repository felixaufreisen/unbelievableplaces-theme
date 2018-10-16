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

<header class="archive">
	<div class="cover">
		<?php do_action( 'unbelievable_loader' ) ?>
		<?php do_action( 'get_unbelievable_map', '5' ) ?>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="title">
					<h1 class="page-title display-4"><?php single_cat_title( ); ?></h1>
					<div class="archive-description"><?php the_archive_description( ); ?></div>
				</div>
			</div>
		</div>
	</div>
</header><!-- .page-header -->

<div class="container-fluid">
	<div class="row">

	<div id="primary" class="content-area col-lg-8">
		<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="thumbnail">
							<a href="<?php the_permalink() ?>">
								<?php the_post_thumbnail( 'category-thumb' ) ?>
							</a>
						</div><!-- .thumbnail -->
						<div class="content-wrap">
							<header class="content-header">
								<div class="title">
									<h2 class="entry-title">
										<a href="<?php the_permalink() ?>">
											<?php the_title( ) ?>
										</a>
									</h2>
								</div><!-- .title -->
								<div class="content-meta">
									<?php
									$cats = get_the_category();
									$cat_name = $cats[0]->name;
							   		$cat_id = $cats[0]->ID;
									?>
									<span class="category">
										<a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>">
											<?php echo esc_html( $cat_name ) ?>
										</a>
									</span>
									<time datetime="<?php echo get_the_date( 'c' ) ?>">
										<?php echo get_the_date( 'j F Y' ); ?>
									</time>
									<span class="comments">
										<?php comments_number() ?>
									</span>
								</div><!-- .category -->
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
							<div class="read-more-wrap">
								<a href="<?php the_permalink() ?>" class="read-more">Weiterlesen</a>
							</div>
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
