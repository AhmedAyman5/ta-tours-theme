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

$ta_offers_url = ta_page_url( 'offers' );
?>
<section class="ta-section" aria-labelledby="ta-latest-offers-title">
	<div class="ta-container">
		<div class="ta-section__head">
			<h2 class="ta-section__title" id="ta-latest-offers-title"><?php echo esc_html( ta_t( 'latest_offers' ) ); ?></h2>
			<?php if ( $ta_offers_url ) : ?>
				<a class="ta-link-arrow" href="<?php echo esc_url( $ta_offers_url ); ?>">
					<span><?php echo esc_html( ta_t( 'view_all_offers' ) ); ?></span>
					<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="ta-grid">
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
