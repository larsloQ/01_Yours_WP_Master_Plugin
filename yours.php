<?php
/**
 * @wordpress-plugin
 * Plugin Name:       01_Yours
 * Plugin URI:        
 * Description:       Central Plugin for LIAISON, based on https://github.com/dmhendricks/wordpress-base-plugin
 * Version:           0.5.4
 * Author:            larslo 
 * Author URI:        https://larslo.de
 * License:           GPL-2.0
 * License URI:       https://opensource.org/licenses/GPL-2.0
 * Text Domain:       yours-plugin
 * Domain Path:       languages
 * GitHub Plugin URI: 
 */

/*	Copyright 2018	  Daniel M. Hendricks (https://www.danhendricks.com/)

		This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if( !defined( 'ABSPATH' ) ) die();

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
  require( __DIR__ . '/vendor/autoload.php' );
}

// Initialize plugin
\Yours\Plugin\Plugin::instance();
