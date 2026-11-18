# Beyond Expectations
Beyond Expectations is a responsive theme for ClassicPress with a custom header image, primary and social menus, a custom sidebar template and a full width template. It is built on the [Backdrop framework](https://github.com/backdrop-dev/framework) 2.0.

## Requirements
- [ClassicPress](https://www.classicpress.net/)
- [PHP 7.4](https://www.php.net/releases/7_4_0.php)
- [Composer](https://getcomposer.org)
- [Node.js](https://nodejs.org) 20.19 or later, to build the styles and scripts (not needed for a release zip)

## Installation
Install the theme's dependencies from the theme folder before activating it.

<pre>
composer install --no-dev
npm install
npm run prod
</pre>

The release zip already includes the built styles and scripts. From the repository they are built by [Vite](https://vite.dev) into `public/assets`; without them the dashboard shows a notice and the theme has no styles. `npm run watch` rebuilds on every change and `npm run build` also exports the finished theme into a `beyond-expectations` folder, which the release workflow zips.

If the Backdrop framework can't be found, administrators see a notice in the dashboard instead of a fatal error.

## Structure
The `app/` and `config/` folders follow the same layout as [Amicable](https://github.com/luthemes/amicable).

- `functions.php` loads Composer's autoloader, `app/bootstrap-autoload.php` and `app/framework.php`, which registers the service providers and boots the Backdrop application.
- `app/Provider.php` binds the theme settings and the theme mod defaults (`config/_settings-mods.php`).
- `app/CleanCP/` removes the emoji scripts, toolbar and embed script when those options are on.
- `app/Customize/` uses the [Backdrop customize](https://github.com/backdrop-dev/customize) package: the panels Theme: Global, Header, Content and Footer, with Layout (radio image), Feature Image and Credit sections.
- `app/Settings/` is the Appearance > Beyond Expectations Settings page, with General (404 page, clean up options), Themes and Plugins tabs. `app/PluginManager/` and `app/ThemeManager/` build the Plugins and Themes tabs from `config/plugins.json` and `config/themes.json`.
- `app/Template/` holds the 404 page (`ErrorPage`) and the footer credit (`Footer`). `app/Tools/` holds `Config`, `Mod`, `PoweredBy`, `Svg` and `Collection`.
- The [Backdrop resources](https://github.com/backdrop-dev/resources) package loads the styles and scripts Vite builds into `public/assets`, using its manifest (`app/functions-assets.php`).
- `app/functions-*.php`: assets, extras (views folder, fonts), filters, setup and template tags.
- `config/` holds the theme mod defaults, image sizes, layouts, social icons and the recommended plugins and themes.
- `resources/` holds the source styles and scripts; Vite builds them into `public/assets`.
- `public/views/comments/default.php` is the comments area and `public/views/comment/` holds a single comment (`default.php`, and `ping.php` for pingbacks and trackbacks), like Amicable.
- `public/views/` holds the views loaded by the [view](https://github.com/backdrop-dev/view) and [template hierarchy](https://github.com/backdrop-dev/template-hierarchy) packages. `public/svg/social-icons` holds the brand icons that the [icons](https://github.com/backdrop-dev/icons) package (Iconoir) doesn't have, and `public/images` the layout previews.

## Copyright and License
This project is licensed under the GNU General Public License, version 2 or later.

The header image (`resources/images/header-image.jpg`, a cropped and darkened copy) and the screenshot use the photo by Greg Rakozy (https://unsplash.com/photos/oMpAz-DN-9I), licensed CC0 as published on Unsplash in 2015. Merriweather (Sorkin Type) and Fira Sans (Carrois Apostrophe, Mozilla) are licensed under SIL OFL 1.1 and load from the [Backdrop fonts](https://github.com/backdrop-dev/fonts) package. Icons are [Iconoir](https://iconoir.com) (MIT) through the Backdrop icons package, and the brand icons in `public/svg/social-icons` are [Font Awesome Free](https://fontawesome.com) 5 brand icons, licensed CC BY 4.0, used as inline SVG.

Copyright © 2016–2026 Benjamin Lu
