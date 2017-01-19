<?php
  //  ___
  // | __|_ _  __ _ _  _ ___ _  _ ___ ___
  // | _|| ' \/ _` | || / -_) || / -_|_-<
  // |___|_||_\__, |\_,_\___|\_,_\___/__/
  //             |_|

  //Enqueue scripts
  add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
  //Enqueue styles
  add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

  //Enqueue scripts
  function enqueue_scripts() {

    //jQuery enqueued
    if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
      wp_deregister_script('jquery');
      wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', false, '2.2.0', true);
      wp_enqueue_script('jquery');
    }

    https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/scroll-snap-polyfill.js

    if (WP_ENV == 'production') {
      $scriptFilename = 'app.min.js';
    } else {
      $scriptFilename = 'app.min.js';
    }

    wp_register_script('theme_js', get_template_directory_uri() . '/assets/build/' . $scriptFilename, array(), '1.1', true);

    // Localize the script with new data
    $site_data = array(
      'themePath'        =>  get_template_directory_uri()
    );
    wp_localize_script('theme_js', 'site_data', $site_data);

    // Enqueued script with localized data.
    wp_enqueue_script('theme_js');

    //wp_enqueue_script('polyfill', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/scroll-snap-polyfill.js', NULL, '1.0', true);

  }


  //Enqueue styles
  function enqueue_styles() {

     wp_enqueue_style('theme_css', get_template_directory_uri() . '/assets/build/style.min.css');

  }
?>
