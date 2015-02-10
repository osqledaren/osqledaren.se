=== Plugin Name ===
Contributors: tomsansome
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=sansometom%40gmail%2ecom&lc=GB&item_name=WP%20Image%20Effects%20Generator%20%2d%20Tom%20Sansome&currency_code=GBP&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: image, effects, generator, resize, image effects, upload, automatically
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.0.1
License: GPLv2 (or later)
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generate image effects on upload.

== Description ==

**On upload this plugin will generate the following effects on that image:**

*   Black and white
*   Blurred
*   Sharpened
*   Sepia
*   Pixelate
*   Negative

**All effects come in the following sizes:**

*   1000px x 1000px not cropped
*   800px x 800px not cropped
*   400px x 400px not cropped

These images are displayed in the **Add Media** area under the **Size** dropdown menu for use in pages and posts.

**Usage with Advanced Custom Fields:**

`<?php $image = wp_get_attachment_image_src(get_field('image'), 'image-effects-1000-bw'); ?>
<img src="<?php echo $image[0]; ?>"/>`

This example is of 1000px wide black and white version.

**All possible image objects:**

* image-effects-1000-bw
* image-effects-800-bw
* image-effects-400-bw
* image-effects-1000-blurred
* image-effects-800-blurred
* image-effects-400-blurred
* image-effects-1000-sharpened
* image-effects-800-sharpened
* image-effects-400-sharpened
* image-effects-1000-sepia
* image-effects-800-sepia
* image-effects-400-sepia
* image-effects-1000-pixelate
* image-effects-800-pixelate
* image-effects-400-pixelate
* image-effects-1000-negative
* image-effects-800-negative
* image-effects-400-negative

For more examples of the above, visit http://dev.twoblok.es/wp-image-effects.

== Installation ==

1. Upload the directory `image-effect-generator` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Settings > Image Effects Settings and select which effects you would like ~ [Image Reference](http://cl.ly/U8U9)
1. Usage under **Description** tab or visit http://dev.twoblok.es/wp-image-effects

== Frequently Asked Questions ==

**Where can I see a nice page to make me feel better?**

[Visit this page](http://dev.twoblok.es/wp-image-effects).

== Screenshots ==

1. Settings page.
1. Add Media area once image uploaded.
1. Displayed on front end

== Changelog ==

= 1.0.1 =
* Let's go!

== Upgrade Notice ==

= 1.0.1 =
* Let's go!