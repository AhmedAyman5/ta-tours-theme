<?php
/**
 * About: brand values, three cards with icons.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

// Icon name => string key (text key = key . '_text').
$ta_values = array(
	'cloud'    => 'about_value_ease',
	'suitcase' => 'about_value_hassle',
	'search'   => 'about_value_detail',
);
?>
<section class="ta-section ta-section--sky" aria-labelledby="ta-values-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'     => 'ta-values-title',
				'title'  => ta_t( 'about_values_title' ),
				'center' => true,
			)
		);
		?>

		<ul class="ta-grid ta-grid--3 ta-features" role="list" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_values as $ta_icon_name => $ta_key ) : ?>
				<li class="ta-feature ta-feature--card">
					<span class="ta-feature__icon"><?php echo ta_icon( $ta_icon_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3 class="ta-feature__title"><?php echo esc_html( ta_t( $ta_key ) ); ?></h3>
					<p class="ta-feature__text"><?php echo esc_html( ta_t( $ta_key . '_text' ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
