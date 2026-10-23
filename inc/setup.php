<?php
/**
 * Theme supports, image sizes and head output.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and image sizes.
 *
 * @return void
 */
function ta_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	add_image_size( 'ta-offer-card', 800, 600, true );
}
add_action( 'after_setup_theme', 'ta_setup' );

/**
 * Output the favicon from the theme (the WordPress Site Icon is not used).
 *
 * @return void
 */
function ta_favicon() {
	$url = ta_image_url( 'favicon.png' );

	if ( ! $url ) {
		return;
	}

	printf( '<link rel="icon" type="image/png" sizes="512x512" href="%s">' . "\n", esc_url( $url ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $url ) );
}
add_action( 'wp_head', 'ta_favicon', 5 );
add_action( 'admin_head', 'ta_favicon', 5 );
remove_action( 'wp_head', 'wp_site_icon', 99 );

/**
 * Swap the html "no-js" class for "js" before the page paints.
 *
 * Safety net: if main.js has not started within 3s (blocked or failed), "ta-motion-off"
 * cancels the hidden reveal state so no content stays invisible.
 *
 * @return void
 */
function ta_js_class() {
	wp_print_inline_script_tag( "(function(d){d.classList.replace('no-js','js');setTimeout(function(){d.classList.contains('ta-motion')||d.classList.add('ta-motion-off');},3000);})(document.documentElement);" );
}
add_action( 'wp_head', 'ta_js_class', 1 );

/**
 * Theme color for mobile browser UI.
 *
 * @return void
 */
function ta_theme_color() {
	echo '<meta name="theme-color" content="#096c8d">' . "\n";
}
add_action( 'wp_head', 'ta_theme_color', 2 );
