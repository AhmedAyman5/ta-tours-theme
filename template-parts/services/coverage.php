<?php
/**
 * Services: domestic and international travel, two cards.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

// Icon name => string key (text key = key . '_text').
$ta_coverage = array(
	'pin'   => 'coverage_egypt',
	'globe' => 'coverage_world',
);
?>
<section class="ta-section ta-section--sky" aria-labelledby="ta-coverage-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'     => 'ta-coverage-title',
				'title'  => ta_t( 'coverage_title' ),
				'center' => true,
			)
		);
		?>

		<ul class="ta-coverage" role="list" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_coverage as $ta_icon_name => $ta_key ) : ?>
				<li class="ta-coverage__card">
					<span class="ta-coverage__icon"><?php echo ta_icon( $ta_icon_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3 class="ta-coverage__title"><?php echo esc_html( ta_t( $ta_key ) ); ?></h3>
					<p class="ta-coverage__text"><?php echo esc_html( ta_t( $ta_key . '_text' ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
