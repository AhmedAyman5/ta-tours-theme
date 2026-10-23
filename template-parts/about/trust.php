<?php
/**
 * About: why travelers trust us, four points with icons.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

// Point number => icon name. Strings: about_trust_{n} and about_trust_{n}_text.
$ta_points = array(
	1 => 'smile',
	2 => 'network',
	3 => 'tag',
	4 => 'repeat',
);
?>
<section class="ta-section ta-section--white" aria-labelledby="ta-trust-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'     => 'ta-trust-title',
				'title'  => ta_t( 'about_trust_title' ),
				'center' => true,
			)
		);
		?>

		<ul class="ta-points" role="list" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_points as $ta_number => $ta_point_icon ) : ?>
				<li class="ta-point">
					<span class="ta-point__icon"><?php echo ta_icon( $ta_point_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<h3 class="ta-point__title"><?php echo esc_html( ta_t( 'about_trust_' . $ta_number ) ); ?></h3>
						<p class="ta-point__text"><?php echo esc_html( ta_t( 'about_trust_' . $ta_number . '_text' ) ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
