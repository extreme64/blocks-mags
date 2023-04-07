<?php



/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://qwqwqw
 * @since             1.0.0
 * @package           Blocks_Mags
 *
 * @wordpress-plugin
 * Plugin Name:       Blocks Mags
 * Plugin URI:        https://na.io
 * Description:       This is a description of the plugin.
 * Version:           1.0.3
 * Author:            Mast_G
 * Author URI:        https://github.com/extreme64/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       blocks-mags
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'BLOCKS_MAGS_VERSION', '1.0.3' );

/** 
 * Define plugin root path constant
 */
define( 'PLUGIN_ROOT_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blocks-mags-activator.php
 */
function activate_blocks_mags() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blocks-mags-activator.php';
	Blocks_Mags_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blocks-mags-deactivator.php
 */
function deactivate_blocks_mags() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blocks-mags-deactivator.php';
	Blocks_Mags_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blocks_mags' );
register_deactivation_hook( __FILE__, 'deactivate_blocks_mags' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-blocks-mags.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blocks_mags() {

	$plugin = new Blocks_Mags();
	$plugin->run();

}
run_blocks_mags();
