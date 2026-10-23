<?php
/**
 * About: our story (text + travel photo).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_story_img = ta_theme_image(
	'about-travel.jpg',
	ta_t( 'about_story_img_alt' ),
	array(
		'class'   => 'ta-split__img',
		'loading' => 'lazy',
	)
);
?>
<section class="ta-section" aria-labelledby="ta-story-title">
	<div class="ta-container ta-split<?php echo $ta_story_img ? '' : ' ta-split--single'; ?>">
		<div class="ta-split__text" data-reveal="slide-start">
			<p class="ta-eyebrow"><?php echo esc_html( ta_t( 'about_story_eyebrow' ) ); ?></p>
			<h2 class="ta-section__title" id="ta-story-title"><?php echo esc_html( ta_t( 'about_story_title' ) ); ?></h2>
			<p class="ta-lead"><?php echo esc_html( ta_t( 'about_story_p1' ) ); ?></p>
			<p><?php echo esc_html( ta_t( 'about_story_p2' ) ); ?></p>
		</div>

		<?php if ( $ta_story_img ) : ?>
			<figure class="ta-split__media" data-reveal="slide-end">
				<?php echo $ta_story_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image(). ?>
			</figure>
		<?php endif; ?>
	</div>
</section>
