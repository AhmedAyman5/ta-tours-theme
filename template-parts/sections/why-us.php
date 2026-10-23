<?php
/**
 * Home: why TA Tours — only facts from the brief.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_founded = (string) ta_config( 'founded' );

// Each point shows either a big number or an icon.
$ta_points = array(
	array(
		'value' => $ta_founded,
		'title' => ta_t( 'why_since_title' ),
		'text'  => sprintf( ta_t( 'why_since_text' ), $ta_founded ),
	),
	array(
		'value' => (string) ta_config( 'branches' ),
		'title' => ta_t( 'why_branches_title' ),
		'text'  => ta_t( 'why_branches_text' ),
	),
	array(
		'icon'  => 'user',
		'title' => ta_t( 'why_personal_title' ),
		'text'  => ta_t( 'why_personal_text' ),
	),
	array(
		'icon'  => 'tag',
		'title' => ta_t( 'why_deals_title' ),
		'text'  => ta_t( 'why_deals_text' ),
	),
);
?>
<section class="ta-section ta-section--sky" aria-labelledby="ta-why-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-why-title',
				'eyebrow' => ta_t( 'why_eyebrow' ),
				'title'   => ta_t( 'why_title' ),
				'center'  => true,
			)
		);
		?>

		<ul class="ta-why" role="list" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_points as $ta_point ) : ?>
				<li class="ta-why__item">
					<?php if ( ! empty( $ta_point['value'] ) ) : ?>
						<span class="ta-why__value" dir="ltr"><span data-countup><?php echo esc_html( $ta_point['value'] ); ?></span></span>
					<?php else : ?>
						<span class="ta-why__icon"><?php echo ta_icon( $ta_point['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<?php endif; ?>
					<h3 class="ta-why__title"><?php echo esc_html( $ta_point['title'] ); ?></h3>
					<p class="ta-why__text"><?php echo esc_html( $ta_point['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
