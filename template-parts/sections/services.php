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

		<ul class="ta-grid ta-features" role="list" data-ta-reveal-group>
			<?php foreach ( ta_services() as $ta_service ) : ?>
				<li class="ta-feature">
					<span class="ta-feature__icon"><?php echo ta_icon( $ta_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3 class="ta-feature__title"><?php echo esc_html( ta_t( $ta_service['label'] ) ); ?></h3>
					<p class="ta-feature__text"><?php echo esc_html( ta_t( $ta_service['label'] . '_text' ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
