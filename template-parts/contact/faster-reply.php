<?php
/**
 * Contact: "Get a faster reply" box — what to include in a message.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-section--sky" aria-labelledby="ta-reply-title">
	<div class="ta-container">
		<div class="ta-reply" data-reveal="zoom-in">
			<span class="ta-reply__icon"><?php echo ta_icon( 'bulb' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<h2 class="ta-reply__title" id="ta-reply-title"><?php echo esc_html( ta_t( 'contact_reply_title' ) ); ?></h2>
			<p class="ta-reply__text"><?php echo esc_html( ta_t( 'contact_reply_text' ) ); ?></p>

			<ul class="ta-checklist ta-reply__list" role="list" data-reveal-stagger="fade-up">
				<?php for ( $ta_i = 1; $ta_i <= 5; $ta_i++ ) : ?>
					<li<?php echo 5 === $ta_i ? ' class="ta-checklist__item--hajj"' : ''; ?>>
						<span class="ta-checklist__icon"><?php echo ta_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span><?php echo esc_html( ta_t( 'contact_reply_point_' . $ta_i ) ); ?></span>
					</li>
				<?php endfor; ?>
			</ul>

			<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
				<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( ta_t( 'contact_whatsapp_btn' ) ); ?></span>
				<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
			</a>
		</div>
	</div>
</section>
