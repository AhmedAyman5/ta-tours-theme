<?php
/**
 * Login page branding and the "TA Tours" admin color scheme.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Login page stylesheet (logo, brand colors, sky background).
 *
 * @return void
 */
function ta_login_assets() {
	wp_enqueue_style( 'ta-login', get_theme_file_uri( 'assets/css/login.css' ), array( 'login' ), ta_asset_version( 'assets/css/login.css' ) );
	wp_add_inline_style( 'ta-login', '.login h1 a{background-image:url("' . esc_url( get_theme_file_uri( 'assets/images/logo-blue.png' ) ) . '")}' );
}
add_action( 'login_enqueue_scripts', 'ta_login_assets' );

/**
 * The login logo links to the home page.
 *
 * @return string
 */
function ta_login_logo_url() {
	return ta_home_url();
}
add_filter( 'login_headerurl', 'ta_login_logo_url' );

/**
 * Accessible text for the login logo link.
 *
 * @return string
 */
function ta_login_logo_text() {
	return ta_pick( ta_config( 'brand_official' ), ta_admin_lang() );
}
add_filter( 'login_headertext', 'ta_login_logo_text' );

/**
 * Register the "TA Tours" admin color scheme.
 *
 * @return void
 */
function ta_register_admin_color_scheme() {
	$file = is_rtl() ? 'assets/css/admin-colors-rtl.css' : 'assets/css/admin-colors.css';

	wp_admin_css_color(
		'ta-tours',
		'TA Tours',
		add_query_arg( 'ver', ta_asset_version( $file ), get_theme_file_uri( $file ) ),
		array( '#075a76', '#096c8d', '#0a769f', '#7caad5' ),
		array(
			'base'    => '#d3e6f1',
			'focus'   => '#ffffff',
			'current' => '#ffffff',
		)
	);
}
add_action( 'admin_init', 'ta_register_admin_color_scheme' );

/**
 * Offers Managers use the TA Tours scheme unless they picked another non-default one.
 *
 * @param string  $color  Saved admin_color value.
 * @param string  $option Option name.
 * @param WP_User $user   User the option belongs to.
 * @return string
 */
function ta_client_admin_color( $color, $option, $user ) {
	if ( in_array( (string) $color, array( '', 'fresh', 'modern' ), true ) && ta_is_offers_manager( $user ) ) {
		return 'ta-tours';
	}
	return $color;
}
add_filter( 'get_user_option_admin_color', 'ta_client_admin_color', 10, 3 );
