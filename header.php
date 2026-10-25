<?php
/**
 * Site header.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_switch = ta_language_switch();
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="ta-skip-link" href="#ta-main"><?php echo esc_html( ta_t( 'skip_to_content' ) ); ?></a>

<header class="ta-header" data-ta-header>
	<div class="ta-container ta-header__inner">
		<a class="ta-header__logo" href="<?php echo esc_url( ta_home_url() ); ?>" aria-label="<?php echo esc_attr( ta_t( 'home_link_label' ) ); ?>">
			<?php
			$ta_logo = ta_theme_image( 'logo-blue.png', '', array( 'class' => 'ta-header__logo-img', 'sizes' => '52px' ) );
			echo $ta_logo ? $ta_logo : '<span class="ta-header__brand">' . esc_html( ta_pick( ta_config( 'brand' ) ) ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image().
			?>
		</a>

		<button class="ta-header__toggle" type="button" aria-expanded="false" aria-controls="ta-header-panel" data-ta-menu-toggle>
			<?php echo ta_icon( 'menu', 'ta-header__toggle-open' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo ta_icon( 'close', 'ta-header__toggle-close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'menu' ) ); ?></span>
		</button>

		<div class="ta-header__panel" id="ta-header-panel" data-ta-menu-panel>
			<nav class="ta-nav" aria-label="<?php echo esc_attr( ta_t( 'primary_nav' ) ); ?>">
				<?php ta_nav_list( 'ta-nav__list' ); ?>
			</nav>

			<div class="ta-header__actions">
				<?php if ( $ta_switch ) : ?>
					<a class="ta-lang-switch" href="<?php echo esc_url( $ta_switch['url'] ); ?>" hreflang="<?php echo esc_attr( $ta_switch['locale'] ); ?>" lang="<?php echo esc_attr( $ta_switch['slug'] ); ?>" aria-label="<?php echo esc_attr( ta_t( 'lang_switch_label' ) . ': ' . $ta_switch['label'] ); ?>">
						<?php echo ta_icon( 'globe' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( $ta_switch['label'] ); ?></span>
					</a>
				<?php endif; ?>

				<a class="ta-btn ta-btn--whatsapp ta-btn--sm" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
					<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( ta_t( 'whatsapp' ) ); ?></span>
					<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
				</a>
			</div>
		</div>
	</div>
</header>

<main id="ta-main" class="ta-main" tabindex="-1">
