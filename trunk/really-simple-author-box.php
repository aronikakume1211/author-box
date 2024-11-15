<?php

/**
 * Plugin Name: Really Simple Author Box 
 * Plugin URI: https://wordpress.org/plugins/really-simple-author-box
 * Description: Add a responsive Really Simple Author Box or guest Author. Great Really Simple Author Box for any site!.
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Version: 1.0.0
 * Author: Mebratu Kumera
 * Author URI: https://www.linkedin.com/in/mebratu-kumera-638149181/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: really-simple-author-box
 */

// Exit if accessed directly
if (! defined('ABSPATH')) exit;

// Define plugin constants
define('RSAB_DIR_PATH', __DIR__ . '/');
define('RSAB_DIR_URL', plugin_dir_url(__FILE__) . '/');
define('RSAB_IMG', 'https://1.gravatar.com/avatar/d459c0256b4417973ea8b940d7a82021?s=96&d=mm&r=g');

// Include required files
require_once RSAB_DIR_PATH . 'inc/init.php';

// Initialize the plugin
new RSAB\Init();
