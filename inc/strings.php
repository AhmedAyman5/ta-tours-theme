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
		'hero_eyebrow'        => array(
			'ar' => 'طيور الجنة · فرع المنصورة – قناة السويس',
			'en' => 'TA Tours · Mansoura – Suez Canal branch',
		),
		'tagline'             => array(
			'ar' => 'السفر أصبح سهلًا',
			'en' => 'Travel made easy',
		),
		'hero_subline'        => array(
			'ar' => 'حجز تذاكر طيران / حجز فنادق / رحلات خارجية / رحلات داخلية مع برامج مميزة للحج والعمرة',
			'en' => 'Flight tickets / Hotel booking / International trips / Domestic trips, with special Hajj & Umrah programs',
		),
		'hero_slide_1'        => array(
			'ar' => 'فوق السحاب',
			'en' => 'Above the clouds',
		),
		'hero_slide_2'        => array(
			'ar' => 'المسجد النبوي، المدينة المنورة',
			'en' => 'Al-Masjid an-Nabawi, Madinah',
		),
		'hero_slide_3'        => array(
			'ar' => 'جزر المالديف',
			'en' => 'Maldives',
		),
		'hero_slide_4'        => array(
			'ar' => 'كابادوكيا، تركيا',
			'en' => 'Cappadocia, Turkey',
		),
		'hero_slide_5'        => array(
			'ar' => 'بالي، إندونيسيا',
			'en' => 'Bali, Indonesia',
		),
		'hero_slides_label'   => array(
			'ar' => 'التحكم في عرض صور الوجهات',
			'en' => 'Destination slideshow controls',
		),
		/* translators: 1: slide number, 2: place name. */
		'hero_go_to_slide'    => array(
			'ar' => 'الصورة %1$s: %2$s',
			'en' => 'Slide %1$s: %2$s',
		),
		'hero_pause'          => array(
			'ar' => 'إيقاف عرض الصور مؤقتًا',
			'en' => 'Pause slideshow',
		),
		'hero_play'           => array(
			'ar' => 'تشغيل عرض الصور',
			'en' => 'Play slideshow',
		),
		'view_offers'         => array(
			'ar' => 'شاهد العروض',
			'en' => 'View offers',
		),

		// Offers.
		'offers_eyebrow'      => array(
			'ar' => 'أُضيفت حديثًا',
			'en' => 'Just added',
		),
		'latest_offers'       => array(
			'ar' => 'أحدث العروض',
			'en' => 'Latest offers',
		),
		'latest_offers_intro' => array(
			'ar' => 'عروض جديدة اخترناها لك بعناية. اسألنا عن أي عرض عبر واتساب.',
			'en' => 'Fresh deals, picked with care. Ask us about any of them on WhatsApp.',
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

		// Home: services.
		'services_eyebrow'    => array(
			'ar' => 'خدماتنا',
			'en' => 'What we do',
		),
		'services_title'      => array(
			'ar' => 'كل ما تحتاجه رحلتك في مكان واحد',
			'en' => 'Everything your trip needs, in one place',
		),
		'services_intro'      => array(
			'ar' => 'من الفكرة الأولى حتى العودة إلى البيت، نهتم بالتفاصيل لتستمتع أنت بالرحلة.',
			'en' => 'From the first idea to the trip home, we look after the details so you can enjoy the journey.',
		),
		'services_link'       => array(
			'ar' => 'تعرّف على خدماتنا',
			'en' => 'Explore our services',
		),
		// Hajj & Umrah: the featured service (Home card + first Services row).
		'service_hajj'       => array(
			'ar' => 'الحج والعمرة',
			'en' => 'Hajj & Umrah',
		),
		'service_hajj_text'  => array(
			'ar' => 'فريق التشغيل الخاص بنا داخل المملكة معك من الحجز حتى عودتك إلى بيتك بالسلامة.',
			'en' => 'Our operations team inside the Kingdom stays with you from booking to your safe return home.',
		),
		'service_hajj_badge' => array(
			'ar' => 'فريق تشغيل داخل المملكة',
			'en' => 'Operations team in the Kingdom',
		),
		'service_flights'     => array(
			'ar' => 'حجز الطيران',
			'en' => 'Flight booking',
		),
		'service_flights_text' => array(
			'ar' => 'نختار لك أنسب رحلة طيران في الموعد الذي يناسبك، ونحجزها دون عناء.',
			'en' => 'The right flight at the right time, booked for you without the hassle.',
		),
		'service_planning'    => array(
			'ar' => 'برامج الرحلات وتخطيط الإجازات',
			'en' => 'Itineraries & vacation planning',
		),
		'service_planning_text' => array(
			'ar' => 'برنامج واضح لعطلتك يومًا بيوم، مبنيّ على ما تحبه.',
			'en' => 'A clear day-by-day plan for your holiday, built around what you love.',
		),
		'service_tours'       => array(
			'ar' => 'جولات سياحية بمرشدين',
			'en' => 'Guided tours',
		),
		'service_tours_text'  => array(
			'ar' => 'اكتشف كل وجهة في جولات منظّمة تُريك أجمل ما فيها.',
			'en' => 'Discover each destination on organised tours that show you its best side.',
		),
		'service_hotels'      => array(
			'ar' => 'حجز الفنادق',
			'en' => 'Hotel booking',
		),
		'service_hotels_text' => array(
			'ar' => 'إقامة مريحة تناسب ميزانيتك وخطة رحلتك.',
			'en' => 'Comfortable stays that suit your budget and your plans.',
		),
		'service_consultancy' => array(
			'ar' => 'استشارات سفر مخصصة',
			'en' => 'Personalized travel consultancy',
		),
		'service_consultancy_text' => array(
			'ar' => 'لا تعرف من أين تبدأ؟ نساعدك على الاختيار بنصيحة صادقة.',
			'en' => "Not sure where to start? We'll help you choose with honest advice.",
		),
		'service_honeymoon'   => array(
			'ar' => 'باقات شهر العسل',
			'en' => 'Honeymoon packages',
		),
		'service_honeymoon_text' => array(
			'ar' => 'بداية هادئة ورومانسية لحياتكما الجديدة، مع الاهتمام بكل التفاصيل.',
			'en' => 'A calm, romantic start to your new life together, with every detail in place.',
		),

		// Services page: hero and intro.
		'services_page_title'       => array(
			'ar' => 'خدماتنا',
			'en' => 'Our services',
		),
		'services_page_intro'       => array(
			'ar' => 'كل ما تحتاجه رحلتك.. مخطط بعناية وفي مكان واحد.',
			'en' => 'Everything your journey needs, planned with care, in one place.',
		),
		'services_intro_eyebrow'    => array(
			'ar' => 'ماذا نقدّم',
			'en' => 'What we do',
		),
		'services_intro_title'      => array(
			'ar' => 'سفرك.. في أيدٍ أمينة',
			'en' => 'Travel, taken care of',
		),
		'services_intro_text'       => array(
			'ar' => 'سواء كنت تحلم بعطلة قصيرة، أو إجازة عائلية، أو شهر عسل لا يُنسى، يتولى فريقنا التخطيط من أول فكرة حتى لحظة عودتك إلى البيت. اختر الخدمة التي تناسبك، أو أخبرنا بما يدور في ذهنك وسنرتّب لك كل شيء.',
			'en' => "Whether you're dreaming of a quick getaway, a family holiday or the honeymoon of a lifetime, our team handles the planning from the first idea to the moment you land back home. Choose a service below, or tell us what you have in mind and we'll put it all together for you.",
		),

		// Services page: service rows (keys follow the labels in ta_services()).
		'service_cta'               => array(
			'ar' => 'استفسر عن هذه الخدمة',
			'en' => 'Ask about this service',
		),
		'service_wa_message'        => array(
			'ar' => 'مرحبًا، أريد الاستفسار عن خدمة: %s',
			'en' => "Hello, I'd like to ask about: %s",
		),
		// Hajj & Umrah row: WhatsApp button reuses hajj_btn / hajj_wa_message from the Offers page.
		'service_hajj_desc'        => array(
			'ar' => 'رحلة روحانية تستحق راحة بال كاملة. من أول رسالة واتساب ومكالمة تأكيد الحجز، مرورًا بكل يوم تقضيه في المملكة، يبقى فريق التشغيل الخاص بنا في السعودية بجانبك، حتى تعود إلى بيتك بالسلامة.',
			'en' => 'A spiritual journey deserves complete peace of mind. From your first WhatsApp message and the booking confirmation call, through every day in the Kingdom, our full operations team in Saudi Arabia stays by your side and makes sure you return home safely.',
		),
		'service_hajj_point_1'     => array(
			'ar' => 'فريق تشغيل متكامل داخل المملكة',
			'en' => 'Full operations team inside Saudi Arabia',
		),
		'service_hajj_point_2'     => array(
			'ar' => 'متابعة من أول رسالة حتى عودتك إلى بيتك',
			'en' => 'Follow-up from your first message until you return home',
		),
		'service_hajj_point_3'     => array(
			'ar' => 'دعم في كل ما تحتاجه طوال إقامتك',
			'en' => 'Support for anything you need during your stay',
		),
		'service_hajj_alt'         => array(
			'ar' => 'الكعبة المشرفة في المسجد الحرام بمكة المكرمة',
			'en' => 'The Kaaba in Masjid al-Haram, Makkah',
		),
		'service_hajj_journey'     => array(
			'ar' => 'تعرّف على الرحلة كاملة',
			'en' => 'See the full journey',
		),
		'service_flights_desc'      => array(
			'ar' => 'حجوزات طيران سلسة لرحلاتك الداخلية والدولية. نساعدك في اختيار الرحلات المناسبة ونتولى الحجز، لتبدأ رحلتك بكل سلاسة.',
			'en' => 'Seamless airline reservations for domestic and international trips. We help you find suitable flights and handle the booking, so your journey starts smoothly.',
		),
		'service_flights_point_1'   => array(
			'ar' => 'رحلات طيران داخلية ودولية',
			'en' => 'Domestic and international flights',
		),
		'service_flights_point_2'   => array(
			'ar' => 'مساعدة في اختيار المسارات والمواعيد المناسبة',
			'en' => 'Help choosing convenient routes and times',
		),
		'service_flights_point_3'   => array(
			'ar' => 'متابعة معك في كل خطوات الحجز',
			'en' => 'Support throughout your booking',
		),
		'service_flights_alt'       => array(
			'ar' => 'جناح طائرة يظهر من نافذتها فوق السحاب',
			'en' => 'An airplane wing seen through the window above the clouds',
		),
		'service_planning_desc'     => array(
			'ar' => 'برامج رحلات مخططة بعناية حسب وقتك وميزانيتك واهتماماتك. نرتّب أيامك لتقضيها في الاستمتاع، لا في التخطيط.',
			'en' => 'Meticulously planned itineraries built around your time, budget and interests. We organize the days so you can spend them enjoying, not planning.',
		),
		'service_planning_point_1'  => array(
			'ar' => 'برنامج واضح لكل يوم',
			'en' => 'A clear plan for every day',
		),
		'service_planning_point_2'  => array(
			'ar' => 'مصمم حسب ميزانيتك واهتماماتك',
			'en' => 'Built around your budget and interests',
		),
		'service_planning_point_3'  => array(
			'ar' => 'وجهات داخل مصر وخارجها',
			'en' => 'Destinations in Egypt and abroad',
		),
		'service_planning_alt'      => array(
			'ar' => 'خريطة وكاميرا ودفتر ملاحظات وساعة على طاولة خشبية',
			'en' => 'A map, a camera, a notebook and a watch on a wooden table',
		),
		'service_tours_desc'        => array(
			'ar' => 'اكتشف كل وجهة من خلال جولات بمرشدين تُحيي أماكنها وحكاياتها، مع تنظيم كامل لكل التفاصيل.',
			'en' => 'Discover each destination through guided tours that bring its places and stories to life, with every detail organized for you.',
		),
		'service_tours_point_1'     => array(
			'ar' => 'زيارات منظمة لأهم المعالم',
			'en' => 'Organized visits to the main landmarks',
		),
		'service_tours_point_2'     => array(
			'ar' => 'مرشدون يعرّفونك بكل مكان',
			'en' => 'Guides who introduce you to every place',
		),
		'service_tours_point_3'     => array(
			'ar' => 'مواعيد مريحة ومرتبة',
			'en' => 'Comfortable, well-planned schedules',
		),
		'service_tours_alt'         => array(
			'ar' => 'قافلة جمال عند أهرامات الجيزة وقت الغروب',
			'en' => 'A camel caravan by the Pyramids of Giza at sunset',
		),
		'service_hotels_desc'       => array(
			'ar' => 'من الإقامات الهادئة إلى المنتجعات، نساعدك في اختيار الفندق المناسب لرحلتك ونتولى الحجز عنك.',
			'en' => 'From cozy stays to resorts, we help you choose the hotel that fits your trip and take care of the reservation.',
		),
		'service_hotels_point_1'    => array(
			'ar' => 'خيارات تناسب كل ميزانية',
			'en' => 'Options for every budget',
		),
		'service_hotels_point_2'    => array(
			'ar' => 'مساعدة في اختيار الموقع المناسب',
			'en' => 'Help choosing the right location',
		),
		'service_hotels_point_3'    => array(
			'ar' => 'نتولى الحجز بالكامل',
			'en' => 'Reservation handled for you',
		),
		'service_hotels_alt'        => array(
			'ar' => 'حمام سباحة في منتجع تحيط به أشجار النخيل',
			'en' => 'A resort swimming pool surrounded by palm trees',
		),
		'service_consultancy_desc'  => array(
			'ar' => 'لا تعرف من أين تبدأ؟ تحدّث مع فريقنا. نستمع لما تريده ونقترح عليك الوجهات والخطط الأنسب لك.',
			'en' => 'Not sure where to start? Talk to our team. We listen to what you want and suggest the destinations and plans that suit you best.',
		),
		'service_consultancy_point_1' => array(
			'ar' => 'نصائح مصممة لك',
			'en' => 'Advice tailored to you',
		),
		'service_consultancy_point_2' => array(
			'ar' => 'أفكار للوجهات وأفضل أوقات السفر',
			'en' => 'Ideas for destinations and the best times to go',
		),
		'service_consultancy_point_3' => array(
			'ar' => 'توصيات واضحة وصادقة',
			'en' => 'Clear, honest recommendations',
		),
		'service_consultancy_alt'   => array(
			'ar' => 'حاسوب محمول على طاولة تطل على جبال خضراء',
			'en' => 'A laptop on a table overlooking green mountains',
		),
		'service_honeymoon_desc'    => array(
			'ar' => 'ابدآ حياتكما الجديدة برحلة الأحلام. باقات شهر العسل الشاملة إلى وجهات مثل المالديف وتركيا وبالي تتيح لكما الاستمتاع بكل لحظة معًا، بينما نهتم نحن بكل شيء آخر.',
			'en' => 'Start your new life with a dream trip. Our all-inclusive honeymoon packages to destinations like the Maldives, Turkey and Bali let you focus on each other while we take care of everything else.',
		),
		'service_honeymoon_point_1' => array(
			'ar' => 'باقات شاملة',
			'en' => 'All-inclusive packages',
		),
		'service_honeymoon_point_2' => array(
			'ar' => 'وجهات رومانسية مثل المالديف وتركيا وبالي',
			'en' => 'Romantic destinations like the Maldives, Turkey and Bali',
		),
		'service_honeymoon_point_3' => array(
			'ar' => 'كل التفاصيل جاهزة مسبقًا',
			'en' => 'Every detail prepared in advance',
		),
		'service_honeymoon_alt'     => array(
			'ar' => 'أرجوحة على رصيف خشبي فوق البحر وقت الغروب',
			'en' => 'A swing bed on a wooden deck over the sea at sunset',
		),

		// Services page: domestic and international.
		'coverage_title'            => array(
			'ar' => 'قريبًا أو بعيدًا.. نحن معك',
			'en' => "Near or far, we've got you covered",
		),
		'coverage_egypt'            => array(
			'ar' => 'اكتشف مصر',
			'en' => 'Explore Egypt',
		),
		'coverage_egypt_text'       => array(
			'ar' => 'أعد اكتشاف جمال مصر بشواطئها وتاريخها وكرم أهلها، في رحلات مخططة حسب رغبتك.',
			'en' => 'Rediscover the beauty of Egypt, its coasts, its history and its warm hospitality, with trips planned around you.',
		),
		'coverage_world'            => array(
			'ar' => 'اكتشف العالم',
			'en' => 'Discover the world',
		),
		'coverage_world_text'       => array(
			'ar' => 'من مياه المالديف الفيروزية إلى سحر تركيا وبالي، نفتح لك الباب على وجهات لا تُنسى.',
			'en' => 'From the turquoise waters of the Maldives to the magic of Turkey and Bali, we open the door to unforgettable destinations.',
		),

		// Services page: FAQ. faq_5_a holds HTML and is a sprintf() format: %s = Offers page URL.
		'faq_title'                 => array(
			'ar' => 'الأسئلة الشائعة',
			'en' => 'Frequently asked questions',
		),
		'faq_hajj_q'               => array(
			'ar' => 'هل تنظمون رحلات الحج والعمرة؟',
			'en' => 'Do you organize Hajj and Umrah trips?',
		),
		'faq_hajj_a'               => array(
			'ar' => 'نعم، السياحة الدينية من أهم خدماتنا. فريق التشغيل الخاص بنا داخل المملكة يتابعك من أول رسالة حتى تعود إلى بيتك بالسلامة.',
			'en' => 'Yes. Religious tourism is one of our key services. Our full operations team inside Saudi Arabia follows you from your first message until you return home safely.',
		),
		'faq_1_q'                   => array(
			'ar' => 'كيف أحجز رحلة؟',
			'en' => 'How do I book a trip?',
		),
		'faq_1_a'                   => array(
			'ar' => 'أرسل لنا رسالة عبر واتساب أو زُرنا في فرع المنصورة – قناة السويس. أخبرنا بوجهتك ومواعيدك وعدد المسافرين، ونتولى نحن الباقي.',
			'en' => "Send us a message on WhatsApp or visit our Mansoura – Suez Canal branch. Tell us your destination, dates and number of travelers, and we'll take it from there.",
		),
		'faq_2_q'                   => array(
			'ar' => 'هل يمكنكم تخطيط رحلة خاصة بي؟',
			'en' => 'Can you plan a trip just for me?',
		),
		'faq_2_a'                   => array(
			'ar' => 'بالتأكيد. التخطيط المخصص هو جوهر ما نقدمه، فنبني الرحلة حسب ميزانيتك واهتماماتك ومواعيدك.',
			'en' => 'Absolutely. Personalized planning is at the heart of what we do. We build the trip around your budget, interests and schedule.',
		),
		'faq_3_q'                   => array(
			'ar' => 'هل تقدمون رحلات داخل مصر وخارجها؟',
			'en' => 'Do you offer trips inside Egypt and abroad?',
		),
		'faq_3_a'                   => array(
			'ar' => 'نعم، نقدم خدماتنا للسفر الداخلي والدولي على حد سواء.',
			'en' => 'Yes. We serve both domestic and international travel.',
		),
		'faq_4_q'                   => array(
			'ar' => 'ما المعلومات التي أجهّزها قبل التواصل معكم؟',
			'en' => 'What should I prepare before contacting you?',
		),
		'faq_4_a'                   => array(
			'ar' => 'الوجهة المفضلة (أو مجرد أفكار)، ومواعيد السفر، وعدد المسافرين، وميزانية تقريبية. ولو لم تكن متأكدًا بعد، سيساعدك فريقنا في الاختيار.',
			'en' => 'Your preferred destination (or just a few ideas), travel dates, number of travelers and an approximate budget. Not sure yet? Our team will help you decide.',
		),
		'faq_5_q'                   => array(
			'ar' => 'أين أجد أحدث العروض؟',
			'en' => 'Where can I find your latest offers?',
		),
		'faq_5_a'                   => array(
			'ar' => 'زُر <a href="%s">صفحة العروض</a>، حيث نشارك أحدث عروضنا أولًا بأول.',
			'en' => 'Visit our <a href="%s">Offers page</a>, where we share our newest deals.',
		),

		// Home: how it works.
		'steps_eyebrow'       => array(
			'ar' => 'كيف نعمل',
			'en' => 'How it works',
		),
		'steps_title'         => array(
			'ar' => 'رحلتك في ثلاث خطوات سهلة',
			'en' => 'Your trip in three easy steps',
		),
		'step_1_title'        => array(
			'ar' => 'راسلنا عبر واتساب',
			'en' => 'Message us on WhatsApp',
		),
		'step_1_text'         => array(
			'ar' => 'أخبرنا بوجهتك وموعد سفرك ومن سيرافقك.',
			'en' => "Tell us where you'd like to go, when, and who's travelling with you.",
		),
		'step_2_title'        => array(
			'ar' => 'نخطّط رحلتك معك',
			'en' => 'We plan it with you',
		),
		'step_2_text'         => array(
			'ar' => 'نقترح عليك الخيارات ونجيب عن أسئلتك، ونعدّل الخطة حتى تناسبك تمامًا.',
			'en' => 'We suggest options, answer your questions and adjust the plan until it feels just right.',
		),
		'step_3_title'        => array(
			'ar' => 'سافر وأنت مطمئن',
			'en' => 'Travel with peace of mind',
		),
		'step_3_text'         => array(
			'ar' => 'حجوزاتك جاهزة وكل التفاصيل مُراجَعة، فلا يبقى عليك إلا الاستمتاع.',
			'en' => 'Your bookings are ready and every detail is checked, so all you have to do is enjoy.',
		),

		// Home: why TA Tours.
		'why_eyebrow'         => array(
			'ar' => 'لماذا طيور الجنة؟',
			'en' => 'Why TA Tours',
		),
		'why_title'           => array(
			'ar' => 'سافر مع فريق يهتم بأدق التفاصيل',
			'en' => 'Travel with a team that cares about the details',
		),
		'why_since_title'     => array(
			'ar' => 'بداية رحلتنا',
			'en' => 'Where our journey began',
		),
		/* translators: %s: founding year. */
		'why_since_text'      => array(
			'ar' => 'منذ عام %s ونحن نساعد المسافرين على تنظيم رحلات سهلة ومرتّبة.',
			'en' => "Since %s, we've been helping travellers plan easy, well-organised trips.",
		),
		'why_branches_title'  => array(
			'ar' => 'فرعًا في أنحاء مصر',
			'en' => 'Branches across Egypt',
		),
		'why_branches_text'   => array(
			'ar' => 'شبكة واسعة من الفروع، وفرعنا في المنصورة – قناة السويس في خدمتك.',
			'en' => 'A wide franchise network, with our Mansoura – Suez Canal branch here to help you.',
		),
		'why_personal_title'  => array(
			'ar' => 'تخطيط شخصي لكل رحلة',
			'en' => 'Personalised planning',
		),
		'why_personal_text'   => array(
			'ar' => 'نخطّط كل رحلة وفق ميزانيتك ومواعيدك وطريقتك في السفر.',
			'en' => 'Every trip is shaped around your budget, your dates and the way you like to travel.',
		),
		'why_deals_title'     => array(
			'ar' => 'أسعار تنافسية وعروض حصرية',
			'en' => 'Competitive prices & exclusive deals',
		),
		'why_deals_text'      => array(
			'ar' => 'علاقاتنا القوية مع شركات الطيران والفنادق تتيح لنا أن نقدّم لك قيمة أفضل.',
			'en' => 'Strong relationships with airlines and hotels let us offer you better value.',
		),

		'why_kingdom_title'  => array(
			'ar' => 'معك في المملكة',
			'en' => 'With you in the Kingdom',
		),
		'why_kingdom_text'   => array(
			'ar' => 'في الحج والعمرة، فريق التشغيل الخاص بنا في السعودية بجانبك طوال رحلتك.',
			'en' => 'For Hajj and Umrah, our operations team in Saudi Arabia is by your side throughout your trip.',
		),

		// Home: destinations.
		'dest_eyebrow'        => array(
			'ar' => 'وجهات مميّزة',
			'en' => 'Popular destinations',
		),
		'dest_title'          => array(
			'ar' => 'إلى أين وجهتك القادمة؟',
			'en' => 'Where to next?',
		),
		'dest_intro'          => array(
			'ar' => 'وجهات تُلهمك لرحلتك القادمة. اختر وجهتك واسألنا عنها عبر واتساب.',
			'en' => 'A few places to inspire your next trip. Pick one and ask us about it on WhatsApp.',
		),
		'dest_cta'            => array(
			'ar' => 'خطّط لرحلتك',
			'en' => 'Plan your trip',
		),
		/* translators: %s: destination name. */
		'dest_cta_label'      => array(
			'ar' => 'خطّط لرحلتك إلى %s عبر واتساب',
			'en' => 'Plan your trip to %s on WhatsApp',
		),
		/* translators: %s: destination name. */
		'dest_wa_message'     => array(
			'ar' => 'مرحبًا، أريد التخطيط لرحلة إلى %s.',
			'en' => "Hello, I'd like to plan a trip to %s.",
		),
		'dest_maldives'       => array(
			'ar' => 'جزر المالديف',
			'en' => 'Maldives',
		),
		'dest_maldives_text'  => array(
			'ar' => 'مياه فيروزية وفيلات فوق الماء',
			'en' => 'Turquoise lagoons and overwater villas',
		),
		'dest_maldives_alt'   => array(
			'ar' => 'فيلات فوق الماء في بحيرة فيروزية بجزر المالديف',
			'en' => 'Overwater villas on a turquoise lagoon in the Maldives',
		),
		'dest_turkey'         => array(
			'ar' => 'تركيا',
			'en' => 'Turkey',
		),
		'dest_turkey_text'    => array(
			'ar' => 'مناطيد كابادوكيا وسحر إسطنبول',
			'en' => "Cappadocia's balloons and Istanbul's charm",
		),
		'dest_turkey_alt'     => array(
			'ar' => 'مناطيد الهواء الساخن فوق وديان كابادوكيا في تركيا',
			'en' => 'Hot-air balloons over the valleys of Cappadocia, Turkey',
		),
		'dest_bali'           => array(
			'ar' => 'بالي',
			'en' => 'Bali',
		),
		'dest_bali_text'      => array(
			'ar' => 'مدرّجات أرز خضراء وهدوء استوائي',
			'en' => 'Green rice terraces and tropical calm',
		),
		'dest_bali_alt'       => array(
			'ar' => 'مدرّجات الأرز الخضراء بين أشجار النخيل في بالي',
			'en' => 'Green rice terraces among palm trees in Bali',
		),
		'dest_makkah'        => array(
			'ar' => 'مكة المكرمة والمدينة المنورة',
			'en' => 'Makkah & Madinah',
		),
		'dest_makkah_text'   => array(
			'ar' => 'عمرة وحج، وفريقنا بجانبك',
			'en' => 'Umrah and Hajj, with our team by your side',
		),
		'dest_makkah_alt'    => array(
			'ar' => 'مآذن المسجد النبوي وقبابه في المدينة المنورة',
			'en' => 'The minarets and domes of Al-Masjid an-Nabawi in Madinah',
		),
		'dest_makkah_wa_message' => array(
			'ar' => 'مرحبًا، أريد الاستفسار عن رحلات العمرة والحج إلى مكة المكرمة والمدينة المنورة.',
			'en' => "Hello, I'd like to ask about Umrah and Hajj trips to Makkah and Madinah.",
		),

		// Home: final call to action.
		'cta_title'           => array(
			'ar' => 'مستعد لرحلتك القادمة؟',
			'en' => 'Ready for your next trip?',
		),
		'cta_text'            => array(
			'ar' => 'أرسل لنا رسالة، ولنبدأ التخطيط معًا اليوم.',
			'en' => "Send us a message and let's start planning together today.",
		),

		// Inner page hero.
		'breadcrumb'                => array(
			'ar' => 'مسار التنقل',
			'en' => 'Breadcrumb',
		),

		// About: page hero.
		'about_title'               => array(
			'ar' => 'من نحن',
			'en' => 'About us',
		),
		'about_intro'               => array(
			'ar' => 'منذ عام 2016 ونحن نحوّل خطط السفر إلى رحلات سهلة ومليئة بالمتعة.',
			'en' => "Since 2016, we've been turning travel plans into easy, joyful journeys.",
		),

		// About: our story.
		'about_story_eyebrow'       => array(
			'ar' => 'من نحن',
			'en' => 'Who we are',
		),
		'about_story_title'         => array(
			'ar' => 'حكايتنا',
			'en' => 'Our story',
		),
		'about_story_p1'            => array(
			'ar' => 'بدأت «TA Tours» – المعروفة رسميًا باسم «طيور الجنة» – رحلتها عام 2016 بفكرة بسيطة: أن يكون السفر متعة تبدأ من أول رسالة، لا عبئًا يُثقل كاهلك. ومنذ ذلك الحين أصبحنا اسمًا موثوقًا في قطاع السفر في مصر، نرافق المسافرين في رحلاتهم داخل مصر وحول العالم بكل سهولة وثقة.',
			'en' => "TA Tours — officially known as Toyor Al-Jannah — began its journey in 2016 with a simple belief: travel should feel exciting from the very first message, not stressful. Since then, we have grown into a trusted name in Egypt's travel industry, helping travelers explore Egypt and the world with ease and confidence.",
		),
		'about_story_p2'            => array(
			'ar' => 'من برامج الرحلات المخططة بعناية وحجوزات الطيران السلسة، إلى حجز الفنادق والجولات السياحية المصحوبة بمرشدين واستشارات السفر الشخصية، نهتم بكل تفصيلة بدقة، حتى لا يتبقى لك سوى أن تحزم حقيبتك وتستمتع بالرحلة.',
			'en' => "From carefully planned itineraries and seamless flight bookings to hotel reservations, guided tours and personal travel advice, we take care of every detail with precision — so all that's left for you is to pack your bag and enjoy the journey.",
		),
		'about_story_img_alt'       => array(
			'ar' => 'كاميرا موضوعة على خريطة العالم',
			'en' => 'A camera resting on a world map',
		),

		// About: key facts.
		'about_facts_label'         => array(
			'ar' => 'حقائق سريعة',
			'en' => 'Key facts',
		),
		'about_fact_founded'        => array(
			'ar' => 'سنة التأسيس',
			'en' => 'Year founded',
		),
		'about_fact_branches'       => array(
			'ar' => 'فرعًا بنظام الفرنشايز في أنحاء مصر',
			'en' => 'Franchise branches across Egypt',
		),
		'about_fact_services'       => array(
			'ar' => 'خدمات سفر في مكان واحد',
			'en' => 'Travel services under one roof',
		),

		// About: our network.
		'about_network_eyebrow'     => array(
			'ar' => 'شبكتنا',
			'en' => 'Our network',
		),
		'about_network_title'       => array(
			'ar' => '21 فرعًا.. ووعد واحد',
			'en' => '21 branches. One promise.',
		),
		'about_network_text'        => array(
			'ar' => 'انطلاقًا من جذورنا في مصر، نمت «طيور الجنة» لتصبح شبكة تضم 21 فرعًا بنظام الفرنشايز في أنحاء الجمهورية، لنقرّب السفر السهل والموثوق من الجميع. ويعمل في كل فرع فريق شغوف بالسفر ومتمرّس في فنون الضيافة، لتحصل دائمًا على اهتمام شخصي وخطة مصممة خصيصًا لك.',
			'en' => 'Rooted in Egypt, Toyor Al-Jannah has grown into a network of 21 franchise branches across the country, bringing easy, reliable travel closer to everyone. Every branch is run by a dedicated team that loves travel and masters the art of hospitality, so you always get personal attention and a plan made just for you.',
		),
		'about_network_hajj'       => array(
			'ar' => 'وفي رحلات الحج والعمرة يمتد اهتمامنا أبعد من ذلك؛ إذ يرافق فريق تشغيل متكامل داخل المملكة ضيوف الرحمن من عملائنا طوال رحلتهم، حتى يعودوا إلى بيوتهم بالسلامة.',
			'en' => 'For Hajj and Umrah, our care goes even further: a full operations team inside Saudi Arabia accompanies our pilgrims throughout their journey, until they return home safely.',
		),
		'about_network_note'        => array(
			'ar' => 'هذا الموقع هو بيت فرعنا في المنصورة – قناة السويس، حيث ينتظرك فريقنا بكل ترحاب.',
			'en' => 'This website is home to our Mansoura – Suez Canal branch, where our team is ready to welcome you.',
		),

		// About: our values.
		'about_values_title'        => array(
			'ar' => 'ما نؤمن به',
			'en' => 'What we stand for',
		),
		'about_value_ease'          => array(
			'ar' => 'السهولة',
			'en' => 'Ease',
		),
		'about_value_ease_text'     => array(
			'ar' => 'التخطيط للسفر يجب أن يكون خفيفًا كالسحاب، لذلك نجعل كل خطوة واضحة وبسيطة.',
			'en' => 'Planning a trip should feel as light as a cloud. We keep every step clear and simple.',
		),
		'about_value_hassle'        => array(
			'ar' => 'سفر بلا متاعب',
			'en' => 'Hassle-free travel',
		),
		'about_value_hassle_text'   => array(
			'ar' => 'الطيران والفنادق وكل الحجوزات بينهما.. نتولاها عنك لتسافر وأنت مطمئن.',
			'en' => 'Flights, hotels and every booking in between: we handle it all, so you can travel with peace of mind.',
		),
		'about_value_detail'        => array(
			'ar' => 'الاهتمام بالتفاصيل',
			'en' => 'Detail-oriented',
		),
		'about_value_detail_text'   => array(
			'ar' => 'التفاصيل الصغيرة هي ما يصنع رحلة رائعة، لذلك نراجع كل تفصيلة قبل أن تقلع طائرتك.',
			'en' => 'The small things make a great trip. We check every detail before you take off.',
		),

		// About: why travelers trust us.
		'about_trust_title'         => array(
			'ar' => 'لماذا يثق بنا المسافرون؟',
			'en' => 'Why travelers trust us',
		),
		'about_trust_1'             => array(
			'ar' => 'رضاك أولًا',
			'en' => 'Your satisfaction comes first',
		),
		'about_trust_1_text'        => array(
			'ar' => 'راحتك وسعادتك هما البوصلة التي توجّه كل قرار نتخذه.',
			'en' => 'Your comfort and happiness guide every decision we make.',
		),
		'about_trust_2'             => array(
			'ar' => 'علاقات قوية',
			'en' => 'Strong relationships',
		),
		'about_trust_2_text'        => array(
			'ar' => 'علاقاتنا الوثيقة مع شركات الطيران والفنادق والمعالم السياحية تمنحك خيارات أفضل.',
			'en' => 'Close ties with airlines, hotels and attractions help us find you better options.',
		),
		'about_trust_3'             => array(
			'ar' => 'أسعار تنافسية وعروض حصرية',
			'en' => 'Competitive prices & exclusive deals',
		),
		'about_trust_3_text'        => array(
			'ar' => 'نسعى دائمًا لنمنحك قيمة حقيقية وعروضًا ستحبها.',
			'en' => "We work hard to give you real value and offers you'll love.",
		),
		'about_trust_4'             => array(
			'ar' => 'عملاء يعودون إلينا',
			'en' => 'Travelers who come back',
		),
		'about_trust_4_text'        => array(
			'ar' => 'كثير من عملائنا يعودون إلينا رحلة بعد رحلة، وهذا أجمل دليل على اهتمامنا.',
			'en' => 'Many of our clients return to us trip after trip, and that is the best proof of our care.',
		),

		// About: our vision.
		'about_vision_eyebrow'      => array(
			'ar' => 'نتطلع إلى المستقبل',
			'en' => 'Looking ahead',
		),
		'about_vision_title'        => array(
			'ar' => 'رؤيتنا',
			'en' => 'Our vision',
		),
		'about_vision_text'         => array(
			'ar' => 'نتطلع إلى المستقبل بنفس الشغف الذي بدأنا به: أن نواصل الابتكار، ونطوّر خدماتنا باستمرار، ونبقى في طليعة قطاع السفر في مصر وخارجها، لنحوّل أحلام الاستكشاف والمغامرة إلى رحلات حقيقية للمسافرين من كل الخلفيات.',
			'en' => 'We look to the future with the same passion we started with: to keep innovating, keep growing our services, and stay at the forefront of travel in Egypt and beyond, turning dreams of exploration and adventure into real journeys for travelers from all walks of life.',
		),
		'about_vision_quote'        => array(
			'ar' => 'السفر أصبح سهلًا.. اليوم وغدًا وفي كل رحلة.',
			'en' => 'Travel made easy — today, tomorrow, and on every trip.',
		),

		// About: Mansoura branch card.
		'about_branch_title'        => array(
			'ar' => 'زورونا في فرع المنصورة – قناة السويس',
			'en' => 'Visit our Mansoura – Suez Canal branch',
		),
		'about_branch_text'         => array(
			'ar' => 'تفضّل التخطيط وجهًا لوجه؟ يسعدنا استقبالك لنخطط معًا لرحلتك القادمة.',
			'en' => "Prefer to plan face to face? Drop by, and we'll be happy to plan your next trip with you.",
		),
		'get_directions'            => array(
			'ar' => 'احصل على الاتجاهات',
			'en' => 'Get directions',
		),

		// Contact page.
		'contact_page_title'        => array(
			'ar' => 'تواصل معنا',
			'en' => 'Contact us',
		),
		'contact_page_intro'        => array(
			'ar' => 'نحن هنا لنساعدك في التخطيط لرحلتك القادمة. تواصل معنا بالطريقة التي تناسبك.',
			'en' => "We're here to help you plan your next trip. Reach out the way that suits you best.",
		),
		'contact_cards_title'       => array(
			'ar' => 'طرق التواصل',
			'en' => 'Ways to reach us',
		),
		'contact_whatsapp_title'    => array(
			'ar' => 'واتساب',
			'en' => 'WhatsApp',
		),
		'contact_whatsapp_text'     => array(
			'ar' => 'أسرع طريقة للتواصل معنا. أرسل رسالتك وسنرد عليك.',
			'en' => "The fastest way to reach us. Send a message and we'll get back to you.",
		),
		'contact_whatsapp_btn'      => array(
			'ar' => 'تحدّث معنا عبر واتساب',
			'en' => 'Chat on WhatsApp',
		),
		'contact_call_title'        => array(
			'ar' => 'اتصل بنا',
			'en' => 'Call us',
		),
		'contact_call_text'         => array(
			'ar' => 'تفضّل الحديث مباشرة؟ اتصل بنا.',
			'en' => 'Prefer to talk? Call us directly.',
		),
		'contact_email_title'       => array(
			'ar' => 'البريد الإلكتروني',
			'en' => 'Email',
		),
		'contact_email_text'        => array(
			'ar' => 'لطلباتك التفصيلية، راسلنا في أي وقت.',
			'en' => 'For detailed requests, write to us anytime.',
		),
		'contact_visit_title'       => array(
			'ar' => 'زورونا',
			'en' => 'Visit us',
		),
		'contact_visit_text'        => array(
			'ar' => 'يسعد فرعنا في المنصورة – قناة السويس باستقبالك.',
			'en' => 'Our Mansoura – Suez Canal branch is happy to welcome you.',
		),
		'contact_directions_btn'    => array(
			'ar' => 'احصل على الاتجاهات',
			'en' => 'Get directions',
		),
		'contact_reply_title'       => array(
			'ar' => 'لرد أسرع',
			'en' => 'Get a faster reply',
		),
		'contact_reply_text'        => array(
			'ar' => 'لنساعدك في التخطيط لرحلتك بسرعة، أخبرنا في رسالتك بـ:',
			'en' => 'To help us plan your trip quickly, include in your message:',
		),
		'contact_reply_point_1'     => array(
			'ar' => 'وجهتك (أو بعض الأفكار)',
			'en' => 'Your destination (or a few ideas)',
		),
		'contact_reply_point_2'     => array(
			'ar' => 'مواعيد السفر',
			'en' => 'Your travel dates',
		),
		'contact_reply_point_3'     => array(
			'ar' => 'عدد المسافرين',
			'en' => 'Number of travelers',
		),
		'contact_reply_point_4'     => array(
			'ar' => 'ميزانيتك التقريبية',
			'en' => 'Your approximate budget',
		),
		'contact_reply_point_5'    => array(
			'ar' => 'للحج أو العمرة: الموسم المفضل وعدد الحجاج أو المعتمرين',
			'en' => 'For Hajj or Umrah: your preferred season and the number of pilgrims',
		),
		'contact_map_title'         => array(
			'ar' => 'موقعنا على الخريطة',
			'en' => 'Find us on the map',
		),

		// Offers page: hero, grid, pagination, empty state and CTA band.
		'offers_page_title'       => array(
			'ar' => 'العروض',
			'en' => 'Offers',
		),
		'offers_page_intro'       => array(
			'ar' => 'أحدث عروضنا، مختارة لتجعل رحلتك القادمة أسهل.',
			'en' => 'Our latest deals, chosen to make your next trip easier.',
		),
		'offers_grid_eyebrow'     => array(
			'ar' => 'أحدث العروض',
			'en' => 'Latest deals',
		),
		'offers_grid_title'       => array(
			'ar' => 'العروض الحالية',
			'en' => 'Current offers',
		),
		'offers_pagination_label' => array(
			'ar' => 'صفحات العروض',
			'en' => 'Offers pages',
		),
		'offers_prev'             => array(
			'ar' => 'السابق',
			'en' => 'Previous',
		),
		'offers_next'             => array(
			'ar' => 'التالي',
			'en' => 'Next',
		),
		'offers_page_number'      => array(
			'ar' => 'صفحة',
			'en' => 'Page',
		),
		'offers_empty_title'      => array(
			'ar' => 'عروض جديدة في الطريق!',
			'en' => 'New offers are on the way!',
		),
		'offers_empty_text'       => array(
			'ar' => 'راسلنا عبر واتساب وسنشاركك أحدث العروض.',
			'en' => "Message us on WhatsApp and we'll share the latest deals with you.",
		),
		'offers_empty_btn'        => array(
			'ar' => 'اسأل عن العروض الحالية',
			'en' => 'Ask about current offers',
		),
		'offers_empty_wa_message' => array(
			'ar' => 'مرحبًا، أريد الاستفسار عن العروض الحالية.',
			'en' => "Hello, I'd like to ask about your current offers.",
		),
		'offers_cta_title'        => array(
			'ar' => 'لم تجد ما تبحث عنه؟',
			'en' => "Didn't find what you're looking for?",
		),
		'offers_cta_text'         => array(
			'ar' => 'أخبرنا عن رحلة أحلامك وسنخطط لها من أجلك.',
			'en' => "Tell us about your dream trip and we'll plan it for you.",
		),

		// Offers page: Hajj & Umrah.
		'hajj_eyebrow'      => array(
			'ar' => 'السياحة الدينية',
			'en' => 'Religious tourism',
		),
		'hajj_title'        => array(
			'ar' => 'الحج والعمرة.. معك في كل خطوة',
			'en' => 'Hajj & Umrah — with you every step of the way',
		),
		'hajj_text'         => array(
			'ar' => 'رحلتك إلى الأراضي المقدسة تستحق راحة بال كاملة. فريق التشغيل الخاص بنا داخل المملكة العربية السعودية يرافقك من أول رسالة حتى تعود إلى بيتك بالسلامة، لتتفرغ لعبادتك ونهتم نحن بكل ما عدا ذلك.',
			'en' => 'Your journey to the Holy Lands deserves complete peace of mind. Our full operations team inside Saudi Arabia stays with you from your very first message until you return home safely, so you can focus on your worship while we take care of everything else.',
		),
		'hajj_badge'        => array(
			'ar' => 'فريق تشغيل متكامل داخل المملكة',
			'en' => 'Our full operations team inside the Kingdom',
		),
		'hajj_img_alt'      => array(
			'ar' => 'الكعبة المشرفة في المسجد الحرام بمكة المكرمة',
			'en' => 'The Kaaba in Masjid al-Haram, Makkah',
		),
		'hajj_steps_label'  => array(
			'ar' => 'كيف نرافقك في رحلتك',
			'en' => 'How we stay with you on your journey',
		),
		'hajj_step_1_title' => array(
			'ar' => 'أول رسالة',
			'en' => 'Your first message',
		),
		'hajj_step_1_text'  => array(
			'ar' => 'احجز بسهولة عبر رسالة واتساب.',
			'en' => 'Book easily with a WhatsApp message.',
		),
		'hajj_step_2_title' => array(
			'ar' => 'مكالمة التأكيد',
			'en' => 'Confirmation call',
		),
		'hajj_step_2_text'  => array(
			'ar' => 'نتصل بك لتأكيد حجزك والإجابة عن كل أسئلتك.',
			'en' => 'We call you to confirm your booking and answer all your questions.',
		),
		'hajj_step_3_title' => array(
			'ar' => 'فريقنا في المملكة',
			'en' => 'Our team in the Kingdom',
		),
		'hajj_step_3_text'  => array(
			'ar' => 'من لحظة وصولك، فريق التشغيل بجانبك في كل ما تحتاجه.',
			'en' => 'From the moment you arrive, our operations team is by your side for anything you need.',
		),
		'hajj_step_4_title' => array(
			'ar' => 'العودة بالسلامة',
			'en' => 'Home safely',
		),
		'hajj_step_4_text'  => array(
			'ar' => 'نبقى معك حتى تعود إلى بيتك سالمًا.',
			'en' => 'We stay with you until you are back home safe and sound.',
		),
		'hajj_season'       => array(
			'ar' => 'الموسم يقترب.. تواصل معنا مبكرًا لتخطط براحة.',
			'en' => 'The season is approaching. Reach out early to plan with ease.',
		),
		'hajj_btn'          => array(
			'ar' => 'استفسر عن الحج والعمرة',
			'en' => 'Ask about Hajj & Umrah',
		),
		'hajj_wa_message'   => array(
			'ar' => 'مرحبًا، أريد الاستفسار عن برامج الحج والعمرة.',
			'en' => "Hello, I'd like to ask about your Hajj and Umrah programs.",
		),

		// Footer.
		/* translators: 1: founding year, 2: number of branches. */
		'footer_about'        => array(
			'ar' => 'منذ %1$s نخطط لرحلات سهلة تهتم بأدق التفاصيل، من العطلات حول العالم إلى الحج والعمرة، عبر %2$s فرعًا في أنحاء مصر. هذا موقع فرع المنصورة – قناة السويس.',
			'en' => 'Since %1$s, we\'ve planned easy, detail-focused trips, from holidays around the world to Hajj and Umrah, through %2$s branches across Egypt. This is the Mansoura – Suez Canal branch.',
		),
		'footer_hajj_link'   => array(
			'ar' => 'الحج والعمرة',
			'en' => 'Hajj & Umrah',
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
		'landline'            => array(
			'ar' => 'الهاتف الأرضي',
			'en' => 'Landline',
		),
		'saudi_phone'         => array(
			'ar' => 'رقم السعودية',
			'en' => 'Saudi Arabia',
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

		// SEO: <title>, meta description, Open Graph (inc/seo.php).
		'seo_site_name'       => array(
			'ar' => 'طيور الجنة TA Tours',
			'en' => 'TA Tours',
		),
		'seo_og_image_alt'    => array(
			'ar' => 'شعار طيور الجنة TA Tours على خلفية زرقاء',
			'en' => 'TA Tours logo on a blue background',
		),
		'seo_home_title'      => array(
			'ar' => 'طيور الجنة TA Tours | السفر أصبح سهلًا: طيران وفنادق وحج وعمرة',
			'en' => 'TA Tours | Travel made easy: Flights, Hotels, Hajj & Umrah',
		),
		'seo_home_desc'       => array(
			'ar' => 'طيور الجنة TA Tours في المنصورة: حجز طيران وفنادق، برامج عطلات وشهر عسل، وحج وعمرة بفريق تشغيل داخل المملكة. منذ 2016.',
			'en' => 'TA Tours (Toyor Al-Jannah) in Mansoura plans flights, hotels, holidays, honeymoons, Hajj and Umrah with care, since 2016.',
		),
		'seo_about_title'     => array(
			'ar' => 'من نحن | طيور الجنة TA Tours',
			'en' => 'About us | TA Tours',
		),
		'seo_about_desc'      => array(
			'ar' => 'منذ 2016 نمت طيور الجنة لتضم 21 فرعًا في أنحاء مصر. تعرّف على حكايتنا وقيمنا ورؤيتنا.',
			'en' => 'Since 2016, TA Tours has grown into 21 franchise branches across Egypt. Discover our story, values and vision.',
		),
		'seo_services_title'  => array(
			'ar' => 'خدماتنا | طيور الجنة TA Tours',
			'en' => 'Our services | TA Tours',
		),
		'seo_services_desc'   => array(
			'ar' => 'الحج والعمرة، حجز الطيران والفنادق، برامج الرحلات، الجولات السياحية، استشارات السفر وباقات شهر العسل في مكان واحد.',
			'en' => 'Hajj and Umrah, flight booking, hotels, itineraries, guided tours, travel consultancy and honeymoon packages, all in one place.',
		),
		'seo_offers_title'    => array(
			'ar' => 'العروض والحج والعمرة | طيور الجنة TA Tours',
			'en' => 'Offers, Hajj & Umrah | TA Tours',
		),
		'seo_offers_desc'     => array(
			'ar' => 'أحدث عروض السفر، وبرامج الحج والعمرة مع فريق تشغيل متكامل داخل المملكة.',
			'en' => 'Our latest travel deals, plus Hajj and Umrah programs with a full operations team inside Saudi Arabia.',
		),
		'seo_contact_title'   => array(
			'ar' => 'تواصل معنا | طيور الجنة TA Tours المنصورة',
			'en' => 'Contact us | TA Tours Mansoura',
		),
		'seo_contact_desc'    => array(
			'ar' => 'تواصل مع طيور الجنة في المنصورة عبر واتساب أو الهاتف أو البريد الإلكتروني، أو زورنا في 125 شارع قناة السويس.',
			'en' => 'Reach TA Tours in Mansoura on WhatsApp, by phone or email, or visit us at 125 Suez Canal Street.',
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
		'not_found_hint'      => array(
			'ar' => 'ربما تغيّر الرابط أو انتهى العرض. يمكنك البدء من هنا:',
			'en' => 'The link may have changed or the offer may have ended. You can start from here:',
		),
		'not_found_links'     => array(
			'ar' => 'روابط مفيدة',
			'en' => 'Helpful links',
		),
		'back_home'           => array(
			'ar' => 'العودة إلى الرئيسية',
			'en' => 'Back to home',
		),
		'no_content'          => array(
			'ar' => 'لا يوجد محتوى بعد.',
			'en' => 'Nothing here yet.',
		),

		// Admin (offer editor). Read with ta_t( $key, ta_admin_lang() ).
		'admin_title_ph'        => array(
			'ar' => 'اكتب عنوان العرض هنا',
			'en' => 'Offer title',
		),
		'admin_image_hint'      => array(
			'ar' => 'يفضّل صورة عرضية بمقاس 1200×900 أو أكبر',
			'en' => 'A landscape image of 1200×900 or larger works best',
		),
		'admin_tips_title'      => array(
			'ar' => 'نصائح سريعة',
			'en' => 'Quick tips',
		),
		'admin_tips_fill'       => array(
			'ar' => 'اكتب عنوانًا واضحًا ووصفًا قصيرًا (سطران أو ثلاثة)، واختر «صورة العرض» من الصندوق الجانبي، ثم اضغط «نشر».',
			'en' => 'Write a clear title and a short description (two or three lines), choose the "Offer image" in the side box, then click "Publish".',
		),
		'admin_tips_translate'  => array(
			'ar' => 'بعد النشر، اضغط علامة + بجوار اللغة الأخرى في صندوق «اللغات» لإضافة الترجمة، ثم انشرها بنفس الطريقة.',
			'en' => 'After publishing, click the + next to the other language in the "Languages" box to add the translation, then publish it the same way.',
		),
		'admin_no_image'        => array(
			'ar' => 'تم حفظ العرض بدون صورة. سيظهر بصورة افتراضية حتى تختار «صورة العرض» من الصندوق الجانبي.',
			'en' => 'The offer was saved without an image. It will show a default picture until you choose an "Offer image" in the side box.',
		),
	);
}
