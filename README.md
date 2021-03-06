# JDM Native Lazy Loading
![Native Lazy Loading Images Plugin](https://github.com/jdmdigital/JDM-Native-Lazy-Loading/blob/master/loading-attribute-plugin.png)
WordPress plugin automatically adds the `loading="lazy"` attribute to IMG tags within your content to support native image lazy loading, coming in Chrome 75.

## Description
This plugin adds the `loading="lazy"` attribute to IMG tags found when filtering `the_content()` to support native image lazy loading (coming in Chrome 75).

For more information about native lazy loading images, check out this article: https://addyosmani.com/blog/lazy-loading/ and for a little more depth into what we're doing here, check out our explainer post at: https://jdmdig.it/30nXp7h

Historically, to limit the impact offscreen images have on page load times, developers have needed to use a JavaScript library (like *LazySizes*) in order to defer fetching these images until a user scrolls near them.  What if the browser could avoid loading these offscreen images for you? 

The `loading` attribute allows a browser to defer loading offscreen images and iframes until users scroll near them. It comes in three flavors which you can select (the first one and the Nth ones) to all images sent through `the_content()`.  

Just install, activate, check the settings page, and marvel at its simplicity.  

There are no added CSS.  There is no JS included in the plugin.  There's no advertising at all.  It just works in browsers that support the new `loading` image attribute.

## Settings
The plugin should work ideally right out of the box, but you *can* go to the new settings page at **Settings** >> **Native Lazy Loading** if you want a little more control.  Here, you can choose what the `loading` attribute should be, both for the first image within the content and the rest of the images below that.

![Native Lazy Loading Images Plugin Screenshot](https://github.com/jdmdigital/JDM-Native-Lazy-Loading/blob/master/screenshot-1.JPG)

## Frequently Asked Questions
**Does this add any JS?**

Nope.  If you're using another JS-based lazy loader, that'll just keep working as it did.  If the browser doesn't support the `loading` attribute, it'll just ignore it and process per usual.

**Where is the Settings Page?**

In version 1.0 there wasn't one, but thanks to a suggestion by [@verlok](https://github.com/verlok), there IS one since v1.1.  You'll find it at **Settings** >> **Native Lazy Loading**.  


## Changelog

**1.2**
* Added Admin Notice (details on [GitHub repo](https://github.com/jdmdigital/JDM-Native-Lazy-Loading/issues/6))
* Added Uninstall Script for housekeeping 
* Added Support for the (unofficial) DISABLE_NAG_NOTICES constant
* Spelling Corrections (Oops)
* Fixed Default Settings
* Added Debug Mode (for dev)
* Bug Fixes

**1.1**
* Added Settings Page
* Added Option to select the `loading=""` attribute

**1.0**
* First release.
