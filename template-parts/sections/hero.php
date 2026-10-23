<?php
/**
 * Home: hero (cloud photo + headline) with the brand-blue band and CTAs overlapping its base.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_offers_url = ta_page_url( 'offers' );
?>
<section class="ta-hero" aria-labelledby="ta-hero-title">
	<div class="ta-hero__media">
		<?php
		// Above the fold: never lazy, fetched first.
		echo ta_theme_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image().
			'hero-clouds.jpg',
			ta_t( 'hero_image_alt' ),
			array(
				'class'         => 'ta-hero__img',
				'loading'       => 'eager',
				'fetchpriority' => 'high',
				'decoding'      => 'sync',
			)
		);
		?>
	</div>

	<div class="ta-container ta-hero__inner">
		<p class="ta-hero__eyebrow"><?php echo esc_html( ta_t( 'hero_eyebrow' ) ); ?></p>
		<h1 class="ta-hero__title" id="ta-hero-title"><?php echo esc_html( ta_t( 'tagline' ) ); ?></h1>
		<p class="ta-hero__subline"><?php echo esc_html( ta_t( 'hero_subline' ) ); ?></p>
	</div>

	<div class="ta-container">
		<div class="ta-band ta-hero__band">
			<p class="ta-band__text"><?php echo esc_html( ta_t( 'hero_band_text' ) ); ?></p>
			<div class="ta-btn-group">
				<a class="ta-btn ta-btn--light" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
					<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'book_whatsapp' ) ); ?></span>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
				</a>
				<?php if ( $ta_offers_url ) : ?>
					<a class="ta-btn ta-btn--outline-light" href="<?php echo esc_url( $ta_offers_url ); ?>">
						<span><?php echo esc_html( ta_t( 'view_offers' ) ); ?></span>
						<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
