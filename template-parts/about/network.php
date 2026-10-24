<?php
/**
 * About: our network of franchise branches, and a note about the Mansoura branch.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-section--white" aria-labelledby="ta-network-title">
	<div class="ta-container ta-split ta-split--network">
		<div class="ta-split__text" data-reveal="slide-start">
			<p class="ta-eyebrow"><?php echo esc_html( ta_t( 'about_network_eyebrow' ) ); ?></p>
			<h2 class="ta-section__title" id="ta-network-title"><?php echo esc_html( ta_t( 'about_network_title' ) ); ?></h2>
			<p><?php echo esc_html( ta_t( 'about_network_text' ) ); ?></p>
			<p class="ta-hajj-note"><?php echo esc_html( ta_t( 'about_network_hajj' ) ); ?></p>
		</div>

		<div class="ta-note" data-reveal="slide-end">
			<span class="ta-note__icon"><?php echo ta_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<p class="ta-note__text"><?php echo esc_html( ta_t( 'about_network_note' ) ); ?></p>
		</div>
	</div>
</section>
