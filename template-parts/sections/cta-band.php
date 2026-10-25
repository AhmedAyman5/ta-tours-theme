<?php
/**
 * Final call to action over the airplane-wing photo. Shared by several pages.
 *
 * Optional args (plain text; defaults are the Home copy):
 * get_template_part( 'template-parts/sections/cta-band', null, array( 'title' => '…', 'text' => '…', 'message' => '…' ) );
 * 'message' is the prefilled WhatsApp message.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_args = wp_parse_args(
	$args ?? array(),
	array(
		'title'   => '',
		'text'    => '',
		'message' => '',
	)
);
$ta_cta_title   = '' !== $ta_args['title'] ? $ta_args['title'] : ta_t( 'cta_title' );
$ta_cta_text    = '' !== $ta_args['text'] ? $ta_args['text'] : ta_t( 'cta_text' );
$ta_cta_message = '' !== $ta_args['message'] ? $ta_args['message'] : ta_t( 'wa_default_message' );
?>
<section class="ta-section ta-cta-section" aria-labelledby="ta-cta-title">
	<div class="ta-container">
		<div class="ta-cta" data-reveal="zoom-in">
			<?php
			// Decorative background behind the text: empty alt.
			echo ta_theme_image( 'cta-wing.jpg', '', array( 'class' => 'ta-cta__img', 'loading' => 'lazy', 'sizes' => '(min-width: 1200px) 1200px, 100vw' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image().
			?>
			<div class="ta-cta__content">
				<h2 class="ta-cta__title" id="ta-cta-title"><?php echo esc_html( $ta_cta_title ); ?></h2>
				<p class="ta-cta__text"><?php echo esc_html( $ta_cta_text ); ?></p>
				<a class="ta-btn ta-btn--light" href="<?php echo esc_url( ta_whatsapp_url( $ta_cta_message ) ); ?>" target="_blank" rel="noopener">
					<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'book_whatsapp' ) ); ?></span>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>
