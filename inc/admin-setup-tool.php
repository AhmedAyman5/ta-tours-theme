<?php
/**
 * Tools → TA Tours Setup: idempotent site setup for deployment.
 *
 * Safe to run many times: existing pages are reused, never duplicated.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Tools submenu page.
 *
 * @return void
 */
function ta_setup_tool_menu() {
	add_management_page(
		__( 'TA Tours Setup', 'ta-tours' ),
		__( 'TA Tours Setup', 'ta-tours' ),
		'manage_options',
		'ta-tours-setup',
		'ta_setup_tool_render'
	);
}
add_action( 'admin_menu', 'ta_setup_tool_menu' );

/**
 * Check that Polylang is active with the ar and en languages.
 *
 * @return string[] Problems found (empty when ready).
 */
function ta_setup_check_polylang() {
	if ( ! function_exists( 'pll_languages_list' ) || ! function_exists( 'pll_set_post_language' ) || ! function_exists( 'pll_save_post_translations' ) ) {
		return array( __( 'Polylang is not active. Install and activate Polylang, then come back here.', 'ta-tours' ) );
	}

	$problems  = array();
	$languages = pll_languages_list( array( 'fields' => 'slug' ) );

	foreach ( ta_languages() as $lang ) {
		if ( ! in_array( $lang, $languages, true ) ) {
			/* translators: %s: language slug. */
			$problems[] = sprintf( __( 'The "%s" language is missing. Add it in Languages → Languages.', 'ta-tours' ), $lang );
		}
	}

	return $problems;
}

/**
 * Find an existing page by slug (any status except trash), across all languages.
 *
 * @param string $slug Page slug.
 * @return int Page ID or 0.
 */
function ta_setup_find_page( $slug ) {
	$ids = get_posts(
		array(
			'post_type'        => 'page',
			'name'             => $slug,
			'post_status'      => array( 'publish', 'draft', 'pending', 'private', 'future' ),
			'posts_per_page'   => 1,
			'fields'           => 'ids',
			'lang'             => '',
			'suppress_filters' => false,
		)
	);

	return $ids ? (int) $ids[0] : 0;
}

/**
 * Clear Polylang's languages cache (it stores each language's front page ID).
 *
 * @return void
 */
function ta_setup_clean_polylang_cache() {
	if ( function_exists( 'PLL' ) && isset( PLL()->model ) && method_exists( PLL()->model, 'clean_languages_cache' ) ) {
		PLL()->model->clean_languages_cache();
	}
	delete_transient( 'pll_languages_list' );
}

/**
 * Serve each language's front page at its language root (/en/ instead of /en/home-en/).
 *
 * Changes only the "redirect_lang" key of the Polylang option; every other key is saved unchanged.
 *
 * @return array{0: string, 1: string} Log row.
 */
function ta_setup_polylang_front_url() {
	$options = get_option( 'polylang' );

	if ( ! is_array( $options ) ) {
		return array( 'error', __( 'Could not read the Polylang settings. In Languages → Settings → URL modifications, enable "The front page URL contains the language code instead of the page name or page id".', 'ta-tours' ) );
	}

	if ( ! empty( $options['redirect_lang'] ) ) {
		return array( 'exists', __( 'Front page URLs already use the language code (/en/).', 'ta-tours' ) );
	}

	$options['redirect_lang'] = true;
	update_option( 'polylang', $options );

	// Polylang still holds the old value in memory for this request and may rebuild its
	// languages cache with it, so clear that cache again once the request is over.
	add_action( 'shutdown', 'ta_setup_clean_polylang_cache', 2000 );

	return array( 'updated', __( 'Front page URLs now use the language code (/en/ instead of /en/home-en/).', 'ta-tours' ) );
}

/**
 * Run the setup steps.
 *
 * @return array{ok: bool, log: array<int, array{0: string, 1: string}>}
 */
