<?php
/**
 * Template helpers: WhatsApp links, page lookup, navigation, images, icons.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build a wa.me link with an optional prefilled message.
 *
 * @param string $text Message text (plain, unencoded).
 * @return string Unescaped URL — pass through esc_url() on output.
 */
function ta_whatsapp_url( $text = '' ) {
	$url = 'https://wa.me/' . preg_replace( '/\D+/', '', (string) ta_config( 'whatsapp' ) );

	if ( '' !== $text ) {
		$url .= '?text=' . rawurlencode( $text );
	}

	return $url;
}

/**
 * Build a tel: link from a phone number.
 *
 * @param string $phone Phone number.
 * @return string
 */
function ta_tel_url( $phone ) {
	return 'tel:' . preg_replace( '/[^\d+]+/', '', $phone );
}

/**
 * Site map: page key => template file (empty template = front page).
 *
 * @return array<string, array{template: string, label: string, slugs: array{ar: string, en: string}}>
 */
function ta_site_pages() {
	return array(
		'home'     => array(
			'template' => '',
			'label'    => 'nav_home',
			'slugs'    => array(
				'ar' => 'home',
				'en' => 'home-en',
			),
		),
		'about'    => array(
			'template' => 'templates/page-about.php',
			'label'    => 'nav_about',
			'slugs'    => array(
				'ar' => 'about',
				'en' => 'about-us',
			),
		),
		'services' => array(
			'template' => 'templates/page-services.php',
			'label'    => 'nav_services',
			'slugs'    => array(
				'ar' => 'services',
				'en' => 'our-services',
			),
		),
		'offers'   => array(
			'template' => 'templates/page-offers.php',
			'label'    => 'nav_offers',
			'slugs'    => array(
				'ar' => 'offers',
				'en' => 'all-offers',
			),
		),
		'contact'  => array(
			'template' => 'templates/page-contact.php',
			'label'    => 'nav_contact',
			'slugs'    => array(
				'ar' => 'contact',
				'en' => 'contact-us',
			),
		),
	);
}

/**
 * Find the published page using a template, in a given language.
 *
 * @param string      $template Template path, e.g. 'templates/page-offers.php'.
 * @param string|null $lang     Language slug; defaults to the current language.
 * @return int Page ID, or 0 if none.
 */
function ta_get_page_by_template( $template, $lang = null ) {
	static $cache = array();

	$lang = null === $lang ? ta_lang() : ta_normalize_lang( $lang );
	$key  = $template . '|' . $lang;

	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}

	$ids = get_posts(
		array(
			'post_type'        => 'page',
			'post_status'      => 'publish',
			'posts_per_page'   => 20,
			'fields'           => 'ids',
			'meta_key'         => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'       => $template, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'orderby'          => 'ID',
			'order'            => 'ASC',
			'lang'             => '', // All languages; filtered below.
			'no_found_rows'    => true,
			'suppress_filters' => false,
		)
	);

	$found = 0;

	foreach ( $ids as $id ) {
		if ( ! function_exists( 'pll_get_post_language' ) || pll_get_post_language( $id, 'slug' ) === $lang ) {
			$found = (int) $id;
			break;
		}
	}

	$cache[ $key ] = $found;

	return $found;
}

/**
 * URL of a site page in the current language.
 *
 * @param string $page_key Key from ta_site_pages().
 * @return string Empty string when the page does not exist.
 */
function ta_page_url( $page_key ) {
	$pages = ta_site_pages();

	if ( ! isset( $pages[ $page_key ] ) ) {
		return '';
	}

	if ( '' === $pages[ $page_key ]['template'] ) {
		return ta_home_url();
	}

	$id = ta_get_page_by_template( $pages[ $page_key ]['template'] );

	return $id ? get_permalink( $id ) : '';
}

/**
 * Navigation items for the current language, built from the site map.
 *
 * Pages that do not exist yet are skipped.
 *
 * @return array<int, array{key: string, label: string, url: string, current: bool}>
 */
