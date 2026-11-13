# YarBar: a SEO-friendly, High-speed, Persian (RTL) WordPress theme 

A complete custom WordPress theme for a logistics and moving company's rebrand. I designed and built it alone, from scratch.

[**Live demo →**](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/gisellesmaeili/yarbar-theme/main/blueprint.json)

![Homepage](screenshot.jpg)

## Features

- Homepage built from nine sections: hero, marquee, why-us, services, **cost calculator**, coverage areas, FAQ, blog preview and final call to action
- Custom post types for **Services** and **Locations**, with REST API support and their own archives and single pages
- **Admin settings panel** (nonce and capability checked) for phone, WhatsApp, Telegram, Instagram, FAQ and homepage headings, with no code editing needed
- **AJAX filtering, sorting and pagination** on archives
- Breadcrumbs, share and copy-link buttons, and a honeypot spam filter on comments
- Performance work: stylesheets and scripts load only where needed, scripts are deferred, WordPress head clutter is removed and the hero image comes in responsive WebP sizes
- Right-to-left layout and translation-ready strings (text domain `yarbar`)

## Requirements

WordPress 6.0 or newer, PHP 7.4 or newer.

## Installation

1. Download the latest release zip from the Releases page.
2. In WordPress, go to Appearance > Themes > Add New > Upload Theme.
3. Activate **YarBar**, then open **تنظیمات یاربار** in the admin menu to set your business details.

The theme expects an RTL language such as Persian (`fa_IR`) so that WordPress sets the text direction.

## Structure

- `inc/`: post types, settings panel, helpers, AJAX handlers, performance
- `template-parts/`: homepage sections, header, archive and single templates
- `assets/`: CSS, JS, fonts and images

## Credits

- Design and development: Qazal Esmaeili
- Font: [Arad](https://github.com/MDarvishi5124/Arad) (SIL OFL 1.1), included in `assets/fonts/arad/`

## License

GPL-2.0-or-later. See `LICENSE`.