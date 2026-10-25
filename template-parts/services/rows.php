<?php
/**
 * Services: one row per service, image side alternating (start, end, start…).
 *
 * Each row's id is its ta_services() key, so the Home cards can link to #flights etc.
 * The whole row slides in from its image side. The featured row (Hajj & Umrah) gets the
 * gold accent, the Offers page WhatsApp message and a link to the full journey there.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_index = 0;
?>
<div class="ta-service-rows">
	<?php
	foreach ( ta_services() as $ta_key => $ta_service ) :
		$ta_title    = ta_t( $ta_service['label'] );
		$ta_featured = $ta_service['featured'];
		$ta_is_end = 1 === $ta_index % 2;
		$ta_slide  = $ta_is_end ? 'slide-end' : 'slide-start';
		$ta_img    = ta_theme_image(
			$ta_service['image'],
			ta_t( $ta_service['label'] . '_alt' ),
			array(
				'class'         => 'ta-service-row__img',
				'loading'       => 0 === $ta_index ? 'eager' : 'lazy',
				'fetchpriority' => 0 === $ta_index ? 'high' : '',
				'sizes'         => '(min-width: 960px) 600px, 100vw',
			)
		);

		// Alternate the band color too, so each row reads as its own block.
		$ta_classes = 'ta-section ta-service-row' . ( $ta_is_end ? ' ta-service-row--end' : ' ta-section--white' );
		if ( ! $ta_img ) {
			$ta_classes .= ' ta-service-row--no-media';
		}
		if ( $ta_featured ) {
			$ta_classes .= ' ta-service-row--featured';
		}
		++$ta_index;
		?>
		<section class="<?php echo esc_attr( $ta_classes ); ?>" id="<?php echo esc_attr( $ta_key ); ?>" aria-labelledby="ta-service-<?php echo esc_attr( $ta_key ); ?>-title">
			<div class="ta-container ta-service-row__inner">
				<?php if ( $ta_img ) : ?>
					<figure class="ta-service-row__media" data-reveal="<?php echo esc_attr( $ta_slide ); ?>">
						<?php echo $ta_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image(). ?>
					</figure>
				<?php endif; ?>

				<div class="ta-service-row__body" data-reveal="<?php echo esc_attr( $ta_slide ); ?>" data-reveal-delay="100">
					<span class="ta-feature__icon"><?php echo ta_icon( $ta_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h2 class="ta-section__title" id="ta-service-<?php echo esc_attr( $ta_key ); ?>-title"><?php echo esc_html( $ta_title ); ?></h2>
					<p class="ta-lead"><?php echo esc_html( ta_t( $ta_service['label'] . '_desc' ) ); ?></p>

					<ul class="ta-checklist" role="list">
						<?php for ( $ta_i = 1; $ta_i <= 3; $ta_i++ ) : ?>
							<li>
								<span class="ta-checklist__icon"><?php echo ta_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<span><?php echo esc_html( ta_t( $ta_service['label'] . '_point_' . $ta_i ) ); ?></span>
							</li>
						<?php endfor; ?>
					</ul>

					<?php if ( $ta_featured ) : ?>
						<div class="ta-btn-group ta-service-row__actions">
							<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'hajj_wa_message' ) ) ); ?>" target="_blank" rel="noopener">
								<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<span><?php echo esc_html( ta_t( 'hajj_btn' ) ); ?></span>
								<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
							</a>
							<?php if ( ta_hajj_offers_url() ) : ?>
								<a class="ta-link-arrow" href="<?php echo esc_url( ta_hajj_offers_url() ); ?>">
									<span><?php echo esc_html( ta_t( 'service_hajj_journey' ) ); ?></span>
									<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php endif; ?>
						</div>
					<?php else : ?>
						<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( sprintf( ta_t( 'service_wa_message' ), $ta_title ) ) ); ?>" target="_blank" rel="noopener">
							<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php echo esc_html( ta_t( 'service_cta' ) ); ?></span>
							<span class="ta-visually-hidden"><?php echo esc_html( ': ' . $ta_title . ' ' . ta_t( 'opens_new_tab' ) ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>
</div>