function ta_nav_items() {
	$items = array();

	foreach ( ta_site_pages() as $key => $page ) {
		if ( '' === $page['template'] ) {
			$items[] = array(
				'key'     => $key,
				'label'   => ta_t( $page['label'] ),
				'url'     => ta_home_url(),
				'current' => is_front_page(),
			);
			continue;
		}

		$id = ta_get_page_by_template( $page['template'] );

		if ( ! $id ) {
			continue;
		}

		$items[] = array(
			'key'     => $key,
			'label'   => ta_t( $page['label'] ),
			'url'     => get_permalink( $id ),
			'current' => is_page( $id ),
		);
	}

	return $items;
}

/**
 * Print a navigation list.
 *
 * @param string $class CSS class for the <ul>.
 * @return void
 */
function ta_nav_list( $class ) {
	echo '<ul class="' . esc_attr( $class ) . '">';

	foreach ( ta_nav_items() as $item ) {
		printf(
			'<li><a href="%1$s"%2$s>%3$s</a></li>',
			esc_url( $item['url'] ),
			$item['current'] ? ' aria-current="page"' : '',
			esc_html( $item['label'] )
		);
	}

	echo '</ul>';
}

/**
 * Whether a theme image exists in assets/images/.
 *
 * @param string $file File name.
 * @return bool
 */
function ta_image_exists( $file ) {
	return is_readable( get_theme_file_path( 'assets/images/' . $file ) );
}

/**
 * URL of a theme image, or an empty string if the file is missing.
 *
 * @param string $file File name in assets/images/.
 * @return string
 */
function ta_image_url( $file ) {
	return ta_image_exists( $file ) ? get_theme_file_uri( 'assets/images/' . $file ) : '';
}

/**
 * An <img> tag for a theme image with intrinsic width/height.
 *
 * Returns an empty string if the file is missing, so layouts never show a broken image.
 *
 * @param string $file  File name in assets/images/.
 * @param string $alt   Alt text (unescaped).
 * @param array  $attrs Extra attributes (unescaped), e.g. [ 'class' => 'x', 'loading' => 'lazy' ].
 * @return string
 */
function ta_theme_image( $file, $alt, array $attrs = array() ) {
	if ( ! ta_image_exists( $file ) ) {
		return '';
	}

	$size = wp_getimagesize( get_theme_file_path( 'assets/images/' . $file ) );

	$attrs = array_merge(
		array(
			'src'      => get_theme_file_uri( 'assets/images/' . $file ),
			'alt'      => $alt,
			'width'    => $size ? $size[0] : '',
			'height'   => $size ? $size[1] : '',
			'decoding' => 'async',
		),
		$attrs
	);

	$html = '<img';

	foreach ( $attrs as $name => $value ) {
		if ( '' === $value || null === $value ) {
			if ( 'alt' === $name ) {
				$html .= ' alt=""';
			}
			continue;
		}
		$html .= sprintf( ' %s="%s"', esc_attr( $name ), 'src' === $name ? esc_url( $value ) : esc_attr( $value ) );
	}

	return $html . '>';
}

/**
 * Inline SVG icon markup (decorative; hidden from assistive tech).
 *
 * @param string $name  Icon name.
 * @param string $class Extra CSS class.
 * @return string
 */
function ta_icon( $name, $class = '' ) {
	$icons = array(
		'whatsapp' => '<path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>',
		'menu'     => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>',
		'close'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/>',
		'arrow'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>',
		'globe'    => '<g fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.6 3.8 5.6 3.8 9s-1.3 6.4-3.8 9c-2.5-2.6-3.8-5.6-3.8-9S9.5 5.6 12 3z"/></g>',
		'phone'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" d="M5 4h3.5l1.7 4.3-2.2 1.4a11 11 0 0 0 6.3 6.3l1.4-2.2L20 15.5V19a1 1 0 0 1-1 1A16 16 0 0 1 4 5a1 1 0 0 1 1-1z"/>',
		'mail'     => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3.5 6.5 12 13l8.5-6.5"/></g>',
		'pin'      => '<g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linejoin="round" d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></g>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$classes = trim( 'ta-icon ta-icon--' . $name . ' ' . $class );

	return '<svg class="' . esc_attr( $classes ) . '" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}
