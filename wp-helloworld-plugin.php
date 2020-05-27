<?php

/**
 * The Hello World plugin bootstrap file.
 *
 * @category Plugins
 * @package  WordPress
 * @author   UpdaterCloud <support@updatercloud.com>
 * @license  GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 * @link     https://updatercloud.com
 *
 * @wordpress-plugin
 * Plugin Name: Hello World
 * Plugin URI:  https://updatercloud.com
 * Description: Hello World sample plugin for WordPress.
 * Version:     1.0.0
 * Author:      UpdaterCloud <support@updatercloud.com>
 * Author URI:  https://updatercloud.com
 * License:     GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-helloworld-plugin
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require_once plugin_dir_path(__FILE__) . 'functions.php';

/**
 * Integrate UpdaterCloud automatic updates.
 */
require_once plugin_dir_path(__FILE__) . 'wp-updatercloud/wp-updatercloud.php';

/**
 * Your UpdaterCloud update channel url.
 *
 * You may want to use different update channel urls for
 * dev and stable releases and offer an option to your customer
 * to select what channel to use for updates.
 */
$url = 'http://sandbox.updatercloud.vagrant/api/v1/update-channels/hello-world-wordpress-plugin-updates.json';

/**
 * Download key.
 *
 * In this example plugin, we`ve stored the download key
 * as an option named wp_helloworld_plugin_downloadkey
 */
$downloadKey = get_option('wp_helloworld_plugin_downloadkey');

/**
 * UpdaterCloud can gather some analytics data about customers
 * WP version, blog language, PHP version, installed plugin version, etc.
 * You must ask your customer for permission to gather and store
 * analytics data from their website. For this example,
 * we'll just set this to true, but you'll probably want to store
 * the user preference in an option.
 */
$canGatherAnalyticsData = true;

// Create new updater instance.
$updaterCloud = UpdaterCloud_v1_Factory::buildUpdateChecker(
    $url, // Your UpdaterCloud update channel url for this plugin
    __FILE__, // Full path to the main plugin file
    'wp-helloworld-plugin', // Plugin slug
    $checkPeriod = 12, // Update check frequency in hours
    $optionName = '', // Where to store book-keeping info about update checks
    $muPluginFile = '', // // Full path to the MU main plugin file
    $downloadKey, // Download key
    $canGatherAnalyticsData
);
