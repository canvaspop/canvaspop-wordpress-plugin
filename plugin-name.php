<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that also follow
 * WordPress coding standards and PHP best practices.
 *
 * @package   CanvasPop Photo Printing API
 * @author    Ryan Johnson <ryan@canvaspop.com>
 * @license   GPL-2.0+
 * @link      http://developer.canvaspop.com
 * @copyright 2013 CanvasPop
 *
 * @wordpress-plugin
 * Plugin Name: CanvasPop Photo Printing API
 * Plugin URI:  http://developer.canvaspop.com
 * Description: CanvasPop Photo Printing API Wordpress Plugin
 * Version:     0.1
 * Author:      Ryan Johnson
 * Author URI:  
 * Text Domain: canvaspop-photo-printing-api
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// TODO: replace `class-plugin-name.php` with the name of the actual plugin's class file
require_once( plugin_dir_path( __FILE__ ) . 'canvaspop-photo-printing-api.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
// TODO: replace Plugin_Name with the name of the plugin defined in `class-plugin-name.php`
register_activation_hook( __FILE__, array( 'CanvasPop_Photo_Printing_API', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'CanvasPop_Photo_Printing_API', 'deactivate' ) );

// TODO: replace Plugin_Name with the name of the plugin defined in `class-plugin-name.php`
add_action( 'plugins_loaded', array( 'CanvasPop_Photo_Printing_API', 'get_instance' ) );
