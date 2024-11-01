<?php
/*
Plugin Name: SublimeVideo (deprecated)
Version: 1.0.14
Author: Jon Breitenbucher
Author URI: http://jon.breitenbucher.net
Plugin URI: http://orthogonalcreations.com/sublimevideo-plugin/
License: GPL3
Description: This plugin will allow you to add the SublimeVideo player to your site. It will add the Javascript to the head of the site after you provide your player code and allows you to set a default width and height for the player as well as a default poster and preload setting. It also provides a shortcode for embedding the SublimeVideo player in a post or page. Usage is [sublimevideo location="path-to-folder-containing-videos" width="#" height="#" poster="poster-filename" preload="none" class="sublime" download="yes" thumbnail="thumbnail-filename" mp4="mp4-filename" m4v="m4v-filename" webm="webm-filename" ogg="ogg-filename" flv="flv-filename"] and the only thing you must provide is a url for at least one video format. Setting download="no" will cause the download links to not be displayed.

If your videos, thumbnails, and posters are stored in a central upload folder, then you can set the location in the SublimeVideo Options to be the URL for this folder. Then poster-filename, thumbnail-filename, mp4-filename, ogg-filename, etc. would just be the actual filename of the file. If you do not use a central upload for your videos, thumbnails, and posters then you can leave the location at the default http://yoursite.com/file/ in the options. You would then set the mp4-filename, webm-filename, etc. to the portion of the File URL appearring after file/. The File URL is displayed when you upload a file using the WordPress Uploader or when you Edit an uploaded file in the Media panel. Additionally you could set location="" in the shortcode and mp4="mp4-File-URL", etc.

Also, you can use the zoom feature of the SublimeVideo player by using class="sublime zoom" thumbnail="thumbnail-filename" and m4v="m4v-filename" in addition to one of the video formats. The thumbnail acts as small place holder in the site when using the SublimeVideo player's zoom feature. It is only required if you are using the zoom feature.

Thanks to Stuart Henderson for suggesting some of the options for the shortcode.
*/

