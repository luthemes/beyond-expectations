# Beyond Expectations
Beyond Expectations is a responsive theme for ClassicPress with a custom header image, primary and social menus, a custom sidebar template and a full width template. It is built on the [Backdrop framework](https://github.com/backdrop-dev/framework) 2.0.

## Requirements
- [ClassicPress](https://www.classicpress.net/)
- [PHP 7.4](https://www.php.net/releases/7_4_0.php)
- [Composer](https://getcomposer.org)

## Installation
Install the theme's dependencies from the theme folder before activating it.

<pre>
composer install --no-dev
</pre>

If the Backdrop framework can't be found, administrators see a notice in the dashboard instead of a fatal error.

## Structure
- `functions.php` loads Composer's autoloader and boots the Backdrop application.
- `app/` holds the service provider (`Provider.php`) and the functions files for setup, assets, the custom header, the customizer and template tags (in the `BeyondExpectations` namespace).
- `index.php` is the only template ClassicPress loads. The [template hierarchy](https://github.com/backdrop-dev/template-hierarchy) package picks the header, content and footer views, which `Backdrop\View\display()` from the [view](https://github.com/backdrop-dev/view) package loads from `public/views`.
- `public/views/header`, `content` and `footer` hold the page views (`content/single.php`, `content/page.php`, `content/archive.php`, ...). `content/default.php` is the blog index and the fallback. The page templates are in `content/custom-templates` and are registered in `app/functions-setup.php`.
- `public/views/comments/default.php` is the comments template, found by the [theme](https://github.com/backdrop-dev/theme) package's comments filter.
- `public/views/entry/` and `public/views/sidebar/` hold the entry and sidebar views. A post format falls back to `entry/default.php`.

## Copyright and License
This project is licensed under the GNU General Public License, version 2 or later.

The screenshot is licensed CC0, by Greg Rakozy (https://unsplash.com/photos/oMpAz-DN-9I). Font Awesome by Dave Gandy is licensed under SIL OFL 1.1 and MIT.

Copyright © 2016–2026 Benjamin Lu
