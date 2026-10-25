<?php
/**
 * Home: hero slideshow (5 destination photos, crossfade + slow zoom) with the headline and CTAs on top.
 *
 * Slide 1 is the LCP image and loads eagerly; slides 2-5 carry their sources in data-*
 * attributes and main.js loads them after the window load event. Without JS, or with
 * reduced motion, only slide 1 shows and the controls stay invisible (space reserved).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

$ta_offers_url = ta_page_url( 'offers' );
// File => caption string key. Missing files are skipped.
$ta_slides = array_filter(
	array(
		'hero-1-wing.jpg'       => 'hero_slide_1',
		'hero-2-madinah.jpg'    => 'hero_slide_2',
		'hero-3-maldives.jpg'   => 'hero_slide_3',
		'hero-4-cappadocia.jpg' => 'hero_slide_4',
		'hero-5-bali.jpg'       => 'hero_slide_5',
	),
	'ta_image_exists',
	ARRAY_FILTER_USE_KEY
);
$ta_files  = array_keys( $ta_slides );
?>
<section class="ta-hero" aria-labelledby="ta-hero-title" data-ta-hero>
	<div class="ta-hero__media">
		<div class="ta-hero__slides" data-parallax="hero">
			<?php
			foreach ( $ta_files as $ta_i => $ta_file ) :
				$ta_attrs = array(
					'class' => 'ta-hero__img',
					'sizes' => '100vw',
				);

				if ( 0 === $ta_i ) {
					// Above the fold and the LCP: never lazy, fetched first.
					$ta_attrs += array(
						'loading'       => 'eager',
						'fetchpriority' => 'high',
						'decoding'      => 'sync',
					);
				} else {
					// No src yet: main.js copies these in after window load.
					$ta_size   = wp_getimagesize( get_theme_file_path( 'assets/images/' . $ta_file ) );
					$ta_attrs += array(
						'src'         => '',
						'srcset'      => '',
						'data-src'    => get_theme_file_uri( 'assets/images/' . $ta_file ),
						'data-srcset' => $ta_size ? ta_image_srcset( $ta_file, (int) $ta_size[0] ) : '',
					);
				}
				?>
				<div class="ta-hero__slide<?php echo 0 === $ta_i ? ' is-active' : ''; ?>" data-ta-slide>
					<?php echo ta_theme_image( $ta_file, '', $ta_attrs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in ta_theme_image(). ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="ta-container ta-hero__inner" data-reveal-stagger="fade-up">
		<p class="ta-hero__eyebrow"><?php echo esc_html( ta_t( 'hero_eyebrow' ) ); ?></p>
		<h1 class="ta-hero__title" id="ta-hero-title"><?php echo esc_html( ta_t( 'tagline' ) ); ?></h1>
		<?php
		// Each "/" gets its own span so the items breathe; <wbr> lets lines wrap after it.
		$ta_subline_items = array_map( 'trim', explode( '/', ta_t( 'hero_subline' ) ) );
		?>
		<p class="ta-hero__subline"><?php echo implode( '<span class="ta-sep" aria-hidden="true">/</span><wbr>', array_map( 'esc_html', $ta_subline_items ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- items escaped above. ?></p>
		<div class="ta-btn-group ta-hero__actions">
			<a class="ta-btn ta-btn--whatsapp" href="<?php echo esc_url( ta_whatsapp_url( ta_t( 'wa_default_message' ) ) ); ?>" target="_blank" rel="noopener">
				<?php echo ta_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( ta_t( 'book_whatsapp' ) ); ?></span>
				<span class="ta-visually-hidden"><?php echo esc_html( ta_t( 'opens_new_tab' ) ); ?></span>
			</a>
			<?php if ( $ta_offers_url ) : ?>
				<a class="ta-btn ta-btn--outline-light" href="<?php echo esc_url( $ta_offers_url ); ?>">
					<span><?php echo esc_html( ta_t( 'view_offers' ) ); ?></span>
					<?php echo ta_icon( 'arrow', 'ta-icon--flip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( $ta_slides ) : ?>
		<div class="ta-hero__bar">
			<?php if ( count( $ta_slides ) > 1 ) : ?>
				<div class="ta-hero__controls" role="group" aria-label="<?php echo esc_attr( ta_t( 'hero_slides_label' ) ); ?>" data-ta-hero-controls>
					<button type="button" class="ta-hero__toggle" data-ta-hero-toggle data-label-pause="<?php echo esc_attr( ta_t( 'hero_pause' ) ); ?>" data-label-play="<?php echo esc_attr( ta_t( 'hero_play' ) ); ?>" aria-label="<?php echo esc_attr( ta_t( 'hero_pause' ) ); ?>">
						<svg class="ta-hero__toggle-icon" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false">
							<path class="ta-hero__icon-pause" fill="currentColor" d="M7 5h3.5v14H7zM13.5 5H17v14h-3.5z"/>
							<path class="ta-hero__icon-play" fill="currentColor" d="M8 5.5v13l11-6.5z"/>
						</svg>
					</button>
					<?php foreach ( $ta_files as $ta_i => $ta_file ) : ?>
						<button type="button" class="ta-hero__dot" data-ta-hero-dot aria-label="<?php echo esc_attr( sprintf( ta_t( 'hero_go_to_slide' ), number_format_i18n( $ta_i + 1 ), ta_t( $ta_slides[ $ta_file ] ) ) ); ?>"<?php echo 0 === $ta_i ? ' aria-current="true"' : ''; ?>></button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="ta-hero__captions">
				<?php foreach ( $ta_files as $ta_i => $ta_file ) : ?>
					<p class="ta-hero__caption<?php echo 0 === $ta_i ? ' is-active' : ''; ?>" data-ta-caption<?php echo 0 === $ta_i ? '' : ' aria-hidden="true"'; ?>><?php echo esc_html( ta_t( $ta_slides[ $ta_file ] ) ); ?></p>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</section>
