<?php
/**
 * Dev tool (not shipped): build responsive WebP variants and the Open Graph image.
 *
 * Usage (from the theme root, plain PHP with GD, no WordPress):
 *   php tools/make-images.php sizes
 *   php tools/make-images.php og /path/to/Gabriela-Regular.ttf /path/to/OpenSans.ttf
 *
 * "sizes" writes assets/images/sizes/{name}-{width}.webp for every JPG/PNG in
 * assets/images/ (widths smaller than the original only). ta_theme_image()
 * picks them up automatically as a srcset. Re-run after replacing a photo.
 *
 * @package ta-tours
 */

if ( 'cli' !== PHP_SAPI ) {
	exit( 1 );
}

$ta_root   = dirname( __DIR__ );
$ta_images = $ta_root . '/assets/images';
$ta_cmd    = $argv[1] ?? '';

/**
 * Load a JPG or PNG into a true-colour GD image with alpha preserved.
 *
 * @param string $file Path.
 * @return GdImage
 */
function ta_tool_load( $file ) {
	$img = str_ends_with( $file, '.png' ) ? imagecreatefrompng( $file ) : imagecreatefromjpeg( $file );
	imagepalettetotruecolor( $img );
	imagealphablending( $img, false );
	imagesavealpha( $img, true );
	return $img;
}

if ( 'sizes' === $ta_cmd ) {
	$widths = array( 160, 320, 480, 800, 1200 );
	$out    = $ta_images . '/sizes';

	if ( ! is_dir( $out ) ) {
		mkdir( $out, 0755, true );
	}

	foreach ( glob( $ta_images . '/*.{jpg,png}', GLOB_BRACE ) as $file ) {
		$name = pathinfo( $file, PATHINFO_FILENAME );

		if ( in_array( $name, array( 'favicon', 'og-image' ), true ) ) {
			continue;
		}

		$src = ta_tool_load( $file );
		$w   = imagesx( $src );

		foreach ( $widths as $width ) {
			if ( $width >= $w ) {
				continue;
			}
			$dst = imagescale( $src, $width, -1, IMG_BICUBIC );
			imagealphablending( $dst, false );
			imagesavealpha( $dst, true );
			imagewebp( $dst, "$out/$name-$width.webp", 78 );
			echo "$name-$width.webp\n";
		}
	}
	exit( 0 );
}

if ( 'og' === $ta_cmd ) {
	$heading_font = $argv[2] ?? '';
	$body_font    = $argv[3] ?? '';

	$og = imagecreatetruecolor( 1200, 630 );
	imagefill( $og, 0, 0, imagecolorallocate( $og, 0x09, 0x6c, 0x8d ) );

	// Soft sky glow behind the logo.
	imagealphablending( $og, true );
	for ( $r = 360; $r > 0; $r -= 6 ) {
		$alpha = (int) ( 127 - ( 360 - $r ) / 360 * 4 );
		imagefilledellipse( $og, 300, 315, $r * 2, $r * 2, imagecolorallocatealpha( $og, 0x7c, 0xaa, 0xd5, $alpha ) );
	}

	// Logo: crop its transparent margin, scale to 420px tall, keep proportions.
	$logo = ta_tool_load( $ta_images . '/logo-white.png' );
	$logo = imagecropauto( $logo, IMG_CROP_TRANSPARENT );
	$lh   = 420;
	$lw   = (int) round( imagesx( $logo ) * $lh / imagesy( $logo ) );
	imagecopyresampled( $og, $logo, 300 - intdiv( $lw, 2 ), 315 - intdiv( $lh, 2 ), 0, 0, $lw, $lh, imagesx( $logo ), imagesy( $logo ) );

	$white = imagecolorallocate( $og, 255, 255, 255 );
	$soft  = imagecolorallocate( $og, 0xe3, 0xf0, 0xf6 );

	imagettftext( $og, 92, 0, 600, 300, $white, $heading_font, 'TA Tours' );
	imagettftext( $og, 34, 0, 606, 370, $soft, $body_font, 'Travel made easy' );
	imagettftext( $og, 22, 0, 608, 430, $soft, $body_font, 'Toyor Al-Jannah Tours · Since 2016' );

	imagejpeg( $og, $ta_images . '/og-image.jpg', 86 );
	echo "og-image.jpg\n";
	exit( 0 );
}

fwrite( STDERR, "Usage: php tools/make-images.php sizes | og <heading.ttf> <body.ttf>\n" );
exit( 1 );
