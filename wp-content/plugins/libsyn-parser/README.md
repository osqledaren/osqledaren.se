# Libsyn-parser
Wordpress plugin to parse Libsyn RSS-feeds.


This plugin creates and option-menu where you can enter a string of Libsyn-RSS feeds.

The plugin the processes the RSS feed once every hour and outputs the following into wp_contents/libsyn-parser-output

1. JSON interpretation of the RSS feed
2. Saved original images
3. Blurred versions of the original images
4. The JSON has links to the local versions of the images.
