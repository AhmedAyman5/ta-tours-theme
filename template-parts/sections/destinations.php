<?php
/**
 * Home: popular destinations. Each card opens WhatsApp with a prefilled message.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="ta-section ta-section--white" aria-labelledby="ta-dest-title">
	<div class="ta-container">
		<?php
		ta_section_head(
			array(
				'id'      => 'ta-dest-title',
				'eyebrow' => ta_t( 'dest_eyebrow' ),
				'title'   => ta_t( 'dest_title' ),
				'intro'   => ta_t( 'dest_intro' ),
			)
		);
		?>

		<ul class="ta-destinations" role="list" data-ta-reveal-group>
			<?php
			foreach ( ta_destinations() as $ta_dest ) :
				$ta_name = ta_t( $ta_dest['label'] );
				?>
				<li class="ta-dest">
					<?php
					echo ta_theme_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image().
						$ta_dest['image'],
						ta_t( $ta_dest['label'] . '_alt' ),
						array(
							'class'   => 'ta-dest__img',
							'loading' => 'lazy',
						)
					);
					?>
					<div class="ta-dest__body">
						<h3 class="ta-dest__title"><?php echo esc_html( $ta_name ); ?></h3>
						<p class="ta-dest__text"><?php echo esc_html( ta_t( $ta_dest['label'] . '_text' ) ); ?></p>
						<a class="ta-dest__link" href="<?php echo esc_url( ta_whatsapp_url( sprintf( ta_t( 'dest_wa_message' ), $ta_name ) ) ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( sprintf( ta_t( 'dest_cta_label' ), $ta_name ) . ' ' . ta_t( 'opens_new_tab' ) ); ?>">
							<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php echo esc_html( ta_t( 'dest_cta' ) ); ?></span>
							<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
