<?php
/**
 * Home: final call to action over the airplane-wing photo.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-cta-section" aria-labelledby="ta-cta-title">
	<div class="ta-container">
		<div class="ta-cta" data-reveal="zoom-in">
			<?php
			// Decorative background behind the text: empty alt.
			echo ta_theme_image( 'cta-wing.jpg', '', array( 'class' => 'ta-cta__img', 'loading' => 'lazy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image().
			?>
			<div class="ta-cta__content">
				<h2 class="ta-cta__title" id="ta-cta-title"><?php echo esc_html( ta_t( 'cta_title' ) ); ?></h2>
				<p class="ta-cta__text"><?php echo esc_html( ta_t( 'cta_text' ) ); ?></p>
				<a class="ta-btn ta-btn--light" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
					<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'book_whatsapp' ) ); ?></span>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>
