<?php
/**
 * 404 template.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<header class="ta-page-header">
	<div class="ta-container">
		<h1 class="ta-page-header__title"><?php echo esc_html( ta_t( 'not_found_title' ) ); ?></h1>
	</div>
</header>
<div class="ta-section">
	<div class="ta-container ta-prose ta-text-center">
		<p><?php echo esc_html( ta_t( 'not_found_text' ) ); ?></p>
		<p>
			<a class="ta-btn ta-btn--primary" href="<?php echo esc_url( ta_home_url() ); ?>">
				<span><?php echo esc_html( ta_t( 'back_home' ) ); ?></span>
				<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</p>
	</div>
</div>
<?php
get_footer();
