<?php
/**
 * Home: the six services with inline SVG icons.
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

		<ul class="ta-grid ta-features" role="list" data-reveal-stagger="fade-up">
			<?php
			foreach ( ta_services() as $ta_key => $ta_service ) :
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
