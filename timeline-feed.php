<?php
/**
 * Plugin Name: Event Timeline Feed
 * Plugin URI: https://scriptstown.com/wordpress-plugins/timeline-feed/
 * Description: Create and showcase event timelines on your WordPress website available in multiple layouts with clean, elegant, and responsive design.
 * Version: 1.2.6
 * Author: ScriptsTown
 * Author URI: https://scriptstown.com/
 * Text Domain: timeline-feed
 * Requires at least: 5.0
 * Requires PHP: 7.0
*/

defined( 'ABSPATH' ) || die();

define( 'STTF_PLUGIN_VERSION', '1.2.6' );
define( 'STTF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'STTF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'STTF_PLUGIN_BASE', plugin_basename( __FILE__ ) );

require STTF_PLUGIN_PATH . 'vendor/autoload.php';

TimelineFeed\Core\Plugin::init();
