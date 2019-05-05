<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Unbelievable_Places
 */

?>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6192031426766834",
          enable_page_level_ads: true
     });
</script>

<header class="cover" id="post">
	<?php the_post_thumbnail( 'full' ); ?>

	<div class="cover-title">
		<div class="entry-content-wrap">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title display-4">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta-wrap">
					<div class="entry-meta">
						<?php
							$cats = get_the_category();
							$cat_name = $cats[0]->name;
							$cat_id = get_cat_ID( $cat_name );
						?>
						<span>Am <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date( 'j F Y' ); ?></time> in
							<a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>">
								<?php echo esc_html( $cat_name ) ?>
							</a>.
						</span>
					</div>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</div><!-- .entry-content-wrap -->
	</div><!-- .cover-title -->
</header><!-- .cover -->

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'unbelievable-places' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'unbelievable-places' ),
					'after'  => '</div>',
				) );
				?>

				<footer class="entry-footer">
					<?php unbelievable_places_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->
