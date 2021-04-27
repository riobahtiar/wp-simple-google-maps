<?php
/**
 * Plugin Name: WP Simple Google Maps
 * Plugin URI: https://rio.my.id
 * Description: Just a simple plugin to show Google Maps
 * Author: Rio Bahtiar
 * Author URI: https://rio.my.id
 * Text Domain: wp-simple-google-maps
 * Domain Path: /languages
 * Version: 0.0.1
 *
 * @package WPSGM
 */

defined( 'ABSPATH' ) || exit;

define( 'WPSGM__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPSGM__PLUGIN_URL', plugins_url( '/', __FILE__ ) );

require_once WPSGM__PLUGIN_DIR . 'inc/class-assets.php';
require_once WPSGM__PLUGIN_DIR . 'inc/class-plugin-settings.php';
require_once WPSGM__PLUGIN_DIR . 'inc/class-shorcode.php';
require_once WPSGM__PLUGIN_DIR . 'inc/namespace.php';


// Load Plugin
WPSGM\init();