<?php
/**
 * SEO without a plugin: titles, meta descriptions, Open Graph / Twitter tags and JSON-LD.
 *
 * Hreflang links come from Polylang, the canonical link and sitemap from WordPress core
 * (offers are kept out of the sitemap in inc/cpt-offers.php).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Key of the current site page from ta_site_pages() ('home', 'about', …), or '' for anything else.
 *
 * @return string
 */
function ta_seo_page_key() {
	if ( is_front_page() ) {
		return 'home';
	}

	if ( ! is_page() ) {
		return '';
	}

	$id = get_queried_object_id();

	// The English Home is a translation of the front page, not the front page itself.
	if ( function_exists( 'pll_get_post' ) && (int) pll_get_post( (int) get_option( 'page_on_front' ) ) === $id ) {
		return 'home';
	}

	$template = get_page_template_slug( $id );

	foreach ( ta_site_pages() as $key => $page ) {
		if ( '' !== $page['template'] && $page['template'] === $template ) {
			return $key;
		}
	}

	return '';
}

/**
 * SEO title for the current page, or '' to let WordPress build it.
 *
 * @return string
 */
function ta_seo_title() {
	$key = ta_seo_page_key();

	if ( '' === $key ) {
		return '';
	}

	$title = ta_t( 'seo_' . $key . '_title' );
	$paged = ta_current_page_number();

	if ( $paged > 1 ) {
		$title .= ' | ' . ta_t( 'offers_page_number' ) . ' ' . number_format_i18n( $paged );
	}

	return $title;
}

/**
 * Meta description for the current page, or ''.
 *
 * @return string
 */
function ta_seo_description() {
	$key = ta_seo_page_key();
	return '' === $key ? '' : ta_t( 'seo_' . $key . '_desc' );
}

/**
 * Use the SEO title on site pages.
 *
 * @param string $title Title from earlier filters.
 * @return string
 */
function ta_pre_document_title( $title ) {
	$seo = ta_seo_title();
	return '' !== $seo ? esc_html( $seo ) : $title;
}
add_filter( 'pre_get_document_title', 'ta_pre_document_title' );

/**
 * Other pages (404, legal pages): "Page title | brand" in the current language.
 *
 * @param array $parts Title parts.
 * @return array
 */
function ta_document_title_parts( $parts ) {
	unset( $parts['tagline'] );
	$parts['site'] = ta_t( 'seo_site_name' );
	return $parts;
}
add_filter( 'document_title_parts', 'ta_document_title_parts' );

/**
 * Title separator.
 *
 * @return string
 */
function ta_document_title_separator() {
	return '|';
}
add_filter( 'document_title_separator', 'ta_document_title_separator' );

/**
 * Open Graph locale for a language slug.
 *
 * @param string $lang Language slug.
 * @return string
 */
function ta_og_locale( $lang ) {
	return 'en' === $lang ? 'en_US' : 'ar_AR';
}

/**
 * Print the meta description, Open Graph and Twitter card tags.
 *
 * @return void
 */
function ta_seo_meta_tags() {
	if ( is_404() || is_search() ) {
		return;
	}

	$title = ta_seo_title();
	$desc  = ta_seo_description();
	$url   = is_singular() ? wp_get_canonical_url() : '';
	$lang  = ta_lang();

	if ( '' === $title ) {
		$title = wp_get_document_title();
	}

	if ( '' !== $desc ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	}

	$tags = array(
		'og:type'             => 'website',
		'og:site_name'        => ta_t( 'seo_site_name' ),
		'og:title'            => $title,
		'og:description'      => $desc,
		'og:url'              => $url,
		'og:locale'           => ta_og_locale( $lang ),
		'og:locale:alternate' => ta_og_locale( 'en' === $lang ? 'ar' : 'en' ),
	);

	$image = ta_image_url( 'og-image.jpg' );

	if ( $image ) {
		$tags['og:image']        = $image;
		$tags['og:image:width']  = '1200';
		$tags['og:image:height'] = '630';
		$tags['og:image:type']   = 'image/jpeg';
		$tags['og:image:alt']    = ta_t( 'seo_og_image_alt' );
	}

	foreach ( $tags as $property => $content ) {
		if ( '' === $content ) {
			continue;
		}
		$value = in_array( $property, array( 'og:url', 'og:image' ), true ) ? esc_url( $content ) : esc_attr( $content );
		printf( '<meta property="%s" content="%s">' . "\n", esc_attr( $property ), $value ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
	}

	$twitter = array(
		'twitter:card'        => 'summary_large_image',
		'twitter:title'       => $title,
		'twitter:description' => $desc,
		'twitter:image'       => $image,
	);

	foreach ( $twitter as $name => $content ) {
		if ( '' === $content ) {
			continue;
		}
		$value = 'twitter:image' === $name ? esc_url( $content ) : esc_attr( $content );
		printf( '<meta name="%s" content="%s">' . "\n", esc_attr( $name ), $value ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
	}
}
add_action( 'wp_head', 'ta_seo_meta_tags', 1 );

/**
 * TravelAgency structured data (facts from ta_config() only; no sameAs until real profiles exist).
 *
 * @return array
 */
function ta_seo_travel_agency_schema() {
	$brand_official = ta_config( 'brand_official' );

	$data = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'TravelAgency',
		'name'          => 'TA Tours',
		'alternateName' => array( $brand_official['en'], $brand_official['ar'] ),
		'url'           => ta_home_url(),
		'telephone'     => array_merge( (array) ta_config( 'phones' ), array( ta_config( 'landline' )['tel'], ta_config( 'saudi_phone' )['tel'] ) ),
		'email'         => ta_config( 'email' ),
		'foundingDate'  => (string) ta_config( 'founded' ),
		'address'       => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => ta_pick( ta_config( 'street' ) ),
			'addressLocality' => ta_pick( ta_config( 'city' ) ),
			'addressCountry'  => ta_config( 'country' ),
		),
	);

	$logo  = ta_image_url( 'logo-blue.png' );
	$image = ta_image_url( 'og-image.jpg' );

	if ( $logo ) {
		$data['logo'] = $logo;
	}

	if ( $image ) {
		$data['image'] = $image;
	}

	return $data;
}

/**
 * Print the JSON-LD on the Home and Contact pages.
 *
 * @return void
 */
function ta_seo_json_ld() {
	if ( ! in_array( ta_seo_page_key(), array( 'home', 'contact' ), true ) ) {
		return;
	}

	wp_print_inline_script_tag(
		wp_json_encode( ta_seo_travel_agency_schema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ),
		array( 'type' => 'application/ld+json' )
	);
}
add_action( 'wp_head', 'ta_seo_json_ld', 20 );

/**
 * Sitemap: pages only. The site has no blog, and the users sitemap would expose login names.
 *
 * @param WP_Sitemaps_Provider $provider Provider instance.
 * @param string               $name     Provider name.
 * @return WP_Sitemaps_Provider|false
 */
function ta_sitemap_providers( $provider, $name ) {
	return in_array( $name, array( 'users', 'taxonomies' ), true ) ? false : $provider;
}
add_filter( 'wp_sitemaps_add_provider', 'ta_sitemap_providers', 10, 2 );

/**
 * Keep blog posts out of the sitemap (offers are removed in inc/cpt-offers.php).
 *
 * @param array $post_types Post types in the sitemap.
 * @return array
 */
function ta_sitemap_exclude_posts( $post_types ) {
	unset( $post_types['post'] );
	return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'ta_sitemap_exclude_posts' );
