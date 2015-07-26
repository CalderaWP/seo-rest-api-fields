<a href="https://calderawp.com/"><img src="https://calderawp.com/wp-content/uploads/2015/04/cwp-logo-horizontal.png" style="display:inline-block;"/></a>
REST API SEO Fields
==================

Adds SEO Fields from [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/) to responses for posts in the [WordPress REST API 2.0-beta3](https://wordpress.org/plugins/rest-api/). Also allows for updating by an authenticated user.

This plugin is a free plugin by [CalderaWP](https://CalderaWP.com). It is not an official add-on for WordPress SEO and is no way associated with the makers of WordPress SEO.

* Requires [WordPress REST API (WP-API) 2.0-beta3](https://wordpress.org/plugins/rest-api/) or later.
* Requires [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/)


### Other SEO Plugins?
Right now this only works with WordPress SEO by Yoast. It could work with other plugins. Just create a new instance of the main class, and pass the title and description meta fields it uses.

```
    if ( defined( 'REST_API_VERSION' ) && version_compare( REST_API_VERSION,'2.0-beta3', '>=' ) ) {
        //update these variables!!!
        $title_field = 'your_title_field';
        $description_field = 'your_description_field';
        new CWP_REST_API_SEO_Fields( $title_field, $description_field );
		}

	}
```

The above should be performed at the rest_api_init action.

### License & Copyright
* Copyright 2015 Josh Pollock for CalderaWP LLC.

* Licensed under the terms of the [GNU General Public License version 2](http://www.gnu.org/licenses/gpl-2.0.html) or later.

* Please share with your neighbor.

