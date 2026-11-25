=== Beyond Expectations ===
Contributors: luthemes
Tags: custom-background, custom-header, right-sidebar
Requires at least: 6.2
Tested up to: 6.2
Stable tag: 0.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html




== Installation ==
0. When installing from the repository instead of a release zip, run `composer install --no-dev`, `npm install` and `npm run prod` in the theme folder first.
1. In your admin panel, go to Appearance -> Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's ZIP file. Click Install Now.
3. Click Activate to use your new theme right away.

== Customizer ==
1. In your admin panel, go to Appearance -> Customize
2. List of different types that you can modify such as
   - Site Title Tagline
      - Hide Display Header Text (this will hide the entire header with header text)
   - Theme: Global > Layout: content with a sidebar (default) or full width with no sidebar
   - Theme: Header > Branding and Header Image
   - Theme: Content > Feature Image: the size of the featured image at the top of a page (banner, large or full size)
   - Theme: Footer > Credit: a random "powered by" line, or your own footer text (by default a copyright line with links to ClassicPress and the theme)
   - Appearance -> Beyond Expectations Settings: General (a private page to show on a 404 error; turn off emoji scripts, the toolbar and embeds), Themes and Plugins (recommended plugins)
3. Mobile Menu
   - The Mobile Menu is slightly different from other themes. I have created a mobile menu that is
     at the bottom left corner that helps users to navigation easier. The reason why is that 90% of
     users when using their device, their hands are always at the bottom of the screen which kind of
     makes the mobile menu more sense to have it at the bottom left corner. The Menu itself when is not
     set, the Site Title and Tagline will move to the center, if set, the Site Title and Tagline will move
     to the left while the menu is at the right side.
4. Header Image
   - Add Header Image
   - Remove Header Image (When removing a header image, the default image will display).
5. Static Front Page
   - Front Page
   - Blog


== Description ==
Beyond Expectations is a responsive theme for ClassicPress, built on the Backdrop framework 2.0.

Beyond Expectations is a standard design with responsive capability.


== Frequently Asked Questions ==
Not Available At the Moment


== Changelog ==
Version: 0.0.2 - November 24, 2026
- Rebuilt on Chassis: design tokens, layout, navigation, search panel, pagination, widgets and comments now come from techkodeninja/chassis; the theme keeps only its own look
- Customizer: Theme Colors and Typography (13 color settings, 4 typography settings) with live preview, plus Layout, Feature Image and footer Credit from backdrop-dev/customize
- Drop-down menus stack vertically, sit under their parent item and size to the longest label; no gray on hover
- Search panel opens on first click and drops below the top bar; the search toggle lines up with the social icons
- Entries spaced 3rem apart; post bodies stay inside their column and wide images scale down
- LinkedIn and Instagram render as outline icons (Chassis 0.2.4); menu hover is underline only, no outline box
- Requires backdrop-dev/customize ^1.0.6 and techkodeninja/chassis ^0.2.3
- See changelog.md for the full list

Version: 0.0.1 - November 17, 2026
- Rebuilt for ClassicPress on the Backdrop framework 2.0 and its Composer packages; app/ and config/ follow Amicable's layout
- Customizer panels (Theme: Global, Header, Content, Footer) with Layout (radio image), Feature Image and footer Credit sections
- Appearance > Beyond Expectations Settings with General (404 page, turn off emoji, toolbar and embeds), Themes and Plugins tabs
- Comment views like Amicable (comments/default.php, comment/default.php, comment/ping.php)
- Templates are views in public/views; markup uses BEM class names and the Backdrop attr package
- Styles and scripts are built with Vite (Sass); Font Awesome is replaced by inline SVG icons (Iconoir)
- Fonts: Fira Sans for headings and Merriweather for body text, loaded locally
- Full Width and Custom Sidebar page templates keep their saved names
- Skip link, keyboard access to the search toggle, and fixes from the Theme Unit Test data
- Requires PHP 7.4 or later
- See changelog.md for the full list

== Upgrade Notice ==
== Resources ==
Header image (resources/images/header-image.jpg) and screenshot
"Silhouette photography of person" by Greg Rakozy (https://unsplash.com/@grakozy)
https://unsplash.com/photos/oMpAz-DN-9I
Licensed CC0 1.0 (https://creativecommons.org/publicdomain/zero/1.0/), as published on Unsplash in 2015
The header image is a cropped and darkened copy of the photo

Merriweather by Sorkin Type - https://github.com/SorkinType/Merriweather
Fira Sans by Carrois Apostrophe and Mozilla - https://github.com/mozilla/Fira
Both licensed under SIL OFL 1.1 and loaded from the Backdrop fonts package (https://github.com/backdrop-dev/fonts)

Icons: Iconoir, https://iconoir.com
(C) 2021 Luca Burgio, MIT License, https://opensource.org/licenses/MIT
Bundled in vendor/backdrop-dev/icons/assets (Backdrop Icons, https://github.com/backdrop-dev/icons, GPLv2 or later)

Brand icons without an Iconoir version (public/svg/social-icons): Font Awesome Free 5 brand icons by Fonticons, Inc. - https://fontawesome.com
Licensed under CC BY 4.0 - https://creativecommons.org/licenses/by/4.0/ (used as inline SVG, no icon font is loaded)

== Copyright ==
Beyond Expectations WordPress Theme, Copyright (C) 2016-2026, Benjamin Lu
Beyond Expectations is distributed under the terms of the GNU GPL
