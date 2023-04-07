<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://na.io
 * @since      1.0.0
 *
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/public
 */
class Blocks_Mags_Public {

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
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the slider tp1 block stylesheets,
	 * for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'css/slider-tp1/public.css', 
			array(), 
			$this->version,
			'all'
		);
	}

	/**
	 * Register the slider tp1 block scripts,
	 * for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/slider-tp1/public.js', 
			array( 'jquery' ), 
			$this->version, 
			false 
		);

	}

	/**
	 * Register the casino score block styles,
	 * for the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_casino_score_styles() {
		global $post;
		if (has_block('blocks-mags/casino-score', $post)) {
			wp_register_style(
				"public-casino-score-block",
				plugin_dir_url(__FILE__) . 'css/casino-score/public.css',
				[],
				$this->version
			);
			wp_enqueue_style("public-casino-score-block");
		}
	}

	/**
	 * Register the casino score block scripts,
	 * for the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_casino_score_scripts()
	{
		wp_register_script(
			"public-casino-score-block",
			plugin_dir_url(__FILE__) . 'js/casino-score/public.js',
			[],
			$this->version,
			true
		);
		wp_enqueue_script("public-casino-score-block");
	}
}


