
# WordPress Master Plugin
this setup is in early alpha. might contain inconsistency, bugs and misleading info/documentation

## Description
This is a boilerplate WordPress plugin featuring namespace autoloading.
Namespace autoloading also you to just duplicate classes, rename file and classname and frees you of the burden to have unique function names (like pluginname_function_name).
Inspired from, but heavily modified https://github.com/dmhendricks/wordpress-base-plugin

all relevant code in *app* folder, structured by functionality, see further readme files there (incomplete)


## Requirements

* WordPress 5.2 or higher
* PHP 7.2 or higher
* CMB2 as a mu-plugin (https://github.com/CMB2/CMB2)

## Installation
1. Put repo in *mu-plugins* and load it in load-mu-plugins.php  ```require WPMU_PLUGIN_DIR.'/yours/yours.php; ``` 
2. It requires CMB2 so make sure to have CMB2 also in mu-plugins and load it before yours-master ``require WPMU_PLUGIN_DIR.'/cmb2/init.php';```
3. run ```composer install``` (and after changes (i.e. adding new files or folders)) you might need to run ```composer dump-autoload -o```








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



