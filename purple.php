<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              wp_puple_bug
 * @since             1.0.0
 * @package           Purple
 *
 * @wordpress-plugin
 * Plugin Name:       Purple Bug Admin Template
 * Plugin URI:        wp_puple_bug
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            John Ricardo Porras
 * Author URI:        wp_puple_bug
 * License:           GPL-2.0+
 * Text Domain:       purple
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PURPLE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-purple-activator.php
 */
function activate_purple() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-purple-activator.php';
	Purple_Activator::activate();

	
}

function pluginprefix_activate(){
	//$unserialize = unserialize('a:7:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:73:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:12:"create_posts";b:1;s:17:"install_languages";b:1;s:14:"resume_plugins";b:1;s:13:"resume_themes";b:1;s:23:"view_site_health_checks";b:1;s:14:"ure_edit_roles";b:1;s:16:"ure_create_roles";b:1;s:16:"ure_delete_roles";b:1;s:23:"ure_create_capabilities";b:1;s:23:"ure_delete_capabilities";b:1;s:18:"ure_manage_options";b:1;s:15:"ure_reset_roles";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}s:12:"client-admin";a:2:{s:4:"name";s:12:"Client Admin";s:12:"capabilities";a:46:{s:12:"create_posts";b:1;s:12:"create_users";b:1;s:19:"delete_others_posts";b:1;s:12:"delete_posts";b:1;s:20:"delete_private_posts";b:1;s:22:"delete_published_posts";b:1;s:12:"delete_users";b:1;s:14:"edit_dashboard";b:1;s:10:"edit_files";b:1;s:17:"edit_others_posts";b:1;s:10:"edit_posts";b:1;s:18:"edit_private_posts";b:1;s:20:"edit_published_posts";b:1;s:10:"edit_users";b:1;s:6:"export";b:1;s:6:"import";b:1;s:7:"level_0";b:1;s:7:"level_1";b:1;s:8:"level_10";b:1;s:7:"level_2";b:1;s:7:"level_3";b:1;s:7:"level_4";b:1;s:7:"level_5";b:1;s:7:"level_6";b:1;s:7:"level_7";b:1;s:7:"level_8";b:1;s:7:"level_9";b:1;s:10:"list_users";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:13:"promote_users";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:18:"read_private_posts";b:1;s:12:"remove_users";b:1;s:15:"unfiltered_html";b:1;s:17:"unfiltered_upload";b:1;s:12:"upload_files";b:1;s:23:"ure_create_capabilities";b:1;s:16:"ure_create_roles";b:1;s:23:"ure_delete_capabilities";b:1;s:16:"ure_delete_roles";b:1;s:14:"ure_edit_roles";b:1;s:18:"ure_manage_options";b:1;}}s:9:"marketing";a:2:{s:4:"name";s:9:"Marketing";s:12:"capabilities";a:34:{s:19:"delete_others_pages";b:1;s:19:"delete_others_posts";b:1;s:12:"delete_pages";b:1;s:12:"delete_posts";b:1;s:20:"delete_private_pages";b:1;s:20:"delete_private_posts";b:1;s:22:"delete_published_pages";b:1;s:22:"delete_published_posts";b:1;s:17:"edit_others_pages";b:1;s:17:"edit_others_posts";b:1;s:10:"edit_pages";b:1;s:10:"edit_posts";b:1;s:18:"edit_private_pages";b:1;s:18:"edit_private_posts";b:1;s:20:"edit_published_pages";b:1;s:20:"edit_published_posts";b:1;s:7:"level_0";b:1;s:7:"level_1";b:1;s:7:"level_2";b:1;s:7:"level_3";b:1;s:7:"level_4";b:1;s:7:"level_5";b:1;s:7:"level_6";b:1;s:7:"level_7";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:17:"moderate_comments";b:1;s:13:"publish_pages";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:18:"read_private_pages";b:1;s:18:"read_private_posts";b:1;s:15:"unfiltered_html";b:1;s:12:"upload_files";b:1;}}}');
	
	
	$arr = array(       
       
            'administrator' => array(
            'name' => 'Administrator',
            'capabilities' => array(
                    'switch_themes' => 1,
                    'edit_themes' => 1,
                    'activate_plugins' => 1,
                    'edit_plugins' => 1,
                    'edit_users' => 1,
                    'edit_files' => 1,
                    'manage_options' => 1,
                    'moderate_comments' => 1,
                    'manage_categories' => 1,
                    'manage_links' => 1,
                    'upload_files' => 1,
                    'import' => 1,
                    'unfiltered_html' => 1,
                    'edit_posts' => 1,
                    'edit_others_posts' => 1,
                    'edit_published_posts' => 1,
                    'publish_posts' => 1,
                    'edit_pages' => 1,
                    'read' => 1,
                    'level_1,0' => 1,
                    'level_9' => 1,
                    'level_8' => 1,
                    'level_7' => 1,
                    'level_6' => 1,
                    'level_5' => 1,
                    'level_4' => 1,
                    'level_3' => 1,
                    'level_2' => 1,
                    'level_1,' => 1,
                    'level_0' => 1,
                    'edit_others_pages' => 1,
                    'edit_published_pages' => 1,
                    'publish_pages' => 1,
                    'delete_pages' => 1,
                    'delete_others_pages' => 1,
                    'delete_published_pages' => 1,
                    'delete_posts' => 1,
                    'delete_others_posts' => 1,
                    'delete_published_posts' => 1,
                    'delete_private_posts' => 1,
                    'edit_private_posts' => 1,
                    'read_private_posts' => 1,
                    'delete_private_pages' => 1,
                    'edit_private_pages' => 1,
                    'read_private_pages' => 1,
                    'delete_users' => 1,
                    'create_users' => 1,
                    'unfiltered_upload' => 1,
                    'edit_dashboard' => 1,
                    'update_plugins' => 1,
                    'delete_plugins' => 1,
                    'install_plugins' => 1,
                    'update_themes' => 1,
                    'install_themes' => 1,
                    'update_core' => 1,
                    'list_users' => 1,
                    'remove_users' => 1,
                    'promote_users' => 1,
                    'edit_theme_options' => 1,
                    'delete_themes' => 1,
                    'export' => 1,
                    'create_posts' => 1,
                    'install_languages' => 1,
                    'resume_plugins' => 1,
                    'resume_themes' => 1,
                    'view_site_health_checks' => 1,
                    'ure_edit_roles' => 1,
                    'ure_create_roles' => 1,
                    'ure_delete_roles' => 1,
                    'ure_create_capabilities' => 1,
                    'ure_delete_capabilities' => 1,
                    'ure_manage_options' => 1,
                    'ure_reset_roles' => 1,
                )

              )
       ,
            'IT' => array(
            'name' => 'Super User (IT)',
            'capabilities' => array(
                    'edit_users' => 1,
                    'edit_files' => 1,
                    'manage_options' => 1,
                    'moderate_comments' => 1,
                    'manage_categories' => 1,
                    'manage_links' => 1,
                    'upload_files' => 1,
                    'unfiltered_html' => 1,
                    'edit_posts' => 1,
                    'edit_others_posts' => 1,
                    'edit_published_posts' => 1,
                    'publish_posts' => 1,
                    'edit_pages' => 1,
                    'read' => 1,
                    'level_1,0' => 1,
                    'level_9' => 1,
                    'level_8' => 1,
                    'level_7' => 1,
                    'level_6' => 1,
                    'level_5' => 1,
                    'level_4' => 1,
                    'level_3' => 1,
                    'level_2' => 1,
                    'level_1,' => 1,
                    'level_0' => 1,
                    'edit_others_pages' => 1,
                    'edit_published_pages' => 1,
                    'publish_pages' => 1,
                    'delete_pages' => 1,
                    'delete_others_pages' => 1,
                    'delete_published_pages' => 1,
                    'delete_posts' => 1,
                    'delete_others_posts' => 1,
                    'delete_published_posts' => 1,
                    'delete_private_posts' => 1,
                    'edit_private_posts' => 1,
                    'read_private_posts' => 1,
                    'delete_private_pages' => 1,
                    'edit_private_pages' => 1,
                    'read_private_pages' => 1,
                    'delete_users' => 1,
                    'create_users' => 1,
                    'unfiltered_upload' => 1,
                    'edit_dashboard' => 1,
                    'list_users' => 1,
                    'remove_users' => 1,
                    'promote_users' => 1,
                    'export' => 1,
                    'create_posts' => 1,
                    'view_site_health_checks' => 1,
                    'ure_edit_roles' => 1,
                    'ure_manage_options' => 1,
                    'ure_reset_roles' => 1,
                )

              )
       ,
           'editor' => array(
                'name' => 'Editor',
                'capabilities' => array
                    (
                        
              
                    'manage_options' => 1,
                    'moderate_comments' => 1,
                    'manage_categories' => 1,
                    'manage_links' => 1,
                    'upload_files' => 1,
                    'unfiltered_html' => 1,
                    'edit_posts' => 1,
                    'edit_others_posts' => 1,
                    'edit_published_posts' => 1,
                    'publish_posts' => 1,
                    'edit_published_pages' => 1,
                    'edit_private_posts' => 1,
                    'read_private_posts' => 1,
                    'delete_private_pages' => 1,
                    'edit_private_pages' => 1,
                    'read_private_pages' => 1,
                    'publish_pages' => 1,
                    'edit_others_pages' => 1,
                    'edit_pages' => 1,
                    
                    'read' => 1,
                    'level_1,0' => 1,
                    'level_9' => 1,
                    'level_8' => 1,
                    'level_7' => 1,
                    'level_6' => 1,
                    'level_5' => 1,
                    'level_4' => 1,
                    'level_3' => 1,
                    'level_2' => 1,
                    'level_1,' => 1,
                
                    'delete_posts' => 1,
                    'delete_published_posts' => 1,
                    'delete_private_posts' => 1,
                    'edit_private_posts' => 1,
                    'read_private_posts' => 1,
                    
                    'unfiltered_upload' => 1,
                    'edit_dashboard' => 1,
                   
                    'create_posts' => 1,
                    'view_site_health_checks' => 1,
                    'ure_manage_options' => 1,
                 
                    )
    
            ) 
       ,
            'author' => array(
                    'name' => 'Author',
                    'capabilities' => array
                        (
                            'manage_options' => 1,
                    'moderate_comments' => 1,
                     
                    'manage_links' => 1,
                    'upload_files' => 1,
                    'unfiltered_html' => 1,
                    'edit_posts' => 1,
                  
                    'edit_published_posts' => 1,
                    'publish_posts' => 1,
                    'edit_published_pages' => 1,
                    'edit_private_posts' => 1,
                    'read_private_posts' => 1,
                    'delete_private_pages' => 1,
                    'edit_private_pages' => 1,
                    'read_private_pages' => 1,
                    'publish_pages' => 1,
                    'edit_others_pages' => 1,
                    'edit_pages' => 1,
                    
                    'read' => 1,
                    'level_1,0' => 1,
                    'level_9' => 1,
                    'level_8' => 1,
                    'level_7' => 1,
                    'level_6' => 1,
                    'level_5' => 1,
                    'level_4' => 1,
                    'level_3' => 1,
                    'level_2' => 1,
                    'level_1,' => 1,
                
                    'delete_posts' => 1,
                    'delete_published_posts' => 1,
                    'delete_private_posts' => 1,
                    'edit_private_posts' => 1,
                    'read_private_posts' => 1,
                    
                    'unfiltered_upload' => 1,
                    'edit_dashboard' => 1,
                   
                    'create_posts' => 1,
                    'view_site_health_checks' => 1,
                    'ure_manage_options' => 1,
                        )
        
                )
        ,
            'client-admin' => array(
                    'name' => 'Client Admin',
                    'capabilities' => array
                        (
                            'create_posts' => 1,
                            'create_users' => 1,
                            'delete_others_posts' => 1,
                            'delete_posts' => 1,
                            'delete_private_posts' => 1,
                            'delete_published_posts' => 1,
                            'delete_users' => 1,
                            'edit_dashboard' => 1,
                            'edit_files' => 1,
                            'edit_others_posts' => 1,
                            'edit_posts' => 1,
                            'edit_private_posts' => 1,
                            'edit_published_posts' => 1,
                            'edit_users' => 1,
                            'export' => 1,
                            'import' => 1,
                            'level_0' => 1,
                            'level_1,' => 1,
                            'level_1,0' => 1,
                            'level_2' => 1,
                            'level_3' => 1,
                            'level_4' => 1,
                            'level_5' => 1,
                            'level_6' => 1,
                            'level_7' => 1,
                            'level_8' => 1,
                            'level_9' => 1,
                            'list_users' => 1,
                            'manage_categories' => 1,
                            'manage_links' => 1,
                            'manage_options' => 1,
                            'moderate_comments' => 1,
                            'promote_users' => 1,
                            'publish_posts' => 1,
                            'read' => 1,
                            'read_private_posts' => 1,
                            'remove_users' => 1,
                            'unfiltered_html' => 1,
                            'unfiltered_upload' => 1,
                            'upload_files' => 1,
                            'ure_create_capabilities' => 1,
                            'ure_create_roles' => 1,
                            'ure_delete_capabilities' => 1,
                            'ure_delete_roles' => 1,
                            'ure_edit_roles' => 1,
                            'ure_manage_options' => 1,
                        )
        
                )
        

        );
	
	update_option('wp_user_roles',$arr);


	update_option('library_content','grid');
}

