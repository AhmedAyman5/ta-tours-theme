<?php
/**
 * All visible theme UI strings, in Arabic and English.
 *
 * Read them through ta_t( $key ). Strings containing %s / %1$s are sprintf() formats.
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the UI strings table.
 *
 * @return array<string, array{ar: string, en: string}>
 */
function ta_strings() {
	return array(
		// Accessibility and navigation.
		'skip_to_content'     => array(
			'ar' => 'تخطَّ إلى المحتوى',
			'en' => 'Skip to content',
		),
		'menu'                => array(
			'ar' => 'القائمة',
			'en' => 'Menu',
		),
		'primary_nav'         => array(
			'ar' => 'القائمة الرئيسية',
			'en' => 'Main navigation',
		),
		'footer_nav'          => array(
			'ar' => 'روابط التذييل',
			'en' => 'Footer links',
		),
		'lang_switch_label'   => array(
			'ar' => 'اختيار اللغة',
			'en' => 'Choose language',
		),
		'home_link_label'     => array(
			'ar' => 'طيور الجنة — الصفحة الرئيسية',
			'en' => 'TA Tours — home',
		),
		'nav_home'            => array(
			'ar' => 'الرئيسية',
			'en' => 'Home',
		),
		'nav_about'           => array(
			'ar' => 'من نحن',
			'en' => 'About us',
		),
		'nav_services'        => array(
			'ar' => 'خدماتنا',
			'en' => 'Our services',
		),
		'nav_offers'          => array(
			'ar' => 'العروض',
			'en' => 'Offers',
		),
		'nav_contact'         => array(
			'ar' => 'تواصل معنا',
			'en' => 'Contact us',
		),

		// WhatsApp.
		'book_whatsapp'       => array(
			'ar' => 'احجز عبر واتساب',
			'en' => 'Book on WhatsApp',
		),
		'whatsapp'            => array(
			'ar' => 'واتساب',
			'en' => 'WhatsApp',
		),
		'whatsapp_chat_label' => array(
			'ar' => 'تواصل معنا عبر واتساب',
			'en' => 'Chat with us on WhatsApp',
		),
		'wa_default_message'  => array(
			'ar' => 'مرحبًا، أريد الاستفسار عن رحلة.',
			'en' => "Hello, I'd like to ask about a trip.",
		),
		'opens_new_tab'       => array(
			'ar' => '(يفتح في نافذة جديدة)',
			'en' => '(opens in a new tab)',
		),

		// Hero.
		'tagline'             => array(
			'ar' => 'السفر أصبح سهلًا',
			'en' => 'Travel made easy',
		),
		'hero_subline'        => array(
			'ar' => 'حجز طيران وفنادق وباقات عطلات، نخطّطها لك من المنصورة.',
			'en' => 'Flights, hotels and holiday packages, planned for you from Mansoura.',
		),
		'view_offers'         => array(
			'ar' => 'شاهد العروض',
			'en' => 'View offers',
		),

		// Offers.
		'latest_offers'       => array(
			'ar' => 'أحدث العروض',
			'en' => 'Latest offers',
		),
		'view_all_offers'     => array(
			'ar' => 'عرض كل العروض',
			'en' => 'View all offers',
		),
		'offer_ask'           => array(
			'ar' => 'استفسر عبر واتساب',
			'en' => 'Ask on WhatsApp',
		),
		/* translators: %s: offer title. */
		'offer_wa_message'    => array(
			'ar' => 'مرحبًا، أريد الاستفسار عن عرض: %s',
			'en' => "Hello, I'd like to ask about the offer: %s",
		),

		// Footer.
		/* translators: 1: founding year, 2: number of branches. */
		'footer_about'        => array(
			'ar' => 'منذ %1$s، نخطّط رحلاتك بسهولة واهتمام بالتفاصيل عبر %2$s فرعًا في أنحاء مصر. هذا موقع فرع المنصورة.',
			'en' => 'Since %1$s, we have planned easy, detail-focused trips through %2$s branches across Egypt. This is the Mansoura branch.',
		),
		'quick_links'         => array(
			'ar' => 'روابط سريعة',
			'en' => 'Quick links',
		),
		'contact_info'        => array(
			'ar' => 'بيانات التواصل',
			'en' => 'Contact details',
		),
		'phone'               => array(
			'ar' => 'الهاتف',
			'en' => 'Phone',
		),
		'email'               => array(
			'ar' => 'البريد الإلكتروني',
			'en' => 'Email',
		),
		'address'             => array(
			'ar' => 'العنوان',
			'en' => 'Address',
		),
		/* translators: 1: year, 2: brand name. */
		'copyright'           => array(
			'ar' => '© %1$s %2$s. جميع الحقوق محفوظة.',
			'en' => '© %1$s %2$s. All rights reserved.',
		),

		// Generic pages.
		'not_found_title'     => array(
			'ar' => 'الصفحة غير موجودة',
			'en' => 'Page not found',
		),
		'not_found_text'      => array(
			'ar' => 'عذرًا، لم نتمكن من العثور على الصفحة المطلوبة.',
			'en' => "Sorry, we couldn't find the page you were looking for.",
		),
		'back_home'           => array(
			'ar' => 'العودة إلى الرئيسية',
			'en' => 'Back to home',
		),
		'no_content'          => array(
			'ar' => 'لا يوجد محتوى بعد.',
			'en' => 'Nothing here yet.',
		),
	);
}
