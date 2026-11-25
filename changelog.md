# Change Log

## Unreleased

## 0.0.3 - 11.24.2026

### Changed
- `readme.txt` is rewritten in Amicable's format: a `=== Beyond Expectations ===` title and `== ==` headings throughout, with a `== Copyright ==` section at the end. The ClassicPress Directory update check finds the theme description now, so the directory picks up new versions.
- The legacy 0.0.1-0.2.2 changelog entries are removed from `readme.txt`; the Changelog lists only the current versions.

## 0.0.2 - 11.24.2026

### Added
- Customize → Theme: Global → Theme Colors and Typography, from `backdrop-dev/customize`. Both write to Chassis, so the controls start at the design's current values and a change overrides `chassis.json` without editing it; a control left alone changes nothing. Theme Colors covers text, muted text, dividers, alternate background, accent, text on accent, links, links on hover, headings, and header background and footer colors; the header text color stays in core's Colors section, which the theme keeps. Typography has the body font, heading font, base font size and line height, with Fira Sans, Lato, Open Sans, Merriweather Sans, Merriweather and Alegreya to choose from. Both preview live.

### Changed
- Requires `backdrop-dev/customize` `^1.0.6`, the release that loads the fonts Typography offers, and `techkodeninja/chassis` `^0.2.3`, which has the overrides the controls use.
- The Layout, Feature Image size and Credit controls in the customizer come from `backdrop-dev/customize` `^1.0.4` instead of the theme's own `Layout`, `FeatureImage` and `Footer` customizable classes, which are removed along with `Customize\Customizable`. `BeyondExpectations\Customize\Defaults` turns the built-in components on and gives them the theme's layouts, image sizes, defaults and labels. The setting IDs (`theme_global_layout`, `theme_content_feature_image`, `theme_footer_powered_by`, `theme_footer_custom_credit`), the panels and the stored theme mods are unchanged, so nothing saved needs migrating. The Colors section still moves into Theme: Global, the custom footer text is still hidden while the random credit is on, and all three controls still refresh the preview. The Layout control is labelled "Layout" instead of "Global Layout" and no longer has a description line.
- The theme is built on Chassis (`techkodeninja/chassis`): the design tokens, layout grid, navigation, search panel, pagination, widgets and comments come from Chassis, and the theme keeps only the styles that make Beyond Expectations itself. The 36 generic patterns Chassis already provides are deleted from the theme, along with empty partials and dead rules.
- `Backdrop\Tools\Collection` now comes from `backdrop-dev/tools` instead of the theme's own copy.
- The theme's own search toggle script is gone; Chassis owns the search panel now.
- Archive and blog listings use excerpts, and sticky posts are marked unmistakable.
- Drop-down menus: items stack vertically, the panel sits under its parent item and sizes to its longest label so text never wraps, and there is no gray background on hover.
- The search toggle lines up with the social icons in the top bar.
- Entries are spaced with a 3rem top margin; the post body stays inside its column and wide images scale down to fit.
- LinkedIn and Instagram render as outline icons, not solid squares (Chassis 0.2.4).

### Fixed
- The search panel opens on the first click and stays open.
- The search panel drops below the top bar instead of covering the magnifier.
- The post body no longer overflows into the sidebar.
- The entry footer and page links clear below floated images.
- The hover outline is gone from menu items; hover and focus underline only, and the drop-down panel has no outline.

## 0.0.1 - 11.17.2026
The first release of Beyond Expectations for ClassicPress, rebuilt on the [Backdrop framework](https://github.com/backdrop-dev/framework) 2.0. The layout and look stay close to the original theme.

### Added
- Customizer panels Theme: Global, Theme: Header, Theme: Content and Theme: Footer (`backdrop-dev/customize`), with a Layout section (content with sidebar or full width, as a radio image control), a Feature Image section (the size of a page's featured image) and a Credit section (a random "powered by" line, or your own footer text).
- Appearance > Beyond Expectations Settings with three tabs: General (a private page to show on a 404 error, and options to turn off the emoji scripts, the toolbar and the embed script), Themes and Plugins (recommended plugins from `config/plugins.json`).
- Comment views like Amicable: `public/views/comments/default.php`, `public/views/comment/default.php` and `public/views/comment/ping.php`. Each comment shows the avatar, author and the date · Edit · Reply links in its header, and "In reply to" from the third level down.
- A "Skip to content" link, and the search toggle can be opened with the keyboard.
- `changelog.md`.

### Changed
- Built on the Backdrop framework 2.0 and its packages, installed with Composer: view, template hierarchy, template helpers, template manager, theme, pagination, attr, fonts, icons, customize and tools.
- The `app/` and `config/` folders follow Amicable's layout (`CleanCP`, `Customize`, `PluginManager`, `Settings`, `Template`, `ThemeManager`, `Tools`, `Vite`).
- Templates are views in `public/views`, loaded by the template hierarchy; `index.php` is the only template in the theme root.
- Markup uses BEM class names (`entry__title`, `site-header__branding`, `primary-navigation__toggle`, `comment__meta` and so on), and the attr package builds the html, body, entry, comment and layout attributes.
- Styles and scripts are built with Vite and Sass from `resources/` into `public/assets`. `style.css` only holds the theme header.
- Icons are inline SVG from the Backdrop icons package (Iconoir); the Font Awesome icon font is gone. Brand icons that Iconoir doesn't have are in `public/svg/social-icons`. The header icons are 18px and sharper.
- Fonts load locally from the Backdrop fonts package: Fira Sans for the site title, headings and menus, and Merriweather for body text. Body text has a 1.6 line height.
- The footer shows a copyright line with links to ClassicPress and the theme by default.
- The Full Width and Custom Sidebar page templates are registered with the template manager and keep their saved names, so pages that use them keep working.
- Requires PHP 7.4 or later.

### Fixed
- Found with the Theme Unit Test data: long titles and words no longer run out of the content area, the page numbers wrap on phones, the blockquote marks stay inside the content area, and the italic, underlined code style only applies on the 404 and search pages.
- The search form label was hidden from screen readers.
- The header navigation aria attribute and the footer markup.

### Credits
- The header image and the screenshot credit the photo by Greg Rakozy (CC0) in `readme.txt` and `readme.md`.
