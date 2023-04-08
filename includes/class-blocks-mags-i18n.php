<?php
if (!defined('ABSPATH')) exit;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://na.io
 * @since      1.0.0
 *
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/includes
 * @author     Mast_G
 */
class Blocks_Mags_i18n {

	/**
	 * The text domain used for translating strings in the plugin.
	 *
	 * @var string $text_domain
	 * 
	 * @since 1.0.1
	 */
	public $text_domain = 'blocks-mags';

	public function get_i18n_domain()
	{
		return $this->text_domain;
	}
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->get_i18n_domain(),
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
