<?php
/**
 * Plugin Name: BB Connect for Charitable
 * Plugin URI: http://www.github.com/helgatheviking/bb-connect-charitable
 * Description: A plugin for adding Charitabe modules to Beaver Builder.
 * Version: 1.0.0
 * Author: Kathy Darling
 * Author URI: http://www.kathyisawesome.com
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'BBC_Charitable' ) ) :

    /**
     * BBC_Charitable()
     *
     * @since   1.0.0
     */
    final class BBC_Charitable {

        /**
         * @var string
         */
        const VERSION = '1.0.0';


        /**
         * @var BBC_Charitable()
         */
        private static $_instance = null;


        /**
        * Get an instance of this class.
        * @since  1.0.0
        */
        public static function get_instance() {
            if ( is_null( self::$_instance ) )
                self::$_instance = new self();
            return self::$_instance;
        }

        /**
         * Throw error on object clone.
         *
         * @since  1.0
         * @access protected
         * @return void
         */
        public function __clone() {
            // Cloning instances of the class is forbidden.
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'bbc-charitable' ), '1.0' );
        }

        /**
         * Disable de-serializing of the class.
         *
         * @since  1.0
         * @access protected
         * @return void
         */
        public function __wakeup() {
            // de-serializing instances of the class is forbidden.
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'bbc-charitable' ), '1.0' );
        }

        /**
         * Initialize the plugin.
         */
        public function __construct() {
    		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
    		add_action( 'init', array( $this, 'load_module_examples' ) );
    		add_action( 'fl_builder_control_my-custom-field', array( $this, 'custom_field' ), 1, 3 );
    		add_action( 'wp_enqueue_scripts', array( $this, 'custom_field_assets' ) );
        }


        /**
         * Set up the internationalisation for the plugin. 
    	 *
    	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
    	 *
    	 * Locales found in:
    	 *      - WP_LANG_DIR/charitable-bb/charitable-bb-LOCALE.mo
    	 *      - WP_LANG_DIR/plugins/charitable-bb-LOCALE.mo
         *
         * @return  void
         * @access  public
         * @since   1.0.0
         */
    	public function load_plugin_textdomain() {
    		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
    		$locale = apply_filters( 'plugin_locale', $locale, 'bbc-charitable' );

    		unload_textdomain( 'bbc-charitable' );
    		load_plugin_textdomain( 'bbc-charitable', false, plugin_basename( dirname( __FILE__ ) ) . '/languages'  );
        }

    	/**
    	 * Custom modules
    	 */
    	public function load_module_examples() {
    		if ( class_exists( 'FLBuilder' ) && class_exists( 'Charitable' ) ) {
    		    require_once 'fields/bbc-toggle/bbc-toggle.php';
                require_once 'modules/bbc-charitable-campaigns/bbc-charitable-campaigns.php';
                require_once 'modules/bbc-charitable-donation/bbc-charitable-donation-form.php';
    		}
    	}

    	/**
    	 * Custom fields
    	 */
    	public function custom_field( $name, $value, $field ) {
    	    echo '<input type="text" class="text text-full" name="' . $name . '" value="' . $value . '" />';
    	}



    	/**
    	 * Custom field styles and scripts
    	 */
    	public function custom_field_assets() {
    	    if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
    	        wp_enqueue_style( 'my-custom-fields', BBC_Charitable()->plugin_url() . '/assets/css/fields.css', array(), '' );
    	        wp_enqueue_script( 'my-custom-fields', BBC_Charitable()->plugin_url() . '/assets/js/fields.js', array(), '', true );
    	    }
    	}

        /*-----------------------------------------------------------------------------------*/
        /*  Helper Functions                                                                 */
        /*-----------------------------------------------------------------------------------*/

        /**
         * Get the plugin url.
         *
         * @return string
         */
        public function plugin_url() {
            return untrailingslashit( plugins_url( '/', __FILE__ ) );
        }


        /**
         * Get the plugin path.
         *
         * @return string
         */
        public function plugin_path() {
            return untrailingslashit( plugin_dir_path( __FILE__ ) );
        }


    }

endif; // Do not remove.


/**
 * Returns the main instance of BBC_Charitable to prevent the need to use globals.
 *
 * @return WooCommerce
 */
function BBC_Charitable() {
    return BBC_Charitable::get_instance();
}

// Launch the whole plugin.
BBC_Charitable();