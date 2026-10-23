<?php
/**
 * Front page: the home sections, in order.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ta_home_sections = array(
	'hero',
	'latest-offers',
	'services',
	'how-it-works',
	'why-us',
	'destinations',
	'cta-band',
);

foreach ( $ta_home_sections as $ta_section ) {
	get_template_part( 'template-parts/sections/' . $ta_section );
}

get_footer();
