<?php
/**
 * Contact: Google Maps embed of the branch address (no API key needed).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section" aria-labelledby="ta-map-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'     => 'ta-map-title',
				'title'  => ta_t( 'contact_map_title' ),
				'center' => true,
			)
		);
		?>

		<div class="ta-map" data-reveal="fade-up">
			<iframe
				class="ta-map__frame"
				src="<?php echo esc_url( ta_map_embed_url() ); ?>"
				title="<?php echo esc_attr( ta_t( 'contact_map_title' ) ); ?>"
				width="1200"
				height="420"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				allowfullscreen
			></iframe>
		</div>
	</div>
</section>
