<?php
/**
 * Plugin Name: CanvasPop Photo Printing API
 * Plugin URI: http://developer.canvaspop.com
 * Description: CanvasPop Photo Printing API
 * Version: 1.0.1
 * Author: CanvasPop
 * Author URI: http://developer.canvaspop.com
 * License: GPL2
 */

/**
 * Plugin class.
 *
 * TODO: Rename this class to a proper name for your plugin.
 *
 * @package CanvasPop Photo Printing API
 * @author  CanvasPop <api.support@canvaspop.com>
 */
class CanvasPop_Photo_Printing_API {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.1';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'canvaspop-photo-printing-api';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );


		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );



		register_activation_hook(__FILE__, 'cp_add_defaults');
		register_uninstall_hook(__FILE__, 'cp_delete_plugin_options');
		add_action('admin_init', 'cp_init' );
		add_action('admin_menu', 'cp_add_options_page');
		add_filter( 'plugin_action_links', 'cp_plugin_action_links', 10, 2 );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide  ) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_activate();
				}
				restore_current_blog();
			} else {
				self::single_activate();
			}
		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_deactivate();
				}
				restore_current_blog();
			} else {
				self::single_deactivate();
			}
		} else {
			self::single_deactivate();
		}
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param	int	$blog_id ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {
		if ( 1 !== did_action( 'wpmu_new_blog' ) )
			return;

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();
	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return	array|false	The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {
		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";
		return $wpdb->get_col( $sql );
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		$screen = get_current_screen();
		$snail = 'toplevel_page_canvaspop-photo-printing-api/' . $this->plugin_slug;
		if ( $screen->id == $snail ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-colorpicker-styles', plugins_url( 'css/colorpicker.css', __FILE__ ), array(), self::VERSION );
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), self::VERSION );

		}


	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		$screen = get_current_screen();
		$snail = 'toplevel_page_canvaspop-photo-printing-api/' . $this->plugin_slug;

		if ( $screen->id == $snail ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-colorpicker-script', plugins_url( 'js/colorpicker.js', __FILE__ ), array( 'jquery' ), self::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		}

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );

		$access_key = get_option( 'cp_options' );
		$script_vars = array(
			'access_key' => $access_key[access_key],
			'print_button_position' => $access_key[print_button_position],
			'print_button_color' => str_replace('#', '', $access_key[print_button_color])
		);
		wp_localize_script( $this->plugin_slug . '-plugin-script', 'cp_scripts', $script_vars );
	}


	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'plugins.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *        WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
	 *        Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// TODO: Define your action hook callback here
	}

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *        WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {
		// TODO: Define your filter hook callback here
	}

}

/*
function requires_wordpress_version() {
	global $wp_version;
	$plugin = plugin_basename( __FILE__ );
	$plugin_data = get_plugin_data( __FILE__, false );

	if ( version_compare($wp_version, "3.3", "<" ) ) {
		if( is_plugin_active($plugin) ) {
			deactivate_plugins( $plugin );
			wp_die( "'".$plugin_data['Name']."' requires WordPress 3.3 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>." );
		}
	}
}
add_action( 'admin_init', 'requires_wordpress_version' );
*/
// Delete options table entries ONLY when plugin deactivated AND deleted
function cp_delete_plugin_options() {
	delete_option('cp_options');
}


// Define default option settings
function cp_add_defaults() {
	$tmp = get_option('cp_options');
    if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
		delete_option('cp_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		$arr = array(	"chk_button1" => "1",
						"chk_button3" => "1",
						"textarea_one" => "This type of control allows a large amount of information to be entered all at once. Set the 'rows' and 'cols' attributes to set the width and height.",
						"textarea_two" => "This text area control uses the TinyMCE editor to make it super easy to add formatted content.",
						"textarea_three" => "Another TinyMCE editor! It is really easy now in WordPress 3.3 to add one or more instances of the built-in WP editor.",
						"txt_one" => "Enter whatever you like here..",
						"drp_select_box" => "four",
						"chk_default_options_db" => "",
						"rdo_group_one" => "one",
						"rdo_group_two" => "two"
		);
		update_option('cp_options', $arr);
	}
}