function ta_setup_run() {
	$log      = array();
	$problems = ta_setup_check_polylang();

	if ( $problems ) {
		foreach ( $problems as $problem ) {
			$log[] = array( 'error', $problem );
		}
		return array(
			'ok'  => false,
			'log' => $log,
		);
	}

	$log[] = array( 'exists', __( 'Polylang is active with the Arabic and English languages.', 'ta-tours' ) );

	if ( function_exists( 'pll_default_language' ) && 'ar' !== pll_default_language( 'slug' ) ) {
		$log[] = array( 'error', __( 'Arabic is not the default language. Set it as default in Languages → Languages (pages are still created).', 'ta-tours' ) );
	}

	$home_ar = 0;

	// Step 2: pages, templates, languages, translations.
	foreach ( ta_site_pages() as $key => $page ) {
		$ids      = array();
		$template = '' === $page['template'] ? 'default' : $page['template'];

		foreach ( ta_languages() as $lang ) {
			$slug  = $page['slugs'][ $lang ];
			$title = ta_t( $page['label'], $lang );
			$id    = ta_setup_find_page( $slug );

			if ( $id ) {
				/* translators: 1: page title, 2: slug, 3: language. */
				$log[] = array( 'exists', sprintf( __( 'Page "%1$s" (/%2$s, %3$s) already exists.', 'ta-tours' ), get_the_title( $id ), $slug, $lang ) );
			} else {
				$id = wp_insert_post(
					array(
						'post_type'    => 'page',
						'post_status'  => 'publish',
						'post_title'   => $title,
						'post_name'    => $slug,
						'post_content' => '',
						'meta_input'   => array( '_wp_page_template' => $template ),
					),
					true
				);

				if ( is_wp_error( $id ) ) {
					$log[] = array( 'error', $id->get_error_message() );
					continue;
				}

				/* translators: 1: page title, 2: slug, 3: language. */
				$log[] = array( 'created', sprintf( __( 'Created page "%1$s" (/%2$s, %3$s).', 'ta-tours' ), $title, $slug, $lang ) );
			}

			$current_template = get_post_meta( $id, '_wp_page_template', true );
			if ( ( $current_template ? $current_template : 'default' ) !== $template ) {
				update_post_meta( $id, '_wp_page_template', $template );
				/* translators: 1: slug, 2: template. */
				$log[] = array( 'updated', sprintf( __( 'Set template of /%1$s to %2$s.', 'ta-tours' ), $slug, $template ) );
			}

			if ( pll_get_post_language( $id, 'slug' ) !== $lang ) {
				pll_set_post_language( $id, $lang );
				/* translators: 1: slug, 2: language. */
				$log[] = array( 'updated', sprintf( __( 'Set language of /%1$s to %2$s.', 'ta-tours' ), $slug, $lang ) );
			}

			$ids[ $lang ] = (int) $id;
		}

		if ( count( $ids ) === count( ta_languages() ) ) {
			$existing = pll_get_post_translations( $ids['ar'] );
			ksort( $existing );
			$wanted = $ids;
			ksort( $wanted );

			if ( array_map( 'intval', $existing ) !== $wanted ) {
				pll_save_post_translations( $ids );
				/* translators: %s: page key. */
				$log[] = array( 'updated', sprintf( __( 'Linked the Arabic and English "%s" pages as translations.', 'ta-tours' ), $key ) );
			} else {
				/* translators: %s: page key. */
				$log[] = array( 'exists', sprintf( __( 'The "%s" translations are already linked.', 'ta-tours' ), $key ) );
			}
		}

		if ( 'home' === $key && isset( $ids['ar'] ) ) {
			$home_ar = $ids['ar'];
		}
	}

	// Step 3: static front page.
	if ( $home_ar ) {
		if ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) === $home_ar ) {
			$log[] = array( 'exists', __( 'The Arabic Home page is already the static front page.', 'ta-tours' ) );
		} else {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_ar );
			$log[] = array( 'updated', __( 'Set the Arabic Home page as the static front page.', 'ta-tours' ) );
		}
	}

	$log[] = ta_setup_polylang_front_url();

	// Step 4: permalinks.
	global $wp_rewrite;
	if ( '/%postname%/' === get_option( 'permalink_structure' ) ) {
		$log[] = array( 'exists', __( 'Permalinks already use /%postname%/.', 'ta-tours' ) );
	} else {
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$log[] = array( 'updated', __( 'Set permalinks to /%postname%/.', 'ta-tours' ) );
	}
	// Polylang caches each language's front page; refresh it so /en/ resolves to the English Home.
	ta_setup_clean_polylang_cache();

	flush_rewrite_rules();
	$log[] = array( 'updated', __( 'Flushed rewrite rules.', 'ta-tours' ) );

	return array(
		'ok'  => true,
		'log' => $log,
	);
}

