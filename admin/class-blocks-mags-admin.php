<?php
if (!defined('ABSPATH')) exit;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://na.io
 * @since      1.0.0
 *
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/admin
 * @author     qwqwqw <wqwqw@12we.ss>
 */
class Blocks_Mags_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Blocks_Mags_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Blocks_Mags_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/blocks-mags-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style(
			'slider-tp1-main', 
			plugin_dir_url(__FILE__) . 'css/slider-tp1/main.css', 
			array(), 
			$this->version,
			'all'
		);


		wp_register_style(
			'casino-score',
			plugin_dir_url(__FILE__) . 'css/casino-score/casino-score-block.css',
			['wp-edit-blocks'],
			$this->version . rand(1, 2222)
		);
		wp_enqueue_style('casino-score');
        



	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script(
			'slider-tp1-main',
			plugin_dir_url(__FILE__) . 'js/slider-tp1/main.js',
			['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data'],
			$this->version,
			false
		);

		wp_register_script(
			'casino-score',
			plugin_dir_url(__FILE__) . 'js/casino-score/casino-score-block.js',
			['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data'],
			$this->version . rand(1, 2222),
			true
		);
		wp_enqueue_script('casino-score');

	}

}