// Init plugin options to white list our options
function cp_init(){
	register_setting( 'cp_plugin_options', 'cp_options', 'cp_validate_options' );
}


// Add menu page
function cp_add_options_page() {
	add_menu_page('CanvasPop Photo Printing API Options page', 'CanvasPop Photo Printing API', 'manage_options', __FILE__, 'cp_render_form', plugin_dir_url( __FILE__ ) . '/assets/icon.png');
}


// Render the Plugin options form
function cp_render_form() {
	?>
	<div class="api--header">
			<p>Welcome to the</p>
			<h1>CanvasPop Photo Printing API</h1>
			<h2>Time to create your very own Pop-up Store.</h2>
		</div><!-- /.api--header -->

	<div class="wrap">
		<!-- Display Plugin Icon, Header, and Description -->
		<!--<div class="icon32" id="icon-options-general"><br></div>-->
		<!--<div class="icon32"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/canvaspop-api-logo.jpg" /></div>
		<h2>CanvasPop Photo Printing API</h2>
		-->

		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('cp_plugin_options'); ?>
			<?php $options = get_option('cp_options'); ?>
			<table class="form-table">
				<!-- Textbox Control -->
				<tr>
					<th><h2>Settings</h2></th>
				</tr>
				<tr>
					<th scope="row"><strong>Access Key</strong></th>
					<td>
						<input type="text" size="57" name="cp_options[access_key]" value="<?php echo $options['access_key']; ?>" />
						<br /><span class="comment">Sign up at <a href="https://developers.canvaspop.com/" target="_blank">developers.canvaspop.com</a> to get your Access Key.</span>
					</td>
				</tr>
				<tr>
					<th scope="row"><strong>Print Button Position</strong></th>
					<td>
						<select name="cp_options[print_button_position]">
							<option value="beneath" <?php selected('beneath', $options['print_button_position']); ?>>Beneath</option>
							<option value="overlayed" <?php selected('overlayed', $options['print_button_position']); ?>>Overlayed</option>
						</select>
					</td>
				</tr>
				<th scope="row"><strong>Button Color</strong></th>
					<td>
						<input type="text" size="10" maxlength="6" name="cp_options[print_button_color]" class="colorpick small" value="<?php echo $options['print_button_color']; ?>" />
						<div class="color colorpick"></div>
					</td>
				<tr>
					<td>
						<input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" />
					</td>
				</tr>
			</table>
		</form>
		<br/>
		<table class="form-table">
			<tr>
				<td>
					<h2>How to use</h2>

					<p>Just wrap any block of images in a container with class <span class="code">.cp</span> and it will automatically add the print buttons to your images.</p>
					<h3>Example:</h3>
					<p class="code code--block">
						&lt;div class="cp"&gt;<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="http://lorempixel.com/200/200/" /&gt;<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="http://lorempixel.com/200/200/" /&gt;<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="http://lorempixel.com/200/200/" /&gt;<br/>
						&lt;/div&gt;
					</p>
					<p><br/><p>
					<p>You may also add the class <span class="code">.ignore</span> to any image you don't want to have a print button and it will automatically get skipped.</p>
					<h3>Example:</h3>
					<p class="code code--block">
						&lt;div class="cp"&gt;<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="http://lorempixel.com/200/200/" class="ignore" /&gt;<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="http://lorempixel.com/200/200/" /&gt;<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&lt;img src="http://lorempixel.com/200/200/" /&gt;<br/>
						&lt;/div&gt;
					</p>
				</td>
			</tr>
		</table>
	</div>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function cp_validate_options($input) {
	 // strip html from textboxes
	$input['textarea_one'] =  wp_filter_nohtml_kses($input['textarea_one']); // Sanitize textarea input (strip html tags, and escape characters)
	$input['access_key'] =  wp_filter_nohtml_kses($input['access_key']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input;
}

// Display a Settings link on the main Plugins page
function cp_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$cp_links = '<a href="'.get_admin_url().'admin.php?page=canvaspop-photo-printing-api/canvaspop-photo-printing-api.php">'.__('Settings').'</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $cp_links );
	}

	return $links;
}

CanvasPop_Photo_Printing_API::get_instance();
