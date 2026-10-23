<?php
/**
 * Home: how it works, in three numbered steps.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_steps = array(
	1 => 'whatsapp',
	2 => 'map',
	3 => 'shield',
);
?>
<section class="ta-section" aria-labelledby="ta-steps-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-steps-title',
				'eyebrow' => ta_t( 'steps_eyebrow' ),
				'title'   => ta_t( 'steps_title' ),
				'center'  => true,
			)
		);
		?>

		<ol class="ta-steps" role="list" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_steps as $ta_number => $ta_step_icon ) : ?>
				<li class="ta-step">
					<span class="ta-step__badge">
						<?php echo ta_icon( $ta_step_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span class="ta-step__number" aria-hidden="true"><?php echo esc_html( number_format_i18n( $ta_number ) ); ?></span>
					</span>
					<h3 class="ta-step__title"><?php echo esc_html( ta_t( 'step_' . $ta_number . '_title' ) ); ?></h3>
					<p class="ta-step__text"><?php echo esc_html( ta_t( 'step_' . $ta_number . '_text' ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>

		<p class="ta-steps__cta" data-reveal="fade-up">
			<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
				<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( ta_t( 'step_1_title' ) ); ?></span>
				<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
			</a>
		</p>
	</div>
</section>
