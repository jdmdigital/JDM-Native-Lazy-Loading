=== JDM Native Lazy Loading ===
Contributors: jdmdigital
Tags: lazy loading, img attribute
Requires at least: 4.5
Tested up to: 5.2
Stable tag: 1.0
License: MIT

Adds the loading="lazy" attribute to IMG tags within your content to support native image lazy loading, coming in Chrome 75.

== Description ==
This plugin adds the ***loading="lazy"*** attribute to IMG tags within your content to support native image lazy loading, coming in Chrome 75.

For more information about native lazy loading images, check out this article: https://addyosmani.com/blog/lazy-loading/

Historically, to limit the impact offscreen images have on page load times, developers have needed to use a JavaScript library (like *LazySizes*) in order to defer fetching these images until a user scrolls near them.  What if the browser could avoid loading these offscreen images for you? 

The `loading` attribute allows a browser to defer loading offscreen images and iframes until users scroll near them. It comes in three flavors, but this plugin simply adds the attribute `loading="lazy"` to all images sent through `the_content()`.  

Just install, activate, and marvel at its simplicity.  

There are no added CSS.  There is no JS included in the plugin.  It just works in browsers that support the new `loading` image attribute.

== Frequently Asked Questions ==
= Does this add any JS? =
Nope.  If you're using another JS-based lazy loader, that'll just keep working as it did.  If the browser doesn't support the `loading` attribute, it'll just ignore it and process per usual.

= Where is the Settings Page? =
There isn't one.  It just adds a plugable function which filters the content and replaces `<img` with `<img loading="lazy"`.  Simple.


== Changelog ==

= 1.0 =
* First release.
