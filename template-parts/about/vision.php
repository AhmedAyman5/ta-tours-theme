<?php
/**
 * About: our vision, closing with the tagline as a large statement.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-section--sky ta-vision" aria-labelledby="ta-vision-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-vision-title',
				'eyebrow' => ta_t( 'about_vision_eyebrow' ),
				'title'   => ta_t( 'about_vision_title' ),
				'center'  => true,
			)
		);
		?>

		<p class="ta-vision__text" data-reveal="fade-up"><?php echo esc_html( ta_t( 'about_vision_text' ) ); ?></p>

		<p class="ta-vision__quote" data-reveal="zoom-in">
			<?php echo ta_icon( 'plane', 'ta-vision__plane ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span><?php echo esc_html( ta_t( 'about_vision_quote' ) ); ?></span>
		</p>
	</div>
</section>
