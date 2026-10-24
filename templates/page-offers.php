<?php
/**
 * Template Name: TA – Offers
 *
 * Offers page: page hero, Hajj & Umrah feature, the offers grid (or an empty state),
 * then the shared CTA band with its own copy.
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
			'title' => ta_t( 'offers_page_title' ),
			'intro' => ta_t( 'offers_page_intro' ),
		)
	);

	get_template_part( 'template-parts/offers/hajj-umrah' );
	get_template_part( 'template-parts/offers/grid' );

	get_template_part(
		'template-parts/sections/cta-band',
		null,
		array(
			'title' => ta_t( 'offers_cta_title' ),
			'text'  => ta_t( 'offers_cta_text' ),
		)
	);
endwhile;

get_footer();
