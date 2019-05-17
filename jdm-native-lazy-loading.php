<?php
/**
 * Plugin Name: JDM Native Lazy Loading
 * Plugin URI:	https://github.com/jdmdigital/JDM-Native-Lazy-Loading
 * Description: This plugin adds the <code>loading="lazy"</code> attribute to IMG tags within your content to support native image lazy loading, coming in Chrome 75.
 * Version:     1.1
 * Author:      JDM Digital
 * Author URI:  https://jdmdigital.co
 */

// If this file is called directly, abandon ship.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NATIVELAZYLOADING_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'NATIVELAZYLOADING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* == Build Settings Page and Declare Options == 
 * @since v1.1
 */
require_once(NATIVELAZYLOADING_PLUGIN_PATH . 'settings.php');



/* == Pretty Much the Whole Plugin Here == */


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
		$firstImg = esc_attr(get_option('jdmnll_1stimg'));
		$nthimg = esc_attr(get_option('jdmnll_nthimg'));
		
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
 