function create_post_type(){

	
	
}





/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-purple-deactivator.php
 */
function deactivate_purple() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-purple-deactivator.php';
	Purple_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_purple' );
register_deactivation_hook( __FILE__, 'deactivate_purple' );
register_activation_hook( __FILE__, 'pluginprefix_activate' );

register_activation_hook( __FILE__, 'create_post_type' );
 

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-purple.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_purple() {

	$plugin = new Purple();
	$plugin->run();

}
run_purple();



// Register Custom Post Type
function library_post_type() {

	$labels = array(
		'name'                  => _x( 'Article', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Article', 'text_domain' ),
		'name_admin_bar'        => __( 'Article', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Article', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New Article ', 'text_domain' ),
		'new_item'              => __( 'New Article ', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Article', 'text_domain' ),
		'view_item'             => __( 'View Article', 'text_domain' ),
		'view_items'            => __( 'View Article', 'text_domain' ),
		'search_items'          => __( 'Search Article', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Article', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title','editor', 'author', 'thumbnail', 'excerpt','comments'),
		'taxonomies'            => array( 'category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 8,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rest_base'             => 'article',
 
		'menu_icon'           => 'dashicons-media-document',
	);
	register_post_type( 'article', $args );

}
add_action( 'init', 'library_post_type', 10 );

if ( ! function_exists('event_task') ) {

// Register Custom Post Type
function event_task() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Events', 'text_domain' ),
		'name_admin_bar'        => __( 'Event', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Event', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'attachment_category','campaign' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => false,
		'menu_position'         => 5,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'event-task', $args );


	$labels = array(
		'name'                  => _x( 'Workflows', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Workflow', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Workflow', 'text_domain' ),
		'name_admin_bar'        => __( 'Workflow', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New Workflow', 'text_domain' ),
		'new_item'              => __( 'New Item Workflow', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Workflow', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => true,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => false,
		'menu_position'         => 10,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'workflow', $args );

	
	 

}
add_action( 'init', 'event_task', 0 );

}

 

 

 

// Register Custom Taxonomy
function campaign_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Campaigns', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Campaign', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Campaign', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Campaign:', 'text_domain' ),
		'new_item_name'              => __( 'New Campaign Name', 'text_domain' ),
		'add_new_item'               => __( 'Add Campaign Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Campaign', 'text_domain' ),
		'view_item'                  => __( 'View Campaign', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'campaign', array( 'event-task' ), $args );

}
add_action( 'init', 'campaign_taxonomy', 0 );


// Register Custom Taxonomy
function libary_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Folders', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Folder', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Folder', 'text_domain' ),
		'all_items'                  => __( 'Folders', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New folder', 'text_domain' ),
		'add_new_item'               => __( 'Add folder', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'attachment_category', array( 'attachment' ), $args );

}
add_action( 'init', 'libary_taxonomy', 0 );

function remove_footer_admin () 
{
    echo '<span id="footer-thankyou" ><span style=" padding-right: 10px;">Developed by </span><a href="https://purplebug.net/" target="_blank"><img width="100px" src="'.plugin_dir_url( __FILE__ ).'admin/partials/images/purplebug-logo.svg'.'"></a></span>';

 
}


add_action('admin_head',function(){
	//ec

	global $wp_query;
	if(isset($_GET['post_type']) || isset($_GET['taxonomy'])){
	    if($_GET['post_type']  == 'workflow' || $_GET['taxonomy'] == 'campaign'){
	        ?>
	            <style>
	                span.view {
                        display: none;
                    }
	            </style>
	        <?php 
	    }
	}
	//echo get_post_type($wp_query->post->ID).'Hello Woeld';
    if( 'article' == get_post_type($_GET['post'])) {
		?>
			<style>
				.load-more-wrapper, .attachments-browser .media-toolbar, button#menu-item-browse {
					display:block !important;
				}
				.wp-admin .attachments-wrapper li.attachment {
					display:block !important;
				}
				.wp-admin .attachments-browser .wp-admin .uploader-inline, .wp-admin .attachments-browser.has-load-more .attachments-wrapper, .wp-admin .attachments-browser:not(.has-load-more) .attachments{
					top: 75px !important;
				}
				 
				.media-toolbar {
				     background:transparent !important;
				}
		 		
				tr.compat-field-lib_content_type,
			 	tr.compat-field-attachment_category {
				    display: none;
				}
				.attachments-browser .media-toolbar{
					right: 490px !important;
				}
			</style>

		<?php 
		     
		 
	}
 
    			

		    $wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		    $current = array_keys($wp_capabilities);
		     if($current[0]!='administrator'){
		?>	
			<style>
			    
			    li#menu-appearance ,
                li.administrator ,
                div#screen-meta,
                .notice.notice-error,
                .error {
                    display: none;
                }
			</style>
		<?php } 
	if( 'event-task' == get_post_type($_GET['post'])) { 
	    ?>
	        <style>
	        div#edit-slug-box,
            a.page-title-action,h1.wp-heading-inline {
                display: none !important;
            }
            </style>
	    <?php 
	}
	?>
	
	<script>var plugin_url = '<?php echo plugins_url()?>';</script>

	<?php 
}); 
 

add_action( 'do_meta_boxes', 'wpdocs_remove_plugin_metaboxes' );
 
function wpdocs_remove_plugin_metaboxes(){
   $user = wp_get_current_user();
   
   
   $allowed_roles = array('administrator');
   if( array_intersect($allowed_roles, $user->roles ) ) return;
   
   remove_meta_box( 'astra_settings_meta_box', 'article', 'side' ); // Remove Edit Flow Editorial Metadata
}

add_action('pre_user_query','yoursite_pre_user_query');
function yoursite_pre_user_query($user_search) {
global $current_user;
  $username = $current_user->user_login;
    if( $current_user->roles[0] == 'administrator') return;
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'admin'",$user_search->query_where);
 
}


function custom_add_user_id_column($columns) {
    unset( $columns['posts'] );
    $columns['user_id'] = 'Articles';
    
    return $columns;
}
add_filter('manage_users_columns', 'custom_add_user_id_column');
//Adds Content To The Custom Added Column
function custom_show_user_id_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    
    
    if ( 'user_id' == $column_name ) 
        return '<a href="edit.php?author='.$user_id.'&post_type=article" class="edit"><span aria-hidden="true">'.count( get_posts( array( 
            'post_type' => 'article', 
            'author'    => $user_id, 
            'nopaging'  => true, // display all posts
        ) ) ).'</span></a>';
    
        
    //return $value;
}
add_filter('manage_users_custom_column',  'custom_show_user_id_column_content', 10, 3);


