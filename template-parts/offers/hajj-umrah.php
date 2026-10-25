<?php
/**
 * Offers: Hajj & Umrah feature — photo with badge, text, a 4-step follow-up timeline,
 * the season line and a WhatsApp button.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_hajj_img = ta_theme_image(
	'hajj-umrah.jpg',
	ta_t( 'hajj_img_alt' ),
	array(
		'class'   => 'ta-hajj__img',
		'loading' => 'lazy',
		'sizes'   => '(min-width: 960px) 600px, 100vw',
	)
);

$ta_hajj_steps = array(
	1 => 'whatsapp',
	2 => 'phone',
	3 => 'user',
	4 => 'shield',
);
?>
<section class="ta-section ta-hajj" id="hajj-umrah" aria-labelledby="ta-hajj-title">
	<div class="ta-container">
		<div class="ta-hajj__panel">
			<div class="ta-hajj__intro<?php echo $ta_hajj_img ? '' : ' ta-hajj__intro--single'; ?>">
				<?php if ( $ta_hajj_img ) : ?>
					<figure class="ta-hajj__media" data-reveal="slide-start">
						<?php echo $ta_hajj_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image(). ?>
					</figure>
				<?php endif; ?>

				<div class="ta-hajj__text" data-reveal="slide-end" data-reveal-delay="100">
					<p class="ta-eyebrow"><?php echo esc_html( ta_t( 'hajj_eyebrow' ) ); ?></p>
					<h2 class="ta-section__title" id="ta-hajj-title"><?php echo esc_html( ta_t( 'hajj_title' ) ); ?></h2>
					<p class="ta-lead"><?php echo esc_html( ta_t( 'hajj_text' ) ); ?></p>
					<p class="ta-hajj__badge">
						<?php echo ta_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( ta_t( 'hajj_badge' ) ); ?></span>
					</p>
				</div>
			</div>

			<ol class="ta-timeline" role="list" aria-label="<?php echo esc_attr( ta_t( 'hajj_steps_label' ) ); ?>" data-reveal-stagger="fade-up">
				<?php foreach ( $ta_hajj_steps as $ta_number => $ta_step_icon ) : ?>
					<li class="ta-timeline__step">
						<span class="ta-timeline__number" aria-hidden="true"><?php echo esc_html( number_format_i18n( $ta_number ) ); ?></span>
						<div class="ta-timeline__body">
							<h3 class="ta-timeline__title">
								<?php echo ta_icon( $ta_step_icon, 'ta-timeline__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span><?php echo esc_html( ta_t( 'hajj_step_' . $ta_number . '_title' ) ); ?></span>
							</h3>
							<p class="ta-timeline__text"><?php echo esc_html( ta_t( 'hajj_step_' . $ta_number . '_text' ) ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>

			<div class="ta-hajj__footer" data-reveal="fade-up">
				<p class="ta-hajj__season">
					<?php echo ta_icon( 'calendar' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'hajj_season' ) ); ?></span>
				</p>
				<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'hajj_wa_message' ) ) ); ?>" target="_blank" rel="noopener">
					<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'hajj_btn' ) ); ?></span>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>
