# Contributing to Beyond Expectations

Thanks for helping with the theme. A few things to know before you open a pull request.

## Branch and pull requests

- The default branch is `develop`. Base every pull request on `develop`, never on `main`.
- Work on a short branch named after the fix, e.g. `fix/skip-link-focus` or `fix/404-escaping`.
- One finding or one small, related set of changes per pull request. Explain in the PR body what changed and why, and note anything you could not verify.
- Never merge your own pull request — the maintainer merges.

## Before you open a PR

From the theme folder:

```sh
composer install --no-dev   # PHP dependencies (Backdrop framework, etc.)
npm install                 # Node dependencies
npm run prod                # Build the styles and scripts with Vite
```

Then check your changes:

- Lint every PHP file you touched: `php -l app/YourFile.php` (or the `find … | xargs -n1 php -l` command CI runs).
- Rebuild with `npm run prod` after touching anything in `resources/scss/` or `resources/js/`, and confirm the entries are still in `public/assets/manifest.json`.
- If you changed a translatable string, regenerate the translation template: `composer make-pot` (WP-CLI must already be installed) and check the entry count is still around 138 with `grep -c '^msgid' public/lang/beyond-expectations.pot`.

## Conventions

- PHP follows the WordPress coding standards (tabs for indentation). SCSS and JS follow the style already in `resources/`.
- Escape late, escape on output: `esc_html()`, `esc_attr()`, `esc_url()` — never echo a filtered or user-supplied value raw.
- Don't commit `node_modules/`, `vendor/`, `public/assets/`, or the release zip — they are built or installed, and gitignored. Do commit `composer.lock` (see below).
- `composer.lock` is committed so installs are reproducible. If you change `composer.json`, run `composer update --lock` and commit the updated lock file with it.

## Releases

Releases are cut from `develop`. The release tag (without the leading `v`) must match both the `Version:` header in `style.css` and the `Stable tag:` in `readme.txt`, or the release workflow fails.
