<?php
/**
 * Offers: empty state, shown when there are no offers in the current language.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="ta-empty" data-reveal="zoom-in">
	<span class="ta-empty__icon">
		<?php echo ta_icon( 'tag' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
	<h3 class="ta-empty__title"><?php echo esc_html( ta_t( 'offers_empty_title' ) ); ?></h3>
	<p class="ta-empty__text"><?php echo esc_html( ta_t( 'offers_empty_text' ) ); ?></p>
	<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'offers_empty_wa_message' ) ) ); ?>" target="_blank" rel="noopener">
		<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<span><?php echo esc_html( ta_t( 'offers_empty_btn' ) ); ?></span>
		<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
	</a>
</div>