function remove_dashboard_meta() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
}
add_action('admin_init', 'remove_dashboard_meta');



function rudr_mailchimp_curl_connect( $url, $request_type, $api_key, $data = array() ) {
	if( $request_type == 'GET' )
		$url .= '?' . http_build_query($data);
	
	$mch = curl_init();
	$headers = array(
		'Content-Type: application/json',
		'Authorization: Basic '.base64_encode( 'user:'. $api_key )
	);
	curl_setopt($mch, CURLOPT_URL, $url );
	curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
	//curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
	curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
	curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
	curl_setopt($mch, CURLOPT_TIMEOUT, 10);
	curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
	
	if( $request_type != 'GET' ) {
		curl_setopt($mch, CURLOPT_POST, true);
		curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
	}
 
	return curl_exec($mch);
}
 

// add_action('wp_head',function(){
    
 
 
 
//     $email = 'porrasjohnricardo530@gmail.com';
//     $status = 'subscribed'; // "subscribed" or "unsubscribed" or "cleaned" or "pending"
//     $list_id = 'f79596a756'; // where to get it read above
//     $api_key = '88d55255a904443bf9c64d39fd89bce4-us20'; // where to get it read above
//     $merge_fields = array('FNAME' => 'Misha','LNAME' => 'Rudrastyh');
     
