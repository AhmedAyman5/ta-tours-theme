<?php
/**
 * Offers: all offers in the current language, newest first, 12 per page,
 * with pagination. Shows a friendly empty state when there are none.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_offers = ta_offers_query(
	array(
		'posts_per_page' => 12,
		'paged'          => ta_current_page_number(),
	)
);
?>
<section class="ta-section ta-section--white ta-offers" id="current-offers" aria-labelledby="ta-offers-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-offers-title',
				'eyebrow' => ta_t( 'offers_grid_eyebrow' ),
				'title'   => ta_t( 'offers_grid_title' ),
				'center'  => true,
			)
		);

		if ( $ta_offers->have_posts() ) :
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

			<?php
			ta_pagination( $ta_offers, ta_t( 'offers_pagination_label' ), 'current-offers' );
		else :
			get_template_part( 'template-parts/offers/empty' );
		endif;
		?>
	</div>
</section>
