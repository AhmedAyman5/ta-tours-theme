<?php
/**
 * Login page branding.
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
