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
- `functions.php` loads Composer's autoloader and boots the Backdrop application.
- `app/` holds the service provider (`Provider.php`) and the functions files for setup, assets, the Vite manifest, icons, the custom header, the customizer and template tags (in the `BeyondExpectations` namespace).
- `resources/` holds the source styles (`scss/screen.scss` loads one partial per section), scripts and the header image. `style.css` only holds the theme header.
- Icons are inline SVG from the [Backdrop icons](https://github.com/backdrop-dev/icons) package (Iconoir), and the social icons are added to the social menu by link. `public/icons/` holds the brand icons that Iconoir doesn't have (Amazon, Reddit, Tumblr, Vimeo and others). No icon font is loaded.
- `index.php` is the only template ClassicPress loads. The [template hierarchy](https://github.com/backdrop-dev/template-hierarchy) package picks the header, content and footer views, which `Backdrop\View\display()` from the [view](https://github.com/backdrop-dev/view) package loads from `public/views`.
- The [template manager](https://github.com/backdrop-dev/template-manager) package registers the Full Width and Custom Sidebar page templates (`app/functions-setup.php`).
- `public/views/header`, `content` and `footer` hold the page views (`content/single.php`, `content/page.php`, `content/archive.php`, ...). `content/default.php` is the blog index and the fallback. The page templates are in `content/custom-templates` and are registered in `app/functions-setup.php`.
- `public/views/comments/default.php` is the comments template, found by the [theme](https://github.com/backdrop-dev/theme) package's comments filter.
- `public/views/entry/` and `public/views/sidebar/` hold the entry and sidebar views. A post format falls back to `entry/default.php`.

## Copyright and License
This project is licensed under the GNU General Public License, version 2 or later.

The screenshot is licensed CC0, by Greg Rakozy (https://unsplash.com/photos/oMpAz-DN-9I). Merriweather Sans (Sorkin Type) and Sanchez (Latinotype) are licensed under SIL OFL 1.1 and load from the [Backdrop fonts](https://github.com/backdrop-dev/fonts) package. Icons are [Iconoir](https://iconoir.com) (MIT) through the Backdrop icons package, and the brand icons in `public/icons` are [Font Awesome Free](https://fontawesome.com) 5 brand icons, licensed CC BY 4.0, used as inline SVG.

Copyright © 2016–2026 Benjamin Lu
