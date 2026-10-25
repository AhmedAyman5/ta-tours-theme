<?php
/**
 * The client's admin (Offers Manager role only): Welcome screen, trimmed menu,
 * quiet notices, simple admin bar and footer.
 *
 * Access is enforced by the role's capabilities; hiding menus is only cosmetic.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Welcome screen URL.
 *
 * @return string
 */
function ta_welcome_url() {
	return admin_url( 'admin.php?page=ta-welcome' );
}

/**
 * Welcome page in the menu, and every other top-level item removed.
 *
 * @return void
 */
function ta_client_menu() {
	global $menu;

	if ( ! ta_is_offers_manager() ) {
		return;
	}

	add_menu_page(
		ta_t( 'admin_welcome_menu', ta_admin_lang() ),
		ta_t( 'admin_welcome_menu', ta_admin_lang() ),
		'edit_offers',
		'ta-welcome',
		'ta_welcome_render',
		'dashicons-admin-home',
		2
	);

	$allowed = array( 'ta-welcome', 'edit.php?post_type=offer', 'upload.php', 'profile.php' );

	foreach ( (array) $menu as $item ) {
		if ( isset( $item[2] ) && ! in_array( $item[2], $allowed, true ) ) {
			remove_menu_page( $item[2] );
		}
	}
}
add_action( 'admin_menu', 'ta_client_menu', 999 );

/**
 * Send the client to the Welcome screen instead of the Dashboard.
 *
 * @return void
 */
function ta_client_redirect_dashboard() {
	if ( ta_is_offers_manager() ) {
		wp_safe_redirect( ta_welcome_url() );
		exit;
	}
}
add_action( 'load-index.php', 'ta_client_redirect_dashboard' );

/**
 * After login, the client lands on the Welcome screen.
 *
 * @param string           $redirect_to Requested redirect.
 * @param string           $requested   Requested redirect (raw).
 * @param WP_User|WP_Error $user        Logged-in user.
 * @return string
 */
