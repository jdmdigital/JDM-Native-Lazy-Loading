=== JDM Native Lazy Loading ===
Contributors: JDM-labs
Tags: lazy load,lazyload,loading,performance,images
Requires at least: 4.5
Tested up to: 5.2.1
Requires PHP: 5.1
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically add the new `loading` attribute to images within your content to support native image lazy loading.

== Description ==

This plugin adds the `loading` attribute to IMG tags found when filtering `the_content()` to support native image lazy loading.

For more information about lazy loading images using this new native browser image attribute, check out this article: [https://addyosmani.com/blog/lazy-loading/](https://addyosmani.com/blog/lazy-loading/) and for a little more depth into what we're doing here, check out our [explainer post](https://jdmdig.it/30nXp7h).

Historically, to limit the impact offscreen images have on page load times, developers have needed to use a JavaScript library (like [LazySizes](https://github.com/aFarkas/lazysizes) or [Vanilla-LazyLoad](https://www.andreaverlicchi.eu/lazyload/)) in order to defer fetching these images until a user scrolls near them.  What if the browser could avoid loading these offscreen images for you? 

The `loading` attribute instructs a browser to defer loading offscreen images until users scroll near them. It comes in three flavors: **eager**, **auto**, and **lazy**.  Install this plugin and you can set the first image's loading attribute and the loading attribute for all the subsequent images sent through `the_content()` in the plugin's settings page.

**Simple is Beautiful**

There is no JavaScript or CSS included in the plugin.  It just works in browsers that support the new `loading` image attribute.

For browsers that don't support this new image loading attribute, that's ok.  You can still use whatever JavaScript-based image lazy loader you want as a fallback until browser support becomes a little more mainstream.

== Installation ==

1. Install **Native Image Lazy Loading** from the WordPress repo
1. Activate the plugin through the **Plugins** menu
1. Configure in **Settings** >> **Native Lazy Loading**
1. **Marvel** at its simplicity

== Frequently Asked Questions ==

= Does this add any JS? =
Nope.  If you're using another JS-based lazy loader, that'll just keep working as it did.  If the browser doesn't support the `loading` attribute, it'll just ignore it and process per usual.

= Where is the Settings Page? =
In version 1.0 there wan't one, but thanks to a suggestion by [@verlok](https://github.com/verlok), there IS one now.  You'll find it at **Settings** >> **Native Lazy Loading**. 

== Screenshots ==

1. The Settings Page

== Changelog ==

= 1.2 =
* Added Admin Notice (details on [GitHub repo](https://github.com/jdmdigital/JDM-Native-Lazy-Loading/issues/6))
* Added Uninstall Script for housekeeping 
* Added Support for the (unofficial) DISABLE_NAG_NOTICES constant
* Spelling Corrections (Oops)

= 1.1 =
* Added Settings Page
* Added Option to select the `loading=""` attribute

= 1.0 = 
* First release.