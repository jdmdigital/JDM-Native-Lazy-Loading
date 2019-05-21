<?php
/**
 * Plugin Name: JDM Native Lazy Loading
 * Plugin URI:	https://github.com/jdmdigital/JDM-Native-Lazy-Loading
 * Description: This plugin adds the <code>loading="lazy"</code> attribute to IMG tags within your content to support native image lazy loading, coming in Chrome 75.
 * Version:     1.2
 * Author:      JDM Digital
 * Author URI:  https://jdmdigital.co
 */

// If this file is called directly, abandon ship.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NATIVELAZYLOADING_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'NATIVELAZYLOADING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'NATIVELAZYLOADING_DEBUG', false );

/* == Build Settings Page and Declare Options == 
 * @since v1.1
 */
require_once(NATIVELAZYLOADING_PLUGIN_PATH . 'settings.php');
// Add Settings Link to Plugins >> Installed Plugins
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'jdm_add_plugin_settings_link');
function jdm_add_plugin_settings_link( $links ) {
	$links[] = '<a href="' .admin_url( 'options-general.php?page=jdm-native-lazy-loading' ) .'">' . __('Settings') . '</a>';
	return $links;
}

/* 
* Get the current time and set it as an option when the plugin is activated.
* We'll use this later to display a rating request after a week. 
* @since 1.2
*/
function jdm_set_activation_date() {
    $now = strtotime( "now" );
    add_option( 'jdmnll_activation_date', $now );
}
register_activation_hook( __FILE__, 'jdm_set_activation_date' );

/*
* Check date on activation and add to admin notice if it was over 8 days ago.
* @since v1.2
*/
function jdm_check_activation_date() {
	$nobug = get_option( 'jdmnll_no_bug');
	if(!$nobug && !defined('DISABLE_NAG_NOTICES')){
    	$install_date = get_option( 'jdmnll_activation_date' );
    	$past_date = strtotime( '-8 days' );

    	if ( $past_date >= $install_date ) {
        	add_action( 'admin_notices', 'jdmnll_review_notice' );
    	}
	}

}
add_action( 'admin_init', 'jdm_check_activation_date' );


// Add Review Notice (dismissable)
// @since v1.2
function jdmnll_review_notice() {
	$reviewurl 			= 'https://wordpress.org/plugins/native-image-lazy-loading/#reviews';
	$dismissforeverurl 	= '?jdmnllnobug=1';

	$notice = '
	<div class="notice notice-info"> 
		<p>If our little plugin is working great for you, do us a big favor and <a href="'.$reviewurl.'" target="_blank" rel="noopener nofollow" style="font-weight:600">rate us on WordPress.org</a> or don\'t. Your choice. <a href="'.$dismissforeverurl.'">Dismiss Forever</a></p>
	</div>';
	
	if( is_admin() && get_option( 'jdmnll_no_bug') && !defined('DISABLE_NAG_NOTICES') ){
		echo $notice;
	}
	
}

/**
* Set the plugin to no longer bug users.
* @since v1.2
*/
function jdmnll_set_no_bug() {
    $nobug = "";
    if ( isset( $_GET['jdmnllnobug'] ) ) {
        $nobug = esc_attr( $_GET['jdmnllnobug'] );
    }

    if ( 1 == $nobug ) {
        add_option( 'jdmnll_no_bug', TRUE );
    }

} 
add_action( 'admin_init', 'jdmnll_set_no_bug', 5 );



/* 
 * == Pretty Much the Whole Plugin Here == 
 */


// Same (mostly) signature as str_replace(), but only replaces the FIRST match
// @since v1.1
if(!function_exists('str_replace_first')) {
	function str_replace_first($search, $replace, $subject) {
		$search = '/'.preg_quote($search, '/').'/';
		return preg_replace($search, $replace, $subject, 1);
	}
}


if(!function_exists('jdm_native_lazy_loading')) {
	add_filter('the_content','jdm_native_lazy_loading');
	
	function jdm_native_lazy_loading($content) {
		$default_value = 'lazy';
		$firstImg = esc_attr(get_option('jdmnll_1stimg', $default_value));
		$nthimg = esc_attr(get_option('jdmnll_nthimg', $default_value));
		
		if($firstImg == $nthimg) {
			// Replace all matches with the loading setting
			$content = str_replace('<img','<img loading="'.$nthimg.'"', $content);
		} else {
			// Replace all matches with the nth image loading setting
			$content = str_replace('<img','<img loading="'.$nthimg.'"', $content);
			// Then, Replace just the FIRST image match with the firstImg setting
			$content = str_replace_first('<img','<img loading="'.$firstImg.'"', $content);	
		}
		
		return $content;
	}
	
}

function jdmnll_debug() {
	if(defined('NATIVELAZYLOADING_DEBUG') && NATIVELAZYLOADING_DEBUG) {
		if(get_option( 'jdmnll_no_bug')){
			$nobuggy = 'TRUE';
		} else {
			$nobuggy = 'FALSE';
		}
		$default_value = 'lazy';
		$firstImg = esc_attr(get_option('jdmnll_1stimg', $default_value));
		$nthimg = esc_attr(get_option('jdmnll_nthimg', $default_value));

		$html = '
		<pre>
			Activation Date: '.get_option( 'jdmnll_activation_date' ).'<br/>
			Past Date: '.strtotime( '-8 days' ).'<br/>
			Never Bug: '.$nobuggy.'<br/>
			First Img: '.$firstImg.'<br/>
			Nth Img: '.$nthimg.'<br/>
		</pre>
		';

		echo $html;
	}
	
}
 