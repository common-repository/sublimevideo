=== SublimeVideo (deprecated) ===
Contributors: kahless
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 1.0.14

DEPRECATED - DO NOT INSTALL THIS PLUGIN!!

Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

== Description ==

DEPRECATED - DO NOT INSTALL THIS PLUGIN!!

Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

== Installation ==

DEPRECATED - DO NOT INSTALL THIS PLUGIN!!

Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

1. Upload the `sublimevideo` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Enter your settings in the SublimeVideo options page.
1. Use the [sublimevideo] shortcode in your post or page to insert the SublimeVideo player. Optional attributes for the shortcode are location, width, height, poster, preload, class, download, thumbnail, m4v, mp4, webm, and ogg where one of mp4, webm, or ogg needs to be present.

== Frequently Asked Questions ==

DEPRECATED - DO NOT INSTALL THIS PLUGIN!!

Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

= Where do I get a Player Code? =

Your Player Code will be found in the URL contained in the Embed Code of each domain at https://my.sublimevideo.net/sites.

= How do I use the shortcode? =

If you have used the plugin in the past:
[sublimevideo location="" mp4="http://yoursite.com/path-to-upload-folder/movie.mp4" poster="http://yoursite.com/path-to-upload-folder/poster-file.jpg" class="sublime"]

If you have set all the options and store your videos in a central folder:
[sublimevideo mp4="movie.mp4"]

If you have a video that needs to be a different size:
[sublimevideo width="600" height="338" mp4="movie.mp4"]

Using all the options except zooming:
[sublimevideo location="http://yoursite.com/path-to-upload-folder/" width="600" height="338" poster="poster-file.jpg" mp4="movie.mp4" ogg="movie.ogv" webm="movie.webm" flv="movie.flv" preload="auto" class="sublime" download="no"]

Using the zoom feature:
[sublimevideo thumbnail="thumbnail-file.jpg" m4v="movie.m4v" mp4="movie.mp4" ogg="movie.ogv" webm="movie.webm" flv="movie.flv" class="sublime zoom" download="yes"]

== Screenshots ==

DEPRECATED - DO NOT INSTALL THIS PLUGIN!!

Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

1. The Options page.
2. Using the shortcode.
3. Player embedded in a post.

== Changelog ==

= 1.0.14 =
* Nothing – Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

= 1.0.13 =
* Nothing – Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

= 1.0.12 =
* Updated the readme.txt at the request of Jilion to point people to the official plugin.

= 1.0.11 =
* Updated the code to check for the presence of the shortcode. If the shortcode is found then the javascript is added to the head of the page. This should eliminate unneeded pageviews with the SublimeVideo service.

= 1.0.10 =
* Changed the naming of the settings function to comply with conventions.

= 1.0.9 =
* Some more cleanup of the code.
* Added more explicit examples of the usage of the shortcode to the readme.txt.

= 1.0.8 =
* Reworked how the default options are set.
* Set the default upload folder to http://yoursite.com/files/ which should be what most setups default to, even on multisite.
* Added some location references back in on the video source URLs. (They got removed at some point in testing committed to trunk.)

= 1.0.7 =
* Updated sublimevideo.php to check for an m4v file and add display:none to the video element if it is present.

= 1.0.6 =
* Updated the readme.txt to explain the new options.
* Updated sublimevideo.php to have the same description as the readme.txt.
* Updated sublimevideo.php to provide additional options for the plugin and the shortcode.

= 1.0.5 =
* Updated the readme.txt shortcode sample to give a correct shortcode usage example.
* Updated the comments on sublimevideo.php to give a correct shortcode usage example.

= 1.0.4 =
* Flash fallback is not needed as SublimeVideo handles it. Associated code removed.

= 1.0.3 =
* Implemented conditional checks for the different video formats.
* First pass at Flash fallback.
* Added download links for users that do not have support for browser playback.

= 1.0.2 =
* Updated the readme with frequently asked questions.

= 1.0.1 =
* Updated the installation instructions in the readme.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.14 =
Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

= 1.0.13 =
Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

= 1.0.12 =
Please install the official plugin instead: http://docs.sublimevideo.net/wordpress

= 1.0.11 =
Users should upgrade to avoid unnecessary pageviews.

= 1.0.10 =
This version changes the name of the settings function to match convention and avoid possible conflicts with other plugins.

= 1.0.9 =
This version implements a few new options for the shortcode. It is now possible to set a default location for your video, poster, and thumbnail files. The location is set to http://yoursite.com/files/ which should work for most standard installations. If you have used this plugin in the past you can add location="" to the shortcode call to have the existing videos work.
All users are encouraged to visit the SublimeVideo Options and make sure the options are set as they should be. Most important is to make sure the Default class is set to sublime.

= 1.0.5 =
Housekeeping update to cleanup the shortcode usage examples found in various files.

= 1.0.4 =
Flash fallback was not needed so the preliminary code for it has been removed. (Thanks for catching this Stuart.)

= 1.0.3 =
Should now support Flash fallback and download links for users not able to use HTML5 or not able to view video at all.

= 1.0.2 =
Added frequently asked questions to the readme. No functional changes that would require an upgrade.

= 1.0.1 =
Only upgrade if you want the readme.txt file to be the same as what is on the repository.