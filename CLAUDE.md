# TA Tours — Custom WordPress Theme

## Project Overview

Bilingual (Arabic + English) company website for **TA Tours (Toyor Al-Jannah Tours / طيور الجنة)**, a travel agency in Mansoura, Egypt.

The site is mostly static marketing pages. The **only content the client edits** is **Offers**: cards with an image, a title, and a short description, managed from wp-admin.

This repository is a **custom WordPress theme** named `ta-tours`, developed locally and deployed by uploading the theme folder as a zip.

## Environments

|            | Local (development)     | Production                         |
| ---------- | ----------------------- | ---------------------------------- |
| URL        | `http://ta-tours.local` | `https://ta-tours.com`             |
| Tool       | LocalWP                 | cPanel shared hosting + WP Toolkit |
| Web server | Apache 2.4              | Apache / LiteSpeed                 |
| PHP        | 8.2.30                  | 8.2.34                             |
| WordPress  | 7.1.3                   | 7.1.3                              |

## Golden Rules (must follow)

1. **Work only inside `wp-content/themes/ta-tours/`.** Never modify WordPress core (`wp-admin/`, `wp-includes/`), `wp-config.php`, or other themes and plugins.
2. **The theme must be fully self-contained.** Deployment = zip this folder, upload, activate. All assets (CSS, JS, images, logos, fonts config) live inside the theme.
3. **Never hard-code URLs or domains.** Use `home_url()`, `get_theme_file_uri()`, `get_permalink()`, and Polylang helpers (`pll_home_url()`).
4. **PHP 8.2 compatible only.** Do not use any PHP 8.3+ features.
5. **No build step.** Plain CSS (custom properties) + vanilla JavaScript. No npm, no Tailwind, no Sass, no jQuery dependency.
6. **Plugins:** the only allowed plugin is **Polylang (free)**. Ask before adding any other plugin.
7. **Security:** escape all output (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`), sanitize all input, and protect admin actions with nonces and capability checks (`manage_options`).
8. **Prefixes:** prefix all PHP functions, hooks, options, and handles with `ta_`. Text domain: `ta-tours`.
9. **Never invent business facts.** Use only the facts in this file. If something is missing (social links, opening hours, prices), leave it out or add `<!-- TODO: ... -->`. Never use fake testimonials, fake numbers, or fake reviews.
10. **Ask before destructive actions** (deleting posts or pages, resetting the database, removing files outside the theme).
11. Use **WP-CLI** (`wp ...`) for WordPress operations when available.
12. Work **one phase at a time**. At the end of each phase, stop and report: files created or changed, what to test at `http://ta-tours.local`, and any open questions.

## Business Facts

- **Brand:** TA Tours — official name **Toyor Al-Jannah Tours** (Arabic: طيور الجنة).
- **Founded:** 2016.
- **Network:** 21 franchise branches across Egypt. **The website shows the Mansoura branch only.**
- **Services:** flight booking, travel itineraries and vacation planning, guided tours, hotel booking, personalized travel consultancy, honeymoon packages.
- **Example destinations:** Maldives, Turkey, Bali.
- **Tagline:** "Travel made easy" — Arabic: «السفر أصبح سهلًا».
- **Brand values:** ease, hassle-free travel, detail-oriented.
- **Tone of voice:** welcoming, reassuring, simple.

### Contact (Mansoura branch)

- **Phones:** `+201038736666`, `+201035428936`
- **WhatsApp:** `+201038736666` → link format `https://wa.me/201038736666?text=...` (URL-encode the text)
- **Email:** `info@ta-tours.com`
- **Address (AR):** المنصورة، 125 شارع قناة السويس، بجوار خير زمان، أعلى الصفوة للدواجن، الدور الثاني
- **Address (EN):** 125 Suez Canal Street, next to Kheir Zaman, above Al-Safwa Poultry, 2nd floor, Mansoura, Egypt
- **Map:** Google Maps embed using an `iframe` with a search query of the address (no API key needed).

All contact data must live in **one place** (`inc/config.php`) and be reused everywhere.

## Brand Identity

### Colors (CSS custom properties)

```css
--ta-primary: #096c8d; /* main brand blue */
--ta-secondary: #0a769f; /* buttons, links, hover states */
--ta-muted: #538da1; /* secondary text and borders on light backgrounds */
--ta-sky: #7caad5; /* light accent: badges, soft backgrounds */
--ta-bg: #fafafa; /* page background */
--ta-white: #ffffff;
--ta-text: #1f2a33; /* body text */
```

Ensure WCAG AA contrast for text.

### Typography (Google Fonts, `display=swap`, load only the weights used)

- **English headings:** Gabriela
- **English body:** Open Sans
- **Arabic (headings and body):** Cairo

Switch font families by language/direction (for example `:root:lang(ar)` or `[dir="rtl"]`).

### Visual Direction

Sky, clouds, and air travel — "Stratospheric expanse / cloudscape horizon". Airy and light: generous whitespace, rounded corners, soft shadows, clean cards.

Reference design: a large friendly headline over a sky-and-clouds photo, followed by a solid brand-blue band with supporting text and a clear CTA.

### Logo Files (in `assets/images/`)

- `logo-blue.png` — transparent, for light backgrounds (header)
- `logo-white.png` — transparent, for blue or dark backgrounds (footer, hero)
- `logo-badge.png` — circular brand-blue badge
- `favicon.png` — 512×512, output it from the theme with `<link rel="icon">` (do not rely on the WordPress Site Icon setting)

Keep clear space around the logo. Do not stretch, recolor, or add effects.

## Languages (Polylang)

- **Arabic** is the default language (`ar`, RTL) and uses root URLs. **English** (`en`, LTR) uses the `/en/` directory.
- WordPress sets the `dir` attribute automatically through `language_attributes()` when the locale is RTL. Use `is_rtl()` in PHP when needed.
- Use **CSS logical properties** (`margin-inline-start`, `padding-inline`, `inset-inline-end`, `text-align: start`) so **one stylesheet** works in both directions. Mirror directional icons (arrows) in RTL.
- **Theme UI strings:** keep all strings in `inc/strings.php` as `[ 'key' => [ 'ar' => '...', 'en' => '...' ] ]` and read them through a single helper `ta_t( $key )` that uses `pll_current_language()`, with a fallback to `ar` if Polylang is inactive. Never hard-code visible text in templates.
- **Language switcher** in the header, built with `pll_the_languages( [ 'raw' => 1 ] )`. Show "English" on Arabic pages and "العربية" on English pages.
- **Navigation is generated in PHP** (not WordPress menus): for each site page, find the page that uses the matching template in the current language and link to it.
- The theme must **not fatal-error** if Polylang is inactive: guard every Polylang function with `function_exists()`.

## Site Map

Each page exists in both languages and the translations are linked in Polylang.

| Page     | Template                      | AR slug    | EN slug        |
| -------- | ----------------------------- | ---------- | -------------- |
| Home     | `front-page.php`              | `home`     | `home-en`      |
| About    | `templates/page-about.php`    | `about`    | `about-us`     |
| Services | `templates/page-services.php` | `services` | `our-services` |
| Offers   | `templates/page-offers.php`   | `offers`   | `all-offers`   |
| Contact  | `templates/page-contact.php`  | `contact`  | `contact-us`   |

### Home Sections

1. **Hero:** cloud photo background, the tagline, a short subline, two CTAs: "Book on WhatsApp" and "View offers".
2. **Latest offers:** the 6 newest offers in the current language + a "View all offers" link (hide the section if there are no offers).
3. **Services:** a grid of the 6 services with inline SVG icons.
4. **Why TA Tours:** since 2016, 21 branches across Egypt, personalized planning, competitive prices and exclusive deals.
5. **Popular destinations:** Maldives, Turkey, Bali as image cards (each links to WhatsApp with a prefilled message).
6. **CTA band:** brand-blue band with a WhatsApp CTA.

### Other Pages

- **About:** the company story based on the brief (founded 2016, 21 franchise branches, services, customer focus, vision). Keep it concise and in the brand tone.
- **Services:** each service with an icon and a short description.
- **Offers:** all offers in the current language, newest first, in a responsive grid with pagination (12 per page).
- **Contact:** phones (`tel:` links), WhatsApp button, email (`mailto:`), address, and the map embed. **No contact form.**

### Global Elements

- **Header:** logo, navigation, language switcher, WhatsApp button; sticky; accessible mobile menu (vanilla JS, `aria-expanded`, Escape to close, focus handling).
- **Footer:** white logo, short description, quick links, contact info, copyright with the current year.
- **Floating WhatsApp button** on every page (bottom inline-end corner, respects RTL).

## Offers (Custom Post Type)

- Post type key: `offer`. Admin labels bilingual: «العروض / Offers».
- Supports: `title`, `editor`, `thumbnail`. `show_in_rest` = true (block editor).
- Offers do **not** need single pages. Make sure the post type is still **translatable in Polylang** (verify it appears in _Languages → Settings → Custom post types and Taxonomies_; adjust the registration arguments if it does not).
- Image size: `add_image_size( 'ta-offer-card', 800, 600, true )`.
- **Offer card** (`template-parts/offer-card.php`): featured image (fallback `assets/images/offer-placeholder.jpg`), title, description trimmed to about 25 words, and a WhatsApp button with a prefilled message:
  - AR: «مرحبًا، أريد الاستفسار عن عرض: {title}»
  - EN: "Hello, I'd like to ask about the offer: {title}"
- Admin list columns: thumbnail, title, language, date.
- Ordering: newest first.

## Setup Tool (for deployment)

Admin page **Tools → TA Tours Setup** (`manage_options` + nonce) with one button that runs an **idempotent** setup (safe to run many times; never duplicates content):

1. Checks that Polylang is active and that the `ar` and `en` languages exist. If not, show clear instructions and stop.
2. Creates any missing pages from the site map in both languages, assigns their templates, sets their language (`pll_set_post_language`), and links the translations (`pll_save_post_translations`).
3. Sets the Arabic Home page as the static front page.
4. Sets permalinks to `/%postname%/` and flushes the rewrite rules.
5. Shows a report of what was created and what already existed.

## Images

Photos are downloaded manually from Unsplash (free license) into `assets/images/`:

- `hero-clouds.jpg` — view above the clouds
- `cta-wing.jpg` — airplane wing over clouds
- `dest-maldives.jpg`, `dest-turkey.jpg`, `dest-bali.jpg`
- `about-travel.jpg` — travel planning (map, passport)
- `offer-placeholder.jpg` — generic travel image

Use `loading="lazy"` and explicit `width`/`height` for images below the fold. If a file is missing, fail gracefully (no broken layout).

## File Structure

```text
ta-tours/
├── CLAUDE.md
├── style.css                  # theme header + minimal base
├── functions.php              # only requires files from inc/
├── screenshot.png             # 1200×900 theme preview
├── inc/
│   ├── config.php             # contact data and constants
│   ├── setup.php              # theme supports, image sizes
│   ├── enqueue.php            # styles, scripts, fonts
│   ├── i18n.php               # ta_t() and Polylang helpers
│   ├── strings.php            # all UI strings (ar/en)
│   ├── cpt-offers.php         # Offers post type + admin columns
│   ├── template-tags.php      # helpers: WhatsApp links, nav, page lookup
│   └── admin-setup-tool.php   # Tools → TA Tours Setup
├── assets/
│   ├── css/main.css
│   ├── js/main.js
│   └── images/
├── template-parts/
│   ├── offer-card.php
│   └── sections/              # home sections
├── templates/                 # page templates
├── header.php
├── footer.php
├── front-page.php
├── page.php
├── index.php
└── 404.php
```

## Code Conventions

- WordPress Coding Standards for PHP; small, focused functions with short doc comments.
- Mobile-first, responsive CSS. Breakpoints: 640px, 960px, 1200px.
- Semantic HTML5, accessible labels, visible focus states, `alt` text on all images.
- Performance: enqueue only what is needed, defer non-critical JS, no heavy libraries.

## Git

- The repository root is the theme folder.
- Commit after each completed phase with a clear message (for example `feat: offers CPT and card component`).
- Never commit secrets or files outside the theme.

## Deployment Checklist (reference)

1. **Production:** install and activate **Polylang** → add **Arabic (default)** and **English** → URL modifications: language from the directory name, hide the default language in the URL → enable translation for the `offer` post type.
2. Zip the `ta-tours` folder (without `.git`) → **Appearance → Themes → Add New → Upload** → Activate.
3. **Tools → TA Tours Setup** → Run setup.
4. **Settings → Permalinks** → Save once.
5. Add a test offer in Arabic and its English translation, then check both languages.
6. **Launch:** change the admin email to a real inbox, disable maintenance mode, enable search engine indexing.
