<?php

    /*
    * Enqueue styles
    */
    function ers_enqueue_plugin_styles() {

        $file = 'css/style.css';
        $dir = plugins_url($file, __DIR__);

        wp_register_style( 'custom-style', $dir, array(), '1,0', 'all' );
        wp_enqueue_style ( 'custom-style' );


    }
    add_action('admin_enqueue_scripts', 'ers_enqueue_plugin_styles');

?>
