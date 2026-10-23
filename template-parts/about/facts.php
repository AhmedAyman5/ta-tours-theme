<?php
/**
 * About: key facts strip with count-up numbers (values come from config).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_facts = array(
	array(
		'value' => (string) ta_config( 'founded' ),
		'label' => ta_t( 'about_fact_founded' ),
	),
	array(
		'value' => (string) ta_config( 'branches' ),
		'label' => ta_t( 'about_fact_branches' ),
	),
	array(
		'value' => (string) count( ta_services() ),
		'label' => ta_t( 'about_fact_services' ),
	),
);
?>
<section class="ta-facts-section" aria-label="<?php echo esc_attr( ta_t( 'about_facts_label' ) ); ?>">
	<div class="ta-container">
		<ul class="ta-facts" role="list" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_facts as $ta_fact ) : ?>
				<li class="ta-fact">
					<span class="ta-fact__value" dir="ltr"><span data-countup><?php echo esc_html( $ta_fact['value'] ); ?></span></span>
					<span class="ta-fact__label"><?php echo esc_html( $ta_fact['label'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
