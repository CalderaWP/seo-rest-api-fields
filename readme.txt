=== REST API SEO Fields ===
Contributors: Shelob9
Donate link: http://example.com/
Tags: comments, spam
Requires at least: 4.4
Tested up to: 4.4
Stable tag: 0.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get or update SEO fields via the WordPress REST API.

== Description ==

Adds SEO Fields from [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/) to responses for posts in the [WordPress REST API 2.0-beta3](https://wordpress.org/plugins/rest-api/). Also allows for updating by an authenticated user.

This plugin is a free plugin by [CalderaWP](https://CalderaWP.com). It is not an official add-on for WordPress SEO and is no way associated with the makers of WordPress SEO.

* Requires [WordPress REST API (WP-API) 2.0-beta3](https://wordpress.org/plugins/rest-api/) or later.
* Requires [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/)

This plugin is available on Github if you wish to contribute, or report bugs: [Github Readme](https://github.com/CalderaWP/seo-rest-api-fields/).

== Installation ==

* Install WordPress SEO by Yoast, and the REST API plugin v2.
* Install this plugin.
* Activate this plugin.

== Frequently Asked Questions ==
= Does It Work With Version 1 of The API? =

No it does not.

= Does It Work With Other SEO Plugins? =

Out of the box? No, it does not.

It could though. Create a new instance of the class with your own field values. See the [Github Readme](https://github.com/CalderaWP/seo-rest-api-fields/) for an example.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
