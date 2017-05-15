<?php

    /*
    * Plugin Name: Fixed Publish Postbox
    * Plugin URI: http://www.squie.com
    * Description: A lightweight plugin which takes the existing WordPress 'Publish Postbox' and places it in a fixed position allowing you to scroll down page, posts and custom post types as far as you like and always have access to the publish/update button.
    * Author: Errol Sidelsky
    * Author URI: http://www.squie.com
    * Version: 1.0
    * License: GPLv2 or later
    * License URI: http://www.gnu.org/licenses/gpl-2.0.html
    */

    /*
    * Enqueue scripts
    */
    function ers_enqueue_plugin_scripts() {

        // Register script - include jQuery
       wp_enqueue_script('my_script', plugins_url('assets/js/main.js', __FILE__), array( 'jquery' ), '1.0', true);

    }

    // wp_enqueue_scripts - load script for Front End
    // admin_enqueue_scripts - load script for admin only
    add_action( 'admin_enqueue_scripts', 'ers_enqueue_plugin_scripts' );


    /*
    * Enqueue styles
    */
    function ers_enqueue_plugin_styles() {

        // register styles
        wp_register_style( 'custom-style', plugins_url( 'assets/css/style.css', __FILE__ ), array(), '1,0', 'all' );
        wp_enqueue_style ( 'custom-style' );


    }

    add_action( 'admin_enqueue_scripts', 'ers_enqueue_plugin_styles' );


    /**
    * Include ACF
    */
    add_filter(plugins_url('assets/admin/advanced-custom-fields', __FILE__), 'my_acf_settings_path');

    function my_acf_settings_path( $path ) {

        // update path
        $path = get_stylesheet_directory() . '/acf/';

        // return
        return $path;

    }


    // 2. customize ACF dir
    add_filter('advanced-custom-fields/settings/dir', 'my_acf_settings_dir');

    function my_acf_settings_dir( $dir ) {

        // update path
        $dir = get_stylesheet_directory_uri() . '/acf/';

        // return
        return $dir;

    }


    // 3. Hide ACF field group menu item
    add_filter('acf/settings/show_admin', '__return_false');


    // 4. Include ACF
    //include_once( get_stylesheet_directory() . '/assets/admin/advanced-custom-fields/acf.php' );

 ?>
