<?php
/**
 * Inner page hero: breadcrumb (Home > Page), title and a short intro over a soft sky.
 *
 * Usage: get_template_part( 'template-parts/page-hero', null, array( 'title' => '…', 'intro' => '…' ) );
 * Without a title it falls back to the current page title.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_args  = wp_parse_args(
	$args ?? array(),
	array(
		'title' => '',
		'intro' => '',
	)
);
$ta_title = '' !== $ta_args['title'] ? $ta_args['title'] : get_the_title();
?>
<header class="ta-page-hero">
	<div class="ta-page-hero__clouds" aria-hidden="true"></div>

	<div class="ta-container ta-page-hero__inner" data-reveal-stagger="fade-up">
		<nav class="ta-breadcrumb" aria-label="<?php echo esc_attr( ta_t( 'breadcrumb' ) ); ?>">
			<ol class="ta-breadcrumb__list">
				<li><a href="<?php echo esc_url( ta_home_url() ); ?>"><?php echo esc_html( ta_t( 'nav_home' ) ); ?></a></li>
				<li>
					<?php echo ta_icon( 'chevron', 'ta-icon--flip ta-breadcrumb__sep' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span aria-current="page"><?php echo esc_html( $ta_title ); ?></span>
				</li>
			</ol>
		</nav>

		<h1 class="ta-page-hero__title"><?php echo esc_html( $ta_title ); ?></h1>

		<?php if ( '' !== $ta_args['intro'] ) : ?>
			<p class="ta-page-hero__intro"><?php echo esc_html( $ta_args['intro'] ); ?></p>
		<?php endif; ?>
	</div>
</header>