/**
 * Render the setup page (and run setup on a valid POST).
 *
 * @return void
 */
function ta_setup_tool_render() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'ta-tours' ) );
	}

	$result = null;

	if ( isset( $_POST['ta_run_setup'] ) ) {
		check_admin_referer( 'ta_run_setup', 'ta_setup_nonce' );
		$result = ta_setup_run();
	}

	$problems = ta_setup_check_polylang();
	$labels   = array(
		'created' => __( 'Created', 'ta-tours' ),
		'updated' => __( 'Updated', 'ta-tours' ),
		'exists'  => __( 'Already OK', 'ta-tours' ),
		'error'   => __( 'Error', 'ta-tours' ),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'TA Tours Setup', 'ta-tours' ); ?></h1>

		<p><?php esc_html_e( 'Creates the site pages in Arabic and English, links their translations, sets the front page (served at /en/ for English) and permalinks. Safe to run many times — nothing is duplicated.', 'ta-tours' ); ?></p>

		<?php if ( $result ) : ?>
			<div class="notice <?php echo $result['ok'] ? 'notice-success' : 'notice-error'; ?>">
				<p><strong><?php echo $result['ok'] ? esc_html__( 'Setup finished.', 'ta-tours' ) : esc_html__( 'Setup stopped.', 'ta-tours' ); ?></strong></p>
			</div>
			<table class="widefat striped" style="max-width:900px;margin-block:1em">
				<thead><tr><th style="width:120px"><?php esc_html_e( 'Status', 'ta-tours' ); ?></th><th><?php esc_html_e( 'Details', 'ta-tours' ); ?></th></tr></thead>
				<tbody>
				<?php foreach ( $result['log'] as $row ) : ?>
					<tr>
						<td><strong><?php echo esc_html( $labels[ $row[0] ] ?? $row[0] ); ?></strong></td>
						<td><?php echo esc_html( $row[1] ); ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>

		<?php if ( $problems ) : ?>
			<div class="notice notice-warning inline">
				<p><strong><?php esc_html_e( 'Before running setup:', 'ta-tours' ); ?></strong></p>
				<ol>
					<?php foreach ( $problems as $problem ) : ?>
						<li><?php echo esc_html( $problem ); ?></li>
					<?php endforeach; ?>
					<li><?php esc_html_e( 'In Languages → Settings → URL modifications: "The language is set from the directory name" and "Hide URL language information for default language".', 'ta-tours' ); ?></li>
					<li><?php esc_html_e( 'Arabic must be the default language.', 'ta-tours' ); ?></li>
				</ol>
			</div>
		<?php endif; ?>

		<form method="post">
			<?php wp_nonce_field( 'ta_run_setup', 'ta_setup_nonce' ); ?>
			<?php submit_button( __( 'Run setup', 'ta-tours' ), 'primary', 'ta_run_setup', false, $problems ? array( 'disabled' => 'disabled' ) : array() ); ?>
		</form>
	</div>
	<?php
}
