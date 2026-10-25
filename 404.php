<?php
/**
 * 404 template: sky hero, a short apology and the ways back (Home, Offers, WhatsApp).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'title' => ta_t( 'not_found_title' ),
		'intro' => ta_t( 'not_found_text' ),
	)
);

$ta_offers_url = ta_page_url( 'offers' );
?>
<section class="ta-section ta-not-found" aria-label="<?php echo esc_attr( ta_t( 'not_found_links' ) ); ?>">
	<div class="ta-container ta-text-center" data-reveal="fade-up">
		<?php echo ta_icon( 'compass', 'ta-not-found__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<p class="ta-lead"><?php echo esc_html( ta_t( 'not_found_hint' ) ); ?></p>
		<div class="ta-btn-group ta-not-found__actions">
			<a class="ta-btn ta-btn--primary" href="<?php echo esc_url( ta_home_url() ); ?>">
				<span><?php echo esc_html( ta_t( 'back_home' ) ); ?></span>
				<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<?php if ( $ta_offers_url ) : ?>
				<a class="ta-btn ta-btn--outline" href="<?php echo esc_url( $ta_offers_url ); ?>">
					<span><?php echo esc_html( ta_t( 'view_offers' ) ); ?></span>
					<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endif; ?>
			<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
				<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( ta_t( 'whatsapp' ) ); ?></span>
				<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
			</a>
		</div>
	</div>
</section>
<?php
get_footer();
