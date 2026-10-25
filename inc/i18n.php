<?php
/**
 * Translation helpers and Polylang wrappers.
 *
 * Every Polylang function is guarded so the theme keeps working if the plugin is inactive.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Languages supported by the theme. The first one is the default.
 *
 * @return string[]
 */
function ta_languages() {
	return array( 'ar', 'en' );
}

/**
 * Whether Polylang is active and loaded.
 *
 * @return bool
 */
function ta_has_polylang() {
	return function_exists( 'pll_current_language' );
}

/**
 * Normalise a language slug to one the theme supports.
 *
 * @param mixed $lang Language slug.
 * @return string
 */
function ta_normalize_lang( $lang ) {
	return in_array( $lang, ta_languages(), true ) ? $lang : 'ar';
}

/**
 * Current language slug ('ar' or 'en'), falling back to 'ar'.
 *
 * @return string
 */
function ta_lang() {
	$lang = ta_has_polylang() ? pll_current_language( 'slug' ) : '';
	return ta_normalize_lang( $lang );
}

/**
 * Translate a theme UI string.
 *
 * @param string      $key  String key from inc/strings.php.
 * @param string|null $lang Optional language slug; defaults to the current language.
 * @return string Unescaped string — escape on output.
 */
function ta_t( $key, $lang = null ) {
	static $strings = null;

	if ( null === $strings ) {
		$strings = ta_strings();
	}

	$lang = null === $lang ? ta_lang() : ta_normalize_lang( $lang );

	if ( ! isset( $strings[ $key ] ) ) {
		return $key;
	}

	return $strings[ $key ][ $lang ] ?? $strings[ $key ]['ar'];
}

/**
 * Admin language ('ar' or 'en') from the current user's locale.
 *
 * @return string
 */
function ta_admin_lang() {
	return str_starts_with( get_user_locale(), 'ar' ) ? 'ar' : 'en';
}

/**
 * Pick the admin-language value from an [ 'ar' => ..., 'en' => ... ] array.
 *
 * @param array $values Values keyed by language.
 * @return mixed
 */
function ta_pick_admin( array $values ) {
	return ta_pick( $values, ta_admin_lang() );
}

/**
 * Pick the current-language value from an [ 'ar' => ..., 'en' => ... ] array.
 *
 * @param array       $values Values keyed by language.
 * @param string|null $lang   Optional language slug.
 * @return mixed
 */
function ta_pick( array $values, $lang = null ) {
	$lang = null === $lang ? ta_lang() : ta_normalize_lang( $lang );
	return $values[ $lang ] ?? $values['ar'] ?? '';
}

/**
 * Home URL for a language.
 *
 * @param string|null $lang Optional language slug.
 * @return string
 */
function ta_home_url( $lang = null ) {
	if ( function_exists( 'pll_home_url' ) ) {
		return pll_home_url( null === $lang ? '' : $lang );
	}
	return home_url( '/' );
}

/**
 * Language of a post, falling back to the current language.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function ta_post_lang( $post_id ) {
	$lang = function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $post_id, 'slug' ) : '';
	return $lang ? ta_normalize_lang( $lang ) : ta_lang();
}

/**
 * The language switcher target: the other language's URL and label.
 *
 * Returns null when Polylang is inactive or no other language exists.
 *
 * @return array{slug: string, url: string, label: string, locale: string}|null
 */
function ta_language_switch() {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return null;
	}

	$languages = pll_the_languages(
		array(
			'raw'           => 1,
			'hide_if_empty' => 0,
		)
	);

	if ( empty( $languages ) || ! is_array( $languages ) ) {
		return null;
	}

	$labels = array(
		'ar' => 'العربية',
		'en' => 'English',
	);

	foreach ( $languages as $language ) {
		if ( ! empty( $language['current_lang'] ) ) {
			continue;
		}

		$slug = $language['slug'] ?? '';

		return array(
			'slug'   => $slug,
			'url'    => $language['url'] ?? ta_home_url( $slug ),
			'label'  => $labels[ $slug ] ?? ( $language['name'] ?? $slug ),
			'locale' => str_replace( '_', '-', $language['locale'] ?? $slug ),
		);
	}

	return null;
}
