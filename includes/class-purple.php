<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       wp_puple_bug
 * @since      1.0.0
 *
 * @package    Purple
 * @subpackage Purple/includes
 */

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
 * @package    Purple
 * @subpackage Purple/includes
 * @author     John Ricardo Porras <porrasjohnricardo530@gmail.com>
 */
class Purple {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Purple_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'PURPLE_VERSION' ) ) {
			$this->version = PURPLE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'purple';

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
	 * - Purple_Loader. Orchestrates the hooks of the plugin.
	 * - Purple_i18n. Defines internationalization functionality.
	 * - Purple_Admin. Defines all hooks for the admin area.
	 * - Purple_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-purple-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-purple-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-purple-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-purple-public.php';

		$this->loader = new Purple_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Purple_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Purple_i18n();

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

		$plugin_admin = new Purple_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_head', $plugin_admin, 'my_custom_dashboard_name' );
	 	$this->loader->add_action( 'admin_menu', $plugin_admin, 'edit_admin_menu_name' );
		// added menus
	 	$this->loader->add_action( 'admin_menu', $plugin_admin, 'client_admin_menu' );
	 	$this->loader->add_action( 'admin_menu', $plugin_admin, 'custom_dashboard_menu' );
	 	$this->loader->add_action( 'admin_menu', $plugin_admin, 'custom_email_logs' );
	 	$this->loader->add_action( 'admin_menu', $plugin_admin, 'custom_user_management' );
		 // eo added menus
	 	$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'remove_dashboard_widgets' );
	 	$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'add_dashboard_widgets' );
	    $this->loader->add_action( 'admin_head-index.php', $plugin_admin, 'my_custom_admin_head' );
	    $this->loader->add_action( 'admin_head-customize.php', $plugin_admin, 'custom_theme' );
	    

	     $this->loader->add_action( 'wp_ajax_my_user_role', $plugin_admin, 'ajax_user_role' );
	     $this->loader->add_action( 'wp_ajax_nopriv_my_user_role', $plugin_admin, 'ajax_user_role' );

	     $this->loader->add_action( 'wp_ajax_update_role', $plugin_admin, 'ajax_update_role' );
	     $this->loader->add_action( 'wp_ajax_nopriv_update_role', $plugin_admin, 'ajax_update_role' );

	     $this->loader->add_action( 'ure_show_additional_capabilities_section', $plugin_admin, 'ure_show_additional_capabilities_section' );


	     $this->loader->add_action( 'ure_bulk_grant_roles', $plugin_admin, 'ure_show_additional_capabilities_section' );

	     $this->loader->add_action( 'admin_head', $plugin_admin, 'ppb_init' );

	     $this->loader->add_action( 'admin_head', $plugin_admin, 'admin_top_bar' );


	     $this->loader->add_action( 'wp_ajax_lib_details', $plugin_admin, 'lib_details' );
	     $this->loader->add_action( 'wp_ajax_nopriv_lib_details', $plugin_admin, 'lib_details' );


	     $this->loader->add_action( 'wp_ajax_upload_media', $plugin_admin, 'upload_media' );
	     $this->loader->add_action( 'wp_ajax_nopriv_upload_media', $plugin_admin, 'upload_media' );

	    // $this->loader->add_action( 'attachment_fields_to_edit', $plugin_admin, 'be_attachment_field_credit', 10, 2  );
	     $this->loader->add_action( 'attachment_fields_to_save', $plugin_admin, 'save_custom_checkbox_attachment_field', 10, 2  );
	    

	    $this->loader->add_action( 'wp_ajax_lib_add', $plugin_admin, 'lib_add' );
	    $this->loader->add_action( 'wp_ajax_nopriv_lib_add', $plugin_admin, 'lib_add' );


	    $this->loader->add_action( 'wp_ajax_lib_view_switch', $plugin_admin, 'lib_view_switch' );
	    $this->loader->add_action( 'wp_ajax_nopriv_lib_view_switch', $plugin_admin, 'lib_view_switch' );

	    $this->loader->add_filter( 'attachment_category_row_actions', $plugin_admin, 'my_user_row_actions', 10, 2 );
	    $this->loader->add_filter( 'lib_content_type_row_actions', $plugin_admin, 'my_user_row_actions', 10, 2 );

	    $this->loader->add_action( 'wp_ajax_create_folder', $plugin_admin, 'create_folder' );
	    $this->loader->add_action( 'wp_ajax_nopriv_create_folder', $plugin_admin, 'create_folder' );

	    $this->loader->add_action( 'wp_ajax_update_lib_datails', $plugin_admin, 'update_lib_datails' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_lib_datails', $plugin_admin, 'update_lib_datails' );

	    $this->loader->add_action( 'wp_ajax_set_post_cat', $plugin_admin, 'set_post_cat' );
	    $this->loader->add_action( 'wp_ajax_nopriv_set_post_cat', $plugin_admin, 'set_post_cat' );

	    $this->loader->add_action( 'wp_ajax_article_details', $plugin_admin, 'article_details' );
	    $this->loader->add_action( 'wp_ajax_nopriv_article_details', $plugin_admin, 'article_details' );

	    $this->loader->add_action( 'wp_ajax_create_task', $plugin_admin, 'create_task' );
	    $this->loader->add_action( 'wp_ajax_nopriv_create_task', $plugin_admin, 'create_task' );

	    $this->loader->add_action( 'wp_ajax_create_task_event', $plugin_admin, 'create_task_event' );
	    $this->loader->add_action( 'wp_ajax_nopriv_create_task_event', $plugin_admin, 'create_task_event' );

	    $this->loader->add_action( 'wp_ajax_ppb_creation', $plugin_admin, 'ppb_creation' );
	    $this->loader->add_action( 'wp_ajax_nopriv_ppb_creation', $plugin_admin, 'ppb_creation' );

	    $this->loader->add_action( 'wp_ajax_get_workflow', $plugin_admin, 'get_workflow' );
	    $this->loader->add_action( 'wp_ajax_nopriv_get_workflow', $plugin_admin, 'get_workflow' );

	    $this->loader->add_action( 'wp_ajax_get_cal_range', $plugin_admin, 'get_cal_range' );
	    $this->loader->add_action( 'wp_ajax_nopriv_get_cal_range', $plugin_admin, 'get_cal_range' );

	    $this->loader->add_action( 'wp_ajax_modal_action', $plugin_admin, 'modal_action' );
	    $this->loader->add_action( 'wp_ajax_nopriv_modal_action', $plugin_admin, 'modal_action' );
	    
	    $this->loader->add_action( 'wp_ajax_my_delete', $plugin_admin, 'my_delete' );
	    $this->loader->add_action( 'wp_ajax_nopriv_my_delete', $plugin_admin, 'my_delete' );

		// comments
	    $this->loader->add_action( 'wp_ajax_update_comments', $plugin_admin, 'update_comments' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_comments', $plugin_admin, 'update_comments' );
		// progess
	    $this->loader->add_action( 'wp_ajax_update_progress', $plugin_admin, 'update_progress' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_progress', $plugin_admin, 'update_progress' );
		// edit comments
	    $this->loader->add_action( 'wp_ajax_edit_comment', $plugin_admin, 'edit_comment' );
	    $this->loader->add_action( 'wp_ajax_nopriv_edit_comment', $plugin_admin, 'edit_comment' );
	    
		// delete comments
	    $this->loader->add_action( 'wp_ajax_delete_comment', $plugin_admin, 'delete_comment' );
	    $this->loader->add_action( 'wp_ajax_nopriv_delete_comment', $plugin_admin, 'delete_comment' );
		// add new users 
	    $this->loader->add_action( 'wp_ajax_add_new_user', $plugin_admin, 'add_new_user' );
	    $this->loader->add_action( 'wp_ajax_nopriv_add_new_user', $plugin_admin, 'add_new_user' );
		// edit users 
	    $this->loader->add_action( 'wp_ajax_edit_user_data', $plugin_admin, 'edit_user_data' );
	    $this->loader->add_action( 'wp_ajax_nopriv_edit_user_data', $plugin_admin, 'edit_user_data' );
		// update user data
	    $this->loader->add_action( 'wp_ajax_update_user_data', $plugin_admin, 'update_user_data' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_user_data', $plugin_admin, 'update_user_data' );
		// delete user data
	    $this->loader->add_action( 'wp_ajax_delete_user_data', $plugin_admin, 'delete_user_data' );
	    $this->loader->add_action( 'wp_ajax_nopriv_delete_user_data', $plugin_admin, 'delete_user_data' );
		// Update sort Order
	    $this->loader->add_action( 'wp_ajax_update_sort_order', $plugin_admin, 'update_sort_order' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_sort_order', $plugin_admin, 'update_sort_order' );
		// Delete workflow Log
	    $this->loader->add_action( 'wp_ajax_delete_workflow_log', $plugin_admin, 'delete_workflow_log' );
	    $this->loader->add_action( 'wp_ajax_nopriv_delete_workflow_log', $plugin_admin, 'delete_workflow_log' );
		// Post per page
	    $this->loader->add_action( 'wp_ajax_update_post_per_table', $plugin_admin, 'update_post_per_table' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_post_per_table', $plugin_admin, 'update_post_per_table' );
		// Update created Workflow
	    $this->loader->add_action( 'wp_ajax_update_created_workflow_count', $plugin_admin, 'update_created_workflow_count' );
	    $this->loader->add_action( 'wp_ajax_nopriv_update_created_workflow_count', $plugin_admin, 'update_created_workflow_count' );
		// Update created Workflow
	    $this->loader->add_action( 'wp_ajax_library_search', $plugin_admin, 'library_search' );
	    $this->loader->add_action( 'wp_ajax_nopriv_library_search', $plugin_admin, 'library_search' );
	    


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Purple_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

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
	 * @return    Purple_Loader    Orchestrates the hooks of the plugin.
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
