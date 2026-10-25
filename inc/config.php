<?php
/**
 * Business facts and contact data — the single source of truth.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

define( 'TA_VERSION', '1.0.0' );

/**
 * Return the theme configuration, or a single key from it.
 *
 * @param string|null $key Optional key to return.
 * @return mixed
 */
function ta_config( $key = null ) {
	static $config = null;

	if ( null === $config ) {
		$config = array(
			'brand'     => array(
				'ar' => 'طيور الجنة',
				'en' => 'TA Tours',
			),
			'brand_official' => array(
				'ar' => 'طيور الجنة',
				'en' => 'Toyor Al-Jannah Tours',
			),
			'founded'   => 2016,
			'branches'  => 21,
			'phones'    => array( '+201038736666', '+201035428936' ),
			'whatsapp'  => '201038736666',
			'email'     => 'info@ta-tours.com',
			'address'   => array(
				'ar' => 'المنصورة، 125 شارع قناة السويس، بجوار خير زمان، أعلى الصفوة للدواجن، الدور الثاني',
				'en' => '125 Suez Canal Street, next to Kheir Zaman, above Al-Safwa Poultry, 2nd floor, Mansoura, Egypt',
			),
			'map_query' => '125 Suez Canal Street, Mansoura, Egypt',
			// WhatsApp number for client support in wp-admin (digits only). Empty hides the help line.
			'support_whatsapp' => '',
		);
	}

	if ( null === $key ) {
		return $config;
	}

	return $config[ $key ] ?? null;
}
