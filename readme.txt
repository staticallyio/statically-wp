=== statically.io - CDN for static assets ===

Contributors: statically, fransallen
Donate link: https://www.patreon.com/fransallen
Tags: images, optimization, minification, processing, cdn, google cloud, cloudfront, cloudflare
Requires at least: 4.6
Requires PHP: 7.2
Tested up to: 5.7
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Host and optimize image, CSS, and JavaScript files with statically.io CDN.

== Description ==

statically.io is the fast and easy way to make your websites load faster. This plugin allows you to easily host and optimize static assets with our fast, reliable global CDN.

[**statically.io**](https://statically.io)

== FEATURES ==

* Image Optimization (auto-WebP, compression level)
* CDN for static assets (images, CSS, JavaScript, fonts)
* CDN for WordPress Core Assets
* CDN for WordPress Emoji
* Create beautiful Open Graph images for social media
* Generate a beautiful favicon
* Replace existing CDNJS URL with statically.io
* Powered by multi-CDN (Cloudflare, Fastly, bunny.net, Google Cloud, and CloudFront)

== BENEFITS ==

* Drastically speed-up your websites by serving static assets with statically.io
* Powered by multi-CDN, offering the most reliable network in its class
* Lighten your server from static asset traffic loads

== HOW DOES IT WORK? ==

statically.io is made to be simple and easy to use. Optimizing files with statically.io is easy as typing a URL into the browser address bar. This plugin works by replacing static links to CDN links. Changed `https://example.com/cat.jpg` to `https://cdn.statically.io/img/example.com/cat.jpg`.

Adding a statically.io link in front of your file link will make it **instantly globally distributed** and give you **the benefit of real-time file optimization**. Visitors will access the site faster and enjoy bandwidth savings, so will you.

== PRINCIPLE ==

Optimizing files for your website can be a pain, you have to install plugins for image optimization and CSS/JS minification. But the process is done on your server so it can create loads.

That's why we want to provide a cloud-based solution that is simple and easy to use for anyone. statically.io allows you easily compress and resize images as well as minify CSS and JavaScript files using our powerful URL-based API. By using statically.io, your static assets will be instantly available worldwide on premium networks operated by Google, Amazon, Cloudflare, Fastly, and bunny.net which saves money on bandwidth.

== CONTRIBUTE ==

* Anyone is welcome to contribute to the plugin on [GitHub](https://github.com/staticallyio/statically-wp).

== Installation ==

#### INSTALL STATICALLY.IO FROM WITHIN WORDPRESS

1. Visit the plugins page within your dashboard and select "Add New";
2. Search for "statically.io";
3. Activate statically.io from your Plugins page;
4. Access the plugin settings from the "statically.io" menu.

#### INSTALL STATICALLY.IO MANUALLY

1. Upload the "statically" folder to the /wp-content/plugins/ directory;
2. Activate the statically.io plugin through the "Plugins" menu in WordPress;
3. Access the plugin settings from the "statically.io" menu.

== Frequently Asked Questions ==

= Is this plugin free? =

Yes this plugin is totally free! You may donate to our development via Patreon or Paypal which is found inside the statically.io page in the dashboard.

= I tested it on my site and it didn't work! =

Our service only works for sites that are accessible over the internet. And if you use a firewall, be sure to [whitelist statically.io](https://statically.io/docs/whitelisting-statically/). Contact us via the [Contact page](https://statically.io/contact/) or post in the support forums here if you experience difficulty and we'll be happy to help.

= How does multi-CDN work at statically.io? =

statically.io uses multi-CDN under the **cdn.statically.io** domain to provide fast and reliable service to end users, it will select the fastest server from 5 CDN providers for your location. This is done automatically and no action from you is required.

= Can I use only one preffered CDN? =

No, statically.io's services are only available under the **cdn.statically.io** domain and it is multi-CDN enabled to provide the best service performance around the globe.

= NSFW content =

statically.io is a family friendly site and we DO NOT intentionally accept or allow the NSFW types of sites into our program. Learn more about our [TOS here](https://statically.io/policies/terms/).

== Screenshots ==

1. General settings
2. Speed settings
3. Extra settings

== Changelog ==

= 1.1.3 =
* Fixed a missing default Image path

= 1.1.2 =
* Support custom Images path

= 1.1.1 =
* Rebranding to statically.io

= 1.1 =
* Added CSS CDN option
* Fixed incorrect WP subdir URL rewriting
* Updated descriptions

= 1.0.2 =
* Fixes

= 1.0.1 =
* Removed admin notice

= 1.0 =
* Fixes
* Removed Debug admin page
* Updated admin notice

= 0.9.1 =
* Security fixes

= 0.9 =
* Added option to enable/disable image CDN

= 0.8.2 =
* Update some UI components

= 0.8.1 =
* Fix custom domain detection
* Added description for Auto-WebP option

= 0.8 =
* Ability to serve JavaScript files on CDN
* Added statically.io Zone ID option for Custom Domain
* Added Analytics tab (Custom Domain required)
* Added Caching tab and its Purge Cache feature (Custom Domain required)
* Added Support Us tab
* Added Favicons service on Tools tab
* Display notice when the site doesn't have HTTPS
* Display notice for statically.io Sites CDN deprecation
* Remove `cdn.statically.io/sites` URL

= 0.7 =
* Option to replace CDNJS URL with statically.io

= 0.6.3 =
* Add Community forum link

= 0.6.2 =
* Fixes

= 0.6.1 =
* Fixes
* Simplify the settings

= 0.6 =
* Automatic progressive enhancements
* Developer mode
* Tools tab

= 0.5.2 =
* Remove transformation for SVG files on Smart Image Resize

= 0.5.0 =
* Added smart image resizer
* Added favicon generator service
* Support for external images

= 0.4.3 =
* Updated UI

= 0.4.2 =
* Option to disable for logged-in users
* Option to add exclusions to pages with the specified query string

= 0.4.1 =
* Added OG Image customization

= 0.4.0 =
* Option to enable OG Image service

= 0.3.0 =
* Option to enable and disable auto-WebP

= 0.2.2 =
* Improve statically.io Images regex

= 0.2.1 =
* Improve custom domain support

= 0.2.0 =
* Added image quality and size options
* Improve URL rewriter
* Custom domain support

= 0.1.0 =
* First minor release
* Changed the default emoji CDN URL with statically.io
* Added query strings remover
* Loads jquery-core, jquery-migrate, dashicons, and wp-block-library from statically.io Libs

= 0.0.1 =
* First release