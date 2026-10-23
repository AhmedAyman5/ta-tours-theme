<?php
/**
 * Template Name: TA – About
 *
 * About page: page hero, then the about sections in order, then the shared CTA band.
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
			'title' => ta_t( 'about_title' ),
			'intro' => ta_t( 'about_intro' ),
		)
	);

	$ta_about_sections = array(
		'about/story',
		'about/facts',
		'about/network',
		'about/values',
		'about/trust',
		'about/vision',
		'about/branch',
		'sections/cta-band',
	);

	foreach ( $ta_about_sections as $ta_section ) {
		get_template_part( 'template-parts/' . $ta_section );
	}
endwhile;

get_footer();
