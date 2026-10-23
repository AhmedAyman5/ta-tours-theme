<?php
/**
 * Template Name: TA – Services
 *
 * Services page: page hero, intro, one row per service, domestic & international,
 * how it works, FAQ, then the shared CTA band.
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
			'title' => ta_t( 'services_page_title' ),
			'intro' => ta_t( 'services_page_intro' ),
		)
	);

	$ta_services_sections = array(
		'services/intro',
		'services/rows',
		'services/coverage',
		'sections/how-it-works',
		'services/faq',
		'sections/cta-band',
	);

	foreach ( $ta_services_sections as $ta_section ) {
		get_template_part( 'template-parts/' . $ta_section );
	}
endwhile;

get_footer();
