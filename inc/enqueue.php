<?php
/**
 * Styles, scripts and fonts.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version string for a theme asset, based on its modification time.
 *
 * @param string $path Path relative to the theme root.
 * @return string
 */
function ta_asset_version( $path ) {
	$file = get_theme_file_path( $path );
	return is_readable( $file ) ? (string) filemtime( $file ) : TA_VERSION;
}

/**
 * Google Fonts URL for the current language (only the families and weights used).
 *
 * @return string
 */
function ta_fonts_url() {
	if ( 'ar' === ta_lang() ) {
		return 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap';
	}

	return 'https://fonts.googleapis.com/css2?family=Gabriela&family=Open+Sans:wght@400;600;700&display=swap';
}

/**
 * Enqueue front-end assets.
 *
 * @return void
 */
function ta_enqueue_assets() {
	// Version must be null: a ?ver= arg would collapse the repeated "family" params.
	wp_enqueue_style( 'ta-fonts', ta_fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	wp_enqueue_style(
		'ta-main',
		get_theme_file_uri( 'assets/css/main.css' ),
		array( 'ta-fonts' ),
		ta_asset_version( 'assets/css/main.css' )
	);

	wp_enqueue_script(
		'ta-main',
		get_theme_file_uri( 'assets/js/main.js' ),
		array(),
		ta_asset_version( 'assets/js/main.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ta_enqueue_assets' );

/**
 * Load the Google Fonts stylesheet without blocking the first paint.
 *
 * The fonts use display=swap, so text renders in the fallback font first anyway.
 *
 * @param string $tag    The link tag.
 * @param string $handle Style handle.
 * @return string
 */
function ta_async_fonts( $tag, $handle ) {
	if ( 'ta-fonts' !== $handle ) {
		return $tag;
	}

	$async = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $tag );

	return $async . '<noscript>' . trim( $tag ) . "</noscript>\n";
}
add_filter( 'style_loader_tag', 'ta_async_fonts', 10, 2 );

/**
 * Drop the front-end emoji polyfill (modern browsers render emoji natively).
 *
 * @return void
 */
function ta_disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'ta_disable_emoji' );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type.
 * @return array
 */
function ta_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'ta_resource_hints', 10, 2 );
