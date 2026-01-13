<?php

/**
 * Plugin Name: Add to Calender
 * Description: This plugin handles add to calender tasks for the WordPress.
 * Version: 1.1.0
 * Author: Sudipto Shakhari
 * Author URI: https://profiles.wordpress.org/shakhari/
 * Text Domain: add-to-calender
 * Requires at least: 6.2
 * Requires PHP: 7.4
 */

defined('ABSPATH') || exit;

class Add_to_calender
{
	/**
	 * This plugin's instance
	 *
	 * @var Add_to_calender The one true Add_to_calender
	 * @since 1.0
	 */
	private static $instance;
	/**
	 * Add to Calender version.	
	 *
	 * @var string
	 * @since 1.0.0
	 */
	public $version = '1.1.0';

	/**
	 * Add_to_calender constructor.
	 */
	private function __construct()
	{
		$this->define_constants();
		register_activation_hook(__FILE__, array($this, 'activate_plugin'));
		register_deactivation_hook(__FILE__, array($this, 'deactivate_plugin'));

		add_action('plugins_loaded', array($this, 'init_plugin'));
	}

	/**
	 * Define all constants
	 * @return void
	 * @since 1.0.0
	 */
	public function define_constants()
	{
		$this->define('ADD_TO_CALENDER_VERSION', $this->version);
		$this->define('ADD_TO_CALENDER_FILE', __FILE__);
		$this->define('ADD_TO_CALENDER_DIR', dirname(__FILE__));
		$this->define('ADD_TO_CALENDER_INC_DIR', dirname(__FILE__) . '/includes');
	}

	/**
	 * Define constant if not already defined
	 *
	 * @param string $name
	 * @param string|bool $value
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	private function define($name, $value)
	{
		if (! defined($name)) {
			define($name, $value);
		}
	}

	/**
	 * Main Add_to_calender Instance
	 *
	 * Ensures that only one instance of Add_to_calender exists in memory at any one time.
	 *
	 * @return Add_to_calender The one true Add_to_calender
	 * @since 1.0.0
	 */
	public static function init()
	{
		if (! isset(self::$instance) && ! (self::$instance instanceof Add_to_calender)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Register activation hook
	 */
	public function activate_plugin() {}

	/**
	 * Register deactivation hook.
	 */
	public function deactivate_plugin() {}

	/**
	 * Return plugin version.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_version()
	{
		return $this->version;
	}

	/**
	 * Plugin URL getter.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function plugin_url()
	{
		return untrailingslashit(plugins_url('/', __FILE__));
	}

	/**
	 * Plugin path getter.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function plugin_path()
	{
		return untrailingslashit(plugin_dir_path(__FILE__));
	}

	/**
	 * Plugin base path name getter.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function plugin_basename()
	{
		return plugin_basename(__FILE__);
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	public function localization_setup()
	{
		load_plugin_textdomain('add-to-calender', false, plugin_basename(dirname(__FILE__)) . '/i18n/languages');
	}

	/**
	 * Throw error on object clone
	 */
	public function __clone()
	{
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'add-to-calender'), '1.0.0');
	}

	/**
	 * Disable unserializing of the class
	 */
	public function __wakeup()
	{
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'add-to-calender'), '1.0.0');
	}

	/**
	 * Load the plugin.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function init_plugin()
	{
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Include required core files.
	 * @since 1.0.0
	 */
	public function includes()
	{
		// Include necessary files here.
		require_once __DIR__ . '/inc/shortcodes.php';
		do_action('add_to_calender_loaded');
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks()
	{
		add_action('plugins_loaded', array($this, 'localization_setup'));
		add_action('wp_enqueue_scripts', array($this, 'plugin_scripts'));
		add_action('elementor/widgets/register', array($this, 'register_elementor_widgets'));
	}

	public function plugin_scripts()
	{
		wp_enqueue_script('add-to-calender-scripts', '//cdn.jsdelivr.net/npm/add-to-calendar-button@2', array(), $this->version, array('in_footer' => true));
	}

	public function register_elementor_widgets($widgets_manager)
	{
		require_once __DIR__ . '/inc/elementor/class-add-to-calender-widget.php';

		$widgets_manager->register_widget_type(new \DWM_Add_To_Calendar_Widget());
	}
}

/**
 * The main function responsible for returning the one true Add to Calender instance.
 *
 * @return Add_to_calender
 * @since 1.0.0
 */
function Add_to_calender()
{
	return Add_to_calender::init();
}

Add_to_calender();
