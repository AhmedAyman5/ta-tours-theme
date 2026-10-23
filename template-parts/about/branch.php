<?php
/**
 * About: Mansoura branch card (all values from inc/config.php).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_email = (string) ta_config( 'email' );
$ta_wa    = '+' . preg_replace( '/\D+/', '', (string) ta_config( 'whatsapp' ) );
?>
<section class="ta-section" aria-labelledby="ta-branch-title">
	<div class="ta-container">
		<div class="ta-branch" data-reveal="fade-up">
			<div class="ta-branch__intro">
				<h2 class="ta-branch__title" id="ta-branch-title"><?php echo esc_html( ta_t( 'about_branch_title' ) ); ?></h2>
				<p class="ta-branch__text"><?php echo esc_html( ta_t( 'about_branch_text' ) ); ?></p>
				<a class="ta-btn ta-btn--primary" href="<?php echo esc_url( ta_directions_url() ); ?>" target="_blank" rel="noopener">
					<?php echo ta_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'get_directions' ) ); ?></span>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
				</a>
			</div>

			<dl class="ta-branch__list">
				<div class="ta-branch__item">
					<dt><span class="ta-branch__icon"><?php echo ta_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo esc_html( ta_t( 'address' ) ); ?></span></dt>
					<dd><address><?php echo esc_html( ta_pick( ta_config( 'address' ) ) ); ?></address></dd>
				</div>

				<div class="ta-branch__item">
					<dt><span class="ta-branch__icon"><?php echo ta_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo esc_html( ta_t( 'phone' ) ); ?></span></dt>
					<dd class="ta-branch__phones">
						<?php foreach ( (array) ta_config( 'phones' ) as $ta_phone ) : ?>
							<a href="<?php echo esc_url( ta_tel_url( $ta_phone ), array( 'tel' ) ); ?>" dir="ltr"><?php echo esc_html( $ta_phone ); ?></a>
						<?php endforeach; ?>
					</dd>
				</div>

				<div class="ta-branch__item">
					<dt><span class="ta-branch__icon"><?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo esc_html( ta_t( 'whatsapp' ) ); ?></span></dt>
					<dd>
						<a href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
							<span dir="ltr"><?php echo esc_html( $ta_wa ); ?></span>
							<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
						</a>
					</dd>
				</div>

				<div class="ta-branch__item">
					<dt><span class="ta-branch__icon"><?php echo ta_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo esc_html( ta_t( 'email' ) ); ?></span></dt>
					<dd><a href="<?php echo esc_url( 'mailto:' . $ta_email, array( 'mailto' ) ); ?>" dir="ltr"><?php echo esc_html( $ta_email ); ?></a></dd>
				</div>
			</dl>
		</div>
	</div>
</section>
