# LFK LFK 2019-12-22_11.55.02

## Doing / Building Blocks:
start block building in blockbuilder directory. this is a setup based on famous react-build-block (see package.)
you can config the blockbuilder JS-part with file *webpack.config.js* (here you set which files are build).
I changed the build setup so that it writes the builded files into *app/Blocks/editor.blocks.js*
to start build:
*** npm run watch *** (see package.json)

## Browser Refresh via gulpfile
use gulpfile in basedir. 
run ***gulp***
(gulp is installed globally, so run ***npm link gulp*** first)

## Package JSON / Node Modules
the orginal plugin contains node modules to package and translate the plugin. This is not in use at the moment (LFK 2019-12-22_12.09.34)
and so package.json is renamed into "org-package.json"... 
and (orginal) node_moduels is deleted.
For my setup node_modules is linked to 
***/var/www/neuro/wp-content/themes/yours/node_modules***

## Folder Strukture:
app           : contains mostly php files, subfolder by functionality
assets        : js and css files, build folder, used by original gulp build process. not in use
blockbuilder  : larslos blockbuilder based on famous block builder (see github)
languages     : ...
node_modules  : ...
vendor        : ...
wp-content    : the vendor based plugin installs these, carbon-fields, bulk-actions




# WordPress Base Plugin

- [Documentation](https://github.com/dmhendricks/wordpress-base-plugin/wiki/)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Future Goals](#future-goals)
- [Change Log](#change-log)

## Description

This is a boilerplate WordPress plugin featuring namespace autoloading and [Carbon Fields](https://carbonfields.net/?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin) examples. It is intended to be used as a starting point for creating WordPress plugins. It contains several examples and dependencies to get you started.

It may also be used as the means of [separating custom code](http://www.billerickson.net/core-functionality-plugin/?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin) from the theme or [extending a child theme](https://www.wp-code.com/wordpress-snippets/wordpress-grandchildren-themes/?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin).

### Contributing

Here are some ways that you can contribute:

* Suggest improvements and/or code them.
* [Report bugs](https://github.com/dmhendricks/wordpress-base-plugin/issues) and/or incompatibilities.
* Host your sites with [Flywheel](https://share.getf.ly/e25g6k?utm_source=github.com&utm_medium=campaign&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin), use [KeyCDN](https://www.keycdn.com/?a=42672&utm_source=github.com&utm_medium=campaign&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin
) for speedy delivery of assets.

## Features

* Namespaces & dependency autoloading
* Dependency checking via [Requirements](https://github.com/Kubitomakita/Requirements)
* Powered by [Composer](https://getcomposer.org/?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin), [Gulp](https://gulpjs.com/?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin) and [Bower](https://bower.io/?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin)
* Object caching (where available; [usage examples](https://github.com/dmhendricks/wordpress-toolkit/wiki/ObjectCache))
* Easy installable ZIP file generation: `npm run zip`
* Automatic translation file (`.pot`) creation. See [Translation](https://github.com/dmhendricks/wordpress-base-plugin/wiki/Translation).
* Network Admin (multisite) options, shortcodes, widgets (via [Carbon Fields](https://carbonfields.net?utm_source=github.com&utm_medium=referral&utm_content=button&utm_campaign=dmhendricks%2Fwordpress-base-plugin)) and custom post types (via [PostTypes](https://github.com/jjgrainger/PostTypes/)) examples
* Configuration registry ([docs](https://github.com/dmhendricks/wordpress-toolkit/wiki/ConfigRegistry)) and optional `wp-config.php` [constants](https://github.com/dmhendricks/wordpress-base-plugin/wiki/Configuration-&-Constants)
* Customizer examples using [WP Customizer Framework](https://github.com/inc2734/wp-customizer-framework/)
* Define environmental variables via `.env` files ([reference](https://github.com/dmhendricks/wordpress-toolkit/wiki/ToolKit#environment))
* [More to come...](#future-plans)

## Requirements

* WordPress 4.8 or higher
* PHP 7 or higher
* [Carbon Fields](https://github.com/htmlburger/carbon-fields) 2.2 or higher. See the wiki section [Carbon Fields](https://github.com/dmhendricks/wordpress-base-plugin/wiki#carbon-fields) for more info.
	* Carbon Fields is only required for the demo. You're welcome to strip out references if you do not wish to use it.

## Installation

If you need tips on installing Node.js, Composer, Gulp & Bower, see [Installing Dependencies](https://github.com/dmhendricks/wordpress-base-plugin/wiki/Installing-Dependencies).

#### The short version:

1. Clone repository to your `plugins` directory
1. Change the four variables in [package.json](https://github.com/dmhendricks/wordpress-base-plugin/wiki#setting-initial-variables). Modify [plugin.json](https://github.com/dmhendricks/wordpress-base-plugin/blob/master/plugin.json) as necessary.
1. Run `npm install; gulp rename; composer install`
1. (optional) For some of the included examples to work, you'll also want to run: `bower install; gulp;`

You'll want to delete features that you don't like (such as references to [TGMPA](http://tgmpluginactivation.com/) if you don't need it).

### Clone Repository

1. At command prompt, change to your `wp-content/plugins` directory.
1. Clone the repository: `git clone https://github.com/dmhendricks/wordpress-base-plugin.git`
1. Renamed the newly created `wordpress-base-plugin` directory to your own plugin slug.

### Next Steps

See the [Getting Started](https://github.com/dmhendricks/wordpress-base-plugin/wiki#getting-started) documentation for further steps.

## Future Goals

* Add plugin `uninstall.php`
* Switch to [webpack](https://webpack.js.org/) for frontend dependency management
* ~~Remove or replace [wordpress-settings-api-class](https://github.com/tareq1988/wordpress-settings-api-class/) example with something actively developed~~
* Clean up Carbon Fields _custom_ CSS classes
* Add automatic GitHub update example
* Add Gutenberg block examples

## Screenshot

![Settings Page](https://raw.githubusercontent.com/dmhendricks/wordpress-base-plugin/master/assets/screenshot-1.png "Settings Page")