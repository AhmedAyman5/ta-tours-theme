<?php
/**
 * Home: hero (sky photo + headline) followed by the brand-blue band with CTAs.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_hero_img   = ta_image_url( 'hero-clouds.jpg' );
$ta_offers_url = ta_page_url( 'offers' );
?>
<section class="ta-hero" aria-labelledby="ta-hero-title"<?php echo $ta_hero_img ? ' style="--ta-hero-image:url(' . esc_url( $ta_hero_img ) . ')"' : ''; ?>>
	<div class="ta-container ta-hero__inner">
		<h1 class="ta-hero__title" id="ta-hero-title"><?php echo esc_html( ta_t( 'tagline' ) ); ?></h1>
	</div>
</section>

<div class="ta-band">
	<div class="ta-container ta-band__inner">
		<p class="ta-band__text"><?php echo esc_html( ta_t( 'hero_subline' ) ); ?></p>
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
