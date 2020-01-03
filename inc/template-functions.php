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
 * Generate social-wrap for embedded map
 */
function unbelievable_places_map( $set_zoom ) {
	// Init
	$has_locations = false;
	$a = [];
	$lats = [];
	$lngs = [];
	$locations = [];
	$settings = [];
	$args = array(
		'post_type' => 'post',	// Show only published posts
		'posts_per_page' => -1 // Don't limit number of posts
	);
	// in category and tag archives show only matching posts
	if ( is_category() || is_tag() ) {
		if ( is_category() ) :
			$archive_type = "category_name";
		elseif ( is_tag() ) :
			$archive_type = "tag";
		endif;
		$a = array( $archive_type => single_cat_title( '', false ) );
		$args = array_merge( $args, $a );
	}
	// Start the WP_Query
	$my_query = new WP_Query( $args );
	while( $my_query->have_posts()) : $my_query->the_post();
		$lat = get_post_meta( get_the_ID(),'lat',true );
		$lng = get_post_meta( get_the_ID(),'lng',true );
		// Map Content
		if ( ($lat != null) && ($lng != null) ) {
			$has_locations = true;
			$cats = get_the_category();
			$category = $cats[0]->name;
			$date = get_the_date();
			$title = get_the_title();
			$link = get_the_permalink();
			$thumbnail = get_the_post_thumbnail( get_the_ID(), 'medium' );
			$a = array("lat"		=>	(float)$lat,
						 "lng"				=>	(float)$lng,
						 "category"		=>	$category,
						 "date"				=>	$date,
						 "title"			=>	$title,
						 "link"				=>	$link,
						 "thumbnail"	=>	$thumbnail,
						 "color"			=>	"#fd7e14"
						);
			array_push( $locations, $a );
			array_push( $lats, (float)$lat );
			array_push( $lngs, (float)$lng );
		}
	endwhile;

	// Show map only if there is at least one relevant post
	if ( $has_locations ) {
		// Add necesary scripts to the document
		wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDfeSGX0ncacK27wP8HIiQBk-Z8498QBmY&callback=initMap', array(), '', true );
		wp_enqueue_script( 'google-maps-infobox', get_template_directory_uri() . '/js/infobox.js', array(), '', true );

		// Calculate lat center
		$min_lat = min( $lats );
		$max_lat = max( $lats );
		$range_lat = $max_lat - $min_lat;
		$center_lat = $min_lat + ( $range_lat / 2 );
		// Calculate lng center
		$min_lng = min( $lngs );
		$max_lng = max( $lngs );
		$range_lng = $max_lng - $min_lng;
		$center_lng = $min_lng + ( $range_lng / 2 );

		// Map Settings
		$settings = array(	"lat"	=>	(float)$center_lat,
												"lng"	=>	(float)$center_lng,
												"zoom"	=>	(float)$set_zoom
											);

		// Generate Output String
		$html = "<div id=\"map\" class=\"embed-responsive embed-responsive-16by9\"
			 data-settings='" . esc_attr(json_encode( $settings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )) . "'
			 data-locations='" . esc_attr(json_encode( $locations, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )) . "'>
		</div>";
	} else { // Wenn keine Datenpunkte in Karte, dann Standardbild zeigen
		$html = "<div id=\"nomap\"><img src=\"https://www.felixaufreisen.de/images/DSC01346.jpg\" alt=\"Blaue Grotte auf Malta\" data-pin-nopin=\"true\"></div>";
	}

	echo $html;
}
add_action( 'get_unbelievable_map', 'unbelievable_places_map', 10 , 1 );

// Subcategories for menu
function unbelievable_places_subcats( $parent ) {
	$cat_id = get_cat_ID( $parent );
	if ( $cat_id > 0 ) {
		echo '<p class="h6"><a href="' . get_category_link( $cat_id ) . '">' . $parent . '</a></p>';
		echo '<ul>';
		$args = array(
			'parent' => $cat_id,
			'orderby' => 'name',
			'order' => 'ASC'
		);
		$categories = get_categories( $args );
		foreach($categories as $category) {
			echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name.'</a></li>';
		}
		echo '</ul>';
	}
}
add_action( 'get_unbelievable_subcats', 'unbelievable_places_subcats' );

