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
			'ar' => 'طيور الجنة · فرع المنصورة',
			'en' => 'TA Tours · Mansoura branch',
		),
		'tagline'             => array(
			'ar' => 'السفر أصبح سهلًا',
			'en' => 'Travel made easy',
		),
		'hero_subline'        => array(
			'ar' => 'طيران وفنادق وعطلات متكاملة، نصمّمها لتناسبك ونتولّى عنك كل التفاصيل.',
			'en' => 'Flights, hotels and complete holidays, planned around you, with every detail taken care of.',
		),
		'hero_band_text'      => array(
			'ar' => 'أخبرنا بوجهة أحلامك، ونحن نرتّب لك رحلة مريحة من البداية إلى النهاية.',
			'en' => "Tell us where you dream of going, and we'll arrange a relaxed trip from start to finish.",
		),
		'hero_image_alt'      => array(
			'ar' => 'منظر فوق بحر من السحب البيضاء تحت سماء زرقاء صافية',
			'en' => 'View above a sea of white clouds under a clear blue sky',
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
		'service_flights'     => array(
			'ar' => 'حجز الطيران',
			'en' => 'Flight booking',
		),
		'service_flights_text' => array(
			'ar' => 'نختار لك أنسب رحلة طيران في الموعد الذي يناسبك، ونحجزها دون عناء.',
			'en' => 'The right flight at the right time, booked for you without the hassle.',
		),
		'service_planning'    => array(
			'ar' => 'تخطيط الرحلات والعطلات',
			'en' => 'Trip & holiday planning',
		),
		'service_planning_text' => array(
			'ar' => 'برنامج واضح لعطلتك يومًا بيوم، مبنيّ على ما تحبه.',
			'en' => 'A clear day-by-day plan for your holiday, built around what you love.',
		),
		'service_tours'       => array(
			'ar' => 'جولات سياحية بصحبة مرشد',
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
		'service_consulting'  => array(
			'ar' => 'استشارات سفر شخصية',
			'en' => 'Personal travel advice',
		),
		'service_consulting_text' => array(
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
			'ar' => 'شبكة واسعة من الفروع، وفرعنا في المنصورة في خدمتك.',
			'en' => 'A wide franchise network, with our Mansoura branch here to help you.',
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
		'about_network_note'        => array(
			'ar' => 'هذا الموقع هو بيت فرعنا في المنصورة، حيث ينتظرك فريقنا بكل ترحاب.',
			'en' => 'This website is home to our Mansoura branch, where our team is ready to welcome you.',
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
			'ar' => 'زورونا في فرع المنصورة',
			'en' => 'Visit our Mansoura branch',
		),
		'about_branch_text'         => array(
			'ar' => 'تفضّل التخطيط وجهًا لوجه؟ يسعدنا استقبالك لنخطط معًا لرحلتك القادمة.',
			'en' => "Prefer to plan face to face? Drop by, and we'll be happy to plan your next trip with you.",
		),
		'get_directions'            => array(
			'ar' => 'احصل على الاتجاهات',
			'en' => 'Get directions',
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
