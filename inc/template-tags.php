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
 * Google Maps link that searches for the branch address (no API key needed).
 *
 * @return string Unescaped URL — pass through esc_url() on output.
 */
function ta_directions_url() {
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( (string) ta_config( 'map_query' ) );
}

/**
 * Google Maps embed URL for the branch address, in the current language (no API key needed).
 *
 * @return string Unescaped URL — pass through esc_url() on output.
 */
function ta_map_embed_url() {
	return 'https://maps.google.com/maps?q=' . rawurlencode( (string) ta_config( 'map_query' ) ) . '&hl=' . ta_lang() . '&z=16&output=embed';
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
 * @param array  $extra Extra items appended after the site pages: { label, url, class }.
 * @return void
 */
function ta_nav_list( $class, array $extra = array() ) {
	echo '<ul class="' . esc_attr( $class ) . '">';

	foreach ( ta_nav_items() as $item ) {
		printf(
			'<li><a href="%1$s"%2$s>%3$s</a></li>',
			esc_url( $item['url'] ),
			$item['current'] ? ' aria-current="page"' : '',
			esc_html( $item['label'] )
		);
	}

	foreach ( $extra as $item ) {
		printf(
			'<li class="%1$s"><a href="%2$s">%3$s</a></li>',
			esc_attr( isset( $item['class'] ) ? $item['class'] : '' ),
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}

	echo '</ul>';
}

/**
 * The services. The key is also the row's anchor id on the Services page.
 *
 * String keys derive from 'label': title = label, short Home text = label . '_text',
 * long text = label . '_desc', bullets = label . '_point_1'…'_point_3', image alt = label . '_alt'.
 * A 'featured' service (Hajj & Umrah) gets the gold accent, a full-width Home card
 * with a badge (label . '_badge') and its own buttons on the Services page.
 *
 * @return array<string, array{icon: string, label: string, image: string, featured: bool}>
 */
function ta_services() {
	return array(
		'hajj-umrah'  => array(
			'icon'     => 'kaaba',
			'label'    => 'service_hajj',
			'image'    => 'hajj-umrah.jpg',
			'featured' => true,
		),
		'flights'     => array(
			'icon'     => 'plane',
			'label'    => 'service_flights',
			'image'    => 'service-flights.jpg',
			'featured' => false,
		),
		'planning'    => array(
			'icon'     => 'map',
			'label'    => 'service_planning',
			'image'    => 'service-planning.jpg',
			'featured' => false,
		),
		'tours'       => array(
			'icon'     => 'compass',
			'label'    => 'service_tours',
			'image'    => 'service-tours.jpg',
			'featured' => false,
		),
		'hotels'      => array(
			'icon'     => 'bed',
			'label'    => 'service_hotels',
			'image'    => 'service-hotels.jpg',
			'featured' => false,
		),
		'consultancy' => array(
			'icon'     => 'bulb',
			'label'    => 'service_consultancy',
			'image'    => 'service-consultancy.jpg',
			'featured' => false,
		),
		'honeymoon'   => array(
			'icon'     => 'heart',
			'label'    => 'service_honeymoon',
			'image'    => 'service-honeymoon.jpg',
			'featured' => false,
		),
	);
}

/**
 * URL of the Hajj & Umrah section on the Offers page (current language).
 *
 * @return string Empty string when the Offers page does not exist.
 */
function ta_hajj_offers_url() {
	$url = ta_page_url( 'offers' );

	return $url ? $url . '#hajj-umrah' : '';
}

/**
 * URL of a service row on the Services page (current language).
 *
 * @param string $key Key from ta_services().
 * @return string Empty string when the Services page does not exist.
 */
function ta_service_url( $key ) {
	$url = ta_page_url( 'services' );

	return $url ? $url . '#' . $key : '';
}

/**
 * Services page FAQ for the current language: question and answer HTML.
 *
 * @return array<int, array{q: string, a: string}> Unescaped; answers may contain links.
 */
function ta_faq_items() {
	$offers = ta_page_url( 'offers' );
	$items  = array();

	foreach ( array( 'hajj', '1', '2', '3', '4', '5' ) as $id ) {
		$answer = ta_t( 'faq_' . $id . '_a' );

		if ( '5' === $id ) {
			// Without an Offers page, keep the sentence but drop the link.
			$answer = $offers ? sprintf( $answer, esc_url( $offers ) ) : wp_strip_all_tags( $answer );
		}

		$items[] = array(
			'q' => ta_t( 'faq_' . $id . '_q' ),
			'a' => $answer,
		);
	}

	return $items;
}

/**
 * Popular destinations: image file and string keys (name key, plus '_text' and '_alt').
 *
 * 'message' is an optional string key for a custom WhatsApp message; otherwise
 * dest_wa_message is used with the name. 'hajj' cards get the gold accent.
 *
 * @return array<string, array{image: string, label: string, message?: string, hajj?: bool}>
 */
function ta_destinations() {
	return array(
		'maldives' => array(
			'image' => 'dest-maldives.jpg',
			'label' => 'dest_maldives',
		),
		'turkey'   => array(
			'image' => 'dest-turkey.jpg',
			'label' => 'dest_turkey',
		),
		'bali'     => array(
			'image' => 'dest-bali.jpg',
			'label' => 'dest_bali',
		),
		'makkah'   => array(
			'image'   => 'dest-madinah.jpg',
			'label'   => 'dest_makkah',
			'message' => 'dest_makkah_wa_message',
			'hajj'    => true,
		),
	);
}

/**
 * Print a section heading: eyebrow, h2, optional intro and optional "more" link.
 *
 * @param array $args {
 *     @type string $id      ID of the h2 (for aria-labelledby).
 *     @type string $eyebrow Small label above the title (unescaped).
 *     @type string $title   Title (unescaped).
 *     @type string $intro   Optional intro paragraph (unescaped).
 *     @type string $url     Optional link URL.
 *     @type string $link    Optional link label (unescaped).
 *     @type bool   $center  Center the heading (no link column).
 * }
 * @return void
 */
function ta_section_head( array $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'id'      => '',
			'eyebrow' => '',
			'title'   => '',
			'intro'   => '',
			'url'     => '',
			'link'    => '',
			'center'  => false,
		)
	);

	$class = 'ta-section__head' . ( $args['center'] ? ' ta-section__head--center' : '' );
	?>
	<div class="<?php echo esc_attr( $class ); ?>" data-reveal="fade-up">
		<div class="ta-section__heading">
			<?php if ( $args['eyebrow'] ) : ?>
				<p class="ta-eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h2 class="ta-section__title" id="<?php echo esc_attr( $args['id'] ); ?>"><?php echo esc_html( $args['title'] ); ?></h2>
			<?php if ( $args['intro'] ) : ?>
				<p class="ta-section__intro"><?php echo esc_html( $args['intro'] ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( $args['url'] && $args['link'] ) : ?>
			<a class="ta-link-arrow" href="<?php echo esc_url( $args['url'] ); ?>">
				<span><?php echo esc_html( $args['link'] ); ?></span>
				<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Current page number for a paginated custom query on a page (or the static front page).
 *
 * @return int
 */
function ta_current_page_number() {
	return max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
}

/**
 * Print accessible pagination for a custom query on the current page.
 *
 * Links are built from the page permalink, so they keep the current language.
 *
 * @param WP_Query $query    The paginated query.
 * @param string   $label    Accessible name of the navigation (unescaped).
 * @param string   $fragment Optional anchor id to land on, e.g. the grid section.
 * @return void
 */
function ta_pagination( WP_Query $query, $label, $fragment = '' ) {
	$total = (int) $query->max_num_pages;

	if ( $total < 2 ) {
		return;
	}

	$permalink = get_permalink();

	if ( get_option( 'permalink_structure' ) ) {
		$base   = trailingslashit( $permalink ) . '%_%';
		$format = user_trailingslashit( 'page/%#%', 'paged' );
	} else {
		$base   = add_query_arg( 'paged', '%#%', $permalink );
		$format = '';
	}

	$links = paginate_links(
		array(
			'base'               => $base,
			'format'             => $format,
			'current'            => min( ta_current_page_number(), $total ),
			'total'              => $total,
			'type'               => 'array',
			'mid_size'           => 1,
			'add_fragment'       => $fragment ? '#' . $fragment : '',
			'before_page_number' => '<span class="ta-visually-hidden">' . esc_html( ta_t( 'offers_page_number' ) ) . ' </span>',
			'prev_text'          => ta_icon( 'chevron', 'ta-pagination__prev' ) . '<span>' . esc_html( ta_t( 'offers_prev' ) ) . '</span>',
			'next_text'          => '<span>' . esc_html( ta_t( 'offers_next' ) ) . '</span>' . ta_icon( 'chevron', 'ta-icon--flip' ),
		)
	);

	if ( ! $links ) {
		return;
	}
	?>
	<nav class="ta-pagination" aria-label="<?php echo esc_attr( $label ); ?>" data-reveal="fade-up">
		<ul class="ta-pagination__list">
			<?php foreach ( $links as $link ) : ?>
				<li><?php echo $link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by paginate_links() from escaped parts. ?></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php
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
 * Srcset for a theme image from its WebP variants in assets/images/sizes/.
 *
 * Variants are built by tools/make-images.php ("{name}-{width}.webp"). The original
 * file is added as the largest candidate.
 *
 * @param string $file  File name in assets/images/.
 * @param int    $width Width of the original file.
 * @return string Empty string when no variants exist.
 */
function ta_image_srcset( $file, $width ) {
	$name = pathinfo( $file, PATHINFO_FILENAME );
	$set  = array();

	foreach ( array( 160, 320, 480, 800, 1200, 1600 ) as $w ) {
		$variant = 'sizes/' . $name . '-' . $w . '.webp';

		if ( $w < $width && ta_image_exists( $variant ) ) {
			$set[] = esc_url( get_theme_file_uri( 'assets/images/' . $variant ) ) . ' ' . $w . 'w';
		}
	}

	if ( ! $set ) {
		return '';
	}

	$set[] = esc_url( get_theme_file_uri( 'assets/images/' . $file ) ) . ' ' . $width . 'w';

	return implode( ', ', $set );
}

/**
 * An <img> tag for a theme image with intrinsic width/height and a WebP srcset.
 *
 * Returns an empty string if the file is missing, so layouts never show a broken image.
 *
 * @param string $file  File name in assets/images/.
 * @param string $alt   Alt text (unescaped).
 * @param array  $attrs Extra attributes (unescaped), e.g. [ 'class' => 'x', 'loading' => 'lazy', 'sizes' => '50vw' ].
 * @return string
 */
function ta_theme_image( $file, $alt, array $attrs = array() ) {
	if ( ! ta_image_exists( $file ) ) {
		return '';
	}

	$size   = wp_getimagesize( get_theme_file_path( 'assets/images/' . $file ) );
	$srcset = $size ? ta_image_srcset( $file, (int) $size[0] ) : '';

	$attrs = array_merge(
		array(
			'src'      => get_theme_file_uri( 'assets/images/' . $file ),
			'srcset'   => $srcset,
			'sizes'    => $srcset ? '100vw' : '',
			'alt'      => $alt,
			'width'    => $size ? $size[0] : '',
			'height'   => $size ? $size[1] : '',
			'decoding' => 'async',
		),
		$attrs
	);

	if ( '' === $srcset ) {
		unset( $attrs['sizes'] );
	}

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
		'plane'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>',
		'map'      => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6l6-3 6 3 6-3v15l-6 3-6-3-6 3z"/><path d="M9 3v15M15 6v15"/></g>',
		'compass'  => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M15.5 8.5l-2 5-5 2 2-5z"/></g>',
		'bed'      => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"/><path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4M12 4v6M2 17h20"/></g>',
		'bulb'     => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6M10 22h4"/></g>',
		'heart'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 14c1.5-1.5 3-3.2 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.8 0-3 .5-4.5 2-1.5-1.5-2.7-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4 3 5.5l7 7z"/>',
		'user'     => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M16 11l2 2 4-4"/></g>',
		'tag'      => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.6 2.6A2 2 0 0 0 11.2 2H4a2 2 0 0 0-2 2v7.2a2 2 0 0 0 .6 1.4l8.7 8.7a2.4 2.4 0 0 0 3.4 0l6.6-6.6a2.4 2.4 0 0 0 0-3.4z"/><circle cx="7.5" cy="7.5" r="1" fill="currentColor"/></g>',
		'shield'   => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.7 9a1 1 0 0 1-.6 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.2-2.7a1.2 1.2 0 0 1 1.6 0C14.5 3.8 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M9 12l2 2 4-4"/></g>',
		'check'    => '<path fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M5 12.5l4.5 4.5L19 7.5"/>',
		'chevron'  => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6"/>',
		'cloud'    => '<path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M17.5 19H7a5 5 0 1 1 1.3-9.8A6 6 0 0 1 19.7 11 4 4 0 0 1 17.5 19z"/>',
		'suitcase' => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/></g>',
		'search'   => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></g>',
		'smile'    => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><circle cx="9" cy="9.5" r="1" fill="currentColor" stroke="none"/><circle cx="15" cy="9.5" r="1" fill="currentColor" stroke="none"/></g>',
		'network'  => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="2.5"/><circle cx="5" cy="19" r="2.5"/><circle cx="19" cy="19" r="2.5"/><path d="M10.8 7.2 6.2 16.8M13.2 7.2l4.6 9.6M7.5 19h9"/></g>',
		'calendar' => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 17.5h.01M12 17.5h.01"/></g>',
		'kaaba'    => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><path d="M12 3 3 7v10l9 4 9-4V7z"/><path d="M3 7l9 4 9-4M12 11v10"/><path stroke-linecap="round" d="M3 10.5l9 4 9-4"/></g>',
		'repeat'   => '<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 2l4 4-4 4"/><path d="M3 11V9a3 3 0 0 1 3-3h15"/><path d="M7 22l-4-4 4-4"/><path d="M21 13v2a3 3 0 0 1-3 3H3"/></g>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$classes = trim( 'ta-icon ta-icon--' . $name . ' ' . $class );

	return '<svg class="' . esc_attr( $classes ) . '" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}
