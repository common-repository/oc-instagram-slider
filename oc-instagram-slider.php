<?php
/**
* Plugin Name: Social Feed Slider
* Description: This plugin allows you to display Instagram Slider ( All slider customize options ).
* Version: 1.0
* Author: Ocean Infotech
* Author URI: https://www.xeeshop.com
* Copyright: 2019 
*/

if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('OCINSTA_PLUGIN_NAME')) {
    define('OCINSTA_PLUGIN_NAME', 'Instagram Gallery & Slider');
}
if (!defined('OCINSTA_PLUGIN_VERSION')) {
    define('OCINSTA_PLUGIN_VERSION', '1.0.0');
}
if (!defined('OCINSTA_PLUGIN_FILE')) {
    define('OCINSTA_PLUGIN_FILE', __FILE__);
}
if (!defined('OCINSTA_PLUGIN_DIR')) {
    define('OCINSTA_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCINSTA_BASE_NAME')) {
    define('OCINSTA_BASE_NAME', plugin_basename(OCINSTA_PLUGIN_FILE));
}
if (!defined('OCINSTA_DOMAIN')) {
    define('OCINSTA_DOMAIN', 'ocinsta');
}



if (!class_exists('OCINSTAMAIN')) {

    class OCINSTAMAIN {

        protected static $instance;

        //Load all includes files
        function includes() {
            include_once('admin/ocinsta-backend.php');
            include_once('admin/ocinsta-shortcode.php');
        }

        function init() {
            add_action( 'admin_enqueue_scripts', array($this, 'OCINSTA_load_admin_script_style'));
            add_action( 'wp_enqueue_scripts', array($this, 'OCINSTA_load_script_style'));
            add_filter( 'wp_enqueue_scripts', array($this, 'insert_jquery'),1);
            add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
        }

        function plugin_row_meta( $links, $file ) {
            if ( OCINSTA_BASE_NAME === $file ) {
                $row_meta = array(
                    'rating'    =>  '<a href="https://wordpress.org/support/plugin/oc-instagram-slider/reviews/#new-post" target="_blank"><img src="'.OCINSTA_PLUGIN_DIR.'/includes/images/star.png" class="ocinsta_rating_div"></a>',
                );

                return array_merge( $links, $row_meta );
            }

            return (array) $links;
        }

        function insert_jquery() {
		    wp_enqueue_script('jquery', false, array(), false, false);
	    }
	

        function OCINSTA_load_admin_script_style() {
            wp_enqueue_style( 'instaback_css', OCINSTA_PLUGIN_DIR . '/includes/css/custom.css', false, '1.0.0' );
            wp_enqueue_script( 'instaback_js', OCINSTA_PLUGIN_DIR . '/includes/js/custom.js', false, '1.0.0' );
        }
    

        function OCINSTA_load_script_style() {
            wp_enqueue_style( 'owlcarousel-min', OCINSTA_PLUGIN_DIR . '/includes/js/owlcarousel/assets/owl.carousel.min.css', false, '1.0.0' );
            wp_enqueue_style( 'owlcarousel-theme', OCINSTA_PLUGIN_DIR . '/includes/js/owlcarousel/assets/owl.theme.default.min.css', false, '1.0.0' );
            wp_enqueue_script( 'owlcarousel', OCINSTA_PLUGIN_DIR . '/includes/js/owlcarousel/owl.carousel.js', false, '1.0.0' );
            wp_enqueue_style( 'instafront_css', OCINSTA_PLUGIN_DIR . '/includes/css/front-css.css', false, '1.0.0' );
            wp_enqueue_script( 'masonryinsta', OCINSTA_PLUGIN_DIR . '/includes/js/masonry.pkgd.min.js', false, '1.0.0' );
            wp_enqueue_script( 'instafront_js', OCINSTA_PLUGIN_DIR . '/includes/js/front.js', false, '1.0.0' );
	    }

    

        public static function do_activation() {
            set_transient('ocinsta-first-rating', true, MONTH_IN_SECONDS);
        }

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
                self::$instance->includes();
            }
            return self::$instance;
        }
    }

    add_action('plugins_loaded', array('OCINSTAMAIN', 'instance'));
    register_activation_hook(OCINSTA_PLUGIN_FILE, array('OCINSTAMAIN', 'do_activation'));
}