/*
SublimeVideo (Wordpress Plugin)
Copyright (C) 2010 Jon Breitenbucher
Contact me at http://orthogonalcreations.com/contact-me/

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

// create custom plugin settings menu
add_action('admin_menu', 'sublimevideo_create_menu');

function sublimevideo_create_menu() {
// create new menu in the Settings panel
	add_options_page('SublimeVideo Options', 'SublimeVideo', 'manage_options', 'sublimevideo_settings_page', 'sublimevideo_settings_page');

// call register settings function
	add_action( 'admin_init', 'register_sublimevideo_settings' );
}


function register_sublimevideo_settings() {
// register our settings
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_playercode' );
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_width' );
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_height' );
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_preload' );
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_location' ); // suggested by Stuart Henderson
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_poster' );
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_class' ); // suggested by Stuart Henderson
	register_setting( 'sublimevideo-settings-group', 'sublimevideo_player_download' ); // suggested by Stuart Henderson
}

// create the actual contents of the settings page
function sublimevideo_settings_page() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	$uploads = get_option('home')."/files/";
?>
<div class="wrap">
<h2>SublimeVideo Options</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'sublimevideo-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        	<th scope="row">Player Code</th>
        	<td><input type="text" name="sublimevideo_playercode" value="<?php echo esc_attr(get_option('sublimevideo_playercode')); ?>" /> Provided by SublimeVideo at the end of the URL in your Embed Code.</td>
        </tr>
        
        <tr valign="top">
        	<th scope="row"><h4>Player defaults</h4></th>
        	<td>&nbsp;</td>
        </tr>
         
		<tr valign="top">
        	<th scope="row">Default video location:</th>
        	<td><input type="text" name="sublimevideo_player_location" value="<?php echo esc_attr(get_option('sublimevideo_player_location', $uploads)); ?>" /> The default location for video files if not overridden.</td>
        </tr><!-- suggested by Stuart Henderson -->

        <tr valign="top">
        	<th scope="row">Default player width:</th>
        	<td><input type="text" name="sublimevideo_player_width" value="<?php echo esc_attr(get_option('sublimevideo_player_width','640')); ?>" /> The default width of the video player if not set.</td>
        </tr>
        
        <tr valign="top">
        	<th scope="row">Default player height:</th>
        	<td><input type="text" name="sublimevideo_player_height" value="<?php echo esc_attr(get_option('sublimevideo_player_height','360')); ?>" /> The default height of the video player if not set.</td>
        </tr>

		<tr valign="top">
        	<th scope="row">Default poster image URL:</th>
        	<td><input type="text" name="sublimevideo_player_poster" value="<?php echo esc_attr(get_option('sublimevideo_player_poster','')); ?>" /> The default image displayed in the player window if not set.</td>
        </tr>

		<tr valign="top">
        	<th scope="row">Default preload:</th>
        	<td><input type="text" name="sublimevideo_player_preload" value="<?php echo esc_attr(get_option('sublimevideo_player_preload','none')); ?>" /> The default is none so that the videos are not preloaded. Other options are metadata and auto.</td>
        </tr>

		<tr valign="top">
			<th scope="row">Default class:</th>
			<td><input type="text" name="sublimevideo_player_class" value="<?php echo esc_attr(get_option('sublimevideo_player_class','sublime')); ?>" /> The default is sublime which is necessary to initiate the player. The zoom class can be added.</td>
		</tr><!-- suggested by Stuart Henderson -->
		
		<tr valign="top">
			<th scope="row">Default setting to display download links:</th>
			<td><input type="text" name="sublimevideo_player_download" value="<?php echo esc_attr(get_option('sublimevideo_player_download','yes')); ?>" /> The default is yes to display the download link.</td><!-- suggested by Stuart Henderson -->
		</tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>
<?php
// insert the SublimeVideo javascript into the header
function add_sublimevideo_header() {
			    $playercode = esc_attr(get_option('sublimevideo_playercode'));
			    echo '<script type="text/javascript" src="http://cdn.sublimevideo.net/js/' . $playercode . '"></script>';
}

// filter the posts and check to see if we need to add the javascript to the head
add_filter('the_posts', 'conditionally_add_sublimevideo_javascript'); // the_posts gets triggered before wp_head
function conditionally_add_sublimevideo_javascript($posts) {
          if (empty($posts)) return $posts;

              $shortcode_found = false; // use this flag to see if javascript needs to be added
                    foreach ($posts as $post) {
                         if (stripos($post->post_content, '[sublimevideo ')) {
                                $shortcode_found = true; // bingo!
                                break;
                         }
                     }

           if ($shortcode_found) {
                    add_action('wp_head','add_sublimevideo_header');
           }

           return $posts;
}
 
function sublimevideo_shortcode($atts) {
	// extract the options
 extract(shortcode_atts(array(
		'location' => esc_attr(get_option('sublimevideo_player_location')), // suggested by Stuart Henderson
		'width' => esc_attr(get_option('sublimevideo_player_width')),
		'height' => esc_attr(get_option('sublimevideo_player_height')),
		'poster' => esc_attr(get_option('sublimevideo_player_poster')),
		'preload' => esc_attr(get_option('sublimevideo_player_preload')),
		'class' => esc_attr(get_option('sublimevideo_player_class')), // suggested by Stuart Henderson
		'download' => esc_attr(get_option('sublimevideo_player_download')), // suggested by Stuart Henderson
		'thumbnail' => '', // suggested by Stuart Henderson
		'display' => '', // suggested by Stuart Henderson
		'name' => '', // suggested by Stuart Henderson
		'mp4' => '',
		'webm' => '',
		'ogg' => '',
		'm4v' => '',
		'flv' => '',
	), $atts));

	// Thumbnail Source Supplied // suggested by Stuart Henderson
	    if ($thumbnail) {
	        $thumbnail_source = esc_attr($location).esc_attr($thumbnail);
	    }

	// Poster Source Supplied
	    if ($poster) {
	        $poster_source = esc_attr($location).esc_attr($poster);
	    }

	// M4V Source Supplied // suggested by Stuart Henderson
	    if ($m4v) {
	        $m4v_source = '<source src="'.esc_attr($location).esc_attr($m4v).'" type="video/mp4"/>';
	        $m4v_link = '<a href="'.esc_attr($location).esc_attr($m4v).'">M4V</a>';
	        $m4v_ref = esc_attr($location).esc_attr($m4v);
	    }

	// MP4 Source Supplied
		if ($mp4) {
	    	$mp4_source = '<source src="'.esc_attr($location).esc_attr($mp4).'" type="video/mp4"/>';
	    	$mp4_link = '<a href="'.esc_attr($location).esc_attr($mp4).'">MP4</a>';
	  }

	// WebM Source Supplied
		if ($webm) {
			$webm_source = '<source src="'.esc_attr($location).esc_attr($webm).'" type="video/webm"/>';
			$webm_link = '<a href="'.esc_attr($location).esc_attr($webm).'">WebM</a>';
		}

	// Ogg source supplied
		if ($ogg) {
			$ogg_source = '<source src="'.esc_attr($location).esc_attr($ogg).'" type="video/ogg"/>';
			$ogg_link = '<a href="'.esc_attr($location).esc_attr($ogg).'">Ogg</a>';
		}

	// FLV source supplied // suggested by Stuart Henderson
		if ($flv) {
			$flv_source = '<source src="'.esc_attr($location).esc_attr($flv).'" type="video/x-flv"/>';
			$flv_link = '<a href="'.esc_attr($location).esc_attr($flv).'">FLV</a>';
		}
	// suggested by Stuart Henderson
	$downloadhtml = <<<_end_
		<!-- Download links provided for devices that can't play video in the browser. -->
		<p class="sublimevideo-no-video"><strong>Download Video:</strong> 
			{$mp4_link}
			{$m4v_link}
			{$webm_link}
			{$ogg_link}
			{$flv_link}
		</p>
_end_;
	// suggested by Stuart Henderson
	$anchorhtml = <<<_end_
			<a class="sublime" href="$m4v_ref" style="text-decoration:none;"><img src="$thumbnail_source"><span class="icon"></span></a>
_end_;
	// suggested by Stuart Henderson
	$headerhtml = <<<_end_
		<!-- Begin SublimeVideo -->
		<div class="sublimevideo-box">
_end_;
	// suggested by Stuart Henderson
	$videohtml = <<<_end_
<video class="$class" width="$width" height="$height" poster="$poster_source" preload="$preload" $display>{$mp4_source}{$m4v_source}{$webm_source}{$ogg_source}{$flv_source}</video></div>
_end_;
	// suggested by Stuart Henderson
$footerhtml = <<<_end_
		<!-- End SublimeVideo -->
_end_;
	// suggested by Stuart Henderson
	$sublimevideo = $headerhtml;
	// Anchor required
	if (strpos($class, 'zoom') || $m4v != '') {
	        $sublimevideo .= $anchorhtml;
			$display = "style='display:none;'";
	}
	// suggested by Stuart Henderson
	$sublimevideo .= $videohtml;
	// Download link required
	    if ($download == 'yes') {
	        $sublimevideo .= $downloadhtml;
	}
	$sublimevideo .= $footerhtml;

	// send back text to calling function
	return $sublimevideo;
}

// tell wordpress to register the sublimevideo shortcode
add_shortcode('sublimevideo', 'sublimevideo_shortcode');
?>