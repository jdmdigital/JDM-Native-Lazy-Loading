<?php
/**
 * Plugin Name: JDM Native Lazy Loading
 * Description: This plugin adds the <code>loading="lazy"</code> attribute to IMG tags within your content to support native image lazy loading, coming in Chrome 75.
 * Version:     1.0
 * Author:      JDM Digital
 * Author URI:  https://jdmdigital.co
 */

if(!function_exists('jdm_native_lazy_loading')) {
	add_filter('the_content','jdm_native_lazy_loading');
	function jdm_native_lazy_loading($content) {
		$content = str_replace('<img','<img loading="lazy"', $content);
		return $content;
	}
}
 