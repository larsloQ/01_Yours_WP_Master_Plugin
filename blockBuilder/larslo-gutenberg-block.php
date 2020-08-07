<?php
/**
 * Gutenberg block example plugin.
 *
 * @license   GPL-2.0+
 * @package t3n53
 *
 * @wordpress-plugin
 * Plugin Name: larslo Gutenberg Block Builder
 * Description: 
 * Version:     0.1.0
 * Author:      larslo
 * Author URI:  
 * License:     
 * Text Domain: larslo
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once(__DIR__."/larslo-gutenberg-block-general-settings.php");
require_once(__DIR__."/blocks/hero/hero_serverside_render.php");

/**
 * Enqueue block script and backend stylesheet.
 */
add_action( 'enqueue_block_editor_assets', function() {
	wp_enqueue_script(
		'larslo-blocks-editor-script',
		plugins_url( 'assets/js/editor.blocks.js', __FILE__ ),
		[ 'wp-blocks', 'wp-element' ]
	);


	wp_enqueue_style(
		'larslo-blocks-editor-style',
		plugins_url( 'assets/css/editor.blocks.css', __FILE__ )
	);
} );

/**
 * Enqueue styles for backend and frontend.
 */
add_action( 'enqueue_block_assets', function() {
	wp_enqueue_style(
		'larslo-blocks-frontend-style',
		plugins_url( 'assets/css/frontend.blocks.css', __FILE__ )
	);
} );
