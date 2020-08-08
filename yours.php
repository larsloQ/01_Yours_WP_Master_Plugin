<?php
/**
 * @wordpress-plugin
 * Plugin Name:       01_Yours_Master_Plugin
 * Plugin URI:        https://github.com/larsloQ/01_Yours_WP_Master_Plugin.git
 * Description:       A Master Plugin defining all building blocks of a custom wordpress (post-types, meta-boxes, taxonomies, etx). based on (but heavily modified) https://github.com/dmhendricks/wordpress-base-plugin
 * Version:           0.5.4
 * Author:            larslo
 * Author URI:        https://larslo.de
 * License:           GPL-2.0
 * License URI:       https://opensource.org/licenses/GPL-2.0
 * Text Domain:       yours-plugin
 * Domain Path:       languages
 * GitHub Plugin URI:
 */

if (!defined('ABSPATH')) {
    die();
}

/* Requirements (checked by plugin called 01_Yours_Master_Plugin underdev-requirements */
static $requirements = array(
    'php'     => '7.2',
    // 'php_extensions'     => array( 'soap' ),
    'wp'      => '5.2',
    // underdev_requirements plugin does only check for usual plugins, so this is not working
    // 'plugins' => array(
    //     "cmb2/init.php" => array('name' => 'CMB2', 'version' => '2.6'), 
    // ),
    'theme'   => array(
        'slug' => 'yours',
        'name' => 'Yours',
    ),
);


if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

// Initialize plugin
\Yours\Plugin\Plugin::instance($requirements);
