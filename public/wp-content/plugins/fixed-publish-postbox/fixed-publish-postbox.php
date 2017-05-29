<?php


    /**
    * @package   Fixed Publish Postbox
    * @author    Errol Sidelsky
    * @license   GPL-2.0+
    * @link      https://github.com/GaryJones/move-floating-social-bar-in-genesis
    * @copyright 2013 Errol Sidelsky, Squie LTD
    *
    * Plugin Name: Fixed Publish Postbox
    * Plugin URI: http://www.squie.com
    * Description: A lightweight plugin which takes the existing WordPress 'Publish Postbox' and places it in a fixed position allowing you to scroll down page, posts and custom post types as far as you like and always have access to the publish/update button.
    * Author: Errol Sidelsky
    * Author URI: http://www.squie.com
    * Version: 1.0
    * License: GPLv2 or later
    * License URI: http://www.gnu.org/licenses/gpl-2.0.html
    */

    /**
    * Feature list
    * Show POST ID
    * Show box shadow
    * Center in middle of screen
    * on mobile move to bottom
    */

    /**
    * If this file is called directly, abort.
    */



    /**
    * Require all functions within the functions folder
    */
    class LoadPlugin {

        public $folder;
        public $files;

        public function getFunctions() {

            $folder = 'admin/functions/*.php';
            $files = glob(plugin_dir_path( __FILE__ ) . $folder);

            foreach( $files as $file ) {
                require_once( $file );
            }

        }

    }

    $file = new LoadPlugin();
    $file-> getFunctions();

?>
