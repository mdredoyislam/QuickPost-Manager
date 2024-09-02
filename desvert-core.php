<?php
/*
    Plugin Name: DesVert Core
    Plugin URI: https://redoyit.com/
    Description: <code>DesVert Core</code> by <code>Md. Redoy Islam</code> is a powerful WordPress plugin designed to extend the platform’s functionality with advanced content management features. With this plugin, you can create and manage <code>Custom Post Types</code> tailored to your needs, enhancing content organization through <code>Custom Taxonomies</code>. The Custom Post Column feature allows you to add and display additional data in the admin panel for better post management. Display posts seamlessly on your site with customizable templates using the Display Post feature. Additionally, <code>Custom Post Meta Fields</code> enable you to store and manage extra information for your posts, providing a comprehensive solution for advanced WordPress content management.
    Version: 1.2
    Requires at least: 5.8
    Requires PHP: 5.6.20
    Author: Md. Redoy Islam
    Author URI: https://redoyit.com/wordpress-plugins/
    License: GPLv2 or later
    Text Domain: desvertcore
    Domain Path: /languages
    Plugin Type: advanced-custom-fields
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define('DVCORE_DIR', plugin_dir_url(__FILE__));
define('DVCORE_ASSETS', DVCORE_DIR.'assets/');
define('DVCORE_ASSETS_ADMIN', DVCORE_ASSETS.'admin/');
define('DVCORE_ASSETS_PUBLIC', DVCORE_DIR.'public/');

define('DVCORE_ASSETS_ADMIN_JS_DIR', DVCORE_ASSETS_ADMIN.'js/');
define('DVCORE_ASSETS_ADMIN_CSS_DIR', DVCORE_ASSETS_ADMIN.'css/');
define('DVCORE_ASSETS_ADMIN_IMG_DIR', DVCORE_ASSETS_ADMIN.'img/');

define('DVCORE_ASSETS_PUBLIC_JS_DIR', DVCORE_ASSETS_PUBLIC.'js/');
define('DVCORE_ASSETS_PUBLIC_CSS_DIR', DVCORE_ASSETS_PUBLIC.'css/');
define('DVCORE_ASSETS_PUBLIC_IMG_DIR', DVCORE_ASSETS_PUBLIC.'img/');

define('DVCORE_VERSION', time());

class DesVertCore{

    private $version;
    function __construct(){

        $this->version = time();
        add_action('plugin_loaded', array($this, 'desvertcore_load_textdomain'));
        add_action('wp_enqueue_scripts', array($this, 'load_front_assets'));
        add_action('admin_enqueue_scripts', array($this, 'load_admin_assets'));

        add_filter( 'site_transient_update_plugins', array($this, 'disable_acf_plugins_update'));

        require_once plugin_dir_path(__FILE__)."tgm/class-tgm-plugin-activation.php";
        require_once plugin_dir_path(__FILE__)."tgm/config-tgm.php";

        require_once plugin_dir_path(__FILE__)."widgets/widgets.php";

        require_once plugin_dir_path(__FILE__)."inc/projects.php";
        require_once plugin_dir_path(__FILE__)."inc/service.php";
        require_once plugin_dir_path(__FILE__)."inc/teatimonial.php";

        require_once plugin_dir_path(__FILE__)."inc/shortcode.php";
        require_once plugin_dir_path(__FILE__)."inc/post-meta.php";

        require_once plugin_dir_path(__FILE__)."post-type/post-type.php";
        require_once plugin_dir_path(__FILE__)."post-type/taxonomies.php";
        
    }

    function disable_acf_plugins_update($value){
        if( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {        
            unset( $value->response['advanced-custom-fields-pro/acf.php'] );
        }
        return $value;
    }

    function load_admin_assets(){
        wp_enqueue_style('dvadmin-style', DVCORE_ASSETS_ADMIN_CSS_DIR . 'dvadmin-main.css');
    }

    function load_front_assets(){
        wp_enqueue_script('icons', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js', null, $this->version, true);
    }

    function desvertcore_load_textdomain(){ 
        load_plugin_textdomain('desvertcore', false, dirname(__FILE__) . '/languages');
    }
}
new DesVertCore();