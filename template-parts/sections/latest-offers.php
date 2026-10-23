<?php
/**
 * Home: the 6 newest offers in the current language. Hidden when there are none.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_offers = ta_offers_query(
	array(
		'posts_per_page' => 6,
		'no_found_rows'  => true,
	)
);

if ( ! $ta_offers->have_posts() ) {
	return;
}
?>
<section class="ta-section ta-section--offers" aria-labelledby="ta-latest-offers-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-latest-offers-title',
				'eyebrow' => ta_t( 'offers_eyebrow' ),
				'title'   => ta_t( 'latest_offers' ),
				'intro'   => ta_t( 'latest_offers_intro' ),
				'url'     => ta_page_url( 'offers' ),
				'link'    => ta_t( 'view_all_offers' ),
			)
		);
		?>

		<div class="ta-grid" data-reveal-stagger="fade-up">
			<?php
			while ( $ta_offers->have_posts() ) :
				$ta_offers->the_post();
				get_template_part( 'template-parts/offer-card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
