<?php
/**
 * Simpler offer editor (for every user): classic screen, short editor,
 * image hint, tips box and a warning when an offer has no image.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether the current admin screen is the offer add/edit screen.
 *
 * @return bool
 */
function ta_is_offer_edit_screen() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	return $screen && 'post' === $screen->base && 'offer' === $screen->post_type;
}

/**
 * Use the classic editor for offers only.
 *
 * @param bool   $use_block_editor Whether to use the block editor.
 * @param string $post_type        Post type.
 * @return bool
 */
function ta_offer_disable_block_editor( $use_block_editor, $post_type ) {
	return 'offer' === $post_type ? false : $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'ta_offer_disable_block_editor', 10, 2 );

/**
 * Title placeholder.
 *
 * @param string  $placeholder Placeholder text.
 * @param WP_Post $post        Post being edited.
 * @return string
 */
function ta_offer_title_placeholder( $placeholder, $post ) {
	return 'offer' === $post->post_type ? ta_t( 'admin_title_ph', ta_admin_lang() ) : $placeholder;
}
add_filter( 'enter_title_here', 'ta_offer_title_placeholder', 10, 2 );

/**
 * Description editor: teeny toolbar, no media button, shorter.
 *
 * @param array  $settings  wp_editor() settings.
 * @param string $editor_id Editor ID.
 * @return array
 */
function ta_offer_editor_settings( $settings, $editor_id ) {
	if ( 'content' !== $editor_id || ! ta_is_offer_edit_screen() ) {
		return $settings;
	}

	$settings['teeny']            = true;
	$settings['media_buttons']    = false;
	$settings['drag_drop_upload'] = false;
	$settings['editor_height']    = 180;

	return $settings;
}
add_filter( 'wp_editor_settings', 'ta_offer_editor_settings', 10, 2 );

/**
 * Remove meta boxes offers do not need.
 *
 * @return void
 */
function ta_offer_remove_meta_boxes() {
	foreach ( array( 'slugdiv', 'postcustom', 'authordiv', 'revisionsdiv', 'commentsdiv', 'commentstatusdiv', 'trackbacksdiv', 'postexcerpt' ) as $box ) {
		remove_meta_box( $box, 'offer', 'normal' );
		remove_meta_box( $box, 'offer', 'advanced' );
		remove_meta_box( $box, 'offer', 'side' );
	}
}
add_action( 'add_meta_boxes_offer', 'ta_offer_remove_meta_boxes', 99 );

/**
 * Offers have no single pages, so hide the permalink row under the title.
 *
 * @param string $html    Sample permalink HTML.
 * @param int    $post_id Post ID.
 * @return string
 */
function ta_offer_hide_permalink( $html, $post_id ) {
	return 'offer' === get_post_type( $post_id ) ? '' : $html;
}
add_filter( 'get_sample_permalink_html', 'ta_offer_hide_permalink', 10, 2 );

/**
 * Size hint inside the "Offer image" box (the box title comes from the
 * post type's featured_image label).
 *
 * @param string $html    Meta box HTML.
 * @param int    $post_id Post ID.
 * @return string
 */
function ta_offer_image_hint( $html, $post_id ) {
	if ( 'offer' !== get_post_type( $post_id ) ) {
		return $html;
	}

	return $html . '<p class="description ta-image-hint">' . esc_html( ta_t( 'admin_image_hint', ta_admin_lang() ) ) . '</p>';
}
add_filter( 'admin_post_thumbnail_html', 'ta_offer_image_hint', 10, 2 );

/**
 * Dismissible tips box at the top of the add/edit screen.
 *
 * @param WP_Post $post Post being edited.
 * @return void
 */
function ta_offer_tips_box( $post ) {
	if ( 'offer' !== $post->post_type || get_user_meta( get_current_user_id(), 'ta_offer_tips_dismissed', true ) ) {
		return;
	}

	$lang = ta_admin_lang();
	?>
	<div class="notice notice-info is-dismissible inline ta-offer-tips" data-nonce="<?php echo esc_attr( wp_create_nonce( 'ta_dismiss_offer_tips' ) ); ?>">
		<p><strong><?php echo esc_html( ta_t( 'admin_tips_title', $lang ) ); ?></strong></p>
		<ul>
			<li><?php echo esc_html( ta_t( 'admin_tips_fill', $lang ) ); ?></li>
			<li><?php echo esc_html( ta_t( 'admin_tips_translate', $lang ) ); ?></li>
		</ul>
	</div>
	<?php
}
add_action( 'edit_form_top', 'ta_offer_tips_box' );

/**
 * AJAX: remember that the current user dismissed the tips box.
 *
 * @return void
 */
function ta_dismiss_offer_tips() {
	check_ajax_referer( 'ta_dismiss_offer_tips', 'nonce' );

	if ( ! current_user_can( 'edit_offers' ) ) {
		wp_send_json_error( null, 403 );
	}

	update_user_meta( get_current_user_id(), 'ta_offer_tips_dismissed', 1 );
	wp_send_json_success();
}
add_action( 'wp_ajax_ta_dismiss_offer_tips', 'ta_dismiss_offer_tips' );

/**
 * After saving an offer without an image, flag the redirect so a warning is shown.
 *
 * @param string $location Redirect URL.
 * @param int    $post_id  Post ID.
 * @return string
 */
function ta_offer_flag_missing_image( $location, $post_id ) {
	if ( 'offer' === get_post_type( $post_id ) && ! has_post_thumbnail( $post_id ) ) {
		$location = add_query_arg( 'ta_no_image', 1, $location );
	}
	return $location;
}
add_filter( 'redirect_post_location', 'ta_offer_flag_missing_image', 10, 2 );

/**
 * Friendly warning after saving an offer without an image.
 *
 * @return void
 */
function ta_offer_missing_image_notice() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display flag only.
	if ( empty( $_GET['ta_no_image'] ) || ! ta_is_offer_edit_screen() ) {
		return;
	}

	$post = get_post();

	if ( ! $post || has_post_thumbnail( $post ) ) {
		return;
	}

	echo '<div class="notice notice-warning is-dismissible"><p>' . esc_html( ta_t( 'admin_no_image', ta_admin_lang() ) ) . '</p></div>';
}
add_action( 'admin_notices', 'ta_offer_missing_image_notice' );

/**
 * Notices added by the theme (kept when other notices are hidden for the client).
 *
 * @return callable[]
 */
function ta_own_admin_notices() {
	return array( 'ta_offer_missing_image_notice' );
}

/**
 * Admin styles and the tips-box script on the theme's admin screens.
 *
 * @param string $hook_suffix Admin page hook.
 * @return void
 */
function ta_offer_admin_assets( $hook_suffix ) {
	$screen = get_current_screen();
	$offer  = $screen && 'offer' === $screen->post_type;

	if ( ! $offer && 'toplevel_page_ta-welcome' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style( 'ta-admin', get_theme_file_uri( 'assets/css/admin.css' ), array(), ta_asset_version( 'assets/css/admin.css' ) );

	if ( ta_is_offer_edit_screen() ) {
		wp_enqueue_script(
			'ta-admin',
			get_theme_file_uri( 'assets/js/admin.js' ),
			array(),
			ta_asset_version( 'assets/js/admin.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
}
add_action( 'admin_enqueue_scripts', 'ta_offer_admin_assets' );
