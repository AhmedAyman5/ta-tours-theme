<?php
/**
 * Contact: four cards — WhatsApp, phones, email, branch visit (all values from inc/config.php).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_email = (string) ta_config( 'email' );
?>
<section class="ta-section" aria-labelledby="ta-contact-cards-title">
	<div class="ta-container">
		<h2 class="ta-visually-hidden" id="ta-contact-cards-title"><?php echo esc_html( ta_t( 'contact_cards_title' ) ); ?></h2>

		<ul class="ta-contact-cards" role="list" data-reveal-stagger="fade-up">
			<li class="ta-contact-card">
				<span class="ta-contact-card__icon ta-contact-card__icon--whatsapp"><?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="ta-contact-card__title"><?php echo esc_html( ta_t( 'contact_whatsapp_title' ) ); ?></h3>
				<p class="ta-contact-card__text"><?php echo esc_html( ta_t( 'contact_whatsapp_text' ) ); ?></p>
				<div class="ta-contact-card__action">
					<a class="ta-btn ta-btn--whatsapp ta-btn--block" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
						<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( ta_t( 'contact_whatsapp_btn' ) ); ?></span>
						<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
					</a>
				</div>
			</li>

			<li class="ta-contact-card">
				<span class="ta-contact-card__icon"><?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="ta-contact-card__title"><?php echo esc_html( ta_t( 'contact_call_title' ) ); ?></h3>
				<p class="ta-contact-card__text"><?php echo esc_html( ta_t( 'contact_call_text' ) ); ?></p>
				<ul class="ta-contact-card__action ta-contact-card__links" role="list">
					<?php foreach ( (array) ta_config( 'phones' ) as $ta_phone ) : ?>
						<li>
							<a href="<?php echo esc_url( ta_tel_url( $ta_phone ), array( 'tel' ) ); ?>">
								<?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<bdi dir="ltr"><?php echo esc_html( $ta_phone ); ?></bdi>
							</a>
						</li>
					<?php endforeach; ?>
					<?php $ta_landline = ta_config( 'landline' ); ?>
					<li>
						<a href="<?php echo esc_url( ta_tel_url( $ta_landline['tel'] ), array( 'tel' ) ); ?>">
							<?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php echo esc_html( ta_t( 'landline' ) ); ?>:</span>
							<bdi dir="ltr"><?php echo esc_html( $ta_landline['display'] ); ?></bdi>
						</a>
					</li>
				</ul>
			</li>

			<li class="ta-contact-card">
				<span class="ta-contact-card__icon"><?php echo ta_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="ta-contact-card__title"><?php echo esc_html( ta_t( 'contact_email_title' ) ); ?></h3>
				<p class="ta-contact-card__text"><?php echo esc_html( ta_t( 'contact_email_text' ) ); ?></p>
				<div class="ta-contact-card__action ta-contact-card__links">
					<a href="<?php echo esc_url( 'mailto:' . $ta_email, array( 'mailto' ) ); ?>">
						<?php echo ta_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<bdi dir="ltr"><?php echo esc_html( $ta_email ); ?></bdi>
					</a>
				</div>
			</li>

			<li class="ta-contact-card">
				<span class="ta-contact-card__icon"><?php echo ta_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="ta-contact-card__title"><?php echo esc_html( ta_t( 'contact_visit_title' ) ); ?></h3>
				<p class="ta-contact-card__text"><?php echo esc_html( ta_t( 'contact_visit_text' ) ); ?></p>
				<address class="ta-contact-card__address"><?php echo esc_html( ta_pick( ta_config( 'address' ) ) ); ?></address>
				<div class="ta-contact-card__action">
					<a class="ta-btn ta-btn--outline ta-btn--block" href="<?php echo esc_url( ta_directions_url() ); ?>" target="_blank" rel="noopener">
						<?php echo ta_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( ta_t( 'contact_directions_btn' ) ); ?></span>
						<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
					</a>
				</div>
			</li>
		</ul>
	</div>
</section>
