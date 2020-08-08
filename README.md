
# WordPress Master Plugin
this setup is in early alpha. might contain inconsistency, bugs and misleading info/documentation

## Description
This is a boilerplate WordPress plugin featuring namespace autoloading.
Namespace autoloading also you to just duplicate classes, rename file and classname and frees you of the burden to have unique function names (like pluginname_function_name).
Inspired from, but heavily modified https://github.com/dmhendricks/wordpress-base-plugin

## Folder Strukture:

-app           : contains mostly php files, subfolder by functionality
-- helpers	  : mostly for media/srcset/ functionality
- languages     : ...
- vendor        : created by composer
- wp-content    : the vendor based plugin installs these,  bulk-actions
- assets        : js and css files, build folder, used by original gulp build process (see https://github.com/dmhendricks/wordpress-base-plugin). not in use

## Requirements

* WordPress 5.2 or higher
* PHP 7.2 or higher
	* Carbon Fields is only required for the demo. You're welcome to strip out references if you do not wish to use it.

## Installation
1. Put repo in *mu-plugins* and load it in load-mu-plugins.php ( *require WPMU_PLUGIN_DIR.'/yours/yours.php'*). 
2. It requires CMB2 so make sure to have CMB2 also in mu-plugins and load it before yours-master (*require WPMU_PLUGIN_DIR.'/cmb2/init.php';*) 
3. run *composer install* (and after changes (i.e. adding new files or folders)) you might need to run *composer dump-autoload -o*








## Features

* Namespaces & dependency autoloading
* Dependency checking via [Requirements](https://packagist.org/packages/underdev/requirements)
* Powered by [Composer]
* ~Object caching (where available; [usage examples](https://github.com/dmhendricks/wordpress-toolkit/wiki/ObjectCache))~
* ~Easy installable ZIP file generation: `npm run zip`~
* Automatic translation file (`.pot`) creation. See [Translation](https://github.com/dmhendricks/wordpress-base-plugin/wiki/Translation).
* ~Customizer examples using [WP Customizer Framework](https://github.com/inc2734/wp-customizer-framework/)~


## Gutenberg Blocks Building:
block build-setup no included here. some build blocks are in app/Blocks



