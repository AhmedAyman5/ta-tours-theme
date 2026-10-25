<?php
/**
 * Offer card. Use inside a loop over "offer" posts.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_title   = get_the_title();
$ta_raw     = html_entity_decode( wp_strip_all_tags( get_post_field( 'post_title', get_the_ID(), 'raw' ) ), ENT_QUOTES, 'UTF-8' );
$ta_excerpt = wp_trim_words( wp_strip_all_tags( strip_shortcodes( excerpt_remove_blocks( get_post_field( 'post_content', get_the_ID(), 'raw' ) ) ) ), 25, '…' );
$ta_wa_url  = ta_whatsapp_url( sprintf( ta_t( 'offer_wa_message' ), $ta_raw ) );
?>
<article class="ta-card ta-offer-card">
	<div class="ta-card__media">
		<?php
		if ( has_post_thumbnail() ) {
			$ta_thumb_id = get_post_thumbnail_id();
			$ta_alt      = trim( (string) get_post_meta( $ta_thumb_id, '_wp_attachment_image_alt', true ) );

			echo wp_get_attachment_image(
				$ta_thumb_id,
				'ta-offer-card',
				false,
				array(
					'class'   => 'ta-card__img',
					'loading' => 'lazy',
					'sizes'   => '(min-width: 960px) 380px, (min-width: 640px) 50vw, 100vw',
					'alt'     => '' !== $ta_alt ? $ta_alt : $ta_raw,
				)
			);
		} else {
			echo ta_theme_image( 'offer-placeholder.jpg', '', array( 'class' => 'ta-card__img', 'loading' => 'lazy', 'sizes' => '(min-width: 960px) 380px, (min-width: 640px) 50vw, 100vw' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image().
		}
		?>
	</div>

	<div class="ta-card__body">
		<h3 class="ta-card__title"><?php echo esc_html( $ta_title ); ?></h3>

		<?php if ( $ta_excerpt ) : ?>
			<p class="ta-card__text"><?php echo esc_html( $ta_excerpt ); ?></p>
		<?php endif; ?>

		<div class="ta-card__footer">
			<a class="ta-btn ta-btn--whatsapp ta-btn--block" href="<?php echo esc_url( $ta_wa_url ); ?>" target="_blank" rel="noopener">
				<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( ta_t( 'offer_ask' ) ); ?></span>
				<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) . ' — ' . $ta_raw ); ?></span>
			</a>
		</div>
	</div>
</article>
