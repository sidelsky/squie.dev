<?php

    /*
    * Enqueue scripts
    */
    function ers_enqueue_plugin_scripts() {

        $file = '/js/main.js';
        $dir = plugins_url($file, __DIR__);

        // Register script - include jQuery
        wp_enqueue_script('my_script', $dir, array( 'jquery' ), '1.0', true);

    }

    // wp_enqueue_scripts - load script for Front End
    // admin_enqueue_scripts - load script for admin only
    add_action('admin_enqueue_scripts', 'ers_enqueue_plugin_scripts');

?>
