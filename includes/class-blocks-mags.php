<?php
if (!defined('ABSPATH')) exit;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Blocks_Mags
 * @subpackage Blocks_Mags/includes
 */
class Blocks_Mags {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Blocks_Mags_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'BLOCKS_MAGS_VERSION' ) ) {
			$this->version = BLOCKS_MAGS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'blocks-mags';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Blocks_Mags_Loader. Orchestrates the hooks of the plugin.
	 * - Blocks_Mags_i18n. Defines internationalization functionality.
	 * - Blocks_Mags_Admin. Defines all hooks for the admin area.
	 * - Blocks_Mags_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-blocks-mags-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-blocks-mags-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-blocks-mags-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-blocks-mags-public.php';


		// Custom BLOCKS
		/**
		 * Include renderable interface
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/blocks/interface-block-mags-renderable.php';

		/**
		 * Custom Gutenberg blocks parent 
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/blocks/class-blocks-mags-block.php';
		
		/**
		 * The class responsible for defining custom block 'slider-tp1'
		 */
		require_once plugin_dir_path( dirname(__FILE__)) . 'includes/blocks/slider-tp1/class-slider-tp1.php';
		
		/**
		 * The class responsible for defining custom block 'casino-score'
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/blocks/casino-score/class-casino-score.php';
		
		/**
		 * Add custom blocks
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/blocks/class-blocks-mags-register-block.php';
		Blocks_Mags_Register_Block::addBlock(Class_Slider_Tp1::BLOCK_STRING_ID);
		Blocks_Mags_Register_Block::addBlock(Class_Casino_Score::BLOCK_STRING_ID);
		// Custom BLOCKS END


		$this->loader = new Blocks_Mags_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Blocks_Mags_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Blocks_Mags_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Blocks_Mags_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/**
		 * Alter script load tag with attribute. 
		 * Set type so js files are loaded as modules.
		 */
		add_filter('script_loader_tag', function ($tag, $handle, $src) {

			global $post;
			$qualifies_to_load_as_module = false;

			// Check if the script handle qualifies to load as module
			$qualified_handles = [
				Class_Slider_Tp1::BLOCK_STRING_ID,
				Class_Casino_Score::BLOCK_STRING_ID,
			];

			if (in_array(trim($handle), $qualified_handles)) {
				$qualifies_to_load_as_module = true;
			}

			// If script qualifies, add type:module
			if ($qualifies_to_load_as_module && is_admin()) {
				$tag = str_replace('src=', 'type="module" src=', $tag);
			}

			return $tag;
			
		}, 13, 3);

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Blocks_Mags_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action('wp', $plugin_public, 'enqueue_casino_score_styles');
		$this->loader->add_action('wp', $plugin_public, 'enqueue_casino_score_scripts');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Blocks_Mags_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
