<?php
/**
 * Front page (Phase 1: temporary — hero + latest offers only).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/sections/hero' );
get_template_part( 'template-parts/sections/latest-offers' );

get_footer();