function ta_client_login_redirect( $redirect_to, $requested, $user ) {
	if ( ta_is_offers_manager( $user instanceof WP_User ? $user : 0 ) && ( '' === $requested || admin_url() === $redirect_to ) ) {
		return ta_welcome_url();
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'ta_client_login_redirect', 10, 3 );

/**
 * Published offers per language.
 *
 * @return array<string, int> Counts keyed by language slug, or 'all' without Polylang.
 */
function ta_published_offer_counts() {
	if ( ! function_exists( 'pll_count_posts' ) ) {
		return array( 'all' => (int) wp_count_posts( 'offer' )->publish );
	}

	$counts = array();
	foreach ( ta_languages() as $lang ) {
		$counts[ $lang ] = (int) pll_count_posts(
			$lang,
			array(
				'post_type'   => 'offer',
				'post_status' => 'publish',
			)
		);
	}
	return $counts;
}

/**
 * Render the Welcome screen.
 *
 * @return void
 */
function ta_welcome_render() {
	if ( ! current_user_can( 'edit_offers' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'ta-tours' ) );
	}

	$lang    = ta_admin_lang();
	$user    = wp_get_current_user();
	$support = preg_replace( '/\D+/', '', (string) ta_config( 'support_whatsapp' ) );
	?>
	<div class="wrap ta-welcome">
		<div class="ta-welcome__hero">
			<img class="ta-welcome__logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-white.png' ) ); ?>" alt="TA Tours" width="619" height="85">
			<h1><?php echo esc_html( sprintf( ta_t( 'admin_welcome_title', $lang ), $user->display_name ) ); ?></h1>
			<p><?php echo esc_html( ta_t( 'admin_welcome_intro', $lang ) ); ?></p>
			<p class="ta-welcome__actions">
				<a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=offer' ) ); ?>"><?php echo esc_html( ta_t( 'admin_add_offer', $lang ) ); ?></a>
				<a class="button button-hero ta-welcome__secondary" href="<?php echo esc_url( admin_url( 'edit.php?post_type=offer' ) ); ?>"><?php echo esc_html( ta_t( 'admin_all_offers', $lang ) ); ?></a>
			</p>
		</div>

		<div class="ta-welcome__grid">
			<section class="ta-welcome__card">
				<h2><?php echo esc_html( ta_t( 'admin_published', $lang ) ); ?></h2>
				<ul class="ta-welcome__counts">
					<?php foreach ( ta_published_offer_counts() as $key => $count ) : ?>
						<li>
							<span class="ta-welcome__count"><?php echo esc_html( number_format_i18n( $count ) ); ?></span>
							<span><?php echo esc_html( ta_t( 'admin_lang_' . $key, $lang ) ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</section>

			<section class="ta-welcome__card">
				<h2><?php echo esc_html( ta_t( 'admin_guide_title', $lang ) ); ?></h2>
				<ol class="ta-welcome__steps">
					<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
						<li><?php echo esc_html( ta_t( 'admin_guide_' . $i, $lang ) ); ?></li>
					<?php endfor; ?>
				</ol>
			</section>
		</div>

		<?php if ( '' !== $support ) : ?>
			<p class="ta-welcome__help">
				<?php echo esc_html( ta_t( 'admin_help', $lang ) ); ?>
				<a href="<?php echo esc_url( 'https://wa.me/' . $support ); ?>" target="_blank" rel="noopener"><?php echo esc_html( ta_t( 'admin_help_link', $lang ) ); ?></a>
			</p>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Hide notices from WordPress and plugins for the client; keep the theme's own.
 *
 * Runs on in_admin_header, right before the notice hooks fire.
 *
 * @return void
 */
function ta_client_quiet_notices() {
	if ( ! ta_is_offers_manager() ) {
		return;
	}

	foreach ( array( 'admin_notices', 'all_admin_notices', 'user_admin_notices', 'network_admin_notices' ) as $hook ) {
		remove_all_actions( $hook );
	}

	foreach ( ta_own_admin_notices() as $callback ) {
		add_action( 'admin_notices', $callback );
	}
}
add_action( 'in_admin_header', 'ta_client_quiet_notices', 999 );

/**
 * Simplified admin bar: no WordPress logo, comments or "New" menu.
 * "View site" and the Polylang language filter stay.
 *
 * @param WP_Admin_Bar $bar Admin bar.
 * @return void
 */
function ta_client_admin_bar( $bar ) {
	if ( ! ta_is_offers_manager() ) {
		return;
	}

	foreach ( array( 'wp-logo', 'comments', 'new-content', 'updates', 'search' ) as $node ) {
		$bar->remove_node( $node );
	}
}
add_action( 'admin_bar_menu', 'ta_client_admin_bar', 999 );

/**
 * Admin footer text for the client.
 *
 * @param string $text Footer text.
 * @return string
 */
function ta_client_footer_text( $text ) {
	return ta_is_offers_manager() ? esc_html( ta_t( 'admin_footer', ta_admin_lang() ) ) : $text;
}
add_filter( 'admin_footer_text', 'ta_client_footer_text' );

/**
 * Hide the WordPress version in the client's footer.
 *
 * @param string $text Version text.
 * @return string
 */
function ta_client_footer_version( $text ) {
	return ta_is_offers_manager() ? '' : $text;
}
add_filter( 'update_footer', 'ta_client_footer_version', 20 );

/**
 * New Offers Managers get the Arabic admin unless a language was already chosen.
 *
 * @param int    $user_id User ID.
 * @param string $role    New role.
 * @return void
 */
function ta_client_default_locale( $user_id, $role ) {
	if ( ta_offers_role() === $role && '' === (string) get_user_meta( $user_id, 'locale', true ) ) {
		update_user_meta( $user_id, 'locale', 'ar' );
	}
}
add_action( 'set_user_role', 'ta_client_default_locale', 10, 2 );
