<?php
/**
 * Home: the featured Hajj & Umrah card, then the other services with inline SVG icons.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-section--white" aria-labelledby="ta-services-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-services-title',
				'eyebrow' => ta_t( 'services_eyebrow' ),
				'title'   => ta_t( 'services_title' ),
				'intro'   => ta_t( 'services_intro' ),
				'url'     => ta_page_url( 'services' ),
				'link'    => ta_t( 'services_link' ),
			)
		);
		?>

		<?php
		foreach ( ta_services() as $ta_key => $ta_service ) :
			if ( ! $ta_service['featured'] ) {
				continue;
			}
			$ta_url = ta_service_url( $ta_key );
			?>
			<div class="ta-feature ta-feature--featured<?php echo $ta_url ? ' ta-feature--link' : ''; ?>" data-reveal="fade-up">
				<span class="ta-feature__icon"><?php echo ta_icon( $ta_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div class="ta-feature__body">
					<p class="ta-badge-gold">
						<?php echo ta_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( ta_t( $ta_service['label'] . '_badge' ) ); ?></span>
					</p>
					<h3 class="ta-feature__title">
						<?php if ( $ta_url ) : ?>
							<a class="ta-feature__link" href="<?php echo esc_url( $ta_url ); ?>"><?php echo esc_html( ta_t( $ta_service['label'] ) ); ?></a>
						<?php else : ?>
							<?php echo esc_html( ta_t( $ta_service['label'] ) ); ?>
						<?php endif; ?>
					</h3>
					<p class="ta-feature__text"><?php echo esc_html( ta_t( $ta_service['label'] . '_text' ) ); ?></p>
				</div>
				<?php if ( $ta_url ) : ?>
					<span class="ta-feature__arrow" aria-hidden="true"><?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>

		<ul class="ta-grid ta-features" role="list" data-reveal-stagger="fade-up">
			<?php
			foreach ( ta_services() as $ta_key => $ta_service ) :
				if ( $ta_service['featured'] ) {
					continue;
				}
				$ta_url = ta_service_url( $ta_key );
				?>
				<li class="ta-feature<?php echo $ta_url ? ' ta-feature--link' : ''; ?>">
					<span class="ta-feature__icon"><?php echo ta_icon( $ta_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3 class="ta-feature__title">
						<?php if ( $ta_url ) : ?>
							<a class="ta-feature__link" href="<?php echo esc_url( $ta_url ); ?>"><?php echo esc_html( ta_t( $ta_service['label'] ) ); ?></a>
						<?php else : ?>
							<?php echo esc_html( ta_t( $ta_service['label'] ) ); ?>
						<?php endif; ?>
					</h3>
					<p class="ta-feature__text"><?php echo esc_html( ta_t( $ta_service['label'] . '_text' ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