//    // $data = rudr_mailchimp_subscriber_status($email, $status, $list_id, $api_key, $merge_fields );
     
//     // Query String Perameters are here
//     // for more reference please vizit http://developer.mailchimp.com/documentation/mailchimp/reference/lists/
  
//     $data = array(
// 	'list_id' => 'f79596a756','count'=>'999',	'email' => 'porrasjohnricardo530@gmail.com'
//     );
//     $url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/campaigns/';
//     $result = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key, $data) );

//     //print_r($result);

//     if( !empty($result->lists) ) {
//     	echo '';
//     	foreach( $result->lists as $list ){
//     		echo '' . $list->name . ' (' . $list->stats->member_count . ')';
//     		// you can also use $list->date_created, $list->stats->unsubscribe_count, $list->stats->cleaned_count or vizit MailChimp API Reference for more parameters (link is above)
//     	}
//     	echo '';
//     } elseif ( is_int( $result->status ) ) { // full error glossary is here http://developer.mailchimp.com/documentation/mailchimp/guides/error-glossary/
//     	echo '' . $result->title . ': ' . $result->detail;
//     }
 
// });


function jba_disable_editor_fullscreen_by_default() {
    $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
    wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'jba_disable_editor_fullscreen_by_default' );

function create_workflow_logs(){
    $labels = array(
        'name' => _x( 'Email Logs', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Workflow Log', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => _x( 'Email Logs', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar' => _x( 'Workflow Log', 'Add New on Toolbar', 'textdomain' ),
        'archives' => __( 'Workflow Log Archives', 'textdomain' ),
        'attributes' => __( 'Workflow Log Attributes', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Workflow Log:', 'textdomain' ),
        'all_items' => __( 'Email Logs', 'textdomain' ),
        'add_new_item' => __( 'Add New Workflow Log', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Workflow Log', 'textdomain' ),
        'edit_item' => __( 'Edit Workflow Log', 'textdomain' ),
        'update_item' => __( 'Update Workflow Log', 'textdomain' ),
        'view_item' => __( 'View Workflow Log', 'textdomain' ),
        'view_items' => __( 'View Email Logs', 'textdomain' ),
        'search_items' => __( 'Search Workflow Log', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
        'featured_image' => __( 'Featured Image', 'textdomain' ),
        'set_featured_image' => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item' => __( 'Insert into Workflow Log', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Workflow Log', 'textdomain' ),
        'items_list' => __( 'Email Logs list', 'textdomain' ),
        'items_list_navigation' => __( 'Email Logs list navigation', 'textdomain' ),
        'filter_items_list' => __( 'Filter Email Logs list', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Workflow Log', 'textdomain' ),
        'description' => __( 'Notify users when workflow is done', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array(),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => 'do_not_allow'
        ),
        'map_meta_cap' => false, 
    );
    register_post_type( 'workflowlog', $args );
}
add_action('init','create_workflow_logs',10);


// Modify Email Logs header
function modify_workflow_logs_header($defaults){
    $defaults['employee'] = 'Employee';
    $defaults['workflow_title'] = 'Workflow Title';
    $defaults['date_emailed'] = 'Date';
    $defaults['status'] = 'Status';
    unset($defaults['title']);
    unset($defaults['date']);
    return $defaults;
}
add_action('manage_workflowlog_posts_columns','modify_workflow_logs_header');

// Modify Email Logs header Content
function modify_workflow_logs_columns($column_name, $post_ID){
    $post_data = get_post($post_ID);

    if($column_name == 'employee'){
        echo get_post_meta($post_ID,'employee_name',true);
    }
    if($column_name == 'workflow_title'){
        echo $post_data->post_title;
    }
    if($column_name == 'date_emailed'){
        echo $post_data->post_date_gmt;
    }
    if($column_name == 'status'){
        if($post_data->post_status == 'publish'){
            echo 'Sent';
        }
        else{
            echo 'Failed'; 
        }
    }

}
add_action('manage_workflowlog_posts_custom_column','modify_workflow_logs_columns',10,2);

//function track user login
function track_users_login($login_user,$user) {
    update_user_meta($user->ID,'is_current_login', 1);
}
add_action('wp_login','track_users_login',10,2);
//function track user last login
function track_users_logout($user_id){
    update_user_meta($user_id,'last_login_dnt', current_time('y-m-d h:i:s'));
    update_user_meta($user_id,'is_current_login', 0);
}
add_action('wp_logout','track_users_logout');

// redirect dashboard to custom dashboard
add_filter( 'login_redirect', function ( $redirect_to, $requested_redirect_to, $user ) {
    return $redirect_to = esc_url( '/wp-admin/admin.php?page=index' );
  }, 10, 3 );


  /**
   * Add meta box to Article Post type
   */
  function article_custom_meta_box(){
    add_meta_box(
        'article_attachment',
        'Attachment',
        'article_attachment_callback',
        'article',
        'advanced',
        'default'
    );
    add_meta_box(
        'Workflows',
        'Workflow',
        'workflow_callback',
        'workflow',
        'advanced',
        'default'
    );
    add_meta_box(
        'Feature Image',
        'Feature Images',
        'feature_images_callback',
        'article',
        'side',
        'default'
    );
  }
  add_action('admin_init','article_custom_meta_box');
  function feature_images_callback(){
    global $post;
    $image_id = get_post_meta($post->ID,'upload_image')[0];
    $image_gallery = unserialize($image_id);
    $output = '';
    $output .= '<div class="feature_gallery_container" id="feature_gallery_container">';
    if(!empty($image_gallery)):
        foreach($image_gallery as $image){
            $output .= '<div class="img-gallery-group"><input type="hidden" name="image_gallery[]" value="'.$image.'"><i class="fas fa-times-circle remove-img-gallery"></i><img src="'.wp_get_attachment_image_src($image)[0].'" ></div>';
        }
    endif;
    $output .= '</div>';
    // $output .= '<div class="feature_gallery_container"></div>';
    $output .= '<a href="#" class="misha-upl button button-primary">Add to gallery</a>
    <a href="#" class="misha-rmv button button-primary" style="display:none">Remove image</a>
    <input type="hidden" name="feature_images_gallery" value="">';
    echo $output;

  }
  //save feature images
  add_action('save_post_article','save_feature_images',9);
  function save_feature_images(){
    global $post;
    $image_id = get_post_meta($post->ID,'upload_image')[0];
    $image_ids = unserialize($image_id);
    $uploaded_images = $_POST['image_gallery'];
    $image_gallery = [];
    if(!empty($image_id)){
        foreach($uploaded_images as $single_image){
            if(!in_array($single_image, $image_gallery)){
                $image_gallery[] =  $single_image;
            }
        }

    }

    update_post_meta($post->ID,'upload_image',serialize($image_gallery));
  }
  function workflow_callback(){
    global $post;
  
    $created_workflow_count = get_post_meta($post->ID,'created_workflows')[0];
    $created_workflow_count = ($created_workflow_count == 0) ? 0: $created_workflow_count;
    // titles
    $workflow_titles = get_post_meta($post->ID,'workflow_titles')[0];
    $workflow_titles = unserialize($workflow_titles);
    // Descritpions
    $workflow_descriptions = get_post_meta($post->ID,'workflow_descriptions')[0];
    $workflow_descriptions = unserialize($workflow_descriptions);
    // List workflows
    
    $output = '';
    $output .= '<div class="workflow-loop">';
    $output .= '<i class="fa fa-plus-circle add-dynamic-workflow" aria-hidden="true" data-id="'.$post->ID.'" workflow-count=""></i>';
    if($created_workflow_count != 0){
    foreach($workflow_titles as $key => $workflow_title){
        $checklist_name = 'checklists'.$key;
        $db_checklists = unserialize(get_post_meta($post->ID,$checklist_name)[0]);
        
        $output .= '<div class="workflow-container" id="'.$key.'">';
        $output .= '<i class="fa fa-minus-circle remove-dynamic-workflow" aria-hidden="true" data-id="'.$key.'" workflow-count=""></i>';
        $output .= '<input type="hidden" name="workflow-count[]" value="1">';
            $output .= '<div class="workflow-group">';
                $output .= '<div class="workflow-title-column">Workflow Title</div>';
                $output .= "<div class='input-column'><input name='workflow_title[]' type='text' placeholder='Workflow Title' value='$workflow_title'></div>";
            $output .= '</div>';
            $output .= '<div class="workflow-group">';
                $output .= '<div class="workflow-title-column">Workflow Description</div>';
                $output .= '<div class="input-column"><textarea  name="workflow_description[]" class="tiny-mce-editor" rows="5">'.$workflow_descriptions[$key].'</textarea></div>';
            $output .= '</div>';
            $output .= '<div class="workflow-group">';
                $output .= '<div class="workflow-title-column">Workflow Checklist<i class="fa fa-plus-circle add-checklist" aria-hidden="true" data-key="'.$key.'"></i></label></div>';
                $output .= '<div class="input-column">';
                    $wf_name = 'workflow_checklists'.$key;
                    $output .= '<div class="workflow-checklist '.$wf_name.'">';
                    if(!empty($db_checklists)):
                        foreach($db_checklists as $checklist){
                            $checklists =  'checklists'.$key.'[]';
                            $output .= "<i class='fa fa-minus-circle remove-wf-checklist' aria-hidden='true' ></i><input type='text' name='$checklists' placeholder='Checklist Title' class='worflow-inputs-checklist' value='$checklist'>";
                        }
                    endif;
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
    }else{ 
        $output .= '<div class="workflow-container" id="">';
        // $output .= '<i class="fa fa-minus-circle remove-dynamic-workflow" aria-hidden="true" data-id="" workflow-count=""></i>';
        $output .= '<input type="hidden" name="workflow-count[]" value="1">';
            $output .= '<div class="workflow-group">';
                $output .= '<div class="workflow-title-column">Workflow Title</div>';
                $output .= "<div class='input-column'><input name='workflow_title[]' type='text' placeholder='Workflow Title' value=''></div>";
            $output .= '</div>';
            $output .= '<div class="workflow-group">';
                $output .= '<div class="workflow-title-column">Workflow Description</div>';
                $output .= '<div class="input-column"><textarea  name="workflow_description[]" class="tiny-mce-editor" rows="5"></textarea></div>';
            $output .= '</div>';
            $output .= '</div>';
    }
        $output .= '</div>';
    $output .= '</div>';
    echo $output;
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($) {
        function add_workflow_content(){
        var output = '';
            output += '<div class="workflow-container">';
            output += '<input type="hidden" name="workflow-count[]" value="1">';
                output += '<div class="workflow-group">';
                    output += '<div class="workflow-title-column">Workflow Title</div>';
                    output += `<div class="input-column"><input name="workflow_title[]" type="text" placeholder="Workflow Title" value=""></div>`;
                output += '</div>'
                output += '<div class="workflow-group">';
                    output += '<div class="workflow-title-column">Workflow Description</div>';
                    output += `<div class="input-column"><textarea  name="workflow_description[]" class="tiny-mce-editor" rows="5"></textarea></div>`;
                output += '</div>'
                output += '<div class="workflow-group">'
                    // output += '<div class="workflow-title-column">Workflow Checklist<i class="fa fa-plus-circle add-checklist_1" aria-hidden="true"></i></label></div>'
                    // output += '<div class="input-column">';
                    //     output += `<div class="workflow-checklist workflow-checklists">`;
                    //         // output += `<input type="text" name="checklists1[]" placeholder="Checklist Title" class="worflow-inputs-checklist" value="">`;
                    //     output += '</div>';
                    // output += '</div>';
                output += '</div>';
            output += '</div>';
            $('.workflow-loop').append(output);
        }
            // add_workflow_content()
            $('.add-dynamic-workflow').on('click',function(){
                var post_id = $(this).attr('data-id')
                var workflow_count = $(this).attr('workflow-count')
                // update_created_workflows(post_id,workflow_count);
                add_workflow_content();
            })
            function update_created_workflows(post_id,workflow_count){
                var workflow_id = post_id;
                var created_workflow = 2;
                    jQuery.ajax({
                    type : "POST",
                    url : ajaxurl,
                    data : {action: "update_created_workflow_count",workflow_id:workflow_id,workflow_count:workflow_count},
                    success: function(response) {
                        // alert('Email log deleted Successfuly')
                        console.log(response);
                        // location.reload()
                    }
                });
            }
        });     
    </script>
        <?php
  }
  add_action('save_post_workflow','save_workflows',10);
  function save_workflows(){
    if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    global $post;
   
    if(!empty($_POST['workflow_title'])){
        $titles = $_POST['workflow_title'];
        update_post_meta($post->ID,'workflow_titles',serialize($titles));
        // 
        $checklists = [];
        foreach($titles as $key => $title){
            $name = "checklists$key";
            $checklists[$name] = $_POST[$name];
        }
        if(!empty($checklists)){
            foreach($checklists as $key => $value){
                update_post_meta($post->ID,$key,serialize($value));
            }
        }
    }

    if(!empty($_POST['workflow_description'])){
        $descriptions = $_POST['workflow_description'];
        update_post_meta($post->ID,'workflow_descriptions',serialize($descriptions));
    }
   
    
    
    
    update_post_meta($post->ID,'created_workflows',count($_POST['workflow_title']));
  }
  function article_attachment_callback(){
    global $post;
    $target_audience = [
        'toggle_all' => 'Toggle All',
        'general_public' => 'General public',
        'influencers' => 'Inlfuencers',
        'national_contractor' => 'National Contractor',
        'private_contractor' => 'Private Contractor',
        'sbc' => 'SBC',
        'spc' => 'SPC',
        'specifiers' => 'Specifiers',
    ];
    $content_pillars = [
        'toggle_all' => 'Toggle All',
        'news_innovation' => 'News & Innovation',
        'buhay_contractor' => 'Buhay Contractor',
        'contruction_tips' => 'Construction Tips',
        'health_tips' => 'Health & Tips',
        'professional_learning' => 'Professional Learning',
    ];
    $content_format = [
        'toggle_all' => 'Toggle All',
        'article' => 'Article',
        'ifographic' => 'Infographic',
        'listicle' => 'Listicle',
        'quiz' => 'Quiz',
        'survey' => 'Survey',
        'video' => 'Video',
        'webinar' => 'Webinar',
    ];
    $journey_stage = [
        'toggle_all' => 'Toggle All',
        'bottom_funnel' => 'Bottom of the Funnel',
        'middle_funnel' => 'Middle of the Funnel',
        'top_funnel' => 'Top of the Funnel',
    ];
    $project_stage = [
        'toggle_all' => 'Toggle All',
        'acceptance' => 'Acceptance',
        'bid' => 'Bid',
        'construction' => 'Construction',
        'design' => 'Design',
        'groundwork' => 'Groundwork',
        'mobilization' => 'Mobilization',
        'planning' => 'Planning',
        'rospecting' => 'Prospecting',
        'punchlist' => 'Punchlist',
        'scoping' => 'Scoping',
        'turnover' => 'Turnover',
    ];
    // Get value on database
    $database_attachment_title = [
        'target_audience',
        'content_pillars',
        'content_format',
        'journey_stage',
        'project_stage'
    ];
    $target_audience_isset = get_post_meta($post->ID,'target_Audience');
    $target_audience_selected = unserialize($target_audience_isset[0]);
    $audience_count = 0;
    // 
    $content_pillars_isset = get_post_meta($post->ID,'content_pillars');
    $content_pillars_selected = unserialize($content_pillars_isset[0]);
    $content_pillars_count = 0;
    // 
    $content_format_isset = get_post_meta($post->ID,'content_format');
    $content_format_selected = unserialize($content_format_isset[0]);
    $content_format_count = 0;
    // 
    $journey_stage_isset = get_post_meta($post->ID,'journey_stage');
    $journey_stage_selected = unserialize($journey_stage_isset[0]);
    $journey_stage_count = 0;
    // 
    $project_stage_isset = get_post_meta($post->ID,'project_stage');
    $project_stage_selected = unserialize($project_stage_isset[0]);
    $project_stage_count = 0;
    


    $output = '';
    $output .= '<div class="article-attachement-container">';
        $output .= '<div id="attachment-td">';
            // Target Audience Checkbox options
            $output .= '<div class="attachement-group">';
                $output .= '<p class="attachment-div-title">Target Audience</p>';
                $output .= '<div  class="attachment-checklist" id="target_audience">';
                foreach($target_audience as $audience => $value){
                   if($audience_count < count($target_audience_selected) && $value == $target_audience_selected[$audience_count]){
                        $output .= '<label>'.$value.'<input name="'.$audience.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'" checked="checked"></label>';
                        $audience_count++;
                   }else{
                    $output .= '<label>'.$value.'<input name="'.$audience.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'"></label>';
                   }
                }
                $output .= '</div>';
            $output .= '</div>';
            //  Content Pillar Checkbox options
            $output .= '<div class="attachement-group">';
                $output .= '<p class="attachment-div-title" id="content-pillars">Content Pillar</p>';
                $output .= '<div  class="attachment-checklist" id="content_pillar">';
                foreach($content_pillars as $content => $value){
                    if($content_pillars_count < count($content_pillars_selected) && $value == $content_pillars_selected[$content_pillars_count]){
                        $output .= '<label>'.$value.'<input name="'.$content.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'" checked="checked"></label>';
                        $content_pillars_count++;
                   }else{
                    $output .= '<label>'.$value.'<input name="'.$content.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'"></label>';
                   }
                }
                $output .= '</div>';
            $output .= '</div>';        
            // Content Format Checkbox options
            $output .= '<div class="attachement-group">';
                $output .= '<p class="attachment-div-title" id="content-format">Content Format</p>';
                $output .= '<div  class="attachment-checklist" id="content_format">';
                foreach($content_format as $content => $value){
                    if($content_format_count < count($content_format_selected) && $value == $content_format_selected[$content_format_count]){
                        $output .= '<label>'.$value.'<input name="'.$content.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'" checked="checked"></label>';
                        $content_format_count++;
                   }else{
                        $output .= '<label>'.$value.'<input name="'.$content.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'"></label>';
                   }   
                }
                $output .= '</div>';
            $output .= '</div>';        
            // Journey Stage Checkbox options
            $output .= '<div class="attachement-group">';
                $output .= '<p class="attachment-div-title">Journey Stage</p>';
                $output .= '<div  class="attachment-checklist" id="journey_stage">';
                foreach($journey_stage as $journery => $value){
                    if($journey_stage_count < count($journey_stage_selected) && $value == $journey_stage_selected[$journey_stage_count]){
                        $output .= '<label>'.$value.'<input name="'.$journery.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'" checked="checked"></label>';
                        $journey_stage_count++;
                   }else{
                        $output .= '<label>'.$value.'<input name="'.$journery.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'"></label>';
                   }   
                }
                $output .= '</div>';
            $output .= '</div>';        
            //  Project Stage Checkbox options
            $output .= '<div class="attachement-group">';
                $output .= '<p class="attachment-div-title" id="project-stage">Project Stage</p>';
                $output .= '<div  class="attachment-checklist" id="project_stage">';
                foreach($project_stage as $project => $value){
                    if($project_stage_count < count($project_stage_selected) && $value == $project_stage_selected[$project_stage_count]){
                        $output .= '<label>'.$value.'<input name="'.$project.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'" checked="checked"></label>';
                        $project_stage_count++;
                   }else{
                        $output .= '<label>'.$value.'<input name="'.$project.'" type="checkbox" class="attachment-checkbox-toggle" value="'.$value.'"></label>';
                   }  
                }
                $output .= '</div>';
            $output .= '</div>';   
            //  
        $output .= '</div>';
    $output .= '</div>';
    echo $output;

  }
  add_action('save_post_article','save_attachments');
  function save_attachments($post_id){
    if(defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    $target_audience = [
        'general_public' => 'General public',
        'influencers' => 'Inlfuencers',
        'national_contractor' => 'National Contractor',
        'private_contractor' => 'Private Contractor',
        'sbc' => 'SBC',
        'spc' => 'SPC',
        'specifiers' => 'Specifiers',
    ];
    $content_pillars = [
        'news_innovation' => 'News & Innovation',
        'buhay_contractor' => 'Buhay Contractor',
        'contruction_tips' => 'Construction Tips',
        'health_tips' => 'Health & Tips',
        'professional_learning' => 'Professional Learning',
    ];
    $content_format = [
        'article' => 'Article',
        'ifographic' => 'Infographic',
        'listicle' => 'Listicle',
        'quiz' => 'Quiz',
        'survey' => 'Survey',
        'video' => 'Video',
        'webinar' => 'Webinar',
    ];
    $journey_stage = [
        'bottom_funnel' => 'Bottom of the Funnel',
        'middle_funnel' => 'Middle of the Funnel',
        'top_funnel' => 'Top of the Funnel',
    ];
    $project_stage = [
        'acceptance' => 'Acceptance',
        'bid' => 'Bid',
        'construction' => 'Construction',
        'design' => 'Design',
        'groundwork' => 'Groundwork',
        'mobilization' => 'Mobilization',
        'planning' => 'Planning',
        'rospecting' => 'Prospecting',
        'punchlist' => 'Punchlist',
        'scoping' => 'Scoping',
        'turnover' => 'Turnover',
    ];
    $target_audience_array = [];
    $content_pillars_array = [];
    $content_format_array = [];
    $journey_stage_array = [];
    $project_stage_array = [];
    // target_audience
    foreach($target_audience as $target_audience_key => $target_audience_value){
        if(isset($_POST[$target_audience_key])){
            $target_audience_array[] = $_POST[$target_audience_key];
        }
    }
    // content_pillars
    foreach($content_pillars as $content_pillars_key => $content_pillars_value){
        if(isset($_POST[$content_pillars_key])){
            $content_pillars_array[] = $_POST[$content_pillars_key];
        }
    }
    // content_format
    foreach($content_format as $content_format_key => $content_format_value){
        if(isset($_POST[$content_format_key])){
            $content_format_array[] = $_POST[$content_format_key];
        }
    }
    // journey_stage
    foreach($journey_stage as $journey_stage_key => $journey_stage_value){
        if(isset($_POST[$journey_stage_key])){
            $journey_stage_array[] = $_POST[$journey_stage_key];
        }
    }
    // project_stage
    foreach($project_stage as $project_stage_key => $project_stage_value){
        if(isset($_POST[$project_stage_key])){
            $project_stage_array[] = $_POST[$project_stage_key];
        }
    }
    // Update Post Meta
    update_post_meta($post_id,'target_Audience',serialize($target_audience_array));
    update_post_meta($post_id,'content_pillars',serialize($content_pillars_array));
    update_post_meta($post_id,'content_format',serialize($content_format_array));
    update_post_meta($post_id,'journey_stage',serialize($journey_stage_array));
    update_post_meta($post_id,'project_stage',serialize($project_stage_array));
  }
  function dashboard_redirect(){
    wp_redirect(admin_url('/admin.php?page=index'));
}
add_action('load-index.php','dashboard_redirect');
function test(){
    global $wpdb;
   $sql = ("");
echo '<pre>';
print_r($wpdb->get_results("SELECT * FROM $wpdb->posts WHERE `post_title` LIKE '%prac%'"));
echo '</pre>';
die();
}
// add_action('admin_init','test');


