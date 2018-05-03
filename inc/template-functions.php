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
			$thumbnail = get_the_post_thumbnail_url();
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
