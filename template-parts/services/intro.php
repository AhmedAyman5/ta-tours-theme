<?php
/**
 * Services: short centered intro.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-services-intro" aria-labelledby="ta-services-intro-title">
	<div class="ta-container ta-prose ta-text-center" data-reveal-stagger="fade-up">
		<p class="ta-eyebrow"><?php echo esc_html( ta_t( 'services_intro_eyebrow' ) ); ?></p>
		<h2 class="ta-section__title" id="ta-services-intro-title"><?php echo esc_html( ta_t( 'services_intro_title' ) ); ?></h2>
		<p class="ta-lead"><?php echo esc_html( ta_t( 'services_intro_text' ) ); ?></p>
	</div>
</section>
