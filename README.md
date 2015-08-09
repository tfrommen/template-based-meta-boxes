# Template-based Meta Boxes

Have you ever lost track of all the different meta boxes that your current theme and/or plugins add to the backend of your website?

&ndash; _Do I need this meta for that page template?_  
&ndash; _Why doesn't the page display this and that?_  
&ndash; _What is this meta even used for anyway?_  

This is exactly when _Template-based Meta Boxes_ kicks in.

## Installation

1. [Download ZIP](https://github.com/tfrommen/template-based-meta-boxes/archive/master.zip).
1. Upload contents to the `/wp-content/plugins` directory on your web server.
1. Activate the plugin through the _Plugins_ menu in WordPress.
1. When editing or creating a page in the backend, the plugin automatically shows and hides the meta boxes according to the plugin settings (see next section).

## Settings

The internal format of the plugin's settings is as follows:

```php
Array
(
    [PAGE_TEMPLATE_FILE] => Array
        (
            [0] => META_BOX_ID
            [1] => META_BOX_ID
            ...
        )

    [PAGE_TEMPLATE_FILE] => Array
        (
            [0] => META_BOX_ID
            [1] => META_BOX_ID
            ...
        )

    ...

)
```

Currently, the settings may be defined via the `template_based_meta_boxes` filter hook. So a valid definition of some example settings could look like this:

```php
function set_template_based_meta_box_settings() {

    return array(
		'default'            => array(
			'authordiv',
			'postimagediv',
		),
		'pt_child_pages.php' => array(
			'authordiv',
		),
		'pt_full.php'        => array(),
		'pt_calendar.php'    => array(
			'postimagediv',
		),
    );
}

add_filter( 'template_based_meta_boxes', 'set_template_based_meta_box_settings' );
```

The above code would **set** the settings exactly as they are given. The filter, however, also provides the settings (which are empty by default) as parameter. So you could also **add** some settings from a plugin that adds meta boxes on its own. This will be an enormous effort in most cases, though.

```php
function add_template_based_meta_box_settings( $settings ) {

    $settings[ 'pt_full' ][ ] => 'somepluginmetabox';

    return $settings;
}

add_filter( 'template_based_meta_boxes', 'add_template_based_meta_box_settings' );
```

## Logic

What's missing now is how the plugin will work with the settings.

The plugin manipulates only meta boxes that are part of the settings.

**No matter what page template you choose, the _Author_ meta box, for instance, will only show and hide if there is at least one setting relating to it.**

This leads to several important aspects:

 * **Passing an empty array for a page template does NOT automatically hide all meta boxes when the template has been selected.**
 * **If a meta box is included in at least one setting, it will be hidden for every page template that doesn't have the meta box in its setting. This also includes page templates that are not handled in the settings.**
 * **If you want to hide all meta boxes for a particular page template, you have to use every single one of them for at least one other page template.**

## UI

Yes, I do have a fancy user interface in mind already. One of these days, when I find time for it, I will integrate some sort of UI either into the Screen Options or into a separate tab.

## Contribution

If you have a feature request, or if you have developed the feature already, please feel free to use the Issues and/or Pull Requests section.

Of course, you can also provide me with translations if you would like to use the plugin in another not yet included language.

## Changelog

[Changelog](CHANGELOG.md)
