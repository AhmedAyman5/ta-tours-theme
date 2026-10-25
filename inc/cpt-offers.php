<?php
/**
 * Offers custom post type, admin columns, Polylang + sitemap integration,
 * and the redirect away from single offer URLs.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the "offer" post type.
 *
 * It stays public / publicly_queryable so Polylang can translate it,
 * but single URLs are redirected (see ta_redirect_single_offer()).
 *
 * @return void
 */
function ta_register_offer_post_type() {
	// Admin labels follow the user's admin language (Arabic only for an ar locale).
	$labels = array_map(
		'ta_pick_admin',
		array(
			'name'                  => array(
				'ar' => 'العروض',
				'en' => 'Offers',
			),
			'singular_name'         => array(
				'ar' => 'عرض',
				'en' => 'Offer',
			),
			'menu_name'             => array(
				'ar' => 'العروض',
				'en' => 'Offers',
			),
			'all_items'             => array(
				'ar' => 'كل العروض',
				'en' => 'All offers',
			),
			'add_new'               => array(
				'ar' => 'إضافة عرض',
				'en' => 'Add offer',
			),
			'add_new_item'          => array(
				'ar' => 'إضافة عرض جديد',
				'en' => 'Add new offer',
			),
			'edit_item'             => array(
				'ar' => 'تعديل العرض',
				'en' => 'Edit offer',
			),
			'new_item'              => array(
				'ar' => 'عرض جديد',
				'en' => 'New offer',
			),
			'view_item'             => array(
				'ar' => 'عرض',
				'en' => 'View offer',
			),
			'search_items'          => array(
				'ar' => 'بحث في العروض',
				'en' => 'Search offers',
			),
			'not_found'             => array(
				'ar' => 'لا توجد عروض',
				'en' => 'No offers found',
			),
			'not_found_in_trash'    => array(
				'ar' => 'لا توجد عروض في المهملات',
				'en' => 'No offers in Trash',
			),
			'featured_image'        => array(
				'ar' => 'صورة العرض',
				'en' => 'Offer image',
			),
			'set_featured_image'    => array(
				'ar' => 'تعيين صورة العرض',
				'en' => 'Set offer image',
			),
			'remove_featured_image' => array(
				'ar' => 'إزالة صورة العرض',
				'en' => 'Remove offer image',
			),
			'use_featured_image'    => array(
				'ar' => 'استخدام كصورة العرض',
				'en' => 'Use as offer image',
			),
		)
	);

	register_post_type(
		'offer',
		array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_rest'        => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-tickets-alt',
			'capability_type'     => 'post',
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'rewrite'             => array(
				'slug'       => 'offer',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'ta_register_offer_post_type' );

/**
 * Flush rewrite rules when the theme is activated so offer URLs resolve.
 *
 * @return void
 */
function ta_offer_flush_rewrites() {
	ta_register_offer_post_type();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ta_offer_flush_rewrites' );

/**
 * Make offers translatable in Polylang.
 *
 * Polylang then shows "offer" as checked (and locked) in
 * Languages → Settings → Custom post types and Taxonomies.
 *
 * @param array $post_types  Translatable post types.
 * @param bool  $is_settings Whether this is the settings screen list.
 * @return array
 */
function ta_pll_offer_post_type( $post_types, $is_settings ) {
	if ( ! $is_settings ) {
		$post_types['offer'] = 'offer';
	}
	return $post_types;
}
add_filter( 'pll_get_post_types', 'ta_pll_offer_post_type', 10, 2 );

/**
 * Keep offers out of the core WordPress sitemap.
 *
 * @param array $post_types Post types in the sitemap.
 * @return array
 */
function ta_sitemap_exclude_offers( $post_types ) {
	unset( $post_types['offer'] );
	return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'ta_sitemap_exclude_offers' );

/**
 * 301-redirect single offer requests to the Offers page in the same language,
 * or to that language's home page if the Offers page does not exist yet.
 *
 * @return void
 */
function ta_redirect_single_offer() {
	if ( ! is_singular( 'offer' ) || is_preview() ) {
		return;
	}

	$lang    = ta_post_lang( get_queried_object_id() );
	$page_id = ta_get_page_by_template( 'templates/page-offers.php', $lang );
	$target  = $page_id ? get_permalink( $page_id ) : ta_home_url( $lang );

	wp_safe_redirect( $target, 301 );
	exit;
}
add_action( 'template_redirect', 'ta_redirect_single_offer' );

/**
 * Admin list columns: thumbnail, title, (Polylang language), date.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function ta_offer_columns( $columns ) {
	$new = array();

	if ( isset( $columns['cb'] ) ) {
		$new['cb'] = $columns['cb'];
	}

	$new['ta_thumb'] = ta_pick_admin( array( 'ar' => 'الصورة', 'en' => 'Image' ) );
	$new['title']    = $columns['title'] ?? ta_pick_admin( array( 'ar' => 'العنوان', 'en' => 'Title' ) );
	$new['date']     = $columns['date'] ?? ta_pick_admin( array( 'ar' => 'التاريخ', 'en' => 'Date' ) );

	// Polylang adds its language column(s) after this filter runs.
	return $new;
}
add_filter( 'manage_offer_posts_columns', 'ta_offer_columns' );

/**
 * Render the thumbnail column.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 * @return void
 */
function ta_offer_column_content( $column, $post_id ) {
	if ( 'ta_thumb' !== $column ) {
		return;
	}

	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, array( 64, 48 ), array( 'class' => 'ta-admin-thumb' ) );
		return;
	}

	echo '<span aria-hidden="true">—</span>';
}
add_action( 'manage_offer_posts_custom_column', 'ta_offer_column_content', 10, 2 );

/**
 * Admin column styling.
 *
 * @return void
 */
function ta_offer_admin_css() {
	$screen = get_current_screen();

	if ( ! $screen || 'edit-offer' !== $screen->id ) {
		return;
	}

	echo '<style>.column-ta_thumb{width:80px}.ta-admin-thumb{width:64px;height:48px;object-fit:cover;border-radius:4px;display:block}</style>';
}
add_action( 'admin_head', 'ta_offer_admin_css' );

/**
 * Query the newest offers in a language.
 *
 * @param array $args Extra WP_Query args.
 * @return WP_Query
 */
function ta_offers_query( array $args = array() ) {
	$defaults = array(
		'post_type'           => 'offer',
		'post_status'         => 'publish',
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
	);

	if ( ta_has_polylang() ) {
		$defaults['lang'] = ta_lang();
	}

	return new WP_Query( array_merge( $defaults, $args ) );
}
