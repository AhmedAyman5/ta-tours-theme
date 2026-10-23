<?php
/**
 * Template Name: TA – Contact
 *
 * Contact page: page hero, four contact cards, "faster reply" tips, then the map.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'title' => ta_t( 'contact_page_title' ),
			'intro' => ta_t( 'contact_page_intro' ),
		)
	);

	$ta_contact_sections = array(
		'contact/cards',
		'contact/faster-reply',
		'contact/map',
	);

	foreach ( $ta_contact_sections as $ta_section ) {
		get_template_part( 'template-parts/' . $ta_section );
	}
endwhile;

get_footer();
