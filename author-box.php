<?php

/**
 * Plugin Name: Author Box
 * Plugin URI: https://wordpress.org/plugins/author-box/
 * Description: Add a responsive author box or guest author box. Great author box for any site!.
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Version: 1.0.0
 * Author: Mebratu Kumera
 * Author URI: https://www.linkedin.com/in/mebratu-kumera-638149181/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: custom-plugin
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

// Define plugin constants
define('GATB_DIR_PATH', __DIR__ . '/');
define('GATB_DIR_URL', plugin_dir_url(__FILE__) . '/');
define('GATB_IMG', 'https://1.gravatar.com/avatar/d459c0256b4417973ea8b940d7a82021?s=96&d=mm&r=g');

// Include required files
require_once GATB_DIR_PATH . 'inc/init.php';

// Initialize the plugin
new GATB_Init();
