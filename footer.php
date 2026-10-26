<?php
/**
 * Site footer and floating WhatsApp button.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_brand = ta_pick( ta_config( 'brand' ) );
?>
</main>

<footer class="ta-footer">
	<div class="ta-container ta-footer__grid">
		<div class="ta-footer__about">
			<a class="ta-footer__logo" href="<?php echo esc_url( ta_home_url() ); ?>" aria-label="<?php echo esc_attr( ta_t( 'home_link_label' ) ); ?>">
				<?php echo ta_theme_image( 'logo-white.png', '', array( 'class' => 'ta-footer__logo-img', 'loading' => 'lazy', 'sizes' => '112px' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image(). ?>
			</a>
			<p><?php echo esc_html( sprintf( ta_t( 'footer_about' ), ta_config( 'founded' ), ta_config( 'branches' ) ) ); ?></p>
		</div>

		<nav class="ta-footer__col" aria-labelledby="ta-footer-links-title">
			<h2 class="ta-footer__title" id="ta-footer-links-title"><?php echo esc_html( ta_t( 'quick_links' ) ); ?></h2>
			<?php
			$ta_hajj_url = ta_hajj_offers_url();
			ta_nav_list(
				'ta-footer__links',
				$ta_hajj_url ? array(
					array(
						'label' => ta_t( 'footer_hajj_link' ),
						'url'   => $ta_hajj_url,
						'class' => 'ta-footer__hajj',
					),
				) : array()
			);
			?>
		</nav>

		<div class="ta-footer__col">
			<h2 class="ta-footer__title"><?php echo esc_html( ta_t( 'contact_info' ) ); ?></h2>
			<ul class="ta-footer__contact">
				<?php foreach ( (array) ta_config( 'phones' ) as $ta_phone ) : ?>
					<li>
						<?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'phone' ) ); ?>:</span>
						<a href="<?php echo esc_url( ta_tel_url( $ta_phone ), array( 'tel' ) ); ?>" dir="ltr"><?php echo esc_html( $ta_phone ); ?></a>
					</li>
				<?php endforeach; ?>
				<?php $ta_landline = ta_config( 'landline' ); ?>
				<li>
					<?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'landline' ) ); ?>:</span>
					<a href="<?php echo esc_url( ta_tel_url( $ta_landline['tel'] ), array( 'tel' ) ); ?>"><bdi dir="ltr"><?php echo esc_html( $ta_landline['display'] ); ?></bdi></a>
				</li>
				<?php $ta_saudi_phone = ta_config( 'saudi_phone' ); ?>
				<li>
					<?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'saudi_phone' ) ); ?>:</span>
					<a href="<?php echo esc_url( ta_tel_url( $ta_saudi_phone['tel'] ), array( 'tel' ) ); ?>"><bdi dir="ltr"><?php echo esc_html( $ta_saudi_phone['display'] ); ?></bdi></a>
				</li>
				<li>
					<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<a href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
						<?php echo esc_html( ta_t( 'whatsapp' ) ); ?>
						<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
					</a>
				</li>
				<li>
					<?php echo ta_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'email' ) ); ?>:</span>
					<a href="<?php echo esc_url( 'mailto:' . ta_config( 'email' ), array( 'mailto' ) ); ?>" dir="ltr"><?php echo esc_html( ta_config( 'email' ) ); ?></a>
				</li>
				<li>
					<?php echo ta_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'address' ) ); ?>:</span>
					<address><?php echo esc_html( ta_pick( ta_config( 'address' ) ) ); ?></address>
				</li>
			</ul>
		</div>
	</div>

	<div class="ta-footer__bottom">
		<div class="ta-container">
			<p><?php echo esc_html( sprintf( ta_t( 'copyright' ), wp_date( 'Y' ), $ta_brand ) ); ?></p>
		</div>
	</div>
</footer>

<a class="ta-wa-float" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ta_t( 'whatsapp_chat_label' ) . ' ' . ta_t( 'opens_new_tab' ) ); ?>">
	<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</a>

<?php wp_footer(); ?>
</body>
</html>
