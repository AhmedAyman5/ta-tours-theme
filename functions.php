<?php
/**
 * TA Tours theme bootstrap.
 *
 * This file only loads the modules in inc/.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_includes = array(
	'config.php',
	'strings.php',
	'i18n.php',
	'template-tags.php',
	'setup.php',
	'enqueue.php',
	'cpt-offers.php',
	'admin-offer-editor.php',
	'admin-branding.php',
	'admin-setup-tool.php',
);

foreach ( $ta_includes as $ta_file ) {
	require_once get_theme_file_path( 'inc/' . $ta_file );
}

unset( $ta_includes, $ta_file );
