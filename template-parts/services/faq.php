<?php
/**
 * Services: FAQ accordion (<details>/<summary>) plus FAQPage JSON-LD for the current language.
 *
 * The visible answers may contain links; the JSON-LD answers are plain text.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_faq = ta_faq_items();

$ta_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'inLanguage' => ta_lang(),
	'mainEntity' => array(),
);

foreach ( $ta_faq as $ta_item ) {
	$ta_schema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => $ta_item['q'],
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => wp_strip_all_tags( $ta_item['a'] ),
		),
	);
}
?>
<section class="ta-section ta-section--white" aria-labelledby="ta-faq-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'     => 'ta-faq-title',
				'title'  => ta_t( 'faq_title' ),
				'center' => true,
			)
		);
		?>

		<div class="ta-faq" data-reveal-stagger="fade-up">
			<?php foreach ( $ta_faq as $ta_item ) : ?>
				<details class="ta-faq__item">
					<summary class="ta-faq__question">
						<span><?php echo esc_html( $ta_item['q'] ); ?></span>
						<?php echo ta_icon( 'chevron', 'ta-faq__chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</summary>
					<div class="ta-faq__answer">
						<p><?php echo wp_kses_post( $ta_item['a'] ); ?></p>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<script type="application/ld+json"><?php echo wp_json_encode( $ta_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP ); ?></script>
