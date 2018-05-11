<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Unbelievable_Places
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function unbelievable_places_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'unbelievable_places_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function unbelievable_places_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'unbelievable_places_pingback_header' );

/**
 * Generate container for embedded map
 */
function unbelievable_places_map( $set_lat, $set_lng, $set_zoom ) {
	// Init
	$a = [];
	$locations = [];
	$settings = [];
	// The Loop
	$args = array( 'post_type' => 'post' );
	$my_query = new WP_Query( $args );
	while($my_query->have_posts()) : $my_query->the_post();
		$lat = get_post_meta( get_the_ID(),'lat',true );
		$lng = get_post_meta( get_the_ID(),'lng',true );
		// Map Content
		if ( ($lat > 0) && ($lng > 0) ) {
			$cats = get_the_category();
			$category = $cats[0]->name;
			$date = get_the_date();
			$title = get_the_title();
			$link = get_the_permalink();
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'medium' );
			$a = array("lat"		=>	(float)$lat,
						 "lng"		=>	(float)$lng,
						 "category"	=>	$category,
						 "date"		=>	$date,
						 "title"		=>	$title,
						 "link"		=>	$link,
						 "thumbnail"	=>	$thumbnail,
						 "color"		=>	"#fd7e14"
						);
			array_push($locations,$a);
		}
	endwhile;
	// Map Settings
	$settings = array(	"lat"	=>	(float)$set_lat,
											"lng"	=>	(float)$set_lng,
											"zoom"	=>	(float)$set_zoom
										);
	// Generate Output String
	$html = "<div id=\"map\" class=\"embed-responsive embed-responsive-16by9\"
		 data-settings='" . esc_attr(json_encode( $settings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )) . "'
		 data-locations='" . esc_attr(json_encode( $locations, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )) . "'>
	</div>";

	echo $html;
}
add_action( 'get_unbelievable_map', 'unbelievable_places_map', 10 , 3 );

/**
 * Show related posts
**/
function unbelievable_places_related_posts( ) {
	$orig_post = $post;
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>3,
			'caller_get_posts'=>1,
			'orderby'=>'rand'
		);

		$my_query = new WP_Query( $args );
		if( $my_query->have_posts() ) { ?>

			<div class="related-posts">
				<div class="title"><h3>Ähnliche Beiträge</h3></div>
				<div class="related-posts-wrap">

					<?php
					while($my_query->have_posts()) : $my_query->the_post();
					?>

						<article>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
							<div class="related-title">
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="related-meta">
								<span class="meta"><?php the_date(); ?></span>
							</div>
						</article>

					<?php endwhile; ?>

				</div> <!-- .related-posts-wrap -->
			</div> <!-- .related-posts -->
		<?php
		}
	}
	$post = $orig_post;
	wp_reset_query();
}
add_action( 'show_unbelievable_related_posts', 'unbelievable_places_related_posts' );

function unbelievable_places_comments($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}?>
		<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
		if ( 'div' != $args['style'] ) { ?>
			<div id="comment-<?php comment_ID() ?>" class="comment-wrap"><?php
		} ?>

				<div class="comment-body">
					<div class="comment-meta">
						<cite class="fn"><?php comment_author_link(); ?></cite>
						<div class="comment-date"><?php comment_date(); ?></div>
					</div>
					<div class="comment-text">
						<?php comment_text(); ?>
					</div>
				</div>

<?php
	if ( $comment->comment_approved == '0' ) { ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
	} ?>

	<div class="comment-reply"><?php
	comment_reply_link(
		array_merge(
			$args,
			array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth']
			)
			)
		); ?>
	</div><?php
	if ( 'div' != $args['style'] ) : ?>
	</div><?php
	endif;
}

/**
 * Add custom thumbnail sizes
 * https://developer.wordpress.org/reference/functions/add_image_size/
**/
function unbelievable_places_thumbnails() {
    add_image_size( 'category-thumb', 600, 600, true ); 
}
add_action( 'after_setup_theme', 'unbelievable_places_thumbnails' );