/**
 * Show related posts
**/
function unbelievable_places_related_posts( ) {
	global $post;
	$orig_post = $post;
	$tags = wp_get_post_tags( $post->ID );
	$cats = wp_get_post_categories( $post->ID );
	// get the IDs of the tags
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

	// setup the query args
	$args=array(
		// exclude the post itself
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 3,
		'orderby'=>'rand',
		// Match posts with same categories OR tags
		'tax_query'=>array(
			'relation' => 'OR',
			array(
				'taxonomy' 	=> 'post_tag',
				'field' 		=> 'term_id',
				'terms' 		=> $tag_ids
			),
			array(
				'taxonomy' 	=> 'category',
				'field' 		=> 'term_id',
				'terms' 		=> $cats
			)
		 )
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

function unbelievable_places_loader() { ?>
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">
				<div class="object" id="object-1"></div>
				<div class="object" id="object-2" style=""></div>
				<div class="object" id="object-3" style=""></div>
				<div class="object" id="object-4" style=""></div>
				<div class="object" id="object-5" style=""></div>
			</div>
		</div>
	</div>
<?php
}
add_action( 'unbelievable_loader', 'unbelievable_places_loader');

function unbelievable_places_share() {
	$link = rawurlencode(get_the_permalink());
	$title = rawurlencode(get_the_title()); ?>

	  <div id="share">
	    <a href="https://twitter.com/home?status=<?php echo $title; ?>%20<?php echo $link; ?>" class="social-wrap twitter" rel="nofollow" target="_blank">
	      <svg  preserveAspectRatio="xMinYMin meet" viewBox="0 0 200 200" class="circle">
	         <circle cx="100" cy="100" r="50"/>
	      </svg>
	      <div class="social">
	        <i class="fab fa-twitter"></i>
	      </div>
	    </a>
	    <a href="https://www.facebook.com/sharer.php?u=<?php echo $link; ?>&amp;t=<?php echo $title; ?>" class="social-wrap facebook" rel="nofollow" target="_blank">
	      <svg  preserveAspectRatio="xMinYMin meet" viewBox="0 0 200 200" class="circle">
	         <circle cx="100" cy="100" r="50"/>
	      </svg>
	      <div class="social">
	        <i class="fab fa-facebook-f"></i>
	      </div>
	    </a>
	    <a href="http://pinterest.com/pin/create/button/?url=<?php echo $link; ?>" class="social-wrap pinterest" rel="nofollow" target="_blank" data-pin-custom="true">
	      <svg  preserveAspectRatio="xMinYMin meet" viewBox="0 0 200 200" class="circle">
	         <circle cx="100" cy="100" r="50"/>
	      </svg>
	      <div class="social">
	        <i class="fab fa-pinterest-p"></i>
	      </div>
	    </a>
	    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;title=<?php echo $title; ?>&amp;url=<?php echo $link; ?>" class="social-wrap linkedin" rel="nofollow" target="_blank">
	      <svg  preserveAspectRatio="xMinYMin meet" viewBox="0 0 200 200" class="circle">
	         <circle cx="100" cy="100" r="50"/>
	      </svg>
	      <div class="social">
	        <i class="fab fa-linkedin-in"></i>
	      </div>
	    </a>
			<a href="mailto:?subject=<?php echo rawurlencode(get_the_title()); ?>&amp;body=<?php echo rawurlencode(get_the_permalink()); ?>" class="social-wrap email" rel="nofollow" target="_blank">
	      <svg  preserveAspectRatio="xMinYMin meet" viewBox="0 0 200 200" class="circle">
	         <circle cx="100" cy="100" r="50"/>
	      </svg>
	      <div class="social">
					<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="envelope-open" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-envelope-open fa-w-16" style=""><path fill="currentColor" d="M494.586 164.516c-4.697-3.883-111.723-89.95-135.251-108.657C337.231 38.191 299.437 0 256 0c-43.205 0-80.636 37.717-103.335 55.859-24.463 19.45-131.07 105.195-135.15 108.549A48.004 48.004 0 0 0 0 201.485V464c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V201.509a48 48 0 0 0-17.414-36.993zM464 458a6 6 0 0 1-6 6H54a6 6 0 0 1-6-6V204.347c0-1.813.816-3.526 2.226-4.665 15.87-12.814 108.793-87.554 132.364-106.293C200.755 78.88 232.398 48 256 48c23.693 0 55.857 31.369 73.41 45.389 23.573 18.741 116.503 93.493 132.366 106.316a5.99 5.99 0 0 1 2.224 4.663V458zm-31.991-187.704c4.249 5.159 3.465 12.795-1.745 16.981-28.975 23.283-59.274 47.597-70.929 56.863C336.636 362.283 299.205 400 256 400c-43.452 0-81.287-38.237-103.335-55.86-11.279-8.967-41.744-33.413-70.927-56.865-5.21-4.187-5.993-11.822-1.745-16.981l15.258-18.528c4.178-5.073 11.657-5.843 16.779-1.726 28.618 23.001 58.566 47.035 70.56 56.571C200.143 320.631 232.307 352 256 352c23.602 0 55.246-30.88 73.41-45.389 11.994-9.535 41.944-33.57 70.563-56.568 5.122-4.116 12.601-3.346 16.778 1.727l15.258 18.526z" class=""></path></svg>
	      </div>
	    </a>
	  </div>
<?php
}
add_action( 'unbelievable_share', 'unbelievable_places_share' );
